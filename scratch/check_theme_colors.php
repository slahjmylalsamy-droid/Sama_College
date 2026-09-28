<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
if (strpos($content, 'theme_color') !== false) {
    echo "theme_color found in index.php\n";
} else {
    echo "theme_color NOT found in index.php\n";
}
if (strpos($content, 'accent_color') !== false) {
    echo "accent_color found in index.php\n";
} else {
    echo "accent_color NOT found in index.php\n";
}
?>
