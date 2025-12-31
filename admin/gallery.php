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
        $error_msg = "You do not have permission to delete.";
    }
}

// Fetch Images
$search = $_GET['search'] ?? '';
$programme_filter = $_GET['programme_id'] ?? '';
$search_query = "";
$params = [];

$where_clauses = [];

if (!empty($search)) {
    $where_clauses[] = "(g.title LIKE ? OR g.description LIKE ? OR p.title LIKE ?)";
    $params[] = "%$search%";
    $params[] = "%$search%";
    $params[] = "%$search%";
}

if (!empty($programme_filter)) {
    $where_clauses[] = "g.programme_id = ?";
    $params[] = $programme_filter;
}

if (!empty($where_clauses)) {
    $search_query = "WHERE " . implode(' AND ', $where_clauses);
}

$stmt = $pdo->prepare("
    SELECT g.*, p.title as programme_title, p.type as programme_type 
    FROM gallery_images g
    LEFT JOIN programmes p ON g.programme_id = p.id 
    $search_query 
    ORDER BY g.upload_date DESC
");
$stmt->execute($params);
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);

function getCategoryBadgeClass($type) {
    switch ($type) {
        case 'workshop': return 'bg-cyan-500/20 text-cyan-300 border-cyan-500/30';
        case 'event': return 'bg-purple-500/20 text-purple-300 border-purple-500/30';
        case 'competition': return 'bg-orange-500/20 text-orange-300 border-orange-500/30';
        case 'community': return 'bg-emerald-500/20 text-emerald-300 border-emerald-500/30';
        default: return 'bg-slate-500/20 text-slate-300 border-slate-500/30';
    }
}

