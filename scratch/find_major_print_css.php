<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/major.php');
$lines = explode("\n", $content);
$found = false;
foreach ($lines as $idx => $line) {
    if (strpos($line, 'media print') !== false) {
        $found = true;
    }
    if ($found) {
        for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 15); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
if (!$found) {
    echo "No '@media print' found in pages/major.php.\n";
}
?>
