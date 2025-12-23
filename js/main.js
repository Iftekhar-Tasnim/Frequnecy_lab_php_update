// Main JavaScript file for F Lab website

// Page Loader functionality - REMOVED
// All loader-related code has been commented out/removed
// If you need to restore the loader, uncomment the functions below

/*
let loaderInitialized = false;
let progressInterval = null;
let loaderHideTimeout = null;
let isInitialPageLoad = true;

function hidePageLoader() {
    // Loader removed
}

function ensureLoaderHidden() {
    // Loader removed
}

function initializePageLoader() {
    // Loader removed
}

function markInitialLoadComplete() {
    // Loader removed
}
*/

let isInitialPageLoad = true; // Keep for potential future use

function markInitialLoadComplete() {
    // Mark initial load complete (used for other features)
    setTimeout(() => {
        isInitialPageLoad = false;
    }, 100);
}

// Initialize on DOM ready
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
        // initializePageLoader(); // Loader removed
        initializeNavigation();
        initializeCarousel();
        initializeMobileMenu();
        initializeNavbarScroll();
        initializeTestimonialsSlider();
        markInitialLoadComplete();
    });
} else {
    // DOM is already ready
    // initializePageLoader(); // Loader removed
    initializeNavigation();
    initializeCarousel();
    initializeMobileMenu();
    initializeNavbarScroll();
    initializeTestimonialsSlider();
    markInitialLoadComplete();
}

// Navigation active state management
function initializeNavigation() {
    // Get current route from hash or pathname
    let currentRoute = window.location.hash.substring(1) || '/';
    if (currentRoute === '/' && window.location.pathname !== '/' && window.location.pathname !== '/index.html') {
        // Try to get route from pathname
        const pathname = window.location.pathname;
        if (pathname.includes('/pages/')) {
            const filename = pathname.split('/').pop();
            currentRoute = '/' + filename.replace('.html', '');
        } else if (pathname !== '/index.html' && pathname !== '/') {
            currentRoute = '/' + pathname.split('/').pop().replace('.html', '');
        }
    }

    const navLinks = document.querySelectorAll('.nav-link, .mobile-nav-link');

    navLinks.forEach(link => {
        const linkHref = link.getAttribute('href');
        // Remove active class first
        link.classList.remove('active');

        // Get route from link href
        let linkRoute = null;
        if (linkHref && linkHref.startsWith('#')) {
            linkRoute = linkHref.substring(1) || '/';
        } else if (linkHref) {
            // Convert file path to route
            if (linkHref === 'index.html' || linkHref === './index.html' || linkHref === '../index.html' || linkHref === '/') {
                linkRoute = '/';
            } else if (linkHref.includes('about')) {
                linkRoute = '/about';
            } else if (linkHref.includes('programmes')) {
                linkRoute = '/programmes';
            } else if (linkHref.includes('publications')) {
                linkRoute = '/publications';
            } else if (linkHref.includes('team')) {
                linkRoute = '/team';
            } else if (linkHref.includes('gallery')) {
                linkRoute = '/gallery';
            } else if (linkHref.includes('blog')) {
                linkRoute = '/blog';
            } else if (linkHref.includes('shop')) {
                linkRoute = '/shop';
            } else if (linkHref.includes('contact')) {
                linkRoute = '/contact';
            } else if (linkHref.includes('privacy-policy')) {
                linkRoute = '/privacy-policy';
            } else if (linkHref.includes('safeguard')) {
                linkRoute = '/safeguard';
            }
        }

        // Check if this link matches the current route
        if (linkRoute && linkRoute === currentRoute) {
            link.classList.add('active');
        }
    });
}

// Mobile menu toggle
function initializeMobileMenu() {
    const mobileMenuBtn = document.getElementById('mobile-menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');

    if (!mobileMenuBtn || !mobileMenu) {
        console.warn('Mobile menu elements not found');
        return;
    }

    // Remove any existing event listeners by cloning and replacing
    const newBtn = mobileMenuBtn.cloneNode(true);
    mobileMenuBtn.parentNode.replaceChild(newBtn, mobileMenuBtn);

    // Get fresh references after replacement
    const btn = document.getElementById('mobile-menu-btn');
    const menu = document.getElementById('mobile-menu');
    const icon = document.getElementById('menu-icon');
    const close = document.getElementById('close-icon');

    if (!btn || !menu) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        const isHidden = menu.classList.contains('hidden');

        if (isHidden) {
            menu.classList.remove('hidden');
            if (icon) icon.classList.add('hidden');
            if (close) close.classList.remove('hidden');
        } else {
            menu.classList.add('hidden');
            if (icon) icon.classList.remove('hidden');
            if (close) close.classList.add('hidden');
        }
    });

    // Close mobile menu when clicking on a link
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', function () {
            menu.classList.add('hidden');
            if (icon) icon.classList.remove('hidden');
            if (close) close.classList.add('hidden');
        });
    });
}

