<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
$count = 0;
foreach ($lines as $idx => $line) {
    if (strpos($line, '#0d4748') !== false || strpos($line, '#085859') !== false || strpos($line, '#ffd700') !== false || strpos($line, '#c5a059') !== false) {
        $count++;
        if ($count <= 20) {
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
echo "Total occurrences: " . $count . "\n";
?>
