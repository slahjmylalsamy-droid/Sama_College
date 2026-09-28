<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/contact.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Target map buttons on line 168 and 204
$search_map1 = 'href="https://maps.app.goo.gl/LXAGdWTzoy7mfjTb9" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background=\'#0d4748\'" onmouseout="this.style.background=\'#085859\'">';
$replace_map1 = 'href="https://maps.app.goo.gl/LXAGdWTzoy7mfjTb9" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#085859\'; this.style.color=\'white\';">';

$search_map2 = 'href="https://maps.google.com/?q=الراهدة،+تعز،+اليمن" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background=\'#0d4748\'" onmouseout="this.style.background=\'#085859\'">';
$replace_map2 = 'href="https://maps.google.com/?q=الراهدة،+تعز،+اليمن" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#085859\'; this.style.color=\'white\';">';

// 2. Target submit button on line 289
$search_send = 'button type="submit" style="background:#0d4748; color:white; border:none; padding:12px 45px; border-radius:4px; font-weight:bold; font-size:16px; cursor:pointer; font-family:\'Cairo\', sans-serif; transition:0.3s; margin-right:auto;" onmouseover="this.style.background=\'#085859\'" onmouseout="this.style.background=\'#0d4748\'">';
$replace_send = 'button type="submit" style="background:#0d4748; color:white; border:none; padding:12px 45px; border-radius:4px; font-weight:bold; font-size:16px; cursor:pointer; font-family:\'Cairo\', sans-serif; transition:0.3s; margin-right:auto;" onmouseover="this.style.background=\'rgb(189, 214, 60)\'; this.style.color=\'#0d4748\';" onmouseout="this.style.background=\'#0d4748\'; this.style.color=\'white\'">';

$content = str_replace($search_map1, $replace_map1, $content);
$content = str_replace($search_map2, $replace_map2, $content);
$content = str_replace($search_send, $replace_send, $content);

file_put_contents($filepath, $content);
echo "pages/contact.php hovers updated successfully.\n";
?>
