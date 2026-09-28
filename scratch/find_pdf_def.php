<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
$found = false;
foreach ($lines as $idx => $line) {
    if (strpos($line, 'function exportAboutPDF') !== false) {
        $found = true;
    }
    if ($found) {
        for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 45); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
?>
