<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'include \'pages/') !== false || strpos($line, 'include("pages/') !== false || strpos($line, 'require') !== false || strpos($line, 'include') !== false) {
        if (strpos($line, 'pages/') !== false) {
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
?>
