<?php
// 1. Update pages/students.php
$students_path = 'c:/xampp1/htdocs/Sama_College/pages/students.php';
$students_content = file_get_contents($students_path);
$students_content = str_replace("\r\n", "\n", $students_content);

$replacements_students = [
    // Send button
    'onmouseover="this.style.background=\'#085859\'" onmouseout="this.style.background=\'#0d4748\'"' => 'onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\';"',
    
    // Download button
    'onmouseover="this.style.background=\'white\';this.style.color=\'#085859\'" onmouseout="this.style.background=\'transparent\';this.style.color=\'white\'"' => 'onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\'; this.style.borderColor=\'rgb(189, 214, 60)\';" onmouseout="this.style.background=\'transparent\'; this.style.color=\'white\'; this.style.borderColor=\'white\';"',
    
    // Export PDF button
    'onmouseover="this.style.background=\'#085859\'" onmouseout="this.style.background=\'#0d4748\'"' => 'onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\';"',
    
    // Print Calendar Report button
    'onmouseover="this.style.background=\'#0d4748\'" onmouseout="this.style.background=\'#085859\'"' => 'onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#085859\'; this.style.color=\'white\';"'
];

// Note: the send and export buttons both have the same search string, so we can replace them sequentially or using str_replace
// Let's perform exact targeted replacements to avoid overlaps.
// Let's do exact substring replacement for line 242-244
$search_send = 'style="background:#0d4748;color:white;border:none;padding:12px 40px;border-radius:6px;font-size:16px;font-weight:bold;font-family:\'Cairo\',sans-serif;cursor:pointer;transition:0.3s;" onmouseover="this.style.background=\'#085859\'" onmouseout="this.style.background=\'#0d4748\'">';
$replace_send = 'style="background:#0d4748;color:white;border:none;padding:12px 40px;border-radius:6px;font-size:16px;font-weight:bold;font-family:\'Cairo\',sans-serif;cursor:pointer;transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\'">';

// Let's do exact substring replacement for line 285-287
$search_download = 'style="display:inline-block;border:2px solid white;color:white;padding:8px 25px;border-radius:4px;text-decoration:none;font-size:14px;font-weight:bold;transition:0.3s;" onmouseover="this.style.background=\'white\';this.style.color=\'#085859\'" onmouseout="this.style.background=\'transparent\';this.style.color=\'white\'">';
$replace_download = 'style="display:inline-block;border:2px solid white;color:white;padding:8px 25px;border-radius:4px;text-decoration:none;font-size:14px;font-weight:bold;transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\'; this.style.borderColor=\'rgb(189, 214, 60)\';" onmouseout="this.style.background=\'transparent\'; this.style.color=\'white\'; this.style.borderColor=\'white\'">';

// Let's do exact substring replacement for line 353-356
$search_export = 'style="display:inline-flex; align-items:center; gap:8px; background:#0d4748; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'#085859\'" onmouseout="this.style.background=\'#0d4748\'">';
$replace_export = 'style="display:inline-flex; align-items:center; gap:8px; background:#0d4748; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\'">';

// Let's do exact substring replacement for line 358-361
$search_print = 'style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'#0d4748\'" onmouseout="this.style.background=\'#085859\'">';
$replace_print = 'style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#085859\'; this.style.color=\'white\'">';

$students_content = str_replace($search_send, $replace_send, $students_content);
$students_content = str_replace($search_download, $replace_download, $students_content);
$students_content = str_replace($search_export, $replace_export, $students_content);
$students_content = str_replace($search_print, $replace_print, $students_content);

file_put_contents($students_path, $students_content);
echo "pages/students.php updated successfully.\n";

// 2. Update pages/academic_calendar.php
$cal_path = 'c:/xampp1/htdocs/Sama_College/pages/academic_calendar.php';
$cal_content = file_get_contents($cal_path);
$cal_content = str_replace("\r\n", "\n", $cal_content);

$search_cal_pdf = 'onmouseover="this.style.background=\'#072928\'; this.style.transform=\'translateY(-1px)\';" onmouseout="this.style.background=\'#0d4748\'; this.style.transform=\'none\';"';
$replace_cal_pdf = 'onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\'; this.style.transform=\'translateY(-1px)\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\'; this.style.transform=\'none\';"';

$cal_content = str_replace($search_cal_pdf, $replace_cal_pdf, $cal_content);
file_put_contents($cal_path, $cal_content);
echo "pages/academic_calendar.php updated successfully.\n";
?>
