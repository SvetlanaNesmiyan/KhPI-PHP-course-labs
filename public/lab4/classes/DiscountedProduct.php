<?php

require_once 'Product.php';

class DiscountedProduct extends Product {
    private $discount;

    public function __construct($name, $price, $discount, $description = '') {
        parent::__construct($name, $price, $description);
        $this->setDiscount($discount);
    }

    public function getDiscount() {
        return $this->discount;
    }

    public function setDiscount($discount) {
        if ($discount < 0 || $discount > 100) {
            throw new InvalidArgumentException("Знижка повинна бути від 0 до 100%");
        }
        $this->discount = $discount;
    }

    public function calculateNewPrice() {
        return $this->price * (1 - $this->discount / 100);
    }

    public function getInfo() {
        $originalPrice = $this->getPrice();
        $newPrice = $this->calculateNewPrice();

        return "Назва: {$this->name}\n" .
            "Оригінальна ціна: {$originalPrice} грн\n" .
            "Знижка: {$this->discount}%\n" .
            "Ціна зі знижкою: " . number_format($newPrice, 2) . " грн\n" .
            "Опис: {$this->description}";
    }
}
?>