<?php
session_start();

$timeout = 300;
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
    session_unset();
    session_destroy();
    echo '<p>Session expired due to inactivity</p>';
}

$_SESSION['last_activity'] = time();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Session Activity</title>
</head>
<body>
<h1>Session Activity Check</h1>
<p>Last activity: <?= date('Y-m-d H:i:s', $_SESSION['last_activity']) ?></p>
<p><a href="<?= $_SERVER['PHP_SELF'] ?>">Refresh</a></p>
</body>
</html>