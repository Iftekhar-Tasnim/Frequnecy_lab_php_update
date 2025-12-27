<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Only Admin can access this page
if (!$auth->checkRole('admin')) {
    header('Location: dashboard.php');
    exit;
}

$success_msg = '';
$error_msg = '';

// Handle Delete
if (isset($_POST['delete_id'])) {
    $id = $_POST['delete_id'];
    
    // Prevent deleting self
    if ($id == $_SESSION['user_id']) {
        $error_msg = "You cannot delete your own account.";
    } else {
        $deleteStmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
        $deleteStmt->execute([$id]);
        $success_msg = "User deleted successfully.";
    }
}

// Fetch Users
$stmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Frequency Lab Admin</title>
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
            <!-- Header -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">User Management</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage system administrators and staff.</p>
                </div>
                
                <a href="user_form.php" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    Add New User
                </a>
            </div>

            <!-- Alerts -->
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

            <!-- Table -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-slate-50">
                        <tr>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">User</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Email</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Role</th>
                            <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Joined</th>
                            <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php foreach ($users as $user): ?>
                        <tr class="hover:bg-slate-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-600 font-bold border border-slate-200">
                                        <?php echo strtoupper(substr($user['username'], 0, 1)); ?>
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($user['username']); ?>
                                            <?php if ($user['id'] == $_SESSION['user_id']): ?>
                                                <span class="ml-2 text-xs text-blue-600 bg-blue-100 px-2 py-0.5 rounded-full">(You)</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo htmlspecialchars($user['email'] ?? 'N/A'); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if ($user['role'] == 'admin'): ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">Admin</span>
                                <?php else: ?>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">Staff</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo date('M j, Y', strtotime($user['created_at'])); ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <div class="flex items-center justify-end space-x-3">
                                    <a href="user_form.php?id=<?php echo $user['id']; ?>" class="text-blue-600 hover:text-blue-900">Edit</a>
                                    
                                    <?php if ($user['id'] != $_SESSION['user_id']): ?>
                                    <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                        <input type="hidden" name="delete_id" value="<?php echo $user['id']; ?>">
                                        <button type="submit" class="text-red-600 hover:text-red-900">Delete</button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
