<?php
// 1. Update index.php with global .nav-pill-btn hover styles
$index_path = 'c:/xampp1/htdocs/Sama_College/index.php';
$index_content = file_get_contents($index_path);
$index_content = str_replace("\r\n", "\n", $index_content);

$search_index = ".btn-back-to-home svg {
    width: 18px !important;
    height: 18px !important;
    display: inline-block !important;
    vertical-align: middle !important;
}";

$replace_index = ".btn-back-to-home svg {
    width: 18px !important;
    height: 18px !important;
    display: inline-block !important;
    vertical-align: middle !important;
}
/* Navigation pill hover styles override */
.nav-pill-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}
.nav-pill-btn.home-pill:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
}";

if (strpos($index_content, $search_index) !== false) {
    $index_content = str_replace($search_index, $replace_index, $index_content);
    file_put_contents($index_path, $index_content);
    echo "1. index.php global styles updated successfully.\n";
} else {
    echo "Warning: index.php search target not found.\n";
}

// 2. Update pages/complaints.php
$complaints_path = 'c:/xampp1/htdocs/Sama_College/pages/complaints.php';
$complaints_content = file_get_contents($complaints_path);
$complaints_content = str_replace("\r\n", "\n", $complaints_content);

$search_comp_submit = 'type="submit" name="submit_complaint" style="width:100%; background:linear-gradient(135deg, #0d4748, #1c7f7c); color:white; border:none; padding:12px; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; box-shadow:0 4px 15px rgba(13, 71, 72,0.15);" onmouseover="this.style.transform=\'translateY(-1px)\';" onmouseout="this.style.transform=\'none\';">';
$replace_comp_submit = 'type="submit" name="submit_complaint" style="width:100%; background:linear-gradient(135deg, #0d4748, #1c7f7c); color:white; border:none; padding:12px; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; box-shadow:0 4px 15px rgba(13, 71, 72,0.15);" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\'; this.style.transform=\'translateY(-1px)\';" onmouseout="this.style.background=\'linear-gradient(135deg, #0d4748, #1c7f7c)\'; this.style.color=\'white\'; this.style.transform=\'none\';">';

$search_comp_track = 'type="submit" name="track_complaint" style="width:100%; background:#0d4748; color:white; border:none; padding:10px; border-radius:8px; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'#072928\';" onmouseout="this.style.background=\'#0d4748\';">';
$replace_comp_track = 'type="submit" name="track_complaint" style="width:100%; background:#0d4748; color:white; border:none; padding:10px; border-radius:8px; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\';">';

$complaints_content = str_replace($search_comp_submit, $replace_comp_submit, $complaints_content);
$complaints_content = str_replace($search_comp_track, $replace_comp_track, $complaints_content);
file_put_contents($complaints_path, $complaints_content);
echo "2. pages/complaints.php hovers updated successfully.\n";

// 3. Update pages/public_grades_query.php
$grades_path = 'c:/xampp1/htdocs/Sama_College/pages/public_grades_query.php';
$grades_content = file_get_contents($grades_path);
$grades_content = str_replace("\r\n", "\n", $grades_content);

$search_grades_submit = 'type="submit" name="query_grades" 
                        style="width:100%; padding:14px; background:#0d4748; color:white; border:none; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; font-family:\'Cairo\',sans-serif;"
                        onmouseover="this.style.background=\'#072928\';" onmouseout="this.style.background=\'#0d4748\';">';
$replace_grades_submit = 'type="submit" name="query_grades" 
                        style="width:100%; padding:14px; background:#0d4748; color:white; border:none; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; font-family:\'Cairo\',sans-serif;"
                        onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\';">';

$search_grades_print = 'onclick="printStudentTranscript()" style="background:#16a34a; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(22,163,74,0.2);" onmouseover="this.style.background=\'#15803d\';" onmouseout="this.style.background=\'#16a34a\';">';
$replace_grades_print = 'onclick="printStudentTranscript()" style="background:#16a34a; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(22,163,74,0.2);" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#16a34a\'; this.style.color=\'white\';">';

$search_grades_pdf = 'onclick="printStudentTranscript()" style="background:#0d4748; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(13, 71, 72,0.2);" onmouseover="this.style.background=\'#072928\';" onmouseout="this.style.background=\'#0d4748\';">';
$replace_grades_pdf = 'onclick="printStudentTranscript()" style="background:#0d4748; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(13, 71, 72,0.2);" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\';">';

$grades_content = str_replace($search_grades_submit, $replace_grades_submit, $grades_content);
$grades_content = str_replace($search_grades_print, $replace_grades_print, $grades_content);
$grades_content = str_replace($search_grades_pdf, $replace_grades_pdf, $grades_content);
file_put_contents($grades_path, $grades_content);
echo "3. pages/public_grades_query.php hovers updated successfully.\n";
?>
