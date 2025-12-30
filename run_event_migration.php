<?php
/**
 * Event Schema Migration Runner
 */

require_once __DIR__ . '/config/db.php';

try {
    // Read and execute the migration SQL
    $sql = file_get_contents(__DIR__ . '/database/events_schema_update.sql');
    
    if ($sql === false) {
        throw new Exception("Could not read schema file.");
    }

    // Split SQL by semicolon so we can execute statements individually if needed, 
    // but PDO->exec can handle multiple statements if configured (MySQL usually does).
    // However, the prepared statement logic in SQL usually requires being run directly in a client or carefully via PHP.
    // Let's try running it as a block.
    $pdo->exec($sql);
    
    echo "✅ Migration successful! The gallery_events table has been processed.\n";
    
} catch (Exception $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
