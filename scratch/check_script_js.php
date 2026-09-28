<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/script.js');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'slide') !== false || strpos($line, 'image') !== false || strpos($line, 'title') !== false || strpos($line, 'nextSlide') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
