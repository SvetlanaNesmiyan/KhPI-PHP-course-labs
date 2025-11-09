<?php

session_start();

function fetchProductData() {
    sleep(2);

    return [
        ['id' => 1, 'name' => 'Ноутбук', 'price' => 25000],
        ['id' => 2, 'name' => 'Мишка', 'price' => 450],
        ['id' => 3, 'name' => 'Клавіатура', 'price' => 1200],
        ['id' => 4, 'name' => 'Монітор', 'price' => 5000],
    ];
}

if (!isset($_SESSION['cached_products']) || isset($_GET['refresh'])) {
    $startTime = microtime(true);
    $_SESSION['cached_products'] = fetchProductData();
    $generationTime = round((microtime(true) - $startTime) * 1000);
    $source = " (згенеровано за {$generationTime}мс)";
} else {
    $source = " (з кешу сесії)";
}

$products = $_SESSION['cached_products'];
?>
    <!DOCTYPE html>
    <html lang="uk">
    <head>
        <meta charset="UTF-8">
        <title>Кешування в сесії</title>
        <link rel="stylesheet" href="style.css.php">
    </head>
    <body>
    <h1>Список товарів<?php echo $source; ?></h1>

    <p><a href="?refresh=1">Оновити дані</a> | <a href="?clear=1">Очистити кеш</a></p>

    <table class="table">
        <tr>
            <th>ID</th>
            <th>Назва</th>
            <th>Ціна</th>
        </tr>
        <?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo $product['id']; ?></td>
                <td><?php echo $product['name']; ?></td>
                <td><?php echo number_format($product['price'], 2); ?> грн</td>
            </tr>
        <?php endforeach; ?>
    </table>

    <p>ID сесії: <?php echo session_id(); ?></p>
    </body>
    </html>

<?php

if (isset($_GET['clear'])) {
    unset($_SESSION['cached_products']);
    header('Location: session-cache.php');
    exit;
}
?>