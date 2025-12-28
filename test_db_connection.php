<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Credentials to test (must match config/db.php)
$host = 'localhost';
$db   = 'flabbdco_frequencylab';
$user = 'flabbdco_admin';
$pass = 'flabbdco_frequencylab123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

echo "<h1>Database Connection Test</h1>";
echo "<p>Attempting to connect...</p>";
echo "<ul>";
echo "<li><strong>Host:</strong> $host</li>";
echo "<li><strong>Database:</strong> $db</li>";
echo "<li><strong>User:</strong> $user</li>";
echo "</ul>";

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
     echo "<h2 style='color:green'>SUCCESS! Connected successfully.</h2>";
     echo "<p>The credentials are correct. If your site is still not working, the issue might be:</p>";
     echo "<ul>";
     echo "<li>File paths or missing files.</li>";
     echo "<li>Your <code>config/db.php</code> might not match this file exactly.</li>";
     echo "</ul>";
} catch (\PDOException $e) {
     echo "<h2 style='color:red'>CONNECTION FAILED</h2>";
     echo "<p><strong>Error Message:</strong> " . $e->getMessage() . "</p>";
     echo "<hr>";
     echo "<h3>Check Checklist:</h3>";
     echo "<ol>";
     echo "<li><strong>Privileges:</strong> Did you add the user <code>$user</code> to the database <code>$db</code> in cPanel? (Go to MySQL Databases -> Add User to Database).</li>";
     echo "<li><strong>Ticks:</strong> Did you check 'ALL PRIVILEGES' when adding the user?</li>";
     echo "<li><strong>Password:</strong> Is the password definitely <code>$pass</code>? Try resetting it in cPanel to be sure.</li>";
     echo "</ol>";
}
?>
