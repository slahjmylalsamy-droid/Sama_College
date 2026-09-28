<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

$_GET['p'] = 'branch_damnah';
ob_start();
include 'c:/xampp1/htdocs/Sama_College/index.php';
$html = ob_get_clean();

file_put_contents('c:/xampp1/htdocs/Sama_College/scratch/output.html', $html);

$lines = explode("\n", $html);
$has_errors = false;
foreach ($lines as $idx => $line) {
    if (preg_match('/(Fatal error|Warning|Parse error|Notice|Call to undefined)/i', $line)) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        $has_errors = true;
    }
}

if (!$has_errors) {
    echo "No errors found in the page body output.\n";
}
?>
