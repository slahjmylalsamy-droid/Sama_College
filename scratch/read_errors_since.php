<?php
$log_path = 'C:\\xampp1\\apache\\logs\\php_error.log';
if (file_exists($log_path)) {
    $lines = file($log_path);
    echo "Total lines in error log: " . count($lines) . "\n";
    echo "LAST 20 LINES:\n";
    $last_lines = array_slice($lines, -20);
    echo implode("", $last_lines);
} else {
    echo "Log file not found.\n";
}
?>
