<?php
$dir = 'C:/xampp1/apache/logs';
if (file_exists($dir)) {
    echo "Files in $dir:\n";
    $files = scandir($dir);
    foreach ($files as $file) {
        $p = $dir . '/' . $file;
        echo "- $file (Size: " . (is_file($p) ? filesize($p) : 'dir') . " bytes)\n";
    }
} else {
    echo "Directory not found: $dir\n";
}
?>
