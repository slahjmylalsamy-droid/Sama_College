<?php
$pages_dir = 'c:/xampp1/htdocs/Sama_College/pages/';
$files = scandir($pages_dir);
foreach ($files as $file) {
    if ($file === '.' || $file === '..') continue;
    $filepath = $pages_dir . $file;
    if (is_dir($filepath)) continue;
    
    $content = file_get_contents($filepath);
    $lines = explode("\n", $content);
    
    foreach ($lines as $i => $line) {
        // Look for buttons, submit inputs, links styled as buttons, or window.print
        if (preg_match('/<button|<input\s+type=["\'](?:submit|button)["\']|window\.print\(\)|class=["\'][^"\']*(?:btn|button|download|print)[^"\']*/i', $line)) {
            // Exclude share buttons or share classes if specified (e.g. social share, shares, etc.)
            if (stripos($line, 'share') !== false) {
                // If it is indeed a share button, skip it to obey "معادا ايقوناة المشاركة لاتغير فيا اي شي"
                continue;
            }
            // Check if this line has hover color rgb(189, 214, 60) or #bdd63c
            $has_hover = (strpos($line, '189') !== false && strpos($line, '214') !== false) || stripos($line, 'bdd63c') !== false;
            
            // Also check if hover is defined in styling section of the file
            $has_style_hover = false;
            // Scan styling block (usually in the same file or global, but let's check local style tags first)
            // If the button has a class, search style block for that class hover.
            
            if (!$has_hover) {
                // Let's print candidate lines that might need hover updates
                echo "File: $file, Line: " . ($i + 1) . "\n";
                echo "   Content: " . trim($line) . "\n\n";
            }
        }
    }
}
?>
