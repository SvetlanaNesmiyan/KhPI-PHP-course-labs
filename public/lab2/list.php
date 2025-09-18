<?php
$uploadDir = 'uploads/';
$files = scandir($uploadDir);
$files = array_diff($files, ['.', '..']);

echo "<h2>Uploaded Files</h2>";
if (count($files) > 0) {
    echo "<ul>";
    foreach ($files as $file) {
        $filePath = $uploadDir . $file;
        echo "<li><a href='" . htmlspecialchars($filePath) . "'>" . htmlspecialchars($file) . "</a></li>";
    }
    echo "</ul>";
} else {
    echo "No files uploaded yet.";
}
echo '<br><a href="index.html">Back to Forms</a>';
?>