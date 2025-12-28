<?php
require_once '../includes/auth.php';
$auth->requireLogin();

if (!$auth->checkRole('admin')) {
    header('Location: dashboard.php');
    exit;
}

// Initialize variables
$is_edit = false;
$id = '';
$username = '';
$role = 'staff';
$error_msg = '';
$success_msg = '';

// Check if editing
if (isset($_GET['id'])) {
    $is_edit = true;
    $id = $_GET['id'];
    
    // Fetch user
    $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
    $stmt->execute([$id]);
    $user = $stmt->fetch();
    
    if (!$user) {
        header('Location: users.php');
        exit;
    }
    
    $username = $user['username'];
    $email = $user['email'];
    $role = $user['role'];
}

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $email = trim($_POST['email']);
    $role = $_POST['role'];
    
    if (empty($username) || empty($email)) {
        $error_msg = "Username and Email are required.";
    } else {
        // Uniqueness check
        $sql = "SELECT id FROM users WHERE (username = ? OR email = ?)";
        $params = [$username, $email];
        
        if ($is_edit) {
            $sql .= " AND id != ?";
            $params[] = $id;
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        
        if ($stmt->fetch()) {
            $error_msg = "Username or Email already exists.";
        } else {
            if ($is_edit) {
                // Update
                $sql_update = "UPDATE users SET username = ?, email = ?, role = ? WHERE id = ?";
                $params_update = [$username, $email, $role, $id];
                
                // Only update password if provided
                if (!empty($password)) {
                    if (strlen($password) < 6) {
                        $error_msg = "Password must be at least 6 characters.";
                    } else {
                        $sql_update = "UPDATE users SET username = ?, email = ?, role = ?, password_hash = ? WHERE id = ?";
                        $params_update = [$username, $email, $role, password_hash($password, PASSWORD_DEFAULT), $id];
                    }
                }
                
                if (empty($error_msg)) {
                    $stmt = $pdo->prepare($sql_update);
                    if ($stmt->execute($params_update)) {
                        $success_msg = "User updated successfully.";
                        if ($id == $_SESSION['user_id']) {
                             $_SESSION['username'] = $username; // Update session if self
                        }
                    } else {
                        $error_msg = "Failed to update user.";
                    }
                }
            } else {
                // Create
                if (empty($password)) {
                    $error_msg = "Password is required for new users.";
                } elseif (strlen($password) < 6) {
                    $error_msg = "Password must be at least 6 characters.";
                } else {
                    $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, role) VALUES (?, ?, ?, ?)");
                    if ($stmt->execute([$username, $email, password_hash($password, PASSWORD_DEFAULT), $role])) {
                        $success_msg = "User created successfully.";
                        // Reset form
                        $username = '';
                        $role = 'staff'; 
                    } else {
                        $error_msg = "Failed to create user.";
                    }
                }
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $is_edit ? 'Edit User' : 'Add User'; ?> - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="mb-6 flex items-center gap-4">
                <a href="users.php" class="p-2 rounded-full hover:bg-slate-200 transition-colors text-slate-500">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </a>
                <h1 class="text-2xl font-bold text-slate-900"><?php echo $is_edit ? 'Edit User' : 'Add New User'; ?></h1>
            </div>

            <div class="max-w-xl mx-auto">
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

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-900">User Details</h3>
                    </div>
                    <div class="p-6 md:p-8">
                        <form method="POST" class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Username <span class="text-red-500">*</span></label>
                                    <input type="text" name="username" value="<?php echo htmlspecialchars($username); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Email Address <span class="text-red-500">*</span></label>
                                    <input type="email" name="email" value="<?php echo htmlspecialchars($email ?? ''); ?>" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all">
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">
                                        Password 
                                        <?php if ($is_edit): ?>
                                            <span class="text-gray-400 font-normal text-xs ml-1">(Leave blank to keep)</span>
                                        <?php else: ?>
                                            <span class="text-red-500">*</span>
                                        <?php endif; ?>
                                    </label>
                                    <input type="password" name="password" <?php echo $is_edit ? '' : 'required'; ?> class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all" placeholder="••••••••">
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Role <span class="text-red-500">*</span></label>
                                    <select name="role" class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition-all bg-white">
                                        <option value="staff" <?php echo $role === 'staff' ? 'selected' : ''; ?>>Staff Access</option>
                                        <option value="admin" <?php echo $role === 'admin' ? 'selected' : ''; ?>>Full Admin Access</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                                <a href="users.php" class="px-5 py-2.5 border border-gray-300 text-gray-700 font-medium rounded-lg hover:bg-gray-50 transition-colors">Cancel</a>
                                <button type="submit" class="px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg shadow-sm transition-colors flex items-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    <?php echo $is_edit ? 'Save Changes' : 'Create User'; ?>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
