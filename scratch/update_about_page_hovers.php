<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Replace .export-action-btn:hover block
$search1 = ".export-action-btn:hover {
    background: #085859;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(8, 88, 89, 0.2);
}";
$replace1 = ".export-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    border-color: rgb(189, 214, 60) !important;
    box-shadow: 0 4px 12px rgba(189, 214, 60, 0.3) !important;
}";

// 2. Replace .video-play-btn-large:hover block
$search2 = ".about-video-slide-box:hover .video-play-btn-large {
    transform: scale(1.15);
    background: #0d4748;
    box-shadow: 0 8px 25px rgba(13, 71, 72, 0.6);
}";
$replace2 = ".about-video-slide-box:hover .video-play-btn-large {
    transform: scale(1.15);
    background: #0d4748;
    box-shadow: 0 8px 25px rgba(13, 71, 72, 0.6);
}
.about-video-slide-box:hover .video-play-btn-large:hover,
.video-play-btn-large:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    box-shadow: 0 8px 25px rgba(189, 214, 60, 0.5) !important;
}";

// 3. Replace .video-play-action-btn:hover block
$search3 = ".video-play-action-btn:hover {
    background: #16a34a;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(22, 163, 74, 0.3);
}";
$replace3 = ".video-play-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}";

// 4. Replace .gallery-download-btn:hover block
$search4 = ".gallery-download-btn:hover {
    background: #085859;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(8, 88, 89, 0.3);
}";
$replace4 = ".gallery-download-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}";

$content = str_replace($search1, $replace1, $content);
$content = str_replace($search2, $replace2, $content);
$content = str_replace($search3, $replace3, $content);
$content = str_replace($search4, $replace4, $content);

file_put_contents($filepath, $content);
echo "pages/about.php hovers updated successfully.\n";
?>
