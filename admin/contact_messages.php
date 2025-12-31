<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$per_page = 20;
$offset = ($page - 1) * $per_page;

// Filters
$status_filter = isset($_GET['status']) ? $_GET['status'] : '';
$search = isset($_GET['search']) ? trim($_GET['search']) : '';

// Build query
$where_clauses = [];
$params = [];

if ($status_filter && in_array($status_filter, ['new', 'read', 'replied', 'archived'])) {
    $where_clauses[] = "status = :status";
    $params[':status'] = $status_filter;
}

if ($search) {
    $where_clauses[] = "(name LIKE :search OR email LIKE :search OR subject LIKE :search OR message LIKE :search)";
    $params[':search'] = '%' . $search . '%';
}

$where_sql = !empty($where_clauses) ? 'WHERE ' . implode(' AND ', $where_clauses) : '';

// Get total count
$count_sql = "SELECT COUNT(*) FROM contact_messages $where_sql";
$count_stmt = $pdo->prepare($count_sql);
$count_stmt->execute($params);
$total_messages = $count_stmt->fetchColumn();
$total_pages = ceil($total_messages / $per_page);

// Get messages
$sql = "SELECT id, name, email, subject, status, created_at 
        FROM contact_messages 
        $where_sql 
        ORDER BY created_at DESC 
        LIMIT :limit OFFSET :offset";
$stmt = $pdo->prepare($sql);
foreach ($params as $key => $value) {
    $stmt->bindValue($key, $value);
}
$stmt->bindValue(':limit', $per_page, PDO::PARAM_INT);
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$messages = $stmt->fetchAll();

