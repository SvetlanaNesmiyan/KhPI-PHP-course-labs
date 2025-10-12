<?php
session_start();
$current_items = $_SESSION['cart'] ?? [];
$previous_items = json_decode($_COOKIE['previous_purchases'] ?? '[]', true);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Shopping Cart</title>
</head>
<body>
<h2>Products</h2>
<ul>
    <li>Product A <a href="add_to_cart.php?item=Product+A">Add to Cart</a></li>
    <li>Product B <a href="add_to_cart.php?item=Product+B">Add to Cart</a></li>
</ul>

<h3>Current Cart</h3>
<ul>
    <?php foreach($current_items as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
    <?php endforeach; ?>
</ul>

<h3>Previous Purchases</h3>
<ul>
    <?php foreach($previous_items as $item): ?>
        <li><?= htmlspecialchars($item) ?></li>
    <?php endforeach; ?>
</ul>

<a href="clear_cart.php">Clear Current Cart</a>
</body>
</html>