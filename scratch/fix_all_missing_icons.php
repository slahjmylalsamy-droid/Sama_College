<?php
// 1. Update pages/about.php
$about_path = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$about_content = file_get_contents($about_path);
$about_content = str_replace("\r\n", "\n", $about_content);

// Download video current
$search_about_v1 = '<button onclick="downloadCurrentVideo()" class="gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                    <i class="fa-solid fa-download"></i> تنزيل الفيديو الحالي
                </button>';
$replace_about_v1 = '<button onclick="downloadCurrentVideo()" class="gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الفيديو الحالي
                </button>';

// Download videos all
$search_about_v2 = '<button onclick="downloadAllVideos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                    <i class="fa-solid fa-box-archive"></i> تنزيل جميع الفيديوهات
                </button>';
$replace_about_v2 = '<button onclick="downloadAllVideos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الفيديوهات
                </button>';

// Download gallery photo current
$search_about_g1 = '<button onclick="downloadCurrentGalleryPhoto()" class="gallery-download-btn" title="تنزيل الصورة الظاهرة حالياً">
                    <i class="fa-solid fa-download"></i> تنزيل الصورة المعروضة
                </button>';
$replace_about_g1 = '<button onclick="downloadCurrentGalleryPhoto()" class="gallery-download-btn" title="تنزيل الصورة الظاهرة حالياً">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الصورة المعروضة
                </button>';

// Download gallery photos all
$search_about_g2 = '<button onclick="downloadAllGalleryPhotos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع صور المعرض مرة واحدة">
                    <i class="fa-solid fa-box-archive"></i> تنزيل جميع الصور
                </button>';
$replace_about_g2 = '<button onclick="downloadAllGalleryPhotos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع صور المعرض مرة واحدة">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الصور
                </button>';

// Strategy subnav in about.php
$search_about_strat = '<a href="?p=strategy" class="nav-pill-btn">
                <i class="fa-solid fa-chart-line" style="margin-left: 5px;"></i> الخطة الاستراتيجية
            </a>';
$replace_about_strat = '<a href="?p=strategy" class="nav-pill-btn">
                📌 الخطة الاستراتيجية
            </a>';

$about_content = str_replace($search_about_v1, $replace_about_v1, $about_content);
$about_content = str_replace($search_about_v2, $replace_about_v2, $about_content);
$about_content = str_replace($search_about_g1, $replace_about_g1, $about_content);
$about_content = str_replace($search_about_g2, $replace_about_g2, $about_content);
$about_content = str_replace($search_about_strat, $replace_about_strat, $about_content);

file_put_contents($about_path, $about_content);
echo "1. pages/about.php updated with beautiful inline SVGs and Emojis.\n";

// 2. Update pages/president.php
$pres_path = 'c:/xampp1/htdocs/Sama_College/pages/president.php';
$pres_content = file_get_contents($pres_path);
$pres_content = str_replace("\r\n", "\n", $pres_content);

$search_pres_vision = '<a href="?p=vision" class="nav-pill-btn">
                <i class="fa-solid fa-eye" style="margin-left: 5px;"></i> الرؤية والرسالة
            </a>';
$replace_pres_vision = '<a href="?p=vision" class="nav-pill-btn">
                🎯 الرؤية والرسالة
            </a>';

$search_pres_strat = '<a href="?p=strategy" class="nav-pill-btn">
                <i class="fa-solid fa-chart-line" style="margin-left: 5px;"></i> الخطة الاستراتيجية
            </a>';
$replace_pres_strat = '<a href="?p=strategy" class="nav-pill-btn">
                📌 الخطة الاستراتيجية
            </a>';

$pres_content = str_replace($search_pres_vision, $replace_pres_vision, $pres_content);
$pres_content = str_replace($search_pres_strat, $replace_pres_strat, $pres_content);
file_put_contents($pres_path, $pres_content);
echo "2. pages/president.php updated.\n";

// 3. Update pages/strategy.php
$strat_path = 'c:/xampp1/htdocs/Sama_College/pages/strategy.php';
$strat_content = file_get_contents($strat_path);
$strat_content = str_replace("\r\n", "\n", $strat_content);

$search_strat_vision = '<a href="?p=vision" class="nav-pill-btn">
                <i class="fa-solid fa-eye" style="margin-left: 5px;"></i> الرؤية والرسالة
            </a>';
$replace_strat_vision = '<a href="?p=vision" class="nav-pill-btn">
                🎯 الرؤية والرسالة
            </a>';

$strat_content = str_replace($search_strat_vision, $replace_strat_vision, $strat_content);
file_put_contents($strat_path, $strat_content);
echo "3. pages/strategy.php updated.\n";
?>
