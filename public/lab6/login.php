<?php

require_once 'config.php';

if (isset($_SESSION['user_id'])) {
    header('Location: welcome.php');
    exit;
}

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (empty($username)) {
        $errors[] = "Введіть ім'я користувача";
    }

    if (empty($password)) {
        $errors[] = "Введіть пароль";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id, username, email, password FROM users WHERE username = ?");
            $stmt->execute([$username]);
            $user = $stmt->fetch();

            if ($user) {
                if (md5($password) === $user['password']) {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    $_SESSION['email'] = $user['email'];

                    header('Location: welcome.php');
                    exit;
                } else {
                    $errors[] = "Невірний пароль";
                }
            } else {
                $errors[] = "Користувача з таким іменем не знайдено";
            }

        } catch(PDOException $e) {
            $errors[] = "Помилка бази даних: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вхід</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"] {
            width: 100%; padding: 8px; border: 1px solid #bab8b8; border-radius: 4px;
        }
        button {
            background: #28a745; color: #bab8b8; padding: 10px 20px;
            border: none; border-radius: 4px; cursor: pointer;
        }
        .error { color: red; margin: 10px 0; }
        .links { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
<h2>Вхід</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username"
               value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit">Увійти</button>
</form>

<div class="links">
    <p>Ще не маєте акаунту? <a href="register.php">Зареєструватися</a></p>
</div>
</body>
</html>