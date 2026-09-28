<?php
// 1. Update index.php
$index_path = 'c:/xampp1/htdocs/Sama_College/index.php';
$index_content = file_get_contents($index_path);
$index_content = str_replace("\r\n", "\n", $index_content);

$search_breadcrumb = '<div style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: \'Cairo\', sans-serif; direction: rtl; justify-content: flex-start;">';
$replace_breadcrumb = '<div class="breadcrumb-container" style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: \'Cairo\', sans-serif; direction: rtl; justify-content: flex-start;">';

$search_subnav = '<div style="background:#f4f6f9; padding: 20px 20px 0;">
    <div style="max-width:900px; margin:auto; display:flex; justify-content:flex-end;">';
$replace_subnav = '<div class="subpage-dropdown-banner" style="background:#f4f6f9; padding: 20px 20px 0;">
    <div style="max-width:900px; margin:auto; display:flex; justify-content:flex-end;">';

$index_content = str_replace($search_breadcrumb, $replace_breadcrumb, $index_content);
$index_content = str_replace($search_subnav, $replace_subnav, $index_content);
file_put_contents($index_path, $index_content);
echo "1. index.php breadcrumbs and subnav container classes updated.\n";


// 2. Update pages/about.php
$about_path = 'c:/xampp1/htdocs/Sama_College/pages/about.php';
$about_content = file_get_contents($about_path);
$about_content = str_replace("\r\n", "\n", $about_content);

// 2a. Replace print media query block
$search_print_query = '/* Print specific styles */
@media print {
    body * { visibility: hidden; }
    #printableAboutArea, #printableAboutArea * { visibility: visible; }
    #printableAboutArea { position: absolute; left: 0; top: 0; width: 100%; }
    .about-actions-bar, .about-bottom-nav, .about-video-wrapper, .about-gallery-wrapper, .media-section-title { display: none !important; }
}';

$replace_print_query = '/* Print specific styles */
@media print {
    /* Hide all layout elements completely */
    header, footer, nav, .about-bottom-nav, .media-section-title, 
    .about-video-wrapper, .about-gallery-wrapper, .share-group, 
    .export-group, .btn-back-to-home, #aboutToast, .about-actions-bar,
    .breadcrumb-container, .subpage-dropdown-banner,
    div[style*="background:#f4f6f9"][style*="padding: 15px 20px"],
    div[style*="background:#f4f6f9"][style*="padding: 20px 20px 0"] {
        display: none !important;
    }
    
    /* Reset visibility for everything else to let display:none work perfectly */
    body * {
        visibility: visible;
    }
    
    /* Ensure the body and html take full height and have zero padding */
    html, body {
        background: #ffffff !important;
        color: #000000 !important;
        margin: 0 !important;
        padding: 0 !important;
        height: auto !important;
        font-family: \'Cairo\', \'Segoe UI\', sans-serif !important;
        font-size: 11pt !important;
        line-height: 1.4 !important;
        width: 100% !important;
    }
    
    /* Clean up the about container layout for print */
    .about-container {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        background: #ffffff !important;
        display: block !important;
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
    }
    
    /* Center college logo & name at the top for official print layout */
    .print-logo-header {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        margin-bottom: 20px !important;
        padding-bottom: 12px !important;
        border-bottom: 3px double #0d4748 !important;
    }
    
    .print-logo-header img {
        width: 80px !important;
        height: 80px !important;
        margin-bottom: 6px !important;
        object-fit: contain !important;
    }
    
    .print-logo-header h1 {
        font-size: 14pt !important;
        font-weight: 800 !important;
        color: #0d4748 !important;
        margin: 0 0 4px 0 !important;
    }
    
    .print-logo-header p {
        font-size: 10pt !important;
        color: #444444 !important;
        margin: 0 !important;
        font-weight: 700 !important;
    }
    
    /* Compact content elements to ensure they fit strictly on ONE single A4 page */
    .about-title {
        font-size: 13pt !important;
        margin-bottom: 12px !important;
        text-align: center !important;
        width: 100% !important;
        color: #0d4748 !important;
        font-weight: 800 !important;
    }
    .about-title::after {
        display: none !important;
    }
    
    .about-intro-text {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        margin-bottom: 8px !important;
        text-align: justify !important;
    }
    
    .about-highlight-box {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        margin-bottom: 12px !important;
        padding: 8px 12px !important;
        border-right: 4px solid #085859 !important;
        background: #f0f7f7 !important;
        color: #0d4748 !important;
    }
    
    .about-section-subtitle {
        font-size: 10.5pt !important;
        margin-bottom: 5px !important;
        color: #0d4748 !important;
        font-weight: 700 !important;
    }
    
    .about-bullet-list {
        font-size: 9pt !important;
        line-height: 1.35 !important;
        margin-bottom: 12px !important;
        padding-right: 15px !important;
    }
    
    .table-main-heading {
        font-size: 11pt !important;
        margin-top: 12px !important;
        margin-bottom: 8px !important;
        text-align: center !important;
        color: #0d4748 !important;
        font-weight: 800 !important;
        text-decoration: none !important;
    }
    
    .table-sub-heading {
        font-size: 9.5pt !important;
        margin-top: 8px !important;
        margin-bottom: 4px !important;
        color: #0d4748 !important;
        font-weight: 700 !important;
    }
    
    .custom-program-table {
        margin-bottom: 8px !important;
        font-size: 8.5pt !important;
        width: 100% !important;
        border: 1px solid #aaa !important;
    }
    
    .custom-program-table th {
        background-color: #0d4748 !important;
        color: #ffffff !important;
        padding: 5px 8px !important;
        font-weight: 700 !important;
        border: 1px solid #aaa !important;
    }
    
    .custom-program-table td {
        padding: 4px 8px !important;
        border: 1px solid #aaa !important;
    }
    
    /* A4 Page printing size optimization */
    @page {
        size: A4 portrait;
        margin: 0.5cm 0.6cm 0.5cm 0.6cm !important;
    }
}';

$about_content = str_replace($search_print_query, $replace_print_query, $about_content);

// 2b. Add centered logo header under the about-container (right before the heading)
$search_heading = '<div class="about-container" id="printableAboutArea">
        
        <!-- Heading -->
        <h1 class="about-title">نبذة عن الكلية</h1>';

$replace_heading = '<div class="about-container" id="printableAboutArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>تقرير تعريفي عن الكلية - نبذة عامة</p>
        </div>
        
        <!-- Heading -->
        <h1 class="about-title">نبذة عن الكلية</h1>';

$about_content = str_replace($search_heading, $replace_heading, $about_content);
file_put_contents($about_path, $about_content);
echo "2. pages/about.php print query and print-header logo updated.\n";
?>
