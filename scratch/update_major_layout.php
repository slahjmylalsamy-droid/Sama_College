<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/pages/major.php';
$content = file_get_contents($filepath);
$content = str_replace("\r\n", "\n", $content);

// 1. Replace CSS hover rule
$search_css = '.export-action-btn:hover {
    background: #085859;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(8, 88, 89, 0.2);
}';
$replace_css = '.export-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    border-color: rgb(189, 214, 60) !important;
    box-shadow: 0 4px 12px rgba(189, 214, 60, 0.3) !important;
}';
$content = str_replace($search_css, $replace_css, $content);

// 2. Replace print media query block
$search_print_style = '/* Print specific styles */
@media print {
    body * { visibility: hidden; }
    #printableMajorArea, #printableMajorArea * { visibility: visible; }
    #printableMajorArea { position: absolute; left: 0; top: 0; width: 100%; }
    .major-actions-bar, .major-bottom-nav, .major-sidebar { display: none !important; }
}';

$replace_print_style = '/* Print specific styles */
@media print {
    /* Hide all layout elements completely */
    header, footer, nav, .major-bottom-nav, .major-actions-bar, .major-sidebar,
    .breadcrumb-container, .subpage-dropdown-banner, .major-section-label,
    .major-gallery-slide-box, .major-gallery-controls-bar, .major-gallery-arrow,
    .export-group, .btn-back-to-home, #majorToast,
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
    
    /* Clean up the container layout for print */
    .major-page-container {
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
    
    .major-main-grid {
        display: block !important;
    }
    
    .major-content-col {
        width: 100% !important;
        padding: 0 !important;
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
        width: 85px !important;
        height: 85px !important;
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
        font-size: 10.5pt !important;
        color: #444444 !important;
        margin: 0 !important;
        font-weight: 700 !important;
    }
    
    /* Title print styling */
    .major-main-title {
        font-size: 14pt !important;
        text-align: center !important;
        color: #0d4748 !important;
        font-weight: 800 !important;
        margin-bottom: 12px !important;
    }
    
    /* Section texts */
    .major-intro-speech {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        text-align: justify !important;
        margin-bottom: 10px !important;
    }
    
    .major-head-speech-card {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        margin-bottom: 12px !important;
        padding: 8px 12px !important;
        background: #f0f7f7 !important;
        border-right: 4px solid #0d4748 !important;
    }
    
    .major-head-speech-card h4 {
        margin: 0 0 4px 0 !important;
        font-size: 10.5pt !important;
        color: #0d4748 !important;
        font-weight: bold !important;
    }
    
    .major-outcomes-list {
        font-size: 9pt !important;
        line-height: 1.35 !important;
        margin-bottom: 12px !important;
        padding-right: 15px !important;
    }
    
    /* A4 Page printing size optimization */
    @page {
        size: A4 portrait;
        margin: 0.5cm 0.6cm 0.5cm 0.6cm !important;
    }
}';
$content = str_replace($search_print_style, $replace_print_style, $content);

// 3. Insert print letterhead header logo & print buttons right before gallery section
$search_gallery_start = '<!-- Single Photo Gallery Slider Box (صورة واحدة متغيرة مع السهام والتنزيل) -->
                <div class="major-section-label">🖼️ معرض صور ومعامل التخصص</div>';

$replace_gallery_start = '<!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>الدليل التعريفي لتخصص: <?php echo $major_data[\'title\']; ?></p>
        </div>

                <!-- Export Buttons (طباعة وحفظ كـ PDF) -->
                <div class="export-group" style="margin-bottom: 25px;">
                    <button onclick="window.print()" class="export-action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
                    </button>
                    <button onclick="exportMajorPDF()" class="export-action-btn" style="background:#085859; color:white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
                    </button>
                </div>

                <!-- Single Photo Gallery Slider Box (صورة واحدة متغيرة مع السهام والتنزيل) -->
                <div class="major-section-label">🖼️ معرض صور ومعامل التخصص</div>';

$content = str_replace($search_gallery_start, $replace_gallery_start, $content);

// 4. Remove the old export buttons block from near the bottom
$search_old_export = '                    <!-- Export Buttons -->
                    <div class="export-group">
                        <button onclick="window.print()" class="export-action-btn">
                            <i class="fa-solid fa-print" style="margin-left: 5px;"></i> طباعة الصفحة
                        </button>
                        <button onclick="exportMajorPDF()" class="export-action-btn" style="background:#085859; color:white;">
                            <i class="fa-solid fa-file-pdf" style="margin-left: 5px;"></i> حفظ كـ PDF
                        </button>
                    </div>';

$content = str_replace($search_old_export, '', $content);

file_put_contents($filepath, $content);
echo "pages/major.php updated successfully.\n";
?>
