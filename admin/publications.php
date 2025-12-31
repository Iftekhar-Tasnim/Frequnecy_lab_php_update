<?php
require_once '../includes/auth.php';
require_once '../config/db.php';

// Auth Check (Assuming auth.php handles session start)
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Handle Delete
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $stmt = $pdo->prepare("DELETE FROM publications WHERE id = ?");
    $stmt->execute([$id]);
    echo "<script>window.location.href='publications.php';</script>";
}

// Fetch Publications
$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM publications WHERE title LIKE ? OR type LIKE ? ORDER BY created_at DESC";
$stmt = $pdo->prepare($sql);
$searchTerm = "%$search%";
$stmt->execute([$searchTerm, $searchTerm]);
$publications = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Publications - Frequency Lab Admin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">
<div class="flex h-screen overflow-hidden">
    
    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-8 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Publications</h1>
                    <p class="text-sm text-slate-500 mt-1">Manage research papers, journals, and profiles</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                     <a href="publication_form.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all hover:shadow-md">
                        <i class="fas fa-plus mr-2"></i> Add New
                    </a>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="bg-white rounded-xl p-4 mb-6 border border-gray-200 shadow-sm">
                <form action="" method="GET" class="flex gap-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               placeholder="Search publications..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white font-medium rounded-lg hover:bg-slate-700 transition-colors">Search</button>
                </form>
            </div>

            <!-- Publications List -->
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead class="bg-slate-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider w-16">Image</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase tracking-wider">Featured</th>
                                <th class="px-6 py-4 text-right text-xs font-semibold text-slate-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            <?php if (count($publications) > 0): ?>
                                <?php foreach($publications as $row): ?>
                                    <tr class="hover:bg-slate-50/80 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if($row['image_url']): ?>
                                                <div class="h-10 w-10 flex-shrink-0">
                                                    <img class="h-10 w-10 rounded-lg object-cover border border-slate-200" src="<?php echo str_starts_with($row['image_url'], '../') ? $row['image_url'] : '../' . $row['image_url']; ?>" alt="">
                                                </div>
                                            <?php else: ?>
                                                <div class="h-10 w-10 flex-shrink-0 rounded-lg bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-slate-900 line-clamp-1" title="<?php echo htmlspecialchars($row['title']); ?>">
                                                <?php echo htmlspecialchars($row['title']); ?>
                                            </div>
                                            <?php if($row['publisher']): ?>
                                                <div class="text-xs text-slate-500 mt-0.5"><?php echo htmlspecialchars($row['publisher']); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium 
                                                <?php 
                                                    switch($row['type']) {
                                                        case 'profile': echo 'bg-purple-50 text-purple-700 border border-purple-100'; break;
                                                        case 'journal': echo 'bg-blue-50 text-blue-700 border border-blue-100'; break;
                                                        case 'article': echo 'bg-sky-50 text-sky-700 border border-sky-100'; break;
                                                        default: echo 'bg-slate-50 text-slate-600 border border-slate-100';
                                                    }
                                                ?>">
                                                <?php echo ucfirst($row['type']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-500 font-mono">
                                            <?php echo $row['publication_date'] ? date('M Y', strtotime($row['publication_date'])) : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($row['is_featured']): ?>
                                                <span class="inline-flex items-center justify-center w-6 h-6 bg-amber-50 rounded-full text-amber-500">
                                                    <i class="fas fa-star text-xs"></i>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-slate-300">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2">
                                                <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-blue-600 text-white hover:bg-blue-700 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md" title="View Link">
                                                    <i class="fas fa-external-link-alt text-sm"></i>
                                                </a>
                                                <a href="publication_form.php?id=<?php echo $row['id']; ?>" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-amber-500 text-white hover:bg-amber-600 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md" title="Edit">
                                                    <i class="fas fa-pen text-sm"></i>
                                                </a>
                                                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="inline-flex items-center justify-center w-9 h-9 rounded-lg bg-red-500 text-white hover:bg-red-600 hover:shadow-lg hover:-translate-y-0.5 transition-all shadow-md" title="Delete">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-16 text-center">
                                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                                            <i class="fas fa-book text-slate-300 text-2xl"></i>
                                        </div>
                                        <h3 class="text-slate-900 font-medium mb-1">No publications found</h3>
                                        <p class="text-slate-500 text-sm mb-4">Get started by creating a new publication.</p>
                                        <a href="publication_form.php" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-colors">
                                            <i class="fas fa-plus mr-2"></i> Add Publication
                                        </a>
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
