<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/strategy.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'class="nav-pill-btn"') !== false) {
        for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 15); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
?>
