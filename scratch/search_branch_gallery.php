<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_damnah.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'gallery') !== false || strpos($line, 'معرض') !== false || strpos($line, 'صور') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
    }
}
?>
