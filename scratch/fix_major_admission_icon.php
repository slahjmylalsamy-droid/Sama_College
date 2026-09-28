<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/major.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// Target "القبول والتسجيل" button icon
$search = '<a href="?p=students" class="nav-pill-btn">
                        <i class="fa-regular fa-file-lines" style="margin-left: 5px;"></i> القبول والتسجيل
                    </a>';

$replace = '<a href="?p=students" class="nav-pill-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> القبول والتسجيل
                    </a>';

$content = str_replace($search, $replace, $content);

file_put_contents($filepath, $content);
echo "pages/major.php admission icon updated successfully.\n";
?>
