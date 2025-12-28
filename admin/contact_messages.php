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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-50 min-h-screen">

<div class="flex h-screen overflow-hidden">
    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden">
        <?php include 'includes/mobile_header.php'; ?>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-slate-50 p-4 md:p-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Contact Messages</h1>
                    <p class="text-sm text-slate-500 mt-1">View and manage inquiries.</p>
                </div>
                
                <!-- Simple Filter Group -->
                <form method="GET" class="flex gap-2 text-sm">
                    <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                           placeholder="Search..." 
                           class="px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 focus:border-blue-500 w-40 sm:w-64">
                    <select name="status" class="px-3 py-1.5 border border-gray-300 rounded-lg focus:ring-1 focus:ring-blue-500 bg-white">
                        <option value="">All</option>
                        <option value="new" <?php echo $status_filter === 'new' ? 'selected' : ''; ?>>New</option>
                        <option value="read" <?php echo $status_filter === 'read' ? 'selected' : ''; ?>>Read</option>
                        <option value="replied" <?php echo $status_filter === 'replied' ? 'selected' : ''; ?>>Replied</option>
                    </select>
                    <button type="submit" class="px-3 py-1.5 bg-slate-800 text-white rounded-lg hover:bg-slate-700">Filter</button>
                    <?php if($search || $status_filter): ?>
                        <a href="contact_messages.php" class="px-3 py-1.5 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300">Reset</a>
                    <?php endif; ?>
                </form>
            </div>

            <!-- Compact Stats -->
            <div class="grid grid-cols-4 gap-4 mb-6">
                <!-- Total -->
                <div class="bg-white rounded-lg border border-gray-200 p-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Total</p>
                        <p class="text-lg font-bold text-gray-800"><?php echo $stats['total']; ?></p>
                    </div>
                </div>
                <!-- New -->
                <div class="bg-white rounded-lg border border-blue-200 p-3 flex items-center justify-between shadow-sm">
                    <div>
                        <p class="text-xs font-medium text-blue-600 uppercase">New</p>
                        <p class="text-lg font-bold text-blue-700"><?php echo $stats['new']; ?></p>
                    </div>
                    <?php if($stats['new'] > 0): ?>
                        <span class="flex h-2 w-2 relative">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                        </span>
                    <?php endif; ?>
                </div>
                <!-- Replied -->
                <div class="bg-white rounded-lg border border-gray-200 p-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-green-600 uppercase">Replied</p>
                        <p class="text-lg font-bold text-green-700"><?php echo $stats['replied']; ?></p>
                    </div>
                </div>
                <!-- Archived --> <!-- Using Read stat as Archived just to allow 4 grid fit if user wants, but keeping Read logic -->
                <div class="bg-white rounded-lg border border-gray-200 p-3 flex items-center justify-between">
                    <div>
                        <p class="text-xs font-medium text-gray-500 uppercase">Read</p>
                        <p class="text-lg font-bold text-gray-800"><?php echo $stats['read']; ?></p>
                    </div>
                </div>
            </div>

            <!-- Compact Table -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Sender</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Subject</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Status</th>
                            <th class="px-4 py-3 text-left font-semibold text-gray-600">Date</th>
                            <th class="px-4 py-3 text-right font-semibold text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php if (empty($messages)): ?>
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-500">
                                    No messages found.
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($messages as $msg): ?>
                                <tr class="hover:bg-slate-50 transition-colors <?php echo $msg['status'] === 'new' ? 'bg-blue-50/30' : ''; ?>">
                                    <td class="px-4 py-3">
                                        <div class="font-medium text-gray-900"><?php echo htmlspecialchars($msg['name']); ?></div>
                                        <div class="text-xs text-gray-500"><?php echo htmlspecialchars($msg['email']); ?></div>
                                    </td>
                                    <td class="px-4 py-3">
                                        <div class="text-gray-900 max-w-xs truncate"><?php echo htmlspecialchars($msg['subject']); ?></div>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap">
                                        <?php
                                        $badge_class = match($msg['status']) {
                                            'new' => 'bg-blue-100 text-blue-800',
                                            'read' => 'bg-gray-100 text-gray-700',
                                            'replied' => 'bg-green-100 text-green-800',
                                            'archived' => 'bg-orange-100 text-orange-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                        ?>
                                        <span class="px-2 py-0.5 inline-flex text-xs leading-5 font-medium rounded-md <?php echo $badge_class; ?>">
                                            <?php echo ucfirst($msg['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-gray-500 text-xs">
                                        <?php echo date('M d, Y', strtotime($msg['created_at'])); ?>
                                        <span class="block text-gray-400"><?php echo date('H:i', strtotime($msg['created_at'])); ?></span>
                                    </td>
                                    <td class="px-4 py-3 whitespace-nowrap text-right font-medium">
                                        <a href="contact_message_view.php?id=<?php echo $msg['id']; ?>" 
                                           class="text-blue-600 hover:text-blue-900 px-2 py-1 hover:bg-blue-50 rounded-md transition-colors">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>

                <!-- Pagination (Compact) -->
                <?php if ($total_pages > 1): ?>
                    <div class="px-4 py-3 flex items-center justify-between border-t border-gray-200">
                        <div class="text-xs text-gray-500">
                            Page <?php echo $page; ?> of <?php echo $total_pages; ?>
                        </div>
                        <div class="flex gap-1">
                            <?php if ($page > 1): ?>
                                <a href="?page=<?php echo $page - 1; ?>&status=<?php echo $status_filter; ?>&search=<?php echo urlencode($search); ?>" 
                                   class="px-3 py-1 border border-gray-300 rounded text-xs font-medium text-gray-700 hover:bg-gray-50">Prev</a>
                            <?php endif; ?>
                            
                            <?php if ($page < $total_pages): ?>
                                <a href="?page=<?php echo $page + 1; ?>&status=<?php echo $status_filter; ?>&search=<?php echo urlencode($search); ?>" 
                                   class="px-3 py-1 border border-gray-300 rounded text-xs font-medium text-gray-700 hover:bg-gray-50">Next</a>
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
