<?php
$dir = 'c:/xampp1/htdocs/Sama_College/';
$files = scandir($dir);
foreach ($files as $file) {
    if (is_file($dir . $file)) {
        $ext = pathinfo($file, PATHINFO_EXTENSION);
        if (in_array(strtolower($ext), ['pdf', 'doc', 'docx', 'txt', 'zip'])) {
            echo "Root File: " . $file . "\n";
        }
    }
}
// recursive check in some common directories
$subdirs = ['assets', 'images', 'files', 'downloads', 'documents'];
foreach ($subdirs as $subdir) {
    if (is_dir($dir . $subdir)) {
        $subfiles = scandir($dir . $subdir);
        foreach ($subfiles as $sf) {
            if (is_file($dir . $subdir . '/' . $sf)) {
                echo "$subdir/$sf\n";
            }
        }
    }
}
?>
