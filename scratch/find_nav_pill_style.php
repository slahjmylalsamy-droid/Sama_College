<?php
$dir = 'c:/xampp1/htdocs/Sama_College';
$files = scandir($dir);
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents("$dir/$file");
        if (strpos($content, '.nav-pill-btn') !== false) {
            echo "Found in root file: $file\n";
        }
    }
}
$dir_pages = "$dir/pages";
$files_pages = scandir($dir_pages);
foreach ($files_pages as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents("$dir_pages/$file");
        if (strpos($content, '.nav-pill-btn') !== false) {
            echo "Found in pages file: $file\n";
        }
    }
}
?>
