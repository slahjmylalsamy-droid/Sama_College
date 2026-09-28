<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

$search_print = '<button onclick="window.print()" class="export-action-btn">
                    <i class="fa-solid fa-print"></i> طباعة الصفحة
                </button>';
$replace_print = '<button onclick="window.print()" class="export-action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
                </button>';

$search_pdf = '<button onclick="exportAboutPDF()" class="export-action-btn" style="background:#085859; color:white;">
                    <i class="fa-solid fa-file-pdf"></i> حفظ كـ PDF
                </button>';
$replace_pdf = '<button onclick="exportAboutPDF()" class="export-action-btn" style="background:#085859; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
                </button>';

$content = str_replace($search_print, $replace_print, $content);
$content = str_replace($search_pdf, $replace_pdf, $content);

file_put_contents($filepath, $content);
echo "pages/about.php print and pdf icons updated successfully.\n";
?>
