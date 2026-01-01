<?php
/**
 * Database Migration Runner
 * 
 * Run this script to bring the database schema up to date.
 * Usage:
 * - Browser: Visit http://localhost/f_lab/migrate.php
 * - CLI: php migrate.php
 */

header('Content-Type: text/plain');

require_once __DIR__ . '/config/db.php';
require_once __DIR__ . '/includes/MigrationManager.php';

// Ensure we have a PDO instance from db.php (which assigns it to $pdo)
if (!isset($pdo) || !$pdo) {
    die("❌ Error: Could not connect to database. Check config/db.php.\n");
}

echo "Starting Database Migration...\n";
echo "------------------------------\n";

$migrationsDir = __DIR__ . '/database/migrations';
$manager = new MigrationManager($pdo, $migrationsDir);

try {
    $manager->migrate();
} catch (Exception $e) {
    echo "❌ System Error: " . $e->getMessage() . "\n";
}

echo "------------------------------\n";
?>
