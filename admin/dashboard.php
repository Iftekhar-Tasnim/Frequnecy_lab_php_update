<?php
require_once '../includes/auth.php';
$auth->requireLogin();

// Get Stats
try {
    $members_count = $pdo->query("SELECT COUNT(*) FROM team_members")->fetchColumn();
    
    // Message Stats
    $messages_count = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
    $new_messages_count = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();
    
    // Content Stats
    $programmes_count = $pdo->query("SELECT COUNT(*) FROM programmes")->fetchColumn();
    $gallery_count = $pdo->query("SELECT COUNT(*) FROM gallery_images")->fetchColumn();
    $publications_count = $pdo->query("SELECT COUNT(*) FROM publications")->fetchColumn();

    // Recent Messages
    $recent_messages = $pdo->query("SELECT * FROM contact_messages ORDER BY created_at DESC LIMIT 5")->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    // Basic error handling
    $members_count = $messages_count = $new_messages_count = $programmes_count = $gallery_count = $publications_count = 0;
    $recent_messages = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Frequency Lab Admin</title>
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
        <div class="absolute top-[10%] left-[20%] w-96 h-96 bg-blue-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob"></div>
        <div class="absolute bottom-[20%] right-[10%] w-96 h-96 bg-cyan-500/10 rounded-full mix-blend-screen filter blur-3xl opacity-20 animate-blob animation-delay-4000"></div>
    </div>

    <?php include 'includes/sidebar.php'; ?>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-hidden relative z-10">
        <?php include 'includes/mobile_header.php'; ?>

        <!-- Main Scrollable Area -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto bg-transparent p-4 md:p-8 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-white font-exo">Dashboard</h1>
                <p class="text-slate-400 mt-1">Welcome back, <span class="text-blue-400"><?php echo htmlspecialchars($_SESSION['username'] ?? 'Admin'); ?></span></p>
            </div>

            <!-- Stats Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 gap-6 mb-8">
                
                <!-- Messages Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col justify-between hover:border-blue-500/30 transition-all hover:shadow-lg hover:shadow-blue-500/10 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-blue-500/20 rounded-xl group-hover:bg-blue-500/30 transition-colors">
                            <svg class="w-6 h-6 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                        <?php if ($new_messages_count > 0): ?>
                        <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-bold bg-blue-500 text-white animate-pulse shadow-lg shadow-blue-500/40">
                            <?php echo $new_messages_count; ?> New
                        </span>
                        <?php endif; ?>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Inquiries</p>
                        <p class="text-3xl font-bold text-white mt-1"><?php echo $messages_count; ?></p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="contact_messages.php" class="text-sm font-medium text-blue-400 hover:text-blue-300 flex items-center transition-colors">
                            View Inbox <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Team Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col justify-between hover:border-cyan-500/30 transition-all hover:shadow-lg hover:shadow-cyan-500/10 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-cyan-500/20 rounded-xl group-hover:bg-cyan-500/30 transition-colors">
                            <svg class="w-6 h-6 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Team</p>
                        <p class="text-3xl font-bold text-white mt-1"><?php echo $members_count; ?></p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="team_members.php" class="text-sm font-medium text-cyan-400 hover:text-cyan-300 flex items-center transition-colors">
                            Manage <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Programmes Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col justify-between hover:border-purple-500/30 transition-all hover:shadow-lg hover:shadow-purple-500/10 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-purple-500/20 rounded-xl group-hover:bg-purple-500/30 transition-colors">
                            <svg class="w-6 h-6 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Programmes</p>
                        <p class="text-3xl font-bold text-white mt-1"><?php echo $programmes_count; ?></p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="programmes.php" class="text-sm font-medium text-purple-400 hover:text-purple-300 flex items-center transition-colors">
                            View All <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Publications Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col justify-between hover:border-emerald-500/30 transition-all hover:shadow-lg hover:shadow-emerald-500/10 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-emerald-500/20 rounded-xl group-hover:bg-emerald-500/30 transition-colors">
                            <svg class="w-6 h-6 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Publications</p>
                        <p class="text-3xl font-bold text-white mt-1"><?php echo $publications_count; ?></p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                        <a href="publications.php" class="text-sm font-medium text-emerald-400 hover:text-emerald-300 flex items-center transition-colors">
                            Edit <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div class="bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl p-6 flex flex-col justify-between hover:border-orange-500/30 transition-all hover:shadow-lg hover:shadow-orange-500/10 group">
                    <div class="flex items-start justify-between mb-4">
                        <div class="p-3 bg-orange-500/20 rounded-xl group-hover:bg-orange-500/30 transition-colors">
                             <svg class="w-6 h-6 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-slate-400 uppercase tracking-wider">Gallery</p>
                        <p class="text-3xl font-bold text-white mt-1"><?php echo $gallery_count; ?></p>
                    </div>
                    <div class="mt-4 pt-4 border-t border-white/5">
                         <a href="gallery.php" class="text-sm font-medium text-orange-400 hover:text-orange-300 flex items-center transition-colors">
                            View <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-8">
                <!-- Recent Contact Messages -->
                <div class="lg:col-span-2 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 flex flex-col overflow-hidden">
                    <div class="p-6 border-b border-white/10 flex justify-between items-center bg-white/5">
                        <h2 class="text-lg font-bold text-white">Recent Inquiries</h2>
                        <a href="contact_messages.php" class="text-sm text-blue-400 hover:text-blue-300 font-medium transition-colors">View All</a>
                    </div>
                    <div class="flex-1 overflow-x-auto">
                        <table class="min-w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-white/5 text-slate-400">
                                <tr>
                                    <th class="px-6 py-4 font-semibold">Name</th>
                                    <th class="px-6 py-4 font-semibold">Subject</th>
                                    <th class="px-6 py-4 font-semibold">Status</th>
                                    <th class="px-6 py-4 font-semibold text-right">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                <?php if(empty($recent_messages)): ?>
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 italic">No messages found.</td>
                                    </tr>
                                <?php else: ?>
                                    <?php foreach($recent_messages as $msg): ?>
                                    <tr class="hover:bg-white/5 transition-colors">
                                        <td class="px-6 py-4 font-medium text-white"><?php echo htmlspecialchars($msg['name']); ?></td>
                                        <td class="px-6 py-4 text-slate-300 truncate max-w-xs"><?php echo htmlspecialchars($msg['subject']); ?></td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-1 rounded text-xs font-medium 
                                                <?php echo $msg['status'] === 'new' ? 'bg-blue-500/20 text-blue-300 border border-blue-500/40' : 
                                                      ($msg['status'] === 'replied' ? 'bg-green-500/20 text-green-300 border border-green-500/40' : 'bg-gray-500/20 text-gray-300 border border-gray-500/40'); ?>">
                                                <?php echo ucfirst($msg['status']); ?>
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right text-slate-500 text-xs">
                                            <?php echo date('M d', strtotime($msg['created_at'])); ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 p-6">
                    <h2 class="text-lg font-bold text-white mb-6">Quick Actions</h2>
                    <div class="space-y-4">
                        <a href="publication_form.php" class="flex items-center p-3 rounded-xl border border-white/10 hover:border-blue-500/50 hover:bg-blue-500/10 transition-all group">
                            <div class="p-2.5 bg-blue-500/20 text-blue-400 rounded-lg group-hover:bg-blue-500/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white">Add Publication</p>
                                <p class="text-xs text-slate-500 group-hover:text-slate-400">New research or article</p>
                            </div>
                        </a>

                        <a href="gallery_form.php" class="flex items-center p-3 rounded-xl border border-white/10 hover:border-orange-500/50 hover:bg-orange-500/10 transition-all group">
                            <div class="p-2.5 bg-orange-500/20 text-orange-400 rounded-lg group-hover:bg-orange-500/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white">Upload Photo</p>
                                <p class="text-xs text-slate-500 group-hover:text-slate-400">Add to gallery</p>
                            </div>
                        </a>

                        <a href="programme_form.php" class="flex items-center p-3 rounded-xl border border-white/10 hover:border-purple-500/50 hover:bg-purple-500/10 transition-all group">
                            <div class="p-2.5 bg-purple-500/20 text-purple-400 rounded-lg group-hover:bg-purple-500/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white">New Programme</p>
                                <p class="text-xs text-slate-500 group-hover:text-slate-400">Create workshop or event</p>
                            </div>
                        </a>
                        
                        <a href="team_form.php" class="flex items-center p-3 rounded-xl border border-white/10 hover:border-cyan-500/50 hover:bg-cyan-500/10 transition-all group">
                            <div class="p-2.5 bg-cyan-500/20 text-cyan-400 rounded-lg group-hover:bg-cyan-500/30 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-semibold text-white">Add Team Member</p>
                                <p class="text-xs text-slate-500 group-hover:text-slate-400">Board, Advisor, or Exec</p>
                            </div>
                        </a>

                    </div>
                </div>
            </div>
            
        </main>
    </div>
</div>

</body>
</html>

