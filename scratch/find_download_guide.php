<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');

$lines = explode("\n", $content);
$matches = [];
foreach ($lines as $idx => $line) {
    if (strpos($line, 'تحميل') !== false || strpos($line, 'download') !== false || strpos($line, 'دليل') !== false) {
        $matches[] = "Line " . ($idx + 1) . ": " . trim($line);
    }
}
echo "Found matches:\n" . implode("\n", array_slice($matches, 0, 40)) . "\n";
?>
