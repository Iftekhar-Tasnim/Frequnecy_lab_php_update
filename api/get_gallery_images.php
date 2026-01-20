<?php
header('Content-Type: application/json');
require_once '../config/db.php';
require_once '../includes/CacheManager.php';

// Initialize cache
$cache = new CacheManager();

try {
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 12;
    $category = isset($_GET['category']) ? $_GET['category'] : 'all';
    $offset = ($page - 1) * $limit;

    // Generate cache key based on request parameters
    $cacheKey = "gallery_p{$page}_l{$limit}_c{$category}";
    
    // Try to get from cache
    $cachedData = $cache->get($cacheKey);
    if ($cachedData !== null) {
        // Return cached response
        echo json_encode($cachedData);
        exit;
    }

    // Build Query
    $sql = "SELECT g.*, p.title as programme_title 
            FROM gallery_images g
            LEFT JOIN programmes p ON g.programme_id = p.id";
    
    $params = [];
    
    if ($category !== 'all') {
        $sql .= " WHERE p.title = :category";
        $params[':category'] = $category;
    }
    
    $sql .= " ORDER BY g.upload_date DESC LIMIT :limit OFFSET :offset";
    
    // Bind numeric params separately as PDO::PARAM_INT
    $stmt = $pdo->prepare($sql);
    foreach ($params as $key => $val) {
        $stmt->bindValue($key, $val);
    }
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Generate HTML
    $html = '';
    foreach ($items as $item) {
        $progTitle = htmlspecialchars($item['programme_title'] ?? 'Other');
        $title = htmlspecialchars($item['title']);
        $desc = htmlspecialchars($item['description']);
        // Note: Image path in DB is relative to root (e.g. assets/...), 
        // and since this is loaded via AJAX into the root index page, we use it directly.
        $k_img = htmlspecialchars($item['image_path']); 
        
        $html .= <<<HTML
        <div class="gallery-item break-inside-avoid group relative rounded-2xl overflow-hidden cursor-zoom-in shadow-md hover:shadow-xl transition-all duration-500 bg-white" 
             data-category="$progTitle"
             data-title="$title"
             data-description="$desc"
             data-programme="$progTitle">
            <img src="$k_img" 
                 alt="$title" 
                 class="w-full h-auto object-cover transform duration-700 group-hover:scale-110"
                 loading="lazy">
            
            <div class="absolute inset-0 bg-gradient-to-t from-prussian-blue-950/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
            </div>
        </div>
HTML;
    }

    $response = [
        'status' => 'success',
        'html' => $html,
        'count' => count($items),
        'has_more' => count($items) === $limit
    ];
    
    // Store in cache (1 hour TTL)
    $cache->set($cacheKey, $response, 3600);
    
    echo json_encode($response);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

