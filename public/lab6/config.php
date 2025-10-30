<?php
session_start();

define('DB_HOST', '127.0.0.1');
define('DB_USER', 'started-user');
define('DB_PASS', 'started-password');
define('DB_NAME', 'started');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>