/**
 * F Lab Gallery Functionality
 * Handles image rendering, grid layout (Classic Design), and lightbox interactions
 */

// Image data source - Based on assets/gallery contents
const galleryImages = [
    // Using filenames found in assets/gallery
    'IMG_2149.jpg', 'IMG_2180.jpg', 'IMG_2228.jpg', 'IMG_2231.jpg', 'IMG_2235.jpg',
    'IMG_2238.jpg', 'IMG_2276.jpg', 'IMG_2281.jpg', 'IMG_2283.jpg', 'IMG_2342.jpg',
    'IMG_2366.jpg', 'IMG_2374.jpg', 'IMG_2571.jpg', 'IMG_2581.jpg', 'IMG_2673.jpg',
    'IMG_2686.jpg', 'IMG_2749.jpg', 'IMG_9101.jpg', 'IMG_9115.jpg', 'IMG_9371.jpg',
    'IMG_9492.jpg', 'IMG_9608.jpg', 'IMG_9613.jpg', 'IMG_9619.jpg', 'IMG_9655.jpg',
    'IMG_9687.jpg', 'IMG_9705.jpg', 'IMG_9715.jpg', 'IMG_9722.jpg', 'IMG_9724.jpg',
    'IMG_9727.jpg', 'IMG_9739.jpg',
    // Numbered images
    'image3.jpg', 'image4.jpg', 'image5.jpg', 'image8.jpg', 'image9.jpg',
    'image10.jpg', 'image12.jpg', 'image13.jpg', 'image14.jpg', 'image15.jpg',
    'image16.jpg', 'image19.jpg', 'image22.jpg', 'image23.jpg', 'image24.jpg',
    'image25.jpg'
];

// State
const ITEMS_PER_LOAD = 12;
let visibleCount = ITEMS_PER_LOAD;
let currentImageIndex = 0;
let filteredImages = [...galleryImages]; // For search functionality

/**
 * Initialize Gallery
 * Called by router or auto-init
 */
window.initGallery = function () {
    const galleryGrid = document.getElementById('gallery-grid');
    if (!galleryGrid) return;

    // Reset state
    visibleCount = ITEMS_PER_LOAD;

    // Initial Render
    filterGallery('');
    setupSearch();
    setupLightbox();

    // Setup Load More
    const loadMoreBtn = document.getElementById('load-more-btn');
    if (loadMoreBtn) {
        loadMoreBtn.onclick = () => {
            visibleCount += ITEMS_PER_LOAD;
            updateGalleryView();
        };
    }
};

/**
 * Setup Search Filter
 */
function setupSearch() {
    const searchInput = document.getElementById('search-input');
    if (searchInput) {
        searchInput.addEventListener('input', (e) => {
            filterGallery(e.target.value);
        });
    }
}

/**
 * Filter and Update Gallery View
 */
function filterGallery(query) {
    const lowerQuery = query.toLowerCase();
    filteredImages = galleryImages.filter(img =>
        img.toLowerCase().includes(lowerQuery)
    );

    // Reset visibility on search
    visibleCount = ITEMS_PER_LOAD;
    updateGalleryView();
}

/**
 * Update the gallery view based on filtered images and visible count
 */
function updateGalleryView() {
    const galleryGrid = document.getElementById('gallery-grid');
    const emptyState = document.getElementById('empty-state');
    const galleryCount = document.getElementById('gallery-count');
    const loadMoreBtn = document.getElementById('load-more-btn');

    if (!galleryGrid) return;

    // Update count (if element exists)
    if (galleryCount) galleryCount.textContent = filteredImages.length;

    // Show/Hide Empty State
    if (filteredImages.length === 0) {
        galleryGrid.classList.add('hidden');
        if (emptyState) emptyState.classList.remove('hidden');
        if (loadMoreBtn) loadMoreBtn.classList.add('hidden');
    } else {
        galleryGrid.classList.remove('hidden');
        if (emptyState) emptyState.classList.add('hidden');

        // Render visible slice
        const imagesToDisplay = filteredImages.slice(0, visibleCount);
        renderGallery(galleryGrid, imagesToDisplay);

        // Handle button visibility
        if (loadMoreBtn) {
            if (visibleCount >= filteredImages.length) {
                loadMoreBtn.parentElement.classList.add('hidden');
            } else {
                loadMoreBtn.parentElement.classList.remove('hidden');
            }
        }
    }
}

/**
 * Render images into the grid
 * Matches the CSS structure of the "Old Gallery" design
 */
