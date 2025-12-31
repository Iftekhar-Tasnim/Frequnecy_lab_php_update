<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Convert category to readable label
function getCategoryLabel($cat) {
    if ($cat == 'board') return 'Board of Directors';
    if ($cat == 'advisor') return 'Advisory Panel';
    if ($cat == 'executive') return 'Executive Team';
    return ucfirst($cat);
}

// Handle Delete
if (isset($_POST['delete_id'])) {
    if ($auth->checkRole('admin')) {
        $id = $_POST['delete_id'];
        
        // Get image path to delete file
        $stmt = $pdo->prepare("SELECT image_path FROM team_members WHERE id = ?");
        $stmt->execute([$id]);
        $member = $stmt->fetch();
        
        if ($member && !empty($member['image_path'])) {
            $file_path = '../' . $member['image_path'];
            if (file_exists($file_path)) {
                unlink($file_path);
            }
        }
        
        $deleteStmt = $pdo->prepare("DELETE FROM team_members WHERE id = ?");
        $deleteStmt->execute([$id]);
        $success_msg = "Team member deleted successfully.";
    } else {
        header('Location: 403.php');
        exit;
    }
}

// Handle AJAX Reordering
if (isset($_POST['action']) && $_POST['action'] == 'reorder') {
    $order = json_decode($_POST['order'], true);
    if ($order && is_array($order)) {
        try {
            $pdo->beginTransaction();
            $stmt = $pdo->prepare("UPDATE team_members SET display_order = ? WHERE id = ?");
            foreach ($order as $item) {
                $stmt->execute([$item['order'], $item['id']]);
            }
            $pdo->commit();
            echo json_encode(['success' => true]);
        } catch (Exception $e) {
            $pdo->rollBack();
            echo json_encode(['success' => false, 'message' => $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Invalid data']);
    }
    exit;
}

// Fetch Members
$search = $_GET['search'] ?? '';
$search_query = "";
$params = [];

if (!empty($search)) {
    $search_query = "WHERE name LIKE ? OR designation LIKE ? OR category LIKE ?";
    $params = ["%$search%", "%$search%", "%$search%"];
}

$stmt = $pdo->prepare("SELECT * FROM team_members $search_query ORDER BY FIELD(category, 'board', 'advisor', 'executive'), display_order ASC");
$stmt->execute($params);
$members = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Team Members - Frequency Lab Admin</title>
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
    <!-- SortableJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.15.0/Sortable.min.js"></script>
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-exo { font-family: 'Exo 2', sans-serif; }
        .scrollbar-hide::-webkit-scrollbar { display: none; }
        .sortable-ghost { opacity: 0.4; background-color: rgba(255, 255, 255, 0.05); }
        .sortable-drag { cursor: grabbing; background-color: rgba(30, 41, 59, 0.9); }
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
                    <h1 class="text-3xl font-bold text-white font-exo">Team Members</h1>
                    <p class="text-slate-400 mt-1">Manage your organization's team structure. <span class="hidden sm:inline text-blue-400 font-medium">Tip: Drag rows to reorder.</span></p>
                </div>
                
                <div class="flex flex-col sm:flex-row gap-3 w-full sm:w-auto">
                    <!-- Search -->
                    <form method="GET" class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-slate-500 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text" name="search" value="<?php echo htmlspecialchars($search); ?>" 
                               class="block w-full sm:w-64 pl-10 pr-10 py-2.5 border border-white/10 rounded-xl leading-5 bg-black/20 text-slate-200 placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm transition-all" 
                               placeholder="Search members...">
                        <?php if (!empty($search)): ?>
                            <a href="team_members.php" class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-white">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        <?php endif; ?>
                    </form>

                    <!-- Add Button -->
                    <a href="team_form.php" class="inline-flex items-center justify-center px-4 py-2.5 border border-transparent text-sm font-medium rounded-xl shadow-lg shadow-blue-500/20 text-white bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-500 hover:to-cyan-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all transform hover:scale-[1.02]">
                        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/></svg>
                        Add Member
                    </a>
                </div>
            </div>

            <!-- Toast Notification (Hidden by default) -->
            <div id="toast" class="fixed bottom-4 right-4 bg-slate-900 border border-white/10 text-white px-6 py-3 rounded-xl shadow-2xl transform translate-y-20 opacity-0 transition-all duration-300 z-50 flex items-center">
                <svg class="w-5 h-5 text-green-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                <span id="toast-message">Action successful</span>
            </div>

            <!-- Alerts -->
            <?php if (isset($success_msg)): ?>
                <div class="bg-green-500/10 border-l-4 border-green-500 p-4 mb-6 rounded-r-lg shadow-sm backdrop-blur-sm animate-fade-in-up">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3"><p class="text-sm text-green-400 font-medium"><?php echo htmlspecialchars($success_msg); ?></p></div>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if (isset($error_msg)): ?>
                <div class="bg-red-500/10 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm backdrop-blur-sm animate-fade-in-up">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="ml-3"><p class="text-sm text-red-400 font-medium"><?php echo htmlspecialchars($error_msg); ?></p></div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Table Card -->
            <div class="bg-white/5 backdrop-blur-md rounded-2xl shadow-xl border border-white/10 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-white/5">
                        <thead class="bg-white/5">
                            <tr>
                                <th scope="col" class="w-10 px-0"></th> <!-- Drag Handle -->
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Member Info</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Category</th>
                                <th scope="col" class="px-6 py-4 text-left text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Order</th>
                                <th scope="col" class="px-6 py-4 text-right text-xs font-bold text-slate-300 uppercase tracking-wider font-exo">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="sortable-list" class="divide-y divide-white/5">
                            <?php foreach ($members as $member): ?>
                            <tr class="hover:bg-white/5 transition-colors duration-150 group" data-id="<?php echo $member['id']; ?>">
                                <td class="px-3 py-4 text-center cursor-move text-slate-600 hover:text-slate-400">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-12 w-12 relative">
                                            <?php if (!empty($member['image_path'])): ?>
                                                <img class="h-12 w-12 rounded-full object-cover border-2 border-white/10 shadow-sm" src="../<?php echo htmlspecialchars($member['image_path']); ?>" alt="">
                                            <?php else: ?>
                                                <div class="h-12 w-12 rounded-full bg-slate-800 flex items-center justify-center text-slate-400 font-bold border-2 border-white/10 shadow-sm">
                                                    <?php echo strtoupper(substr($member['name'], 0, 2)); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-semibold text-white group-hover:text-blue-400 transition-colors"><?php echo htmlspecialchars($member['name']); ?></div>
                                            <div class="text-xs text-slate-400"><?php echo htmlspecialchars($member['designation']); ?></div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php 
                                        $badge_colors = [
                                            'board' => 'bg-purple-500/20 text-purple-300 border-purple-500/30',
                                            'advisor' => 'bg-amber-500/20 text-amber-300 border-amber-500/30',
                                            'executive' => 'bg-blue-500/20 text-blue-300 border-blue-500/30'
                                        ];
                                        $color_class = $badge_colors[$member['category']] ?? 'bg-slate-500/20 text-slate-300 border-slate-500/30';
                                    ?>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium border <?php echo $color_class; ?>">
                                        <?php echo getCategoryLabel($member['category']); ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="text-sm text-slate-400 font-mono bg-white/5 px-2 py-1 rounded order-badge border border-white/5">
                                        #<?php echo $member['display_order']; ?>
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <div class="flex items-center justify-end space-x-3">
                                        <a href="team_form.php?id=<?php echo $member['id']; ?>" class="text-slate-400 hover:text-white transition-colors p-2 rounded-lg hover:bg-white/10" title="Edit">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        </a>
                                        
                                        <?php if ($auth->checkRole('admin')): ?>
                                        <form method="POST" class="inline-block" onsubmit="return confirm('Are you sure you want to delete this member?');">
                                            <input type="hidden" name="delete_id" value="<?php echo $member['id']; ?>">
                                            <button type="submit" class="text-slate-400 hover:text-red-400 transition-colors p-2 rounded-lg hover:bg-red-500/10" title="Delete">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                            
                            <?php if (empty($members)): ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="bg-white/5 rounded-full p-6 mb-4 ring-1 ring-white/10">
                                                <svg class="w-10 h-10 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            </div>
                                            <h3 class="text-lg font-medium text-white">No team members found</h3>
                                            <p class="text-slate-400 mt-2 mb-6 max-w-sm">Get started by adding a new team member to your organization.</p>
                                            <a href="team_form.php" class="inline-flex items-center px-4 py-2.5 bg-blue-600 hover:bg-blue-500 text-white text-sm font-medium rounded-xl shadow-lg shadow-blue-500/20 transition-all">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                                Add Member
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

<script>
    // Initialize Sortable
    const el = document.getElementById('sortable-list');
    const sortable = Sortable.create(el, {
        animation: 150,
        handle: '.cursor-move', // Handle selector
        ghostClass: 'sortable-ghost',
        dragClass: 'sortable-drag',
        onEnd: function (evt) {
            // Get order array
            const rows = el.querySelectorAll('tr');
            const order = [];
            
            rows.forEach((row, index) => {
                const id = row.getAttribute('data-id');
                // Calculate new visual number (Just for fallback, real calculation is simpler)
                // We just need ID list in order
                order.push({ id: id, order: index + 1 });
                
                // Update badge visually
                const badge = row.querySelector('.order-badge');
                if (badge) badge.textContent = '#' + (index + 1);
            });

            // Send to server
            fetch('team_members.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'action=reorder&order=' + JSON.stringify(order)
            })
            .then(response => response.json())
            .then(data => {
                showToast(data.success ? 'Order updated successfully' : 'Failed to update user order', data.success ? 'success' : 'error');
            })
            .catch(error => {
                showToast('Network error', 'error');
                console.error('Error:', error);
            });
        }
    });

    function showToast(message, type) {
        const toast = document.getElementById('toast');
        const msg = document.getElementById('toast-message');
        msg.textContent = message;
        
        // Remove old styling classes if needed, or handle simple dynamic styling
        // Here we keep it simple since we styled it in PHP
        
        toast.classList.remove('translate-y-20', 'opacity-0');
        
        // Auto hide
        setTimeout(() => {
            toast.classList.add('translate-y-20', 'opacity-0');
        }, 3000);
    }
</script>
</body>
</html>
