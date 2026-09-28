<?php
$dir = 'c:/xampp1/htdocs/Sama_College';
$files = scandir($dir);
foreach ($files as $file) {
    if (is_file($dir . '/' . $file)) {
        $content = file_get_contents($dir . '/' . $file);
        if (strpos($content, 'nextSlide') !== false) {
            echo "Found in file: " . $file . "\n";
        }
    }
}
?>
