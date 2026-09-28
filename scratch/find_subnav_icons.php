<?php
$dir = 'c:/xampp1/htdocs/Sama_College/pages';
$files = ['about.php', 'goals.php', 'president.php', 'strategy.php', 'vision.php'];

foreach ($files as $file) {
    $content = file_get_contents("$dir/$file");
    $lines = explode("\n", $content);
    foreach ($lines as $idx => $line) {
        if (strpos($line, 'الخطة الاستراتيجية') !== false && strpos($line, 'nav-pill-btn') !== false) {
            echo "$file (Line " . ($idx + 1) . "): " . trim($line) . "\n";
        }
    }
}
?>
