<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');

$lines = explode("\n", $content);
$matches = [];
foreach ($lines as $idx => $line) {
    if (strpos($line, 'arrow-up') !== false || strpos($line, 'chevron-up') !== false || strpos($line, 'scrollTo') !== false || strpos($line, 'back-to-top') !== false || strpos($line, 'btn-back-to-top') !== false) {
        $matches[] = "Line " . ($idx + 1) . ": " . trim($line);
    }
}
echo "Found matches:\n" . implode("\n", $matches) . "\n";
?>
