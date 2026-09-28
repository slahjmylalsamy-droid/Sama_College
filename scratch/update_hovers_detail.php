<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/index.php';
$content = file_get_contents($filepath);

$search1 = '<a href="?p=latest_news" style="background: var(--main-color); color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(8, 88, 89,0.2); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;" onmouseover="this.style.background=\'var(--main-color)\'; this.style.transform=\'translateY(-2px)\'" onmouseout="this.style.background=\'var(--main-color)\'; this.style.transform=\'none\'">عرض الكل</a>';

$replace1 = '<a href="?p=latest_news" style="background: var(--main-color); color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(8, 88, 89,0.2); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'var(--main-color)\'; this.style.transform=\'translateY(-2px)\';" onmouseout="this.style.background=\'var(--main-color)\'; this.style.color=\'white\'; this.style.transform=\'none\'">عرض الكل</a>';

$search2 = '<button onclick="scrollToTop()" id="topBtn" style="display: none; position: fixed; bottom: 20px; left: 20px; z-index: 99; border: none; outline: none; background-color: var(--main-color); color: white; cursor: pointer; padding: 12px 16px; border-radius: 50%; font-size: 16px; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.25);" onmouseover="this.style.background=\'#054445\'; this.style.transform=\'translateY(-3px)\';" onmouseout="this.style.background=\'var(--main-color)\'; this.style.transform=\'none\';">⬆</button>';

$replace2 = '<button onclick="scrollToTop()" id="topBtn" style="display: none; position: fixed; bottom: 20px; left: 20px; z-index: 99; border: none; outline: none; background-color: var(--main-color); color: white; cursor: pointer; padding: 12px 16px; border-radius: 50%; font-size: 16px; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.25);" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'var(--main-color)\'; this.style.transform=\'translateY(-3px)\';" onmouseout="this.style.background=\'var(--main-color)\'; this.style.color=\'white\'; this.style.transform=\'none\';">⬆</button>';

$content_norm = str_replace("\r\n", "\n", $content);
$search1_norm = str_replace("\r\n", "\n", $search1);
$replace1_norm = str_replace("\r\n", "\n", $replace1);
$search2_norm = str_replace("\r\n", "\n", $search2);
$replace2_norm = str_replace("\r\n", "\n", $replace2);

$success = true;

if (strpos($content_norm, $search1_norm) !== false) {
    $content_norm = str_replace($search1_norm, $replace1_norm, $content_norm);
    echo "1. 'View All' button hover replaced successfully.\n";
} else {
    echo "Warning: 'View All' button target not found.\n";
    $success = false;
}

if (strpos($content_norm, $search2_norm) !== false) {
    $content_norm = str_replace($search2_norm, $replace2_norm, $content_norm);
    echo "2. 'Back to Top' button hover replaced successfully.\n";
} else {
    echo "Warning: 'Back to Top' button target not found.\n";
    $success = false;
}

if ($success || strpos($content_norm, 'rgb(189, 214, 60)') !== false) {
    file_put_contents($filepath, $content_norm);
    echo "index.php updated successfully with custom rgb(189, 214, 60) hovers.\n";
}
?>
