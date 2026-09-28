<?php
$it = new RecursiveDirectoryIterator("C:/xampp1/");
$iterator = new RecursiveIteratorIterator($it);
foreach ($iterator as $file) {
    if ($file->isFile() && strtolower($file->getExtension()) === 'log' && strpos($file->getFilename(), 'php') !== false) {
        echo "Found LOG file: " . $file->getPathname() . " (Size: " . $file->getSize() . " bytes)\n";
        $lines = file($file->getPathname());
        $last_lines = array_slice($lines, -40);
        echo "LAST 40 LINES:\n" . implode("", $last_lines) . "\n-------------------\n";
    }
}
?>
