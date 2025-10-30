<?php

require_once 'BankAccount.php';

class SavingsAccount extends BankAccount {
    public static $interestRate = 0.05; // 5% річних

    public function applyInterest() {
        $interest = $this->balance * self::$interestRate;
        $this->balance += $interest;
        return $this;
    }

    public static function setInterestRate($rate) {
        self::$interestRate = $rate;
    }
}
?>