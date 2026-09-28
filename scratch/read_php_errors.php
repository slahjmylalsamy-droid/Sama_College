<?php
$log_path = 'C:\\xampp1\\apache\\bin\\php_errors.log';
if (file_exists($log_path)) {
    $lines = file($log_path);
    $last_lines = array_slice($lines, -40);
    echo "LAST 40 LINES OF PHP_ERRORS.LOG:\n";
    echo implode("", $last_lines);
} else {
    echo "Log file not found at: $log_path\n";
    // Search again
    $it = new RecursiveDirectoryIterator("C:/xampp1/");
    $iterator = new RecursiveIteratorIterator($it);
    foreach ($iterator as $file) {
        if ($file->isFile() && strpos($file->getFilename(), 'php_errors') !== false) {
            echo "Found file during search: " . $file->getPathname() . "\n";
            $lines = file($file->getPathname());
            $last_lines = array_slice($lines, -40);
            echo "LAST 40 LINES:\n" . implode("", $last_lines);
            break;
        }
    }
}
?>
