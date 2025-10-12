<?php

require_once 'Product.php';

class Category {
    private $name;
    private $products = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    // Виведення всіх товарів категорії
    public function displayProducts() {
        echo "Категорія: {$this->name}\n";
        echo "Кількість товарів: " . count($this->products) . "\n";
        echo "------------------------\n";

        foreach ($this->products as $index => $product) {
            echo "Товар " . ($index + 1) . ":\n";
            echo $product->getInfo() . "\n";
            echo "------------------------\n";
        }
    }

    // Гетер для назви категорії
    public function getName() {
        return $this->name;
    }

    // Гетер для масиву товарів
    public function getProducts() {
        return $this->products;
    }
}
?>