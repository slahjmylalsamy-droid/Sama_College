<?php
$it = new RecursiveDirectoryIterator("C:/xampp1/");
$iterator = new RecursiveIteratorIterator($it);
$count = 0;
foreach ($iterator as $file) {
    if ($file->isFile() && strpos($file->getFilename(), 'php_errors') !== false) {
        echo "Found: " . $file->getPathname() . "\n";
        $count++;
        if ($count > 10) break;
    }
}
echo "Search complete.\n";
?>
