<!DOCTYPE html>
<html lang="en" data-theme="f-lab">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery | Frequency Lab</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-white font-sans selection:bg-yale-blue-500 selection:text-white">

<?php include '../includes/navbar.php'; ?>



<?php
require_once '../config/db.php';

// Fetch images from database with their programme type
$stmt = $pdo->query("
    SELECT g.*, p.type as event_category 
    FROM gallery_images g
    JOIN programmes p ON g.programme_id = p.id 
    ORDER BY g.upload_date DESC
");
$gallery_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<main class="pt-32 pb-24 min-h-screen bg-platinum-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="text-center space-y-8 mb-16">
            <div class="inline-block px-4 py-1.5 bg-yale-blue-100/50 text-yale-blue-700 rounded-full text-sm font-bold tracking-wider uppercase backdrop-blur-sm">
                Our Memories
            </div>
            <h1 class="text-5xl md:text-7xl font-bold text-prussian-blue-900 font-exo">
                Frequency in <br><span class="text-transparent bg-clip-text bg-gradient-to-r from-yale-blue-600 to-fresh-sky-500">Action</span>
            </h1>
            <p class="text-xl text-platinum-600 max-w-3xl mx-auto leading-relaxed">
                Explore the vibrant moments from our workshops, hackathons, and community gatherings.
            </p>
        </div>

        <!-- Filter Buttons -->
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <button class="filter-btn active px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-yale-blue-600 text-white shadow-lg shadow-yale-blue-600/20 hover:shadow-yale-blue-600/40" data-filter="all">
                All Moments
            </button>
            <button class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-slate-600 hover:bg-platinum-100 hover:text-yale-blue-700" data-filter="workshops">
                Workshops
            </button>
            <button class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-slate-600 hover:bg-platinum-100 hover:text-yale-blue-700" data-filter="events">
                Events
            </button>
            <button class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-slate-600 hover:bg-platinum-100 hover:text-yale-blue-700" data-filter="competitions">
                Competitions
            </button>
            <button class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-slate-600 hover:bg-platinum-100 hover:text-yale-blue-700" data-filter="community">
                Community
            </button>
        </div>

        <!-- Masonry Grid -->
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6" id="gallery-grid">
            <?php foreach ($gallery_items as $item): ?>
                <div class="gallery-item break-inside-avoid group relative rounded-2xl overflow-hidden cursor-zoom-in shadow-md hover:shadow-xl transition-all duration-500 bg-white" 
                     data-category="<?php echo htmlspecialchars($item['event_category']); ?>">
                    <img src="../<?php echo htmlspecialchars($item['image_path']); ?>" 
                         alt="<?php echo htmlspecialchars($item['title']); ?>" 
                         class="w-full h-auto object-cover transform duration-700 group-hover:scale-110"
                         loading="lazy">
                    
                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-prussian-blue-950/90 via-prussian-blue-900/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-6">
                        <span class="text-fresh-sky-400 text-xs font-bold tracking-wider uppercase mb-2">
                            <?php echo htmlspecialchars($item['event_category']); ?>
                        </span>
                        <h3 class="text-white text-xl font-bold font-exo mb-1">
                            <?php echo htmlspecialchars($item['title']); ?>
                        </h3>
                        <p class="text-platinum-300 text-sm line-clamp-2">
                            <?php echo htmlspecialchars($item['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-20">
            <div class="text-6xl mb-4">📷</div>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">No photos found</h3>
            <p class="text-slate-500">Try selecting a different category.</p>
        </div>
    </div>
</main>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-prussian-blue-950/95 backdrop-blur-md hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
    <button id="lightbox-close" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors p-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    
    <div class="max-w-6xl w-full flex flex-col md:flex-row gap-8 items-center justify-center">
        <div class="relative w-full md:w-3/4 aspect-[4/3] md:aspect-auto md:h-[80vh] flex items-center justify-center">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg shadow-2xl">
        </div>
        <div class="w-full md:w-1/4 text-white p-4 md:p-0">
            <span id="lightbox-category" class="inline-block px-3 py-1 bg-yale-blue-600/50 border border-yale-blue-500/50 rounded-full text-xs font-bold tracking-wider uppercase mb-4 text-fresh-sky-300"></span>
            <h2 id="lightbox-title" class="text-3xl font-bold font-exo mb-4"></h2>
            <p id="lightbox-desc" class="text-platinum-300 leading-relaxed"></p>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Filter Logic
    const filterBtns = document.querySelectorAll('.filter-btn');
    const galleryItems = document.querySelectorAll('.gallery-item');
    const noResults = document.getElementById('no-results');

    filterBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            // Remove active class from all
            filterBtns.forEach(b => {
                b.classList.remove('bg-yale-blue-600', 'text-white', 'shadow-lg');
                b.classList.add('bg-white', 'text-slate-600');
            });
            // Add active class to clicked
            btn.classList.remove('bg-white', 'text-slate-600');
            btn.classList.add('bg-yale-blue-600', 'text-white', 'shadow-lg');

            const filterValue = btn.getAttribute('data-filter');
            let visibleCount = 0;

            galleryItems.forEach(item => {
                if (filterValue === 'all' || item.getAttribute('data-category') === filterValue) {
                    item.classList.remove('hidden');
                    // Add animation class if needed
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                    visibleCount++;
                } else {
                    item.classList.add('hidden');
                    item.style.opacity = '0';
                    item.style.transform = 'scale(0.95)';
                }
            });

            if (visibleCount === 0) {
                noResults.classList.remove('hidden');
            } else {
                noResults.classList.add('hidden');
            }
        });
    });

    // Lightbox Logic
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    const lightboxDesc = document.getElementById('lightbox-desc');
    const lightboxCat = document.getElementById('lightbox-category');
    const closeBtn = document.getElementById('lightbox-close');

    galleryItems.forEach(item => {
        item.addEventListener('click', () => {
            const img = item.querySelector('img');
            const title = item.querySelector('h3').textContent.trim();
            const desc = item.querySelector('p').textContent.trim();
            const cat = item.querySelector('span').textContent.trim();
            
            lightboxImg.src = img.src;
            lightboxTitle.textContent = title;
            lightboxDesc.textContent = desc;
            lightboxCat.textContent = cat;

            lightbox.classList.remove('hidden');
            // Small delay to allow display:block to apply before opacity transition
            setTimeout(() => {
                lightbox.classList.remove('opacity-0');
            }, 10);
            document.body.style.overflow = 'hidden';
        });
    });

    const closeLightbox = () => {
        lightbox.classList.add('opacity-0');
        setTimeout(() => {
            lightbox.classList.add('hidden');
        }, 300);
        document.body.style.overflow = '';
    };

    closeBtn.addEventListener('click', closeLightbox);
    lightbox.addEventListener('click', (e) => {
        if (e.target === lightbox) closeLightbox();
    });
    
    // Close on Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') closeLightbox();
    });
});
</script>

<?php include '../includes/footer.php'; ?>

</body>
</html>
