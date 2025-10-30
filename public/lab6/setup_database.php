<?php
session_start();

echo "<h3>Створення бази даних і таблиці</h3>";

$connections = [
    ['host' => 'localhost', 'user' => 'root', 'pass' => ''],
    ['host' => 'localhost', 'user' => 'root', 'pass' => 'root'],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => ''],
    ['host' => '127.0.0.1', 'user' => 'root', 'pass' => 'root']
];

$success = false;

foreach ($connections as $conn) {
    try {
        $pdo = new PDO("mysql:host={$conn['host']};charset=utf8mb4", $conn['user'], $conn['pass']);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $pdo->exec("CREATE DATABASE IF NOT EXISTS users_db CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        $pdo->exec("USE users_db");

        $pdo->exec("
            CREATE TABLE IF NOT EXISTS users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                username VARCHAR(50) UNIQUE NOT NULL,
                email VARCHAR(100) UNIQUE NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
        ");

        $pdo->exec("
            INSERT IGNORE INTO users (username, email, password) 
            VALUES ('testuser', 'test@example.com', MD5('password123'))
        ");

        echo "✅ БАЗУ ДАНИХ СТВОРЕНО УСПІШНО!<br>";
        echo "Використано підключення: {$conn['user']}@{$conn['host']}<br>";
        echo "База даних: users_db<br>";
        echo "Таблиця: users<br>";

        $success = true;
        break;

    } catch(PDOException $e) {
        echo "❌ Не вдалося підключитися до {$conn['user']}@{$conn['host']}: " . $e->getMessage() . "<br>";
    }
}

if (!$success) {
    echo "<br><strong>Не вдалося створити базу даних. Можливі причини:</strong><br>";
    echo "1. MySQL не запущений<br>";
    echo "2. Неправильний пароль root<br>";
    echo "3. Проблеми з налаштуванням XAMPP<br>";
    echo "<br><strong>Рішення:</strong><br>";
    echo "- Перевірте, чи запущений MySQL в XAMPP<br>";
    echo "- Спробуйте запустити SQL через phpMyAdmin<br>";
    echo "- Перевстановіть XAMPP";
}
?>