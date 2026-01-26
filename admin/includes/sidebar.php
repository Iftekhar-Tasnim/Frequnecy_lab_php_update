<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<!-- Mobile Overlay -->
<div id="sidebar-overlay" class="fixed inset-0 bg-black/80 backdrop-blur-sm z-40 hidden md:hidden transition-opacity"></div>

<!-- Sidebar -->
<aside id="admin-sidebar" class="fixed inset-y-0 left-0 z-50 w-64 bg-slate-900/95 backdrop-blur-xl text-white transform -translate-x-full md:translate-x-0 md:static md:inset-0 transition-transform duration-300 ease-in-out flex flex-col h-full border-r border-white/5 shadow-2xl">
    <div class="h-16 flex items-center justify-between px-6 border-b border-white/5">
        <div class="flex items-center justify-center">
             <img src="../assets/logo/F_Lab logo(full name).png" alt="Frequency Lab" class="h-8 w-auto drop-shadow-[0_0_10px_rgba(59,130,246,0.5)]">
        </div>
        <!-- Close Button (Mobile) -->
        <button id="sidebar-close" class="md:hidden text-slate-400 hover:text-white transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
        </button>
    </div>
    
    <div class="flex-1 overflow-y-auto py-4 scrollbar-thin scrollbar-thumb-slate-700 scrollbar-track-transparent">
        <nav class="px-3 space-y-1">
            <!-- Dashboard -->
            <a href="dashboard.php" class="flex items-center px-3 py-2.5 <?php echo $current_page == 'dashboard.php' ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo $current_page == 'dashboard.php' ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <div class="pt-6 pb-2">
                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-widest font-exo">Content Management</p>
            </div>

            <!-- Home Content -->
            <a href="home.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'home') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'home') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                Home Page
            </a>

            <!-- Programmes -->
            <a href="programmes.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'progra') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'progra') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z"></path></svg>
                Programmes
            </a>

            <!-- Gallery -->
            <a href="gallery.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'gallery') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'gallery') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                Gallery
            </a>

            <!-- Publications -->
            <a href="publications.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'publication') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'publication') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                Publications
            </a>
            
            <!-- Shop -->
            <a href="shop.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'shop') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'shop') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                Shop
            </a>

            <!-- Team -->
            <a href="team_members.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'team') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'team') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Team Members
            </a>

            <!-- Contact Messages -->
            <a href="contact_messages.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'contact_message') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-all group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'contact_message') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                Contact Messages
                <?php
                // Get new messages count
                try {
                     $new_count = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE status = 'new'")->fetchColumn();
                     if ($new_count > 0):
                ?>
                     <span class="ml-auto bg-blue-500 text-white text-xs font-bold px-2 py-0.5 rounded-full shadow-lg shadow-blue-500/40 animate-pulse"><?php echo $new_count; ?></span>
                <?php 
                     endif;
                } catch (PDOException $e) { /* Ignore */ } 
                ?>
            </a>

            <div class="pt-6 pb-2">
                <p class="px-3 text-xs font-bold text-slate-500 uppercase tracking-widest font-exo">System</p>
            </div>
            
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="users.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'user') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-colors group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'user') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Users & Roles
            </a>
            <?php endif; ?>
            
            <a href="profile.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'profile') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-colors group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'profile') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                My Profile
            </a>

             <a href="settings.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'settings') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-colors group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'settings') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                Settings
            </a>

            <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
            <a href="database_migration.php" class="flex items-center px-3 py-2 <?php echo (strpos($current_page, 'database_migration') !== false) ? 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white shadow-lg shadow-blue-500/20' : 'text-slate-400 hover:bg-white/5 hover:text-white'; ?> rounded-lg transition-colors group">
                <svg class="w-5 h-5 mr-3 <?php echo (strpos($current_page, 'database_migration') !== false) ? 'text-white' : 'text-slate-500 group-hover:text-white'; ?> transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/></svg>
                DB Migration
            </a>
            <?php endif; ?>
        </nav>
    </div>

    <div class="p-4 border-t border-white/5">
        <a href="profile.php" class="flex items-center group">
            <div class="flex-shrink-0">
                <div class="h-8 w-8 rounded-full bg-blue-600 flex items-center justify-center text-white font-bold shadow-lg shadow-blue-500/20 ring-2 ring-transparent group-hover:ring-blue-400 transition-all">
                    <?php echo strtoupper(substr($_SESSION['username'] ?? 'U', 0, 1)); ?>
                </div>
            </div>
            <div class="ml-3">
                <p class="text-sm font-medium text-white group-hover:text-blue-400 transition-colors"><?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?></p>
                <p class="text-xs text-slate-500 capitalize"><?php echo htmlspecialchars($_SESSION['role'] ?? 'Staff'); ?></p>
            </div>
        </a>
        <a href="logout.php" class="mt-4 block text-center text-xs text-white hover:text-red-400 font-medium transition-colors bg-white/5 hover:bg-red-500/10 py-2 rounded-lg border border-white/5 hover:border-red-500/20">Sign Out</a>
    </div>
</aside>
<script src="js/admin.js"></script>
