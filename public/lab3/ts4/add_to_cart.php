<?php
session_start();

if (!empty($_GET['item'])) {
    $_SESSION['cart'][] = $_GET['item'];

    $previous = json_decode($_COOKIE['previous_purchases'] ?? '[]', true);
    $previous[] = $_GET['item'];
    setcookie('previous_purchases', json_encode($previous), time() + 60*60*24*30);
}

header('Location: index.php');
exit;