function renderGallery(container, images) {
    const existingItems = container.querySelectorAll('.gallery-item');
    const existingFilenames = Array.from(existingItems).map(item => {
        const img = item.querySelector('img');
        return img ? img.getAttribute('src').split('/').pop() : null;
    });

    // Check if we are just appending to the current view (Sequential)
    const isSequentialAppend = images.length > existingItems.length &&
        images.slice(0, existingItems.length).every((file, i) => file === existingFilenames[i]);

    if (!isSequentialAppend) {
        container.innerHTML = '';
    }

    images.forEach((filename, index) => {
        // Skip already rendered items if we are appending
        if (isSequentialAppend && index < existingItems.length) return;

        const originalIndex = galleryImages.indexOf(filename);
        const item = document.createElement('div');

        // Dynamic Bento Spans based on index
        // Pattern repeats every 12 items for variety
        const layoutIndex = index % 12;
        let spanClass = '';
        if (layoutIndex === 1) spanClass = 'md:col-span-2';
        else if (layoutIndex === 3) spanClass = 'md:row-span-2';
        else if (layoutIndex === 6) spanClass = 'md:col-span-2 md:row-span-2';
        else if (layoutIndex === 9) spanClass = 'md:col-span-2';

        item.className = `gallery-item group relative overflow-hidden rounded-2xl h-full w-full cursor-pointer bg-slate-50 border border-slate-100 transition-all duration-700 hover:-translate-y-2 hover:scale-[1.01] hover:shadow-2xl opacity-0 translate-y-10 ${spanClass}`;
        item.onclick = () => openLightbox(originalIndex);

        const displayName = filename.replace(/\.(jpg|png|jpeg)$/i, '').replace(/[_-]/g, ' ');

        item.innerHTML = `
            <img src="../assets/gallery/${filename}" 
                 alt="${displayName}" 
                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 opacity-0"
                 onload="this.classList.add('opacity-100')"
                 onerror="this.src='../assets/logo/F_Lab logo Badge.png'; this.classList.add('opacity-100')"
                 loading="lazy">
            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500 flex flex-col justify-end p-6 z-10">
                <h3 class="text-white text-lg font-bold font-['Exo_2'] transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500">${displayName}</h3>
                <p class="text-white/80 text-sm transform translate-y-4 group-hover:translate-y-0 transition-transform duration-500 delay-75">Image ${originalIndex + 1}</p>
            </div>
        `;

        container.appendChild(item);

        // Staggered reveal for new items
        const batchIndex = isSequentialAppend ? index - existingItems.length : index;
        const delay = batchIndex * 60;

        setTimeout(() => {
            item.classList.remove('opacity-0', 'translate-y-10');
            item.classList.add('opacity-100', 'translate-y-0');
        }, delay);
    });
}

/**
 * Setup Lightbox Elements and Event Listeners
 */
function setupLightbox() {
    const lightbox = document.getElementById('lightbox');
    const closeBtn = document.getElementById('lightbox-close');
    const nextBtn = document.getElementById('lightbox-next');
    const prevBtn = document.getElementById('lightbox-prev');

    if (!lightbox) return;

    // Close
    closeBtn?.addEventListener('click', closeLightbox);

    // Navigation
    nextBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        nextImage();
    });

    prevBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        prevImage();
    });

    // Close on background click
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });

    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        if (!lightbox.classList.contains('hidden')) {
            if (e.key === 'Escape') closeLightbox();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'ArrowRight') nextImage();
        }
    });
}

window.openLightbox = function (index) {
    currentImageIndex = index;
    const lightbox = document.getElementById('lightbox');
    if (!lightbox) return;

    updateLightboxImage();

    // Tailwind Transition
    lightbox.classList.remove('hidden', 'opacity-0', 'pointer-events-none');
    lightbox.classList.add('flex', 'opacity-100', 'pointer-events-auto');

    const img = lightbox.querySelector('img');
    if (img) {
        img.classList.remove('scale-95');
        img.classList.add('scale-100');
    }

    document.body.style.overflow = 'hidden';
};

window.closeLightbox = function () {
    const lightbox = document.getElementById('lightbox');
    if (!lightbox) return;

    const img = lightbox.querySelector('img');
    if (img) {
        img.classList.remove('scale-100');
        img.classList.add('scale-95');
    }

    lightbox.classList.remove('opacity-100', 'pointer-events-auto');
    lightbox.classList.add('opacity-0', 'pointer-events-none');

    setTimeout(() => {
        lightbox.classList.add('hidden');
        lightbox.classList.remove('flex');
        document.body.style.overflow = '';
    }, 300);
};

window.nextImage = function () {
    currentImageIndex = (currentImageIndex + 1) % galleryImages.length;
    updateLightboxImage();
};

window.prevImage = function () {
    currentImageIndex = (currentImageIndex - 1 + galleryImages.length) % galleryImages.length;
    updateLightboxImage();
};

function updateLightboxImage() {
    const img = document.getElementById('lightbox-image');
    const info = document.getElementById('lightbox-info');

    if (img) {
        // Quick fade effect
        img.style.opacity = '0.5';
        setTimeout(() => {
            img.src = `../assets/gallery/${galleryImages[currentImageIndex]}`;
            img.onload = () => { img.style.opacity = '1'; };
        }, 150);
    }

    if (info) {
        info.textContent = `Image ${currentImageIndex + 1} of ${galleryImages.length}`;
    }
}

// Auto-initialize if direct load
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        if (document.getElementById('gallery-grid')) {
            window.initGallery();
        }
    });
} else {
    // If we're already loaded (common in SPAs), check immediately
    if (document.getElementById('gallery-grid')) {
        // short delay ensuring DOM is painted
        setTimeout(window.initGallery, 50);
    }
}
