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

// Fetch images from database with their programme title
$stmt = $pdo->query("
    SELECT g.*, p.title as programme_title 
    FROM gallery_images g
    LEFT JOIN programmes p ON g.programme_id = p.id 
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
            <?php
            // Fetch distinct titles that actually have images
            $prog_stmt = $pdo->query("
                SELECT DISTINCT p.title 
                FROM gallery_images g
                JOIN programmes p ON g.programme_id = p.id 
                WHERE p.title IS NOT NULL
                ORDER BY p.title ASC
            ");
            $programmes = $prog_stmt->fetchAll(PDO::FETCH_COLUMN);

            foreach ($programmes as $prog): 
            ?>
                <button class="filter-btn px-6 py-2.5 rounded-full text-sm font-semibold transition-all duration-300 bg-white text-slate-600 hover:bg-platinum-100 hover:text-yale-blue-700" data-filter="<?php echo htmlspecialchars($prog); ?>">
                    <?php echo htmlspecialchars($prog); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Masonry Grid -->
        <div class="columns-1 md:columns-2 lg:columns-3 gap-6 space-y-6" id="gallery-grid">
            <?php foreach ($gallery_items as $item): ?>
                <div class="gallery-item break-inside-avoid group relative rounded-2xl overflow-hidden cursor-zoom-in shadow-md hover:shadow-xl transition-all duration-500 bg-white" 
                     data-category="<?php echo htmlspecialchars($item['programme_title'] ?? 'Other'); ?>"
                     data-title="<?php echo htmlspecialchars($item['title']); ?>"
                     data-description="<?php echo htmlspecialchars($item['description']); ?>"
                     data-programme="<?php echo htmlspecialchars($item['programme_title'] ?? 'Other'); ?>">
                    <img src="../<?php echo htmlspecialchars($item['image_path']); ?>" 
                         alt="<?php echo htmlspecialchars($item['title']); ?>" 
                         class="w-full h-auto object-cover transform duration-700 group-hover:scale-110"
                         loading="lazy">
                    
                    <!-- Overlay (Tint only) -->
                    <div class="absolute inset-0 bg-gradient-to-t from-prussian-blue-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- No Results Message -->
        <div id="no-results" class="hidden text-center py-20">
            <div class="text-6xl mb-4">📷</div>
            <h3 class="text-2xl font-bold text-slate-700 mb-2">No photos found</h3>
            <p class="text-slate-500">Try selecting a different programme.</p>
        </div>
    </div>
</main>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] bg-prussian-blue-950/95 backdrop-blur-md hidden opacity-0 transition-opacity duration-300 flex items-center justify-center p-4">
    <button id="lightbox-close" class="absolute top-6 right-6 text-white/50 hover:text-white transition-colors p-2 z-[110]">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
    
    <div class="max-w-6xl w-full flex items-center justify-center">
        <div class="relative w-full max-h-[90vh] flex items-center justify-center">
            <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl transition-transform duration-500">
        </div>
    </div>
</div>

<script>
// Use global initialization to support both direct load and SPA navigation
if (typeof initializeDynamicGallery === 'function') {
    initializeDynamicGallery();
}
</script>

<?php include '../includes/footer.php'; ?>

</body>
</html>
