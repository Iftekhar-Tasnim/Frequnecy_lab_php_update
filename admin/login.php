<?php
require_once '../includes/auth.php';

// Redirect if already logged in
if ($auth->isLoggedIn()) {
    header('Location: dashboard.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($auth->login($username, $password)) {
        header('Location: dashboard.php');
        exit;
    } else {
        $error = 'Invalid username or password.';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Frequency Lab</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">

    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md overflow-hidden">
        <!-- Header -->
        <div class="bg-blue-600 p-8 text-center">
            <h1 class="text-2xl font-bold text-white mb-2">Welcome Back</h1>
            <p class="text-blue-100 text-sm">Sign in to manage Frequency Lab</p>
        </div>

        <!-- Form -->
        <div class="p-8">
            <?php if ($error): ?>
                <div class="bg-red-50 text-red-600 px-4 py-3 rounded-lg text-sm mb-6 border border-red-100">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-5">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="username">Username or Email</label>
                    <input type="text" id="username" name="username" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="username or email@example.com">
                </div>
                
                <div class="mb-8">
                    <label class="block text-gray-700 text-sm font-semibold mb-2" for="password">Password</label>
                    <input type="password" id="password" name="password" required 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                        placeholder="••••••••">
                </div>

                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl">
                    Sign In
                </button>
            </form>
        </div>
        
        <div class="bg-gray-50 p-4 text-center border-t border-gray-100">
            <p class="text-xs text-gray-400">&copy; <?php echo date('Y'); ?> Frequency Lab. All rights reserved.</p>
        </div>
    </div>

</body>
</html>
