<?php
session_start();

$credentials = [
    'admin' => 'password123',
    'user' => 'qwerty'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($credentials[$_POST['login']] === $_POST['password']) {
        $_SESSION['user'] = $_POST['login'];
        header('Location: welcome.php');
        exit;
    } else {
        $error = 'Invalid credentials';
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
<?php if (isset($error)): ?>
    <p style="color: red;"><?= $error ?></p>
<?php endif; ?>
<form method="post">
    <input type="text" name="login" placeholder="Login" required><br>
    <input type="password" name="password" placeholder="Password" required><br>
    <button type="submit">Login</button>
</form>
</body>
</html>