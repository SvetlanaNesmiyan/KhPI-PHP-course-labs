<?php

session_start();

define('DB_HOST', 'http://localhost:6334');
define('DB_USER', 'testuser');
define('DB_PASS', '');
define('DB_NAME', 'users_db');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Помилка підключення до бази даних: " . $e->getMessage());
}
?>