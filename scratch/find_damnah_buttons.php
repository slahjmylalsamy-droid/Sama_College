<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_damnah.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (preg_match('/(button|submit|btn|hover|background-color:|background:|onmouseover)/i', $line)) {
        if ($idx > 480) { // Look at HTML content area
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
?>
