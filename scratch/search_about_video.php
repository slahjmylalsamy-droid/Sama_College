<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
foreach ($lines as $i => $line) {
    if (strpos($line, 'video-play-action-btn') !== false ||
        strpos($line, 'downloadCurrentVideo') !== false ||
        strpos($line, 'downloadAllVideos') !== false ||
        strpos($line, 'video-play-btn-large') !== false) {
        echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
        // print a few surrounding lines
        for ($j = max(0, $i - 3); $j <= min(count($lines) - 1, $i + 3); $j++) {
            echo "   [" . ($j + 1) . "]: " . $lines[$j] . "\n";
        }
        echo "---------------------------\n";
    }
}
?>
