// Client-side Router for F Lab Website
// This router protects file paths by using hash-based routing

class Router {
    constructor() {
        this.routes = {
            '/': 'index.php',
            '/home': 'index.php',
            '/about': 'pages/about.php',
            '/programmes': 'pages/programmes.php',
            '/publications': 'pages/publications.php',
            '/team': 'pages/team.php',
            '/gallery': 'pages/gallery.php',

            '/blog': 'pages/blog.php',
            '/shop': 'pages/shop.php',
            '/contact': 'pages/contact.php',
            '/privacy-policy': 'pages/privacy-policy.php',
            '/safeguard': 'pages/safeguard.php'
        };

        this.currentRoute = null;
        this.linksIntercepted = false;
        this.init();
    }

    init() {
        // Listen for hash changes
        window.addEventListener('hashchange', () => this.handleRoute());

        // Listen for popstate (back/forward buttons)
        window.addEventListener('popstate', () => this.handleRoute());

        // Handle initial load
        this.handleRoute();

        // Intercept all internal link clicks (only set up once)
        if (!this.linksIntercepted) {
            this.interceptLinks();
            this.linksIntercepted = true;
        }
    }

    interceptLinks() {
        // Use event delegation - only need to set this up once
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (!link) return;

            const href = link.getAttribute('href');

            // Check if it's an internal route
            if (href && this.isInternalRoute(href)) {
                e.preventDefault();
                const route = this.getRouteFromHref(href);
                this.navigate(route);
            }
        });
    }

    isInternalRoute(href) {
        // Check if it's a relative path to one of our pages
        if (href.startsWith('#')) return true;
        if (href.startsWith('http')) return false;
        if (href.startsWith('mailto:') || href.startsWith('tel:')) return false;

        // Check if it matches any of our routes
        const route = this.getRouteFromHref(href);
        return route && this.routes.hasOwnProperty(route);
    }

    getRouteFromHref(href) {
        // Convert file paths to routes
        if (href.startsWith('#')) {
            return href.substring(1) || '/';
        }

        // Handle relative paths
        if (href === 'index.html' || href === './index.html' || href === '../index.html' || href === '/') {
            return '/';
        }

        // Map file paths to routes
        const pathMap = {
            'pages/about.php': '/about',
            '../pages/about.php': '/about',
            './pages/about.php': '/about',
            'about.php': '/about',
            'pages/programmes.php': '/programmes',
            '../pages/programmes.php': '/programmes',
            './pages/programmes.php': '/programmes',
            'programmes.php': '/programmes',
            'pages/publications.php': '/publications',
            '../pages/publications.php': '/publications',
            './pages/publications.php': '/publications',
            'publications.php': '/publications',
            'pages/team.php': '/team',
            '../pages/team.php': '/team',
            './pages/team.php': '/team',
            'team.php': '/team',
            'pages/gallery.php': '/gallery',
            '../pages/gallery.php': '/gallery',
            './pages/gallery.php': '/gallery',
            'gallery.php': '/gallery',

            'pages/blog.php': '/blog',
            '../pages/blog.php': '/blog',
            './pages/blog.php': '/blog',
            'blog.php': '/blog',
            'pages/shop.php': '/shop',
            '../pages/shop.php': '/shop',
            './pages/shop.php': '/shop',
            'shop.php': '/shop',
            'pages/contact.php': '/contact',
            '../pages/contact.php': '/contact',
            './pages/contact.php': '/contact',
            'contact.php': '/contact',
            'pages/privacy-policy.php': '/privacy-policy',
            '../pages/privacy-policy.php': '/privacy-policy',
            './pages/privacy-policy.php': '/privacy-policy',
            'privacy-policy.php': '/privacy-policy',
            'pages/safeguard.php': '/safeguard',
            '../pages/safeguard.php': '/safeguard',
            './pages/safeguard.php': '/safeguard',
            'safeguard.php': '/safeguard'
        };

        return pathMap[href] || null;
    }

    navigate(route) {
        // Ensure route starts with /
        if (!route.startsWith('/')) {
            route = '/' + route;
        }

        // Update hash without triggering page reload
        if (window.location.hash !== '#' + route) {
            window.location.hash = route;
        }

        this.handleRoute();
    }

    async handleRoute() {
        // Get route from hash or pathname
        let route = window.location.hash.substring(1) || '/';

        // Fallback to pathname if no hash and not on index.html
        if (route === '/' && window.location.pathname !== '/' && window.location.pathname !== '/index.html') {
            const pathRoute = this.getRouteFromPathname(window.location.pathname);
            if (pathRoute) {
                route = pathRoute;
            }
        }

        // Normalize route
        if (!route.startsWith('/')) {
            route = '/' + route;
        }

        // If route doesn't exist, default to home
        if (!this.routes[route]) {
            route = '/';
        }

        // Don't reload if it's the same route (except when navigating to home from another page)
        if (this.currentRoute === route) {
            // If already on home and clicking home again, just reinitialize
            if (route === '/' && (window.location.pathname === '/' || window.location.pathname.endsWith('index.html'))) {
                return;
            }
            // For other routes, don't reload if same
            if (route !== '/') {
                return;
            }
        }

        this.currentRoute = route;

        // If we're on home route and it's the initial load (no currentRoute set), just initialize
        if (route === '/' && !this.currentRoute && (window.location.pathname === '/' || window.location.pathname.endsWith('index.html'))) {
            window.history.replaceState({ route: '/' }, '', window.location.pathname);
            this.reinitializePage();
            return;
        }

        // Load the page (this handles both home and other routes)
        await this.loadPage(route);
    }

    getRouteFromPathname(pathname) {
        // Convert pathname to route
        const pathMap = {
            '/index.php': '/',
            '/about.php': '/about',
            '/programmes.php': '/programmes',
            '/publications.php': '/publications',
            '/team.php': '/team',
            '/gallery.php': '/gallery',

            '/blog.php': '/blog',
            '/shop.php': '/shop',
            '/contact.php': '/contact',
            '/privacy-policy.php': '/privacy-policy',
            '/safeguard.php': '/safeguard'
        };

        // Check direct match
        if (pathMap[pathname]) {
            return pathMap[pathname];
        }

        // Check if it's in pages directory
        if (pathname.includes('/pages/')) {
            const filename = pathname.split('/').pop();
            return pathMap['/' + filename] || null;
        }

        return null;
    }

    async loadPage(route) {
        const filePath = this.routes[route];
        if (!filePath) {
            console.error('Route not found:', route);
            return;
        }

        try {
            // Show loading state
            this.showLoading();

            // Fetch the page content
            const response = await fetch(filePath);
            if (!response.ok) {
                throw new Error(`Failed to load page: ${response.status}`);
            }

            const html = await response.text();
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');

            // Extract main content (everything except head)
            let bodyContent = doc.body.innerHTML;

            // Fix asset paths - convert relative paths from pages/ to absolute paths
            // Replace ../assets/ with /assets/ and ../dist/ with /dist/
            bodyContent = bodyContent.replace(/\.\.\/assets\//g, '/assets/');
            bodyContent = bodyContent.replace(/\.\.\/dist\//g, '/dist/');
            bodyContent = bodyContent.replace(/\.\.\/js\//g, '/js/');
            bodyContent = bodyContent.replace(/\.\.\/css\//g, '/css/');
            // Also handle ./ paths
            bodyContent = bodyContent.replace(/\.\/assets\//g, '/assets/');
            bodyContent = bodyContent.replace(/\.\/dist\//g, '/dist/');
            bodyContent = bodyContent.replace(/\.\/js\//g, '/js/');
            bodyContent = bodyContent.replace(/\.\/css\//g, '/css/');
            // Handle template literals in JavaScript (backtick strings)
            bodyContent = bodyContent.replace(/`\.\.\/assets\//g, '`/assets/');
            bodyContent = bodyContent.replace(/`\.\.\/dist\//g, '`/dist/');
            bodyContent = bodyContent.replace(/`\.\.\/js\//g, '`/js/');
            bodyContent = bodyContent.replace(/`\.\/assets\//g, '`/assets/');
            bodyContent = bodyContent.replace(/`\.\/dist\//g, '`/dist/');
            bodyContent = bodyContent.replace(/`\.\/js\//g, '`/js/');

            // Convert all internal navigation links to hash routes
            // Home page links
            bodyContent = bodyContent.replace(/href="\.\.\/index\.html"/g, 'href="#/"');
            bodyContent = bodyContent.replace(/href="\.\/index\.html"/g, 'href="#/"');
            bodyContent = bodyContent.replace(/href="index\.html"/g, 'href="#/"');

            // About page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/about\.html"/g, 'href="#/about"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/about\.html"/g, 'href="#/about"');
            bodyContent = bodyContent.replace(/href="pages\/about\.html"/g, 'href="#/about"');
            bodyContent = bodyContent.replace(/href="about\.html"/g, 'href="#/about"');

            // Programmes page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/programmes\.html"/g, 'href="#/programmes"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/programmes\.html"/g, 'href="#/programmes"');
            bodyContent = bodyContent.replace(/href="pages\/programmes\.html"/g, 'href="#/programmes"');
            bodyContent = bodyContent.replace(/href="programmes\.html"/g, 'href="#/programmes"');

            // Publications page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/publications\.html"/g, 'href="#/publications"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/publications\.html"/g, 'href="#/publications"');
            bodyContent = bodyContent.replace(/href="pages\/publications\.html"/g, 'href="#/publications"');
            bodyContent = bodyContent.replace(/href="publications\.html"/g, 'href="#/publications"');

            // Team page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/team\.html"/g, 'href="#/team"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/team\.html"/g, 'href="#/team"');
            bodyContent = bodyContent.replace(/href="pages\/team\.html"/g, 'href="#/team"');
            bodyContent = bodyContent.replace(/href="team\.html"/g, 'href="#/team"');

            // Gallery page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/gallery\.html"/g, 'href="#/gallery"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/gallery\.html"/g, 'href="#/gallery"');
            bodyContent = bodyContent.replace(/href="pages\/gallery\.html"/g, 'href="#/gallery"');
            bodyContent = bodyContent.replace(/href="gallery\.html"/g, 'href="#/gallery"');



            // Blog page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/blog\.html"/g, 'href="#/blog"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/blog\.html"/g, 'href="#/blog"');
            bodyContent = bodyContent.replace(/href="pages\/blog\.html"/g, 'href="#/blog"');
            bodyContent = bodyContent.replace(/href="blog\.html"/g, 'href="#/blog"');

            // Shop page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/shop\.html"/g, 'href="#/shop"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/shop\.html"/g, 'href="#/shop"');
            bodyContent = bodyContent.replace(/href="pages\/shop\.html"/g, 'href="#/shop"');
            bodyContent = bodyContent.replace(/href="shop\.html"/g, 'href="#/shop"');

            // Contact page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/contact\.html"/g, 'href="#/contact"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/contact\.html"/g, 'href="#/contact"');
            bodyContent = bodyContent.replace(/href="pages\/contact\.html"/g, 'href="#/contact"');
            bodyContent = bodyContent.replace(/href="contact\.html"/g, 'href="#/contact"');

            // Privacy Policy page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/privacy-policy\.html"/g, 'href="#/privacy-policy"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/privacy-policy\.html"/g, 'href="#/privacy-policy"');
            bodyContent = bodyContent.replace(/href="pages\/privacy-policy\.html"/g, 'href="#/privacy-policy"');
            bodyContent = bodyContent.replace(/href="privacy-policy\.html"/g, 'href="#/privacy-policy"');

            // Safeguard page
            bodyContent = bodyContent.replace(/href="\.\.\/pages\/safeguard\.html"/g, 'href="#/safeguard"');
            bodyContent = bodyContent.replace(/href="\.\/pages\/safeguard\.html"/g, 'href="#/safeguard"');
            bodyContent = bodyContent.replace(/href="pages\/safeguard\.html"/g, 'href="#/safeguard"');
            bodyContent = bodyContent.replace(/href="safeguard\.html"/g, 'href="#/safeguard"');

            // Update page title
            const newTitle = doc.querySelector('title')?.textContent || 'F Lab';
            document.title = newTitle;

            // Replace body content
            document.body.innerHTML = bodyContent;

            // Update URL without reload (using history API for cleaner URLs)
            if (route !== '/') {
                window.history.pushState({ route }, '', '#' + route);
            } else {
                window.history.pushState({ route: '/' }, '', window.location.pathname);
            }

            // Reinitialize scripts and components
            this.reinitializePage();

            // Scroll to top
            window.scrollTo(0, 0);

        } catch (error) {
            console.error('Error loading page:', error);
            this.showError('Failed to load page. Please try again.');
        }
    }

    showLoading() {
        // Show a minimal loading overlay for route changes (not the main page loader)
        const routeLoader = document.createElement('div');
        routeLoader.id = 'route-loader';
        routeLoader.className = 'fixed inset-0 bg-white/60 backdrop-blur-sm z-[100] flex items-center justify-center';
        routeLoader.innerHTML = `
            <div class="text-center">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-yale-blue-500 border-t-transparent mb-4"></div>
                <p class="text-prussian-blue-800 font-medium">Loading page...</p>
            </div>
        `;
        document.body.appendChild(routeLoader);
    }

    hideLoading() {
        const routeLoader = document.getElementById('route-loader');
        if (routeLoader) {
            routeLoader.remove();
        }
    }

    showError(message) {
        this.hideLoading();
        const errorDiv = document.createElement('div');
        errorDiv.className = 'fixed top-4 right-4 bg-red-500 text-white p-4 rounded-lg shadow-lg z-50';
        errorDiv.textContent = message;
        document.body.appendChild(errorDiv);

        setTimeout(() => {
            errorDiv.remove();
        }, 5000);
    }

    reinitializePage() {
        // Hide loading
        this.hideLoading();

        // Re-run initialization functions from main.js
        if (typeof initializeNavigation === 'function') {
            initializeNavigation();
        }
        if (typeof initializeCarousel === 'function') {
            initializeCarousel();
        }
        if (typeof initializeMobileMenu === 'function') {
            initializeMobileMenu();
        }
        if (typeof initializeNavbarScroll === 'function') {
            initializeNavbarScroll();
        }
        if (typeof initializeTestimonialsSlider === 'function') {
            initializeTestimonialsSlider();
        }

        // Initialize gallery lightbox if on gallery page
        if (this.currentRoute === '/gallery') {
            setTimeout(() => {
                if (typeof window.initGallery === 'function') {
                    window.initGallery();
                }
            }, 100);
        }



        // Links are already intercepted via event delegation, no need to re-intercept
    }
}

// Initialize router when DOM is ready
let router;
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        router = new Router();
        // Export router instance for global access
        window.router = router;
    });
} else {
    router = new Router();
    // Export router instance for global access
    window.router = router;
}

