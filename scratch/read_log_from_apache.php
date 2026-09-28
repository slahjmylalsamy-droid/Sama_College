<?php
header('Content-Type: text/plain; charset=utf-8');
$error_log_path = ini_get('error_log');
echo "Apache PHP error_log path: " . $error_log_path . "\n";
if (file_exists($error_log_path)) {
    echo "File exists! Size: " . filesize($error_log_path) . " bytes\n";
    $lines = file($error_log_path);
    $last_lines = array_slice($lines, -40);
    echo "LAST 40 LINES:\n" . implode("", $last_lines);
} else {
    echo "File does not exist at path.\n";
    // Let's look inside C:/xampp1/apache/logs/error.log
    $apache_err = 'C:/xampp1/apache/logs/error.log';
    if (file_exists($apache_err)) {
        echo "\nLAST 20 LINES OF APACHE ERROR.LOG:\n";
        $lines = file($apache_err);
        echo implode("", array_slice($lines, -20));
    }
}
?>
