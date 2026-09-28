<?php
$index_content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $index_content);
$found = false;
foreach ($lines as $num => $line) {
    if ($num >= 1800 && $num < 1950) {
        echo "Line " . ($num + 1) . ": " . trim($line) . "\n";
    }
}
?>
