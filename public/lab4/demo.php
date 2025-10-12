<?php

require_once 'classes/Product.php';
require_once 'classes/DiscountedProduct.php';
require_once 'classes/Category.php';

class ShopDemo {
    public static function run() {
        echo "<h1>Демонстрація</h1>\n";

        self::demoBasicProducts();
        self::demoInheritance();
        self::demoCategories();
        self::demoValidation();
    }

    private static function demoBasicProducts() {
        echo "<h2>1. Базові товари</h2>\n";

        $products = [
            new Product("Мишка", 450, "Комп'ютерна мишка"),
            new Product("Клавіатура", 1200, "Механічна клавіатура"),
            new Product("Монітор", 8000, "24-дюймовий монітор")
        ];

        foreach ($products as $product) {
            echo "<div style='border: 1px solid #ccc; padding: 10px; margin: 10px;'>\n";
            echo "<pre>" . $product->getInfo() . "</pre>\n";
            echo "</div>\n";
        }
    }

    private static function demoInheritance() {
        echo "<h2>2. Товари зі знижкою (спадкування)</h2>\n";

        $discountedProducts = [
            new DiscountedProduct("Геймпад", 1500, 20, "Бездротовий геймпад"),
            new DiscountedProduct("Веб-камера", 900, 15, "Full HD веб-камера"),
            new DiscountedProduct("Колонки", 2000, 25, "Стерео колонки")
        ];

        foreach ($discountedProducts as $product) {
            echo "<div style='border: 1px solid #39ffaf; padding: 10px; margin: 10px; background: #cdc9b7;'>\n";
            echo "<pre>" . $product->getInfo() . "</pre>\n";
            echo "</div>\n";
        }
    }

    private static function demoCategories() {
        echo "<h2>3. Категорії товарів</h2>\n";

        // Створення категорій
        $computerCategory = new Category("Комп'ютерна техніка");
        $audioCategory = new Category("Аудіотехніка");

        // Додавання товарів до категорій
        $computerCategory->addProduct(new Product("Процесор", 6000, "Intel Core i7"));
        $computerCategory->addProduct(new DiscountedProduct("Відеокарта", 15000, 10, "NVIDIA RTX 3060"));
        $computerCategory->addProduct(new Product("Оперативна пам'ять", 2000, "16GB DDR4"));

        $audioCategory->addProduct(new DiscountedProduct("Навушники", 2500, 30, "Gaming навушники"));
        $audioCategory->addProduct(new Product("Мікрофон", 1800, "USB мікрофон"));
        $audioCategory->addProduct(new DiscountedProduct("Саундбар", 5000, 15, "Домашній кінотеатр"));

        // Виведення категорій
        echo "<div style='border: 1px solid #0066cc; padding: 10px; margin: 10px;'>\n";
        echo "<pre>";
        $computerCategory->displayProducts();
        echo "</pre>";
        echo "</div>\n";

        echo "<div style='border: 1px solid #0066cc; padding: 10px; margin: 10px;'>\n";
        echo "<pre>";
        $audioCategory->displayProducts();
        echo "</pre>";
        echo "</div>\n";
    }

    private static function demoValidation() {
        echo "<h2>4. Тестування валідації</h2>\n";

        echo "<h3>Спроба створити товар з від'ємною ціною:</h3>\n";
        try {
            $invalidProduct = new Product("Невірний товар", -100);
        } catch (InvalidArgumentException $e) {
            echo "<p style='color: red;'>❌ " . $e->getMessage() . "</p>\n";
        }

        echo "<h3>Спроба створити товар з невірною знижкою:</h3>\n";
        try {
            $invalidDiscounted = new DiscountedProduct("Невірна знижка", 1000, 150);
        } catch (InvalidArgumentException $e) {
            echo "<p style='color: red;'>❌ " . $e->getMessage() . "</p>\n";
        }

        echo "<h3>Успішне створення товарів:</h3>\n";
        try {
            $validProduct = new Product("Валідний товар", 500);
            $validDiscounted = new DiscountedProduct("Валідний знижковий", 1000, 20);
            echo "<p style='color: green;'>✅ Товари успішно створені!</p>\n";
        } catch (Exception $e) {
            echo "<p style='color: red;'>❌ " . $e->getMessage() . "</p>\n";
        }
    }
}

ShopDemo::run();

?>