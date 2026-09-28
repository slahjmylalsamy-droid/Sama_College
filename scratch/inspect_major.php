<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/major.php');
$lines = explode("\n", $content);
echo "Total lines: " . count($lines) . "\n";
foreach ($lines as $idx => $line) {
    if (strpos($line, 'window.print') !== false || strpos($line, 'export') !== false || strpos($line, 'طباعة') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