// Get stats
$stats = [
    'total' => $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn(),
    'new' => $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn(),
    'read' => $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'read'")->fetchColumn(),
    'replied' => $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'replied'")->fetchColumn(),
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Messages - Frequency Lab Admin</title>
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
        .scrollbar-hide::-webkit-scrollbar { display: none; }
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
                    <h1 class="text-3xl font-bold text-white font-exo">Contact Messages</h1>
                    <p class="text-slate-400 mt-1">View and manage inquiries.</p>
                </div>
                
                <!-- Simple Filter Group -->
                <form method="GET" class="flex gap-2 text-sm w-full sm:w-auto">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search..." 
                           class="px-3 py-2 border border-white/10 rounded-xl bg-black/20 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-1 focus:ring-blue-500 w-full sm:w-64 transition-all">
                    <select name="status" class="px-3 py-2 border border-white/10 rounded-xl bg-black/20 text-slate-200 focus:outline-none focus:ring-1 focus:ring-blue-500 transition-all cursor-pointer">
                        <option value="" class="bg-slate-900 text-slate-300">All Status</option>
                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?> class="bg-slate-900">New</option>
                        <option value="read" <?php echo $status_filter === 'read' ? 'selected' : ''; ?> class="bg-slate-900">Read</option>
                        <option value="replied" <?php echo $status_filter === 'replied' ? 'selected' : ''; ?> class="bg-slate-900">Replied</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600/20 text-blue-400 border border-blue-500/30 font-medium rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-lg shadow-blue-500/10">Filter</button>
                    <?php if($search || $status_filter): ?>
                        <a href="contact_messages.php" class="px-4 py-2 bg-white/5 text-slate-400 border border-white/10 rounded-xl hover:bg-white/10 transition-colors">Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Compact Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                <!-- Total -->
                <div class="bg-white/5 backdrop-blur-md rounded-xl border border-white/10 p-4 flex flex-col justify-between hover:border-slate-500/30 transition-colors shadow-lg">
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Total</p>
                    <p class="text-2xl font-bold text-white mt-2 font-exo"><?php echo $stats['total']; ?></p>
                </div>
                <!-- New -->
                <div class="bg-blue-500/5 backdrop-blur-md rounded-xl border border-blue-500/20 p-4 flex flex-col justify-between relative overflow-hidden shadow-[0_0_15px_rgba(59,130,246,0.1)] group">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                    <div class="flex justify-between items-start relative z-10">
                        <p class="text-xs font-medium text-blue-400 uppercase tracking-wider">New</p>
                        <?php if($stats['new'] > 0): ?>
                            <span class="flex h-2.5 w-2.5 relative">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-blue-500 shadow-[0_0_10px_rgba(59,130,246,0.6)]"></span>
                            </span>
                        <?php endif; ?>
                    </div>
                    <p class="text-2xl font-bold text-blue-100 mt-2 font-exo relative z-10"><?php echo $stats['new']; ?></p>
                </div>
                <!-- Replied -->
                <div class="bg-green-500/5 backdrop-blur-md rounded-xl border border-green-500/20 p-4 flex flex-col justify-between hover:border-green-500/30 transition-colors shadow-lg">
                    <p class="text-xs font-medium text-green-400 uppercase tracking-wider">Replied</p>
                    <p class="text-2xl font-bold text-white mt-2 font-exo"><?php echo $stats['replied']; ?></p>
                </div>
                <!-- Read -->
                <div class="bg-white/5 backdrop-blur-md rounded-xl border border-white/10 p-4 flex flex-col justify-between hover:border-slate-500/30 transition-colors shadow-lg">
                    <p class="text-xs font-medium text-slate-400 uppercase tracking-wider">Read</p>
                    <p class="text-2xl font-bold text-white mt-2 font-exo"><?php echo $stats['read']; ?></p>
                </div>
            </div>

            <!-- Compact Table -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
                <table class="min-w-full divide-y divide-white/5">
                    <thead class="bg-white/5">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Sender</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Subject</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Status</th>
                            <th class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Date</th>
                            <th class="px-6 py-4 text-right text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center text-slate-500">
                                    <div class="flex flex-col items-center">
                                        <div class="p-4 rounded-full bg-white/5 border border-white/5 mb-3">
                                            <i class="fas fa-inbox text-2xl opacity-50"></i>
                                        </div>
                                        <p>No messages found matching your criteria.</p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($messages as $msg): ?>
                                <tr class="hover:bg-white/5 transition-colors <?php echo $msg['status'] === 'new' ? 'bg-blue-500/5' : ''; ?>">
                                    <td class="px-6 py-4">
                                        <div class="font-semibold text-white"><?php echo htmlspecialchars($msg['name']); ?></div>
                                        <div class="text-xs text-slate-500"><?php echo htmlspecialchars($msg['email']); ?></div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-slate-300 max-w-xs truncate"><?php echo htmlspecialchars($msg['subject']); ?></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php
                                        $badge_class = match($msg['status']) {
                                            'new' => 'bg-blue-500/20 text-blue-300 border border-blue-500/30',
                                            'read' => 'bg-slate-500/20 text-slate-300 border border-slate-500/30',
                                            'replied' => 'bg-green-500/20 text-green-300 border border-green-500/30',
                                            'archived' => 'bg-orange-500/20 text-orange-300 border border-orange-500/30',
                                            default => 'bg-slate-500/20 text-slate-300 border border-slate-500/30'
                                        };
                                        ?>
                                        <span class="px-2.5 py-0.5 inline-flex text-xs leading-5 font-medium rounded-full <?php echo $badge_class; ?>">
                                            <?php echo ucfirst($msg['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-slate-400 text-xs font-mono">
                                        <?php echo date('M d, Y', strtotime($msg['created_at'])); ?>
                                        <span class="block text-slate-600"><?php echo date('H:i', strtotime($msg['created_at'])); ?></span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right font-medium">
                                        <a href="contact_message_view.php?id=<?php echo $msg['id']; ?>" 
                                           class="text-blue-400 hover:text-blue-300 px-3 py-1 hover:bg-blue-500/10 rounded-lg transition-colors inline-block">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination (Compact) -->
                <?php if ($total_pages > 1): ?>
                    <div class="px-6 py-4 flex items-center justify-between border-t border-white/5 bg-white/5">
                        <div class="text-xs text-slate-500">
                            Page <span class="text-white font-medium"><?php echo $page; ?></span> of <span class="text-white font-medium"><?php echo $total_pages; ?></span>
                        </div>
                        <div class="flex gap-2">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>&status=<?php echo $status_filter; ?>&search=<?php echo urlencode($search); ?>" 
                                   class="px-3 py-1.5 border border-white/10 rounded-lg text-xs font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-colors">Prev</a>
                            <?php endif; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>&status=<?php echo $status_filter; ?>&search=<?php echo urlencode($search); ?>" 
                                   class="px-3 py-1.5 border border-white/10 rounded-lg text-xs font-medium text-slate-300 hover:bg-white/10 hover:text-white transition-colors">Next</a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
            
        </main>
    </div>
</div>
<script src="../js/main.js"></script>
</body>
</html>