// Navbar scroll effect
function initializeNavbarScroll() {
    const navbar = document.getElementById('navbar');
    if (!navbar) return;

    let lastScroll = 0;

    window.addEventListener('scroll', function () {
        const currentScroll = window.pageYOffset;

        if (currentScroll > 50) {
            navbar.classList.add('navbar-scrolled');
        } else {
            navbar.classList.remove('navbar-scrolled');
        }

        lastScroll = currentScroll;
    });
}

// Carousel functionality
function initializeCarousel() {
    const carousel = document.querySelector('.carousel');
    if (!carousel) return;

    const slides = carousel.querySelectorAll('.carousel-item');
    const totalSlides = slides.length;
    let currentSlide = 0;
    let autoPlayInterval = null;
    let isUserInteracting = false;

    // Function to scroll to a specific slide
    function goToSlide(slideIndex) {
        if (slideIndex < 0 || slideIndex >= totalSlides) return;

        currentSlide = slideIndex;
        const slideWidth = carousel.offsetWidth;
        carousel.scrollTo({
            left: slideWidth * slideIndex,
            behavior: 'smooth'
        });
        updateCarouselNavigation();
    }

    // Update carousel navigation
    function updateCarouselNavigation() {
        // Update indicator buttons
        const indicators = document.querySelectorAll('.carousel-indicator');
        if (!indicators.length) return;

        indicators.forEach((indicator, index) => {
            if (index === currentSlide) {
                indicator.classList.add('bg-white', 'bg-opacity-80', 'ring-2', 'ring-white', 'ring-opacity-80', 'scale-110');
                indicator.classList.remove('bg-opacity-50', 'ring-0', 'scale-100');
                indicator.setAttribute('aria-current', 'true');
            } else {
                indicator.classList.remove('bg-opacity-80', 'ring-2', 'ring-white', 'ring-opacity-80', 'scale-110');
                indicator.classList.add('bg-white', 'bg-opacity-50', 'ring-0', 'scale-100');
                indicator.removeAttribute('aria-current');
            }
        });
    }

    // Auto-play carousel
    function startAutoPlay() {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(() => {
            if (!isUserInteracting) {
                currentSlide = (currentSlide + 1) % totalSlides;
                goToSlide(currentSlide);
            }
        }, 5000); // Change slide every 5 seconds
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Handle indicator button clicks
    const indicators = document.querySelectorAll('.carousel-indicator');
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function (e) {
            e.preventDefault();
            isUserInteracting = true;
            goToSlide(index);
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000); // Reset after 6 seconds
        });
    });

    // Handle arrow button clicks
    const prevArrow = document.querySelector('.carousel-arrow-prev');
    const nextArrow = document.querySelector('.carousel-arrow-next');

    if (prevArrow) {
        prevArrow.addEventListener('click', function (e) {
            e.preventDefault();
            isUserInteracting = true;
            const prevSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            goToSlide(prevSlide);
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000);
        });
    }

    if (nextArrow) {
        nextArrow.addEventListener('click', function (e) {
            e.preventDefault();
            isUserInteracting = true;
            const nextSlide = (currentSlide + 1) % totalSlides;
            goToSlide(nextSlide);
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000);
        });
    }

    // Detect scroll position to update current slide
    carousel.addEventListener('scroll', function () {
        const slideWidth = carousel.offsetWidth;
        const scrollLeft = carousel.scrollLeft;
        const newSlide = Math.round(scrollLeft / slideWidth);
        if (newSlide !== currentSlide && newSlide >= 0 && newSlide < totalSlides) {
            currentSlide = newSlide;
            updateCarouselNavigation();
        }
    });

    // Pause auto-play on user interaction
    carousel.addEventListener('mouseenter', stopAutoPlay);
    carousel.addEventListener('mouseleave', startAutoPlay);
    carousel.addEventListener('touchstart', stopAutoPlay);
    carousel.addEventListener('touchend', function () {
        setTimeout(startAutoPlay, 3000);
    });

    // Initialize
    updateCarouselNavigation();
    startAutoPlay();
}

