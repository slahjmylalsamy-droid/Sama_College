<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}
?>

<style>
/* Style rules for About Page */
.about-container {
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

.about-title {
    font-size: 26px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 25px;
    position: relative;
    display: inline-block;
    padding-bottom: 8px;
}
.about-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 70%;
    height: 3px;
    background-color: #085859;
    border-radius: 2px;
}

.about-intro-text {
    line-height: 2;
    font-size: 16px;
    color: #333;
    margin-bottom: 25px;
    text-align: justify;
}

.about-highlight-box {
    color: #d97706;
    font-size: 17px;
    font-weight: 700;
    line-height: 1.8;
    margin-bottom: 30px;
    background: #fffbe6;
    border-right: 4px solid #d97706;
    padding: 15px 20px;
    border-radius: 6px;
}

.about-section-subtitle {
    color: #0d4748;
    font-size: 19px;
    font-weight: 700;
    margin-bottom: 12px;
}

.about-bullet-list {
    line-height: 2;
    font-size: 15px;
    color: #444;
    margin-bottom: 35px;
    padding-right: 20px;
    list-style-type: disc;
}

.table-main-heading {
    color: #b91c1c;
    font-size: 18px;
    font-weight: 800;
    margin-top: 35px;
    margin-bottom: 20px;
    text-decoration: underline;
    text-underline-offset: 6px;
}

.table-sub-heading {
    color: #0d4748;
    font-size: 17px;
    font-weight: 700;
    margin-top: 25px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.custom-program-table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 25px;
    background: #ffffff;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.04);
    border: 1px solid #e5e7eb;
}

.custom-program-table th {
    background-color: #072928;
    color: #ffffff;
    font-weight: 700;
    padding: 12px 15px;
    text-align: center;
    font-size: 15px;
    border-bottom: 2px solid #0d4748;
}

.custom-program-table td {
    padding: 12px 15px;
    text-align: center;
    font-size: 15px;
    border-bottom: 1px solid #e5e7eb;
    color: #333;
}

.custom-program-table tr:nth-child(even) {
    background-color: #f9fafb;
}

.custom-program-table tr:hover {
    background-color: #f0f7f7;
}

/* Action and Share buttons */
.about-actions-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-top: 40px;
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

.media-section-title {
    color: #0d4748;
    font-size: 20px;
    font-weight: 800;
    margin-top: 45px;
    margin-bottom: 20px;
    padding-right: 12px;
    border-right: 4px solid #085859;
}

/* Video Slider Section */
.about-video-wrapper {
    position: relative;
    width: 100%;
    max-width: 900px;
    margin: 0 auto 35px;
    background: #072928;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border: 1px solid #112223;
}

.about-video-slide-box {
    position: relative;
    width: 100%;
    height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #031112;
}

.about-video-slide-box img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain !important;
    opacity: 0.85;
    transition: opacity 0.3s ease;
}

.about-video-slide-box video {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: #000;
}

.video-play-btn-large {
    position: absolute;
    width: 75px;
    height: 75px;
    background: rgba(8, 88, 89, 0.95);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    font-size: 30px;
    box-shadow: 0 6px 20px rgba(0,0,0,0.4);
    transition: all 0.3s ease;
    cursor: pointer;
    z-index: 5;
    padding-left: 4px;
}

.about-video-slide-box:hover .video-play-btn-large {
    transform: scale(1.15);
    background: #0d4748;
    box-shadow: 0 8px 25px rgba(13, 71, 72, 0.6);
}
.about-video-slide-box:hover .video-play-btn-large:hover,
.video-play-btn-large:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    box-shadow: 0 8px 25px rgba(189, 214, 60, 0.5) !important;
}

.video-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(10, 26, 47, 0.85);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    user-select: none;
}

.video-nav-btn:hover {
    background: #085859;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 15px rgba(8, 88, 89, 0.5);
}

.video-nav-btn.prev-btn { right: 15px; }
.video-nav-btn.next-btn { left: 15px; }

.video-caption-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 14px 20px;
    background: linear-gradient(transparent, rgba(10, 26, 47, 0.95));
    color: #ffffff;
    text-align: right;
    pointer-events: none;
    z-index: 4;
}

