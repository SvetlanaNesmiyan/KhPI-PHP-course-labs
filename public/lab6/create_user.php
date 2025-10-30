<?php
// create_user.php - запустіть цей файл один раз
try {
    // Спочатку спробуємо підключитися без пароля
    $pdo = new PDO("mysql:host=127.0.0.1;charset=utf8mb4", 'root', '');

    // Створюємо базу даних
    $pdo->exec("CREATE DATABASE IF NOT EXISTS users_db");

    // Створюємо нового користувача
    $pdo->exec("CREATE USER IF NOT EXISTS 'phpuser'@'localhost' IDENTIFIED BY 'phppassword'");
    $pdo->exec("GRANT ALL PRIVILEGES ON users_db.* TO 'phpuser'@'localhost'");
    $pdo->exec("FLUSH PRIVILEGES");

    echo "✅ НОВИЙ КОРИСТУВАЧ СТВОРЕНИЙ!<br>";
    echo "Користувач: phpuser<br>";
    echo "Пароль: phppassword<br>";
    echo "База даних: users_db";

} catch(PDOException $e) {
    echo "❌ Не вдалося створити користувача: " . $e->getMessage();
}
?>