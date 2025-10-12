<?php

require_once 'classes/Product.php';
require_once 'classes/DiscountedProduct.php';
require_once 'classes/Category.php';

echo "<h1>Система інтернет-магазину</h1>\n";

try {
    echo "<h2>Звичайні товари:</h2>\n";
    $product1 = new Product("Смартфон", 15000, "Сучасний смартфон з гарною камерою");
    $product2 = new Product("Ноутбук", 25000, "Потужний ноутбук для роботи та ігор");

    echo "<pre>" . $product1->getInfo() . "</pre>\n";
    echo "<pre>" . $product2->getInfo() . "</pre>\n";

    echo "<h2>Товари зі знижкою:</h2>\n";
    $discountedProduct1 = new DiscountedProduct("Навушники", 2000, 15, "Бездротові навушники");
    $discountedProduct2 = new DiscountedProduct("Планшет", 12000, 20, "Планшет для роботи");

    echo "<pre>" . $discountedProduct1->getInfo() . "</pre>\n";
    echo "<pre>" . $discountedProduct2->getInfo() . "</pre>\n";

    echo "<h2>Категорії товарів:</h2>\n";

    $electronics = new Category("Електроніка");
    $electronics->addProduct($product1);
    $electronics->addProduct($product2);
    $electronics->addProduct($discountedProduct1);
    $electronics->addProduct($discountedProduct2);

    echo "<pre>";
    $electronics->displayProducts();
    echo "</pre>";

    $books = new Category("Книги");
    $book1 = new Product("PHP для початківців", 500, "Навчальний посібник");
    $book2 = new DiscountedProduct("JavaScript ниндзя", 800, 10, "Розширене вивчення JavaScript");

    $books->addProduct($book1);
    $books->addProduct($book2);

    echo "<pre>";
    $books->displayProducts();
    echo "</pre>";

    echo "<h2>Тестування валідації:</h2>\n";
    try {
        $invalidProduct = new Product("Невірний товар", -100, "Товар з від'ємною ціною");
    } catch (InvalidArgumentException $e) {
        echo "<p style='color: red;'>Помилка валідації: " . $e->getMessage() . "</p>\n";
    }

    try {
        $invalidDiscounted = new DiscountedProduct("Невірна знижка", 1000, 150, "Товар з завеликою знижкою");
    } catch (InvalidArgumentException $e) {
        echo "<p style='color: red;'>Помилка валідації: " . $e->getMessage() . "</p>\n";
    }

    echo "<h2>Робота з гетерами та сетерами:</h2>\n";
    $testProduct = new Product("Тестовий товар", 1000, "Для демонстрації");
    echo "<p>Початкова ціна: " . $testProduct->getPrice() . " грн</p>\n";

    $testProduct->setPrice(1200);
    echo "<p>Нова ціна: " . $testProduct->getPrice() . " грн</p>\n";

    $testDiscounted = new DiscountedProduct("Тест знижки", 1000, 10);
    echo "<p>Початкова знижка: " . $testDiscounted->getDiscount() . "%</p>\n";

    $testDiscounted->setDiscount(25);
    echo "<p>Нова знижка: " . $testDiscounted->getDiscount() . "%</p>\n";
    echo "<p>Нова ціна зі знижкою: " . $testDiscounted->calculateNewPrice() . " грн</p>\n";

} catch (Exception $e) {
    echo "<p style='color: red;'>Сталася помилка: " . $e->getMessage() . "</p>\n";
}

?>