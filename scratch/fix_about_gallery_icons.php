<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Target "تنزيل الصورة المعروضة"
$search_g1 = '<button onclick="downloadCurrentGalleryPhoto()" class="gallery-download-btn" title="تنزيل الصورة الظاهرة حالياً">
                        <i class="fa-solid fa-download"></i> تنزيل الصورة المعروضة
                    </button>';
$replace_g1 = '<button onclick="downloadCurrentGalleryPhoto()" class="gallery-download-btn" title="تنزيل الصورة الظاهرة حالياً">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الصورة المعروضة
                    </button>';

// 2. Target "تنزيل جميع الصور"
$search_g2 = '<button onclick="downloadAllGalleryPhotos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع صور المعرض مرة واحدة">
                        <i class="fa-solid fa-box-archive"></i> تنزيل جميع الصور
                    </button>';
$replace_g2 = '<button onclick="downloadAllGalleryPhotos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع صور المعرض مرة واحدة">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الصور
                    </button>';

$content = str_replace($search_g1, $replace_g1, $content);
$content = str_replace($search_g2, $replace_g2, $content);

file_put_contents($filepath, $content);
echo "pages/about.php gallery buttons and icons updated successfully.\n";
?>
