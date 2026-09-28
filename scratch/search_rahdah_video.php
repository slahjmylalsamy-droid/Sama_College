<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_rahdah.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'video') !== false || strpos($line, 'فيديو') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
?>
