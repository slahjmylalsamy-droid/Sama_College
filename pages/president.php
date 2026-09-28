<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}
?>

<style>
/* Style rules for President / Dean Page */
.president-container {
    direction: rtl;
    font-family: 'Cairo', sans-serif;
    color: #333;
    max-width: 960px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.president-title {
    font-size: 26px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 25px;
    position: relative;
    display: inline-block;
    padding-bottom: 8px;
}
.president-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 70%;
    height: 3px;
    background-color: #085859;
    border-radius: 2px;
}

.president-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: flex-start;
    margin-bottom: 25px;
}

.president-text-col {
    flex: 1 1 450px;
    line-height: 2;
    font-size: 15px;
    color: #333;
    text-align: justify;
}

.president-text-col p {
    margin-bottom: 16px;
    line-height: 2;
}

.president-image-col {
    flex: 0 0 320px;
    max-width: 360px;
    width: 100%;
}

.president-img-card {
    width: 100%;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 3px solid #ffffff;
    outline: 1px solid #cbd5e1;
    background: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
}

.president-img-card img {
    width: 100%;
    height: auto;
    max-width: 100%;
    display: block;
    object-fit: contain !important;
    border-radius: 11px;
}

.president-subheading {
    color: #b91c1c;
    font-size: 16px;
    font-weight: 700;
    margin-top: 15px;
    margin-bottom: 10px;
}

.president-dept-list {
    margin-bottom: 18px;
    padding-right: 0;
    list-style-type: none;
}

.president-dept-list li {
    margin-bottom: 10px;
    line-height: 1.9;
}

.president-dept-list strong {
    color: #0d4748;
}

.president-signature {
    margin-top: 25px;
    padding-top: 15px;
    border-top: 1px dashed #cbd5e1;
}

.president-signature-title {
    color: #0d4748;
    font-size: 16px;
    font-weight: 700;
    margin-bottom: 4px;
}

.president-signature-name {
    color: #085859;
    font-size: 19px;
    font-weight: 800;
}

/* Actions and Share buttons */
.president-actions-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-top: 35px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.share-group {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.share-btn-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 20px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    color: #4b5563;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.share-btn-item svg {
    width: 18px;
    height: 18px;
}

.share-btn-item.fb:hover { background: #1877f2; color: white; border-color: #1877f2; }
.share-btn-item.fb:hover svg path { fill: white; }

.share-btn-item.tw:hover { background: #000000; color: white; border-color: #000000; }
.share-btn-item.tw:hover svg path { fill: white; }

.share-btn-item.wa:hover { background: #25d366; color: white; border-color: #25d366; }
.share-btn-item.wa:hover svg path { fill: white; }

.share-btn-item.insta:hover { background: #e1306c; color: white; border-color: #e1306c; }
.share-btn-item.insta:hover svg path { fill: white; }

.share-btn-item.tg:hover { background: #0088cc; color: white; border-color: #0088cc; }
.share-btn-item.tg:hover svg path { fill: white; }

.export-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.export-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid #085859;
    background: #ffffff;
    color: #085859;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.export-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    border-color: rgb(189, 214, 60) !important;
    box-shadow: 0 4px 12px rgba(189, 214, 60, 0.3) !important;
}

/* Bottom Nav Buttons */
.president-bottom-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-top: 45px;
    padding-top: 25px;
    border-top: 2px dashed #e5e7eb;
}

.nav-pill-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    background: #0d4748;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 71, 72, 0.15);
    transition: all 0.3s ease;
}

.nav-pill-btn:hover {
    background: #085859;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(8, 88, 89, 0.25);
    color: #ffffff;
}

.nav-pill-btn.home-pill {
    background: #085859;
}
.nav-pill-btn.home-pill:hover {
    background: #0d4748;
}

/* Toast Message */
#presidentToast {
    visibility: hidden;
    min-width: 250px;
    background-color: #072928;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    padding: 12px 20px;
    position: fixed;
    z-index: 9999;
    left: 50%;
    bottom: 30px;
    transform: translateX(-50%);
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    border: 1px solid #ffd700;
}

#presidentToast.show {
    visibility: visible;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@keyframes fadein {
    from { bottom: 0; opacity: 0; }
    to { bottom: 30px; opacity: 1; }
}

@keyframes fadeout {
    from { bottom: 30px; opacity: 1; }
    to { bottom: 0; opacity: 0; }
}

/* Print specific styles */
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
        font-family: 'Cairo', 'Segoe UI', sans-serif !important;
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
}
</style>