.video-caption-bar h4 {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
}

.video-caption-bar p {
    margin: 0;
    font-size: 13px;
    color: #cbd5e1;
}

.video-controls-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: #ffffff;
    border-top: 1px solid #eaeaea;
    flex-wrap: wrap;
    gap: 15px;
}

.video-dots-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.video-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #cbd5e1;
    cursor: pointer;
    transition: all 0.3s ease;
}

.video-dot.active {
    background: #085859;
    width: 28px;
    border-radius: 10px;
}

.video-play-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: #22c55e;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(34, 197, 94, 0.2);
}

.video-play-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}

/* Gallery Slider Section */
.about-gallery-wrapper {
    position: relative;
    width: 100%;
    max-width: 900px;
    margin: 0 auto 35px;
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    border: 1px solid #eaeaea;
}

.about-gallery-slide-box {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: transparent;
}

.about-gallery-slide-box img {
    max-width: 100%;
    max-height: 520px;
    width: auto;
    height: auto;
    object-fit: contain !important;
    transition: opacity 0.3s ease;
}

.gallery-nav-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(10, 26, 47, 0.85);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    user-select: none;
}

.gallery-nav-btn:hover {
    background: #085859;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 15px rgba(8, 88, 89, 0.5);
}

.gallery-nav-btn.prev-btn { right: 15px; }
.gallery-nav-btn.next-btn { left: 15px; }

.gallery-caption-bar {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    padding: 14px 20px;
    background: linear-gradient(transparent, rgba(10, 26, 47, 0.95));
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    text-align: right;
    pointer-events: none;
}

.gallery-controls-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: #ffffff;
    border-top: 1px solid #eaeaea;
    flex-wrap: wrap;
    gap: 15px;
}

.gallery-dots-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.gallery-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #cbd5e1;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gallery-dot.active {
    background: #085859;
    width: 28px;
    border-radius: 10px;
}

.gallery-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 9px 18px;
    background: #0d4748;
    color: #ffffff;
    border: none;
    border-radius: 8px;
    font-size: 14px;
    font-weight: 700;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(13, 71, 72, 0.2);
}

.gallery-download-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}

/* Bottom Nav Buttons */
.about-bottom-nav {
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
#aboutToast {
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

#aboutToast.show {
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
        font-family: 'Cairo', 'Segoe UI', sans-serif !important;
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
}
</style>

