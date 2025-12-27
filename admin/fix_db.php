<?php
require_once __DIR__ . '/../config/db.php';

try {
    echo "Checking 'users' table schema...\n";
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);

    if (in_array('email', $columns)) {
        echo "Column 'email' ALREADY EXISTS.\n";
    } else {
        echo "Column 'email' is MISSING. Adding it now...\n";
        $pdo->exec("ALTER TABLE users ADD COLUMN email VARCHAR(100) UNIQUE AFTER username");
        echo "Column 'email' ADDED SUCCESSFULLY.\n";
    }
    
    // Verify again
    $stmt = $pdo->query("DESCRIBE users");
    $columns = $stmt->fetchAll(PDO::FETCH_COLUMN);
    echo "Current Columns: " . implode(", ", $columns) . "\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
