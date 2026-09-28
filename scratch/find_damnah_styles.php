<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_damnah.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'hover') !== false || strpos($line, 'btn') !== false || strpos($line, 'background:') !== false || strpos($line, 'background-color:') !== false) {
        if ($idx < 480) { // Look at CSS styles area
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
?>
