<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// 1. Ensure Table Exists (Self-healing)
try {
    $checkTable = $pdo->query("SHOW TABLES LIKE 'site_settings'");
    if ($checkTable->rowCount() == 0) {
        $pdo->exec("CREATE TABLE site_settings (
            id INT PRIMARY KEY DEFAULT 1,
            site_name VARCHAR(255) DEFAULT 'Frequency Lab Admin',
            support_email VARCHAR(255) DEFAULT 'support@frequencylab.com',
            welcome_message TEXT,
            dark_mode TINYINT(1) DEFAULT 0,
            accent_color VARCHAR(20) DEFAULT 'blue',
            maintenance_mode TINYINT(1) DEFAULT 0,
            allow_registration TINYINT(1) DEFAULT 1,
            updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
        )");
        
        $pdo->exec("INSERT INTO site_settings (id, welcome_message) VALUES (1, 'Innovate. Learn. Create.')");
    }
} catch (PDOException $e) {
    die("Database Error: " . $e->getMessage());
}

// 2. Handle Form Submission
$success_msg = "";
$error_msg = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $site_name = trim($_POST['site_name']);
    $support_email = trim($_POST['admin_email']);
    $welcome_message = trim($_POST['site_description']);
    $accent_color = $_POST['accent_color'];
    
    // Checkboxes send 'on' if checked, nothing if unchecked
    $dark_mode = isset($_POST['dark_mode']) ? 1 : 0;
    $maintenance_mode = isset($_POST['maintenance_mode']) ? 1 : 0;
    $allow_registration = isset($_POST['allow_registration']) ? 1 : 0;

    try {
        $stmt = $pdo->prepare("UPDATE site_settings SET 
            site_name = ?, 
            support_email = ?, 
            welcome_message = ?, 
            dark_mode = ?, 
            accent_color = ?, 
            maintenance_mode = ?, 
            allow_registration = ? 
            WHERE id = 1");
        
        $stmt->execute([
            $site_name, 
            $support_email, 
            $welcome_message, 
            $dark_mode, 
            $accent_color, 
            $maintenance_mode, 
            $allow_registration
        ]);

        $success_msg = "Settings saved successfully.";
        
    } catch (PDOException $e) {
        $error_msg = "Failed to save settings: " . $e->getMessage();
    }
}

