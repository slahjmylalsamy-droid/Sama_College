<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, '<header') !== false || strpos($line, '<footer') !== false || strpos($line, '<div class="sidebar"') !== false || strpos($line, 'id="header"') !== false || strpos($line, 'class="header"') !== false || strpos($line, 'class="footer"') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
