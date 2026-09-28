<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/major.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'major-main-title') !== false || strpos($line, 'major-page-container') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
