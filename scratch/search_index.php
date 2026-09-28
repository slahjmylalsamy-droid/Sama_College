<?php
$index_content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $index_content);
foreach ($lines as $num => $line) {
    if (strpos($line, 'site_pages') !== false || strpos($line, 'page_content') !== false) {
        echo "Line " . ($num + 1) . ": " . trim($line) . "\n";
    }
}
?>
