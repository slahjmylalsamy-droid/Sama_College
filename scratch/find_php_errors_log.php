<?php
$dirs = [
    'C:/xampp1/php',
    'C:/xampp1/apache',
    'C:/xampp1/apache/bin',
    'C:/xampp1/htdocs/Sama_College'
];

foreach ($dirs as $dir) {
    if (file_exists($dir . '/php_errors.log')) {
        echo "Found php_errors.log in: $dir/php_errors.log\n";
        // print last 10 lines
        $lines = file($dir . '/php_errors.log');
        $last_lines = array_slice($lines, -10);
        echo "Last 10 lines:\n" . implode("", $last_lines) . "\n";
    }
}
?>
