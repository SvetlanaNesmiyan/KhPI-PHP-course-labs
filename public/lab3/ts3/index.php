<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: https://google.com');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Server Info</title>
</head>
<body>
<p>Client IP: <?= $_SERVER['REMOTE_ADDR'] ?></p>
<p>User Agent: <?= $_SERVER['HTTP_USER_AGENT'] ?></p>
<p>Script Name: <?= $_SERVER['PHP_SELF'] ?></p>
<p>Request Method: <?= $_SERVER['REQUEST_METHOD'] ?></p>
<p>Server Path: <?= $_SERVER['SCRIPT_FILENAME'] ?></p>
</body>
</html>