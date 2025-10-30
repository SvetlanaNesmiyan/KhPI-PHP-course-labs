<?php

require_once 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT username, email, created_at FROM users WHERE id = ?");
    $stmt->execute([$_SESSION['user_id']]);
    $user = $stmt->fetch();
} catch(PDOException $e) {
    die("Помилка бази даних: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ласкаво просимо</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 600px; margin: 50px auto; padding: 20px; }
        .welcome { background: #bab8b8; padding: 20px; border-radius: 8px; }
        .user-info { margin: 20px 0; }
        .logout { margin-top: 20px; }
        .logout a {
            background: #dc3545; color: #bab8b8; padding: 10px 20px;
            text-decoration: none; border-radius: 4px;
        }
    </style>
</head>
<body>
<div class="welcome">
    <h1>Ласкаво просимо, <?php echo htmlspecialchars($user['username']); ?>!</h1>

    <div class="user-info">
        <h3>Інформація про ваш акаунт:</h3>
        <p><strong>Ім'я користувача:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Дата реєстрації:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
    </div>

    <div class="logout">
        <a href="logout.php">Вийти</a>
    </div>
</div>
</body>
</html>