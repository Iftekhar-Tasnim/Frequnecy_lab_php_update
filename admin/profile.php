<?php
require_once '../includes/auth.php';
$auth->requireLogin();

$success_msg = '';
$error_msg = '';

$user_id = $_SESSION['user_id'];

// Handle Profile Update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Handle Account Details Update
    if (isset($_POST['action']) && $_POST['action'] === 'update_details') {
        $new_username = trim($_POST['username']);
        $new_email = trim($_POST['email']);
        $verify_password = $_POST['verify_password']; // New field for verification
        
        if (empty($new_username) || empty($new_email)) {
            $error_msg = "Username and Email cannot be empty.";
        } elseif (empty($verify_password)) {
            $error_msg = "Current password is required to save changes.";
        } else {
            // Verify Password First
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();
            
            if ($user && password_verify($verify_password, $user['password_hash'])) {
                 // Check uniqueness
                $stmt = $pdo->prepare("SELECT id FROM users WHERE (username = ? OR email = ?) AND id != ?");
                $stmt->execute([$new_username, $new_email, $user_id]);
                
                if ($stmt->fetch()) {
                    $error_msg = "Username or Email already taken.";
                } else {
                    // Update details
                    $stmt = $pdo->prepare("UPDATE users SET username = ?, email = ? WHERE id = ?");
                    if ($stmt->execute([$new_username, $new_email, $user_id])) {
                        $_SESSION['username'] = $new_username;
                        $success_msg = "Profile details updated successfully.";
                    } else {
                        $error_msg = "Failed to update profile.";
                    }
                }
            } else {
                $error_msg = "Incorrect password. Changes not saved.";
            }
        }
    }

    // Check Password Change
    if (isset($_POST['action']) && $_POST['action'] === 'change_password') {
        $current_password = $_POST['current_password'];
        $new_password = $_POST['new_password'];
        $confirm_password = $_POST['confirm_password'];

        if (empty($current_password)) {
            $error_msg = "Current password is required to set a new one.";
        } else {
            // Verify current password
            $stmt = $pdo->prepare("SELECT password_hash FROM users WHERE id = ?");
            $stmt->execute([$user_id]);
            $user = $stmt->fetch();

            if ($user && password_verify($current_password, $user['password_hash'])) {
                if ($new_password === $confirm_password) {
                    if (strlen($new_password) >= 6) {
                        $new_hash = password_hash($new_password, PASSWORD_DEFAULT);
                        $updateStmt = $pdo->prepare("UPDATE users SET password_hash = ? WHERE id = ?");
                        $updateStmt->execute([$new_hash, $user_id]);
                        $success_msg = "Password updated successfully.";
                    } else {
                        $error_msg = "New password must be at least 6 characters.";
                    }
                } else {
                    $error_msg = "New passwords do not match.";
                }
            } else {
                $error_msg = "Incorrect current password.";
            }
        }
    }
}

// Fetch current user details (refresh info)
$stmt = $pdo->prepare("SELECT username, email, role, created_at FROM users WHERE id = ?");
$stmt->execute([$user_id]);
$currentUser = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <!-- Mobile Header -->
        <header class="bg-white shadow-sm border-b border-gray-200 lg:hidden h-16 flex items-center px-4 justify-between z-10">
            <span class="text-xl font-bold text-gray-800">F_Lab Admin</span>
            <button id="sidebar-open" class="text-gray-500 hover:text-gray-800 focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </header>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="max-w-3xl mx-auto">
                <div class="mb-8">
                    <h1 class="text-2xl font-bold text-slate-900">My Profile</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage your account settings and security.</p>
                </div>

                <?php if ($success_msg): ?>
                    <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                            <div class="ml-3"><p class="text-sm text-green-700"><?php echo htmlspecialchars($success_msg); ?></p></div>
                        </div>
                    </div>
                <?php endif; ?>
                
                <?php if ($error_msg): ?>
                    <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                        <div class="flex">
                            <div class="flex-shrink-0"><svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg></div>
                            <div class="ml-3"><p class="text-sm text-red-700"><?php echo htmlspecialchars($error_msg); ?></p></div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    
                    <!-- Left Column: Avatar & Quick Info -->
                    <div class="lg:col-span-1 space-y-6">
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col items-center text-center">
                             <div class="h-32 w-32 rounded-full bg-slate-900 flex items-center justify-center text-white text-4xl font-bold border-4 border-slate-50 shadow-lg mb-4">
                                <?php echo strtoupper(substr($currentUser['username'], 0, 1)); ?>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900"><?php echo htmlspecialchars($currentUser['username']); ?></h2>
                            <span class="inline-flex items-center px-3 py-1 mt-2 rounded-full text-xs font-medium bg-blue-100 text-blue-800 uppercase tracking-wide">
                                <?php echo htmlspecialchars($currentUser['role']); ?>
                            </span>
                            <p class="text-xs text-gray-400 mt-4">Member Since <br> <?php echo isset($currentUser['created_at']) ? date('F j, Y', strtotime($currentUser['created_at'])) : 'N/A'; ?></p>
                        </div>
                    </div>

                    <!-- Right Column: Settings Forms -->
                    <div class="lg:col-span-2 space-y-6">
                        
                        <!-- Account Settings -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50 flex justify-between items-center">
                                <h3 class="text-lg font-semibold text-gray-900">Account Settings</h3>
                            </div>
                            <div class="p-6">
                                <form method="POST" class="space-y-5">
                                    <input type="hidden" name="action" value="update_details">
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Username</label>
                                            <input type="text" name="username" value="<?php echo htmlspecialchars($currentUser['username']); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                            <input type="email" name="email" value="<?php echo htmlspecialchars($currentUser['email'] ?? ''); ?>" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                        </div>
                                    </div>

                                    <div class="pt-4 border-t border-gray-100">
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Verify Password <span class="text-red-500 text-xs font-normal">(Required to save changes)</span></label>
                                        <input type="password" name="verify_password" placeholder="Enter current password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all bg-gray-50 focus:bg-white">
                                    </div>

                                    <div class="flex justify-end">
                                        <button type="submit" class="px-5 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors text-sm">
                                            Save Changes
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Security -->
                        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                            <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                                <h3 class="text-lg font-semibold text-gray-900">Security</h3>
                            </div>
                            <div class="p-6">
                                <form method="POST" class="space-y-4">
                                    <input type="hidden" name="action" value="change_password">
                                    
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Current Password</label>
                                        <input type="password" name="current_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">New Password</label>
                                            <input type="password" name="new_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                            <p class="text-xs text-gray-500 mt-1">Min 6 chars.</p>
                                        </div>
                                        <div>
                                            <label class="block text-sm font-medium text-gray-700 mb-1">Confirm New</label>
                                            <input type="password" name="confirm_password" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                        </div>
                                    </div>

                                    <div class="flex justify-end pt-2">
                                        <button type="submit" class="px-5 py-2 bg-slate-900 hover:bg-slate-800 text-white font-medium rounded-lg shadow-sm transition-colors text-sm">
                                            Update Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
