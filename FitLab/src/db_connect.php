<?php
$dsn = 'mysql:host=127.0.0.1;port=3307;dbname=FitLab;charset=utf8mb4';
$username = 'root';
$password = ''; // default for XAMPP
$options = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
];

try {
    $connection = new PDO($dsn, $username, $password, $options);
    echo 'DB connected';
} catch (PDOException $e) {
    die("DB ERROR: " . $e->getMessage());
}
?>