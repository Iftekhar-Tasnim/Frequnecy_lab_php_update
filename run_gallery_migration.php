<?php
/**
 * Gallery Migration Runner
 */

require_once __DIR__ . '/config/db.php';

try {
    // Read and execute the migration SQL
    $sql = file_get_contents(__DIR__ . '/database/gallery_schema.sql');
    
    if ($sql === false) {
        throw new Exception("Could not read schema file.");
    }

    $pdo->exec($sql);
    
    echo "✅ Migration successful! The gallery_images table has been created.\n";
    
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