// Fetch All Programmes for Filter
$allProgrammes = $pdo->query("SELECT id, title FROM programmes ORDER BY title ASC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery - Frequency Lab Admin</title>
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
                    },
                    animation: {
                        'blob': 'blob 7s infinite',
                    },
                    keyframes: {
                        blob: {
                            '0%': { transform: 'translate(0px, 0px) scale(1)' },
                            '33%': { transform: 'translate(30px, -50px) scale(1.1)' },
                            '66%': { transform: 'translate(-20px, 20px) scale(0.9)' },
                            '100%': { transform: 'translate(0px, 0px) scale(1)' },
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
        <div class="absolute top-[10%] left-[20%] w-96 h-96 bg-purple-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute bottom-[20%] right-[10%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <?php include 'includes/sidebar.php'; ?>

    <div class="flex-1 flex flex-col overflow-hidden relative z-10">
        <?php include 'includes/mobile_header.php'; ?>

        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 md:p-6 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
            <!-- Header Section -->
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-white font-exo">Gallery</h1>
                    <p class="text-slate-400 mt-1">Manage your gallery photos and events.</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Manage Programmes Button -->
                    <a href="programmes.php" class="inline-flex items-center justify-center px-4 py-2 border border-white/10 shadow-lg shadow-black/20 text-sm font-medium rounded-xl text-slate-300 bg-white/5 hover:bg-white/10 hover:text-white backdrop-blur-sm transition-all mr-2 group">
                        <svg class="w-5 h-5 mr-2 -ml-1 text-slate-400 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Manage Programmes
                    </a>

                    <!-- Upload Button -->
                    <a href="gallery_form.php" class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl shadow-lg shadow-blue-500/20 text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:scale-[1.02]">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Upload Photo
                    </a>
                </div>
            </div>

            <!-- Alerts -->
            <?php if (isset($success_msg)): ?>
                <div class="bg-green-500/10 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm backdrop-blur-sm">
                    <p class="text-sm text-green-400 px-3 py-1 font-medium"><?php echo htmlspecialchars($success_msg); ?></p>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_msg)): ?>
                <div class="bg-red-500/10 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm backdrop-blur-sm">
                    <p class="text-sm text-red-400 px-3 py-1 font-medium"><?php echo htmlspecialchars($error_msg); ?></p>
                </div>
            <?php endif; ?>

            <!-- Search & Filter Bar -->
            <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-sm border border-white/10 p-4 mb-6">
                <form method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <!-- Search -->
                    <div class="relative w-full md:w-96">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               class="block w-full pl-10 pr-3 py-2 border border-white/10 rounded-xl leading-5 bg-black/20 text-slate-200 placeholder-slate-500 focus:outline-none focus:placeholder-slate-400 focus:ring-1 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                               placeholder="Search images...">
                    </div>

                    <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
                        <!-- Filter -->
                        <div class="relative w-full sm:w-64">
                            <select name="programme_id" onchange="this.form.submit()" class="block w-full pl-3 pr-10 py-2.5 text-base border-white/10 bg-slate-900/50 text-slate-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-xl">
                                <option value="">All Programmes</option>
                                <?php foreach ($allProgrammes as $p): ?>
                                    <option value="<?php echo $p['id']; ?>" class="bg-slate-900" <?php echo $programme_filter == $p['id'] ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($p['title']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <!-- Filter Button -->
                        <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent shadow-md text-sm font-medium rounded-xl text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                            Filter
                        </button>
                    </div>
                </form>
            </div>

            <!-- Gallery Grid -->
            <?php if (empty($images)): ?>
                <div class="bg-white/5 backdrop-blur-md rounded-xl shadow-sm border border-white/10 p-16 text-center">
                    <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-slate-800/50 mb-6">
                        <svg class="h-10 w-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">No images found</h3>
                    <p class="text-slate-400 mb-8 max-w-sm mx-auto">Get started by uploading some photos to your gallery.</p>
                    <a href="gallery_form.php" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl shadow-lg shadow-blue-500/20 text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                        Upload First Photo
                    </a>
                </div>
            <?php else: ?>
                <!-- Compact Grid Layout -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-4">
                    <?php foreach ($images as $img): ?>
                        <div class="group bg-white/5 backdrop-blur-sm rounded-xl shadow-lg border border-white/10 overflow-hidden hover:shadow-blue-500/10 hover:border-blue-500/30 transition-all duration-300 flex flex-col h-full relative">
                            <!-- Image Area -->
                            <div class="relative aspect-[4/3] overflow-hidden bg-slate-900 border-b border-white/5">
                                <?php if (!empty($img['image_path'])): ?>
                                    <img src="../<?php echo htmlspecialchars($img['image_path']); ?>" 
                                         alt="<?php echo htmlspecialchars($img['title']); ?>" 
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-700 ease-in-out">
                                    <!-- Dark Overlay on Hover -->
                                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center text-slate-600 bg-slate-800">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    </div>
                                <?php endif; ?>
                                
                                <!-- Category Badge -->
                                <div class="absolute top-2 right-2 pointer-events-none">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold backdrop-blur-md shadow-sm border border-white/10 <?php echo getCategoryBadgeClass($img['programme_type'] ?? ''); ?>">
                                        <?php echo strtoupper($img['programme_type'] ?? 'GENERAL'); ?>
                                    </span>
                                </div>

                                <!-- Action Buttons Overlay (Visible on Hover in Compact View) -->
                                <div class="absolute bottom-2 right-2 flex space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-300 transform translate-y-2 group-hover:translate-y-0">
                                    <a href="gallery_form.php?id=<?php echo $img['id']; ?>" class="bg-cyan-500 text-white p-1.5 rounded-lg shadow-lg hover:bg-cyan-400 transition-colors" title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    
                                    <?php if ($auth->checkRole('admin')): ?>
                                    <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                        <input type="hidden" name="delete_id" value="<?php echo $img['id']; ?>">
                                        <button type="submit" class="bg-red-500 text-white p-1.5 rounded-lg shadow-lg hover:bg-red-400 transition-colors" title="Delete">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    <?php endif; ?>
                                </div>
                            </div>
                            
                            <!-- Compact Content -->
                            <div class="p-3 flex-1 flex flex-col justify-between">
                                <div>
                                    <h3 class="text-sm font-bold text-white group-hover:text-blue-400 transition-colors truncate mb-0.5" title="<?php echo htmlspecialchars($img['title']); ?>">
                                        <?php echo htmlspecialchars($img['title']); ?>
                                    </h3>
                                    <?php if (!empty($img['programme_title'])): ?>
                                        <p class="text-[10px] text-slate-500 font-medium truncate uppercase tracking-wide">
                                            <?php echo htmlspecialchars($img['programme_title']); ?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                                <div class="mt-2 pt-2 border-t border-white/5 flex justify-between items-center">
                                     <span class="text-[10px] text-slate-500">
                                        <?php echo date('M d, Y', strtotime($img['upload_date'])); ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </main>
    </div>
</div>
<script src="js/admin.js"></script>
</body>
</html>
