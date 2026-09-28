<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/branch_damnah.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    // print lines with Arabic text or headings
    if (preg_match('/[\x{0600}-\x{06FF}]/u', $line) && (strpos($line, 'class=') === false || strpos($line, '<h') !== false)) {
        if ($idx > 400 && $idx < 500) {
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
        }
    }
}
?>
