<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Mock session and server variables
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['role'] = 'staff';
$_SESSION['permission'] = 3;

$_SERVER['REQUEST_METHOD'] = 'GET';
$_SERVER['HTTP_HOST'] = 'localhost:8080';
$_SERVER['REQUEST_URI'] = '/Sama_College/admin/manage_content.php';
$_SERVER['PHP_SELF'] = '/Sama_College/admin/manage_content.php';

ob_start();
try {
    include 'manage_content.php';
    $output = ob_get_clean();
    echo "Manage Content ran successfully. Length: " . strlen($output) . "\n";
} catch (Throwable $e) {
    ob_end_clean();
    echo "CRITICAL ERROR: " . $e->getMessage() . " in " . $e->getFile() . " on line " . $e->getLine() . "\n";
    echo $e->getTraceAsString() . "\n";
}
?>
