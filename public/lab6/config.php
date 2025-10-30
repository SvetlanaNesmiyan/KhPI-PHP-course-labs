<?php
session_start();

$host = '127.0.0.1';
$dbname = 'users_db';
$user = 'root';
$passwords = ['', 'root', 'password', '123456'];

foreach ($passwords as $password) {
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Успішне підключення з паролем: '" . $password . "'";
        // Якщо підключення вдалося, виходимо з циклу
        break;
    } catch (PDOException $e) {
        // Якщо це останній пароль, виводимо повідомлення про помилку
        if ($password === end($passwords)) {
            die("Не вдалося підключитися до бази даних. Остання помилка: " . $e->getMessage() .
                " Спробуйте скинути пароль root для MySQL.");
        }
    }
}
?>