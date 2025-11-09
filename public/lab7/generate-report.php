<?php

function generateReport() {
    sleep(3);

    $html = "<table class='table'>\n";
    $html .= "<tr><th>ID</th><th>Ім'я</th><th>Сума</th><th>Дата</th></tr>\n";

    for ($i = 1; $i <= 1000; $i++) {
        $name = "Користувач " . $i;
        $amount = number_format(rand(100, 10000) / 100, 2);
        $date = date('Y-m-d', time() - rand(0, 86400 * 365));
        $html .= "<tr><td>{$i}</td><td>{$name}</td><td>{$amount}</td><td>{$date}</td></tr>\n";
    }

    $html .= "</table>";
    return $html;
}

$cacheFile = __DIR__ . '/cache/report.html';
$cacheTime = 10 * 60;

if (!file_exists(dirname($cacheFile))) {
    mkdir(dirname($cacheFile), 0755, true);
}

if (file_exists($cacheFile) && (time() - filemtime($cacheFile) < $cacheTime)) {
    $content = file_get_contents($cacheFile);
    $source = " (з кешу)";
} else {
    $content = generateReport();
    file_put_contents($cacheFile, $content);
    $source = " (нова генерація)";
}

echo "<!DOCTYPE html>\n";
echo "<html lang='uk'>\n";
echo "<head><meta charset='UTF-8'><title>Звіт</title>\n";
echo "<link rel='stylesheet' href='style.css.php'>\n";
echo "</head>\n";
echo "<body>\n";
echo "<h1>Звіт про операції" . $source . "</h1>\n";
echo "<p>Час генерації: " . date('Y-m-d H:i:s') . "</p>\n";
echo $content;
echo "</body>\n";
echo "</html>\n";
?>