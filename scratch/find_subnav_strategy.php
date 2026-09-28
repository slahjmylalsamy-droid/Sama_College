<?php
$dir = 'c:/xampp1/htdocs/Sama_College/pages';
$files = ['about.php', 'goals.php', 'president.php', 'strategy.php', 'vision.php'];

foreach ($files as $file) {
    $content = file_get_contents("$dir/$file");
    $lines = explode("\n", $content);
    foreach ($lines as $idx => $line) {
        if (strpos($line, 'p=strategy') !== false) {
            echo "$file (Line " . ($idx + 1) . "): " . trim($line) . "\n";
            // Print the next line too in case of multiline
            if (isset($lines[$idx+1])) {
                echo "  Next: " . trim($lines[$idx+1]) . "\n";
            }
        }
    }
}
?>
