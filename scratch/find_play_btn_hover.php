<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
for ($i = 390; $i < 410; $i++) {
    echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
}
?>
