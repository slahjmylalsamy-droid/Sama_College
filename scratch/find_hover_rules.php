<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');

// Find all css rules that define hover effects (:hover)
$lines = explode("\n", $content);
$hovers = [];
foreach ($lines as $idx => $line) {
    if (strpos($line, ':hover') !== false) {
        $hovers[] = "Line " . ($idx + 1) . ": " . trim($line);
    }
}
echo "Hover occurrences:\n" . implode("\n", array_slice($hovers, 0, 40)) . "\nTotal hovers: " . count($hovers) . "\n";
?>