<div style="background:#f4f6f9; padding: 40px 15px;">
    <div class="president-container" id="printablePresidentArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>كلمة عميد الكلية بمناسبة العام الدراسي الجديد</p>
        </div>
        
        <!-- Heading -->
        <h1 class="president-title">كلمة عميد الكلية</h1>
        
        <div class="president-grid">
            <!-- Right Column: Dean Speech Content -->
            <div class="president-text-col">
                <p>
                    تأسست كلية سماء المتميزين عام 2004م حيث إهتمت الكلية بالمعارف والمهارات الحديثة ومنهجية البحث العلمي، وقد عملت على توفير الخدمات والمرافق الضرورية لتفعيل الحياة الأكاديمية والثقافية والرياضية والاجتماعية وتوفير خدمة الإنترنت لطلبتها وكذا المنح الدراسية التنافسية للطلبة المتفوقين.
                </p>

                <div class="president-subheading">تضم الكلية ثلاث كليات رئيسية:</div>
                <ul class="president-dept-list">
                    <li><strong>كلية العلوم الطبية وتضم الأقسام التالية:</strong> (طب عام وجراحة - طب وجراحة الفم والأسنان - علوم الصيدلة - المختبرات الطبية - تمريض - صحة مجتمع).</li>
                    <li><strong>كلية العلوم والهندسة وتضم الأقسام التالية:</strong> (علوم الحاسوب وتقنية المعلومات - هندسة الاتصالات والشبكات - هندسة معمارية ومدنية).</li>
                    <li><strong>كلية العلوم الإدارية والإنسانية وتضم الأقسام التالية:</strong> (محاسبة - تخصصات إدارية - شريعة وقانون - اللغة الانجليزية والترجمة - إعلام وعلاقات عامة - تسويق - نظم معلومات).</li>
                </ul>

                <p>
                    وتضم الكلية إدارة التطوير وضمان الجودة وعدد من المراكز المتخصصة مثل مركز خدمة المجتمع ومركز الحاسوب واللغات. وقد وقّعت الكلية العديد من الإتفاقيات الثقافية والعلمية مع بعض الكليات والمؤسسات بهدف توثيق التعاون وتبادل الخبرات والزيارات.
                </p>

                <p>
                    كما أن الكلية عضو فاعل في إتحاد الكليات والجامعات اليمنية، حيث أنها تهتم بدعم البحث العلمي والإيفاء وتطويره. كما يوجد في الكلية مكتبة تضم العديد من المجلدات والكتب والدوريات والنشرات والمجلات العلمية والتي تغطي جميع التخصصات التي تُدرّس في الكلية.
                </p>

                <div class="president-signature">
                    <div class="president-signature-title">عميد الكلية :</div>
                    <div class="president-signature-name">أ. د. محمد أحمد عبد الوهاب السامعي</div>
                </div>
            </div>

            <!-- Left Column: Photo of the Dean -->
            <div class="president-image-col">
                <div class="president-img-card">
                    <img src="images/dean.jpg?v=3" alt="أ. د. محمد أحمد عبد الوهاب السامعي - عميد الكلية">
                </div>
            </div>
        </div>

        <!-- Actions and Share Bar -->
        <div class="president-actions-bar">
            <div class="share-group">
                <span style="font-weight: 700; color: #0d4748; font-size: 14px; margin-left: 5px;">مشاركة الصفحة:</span>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                    <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('كلمة عميد كلية سماء المتميزين - أ. د. محمد أحمد عبد الوهاب السامعي'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                    <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    تويتر
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('كلمة عميد كلية سماء المتميزين أ. د. محمد أحمد عبد الوهاب السامعي: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                    <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                    واتساب
                </a>

                <!-- Instagram -->
                <button onclick="copyPresidentLink()" class="share-btn-item insta" title="انستجرام">
                    <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    انستجرام
                </button>

                <!-- Telegram -->
                <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('كلمة عميد كلية سماء المتميزين - أ. د. محمد أحمد عبد الوهاب السامعي'); ?>" target="_blank" class="share-btn-item tg" title="تليجرام">
                    <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                    تليجرام
                </a>
            </div>

            <!-- Export Buttons -->
            <div class="export-group">
                <button onclick="window.print()" class="export-action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
                </button>
                <button onclick="exportPresidentPDF()" class="export-action-btn" style="background:#085859; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
                </button>
            </div>
        </div>

        <!-- Bottom Navigation Pill Buttons -->
        <div class="president-bottom-nav">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <a href="?p=about" class="nav-pill-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> نبذة عن الكلية
            </a>
            <a href="?p=president" class="nav-pill-btn" style="background:#085859;">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg> عميد الكلية
            </a>
            <a href="?p=vision" class="nav-pill-btn">
                🎯 الرؤية والرسالة
            </a>
            <a href="?p=goals" class="nav-pill-btn">
                💎 الأهداف والقيم
            </a>
            <a href="?p=strategy" class="nav-pill-btn">
                📌 الخطة الاستراتيجية
            </a>
        </div>

    </div>
</div>

<!-- Toast notification element -->
<div id="presidentToast">تم نسخ رابط الصفحة بنجاح! يمكنك مشاركته عبر انستجرام.</div>

<script>
function copyPresidentLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    
    var toast = document.getElementById("presidentToast");
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

function exportPresidentPDF() {
    var oldTitle = document.title;
    document.title = "كلمة_عميد_كلية_سماء_المتميزين_2026";
    window.print();
    document.title = oldTitle;
}
</script>
