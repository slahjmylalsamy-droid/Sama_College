<?php
$content = file_get_contents('c:/xampp1/htdocs/Sama_College/pages/about.php');
$lines = explode("\n", $content);
$keywords = ['طباعة الصفحة', 'حفظ كـ PDF', 'تشغيل الفيديو', 'تنزيل الفيديو الحالي', 'تنزيل جميع الفيديوهات', 'عرض الصورة', 'تنزيل جميع الصور', 'play-btn', 'download'];

foreach ($lines as $idx => $line) {
    foreach ($keywords as $keyword) {
        if (strpos($line, $keyword) !== false) {
            echo "Line " . ($idx + 1) . ": " . trim($line) . "\n";
            break;
        }
    }
}
?>
