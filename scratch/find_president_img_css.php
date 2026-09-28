<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/president.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'president-image-col') !== false && $idx < 200) {
        for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 25); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
?>
