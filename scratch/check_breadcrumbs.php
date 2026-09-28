<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');

// Let's search for breadcrumbs or home icon
$lines = explode("\n", $content);
$matches = [];
foreach ($lines as $idx => $line) {
    if (strpos($line, 'fa-home') !== false || strpos($line, 'fa-house') !== false || strpos($line, 'breadcrumb') !== false) {
        $matches[] = "Line " . ($idx + 1) . ": " . trim($line);
    }
}

echo "Found matches:\n" . implode("\n", $matches) . "\n";
?>
