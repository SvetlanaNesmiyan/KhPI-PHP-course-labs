<?php

require_once 'AccountInterface.php';

class BankAccount implements AccountInterface {
    const MIN_BALANCE = 0;

    protected $balance;
    protected $currency;

    public function __construct($initialBalance = 0, $currency = 'USD') {
        $this->balance = $initialBalance;
        $this->currency = $currency;
    }

    public function deposit($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума поповнення має бути більше нуля");
        }
        $this->balance += $amount;
        return $this;
    }

    public function withdraw($amount) {
        if ($amount <= 0) {
            throw new Exception("Сума зняття має бути більше нуля");
        }

        if ($amount > $this->balance) {
            throw new Exception("Недостатньо коштів");
        }

        $this->balance -= $amount;
        return $this;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function getCurrency() {
        return $this->currency;
    }
}
?>