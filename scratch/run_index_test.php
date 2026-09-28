<?php
// Enable all error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mock server variables to run index.php
$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'localhost:8080';
$_SERVER['REQUEST_URI'] = '/Sama_College/index.php';
$_SERVER['REMOTE_ADDR'] = '127.0.0.1';

ob_start();
try {
    include 'c:/xampp1/htdocs/Sama_College/index.php';
    $output = ob_get_clean();
    echo "Index ran successfully. Length: " . strlen($output) . "\n";
    if (strlen($output) < 100) {
        echo "Output snippet: " . $output . "\n";
    }
} catch (Throwable $e) {
    ob_end_clean();
    echo "CRITICAL ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}
?>
