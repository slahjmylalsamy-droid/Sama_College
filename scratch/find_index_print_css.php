<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
$found = false;
foreach ($lines as $idx => $line) {
    if (strpos($line, 'media print') !== false) {
        $found = true;
        for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 20); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
if (!$found) {
    echo "No '@media print' found in index.php.\n";
}
?>
