<?php
// Database configuration template
// Copy this file to db.php and update with your actual database credentials

$host = 'localhost';
$db   = 'flabbdco_flabdb';
$user = 'flabbdco_flabuser';
$pass = 'C6YBaF~0!Z6zG^$^';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
     error_log($e->getMessage());
     die("A database error occurred. Please try again later.");
}
?>
