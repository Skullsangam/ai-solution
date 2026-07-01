<?php
// config/db.php
// Database connection configuration using PDO

$host = 'localhost';
$db   = 'ai_solutions';
$user = 'root';
$pass = ''; // Standard default for local XAMPP
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
     // For safety, do not display full details to regular users in production.
     // But for local development we can display the message to help debug.
     die("Database connection failed: " . $e->getMessage());
}
?>
