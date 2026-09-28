<?php
$dir = 'c:/xampp1/htdocs/Sama_College/pages/';
$files = scandir($dir);
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents($dir . $file);
        if (strpos($content, 'المعهد الطبي العالي') !== false || strpos($content, 'كلية المجتمع') !== false) {
            echo "Found in file: pages/$file\n";
        }
    }
}
?>
