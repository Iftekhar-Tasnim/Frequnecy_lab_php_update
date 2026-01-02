<!-- Navigation -->
<nav id="navbar" class="fixed top-0 left-0 w-full z-50 transition-all duration-300">
    <?php 
    if (!isset($path)) {
        $path = '';
        if (strpos($_SERVER['PHP_SELF'], '/pages/') !== false) {
            $path = '../';
        }
    }
    $base = $path;
    $current_page = basename($_SERVER['PHP_SELF']);
    ?>
    <div id="navbar-bg" class="absolute inset-0 bg-prussian-blue-950 backdrop-blur-xl border-b border-white/5 opacity-100"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
        <div class="flex items-center justify-between h-20">
            <!-- Left: Logo -->
            <div class="flex-shrink-0 flex items-center">
                <a href="<?php echo $base; ?>index.php" class="flex items-center gap-3 group">
                    <img src="<?php echo $base; ?>assets/logo/F_Lab logo Badge.png" alt="Logo" class="h-10 w-10 group-hover:drop-shadow-[0_0_8px_rgba(31,157,224,0.6)] transition-all">
                    <img src="<?php echo $base; ?>assets/logo/F_Lab logo(full name).png" alt="Frequency Lab" class="h-8 sm:h-12 block">
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
                <a href="<?php echo $base; ?>pages/contact.php" class="hidden lg:inline-flex items-center justify-center px-4 py-2 text-sm font-semibold text-white transition-all bg-gradient-to-r from-blue-600 to-blue-500 rounded-full hover:from-blue-500 hover:to-blue-400 shadow-lg shadow-blue-500/25 hover:shadow-blue-500/40 hover:-translate-y-0.5 <?php echo ($current_page == 'contact.php') ? 'ring-2 ring-offset-2 ring-blue-500 ring-offset-slate-900' : ''; ?>">
                    Contact Us
                </a>

                <!-- Mobile menu button -->
                <button id="mobile-menu-btn" class="lg:hidden text-white p-2 focus:outline-none">
                    <svg id="menu-icon" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                    <svg id="close-icon" class="h-8 w-8 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden absolute top-20 left-0 w-full h-[calc(100vh-5rem)] bg-prussian-blue-950 border-t border-white/5 z-10 overflow-y-auto">
        <div class="flex flex-col h-full">
            
            <!-- Navigation Links -->
            <div class="px-6 py-6 space-y-1 flex-1">
                <a href="<?php echo $base; ?>index.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'index.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Home
                </a>
                <a href="<?php echo $base; ?>pages/about.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'about.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    About
                </a>
                <a href="<?php echo $base; ?>pages/programmes.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'programmes.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Programmes
                </a>
                <a href="<?php echo $base; ?>pages/publications.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'publications.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Publications
                </a>
                <a href="<?php echo $base; ?>pages/team.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'team.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Team
                </a>
                <a href="<?php echo $base; ?>pages/gallery.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'gallery.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Gallery
                </a>
                <a href="<?php echo $base; ?>pages/shop.php" class="mobile-nav-link block py-4 px-2 border-b border-white/5 text-white/80 font-inter font-medium text-lg hover:text-white hover:pl-4 transition-all duration-300 <?php echo ($current_page == 'shop.php') ? 'text-white border-blue-500/50 pl-4' : ''; ?>">
                    Shop
                </a>
                
                <a href="<?php echo $base; ?>pages/contact.php" class="mobile-nav-link block mt-8 py-3 px-6 text-center text-white bg-blue-600 rounded-lg font-medium hover:bg-blue-500 transition-colors shadow-lg shadow-blue-900/20 <?php echo ($current_page == 'contact.php') ? 'ring-2 ring-white/20' : ''; ?>">
                    Contact Us
                </a>
            </div>

            <!-- Footer Info -->
            <div class="p-8 text-center border-t border-white/5 bg-black/10">
                <div class="flex justify-center gap-8 mb-4">
                     <a href="https://www.facebook.com/frequencylab.bd" target="_blank" class="text-white/40 hover:text-white transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg></a>
                     <a href="https://www.linkedin.com/company/frequency-lab-bd/" target="_blank" class="text-white/40 hover:text-white transition-colors"><svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/></svg></a>
                </div>
                <p class="text-[10px] text-white/30 font-inter uppercase tracking-widest">© 2024 Frequency Lab</p>
            </div>
        </div>
    </div>
</nav>
