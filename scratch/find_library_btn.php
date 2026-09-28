<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/library.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, '<button') !== false || strpos($line, '<input') !== false || strpos($line, 'submit') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
