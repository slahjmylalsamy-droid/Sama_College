<?php
$admin_dir = 'c:/xampp1/htdocs/Sama_College/admin';
$files = scandir($admin_dir);
foreach ($files as $file) {
    if (is_file($admin_dir . '/' . $file) && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
        $content = file_get_contents($admin_dir . '/' . $file);
        $matches = [];
        preg_match_all('/#(0d4748|085859|ffd700|c5a059|072928|006654)/i', $content, $matches);
        if (!empty($matches[0])) {
            echo "File: $file has " . count($matches[0]) . " hardcoded colors: " . implode(', ', array_unique($matches[0])) . "\n";
        }
    }
}
?>
