<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'طباعة') !== false ||
        strpos($line, 'PDF') !== false ||
        strpos($line, 'pdf') !== false ||
        strpos($line, 'export-action-btn') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
?>
