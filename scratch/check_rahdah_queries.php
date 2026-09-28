<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_rahdah.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, '$conn') !== false || strpos($line, 'query') !== false || strpos($line, 'mysql') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
