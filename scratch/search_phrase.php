<?php
$dir = 'c:/xampp1/htdocs/Sama_College';
$it = new RecursiveDirectoryIterator($dir);
$iterator = new RecursiveIteratorIterator($it);

$phrases = ['البرامج المتاحة والرسوم الدراسية', 'دليل الطالب', 'استخراج PDF', 'طباعة تقرير التقويم'];

foreach ($iterator as $file) {
    if ($file->isFile() && strtolower($file->getExtension()) === 'php') {
        $content = file_get_contents($file->getPathname());
        foreach ($phrases as $phrase) {
            if (strpos($content, $phrase) !== false) {
                echo "Found '$phrase' in: " . $file->getPathname() . "\n";
            }
        }
    }
}
?>
