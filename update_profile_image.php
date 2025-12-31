<?php
require_once 'config/db.php';

try {
    // 1. Find the profile (title likely contains 'Tahmidul Kabir')
    $stmt = $pdo->prepare("SELECT id, title FROM publications WHERE type = 'profile' LIMIT 1");
    $stmt->execute();
    $profile = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($profile) {
        echo "Found profile: " . $profile['title'] . " (ID: " . $profile['id'] . ")\n";

        // 2. Update the image URL
        // Path should be relative to the web root or logical path. 
        // Based on other code, it seems paths like 'assets/...' are used.
        $new_image_path = '../assets/team/tahmidul_kabir.png'; // publications.php is in pages/, so it needs ../ 
        // FAIL: The database usually stores the path relative to the root or absolute? 
        // Looking at navbar, it uses $base . 'assets/...'
        // In publications.php: <img src="<?php echo htmlspecialchars($pub['image_url']); ?>" ...
        // If the DB stores 'assets/team/tahmidul_kabir.png', and we are in pages/publications.php, we need '../assets/...'
        // BUT, admin might expect consistent paths. 
        // Let's check how other images are stored. 
        // Actually, looking at publications.php line 140: <img src="<?php echo htmlspecialchars($pub['image_url']); ?>"
        // If I store '../assets/team/tahmidul_kabir.png' it will work for pages/publications.php.
        // But if I display it on home page (root), it will break.
        // Best practice: store 'assets/team/tahmidul_kabir.png' and handle the ../ in the view logic or ensure view uses absolute path helper.
        // However, looking at publications.php: it strictly echos the DB value.
        // So for now, I should probably store it as `../assets/team/tahmidul_kabir.png` OR fix the view to prepend $base.
        // The view currently does NOT prepend base to `$pub['image_url']`.
        // So I must put the relative path from `pages/` into the DB: `../assets/team/tahmidul_kabir.png`
        
        $updateStmt = $pdo->prepare("UPDATE publications SET image_url = ? WHERE id = ?");
        $updateStmt->execute([$new_image_path, $profile['id']]);
        
        echo "Successfully updated profile image to: $new_image_path\n";
    } else {
        echo "No profile found.\n";
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
