<?php
$ini = file_get_contents('C:/xampp1/php/php.ini');
if (preg_match('/error_log\s*=\s*(.+)/i', $ini, $matches)) {
    echo "PHP Error Log path: " . trim($matches[1]) . "\n";
} else {
    echo "error_log directive not found in php.ini\n";
}
if (preg_match('/display_errors\s*=\s*(.+)/i', $ini, $matches)) {
    echo "display_errors: " . trim($matches[1]) . "\n";
}
?>
