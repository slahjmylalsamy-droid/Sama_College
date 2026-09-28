<?php
$files = [
    'c:/xampp1/htdocs/Sama_College/pages/community_college.php',
    'c:/xampp1/htdocs/Sama_College/pages/community_services.php',
    'c:/xampp1/htdocs/Sama_College/pages/medical_institute.php',
    'c:/xampp1/htdocs/Sama_College/pages/training_center.php'
];

$search_college = '<a href="?p=community_college" class="nav-pill-btn">
                <i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> كلية المجتمع
            </a>';
$replace_college = '<a href="?p=community_college" class="nav-pill-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg> كلية المجتمع
            </a>';

$search_services = '<a href="?p=community_services" class="nav-pill-btn">
                <i class="fa-solid fa-handshake" style="margin-left: 5px;"></i> مركز خدمة المجتمع والدراسات
            </a>';
$replace_services = '<a href="?p=community_services" class="nav-pill-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> مركز خدمة المجتمع والدراسات
            </a>';

foreach ($files as $filepath) {
    if (file_exists($filepath)) {
        $content = file_get_contents($filepath);
        $content = str_replace("\r\n", "\n", $content);
        
        $content = str_replace($search_college, $replace_college, $content);
        $content = str_replace($search_services, $replace_services, $content);
        
        file_put_contents($filepath, $content);
        echo "Updated $filepath\n";
    } else {
        echo "File does not exist: $filepath\n";
    }
}
?>
