<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/major.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Add screen CSS rule to hide print-logo-header by default
$search_container_css = '.major-page-container {
    direction: rtl;
    font-family: \'Cairo\', sans-serif;
    color: #333;
    max-width: 1100px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}';
$replace_container_css = '.major-page-container {
    direction: rtl;
    font-family: \'Cairo\', sans-serif;
    color: #333;
    max-width: 1100px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.print-logo-header {
    display: none;
}';
$content = str_replace($search_container_css, $replace_container_css, $content);

// 2. Remove the nested print logo header from line 1102
$search_nested_header = '        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>الدليل التعريفي لتخصص: <?php echo $major_data[\'title\']; ?></p>
        </div>';
$content = str_replace($search_nested_header, '', $content);

// 3. Place the clean print logo header at the very top of .major-page-container (right before the grid)
$search_grid_start = '<div class="major-page-container" id="printableMajorArea">
        
        <div class="major-main-grid">';
$replace_grid_start = '<div class="major-page-container" id="printableMajorArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>الدليل التعريفي لتخصص: <?php echo $major_data[\'title\']; ?></p>
        </div>
        
        <div class="major-main-grid">';
$content = str_replace($search_grid_start, $replace_grid_start, $content);

file_put_contents($filepath, $content);
echo "pages/major.php refactored for printing logo header.\n";
?>
