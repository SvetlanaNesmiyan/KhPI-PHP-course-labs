<?php

require_once 'SavingsAccount.php';

function displayBalance($account, $name) {
    echo "$name баланс: " . $account->getBalance() . " " . $account->getCurrency() . "\n";
}

echo "=== Тестування банківської системи ===\n\n";

// Тестування базового рахунку
echo "1. Тестування базового рахунку:\n";
try {
    $account1 = new BankAccount(100, 'USD');
    displayBalance($account1, "Початковий");

    $account1->deposit(50);
    displayBalance($account1, "Після поповнення 50");

    $account1->withdraw(30);
    displayBalance($account1, "Після зняття 30");

    // Спроба зняття більше коштів
    // $account1->withdraw(200); // Це викличе помилку

} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "\n";
}

// Тестування накопичувального рахунку
echo "\n2. Тестування накопичувального рахунку:\n";
try {
    $savings = new SavingsAccount(1000, 'USD');
    displayBalance($savings, "Початковий накопичувальний");

    $savings->applyInterest();
    displayBalance($savings, "Після нарахування відсотків");

    // Зміна відсоткової ставки
    SavingsAccount::setInterestRate(0.1); // 10%
    $savings->applyInterest();
    displayBalance($savings, "Після зміни ставки та нарахування");

} catch (Exception $e) {
    echo "Помилка: " . $e->getMessage() . "\n";
}

// Тестування обробки помилок
echo "\n3. Тестування обробки помилок:\n";
$testAccounts = [
    new BankAccount(50, 'USD'),
    new SavingsAccount(200, 'USD')
];

foreach ($testAccounts as $index => $account) {
    try {
        echo "Рахунок " . ($index + 1) . ":\n";
        displayBalance($account, "Початковий");

        // Спроба некоректного поповнення
        $account->deposit(-10);

    } catch (Exception $e) {
        echo "Помилка при поповненні: " . $e->getMessage() . "\n";
    }

    try {
        // Спроба некоректного зняття
        $account->withdraw(1000);

    } catch (Exception $e) {
        echo "Помилка при знятті: " . $e->getMessage() . "\n";
    }

    displayBalance($account, "Кінцевий");
    echo "---\n";
}

// Демонстрація поліморфізму
echo "\n4. Демонстрація поліморфізму:\n";
$accounts = [
    new BankAccount(500, 'USD'),
    new SavingsAccount(500, 'USD')
];

foreach ($accounts as $index => $account) {
    echo "Рахунок " . ($index + 1) . " тип: " . get_class($account) . "\n";

    $account->deposit(100);
    echo "Після поповнення: " . $account->getBalance() . "\n";

    if ($account instanceof SavingsAccount) {
        $account->applyInterest();
        echo "Після відсотків: " . $account->getBalance() . "\n";
    }

    echo "---\n";
}
?>