<div style="background:#f4f6f9; padding: 40px 15px;">
    <div class="about-container" id="printableAboutArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header" style="display: none;">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>تقرير تعريفي عن الكلية - نبذة عامة</p>
        </div>
        
        <!-- Heading -->
        <h1 class="about-title">نبذة عن الكلية</h1>
        
        <!-- Intro Text Paragraphs -->
        <p class="about-intro-text">
            <strong style="color:#085859;">كلية سماء المتميزين</strong> مؤسسة تعليمية خاصة مرخصة رسمياً من وزارة التعليم العالي والبحث العلمي في الجمهورية اليمنية، بدأ نشاط الكلية التعليمية في عام 2004م بإسم معهد الكلية للتخصصات الطبية، ثم أضيفت التخصصات التقنية والإدارية بترخيص من وزارة الصحة العامة والسكان ووزارة التعليم الفني والتدريب المهني على التوالي. وسرعان ما نالت هذه المؤسسة ثقة الجهات الرسمية فتم افتتاحها رسمياً لتكون صرحاً تعليمياً أهلياً متميزاً مقره تعز - دمنة خدير وفرعها بالراهدة.
        </p>

        <!-- Highlighted Box -->
        <div class="about-highlight-box">
            كما تقدم الكلية منح دراسية مجانية تنافسية (كاملة و جزئية) معتمدة منذ العام 2010م في جميع فروعها ضمن خدماتها المجتمعية ودعماً لطلابها الراغبين في الدراسة في جميع التخصصات.
        </div>

        <!-- System of Study -->
        <div class="about-section-subtitle">نظام الدراسة:</div>
        <ul class="about-bullet-list">
            <li>يبدأ العام الجامعي في شهر سبتمبر من كل عام، وتستمر الدراسة (32) أسبوعاً في العام الجامعي خلال الفصلين الدراسيين الأول والثاني، حيث تكون مدة الفصل الدراسي (الأول أو الثاني) 16 أسبوعاً بما في ذلك الاختبارات النصفية والنهائية. وتكون مدة الفصل الصيفي (8) أسابيع بواقع محاضرتين خلال كل أسبوع بما في ذلك الاختبارات.</li>
            <li>نظام الدراسة في جميع كليات وفروع الكلية يقوم على أساس الإنتظام، ويحرم الطالب من دخول الإختبار النهائي إذا كانت نسبة حضوره أقل من 75% من المحاضرات النظرية والدروس العملية لكل مقرر بحسب الخطة الدراسية، ويعتبر الطالب الذي حرم من دخول الإختبار النهائي بسبب الغياب راسباً في المقرر.</li>
        </ul>

        <!-- Main Duration Heading -->
        <div class="table-main-heading">تحدد مدة الدراسة لكل برنامج في كليات الكلية على النحو الآتي:</div>

        <!-- Table 1: Medical Programs -->
        <div class="table-sub-heading">
            <span>أولاً: برامج كلية العلوم الطبية:</span>
        </div>
        <table class="custom-program-table">
            <thead>
                <tr>
                    <th style="width: 10%;">م</th>
                    <th style="width: 45%;">البرنامج / التخصص</th>
                    <th style="width: 25%;">نظام الدراسة</th>
                    <th style="width: 20%;">السنوات الدراسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>صيدلة</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>مساعد طبيب</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>قبالة وتوليد</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
            </tbody>
        </table>

        <!-- Table 2: Engineering & IT Programs -->
        <div class="table-sub-heading">
            <span>ثانياً: برامج العلوم الهندسية وتكنولوجيا المعلومات:</span>
        </div>
        <table class="custom-program-table">
            <thead>
                <tr>
                    <th style="width: 10%;">م</th>
                    <th style="width: 45%;">البرنامج / التخصص</th>
                    <th style="width: 25%;">نظام الدراسة</th>
                    <th style="width: 20%;">السنوات الدراسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>تقنية المعلومات</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>الجرافيكس والتصميم</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td><strong>الهندسة المعمارية</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
            </tbody>
        </table>

        <!-- Table 3: Administrative Programs -->
        <div class="table-sub-heading">
            <span>ثالثاً: برامج العلوم الإدارية والمالية:</span>
        </div>
        <table class="custom-program-table">
            <thead>
                <tr>
                    <th style="width: 10%;">م</th>
                    <th style="width: 45%;">البرنامج / التخصص</th>
                    <th style="width: 25%;">نظام الدراسة</th>
                    <th style="width: 20%;">السنوات الدراسية</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><strong>محاسبة</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td><strong>إدارة أعمال</strong></td>
                    <td>نظام فصلي</td>
                    <td>*3 سنوات</td>
                </tr>
            </tbody>
        </table>

        <!-- Actions and Share Bar -->
        <div class="about-actions-bar">
            <div class="share-group">
                <span style="font-weight: 700; color: #0d4748; font-size: 14px; margin-left: 5px;">مشاركة الصفحة:</span>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                    <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('نبذة عن كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                    <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    تويتر
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('نبذة عن كلية سماء المتميزين: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                    <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                    واتساب
                </a>

                <!-- Instagram -->
                <button onclick="copyAboutLink()" class="share-btn-item insta" title="انستجرام">
                    <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    انستجرام
                </button>

                <!-- Telegram -->
                <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('نبذة عن كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tg" title="تليجرام">
                    <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                    تليجرام
                </a>
            </div>

            <!-- Export Buttons -->
            <div class="export-group">
                <button onclick="window.print()" class="export-action-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
                </button>
                <button onclick="exportAboutPDF()" class="export-action-btn" style="background:#085859; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
                </button>
            </div>
        </div>

        <!-- Video Slider Section (مشغل فيديو حقيقي تفاعلي بالسلايدر والتنزيل) -->
        <div class="media-section-title"><i class="fa-solid fa-circle-play"></i> فيديوهات تعريفية عن الكلية</div>
        
        <div class="about-video-wrapper" onmouseenter="clearInterval(aboutVideoTimer)" onmouseleave="resetAboutVideoTimer()">
            <!-- Prev & Next Arrows -->
            <button class="video-nav-btn prev-btn" onclick="prevAboutVideoSlide()" title="الفيديو السابق">❮</button>
            <button class="video-nav-btn next-btn" onclick="nextAboutVideoSlide()" title="الفيديو التالي">❯</button>
            
            <!-- Dynamic Video Slide Container -->
            <div class="about-video-slide-box" id="videoSlideBox">
                <img id="aboutVideoImg" src="images/slider_campus.jpg?v=3" alt="فيديوهات كلية سماء المتميزين">
                <div class="video-play-btn-large" id="videoPlayOverlayBtn" onclick="playCurrentVideo()" title="تشغيل الفيديو الحقيقي" style="padding-left: 0; padding-right: 4px;"><i class="fa-solid fa-play"></i></div>
                
                <div class="video-caption-bar" id="videoCaptionBar">
                    <h4 id="aboutVideoTitle">فيديو تعريفي ببرامج وأقسام كلية سماء المتميزين</h4>
                    <p id="aboutVideoDesc">استعراض شامل للبرامج الأكاديمية والخدمات والأنشطة التعليمية في الكلية</p>
                </div>
            </div>
            
            <!-- Video Controls Bar: Dots, Play & Download Options -->
            <div class="video-controls-bar">
                <div class="video-dots-wrap">
                    <span class="video-dot active" onclick="showAboutVideoSlide(0)"></span>
                    <span class="video-dot" onclick="showAboutVideoSlide(1)"></span>
                    <span class="video-dot" onclick="showAboutVideoSlide(2)"></span>
                    <span class="video-dot" onclick="showAboutVideoSlide(3)"></span>
                </div>
                
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button onclick="playCurrentVideo()" class="video-play-action-btn" title="تشغيل الفيديو داخل المشغل">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg> تشغيل الفيديو
                    </button>
                    <button onclick="downloadCurrentVideo()" class="gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الفيديو الحالي
                    </button>
                    <button onclick="downloadAllVideos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الفيديوهات
                    </button>
                </div>
            </div>
        </div>

        <!-- Photo Gallery Slider Section (معرض صور الكلية بالأسهم وخيارين للتنزيل) -->
        <div class="media-section-title"><i class="fa-solid fa-images"></i> معرض صور الكلية</div>
        
        <div class="about-gallery-wrapper" onmouseenter="clearInterval(aboutGalleryTimer)" onmouseleave="resetAboutGalleryTimer()">
            <!-- Prev & Next Arrows -->
            <button class="gallery-nav-btn prev-btn" onclick="prevAboutGallerySlide()" title="الصورة السابقة">❮</button>
            <button class="gallery-nav-btn next-btn" onclick="nextAboutGallerySlide()" title="الصورة التالية">❯</button>
            
            <!-- Image Slide Container -->
            <div class="about-gallery-slide-box">
                <img id="aboutGalleryImg" src="images/slider_campus.jpg?v=3" alt="صور كلية سماء المتميزين">
                <div class="gallery-caption-bar" id="aboutGalleryCaption">المبنى الرئيسي لكلية سماء المتميزين</div>
            </div>
            
            <!-- Controls Bar: Dots & Download Options (Current & All) -->
            <div class="gallery-controls-bar">
                <div class="gallery-dots-wrap">
                    <span class="gallery-dot active" onclick="showAboutGallerySlide(0)"></span>
                    <span class="gallery-dot" onclick="showAboutGallerySlide(1)"></span>
                    <span class="gallery-dot" onclick="showAboutGallerySlide(2)"></span>
                    <span class="gallery-dot" onclick="showAboutGallerySlide(3)"></span>
                </div>
                
                <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                    <button onclick="downloadCurrentGalleryPhoto()" class="gallery-download-btn" title="تنزيل الصورة الظاهرة حالياً">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الصورة المعروضة
                    </button>
                    <button onclick="downloadAllGalleryPhotos()" class="gallery-download-btn" style="background:#085859;" title="تنزيل جميع صور المعرض مرة واحدة">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الصور
                    </button>
                </div>
            </div>
        </div>

        <!-- Bottom Navigation Pill Buttons -->
        <div class="about-bottom-nav">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <a href="?p=president" class="nav-pill-btn">
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
<div id="aboutToast">تم التحديث بنجاح!</div>

<script>
// Video Slider Data & HTML5 Video Stream Links
const aboutVideoData = [
    { 
        poster: "images/slider_campus.jpg?v=3", 
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4",
        title: "فيديو تعريفي ببرامج وأقسام كلية سماء المتميزين",
        desc: "استعراض شامل للبرامج الأكاديمية والخدمات والأنشطة التعليمية في الكلية"
    },
    { 
        poster: "images/slider_mission.jpg?v=3", 
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
        title: "جولة افتراضية في المعامل والمختبرات الطبية والتقنية",
        desc: "التعرف على التجهيزات والمختبرات الطبية والتقنية ذات المستوى العالي"
    },
    { 
        poster: "images/slider_vision.jpg?v=3", 
        title: "المكتبة الرقمية وقاعات الأبحاث التفاعلية",
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerFun.mp4",
        desc: "جولة في المكتبة الرقمية والوسائط التعليمية ومصادر المعلومات الذكية"
    },
    { 
        poster: "images/news_launch.jpg", 
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerJoydates.mp4",
        title: "تغطية تدشين العام الدراسي الجديد والفعاليات الأكاديمية",
        desc: "مشاهد من حفل التدشين والأنشطة الطلابية والثقافية في الكلية"
    }
];
let aboutVideoIdx = 0;
let aboutVideoTimer = setInterval(nextAboutVideoSlide, 8000);
let isVideoPlaying = false;

function showAboutVideoSlide(index) {
    aboutVideoIdx = (index + aboutVideoData.length) % aboutVideoData.length;
    const boxEl = document.getElementById("videoSlideBox");
    
    // Reset video slide box to poster image view if changing slide
    boxEl.innerHTML = `
        <img id="aboutVideoImg" src="${aboutVideoData[aboutVideoIdx].poster}" alt="فيديوهات كلية سماء المتميزين">
        <div class="video-play-btn-large" id="videoPlayOverlayBtn" onclick="playCurrentVideo()" title="تشغيل الفيديو الحقيقي">▶</div>
        <div class="video-caption-bar" id="videoCaptionBar">
            <h4 id="aboutVideoTitle">${aboutVideoData[aboutVideoIdx].title}</h4>
            <p id="aboutVideoDesc">${aboutVideoData[aboutVideoIdx].desc}</p>
        </div>
    `;
    isVideoPlaying = false;
    
    var dots = document.querySelectorAll(".video-dot");
    dots.forEach(function(dot, idx) {
        if (idx === aboutVideoIdx) {
            dot.classList.add("active");
        } else {
            dot.classList.remove("active");
        }
    });
}

function playCurrentVideo() {
    clearInterval(aboutVideoTimer); // Stop auto-sliding when video plays
    const currentVid = aboutVideoData[aboutVideoIdx];
    const boxEl = document.getElementById("videoSlideBox");
    
    boxEl.innerHTML = `
        <video id="activeHtml5Player" controls autoplay style="width:100%; height:100%; object-fit:contain; background:#000;">
            <source src="${currentVid.videoUrl}" type="video/mp4">
            متصفحك لا يدعم مشغل الفيديوهات المباشرة.
        </video>
        <div class="video-caption-bar" style="background: rgba(10,26,47,0.85);">
            <h4>▶ ${currentVid.title}</h4>
            <p>${currentVid.desc}</p>
        </div>
    `;
    isVideoPlaying = true;
    showToast("▶ جاري تشغيل الفيديو المباشر...");
}

function nextAboutVideoSlide() {
    showAboutVideoSlide(aboutVideoIdx + 1);
    resetAboutVideoTimer();
}

function prevAboutVideoSlide() {
    showAboutVideoSlide(aboutVideoIdx - 1);
    resetAboutVideoTimer();
}

function resetAboutVideoTimer() {
    clearInterval(aboutVideoTimer);
    if (!isVideoPlaying) {
        aboutVideoTimer = setInterval(nextAboutVideoSlide, 8000);
    }
}

function downloadCurrentVideo() {
    const currentVid = aboutVideoData[aboutVideoIdx];
    const link = document.createElement("a");
    link.href = currentVid.videoUrl;
    link.target = "_blank";
    link.download = "فيديو_كلية_سماء_المتميزين_" + (aboutVideoIdx + 1) + ".mp4";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast("جاري تنزيل الفيديو الحالي...");
}

function downloadAllVideos() {
    showToast("جاري تنزيل جميع فيديوهات الكلية...");
    aboutVideoData.forEach((vid, i) => {
        setTimeout(() => {
            const link = document.createElement("a");
            link.href = vid.videoUrl;
            link.target = "_blank";
            link.download = "فيديو_كلية_سماء_المتميزين_" + (i + 1) + ".mp4";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, i * 800);
    });
}

// Photo Gallery Slider Data & Download Logic
const aboutGalleryData = [
    { src: "images/slider_campus.jpg?v=3", title: "المبنى الرئيسي لكلية سماء المتميزين" },
    { src: "images/slider_mission.jpg?v=3", title: "المختبرات والمعامل الطبية والتقنية" },
    { src: "images/slider_vision.jpg?v=3", title: "المكتبة الرقمية وقاعات الأبحاث" },
    { src: "images/news_launch.jpg", title: "الفعاليات والأنشطة الأكاديمية بالكلية" }
];
let aboutGalleryIdx = 0;
let aboutGalleryTimer = setInterval(nextAboutGallerySlide, 5000);

function showAboutGallerySlide(index) {
    aboutGalleryIdx = (index + aboutGalleryData.length) % aboutGalleryData.length;
    const imgEl = document.getElementById("aboutGalleryImg");
    const captionEl = document.getElementById("aboutGalleryCaption");
    
    if (imgEl && captionEl) {
        imgEl.style.opacity = "0.2";
        setTimeout(function() {
            imgEl.src = aboutGalleryData[aboutGalleryIdx].src;
            captionEl.innerText = aboutGalleryData[aboutGalleryIdx].title;
            imgEl.style.opacity = "1";
        }, 150);
    }
    
    var dots = document.querySelectorAll(".gallery-dot");
    dots.forEach(function(dot, idx) {
        if (idx === aboutGalleryIdx) {
            dot.classList.add("active");
        } else {
            dot.classList.remove("active");
        }
    });
}

function nextAboutGallerySlide() {
    showAboutGallerySlide(aboutGalleryIdx + 1);
    resetAboutGalleryTimer();
}

function prevAboutGallerySlide() {
    showAboutGallerySlide(aboutGalleryIdx - 1);
    resetAboutGalleryTimer();
}

function resetAboutGalleryTimer() {
    clearInterval(aboutGalleryTimer);
    aboutGalleryTimer = setInterval(nextAboutGallerySlide, 5000);
}

function downloadCurrentGalleryPhoto() {
    const currentPhoto = aboutGalleryData[aboutGalleryIdx];
    const cleanSrc = currentPhoto.src.split('?')[0];
    
    const link = document.createElement("a");
    link.href = cleanSrc;
    link.download = "صورة_كلية_سماء_المتميزين_" + (aboutGalleryIdx + 1) + ".jpg";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast("جاري تنزيل الصورة المعروضة...");
}

function downloadAllGalleryPhotos() {
    showToast("جاري تنزيل جميع صور المعرض...");
    aboutGalleryData.forEach((photo, i) => {
        setTimeout(() => {
            const cleanSrc = photo.src.split('?')[0];
            const link = document.createElement("a");
            link.href = cleanSrc;
            link.download = "صورة_كلية_سماء_المتميزين_" + (i + 1) + ".jpg";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, i * 500);
    });
}

function showToast(msg) {
    var toast = document.getElementById("aboutToast");
    toast.innerText = msg;
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

function copyAboutLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    showToast("تم نسخ رابط الصفحة بنجاح! يمكنك مشاركته عبر انستجرام.");
}

function exportAboutPDF() {
    var oldTitle = document.title;
    document.title = "نبذة_عن_كلية_سماء_المتميزين_2026";
    window.print();
    document.title = oldTitle;
}
</script>
