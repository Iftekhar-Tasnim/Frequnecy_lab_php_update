<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Handle Delete
if (isset($_POST['delete_id'])) {
    if ($auth->checkRole('admin')) {
        $id = $_POST['delete_id'];
        
        // Get image path to delete file
        $stmt = $pdo->prepare("SELECT image_path FROM gallery_images WHERE id = ?");
        $stmt->execute([$id]);
        $image = $stmt->fetch();
        
        if ($image && !empty($image['image_path'])) {
            $file_path = '../' . $image['image_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        $deleteStmt = $pdo->prepare("DELETE FROM gallery_images WHERE id = ?");
        $deleteStmt->execute([$id]);
        $success_msg = "Image deleted successfully.";
    } else {
        // header('Location: 403.php'); // Optional: redirect to 403
        $error_msg = "You do not have permission to delete.";
    }
}

// Fetch Images
$search = $_GET['search'] ?? '';
$category_filter = $_GET['category'] ?? '';
$search_query = "";
$params = [];

$where_clauses = [];

if (!empty($search)) {
    $where_clauses[] = "(title LIKE ? OR description LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($category_filter)) {
    $where_clauses[] = "event_category = ?";
    $params[] = $category_filter;
}

if (!empty($where_clauses)) {
    $search_query = "WHERE " . implode(' AND ', $where_clauses);
}

$stmt = $pdo->prepare("SELECT * FROM gallery_images $search_query ORDER BY upload_date DESC");
$stmt->execute($params);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getCategoryBadgeClass($cat) {
    switch ($cat) {
        case 'workshops': return 'bg-cyan-100 text-cyan-800 border-cyan-200';
        case 'events': return 'bg-purple-100 text-purple-800 border-purple-200';
        case 'competitions': return 'bg-orange-100 text-orange-800 border-orange-200';
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
    <title>Gallery - Frequency Lab Admin</title>
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
                    <h1 class="text-2xl font-bold text-slate-900">Gallery</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage your gallery photos and events.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Category Filter -->
                    <form method="GET" class="flex gap-2">
                        <select name="category" onchange="this.form.submit()" class="block w-full sm:w-40 py-2.5 px-3 border border-gray-300 bg-white rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            <option value="">All Categories</option>
                            <option value="workshops" <?php echo $category_filter == 'workshops' ? 'selected' : ''; ?>>Workshops</option>
                            <option value="events" <?php echo $category_filter == 'events' ? 'selected' : ''; ?>>Events</option>
                            <option value="competitions" <?php echo $category_filter == 'competitions' ? 'selected' : ''; ?>>Competitions</option>
                            <option value="community" <?php echo $category_filter == 'community' ? 'selected' : ''; ?>>Community</option>
                        </select>
                        <!-- Preserve search if exists -->
                         <input type="hidden" name="search" value="<?php echo htmlspecialchars($search); ?>">
                    </form>


                    <!-- Manage Programmes Button -->
                    <a href="programmes.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50 focus:outline-none transition-all mr-2">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Manage Programmes
                    </a>

                    <!-- Add Button -->
                    <a href="gallery_form.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Upload Photo
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (isset($success_msg)): ?>
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0"><svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg></div>
                        <div class="ml-3"><p class="text-sm text-green-700"><?php echo htmlspecialchars($success_msg); ?></p></div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_msg)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
                    <div class="flex">
                        <div class="flex-shrink-0"><svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg></div>
                        <div class="ml-3"><p class="text-sm text-red-700"><?php echo htmlspecialchars($error_msg); ?></p></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Table Card -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-slate-50">
                            <tr>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Image</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Details</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Category</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Date</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php foreach ($images as $img): ?>
                            <tr class="hover:bg-slate-50/80 transition-colors duration-150 group">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex-shrink-0 h-16 w-24 relative rounded-lg overflow-hidden border border-gray-200">
                                        <?php if (!empty($img['image_path'])): ?>
                                            <img class="h-full w-full object-cover" src="../<?php echo htmlspecialchars($img['image_path']); ?>" alt="">
                                        <?php else: ?>
                                            <div class="h-full w-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-semibold text-gray-900 group-hover:text-blue-600 transition-colors"><?php echo htmlspecialchars($img['title']); ?></div>
                                    <div class="text-xs text-gray-500 mt-1 line-clamp-1 max-w-xs"><?php echo htmlspecialchars($img['description']); ?></div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo getCategoryBadgeClass($img['event_category']); ?>">
                                        <?php echo ucfirst($img['event_category']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo date('M j, Y', strtotime($img['upload_date'])); ?>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="gallery_form.php?id=<?php echo $img['id']; ?>" class="text-slate-400 hover:text-blue-600 transition-colors p-1 rounded-full hover:bg-blue-50" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <?php if ($auth->checkRole('admin')): ?>
                                        <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $img['id']; ?>">
                                            <button type="submit" class="text-slate-400 hover:text-red-600 transition-colors p-1 rounded-full hover:bg-red-50" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($images)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-slate-100 rounded-full p-4 mb-4">
                                                <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-slate-900">No images found</h3>
                                            <p class="text-slate-500 mt-1 mb-6 max-w-sm">Start building your gallery by uploading some photos.</p>
                                            <a href="gallery_form.php" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg shadow-sm transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                Upload Photo
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
