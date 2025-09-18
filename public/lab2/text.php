<?php
$logFile = 'log.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['textData'])) {
    $textData = $_POST['textData'] . PHP_EOL;
    if (file_put_contents($logFile, $textData, FILE_APPEND | LOCK_EX)) {
        echo "Text saved successfully.<br>";
    } else {
        echo "Error saving text.<br>";
    }
}

echo "<h2>Log File Content</h2>";
if (file_exists($logFile)) {
    echo nl2br(htmlspecialchars(file_get_contents($logFile)));
} else {
    echo "Log file is empty or doesn't exist.";
}

echo '<br><a href="index.html">Back to Forms</a>';
?>