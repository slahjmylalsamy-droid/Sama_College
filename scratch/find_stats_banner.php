<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');

$lines = explode("\n", $content);
$matches = [];
foreach ($lines as $idx => $line) {
    if (strpos($line, '3500') !== false || strpos($line, 'برنامج أكاديمي') !== false || strpos($line, 'إحصائيات الكلية') !== false) {
        $matches[] = "Line " . ($idx + 1) . ": " . trim($line);
    }
}
echo "Found matches:\n" . implode("\n", $matches) . "\n";
?>
