<?php

class Product {
    public $name;
    public $description;
    protected $price;

    public function __construct($name, $price, $description = '') {
        $this->name = $name;
        $this->setPrice($price); // Використовуємо сетер для валідації
        $this->description = $description;
    }

    public function getPrice() {
        return $this->price;
    }

    public function setPrice($price) {
        if ($price < 0) {
            throw new InvalidArgumentException("Ціна не може бути від'ємною");
        }
        $this->price = $price;
    }

    public function getInfo() {
        return "Назва: {$this->name}\nЦіна: {$this->price} грн\nОпис: {$this->description}";
    }
}
?>