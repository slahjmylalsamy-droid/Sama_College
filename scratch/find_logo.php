<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'logo') !== false || strpos($line, 'img') !== false || strpos($line, 'assets') !== false) {
        if (strlen($line) < 300) {
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
?>
