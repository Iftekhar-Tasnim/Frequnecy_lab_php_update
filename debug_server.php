<?php
/**
 * Frequency Lab - Server Diagnostic Tool
 * Upload this file to your public_html folder and visit it in your browser:
 * https://yourdomain.com/debug_server.php
 */

error_reporting(E_ALL);
ini_set('display_errors', 1);

echo "<!DOCTYPE html><html><head><title>F-Lab Diagnostics</title>";
echo "<style>body{font-family:sans-serif;max-width:800px;margin:2rem auto;padding:1rem;} .success{color:green;font-weight:bold;} .error{color:red;font-weight:bold;} .info{color:blue;} pre{background:#f4f4f4;padding:10px;overflow-x:auto;}</style>";
echo "</head><body>";
echo "<h1>Server Diagnostics</h1>";

// 1. Check File Locations
echo "<h2>1. File System Check</h2>";
echo "<ul>";
echo "<li>Current Directory: " . __DIR__ . "</li>";

$configFile = __DIR__ . '/config/db.php';
if (file_exists($configFile)) {
    echo "<li class='success'>[OK] config/db.php found.</li>";
} else {
    echo "<li class='error'>[ERROR] config/db.php NOT found at: $configFile</li>";
}

$processFile = __DIR__ . '/process_contact.php';
if (file_exists($processFile)) {
    echo "<li class='success'>[OK] process_contact.php found.</li>";
} else {
    echo "<li class='error'>[ERROR] process_contact.php NOT found at: $processFile</li>";
}
echo "</ul>";

// 2. Database Connection Test
echo "<h2>2. Database Connection Test</h2>";
try {
    if (file_exists($configFile)) {
        require_once $configFile;
        
        if (isset($pdo) && $pdo instanceof PDO) {
            echo "<div class='success'>[OK] Database connection established via config/db.php.</div>";
            
            // Check Server Version
            echo "<p class='info'>MySQL Version: " . $pdo->getAttribute(PDO::ATTR_SERVER_VERSION) . "</p>";
            
            // Check Table
            $stmt = $pdo->query("SHOW TABLES LIKE 'contact_messages'");
            if ($stmt->rowCount() > 0) {
                echo "<div class='success'>[OK] Table 'contact_messages' exists.</div>";
                
                // Show Columns
                echo "<h3>Table Structure:</h3><pre>";
                $columns = $pdo->query("DESCRIBE contact_messages")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($columns as $col) {
                    echo $col['Field'] . " (" . $col['Type'] . ")\n";
                }
                echo "</pre>";
                
            } else {
                echo "<div class='error'>[ERROR] Table 'contact_messages' DOES NOT exist. You need to migrate your database.</div>";
            }
            
        } else {
            echo "<div class='error'>[ERROR] \$pdo variable not found or invalid after including config/db.php.</div>";
        }
    } else {
        echo "<div class='error'>[SKIPPED] Cannot test DB because config file is missing.</div>";
    }
} catch (Exception $e) {
    echo "<div class='error'>[EXCEPTION] Database Error: " . htmlspecialchars($e->getMessage()) . "</div>";
}

// 3. PHP Environment
echo "<h2>3. PHP Environment</h2>";
echo "<ul>";
echo "<li>PHP Version: " . phpversion() . "</li>";
echo "<li>Server Software: " . $_SERVER['SERVER_SOFTWARE'] . "</li>";
echo "<li>Remote Address: " . $_SERVER['REMOTE_ADDR'] . "</li>";
echo "</ul>";

echo "</body></html>";
?>
