<?php
// 1. Виведення тексту "Hello, World!"
echo "Hello, World!<br>";

// 2. Змінні та типи даних
$strVar = "Привіт, PHP!";
$intVar = 42;
$floatVar = 3.14;
$boolVar = true;

echo $strVar . "<br>";
echo $intVar . "<br>";
echo $floatVar . "<br>";
echo $boolVar . "<br>";

var_dump($strVar);
var_dump($intVar);
var_dump($floatVar);
var_dump($boolVar);

// 3. Конкатенація рядків
$str1 = "Привіт, ";
$str2 = "світ!";
$combinedStr = $str1 . $str2;
echo $combinedStr . "<br>";

// 4. Умовні конструкції: перевірка парності числа
$num = 7;
if ($num % 2 == 0) {
    echo "$num є парним числом.<br>";
} else {
    echo "$num є непарним числом.<br>";
}

// 5. Цикли
for ($i = 1; $i <= 10; $i++) {
    echo $i . " ";
}
echo "<br>";

// b) Виведення чисел від 10 до 1 (while)
$j = 10;
while ($j >= 1) {
    echo $j . " ";
    $j--;
}
echo "<br>";

// 6. Масиви
$student = [
    "ім'я" => "Марія",
    "прізвище" => "Іванова",
    "вік" => 21,
    "спеціальність" => "Інформатика"
];
echo "Ім'я: " . $student["ім'я"] . "<br>";
echo "Прізвище: " . $student["прізвище"] . "<br>";
echo "Вік: " . $student["вік"] . "<br>";
echo "Спеціальність: " . $student["спеціальність"] . "<br>";

$student["середній_бал"] = 4.8;

echo "<pre>";
print_r($student);
echo "</pre>";
?>
