<?php
$log_path = 'C:\\xampp1\\php\\logs\\php_error_log';
if (file_exists($log_path)) {
    echo "Found log file at $log_path! Size: " . filesize($log_path) . " bytes\n";
    $lines = file($log_path);
    $last_lines = array_slice($lines, -30);
    echo "LAST 30 LINES:\n" . implode("", $last_lines);
} else {
    echo "Log file not found at: $log_path\n";
}
?>
