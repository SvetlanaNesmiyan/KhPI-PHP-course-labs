<?php
$name = trim($_POST['name'] ?? '');
$surname = trim($_POST['surname'] ?? '');

if ($name === '' || $surname === '') {
    echo "Будь ласка, заповніть обидва поля.<br>";
} else {
    echo "Привіт, " . htmlspecialchars($name) . " " . htmlspecialchars($surname) . "!";
}
?>
