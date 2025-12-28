<?php
require_once '../includes/auth.php';
$auth->requireLogin();

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$id) {
    header('Location: contact_messages.php');
    exit;
}

// Handle status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_status'])) {
    $new_status = $_POST['status'];
    if (in_array($new_status, ['new', 'read', 'replied', 'archived'])) {
        $stmt = $pdo->prepare("UPDATE contact_messages SET status = :status WHERE id = :id");
        $stmt->execute([':status' => $new_status, ':id' => $id]);
        header('Location: contact_message_view.php?id=' . $id . '&updated=1');
        exit;
    }
}

// Handle delete
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $stmt = $pdo->prepare("DELETE FROM contact_messages WHERE id = :id");
    $stmt->execute([':id' => $id]);
    header('Location: contact_messages.php?deleted=1');
    exit;
}

// Get message
$stmt = $pdo->prepare("SELECT * FROM contact_messages WHERE id = :id");
$stmt->execute([':id' => $id]);
$message = $stmt->fetch();

if (!$message) {
    header('Location: contact_messages.php');
    exit;
}

// Mark as read if it's new
if ($message['status'] === 'new') {
    $stmt = $pdo->prepare("UPDATE contact_messages SET status = 'read' WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $message['status'] = 'read';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Message - Frequency Lab Admin</title>
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
            <!-- Header -->
            <div class="mb-6 flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-slate-900">Message Details</h1>
                    <p class="text-sm text-slate-500 mt-1">ID: #<?php echo $message['id']; ?></p>
                </div>
                <a href="contact_messages.php" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Back to List
                </a>
            </div>

            <?php if (isset($_GET['updated'])): ?>
                <div class="mb-6 bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg">
                    Status updated successfully!
                </div>
            <?php endif; ?>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Message Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Message Card -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <div class="mb-4">
                            <h2 class="text-lg font-bold text-slate-900 mb-2"><?php echo htmlspecialchars($message['subject']); ?></h2>
                            <?php
                            $badge_colors = [
                                'new' => 'bg-blue-100 text-blue-800',
                                'read' => 'bg-gray-100 text-gray-800',
                                'replied' => 'bg-green-100 text-green-800',
                                'archived' => 'bg-orange-100 text-orange-800'
                            ];
                            $color = $badge_colors[$message['status']] ?? 'bg-gray-100 text-gray-800';
                            ?>
                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full <?php echo $color; ?>">
                                <?php echo ucfirst($message['status']); ?>
                            </span>
                        </div>
                        
                        <div class="prose max-w-none">
                            <p class="text-gray-700 whitespace-pre-wrap"><?php echo htmlspecialchars($message['message']); ?></p>
                        </div>
                    </div>

                    <!-- Sender Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Sender Information</h3>
                        <dl class="grid grid-cols-1 gap-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Name</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo htmlspecialchars($message['name']); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Email</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>" class="text-blue-600 hover:text-blue-800">
                                        <?php echo htmlspecialchars($message['email']); ?>
                                    </a>
                                </dd>
                            </div>
                            <?php if ($message['phone']): ?>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Phone</dt>
                                <dd class="mt-1 text-sm text-gray-900">
                                    <a href="tel:<?php echo htmlspecialchars($message['phone']); ?>" class="text-blue-600 hover:text-blue-800">
                                        <?php echo htmlspecialchars($message['phone']); ?>
                                    </a>
                                </dd>
                            </div>
                            <?php endif; ?>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Submitted</dt>
                                <dd class="mt-1 text-sm text-gray-900"><?php echo date('F d, Y \a\t g:i A', strtotime($message['created_at'])); ?></dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">IP Address</dt>
                                <dd class="mt-1 text-sm text-gray-900 font-mono"><?php echo htmlspecialchars($message['ip_address']); ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Sidebar Actions -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Status Update -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Update Status</h3>
                        <form method="POST">
                            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent mb-4">
                                <option value="new" <?php echo $message['status'] === 'new' ? 'selected' : ''; ?>>New</option>
                                <option value="read" <?php echo $message['status'] === 'read' ? 'selected' : ''; ?>>Read</option>
                                <option value="replied" <?php echo $message['status'] === 'replied' ? 'selected' : ''; ?>>Replied</option>
                                <option value="archived" <?php echo $message['status'] === 'archived' ? 'selected' : ''; ?>>Archived</option>
                            </select>
                            <button type="submit" name="update_status" class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors font-medium">
                                Update Status
                            </button>
                        </form>
                    </div>

                    <!-- Quick Actions -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Quick Actions</h3>
                        <div class="space-y-3">
                            <a href="mailto:<?php echo htmlspecialchars($message['email']); ?>?subject=Re: <?php echo urlencode($message['subject']); ?>" 
                               class="block w-full px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors font-medium text-center">
                                <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                                Reply via Email
                            </a>
                            
                            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this message? This action cannot be undone.');">
                                <button type="submit" name="delete" class="w-full px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors font-medium">
                                    <svg class="w-4 h-4 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    Delete Message
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Technical Info -->
                    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h3 class="text-lg font-bold text-slate-900 mb-4">Technical Info</h3>
                        <dl class="space-y-3">
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">User Agent</dt>
                                <dd class="mt-1 text-xs text-gray-700 break-all"><?php echo htmlspecialchars($message['user_agent']); ?></dd>
                            </div>
                            <div>
                                <dt class="text-xs font-medium text-gray-500 uppercase">Last Updated</dt>
                                <dd class="mt-1 text-xs text-gray-700"><?php echo date('M d, Y g:i A', strtotime($message['updated_at'])); ?></dd>
                            </div>
                        </dl>
                    </div>
                </div>
            </div>
            
        </main>
    </div>
</div>

</body>
</html>
