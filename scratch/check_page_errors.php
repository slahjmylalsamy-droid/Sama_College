<?php
$_GET['p'] = 'branch_damnah';
ob_start();
include 'c:/xampp1/htdocs/Sama_College/index.php';
$output = ob_get_clean();

echo "Response Code: " . http_response_code() . "\n";
if (preg_error_check($output)) {
    echo "Errors found in output!\n";
} else {
    echo "No obvious error text in output, length: " . strlen($output) . "\n";
}

function preg_error_check($text) {
    return preg_match('/(Fatal error|Warning|Parse error|Notice)/i', $text);
}
?>
