<?php
session_start();

// Для MAMP
define('DB_HOST', '3306');
define('DB_USER', 'root');
define('DB_PASS', 'root');  // MAMP зазвичай використовує 'root'
define('DB_NAME', 'users_db');

try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "✅ Успіх з MAMP налаштуваннями!";
} catch(PDOException $e) {
    echo "❌ Помилка: " . $e->getMessage();
}
?>