<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Target "تشغيل الفيديو"
$search_play = '<button onclick="playCurrentVideo()" class="video-play-action-btn" title="تشغيل الفيديو داخل المشغل">
                        <i class="fa-solid fa-play"></i> تشغيل الفيديو
                    </button>';
$replace_play = '<button onclick="playCurrentVideo()" class="video-play-action-btn" title="تشغيل الفيديو داخل المشغل">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg> تشغيل الفيديو
                    </button>';

// 2. Target "تنزيل الفيديو الحالي"
$search_dl_cur = '<button onclick="downloadCurrentVideo()" class="gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                        <i class="fa-solid fa-download"></i> تنزيل الفيديو الحالي
                    </button>';
$replace_dl_cur = '<button onclick="downloadCurrentVideo()" class="gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الفيديو الحالي
                    </button>';

// 3. Target "تنزيل جميع الفيديوهات"
$search_dl_all = '<button onclick="downloadAllVideos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                        <i class="fa-solid fa-box-archive"></i> تنزيل جميع الفيديوهات
                    </button>';
$replace_dl_all = '<button onclick="downloadAllVideos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الفيديوهات
                    </button>';

$content = str_replace($search_play, $replace_play, $content);
$content = str_replace($search_dl_cur, $replace_dl_cur, $content);
$content = str_replace($search_dl_all, $replace_dl_all, $content);

file_put_contents($filepath, $content);
echo "pages/about.php video buttons and icons updated successfully.\n";
?>
