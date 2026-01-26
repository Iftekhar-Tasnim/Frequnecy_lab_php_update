<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Only admins can access this page
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header('Location: dashboard.php');
    exit;
}

require_once '../config/db.php';
require_once '../includes/MigrationManager.php';

$migrationResult = null;
$error = null;

// Handle migration execution
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['run_migration'])) {
    try {
        $migrationsDir = dirname(__DIR__) . '/database/migrations';
        $manager = new MigrationManager($pdo, $migrationsDir);
        
        // Capture output
        ob_start();
        $manager->migrate();
        $output = ob_get_clean();
        
        $migrationResult = [
            'success' => true,
            'output' => $output
        ];
    } catch (Exception $e) {
        $migrationResult = [
            'success' => false,
            'error' => $e->getMessage()
        ];
    }
}

// Get pending migrations count
try {
    $migrationsDir = dirname(__DIR__) . '/database/migrations';
    $manager = new MigrationManager($pdo, $migrationsDir);
    $pendingMigrations = $manager->getPendingMigrations();
    $pendingCount = count($pendingMigrations);
} catch (Exception $e) {
    $pendingCount = 0;
    $pendingMigrations = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Migration - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'prussian-blue': {
                            900: '#0B1423',
                            950: '#050A11',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-exo { font-family: 'Exo 2', sans-serif; }
    </style>
</head>
<body class="bg-prussian-blue-950 min-h-screen text-slate-300">

<div class="flex h-screen overflow-hidden relative">
    
    <!-- Ambient Background Effects -->
    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none z-0">
        <div class="absolute top-[10%] left-[20%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>
        <div class="absolute bottom-[20%] right-[10%] w-96 h-96 bg-cyan-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20"></div>
    </div>

    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden relative z-10">
        <?php include 'includes/mobile_header.php'; ?>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 md:p-8">
            <div class="max-w-4xl mx-auto">
                <!-- Header -->
                <div class="mb-8">
                    <h1 class="text-3xl font-bold text-white font-exo">Database Migration</h1>
                    <p class="text-slate-400 mt-1">Run database migrations to update your database schema</p>
                </div>

                <!-- Migration Status Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 mb-6">
                    <div class="flex items-center justify-between mb-6">
                        <div>
                            <h2 class="text-xl font-bold text-white flex items-center">
                                <svg class="w-6 h-6 mr-2 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                </svg>
                                Migration Status
                            </h2>
                            <p class="text-sm text-slate-400 mt-1">Keep your database schema up to date</p>
                        </div>
                        
                        <?php if ($pendingCount > 0): ?>
                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold bg-yellow-500/20 text-yellow-300 border border-yellow-500/40 animate-pulse">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                            </svg>
                            <?php echo $pendingCount; ?> Pending
                        </span>
                        <?php else: ?>
                        <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-bold bg-green-500/20 text-green-300 border border-green-500/40">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Up to Date
                        </span>
                        <?php endif; ?>
                    </div>

                    <!-- Pending Migrations List -->
                    <?php if ($pendingCount > 0): ?>
                    <div class="bg-white/5 rounded-xl p-4 mb-6 border border-white/10">
                        <h3 class="text-sm font-semibold text-white mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Pending Migrations (<?php echo $pendingCount; ?>)
                        </h3>
                        <ul class="space-y-2">
                            <?php foreach ($pendingMigrations as $migration): ?>
                            <li class="flex items-center text-sm text-slate-300 bg-white/5 rounded-lg p-3 border border-white/5">
                                <svg class="w-4 h-4 mr-2 text-blue-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                <code class="font-mono text-xs"><?php echo htmlspecialchars($migration); ?></code>
                            </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php endif; ?>

                    <!-- Run Migration Button -->
                    <form method="POST" id="migration-form">
                        <?php if ($pendingCount > 0): ?>
                        <button type="submit" name="run_migration" id="run-migration-btn" 
                                class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-bold py-4 px-6 rounded-xl transition-all shadow-lg shadow-blue-500/20 hover:shadow-blue-500/40 flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Run Migrations Now
                        </button>
                        <?php else: ?>
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 mx-auto text-green-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <p class="text-lg font-semibold text-white">All migrations are up to date!</p>
                            <p class="text-sm text-slate-400 mt-2">Your database schema is current</p>
                        </div>
                        <?php endif; ?>
                    </form>
                </div>

                <!-- Migration Result -->
                <?php if ($migrationResult): ?>
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 mb-6">
                    <?php if ($migrationResult['success']): ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-lg font-semibold text-green-400 mb-2">Migration Successful!</h3>
                            <div class="bg-black/30 rounded-lg p-4 border border-green-500/20">
                                <pre class="text-xs text-green-300 font-mono whitespace-pre-wrap"><?php echo htmlspecialchars($migrationResult['output']); ?></pre>
                            </div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="flex items-start">
                        <div class="flex-shrink-0">
                            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="ml-3 flex-1">
                            <h3 class="text-lg font-semibold text-red-400 mb-2">Migration Failed</h3>
                            <div class="bg-black/30 rounded-lg p-4 border border-red-500/20">
                                <pre class="text-xs text-red-300 font-mono whitespace-pre-wrap"><?php echo htmlspecialchars($migrationResult['error']); ?></pre>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <!-- Info Card -->
                <div class="bg-blue-500/10 border border-blue-500/20 rounded-2xl p-6">
                    <div class="flex items-start">
                        <svg class="w-6 h-6 text-blue-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div class="ml-3">
                            <h3 class="text-sm font-semibold text-blue-300 mb-2">What are migrations?</h3>
                            <p class="text-xs text-slate-400 leading-relaxed">
                                Database migrations are version-controlled changes to your database schema. They help keep your database structure up to date with the latest application requirements. Running migrations is safe and will not delete any existing data.
                            </p>
                            <div class="mt-4 space-y-2">
                                <div class="flex items-center text-xs text-slate-400">
                                    <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Safe to run - won't delete data
                                </div>
                                <div class="flex items-center text-xs text-slate-400">
                                    <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Adds indexes for better performance
                                </div>
                                <div class="flex items-center text-xs text-slate-400">
                                    <svg class="w-4 h-4 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    Automatically tracks which migrations have run
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>
    </div>
</div>

<script>
// Add loading state to button
document.getElementById('migration-form')?.addEventListener('submit', function() {
    const btn = document.getElementById('run-migration-btn');
    if (btn) {
        btn.disabled = true;
        btn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Running Migrations...
        `;
    }
});
</script>

</body>
</html>
