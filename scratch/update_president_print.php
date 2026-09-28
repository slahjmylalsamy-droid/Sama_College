<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/president.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Replace media print styling
$search_print_style = '/* Print specific styles */
@media print {
    body * { visibility: hidden; }
    #printablePresidentArea, #printablePresidentArea * { visibility: visible; }
    #printablePresidentArea { position: absolute; left: 0; top: 0; width: 100%; }
    .president-actions-bar, .president-bottom-nav { display: none !important; }
}';

$replace_print_style = '/* Print specific styles */
@media print {
    /* Hide all layout elements completely */
    header, footer, nav, .president-bottom-nav, .president-actions-bar,
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
    
    /* Clean up the president container layout for print */
    .president-container {
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
    .president-title {
        font-size: 13pt !important;
        margin-bottom: 12px !important;
        text-align: center !important;
        width: 100% !important;
        color: #0d4748 !important;
        font-weight: 800 !important;
    }
    .president-title::after {
        display: none !important;
    }
    
    /* Print grid layout - side by side */
    .president-grid {
        display: flex !important;
        flex-direction: row !important;
        gap: 20px !important;
        align-items: flex-start !important;
        width: 100% !important;
    }
    
    .president-text-col {
        flex: 1 !important;
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        text-align: justify !important;
    }
    
    .president-subheading {
        font-size: 10pt !important;
        font-weight: bold !important;
        margin-top: 8px !important;
        margin-bottom: 4px !important;
    }
    
    .president-dept-list {
        font-size: 9pt !important;
        line-height: 1.35 !important;
        margin-bottom: 8px !important;
        padding-right: 15px !important;
    }
    
    .president-signature {
        margin-top: 15px !important;
    }
    
    /* Image column print style */
    .president-image-col {
        flex: 0 0 150px !important;
        max-width: 150px !important;
        display: block !important;
    }
    
    .president-img-card {
        border: 1px solid #aaa !important;
        border-radius: 8px !important;
        box-shadow: none !important;
        padding: 0 !important;
        background: none !important;
    }
    
    .president-img-card img {
        border-radius: 6px !important;
        width: 100% !important;
        display: block !important;
    }
    
    /* A4 Page printing size optimization */
    @page {
        size: A4 portrait;
        margin: 0.5cm 0.6cm 0.5cm 0.6cm !important;
    }
}';

$content = str_replace($search_print_style, $replace_print_style, $content);

// 2. Insert print letterhead logo header
$search_heading = '<div class="president-container" id="printablePresidentArea">
        
        <!-- Heading -->
        <h1 class="president-title">كلمة عميد الكلية</h1>';

$replace_heading = '<div class="president-container" id="printablePresidentArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>كلمة عميد الكلية بمناسبة العام الدراسي الجديد</p>
        </div>
        
        <!-- Heading -->
        <h1 class="president-title">كلمة عميد الكلية</h1>';

$content = str_replace($search_heading, $replace_heading, $content);

// 3. Replace print button with SVG
$search_print_btn = '<button onclick="window.print()" class="export-action-btn">
                <i class="fa-solid fa-print" style="margin-left: 5px;"></i> طباعة الصفحة
            </button>';
$replace_print_btn = '<button onclick="window.print()" class="export-action-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
            </button>';

$content = str_replace($search_print_btn, $replace_print_btn, $content);

// 4. Replace PDF button with SVG
$search_pdf_btn = '<button onclick="exportPresidentPDF()" class="export-action-btn" style="background:#085859; color:white;">
                <i class="fa-solid fa-file-pdf" style="margin-left: 5px;"></i> حفظ كـ PDF
            </button>';
$replace_pdf_btn = '<button onclick="exportPresidentPDF()" class="export-action-btn" style="background:#085859; color:white;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
            </button>';

$content = str_replace($search_pdf_btn, $replace_pdf_btn, $content);

file_put_contents($filepath, $content);
echo "pages/president.php print styles and layout updated successfully.\n";
?>
