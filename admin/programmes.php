<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Handle Delete
if (isset($_POST['delete_id'])) {
    if ($auth->checkRole('admin')) {
        $id = $_POST['delete_id'];
        
        // Prevent deleting the default General Moments programme if we want to enforce it? 
        // For now allow delete, but maybe warn.
        
        $deleteStmt = $pdo->prepare("DELETE FROM programmes WHERE id = ?");
        $deleteStmt->execute([$id]);
        $success_msg = "Programme deleted successfully.";
    } else {
        $error_msg = "You do not have permission to delete.";
    }
}

// Fetch Programmes
$stmt = $pdo->query("SELECT * FROM programmes ORDER BY start_date DESC, created_at DESC");
$programmes = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getTypeBadgeClass($type) {
    switch ($type) {
        case 'workshop': return 'bg-cyan-100 text-cyan-800 border-cyan-200';
        case 'event': return 'bg-purple-100 text-purple-800 border-purple-200';
        case 'competition': return 'bg-orange-100 text-orange-800 border-orange-200';
        case 'community': return 'bg-green-100 text-green-800 border-green-200';
        default: return 'bg-gray-100 text-gray-800 border-gray-200';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programmes - Frequency Lab Admin</title>
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
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Programmes</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage workshops, events, and competitions.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Add Button -->
                    <a href="programme_form.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Add Programme
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (isset($success_msg)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                    <p class="text-sm text-green-700 px-3 py-1"><?php echo htmlspecialchars($success_msg); ?></p>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_msg)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                    <p class="text-sm text-red-700 px-3 py-1"><?php echo htmlspecialchars($error_msg); ?></p>
                </div>
            <?php endif; ?>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Programme Title</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Type</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Description</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($programmes as $prog): ?>
                            <tr class="hover:bg-slate-50/80 transition-colors duration-150 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars($prog['title']); ?></div>
                                </td>
                                 <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo getTypeBadgeClass($prog['type']); ?>">
                                        <?php echo ucfirst($prog['type']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo $prog['start_date'] ? date('M j, Y', strtotime($prog['start_date'])) : 'N/A'; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-500 line-clamp-1 max-w-xs"><?php echo htmlspecialchars($prog['description']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="gallery.php?programme_id=<?php echo $prog['id']; ?>" class="text-blue-500 hover:text-blue-700 transition-colors p-1 rounded-full hover:bg-blue-50 flex items-center gap-1 text-xs" title="View Gallery">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            Gallery
                                        </a>
                                        <a href="programme_form.php?id=<?php echo $prog['id']; ?>" class="text-slate-400 hover:text-blue-600 transition-colors p-1 rounded-full hover:bg-blue-50" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <?php if ($auth->checkRole('admin')): ?>
                                        <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this programme? This will likely break any linked gallery images.');">
                                            <input type="hidden" name="delete_id" value="<?php echo $prog['id']; ?>">
                                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-1 rounded-full hover:bg-red-50" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($programmes)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-slate-100 rounded-full p-4 mb-4">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-slate-900">No programmes found</h3>
                                            <p class="text-slate-500 mt-1 mb-6 max-w-sm">Create programmes to categorize your gallery.</p>
                                            <a href="programme_form.php" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                Add Programme
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
