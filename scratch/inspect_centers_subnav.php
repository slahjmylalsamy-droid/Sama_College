<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/medical_institute.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'community_college') !== false || strpos($line, 'community_services') !== false) {
        for ($i = max(0, $idx - 5); $i < min(count($lines), $idx + 15); $i++) {
            echo "Line " . ($i + 1) . ": " . $lines[$i] . "\n";
        }
        break;
    }
}
?>