// 3. Fetch Current Settings
try {
    $stmt = $pdo->query("SELECT * FROM site_settings WHERE id = 1");
    $settings = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Fallback defaults if fetch fails (shouldn't happen due to initialization above)
    if (!$settings) {
        $settings = [
            'site_name' => 'Frequency Lab Admin',
            'support_email' => 'support@frequencylab.com',
            'welcome_message' => 'Innovate. Learn. Create.',
            'dark_mode' => 0,
            'accent_color' => 'blue',
            'maintenance_mode' => 0,
            'allow_registration' => 1
        ];
    }
} catch (PDOException $e) {
    die("Error fetching settings: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - <?php echo htmlspecialchars($settings['site_name']); ?></title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        /* Custom Toggle Switch */
        .toggle-checkbox:checked {
            right: 0;
            border-color: #2563EB;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #2563EB;
        }
    </style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">System Settings</h1>
                        <p class="text-sm text-slate-500 mt-1">Manage general site configuration and preferences.</p>
                    </div>
                    <button type="submit" form="settings-form" class="inline-flex items-center px-4 py-2.5 bg-blue-600 border border-transparent rounded-lg font-medium text-sm text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 shadow-sm transition-all">
                        Save Changes
                    </button>
                </div>

                <?php if ($success_msg): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm animate-fade-in-down">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-green-700"><?php echo htmlspecialchars($success_msg); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                
                <?php if ($error_msg): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm animate-fade-in-down">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700"><?php echo htmlspecialchars($error_msg); ?></p>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <form id="settings-form" method="POST" class="space-y-6">
                    
                    <!-- General Settings Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-medium text-slate-900">General Information</h2>
                            <p class="text-sm text-slate-500 mt-1">Basic details about the website.</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="site_name" class="block text-sm font-medium text-slate-700 mb-1">Display Name</label>
                                    <input type="text" id="site_name" name="site_name" value="<?php echo htmlspecialchars($settings['site_name']); ?>" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
                                </div>
                                <div>
                                    <label for="admin_email" class="block text-sm font-medium text-slate-700 mb-1">Support Email</label>
                                    <input type="email" id="admin_email" name="admin_email" value="<?php echo htmlspecialchars($settings['support_email']); ?>" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border">
                                </div>
                            </div>
                            
                            <div>
                                <label for="site_description" class="block text-sm font-medium text-slate-700 mb-1">Welcome Message / Tagline</label>
                                <textarea id="site_description" name="site_description" rows="3" class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm px-4 py-2 border"><?php echo htmlspecialchars($settings['welcome_message']); ?></textarea>
                                <p class="mt-2 text-sm text-slate-500">This appears on the admin dashboard welcome screen.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Appearance & Branding -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                        <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-medium text-slate-900">Appearance</h2>
                            <p class="text-sm text-slate-500 mt-1">Customize the look and feel of the admin panel.</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-slate-900">Dark Mode Support</h3>
                                    <p class="text-sm text-slate-500">Enable theme toggle for dashboard users</p>
                                </div>
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="dark_mode" id="dark_mode" <?php echo $settings['dark_mode'] ? 'checked' : ''; ?> class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300 transition-all duration-300"/>
                                    <div class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></div>
                                </div>
                            </div>
                            <hr class="border-gray-100">
                             <div>
                                <label class="block text-sm font-medium text-slate-700 mb-2">Primary Accent Color</label>
                                <div class="flex items-center gap-3">
                                    <label class="cursor-pointer">
                                        <input type="radio" name="accent_color" value="blue" class="sr-only peer" <?php echo $settings['accent_color'] === 'blue' ? 'checked' : ''; ?>>
                                        <div class="w-8 h-8 rounded-full bg-blue-600 ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-blue-600 transition-all shadow-sm"></div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="accent_color" value="purple" class="sr-only peer" <?php echo $settings['accent_color'] === 'purple' ? 'checked' : ''; ?>>
                                        <div class="w-8 h-8 rounded-full bg-purple-600 ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-purple-600 transition-all shadow-sm"></div>
                                    </label>
                                    <label class="cursor-pointer">
                                        <input type="radio" name="accent_color" value="green" class="sr-only peer" <?php echo $settings['accent_color'] === 'green' ? 'checked' : ''; ?>>
                                        <div class="w-8 h-8 rounded-full bg-green-600 ring-2 ring-transparent peer-checked:ring-offset-2 peer-checked:ring-green-600 transition-all shadow-sm"></div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Security & Maintenance -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                         <div class="p-6 border-b border-gray-100 bg-gray-50/50">
                            <h2 class="text-lg font-medium text-slate-900">Security & Maintenance</h2>
                            <p class="text-sm text-slate-500 mt-1">Control system access and status.</p>
                        </div>
                        <div class="p-6 space-y-6">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-slate-900">Maintenance Mode</h3>
                                    <p class="text-sm text-slate-500">Temporarily disable public access to the main site</p>
                                </div>
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="maintenance_mode" id="maintenance_mode" <?php echo $settings['maintenance_mode'] ? 'checked' : ''; ?> class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300 transition-all duration-300"/>
                                    <div class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></div>
                                </div>
                            </div>
                             <hr class="border-gray-100">
                             <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-slate-900">Allow New User Registrations</h3>
                                    <p class="text-sm text-slate-500">If disabled, only admins can add new users</p>
                                </div>
                                <div class="relative inline-block w-10 mr-2 align-middle select-none transition duration-200 ease-in">
                                    <input type="checkbox" name="allow_registration" id="allow_registration" <?php echo $settings['allow_registration'] ? 'checked' : ''; ?> class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-4 appearance-none cursor-pointer border-gray-300 transition-all duration-300"/>
                                    <div class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </form>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
