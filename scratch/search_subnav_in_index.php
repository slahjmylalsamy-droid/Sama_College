<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $content);
foreach ($lines as $idx => $line) {
    if (strpos($line, 'نبذة عن الكلية') !== false || strpos($line, 'الرؤية والرسالة') !== false) {
        echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
    }
}
?>
