<?php
$index_content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
$lines = explode("\n", $index_content);
$in_switcher = false;
$line_start = 1707;
$bracket_count = 0;
// We look for the endif; that matches the start at line 1707
// Since it's using alternative syntax:
// if ($page == 'about'):
// elseif ...
// ...
// endif;
// Let's search for "endif;" or similar below line 1707
for ($i = $line_start; $i < count($lines); $i++) {
    $line = trim($lines[$i]);
    if (strpos($line, 'endif;') !== false) {
        echo "Found endif; at line " . ($i + 1) . ": " . $line . "\n";
    }
}
?>
