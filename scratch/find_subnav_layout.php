<?php
$dir = 'c:/xampp1/htdocs/Sama_College/pages';
$files = scandir($dir);
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents("$dir/$file");
        if (strpos($content, 'p=about') !== false && strpos($content, 'p=vision') !== false) {
            echo "Match found in: $file\n";
            // Print lines containing the links
            $lines = explode("\n", $content);
            foreach ($lines as $idx => $line) {
                if (strpos($line, 'p=about') !== false || strpos($line, 'p=vision') !== false) {
                    echo "  Line " . ($idx + 1) . ": " . trim($line) . "\n";
                }
            }
        }
    }
}
?>
