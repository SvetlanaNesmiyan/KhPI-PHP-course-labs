<?php

require_once 'config.php';

$errors = [];
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (empty($username)) {
        $errors[] = "Ім'я користувача обов'язкове";
    } elseif (strlen($username) < 3) {
        $errors[] = "Ім'я користувача має містити щонайменше 3 символи";
    }

    if (empty($email)) {
        $errors[] = "Email обов'язковий";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Невірний формат email";
    }

    if (empty($password)) {
        $errors[] = "Пароль обов'язковий";
    } elseif (strlen($password) < 6) {
        $errors[] = "Пароль має містити щонайменше 6 символів";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Паролі не співпадають";
    }

    if (empty($errors)) {
        try {
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
            if ($stmt->rowCount() > 0) {
                $errors[] = "Це ім'я користувача вже зайняте";
            }

            $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->rowCount() > 0) {
                $errors[] = "Цей email вже зареєстрований";
            }

            if (empty($errors)) {
                $hashed_password = md5($password);

                $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
                $stmt->execute([$username, $email, $hashed_password]);

                $success = "Реєстрація успішна! Тепер ви можете увійти.";
                $_POST = [];
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
    <title>Реєстрація</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%; padding: 8px; border: 1px solid #bab8b8; border-radius: 4px;
        }
        button {
            background: #40fff0; color: #bab8b8; padding: 10px 20px;
            border: none; border-radius: 4px; cursor: pointer;
        }
        .error { color: #cc0000; margin: 10px 0; }
        .success { color: #4cff4c; margin: 10px 0; }
        .links { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
<h2>Реєстрація</h2>

<?php if (!empty($errors)): ?>
    <div class="error">
        <?php foreach ($errors as $error): ?>
            <p><?php echo htmlspecialchars($error); ?></p>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php if ($success): ?>
    <div class="success">
        <p><?php echo htmlspecialchars($success); ?></p>
    </div>
<?php endif; ?>

<form method="POST" action="">
    <div class="form-group">
        <label for="username">Ім'я користувача:</label>
        <input type="text" id="username" name="username"
               value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email"
               value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
    </div>

    <div class="form-group">
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
    </div>

    <div class="form-group">
        <label for="confirm_password">Підтвердження пароля:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>
    </div>

    <button type="submit">Зареєструватися</button>
</form>

<div class="links">
    <p>Вже маєте акаунт? <a href="login.php">Увійти</a></p>
</div>
</body>
</html>