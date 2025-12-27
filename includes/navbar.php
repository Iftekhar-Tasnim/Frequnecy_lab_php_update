<!-- Navigation -->
<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <?php 
    $base = $path ?? ''; 
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <div id="navbar-bg" class="absolute inset-0 bg-prussian-blue-950/80 backdrop-blur-xl border-b border-white/5 opacity-100"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center justify-between h-20">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="<?php echo $base; ?>index.php" class="flex items-center gap-3 group">
                    <img src="<?php echo $base; ?>assets/logo/F_Lab logo Badge.png" alt="Logo" class="h-10 w-10 group-hover:drop-shadow-[0_0_8px_rgba(31,157,224,0.6)] transition-all">
                    <img src="<?php echo $base; ?>assets/logo/F_Lab logo(full name).png" alt="Frequency Lab" class="h-12 hidden sm:block">
                </a>
            </div>
            
            <!-- Center: Desktop Nav Links -->
            <div class="hidden lg:flex items-center justify-center absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                <nav class="flex items-center gap-1 bg-white/5 px-2 py-1 rounded-full border border-white/10 backdrop-blur-md">
                    <a href="<?php echo $base; ?>index.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'index.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Home</a>
                    <a href="<?php echo $base; ?>pages/about.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'about.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">About</a>
                    <a href="<?php echo $base; ?>pages/programmes.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'programmes.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Programmes</a>
                    <a href="<?php echo $base; ?>pages/publications.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'publications.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Publications</a>
                    <a href="<?php echo $base; ?>pages/team.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'team.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Team</a>
                    <a href="<?php echo $base; ?>pages/gallery.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'gallery.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Gallery</a>
                    <a href="<?php echo $base; ?>pages/shop.php" class="nav-link px-3 py-2 text-sm text-white/90 hover:text-white font-medium rounded-full transition-all <?php echo ($current_page == 'shop.php') ? 'bg-white/10 text-white shadow-sm' : 'hover:bg-white/5'; ?>">Shop</a>
                </nav>
            </div>

            <!-- Right: Contact & Mobile Menu -->
            <div class="flex items-center gap-4">
                <a href="<?php echo $base; ?>pages/contact.php" class="inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white transition-all bg-gradient-to-r from-blue-600 to-blue-500 rounded-full hover:from-blue-500 hover:to-blue-400 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 <?php echo ($current_page == 'contact.php') ? 'ring-2 ring-offset-2 ring-blue-500 ring-offset-slate-900' : ''; ?>">
                    Contact Us
                </a>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white p-2 rounded-lg hover:bg-white/10 transition-colors">
                    <svg id="menu-icon" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg id="close-icon" class="h-6 w-6 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden bg-prussian-blue-950 border-t border-white/5">
        <div class="px-4 pt-2 pb-6 space-y-1">
            <a href="<?php echo $base; ?>index.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Home</a>
            <a href="<?php echo $base; ?>pages/about.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">About</a>
            <a href="<?php echo $base; ?>pages/programmes.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Programmes</a>
            <a href="<?php echo $base; ?>pages/publications.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Publications</a>
            <a href="<?php echo $base; ?>pages/team.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Team</a>
            <a href="<?php echo $base; ?>pages/gallery.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Gallery</a>
            <a href="<?php echo $base; ?>pages/shop.php" class="block px-3 py-4 text-white hover:bg-white/5 font-exo mobile-nav-link">Shop</a>
            <a href="<?php echo $base; ?>pages/contact.php" class="block px-3 py-4 text-yale-blue-400 font-bold font-exo mobile-nav-link">Contact Us</a>
        </div>
    </div>
</nav>
