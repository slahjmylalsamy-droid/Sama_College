<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
if (strpos($content, 'style.css') !== false) {
    echo "style.css is linked in index.php\n";
} else {
    echo "style.css is NOT linked in index.php\n";
}
?>
