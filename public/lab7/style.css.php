<?php

$cssContent = "
body { font-family: Arial, sans-serif; margin: 20px; }
.header { color: #2c3e50; padding: 10px; }
.table { border-collapse: collapse; width: 100%; }
.table td, .table th { border: 1px solid #ddd; padding: 8px; }
";

header('Content-Type: text/css');
header('Cache-Control: public, max-age=86400');
header('Expires: ' . gmdate('D, d M Y H:i:s', time() + 86400) . ' GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');

header('ETag: "' . md5($cssContent) . '"');

echo $cssContent;
?>