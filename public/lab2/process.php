<?php
$uploadDir = 'uploads/';
$allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
$maxSize = 2 * 1024 * 1024; // 2MB

if ($_FILES['fileToUpload']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['fileToUpload']['tmp_name'];
    $fileName = $_FILES['fileToUpload']['name'];
    $fileSize = $_FILES['fileToUpload']['size'];
    $fileType = $_FILES['fileToUpload']['type'];

    if (!in_array($fileType, $allowedTypes)) {
        die("Error: Only JPG, JPEG, and PNG files are allowed.");
    }

    if ($fileSize > $maxSize) {
        die("Error: File size must be less than 2MB.");
    }

    $fileNameCmps = pathinfo($fileName);
    $fileExtension = strtolower($fileNameCmps['extension']);
    $newFileName = $fileNameCmps['filename'] . '_' . date('Y-m-d_H-i-s') . '.' . $fileExtension;
    $destPath = $uploadDir . $newFileName;

    if (file_exists($destPath)) {
        die("Error: File already exists. Please try again with a different file.");
    }

    if (move_uploaded_file($fileTmpPath, $destPath)) {
        echo "<h2>File Uploaded Successfully</h2>";
        echo "Name: " . htmlspecialchars($newFileName) . "<br>";
        echo "Type: " . htmlspecialchars($fileType) . "<br>";
        echo "Size: " . round($fileSize / 1024, 2) . " KB<br>";
        echo "Download: <a href='" . htmlspecialchars($destPath) . "'>" . htmlspecialchars($newFileName) . "</a>";
    } else {
        echo "Error moving uploaded file.";
    }
} else {
    echo "Error uploading file. Code: " . $_FILES['fileToUpload']['error'];
}
?>