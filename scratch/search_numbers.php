<?php
$dir = new RecursiveDirectoryIterator('c:/xampp1/htdocs/Sama_College');
$iterator = new RecursiveIteratorIterator($dir);
foreach ($iterator as $file) {
    if ($file->isFile() && $file->getExtension() === 'php') {
        $content = file_get_contents($file->getPathname());
        if (strpos($content, '323058') !== false || strpos($content, '770821112') !== false || strpos($content, '733045299') !== false || strpos($content, '736863982') !== false) {
            echo $file->getPathname() . "\n";
        }
    }
}
?>
