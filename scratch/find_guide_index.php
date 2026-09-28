<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'دليل') !== false) {
        echo "index.php Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
