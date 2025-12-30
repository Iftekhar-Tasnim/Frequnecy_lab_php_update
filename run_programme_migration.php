<?php
/**
 * Programme Schema Migration Runner
 */

require_once __DIR__ . '/config/db.php';

try {
    $sql = file_get_contents(__DIR__ . '/database/programmes_schema.sql');
    
    if ($sql === false) {
        throw new Exception("Could not read schema file.");
    }
    
    // Execute raw SQL
    // Splitting by command if necessary, but try direct exec for this block
    $pdo->exec($sql);
    
    echo "✅ Migration successful! The programmes table is ready.\n";
    
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
