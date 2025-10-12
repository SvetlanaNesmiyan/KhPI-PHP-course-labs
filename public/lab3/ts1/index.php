<?php
$username = $_COOKIE['username'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['username'])) {
    setcookie('username', $_POST['username'], time() + 60*60*24*7);
    header('Location: '.$_SERVER['PHP_SELF']);
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cookie</title>
</head>
<body>
<?php if ($username): ?>
    <h1>Welcome back, <?= htmlspecialchars($username) ?>!</h1>
    <form method="post" action="delete_cookie.php">
        <button type="submit">Delete Cookie</button>
    </form>
<?php else: ?>
    <form method="post">
        <input type="text" name="username" placeholder="Enter your name" required>
        <button type="submit">Submit</button>
    </form>
<?php endif; ?>
</body>
</html>