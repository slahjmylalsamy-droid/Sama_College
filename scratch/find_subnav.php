<?php
$dir = 'c:/xampp1/htdocs/Sama_College/pages';
$files = scandir($dir);
foreach ($files as $file) {
    if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
        $content = file_get_contents("$dir/$file");
        if (strpos($content, 'الخطة الاستراتيجية') !== false || strpos($content, 'نبذة عن الكلية') !== false) {
            echo "Found in: $file\n";
        }
    }
}
?>
