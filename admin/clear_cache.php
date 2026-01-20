<?php
require_once '../includes/auth.php';
require_once '../includes/CacheManager.php';

$auth->requireLogin();
$auth->checkRole('admin'); // Only admins can clear cache

// Initialize cache
$cache = new CacheManager();

$success_msg = '';
$error_msg = '';

// Handle cache clearing
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    
    try {
        switch ($action) {
            case 'clear_all':
                $count = $cache->clearAll();
                $success_msg = "Successfully cleared all cache ($count files deleted).";
                break;
                
            case 'clear_gallery':
                $count = $cache->clear('gallery_*');
                $success_msg = "Successfully cleared gallery cache ($count files deleted).";
                break;
                
            case 'clear_expired':
                $count = $cache->cleanExpired();
                $success_msg = "Successfully cleaned expired cache ($count files deleted).";
                break;
                
            default:
                $error_msg = "Invalid action.";
        }
    } catch (Exception $e) {
        $error_msg = "Error: " . $e->getMessage();
    }
}

// Get cache statistics
$stats = $cache->getStats();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cache Management - Frequency Lab Admin</title>
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
            <div class="max-w-4xl mx-auto">
                <!-- Page Header -->
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-8 gap-4">
                    <div>
                        <h1 class="text-2xl font-bold text-slate-900">Cache Management</h1>
                        <p class="text-sm text-slate-500 mt-1">
                            Manage server-side cache to improve performance
                        </p>
                    </div>
                    <a href="settings.php" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-300 px-4 py-2 rounded-lg hover:bg-slate-50 transition-colors shadow-sm">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        Back to Settings
                    </a>
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

                <!-- Cache Statistics -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 mb-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Cache Statistics</h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-blue-50 rounded-lg p-4 border border-blue-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-blue-600 uppercase tracking-wide">Total Files</p>
                                    <p class="text-3xl font-bold text-blue-900 mt-1"><?php echo $stats['total_files']; ?></p>
                                </div>
                                <div class="bg-blue-200 rounded-full p-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-purple-50 rounded-lg p-4 border border-purple-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-purple-600 uppercase tracking-wide">Total Size</p>
                                    <p class="text-3xl font-bold text-purple-900 mt-1"><?php echo $stats['total_size_formatted']; ?></p>
                                </div>
                                <div class="bg-purple-200 rounded-full p-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4"/></svg>
                                </div>
                            </div>
                        </div>

                        <div class="bg-orange-50 rounded-lg p-4 border border-orange-200">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-sm font-medium text-orange-600 uppercase tracking-wide">Expired Files</p>
                                    <p class="text-3xl font-bold text-orange-900 mt-1"><?php echo $stats['expired_files']; ?></p>
                                </div>
                                <div class="bg-orange-200 rounded-full p-3">
                                    <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Cache Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4 border-b pb-2">Cache Actions</h2>
                    
                    <div class="space-y-4">
                        <!-- Clear All Cache -->
                        <div class="flex items-start justify-between p-4 bg-red-50 rounded-lg border border-red-200">
                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-gray-900">Clear All Cache</h3>
                                <p class="text-sm text-gray-600 mt-1">Remove all cached data. Use this if you're experiencing issues or after major updates.</p>
                            </div>
                            <form method="POST" class="ml-4" onsubmit="return confirm('Are you sure you want to clear ALL cache?');">
                                <input type="hidden" name="action" value="clear_all">
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 transition-all font-medium text-sm">
                                    Clear All
                                </button>
                            </form>
                        </div>

                        <!-- Clear Gallery Cache -->
                        <div class="flex items-start justify-between p-4 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-gray-900">Clear Gallery Cache</h3>
                                <p class="text-sm text-gray-600 mt-1">Clear only gallery-related cache. Use after uploading or modifying gallery images.</p>
                            </div>
                            <form method="POST" class="ml-4">
                                <input type="hidden" name="action" value="clear_gallery">
                                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all font-medium text-sm">
                                    Clear Gallery
                                </button>
                            </form>
                        </div>

                        <!-- Clean Expired Cache -->
                        <div class="flex items-start justify-between p-4 bg-green-50 rounded-lg border border-green-200">
                            <div class="flex-1">
                                <h3 class="text-base font-semibold text-gray-900">Clean Expired Cache</h3>
                                <p class="text-sm text-gray-600 mt-1">Remove only expired cache files. This is done automatically but you can run it manually.</p>
                            </div>
                            <form method="POST" class="ml-4">
                                <input type="hidden" name="action" value="clear_expired">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 transition-all font-medium text-sm">
                                    Clean Expired
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- Information -->
                <div class="mt-6 bg-blue-50 border-l-4 border-blue-500 p-4 rounded-r-lg">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-blue-800">About Caching</h3>
                            <div class="mt-2 text-sm text-blue-700">
                                <p>Caching improves website performance by storing frequently accessed data. Cache is automatically cleared when you make changes to gallery images or other content.</p>
                                <ul class="list-disc list-inside mt-2 space-y-1">
                                    <li>Gallery cache: 1 hour expiration</li>
                                    <li>Cache is automatically invalidated on content updates</li>
                                    <li>Expired cache is cleaned up automatically</li>
                                </ul>
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