// Testimonials Slider functionality
function initializeTestimonialsSlider() {
    const slider = document.getElementById('testimonials-slider');
    if (!slider) return;

    const slides = slider.querySelectorAll('.testimonial-slide');
    const totalSlides = slides.length;
    const prevBtn = document.getElementById('testimonial-prev');
    const nextBtn = document.getElementById('testimonial-next');
    const indicators = document.querySelectorAll('.testimonial-indicator');

    let currentIndex = 0;
    let slidesPerView = 1;
    let autoPlayInterval = null;
    let isUserInteracting = false;

    // Calculate slides per view based on screen width
    function updateSlidesPerView() {
        const width = window.innerWidth;
        if (width >= 1024) {
            slidesPerView = 3;
        } else if (width >= 768) {
            slidesPerView = 2;
        } else {
            slidesPerView = 1;
        }
    }

    // Calculate max index
    function getMaxIndex() {
        return Math.max(0, totalSlides - slidesPerView);
    }

    // Update slider position
    function updateSliderPosition() {
        const slideWidth = slider.offsetWidth / slidesPerView;
        const offset = -(currentIndex * slideWidth);
        slider.style.transform = `translateX(${offset}px)`;
        updateIndicators();
    }

    // Update indicators
    function updateIndicators() {
        const maxIndex = getMaxIndex();
        const totalGroups = maxIndex + 1;

        indicators.forEach((indicator, index) => {
            if (index < totalGroups) {
                indicator.style.display = 'block';
                if (index === currentIndex) {
                    indicator.classList.remove('bg-platinum-300');
                    indicator.classList.add('bg-yale-blue-500');
                } else {
                    indicator.classList.remove('bg-yale-blue-500');
                    indicator.classList.add('bg-platinum-300');
                }
            } else {
                indicator.style.display = 'none';
            }
        });
    }

    // Go to specific slide
    function goToSlide(index) {
        const maxIndex = getMaxIndex();
        currentIndex = Math.max(0, Math.min(index, maxIndex));
        updateSliderPosition();
    }

    // Previous slide
    function prevSlide() {
        goToSlide(currentIndex - 1);
    }

    // Next slide
    function nextSlide() {
        const maxIndex = getMaxIndex();
        if (currentIndex < maxIndex) {
            goToSlide(currentIndex + 1);
        } else {
            goToSlide(0); // Loop back to start
        }
    }

    // Auto-play functionality
    function startAutoPlay() {
        if (autoPlayInterval) clearInterval(autoPlayInterval);
        autoPlayInterval = setInterval(() => {
            if (!isUserInteracting) {
                nextSlide();
            }
        }, 5000); // Change every 5 seconds
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    // Event listeners for navigation buttons
    if (prevBtn) {
        prevBtn.addEventListener('click', function () {
            isUserInteracting = true;
            prevSlide();
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000);
        });
    }

    if (nextBtn) {
        nextBtn.addEventListener('click', function () {
            isUserInteracting = true;
            nextSlide();
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000);
        });
    }

    // Event listeners for indicators
    indicators.forEach((indicator, index) => {
        indicator.addEventListener('click', function () {
            isUserInteracting = true;
            goToSlide(index);
            setTimeout(() => {
                isUserInteracting = false;
            }, 6000);
        });
    });

    // Pause auto-play on hover
    slider.addEventListener('mouseenter', stopAutoPlay);
    slider.addEventListener('mouseleave', startAutoPlay);

    // Handle window resize
    let resizeTimeout;
    window.addEventListener('resize', function () {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            const oldSlidesPerView = slidesPerView;
            updateSlidesPerView();
            if (oldSlidesPerView !== slidesPerView) {
                currentIndex = 0; // Reset to first slide on breakpoint change
            }
            updateSliderPosition();
        }, 250);
    });

    // Initialize
    updateSlidesPerView();
    updateSliderPosition();
    startAutoPlay();
}

