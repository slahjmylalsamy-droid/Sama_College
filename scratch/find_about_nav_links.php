<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'class="nav-pill-btn"') !== false || strpos($line, 'btn-back-to-home') !== false) {
        if ($idx > 500) { // bottom nav
            for ($i = max(0, $idx - 2); $i < min(count($lines), $idx + 12); $i++) {
                echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
            }
            break;
        }
    }
}
?>
