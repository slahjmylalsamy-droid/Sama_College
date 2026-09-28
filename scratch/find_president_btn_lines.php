<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/president.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'export-action-btn') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
