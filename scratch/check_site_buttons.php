<?php
$pages_dir = 'c:/xampp1/htdocs/Sama_College/pages/';
$files = ['about.php', 'president.php', 'strategy.php', 'academic_calendar.php', 'complaints.php', 'contact.php', 'public_grades_query.php', 'students.php'];
foreach ($files as $file) {
    $filepath = $pages_dir . $file;
    if (!file_exists($filepath)) continue;
    $content = file_get_contents($filepath);
    $lines = explode("\n", $content);
    echo "=== File: $file ===\n";
    foreach ($lines as $i => $line) {
        if (preg_match('/<button|<input\s+type=["\'](?:submit|button)["\']|window\.print\(\)|export|print|download/i', $line)) {
            if (stripos($line, 'share') !== false) continue;
            $has_hover = (strpos($line, '189') !== false && strpos($line, '214') !== false) || stripos($line, 'bdd63c') !== false;
            if (!$has_hover) {
                echo "Line " . ($i + 1) . ": " . trim($line) . "\n";
            }
        }
    }
}
?>
