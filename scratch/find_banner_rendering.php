<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
for ($i = 1690; $i < 1740; $i++) {
    if (isset($lines[$i])) {
        echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
    }
}
?>
