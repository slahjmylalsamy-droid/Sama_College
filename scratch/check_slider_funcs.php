<?php
$index = file_get_contents('c:/xampp1/htdocs/Sama_College/index.php');
if (strpos($index, 'function prevSlide') !== false) {
    echo "prevSlide defined in index.php\n";
} else {
    echo "prevSlide NOT defined in index.php\n";
}
if (strpos($index, 'function nextSlide') !== false) {
    echo "nextSlide defined in index.php\n";
} else {
    echo "nextSlide NOT defined in index.php\n";
}

$js = file_get_contents('c:/xampp1/htdocs/Sama_College/script.js');
if (strpos($js, 'prevSlide') !== false) {
    echo "prevSlide defined in script.js\n";
} else {
    echo "prevSlide NOT defined in script.js\n";
}
if (strpos($js, 'nextSlide') !== false) {
    echo "nextSlide defined in script.js\n";
} else {
    echo "nextSlide NOT defined in script.js\n";
}
?>
