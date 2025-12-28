<?php
/**
 * Database Migration Runner
 * Run this file once to create the contact_messages table
 */

require_once __DIR__ . '/config/db.php';

try {
    // Read and execute the migration SQL
    $sql = file_get_contents(__DIR__ . '/sql/contact_messages_migration.sql');
    
    $pdo->exec($sql);
    
    echo "✅ Migration successful! The contact_messages table has been created.\n";
    echo "You can now start receiving and managing contact form submissions.\n";
    
} catch (PDOException $e) {
    echo "❌ Migration failed: " . $e->getMessage() . "\n";
    exit(1);
}
?>
