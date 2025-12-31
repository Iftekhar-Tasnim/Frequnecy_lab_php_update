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
                    <h1 class="text-3xl font-bold text-white font-exo">Publications</h1>
                    <p class="text-slate-400 mt-1">Manage research papers, journals, and profiles</p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                     <a href="publication_form.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-lg shadow-blue-500/20 text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:scale-[1.02]">
                        <i class="fas fa-plus mr-2"></i> Add New
                    </a>
                </div>
            </div>

            <!-- Search & Filter -->
            <div class="bg-white/5 backdrop-blur-md rounded-xl p-4 mb-6 border border-white/10 shadow-lg">
                <form action="" method="GET" class="flex gap-4">
                    <div class="flex-1 relative">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-slate-500"></i>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               placeholder="Search publications..." 
                               class="w-full pl-10 pr-4 py-2.5 border border-white/10 rounded-xl bg-black/20 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-slate-800 text-white font-medium rounded-xl hover:bg-slate-700 border border-white/10 transition-colors shadow-lg">Search</button>
                </form>
            </div>

            <!-- Publications List -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 shadow-xl overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/5">
                        <thead class="bg-white/5">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider w-20 font-exo">Image</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Title</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Type</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Date</th>
                                <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Featured</th>
                                <th class="px-6 py-4 text-right text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-white/5">
                            <?php if (count($publications) > 0): ?>
                                <?php foreach($publications as $row): ?>
                                    <tr class="hover:bg-white/5 transition-colors group">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if($row['image_url']): ?>
                                                <div class="h-12 w-12 flex-shrink-0">
                                                    <img class="h-12 w-12 rounded-lg object-cover border border-white/10 group-hover:border-blue-500/30 transition-colors" src="<?php echo str_starts_with($row['image_url'], '../') ? $row['image_url'] : '../' . $row['image_url']; ?>" alt="">
                                                </div>
                                            <?php else: ?>
                                                <div class="h-12 w-12 flex-shrink-0 rounded-lg bg-white/5 border border-white/10 flex items-center justify-center text-slate-500">
                                                    <i class="fas fa-image"></i>
                                                </div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-white group-hover:text-blue-400 transition-colors line-clamp-1" title="<?php echo htmlspecialchars($row['title']); ?>">
                                                <?php echo htmlspecialchars($row['title']); ?>
                                            </div>
                                            <?php if($row['publisher']): ?>
                                                <div class="text-xs text-slate-500 mt-1"><?php echo htmlspecialchars($row['publisher']); ?></div>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium border
                                                <?php 
                                                    switch($row['type']) {
                                                        case 'profile': echo 'bg-purple-500/20 text-purple-300 border-purple-500/30'; break;
                                                        case 'journal': echo 'bg-blue-500/20 text-blue-300 border-blue-500/30'; break;
                                                        case 'article': echo 'bg-sky-500/20 text-sky-300 border-sky-500/30'; break;
                                                        default: echo 'bg-slate-500/20 text-slate-300 border-slate-500/30';
                                                    }
                                                ?>">
                                                <?php echo ucfirst($row['type']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-400 font-mono">
                                            <?php echo $row['publication_date'] ? date('M Y', strtotime($row['publication_date'])) : '-'; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <?php if ($row['is_featured']): ?>
                                                <span class="inline-flex items-center justify-center w-8 h-8 bg-amber-500/20 rounded-full text-amber-400 border border-amber-500/20 shadow-[0_0_10px_rgba(245,158,11,0.2)]">
                                                    <i class="fas fa-star text-xs"></i>
                                                </span>
                                            <?php else: ?>
                                                <span class="text-slate-600">-</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            <div class="flex items-center justify-end gap-2 text-white">
                                                <a href="<?php echo htmlspecialchars($row['link']); ?>" target="_blank" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-blue-500/20 text-blue-400 hover:bg-blue-500 hover:text-white border border-blue-500/30 transition-all hover:shadow-[0_0_15px_rgba(59,130,246,0.5)]" title="View Link">
                                                    <i class="fas fa-external-link-alt text-xs"></i>
                                                </a>
                                                <a href="publication_form.php?id=<?php echo $row['id']; ?>" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-cyan-500/20 text-cyan-400 hover:bg-cyan-500 hover:text-white border border-cyan-500/30 transition-all hover:shadow-[0_0_15px_rgba(6,182,212,0.5)]" title="Edit">
                                                    <i class="fas fa-pen text-xs"></i>
                                                </a>
                                                <a href="?delete=<?php echo $row['id']; ?>" onclick="return confirm('Are you sure?')" class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-red-500/20 text-red-400 hover:bg-red-500 hover:text-white border border-red-500/30 transition-all hover:shadow-[0_0_15px_rgba(239,68,68,0.5)]" title="Delete">
                                                    <i class="fas fa-trash-alt text-xs"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="px-6 py-24 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/5 border border-white/10 mb-6 shadow-inner">
                                                <i class="fas fa-book text-slate-500 text-3xl"></i>
                                            </div>
                                            <h3 class="text-xl font-medium text-white mb-2">No publications found</h3>
                                            <p class="text-slate-400 text-sm mb-8">Get started by creating a new publication.</p>
                                            <a href="publication_form.php" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-cyan-600 text-white text-sm font-medium rounded-xl hover:from-blue-500 hover:to-cyan-500 shadow-lg shadow-blue-500/20 transition-all">
                                                <i class="fas fa-plus mr-2"></i> Add Publication
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
