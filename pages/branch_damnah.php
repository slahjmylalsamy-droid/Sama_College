<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}
?>

<style>
.branch-page-container {
    direction: rtl;
    font-family: 'Cairo', sans-serif;
    color: #333;
    max-width: 1150px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 40px 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.branch-heading-title {
    font-size: 28px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 10px;
}

.branch-heading-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 60px;
    height: 3px;
    background-color: #085859;
    border-radius: 2px;
}

/* Master Layout Grid (Main Content Left, Sidebar Right) */
.branch-master-grid {
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 40px;
    align-items: start;
}

@media (max-width: 900px) {
    .branch-master-grid {
        grid-template-columns: 1fr;
    }
}

/* Sidebar Menu */
.branch-sidebar-box {
    background: #ffffff;
    border-right: 2px solid #e5e7eb;
    padding-right: 15px;
    padding-left: 5px;
    position: sticky;
    top: 100px;
}

.branch-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.branch-menu-item {
    margin-bottom: 8px;
}

.branch-menu-link {
    display: block;
    padding: 12px 15px;
    color: #374151;
    font-weight: 700;
    font-size: 16px;
    text-decoration: none;
    border-bottom: 1px solid #f3f4f6;
    transition: all 0.3s ease;
    cursor: pointer;
    position: relative;
}

.branch-menu-link:hover {
    color: #085859;
    background: #f0f7f7;
    border-radius: 6px;
}

.branch-menu-link.active {
    color: #085859;
    font-weight: 800;
}

.branch-menu-link.active::after {
    content: '';
    position: absolute;
    top: 50%;
    right: -17px;
    transform: translateY(-50%);
    width: 25px;
    height: 4px;
    background-color: #085859;
    border-radius: 2px;
}

/* Content Sections Styling */
.branch-section-card {
    background: #ffffff;
    margin-bottom: 35px;
    padding-bottom: 25px;
}

.branch-sub-title {
    color: #0d4748;
    font-size: 22px;
    font-weight: 800;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    gap: 10px;
}

/* Info Cards Row */
.branch-info-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.branch-info-card {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 24px 20px;
    text-align: right;
    display: flex;
    gap: 15px;
    align-items: center;
    min-height: 100px;
    box-sizing: border-box;
}

.branch-info-card.link-card {
    text-decoration: none;
    transition: all 0.3s ease;
}

.branch-info-card.link-card:hover {
    background: #ffffff;
    border-color: #085859;
    box-shadow: 0 8px 20px rgba(8, 88, 89, 0.1);
    transform: translateY(-3px);
}

.branch-info-card.link-card:hover .branch-info-icon {
    background: #085859;
    color: white;
}

.branch-info-icon {
    width: 45px;
    height: 45px;
    background: #f0f7f7;
    color: #085859;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    transition: all 0.3s ease;
}

.branch-info-text h4 {
    margin: 0 0 5px;
    color: #0d4748;
    font-size: 15px;
    font-weight: 800;
}

.branch-info-text p {
    margin: 0;
    color: #555;
    font-size: 13.5px;
    line-height: 1.6;
    word-break: break-all;
}

/* Admission requirements box */
.branch-admission-box {
    background: #fffdf5;
    border-right: 4px solid #ffd700;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.02);
}

.branch-admission-box h4 {
    color: #085859;
    margin-top: 0;
    margin-bottom: 12px;
    font-size: 17px;
    font-weight: 800;
}

.branch-admission-box ul {
    margin: 0;
    padding-right: 20px;
    line-height: 2;
    font-size: 14.5px;
    color: #444;
}

/* Majors Grid */
.branch-majors-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 15px;
    margin-top: 20px;
}

.branch-major-item {
    background: #f5fafb;
    border: 1px solid #f3e8eb;
    border-radius: 8px;
    padding: 15px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.branch-major-bullet {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #085859;
    flex-shrink: 0;
}

.branch-major-item span {
    font-weight: 700;
    color: #0d4748;
    font-size: 14.5px;
}

/* Custom Single-Image Slideshow Gallery */
.branch-gallery-box {
    position: relative;
    max-width: 100%;
    margin: 25px auto;
    display: flex;
    align-items: center;
    justify-content: center;
}

.branch-slide-img {
    max-width: 100%;
    max-height: 520px; /* حد أقصى للارتفاع لكي لا تتجاوز الصور الطولية حجم الشاشة */
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 12px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.08);
    display: none;
    transition: opacity 0.5s ease-in-out;
}

.branch-slide-img.active {
    display: block;
}

/* Gallery Controls */
.gallery-arrow-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(13, 71, 72, 0.7);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: background 0.3s;
    z-index: 10;
}

.gallery-arrow-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
}

.gallery-arrow-btn.prev-btn { right: 15px; }
.gallery-arrow-btn.next-btn { left: 15px; }

.gallery-dots-indicator {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}

.gallery-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: background 0.3s;
}

.gallery-dot.active {
    background: #ffd700;
    transform: scale(1.2);
}

/* Map frame styling */
.branch-map-box {
    border-radius: 12px;
    overflow: hidden;
    border: 1px solid #e2e8f0;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.04);
}

/* Actions and Share Bar */
.branch-actions-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 35px;
    padding-top: 25px;
    border-top: 1px solid #eeeeee;
}

.share-group {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.share-title-text {
    font-weight: 800;
    color: #0d4748;
    font-size: 16px;
    margin-left: 10px;
}

.share-btn-item {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 6px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
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

/* Bottom Nav Buttons (مربعات التنقل المخصصة للفروع) */
.branch-bottom-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 15px;
    margin-top: 45px;
    padding-top: 25px;
    border-top: 2px dashed #e5e7eb;
}

.nav-pill-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 11px 24px;
    border-radius: 25px;
    background: #0d4748;
    color: #ffffff;
    text-decoration: none;
    font-size: 14.5px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 71, 72, 0.15);
    transition: all 0.3s ease;
}

.nav-pill-btn:hover {
    background: rgb(189, 214, 60) !important;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.35);
    color: #0d4748 !important;
}

.nav-pill-btn.home-pill {
    background: #085859;
}
.nav-pill-btn.home-pill:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
}

.nav-pill-btn.branch-pill {
    background: #475569;
}
.nav-pill-btn.branch-pill:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
}

/* Toast Message */
#damnahToast {
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

#damnahToast.show {
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

/* Photo Gallery Download Buttons styling */
.branch-gallery-download-btn {
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
    text-decoration: none;
}

.branch-gallery-download-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}

/* Video Slider Section */
.branch-video-wrapper {
    position: relative;
    width: 100%;
    max-width: 900px;
    margin: 20px auto 15px;
    background: #072928;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0,0,0,0.12);
    border: 1px solid #112223;
}

.branch-video-slide-box {
    position: relative;
    width: 100%;
    height: 420px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #031112;
}

.branch-video-slide-box img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain !important;
    opacity: 0.85;
    transition: opacity 0.3s ease;
}

.branch-video-slide-box video {
    width: 100%;
    height: 100%;
    object-fit: contain;
    background: #000;
}

.branch-video-play-btn-large {
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
    padding-left: 0px;
    padding-right: 4px;
}

.branch-video-slide-box:hover .branch-video-play-btn-large {
    transform: scale(1.15);
    background: #0d4748;
    box-shadow: 0 8px 25px rgba(13, 71, 72, 0.6);
}

.branch-video-slide-box:hover .branch-video-play-btn-large:hover,
.branch-video-play-btn-large:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
    box-shadow: 0 8px 25px rgba(189, 214, 60, 0.5) !important;
}

.branch-video-nav-btn {
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

.branch-video-nav-btn:hover {
    background: #085859;
    transform: translateY(-50%) scale(1.1);
    box-shadow: 0 4px 15px rgba(8, 88, 89, 0.5);
}

.branch-video-nav-btn.prev-btn { right: 15px; }
.branch-video-nav-btn.next-btn { left: 15px; }

.branch-video-caption-bar {
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

.branch-video-caption-bar h4 {
    margin: 0 0 4px 0;
    font-size: 16px;
    font-weight: 700;
    color: #ffffff;
}

.branch-video-caption-bar p {
    margin: 0;
    font-size: 13px;
    color: #cbd5e1;
}

.branch-video-controls-bar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 20px;
    background: #ffffff;
    border-top: 1px solid #eaeaea;
    flex-wrap: wrap;
    gap: 15px;
}

.branch-video-dots-wrap {
    display: flex;
    align-items: center;
    gap: 8px;
}

.branch-video-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: #cbd5e1;
    cursor: pointer;
    transition: all 0.3s ease;
}

.branch-video-dot.active {
    background: #085859;
    width: 28px;
    border-radius: 10px;
}

.branch-video-play-action-btn {
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

.branch-video-play-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: #0d4748 !important;
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}
</style>

<div style="background:#f4f6f9; padding: 40px 15px;">
    <div class="branch-page-container">
        
        <h1 class="branch-heading-title">فرع دمنة خدير</h1>

        <div class="branch-master-grid">
            
            <!-- Main Content Area -->
            <div class="branch-content-column">
                
                <!-- Section 1: تفاصيل الاتصال والفرع -->
                <div id="sec-branch-info" class="branch-section-card">
                    <h2 class="branch-sub-title">معلومات الاتصال بالفرع</h2>
                    
                    <div class="branch-info-row">
                        <div class="branch-info-card">
                            <div class="branch-info-icon"><i class="fa-solid fa-location-dot"></i></div>
                            <div class="branch-info-text">
                                <h4>العنوان</h4>
                                <p>تعز- دمنة خدير- شارع شمعة – خلف حلويات الناشري – مقابل خزان شاعر.</p>
                            </div>
                        </div>
                        <a href="mailto:klytalmtmyzyn.damnah@gmail.com" class="branch-info-card link-card">
                            <div class="branch-info-icon"><i class="fa-solid fa-envelope"></i></div>
                            <div class="branch-info-text">
                                <h4>البريد الإلكتروني</h4>
                                <p style="color: #085859; font-weight: bold;">klytalmtmyzyn.damnah@gmail.com</p>
                            </div>
                        </a>
                        <div class="branch-info-card">
                            <div class="branch-info-icon"><i class="fa-solid fa-phone"></i></div>
                            <div class="branch-info-text">
                                <h4>رقم الهاتف والجوال</h4>
                                <p>
                                    هاتف: <a href="tel:04323058" style="color: #085859; text-decoration: none; font-weight: bold; transition: color 0.2s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">04-323058</a><br>
                                    جوال: <span style="direction: ltr; display: inline-block; font-weight: bold; color: #0d4748;">
                                        <a href="tel:770821112" style="color: #0d4748; text-decoration: none;">770821112</a> - 
                                        <a href="tel:733045299" style="color: #0d4748; text-decoration: none;">733045299</a> - 
                                        <a href="tel:736863982" style="color: #0d4748; text-decoration: none;">736863982</a>
                                    </span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 2: شروط القبول والتسجيل والوثائق -->
                <div id="sec-branch-admission" class="branch-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="branch-sub-title">القبول والتسجيل الأكاديمي</h2>
                    
                    <div class="branch-admission-box">
                        <h4><i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> شروط القبول والتسجيل بالفرع:</h4>
                        <ul>
                            <li><strong>الدرجة العلمية الممنوحة:</strong> تمنح الكلية درجة البكالوريوس المعتمدة في كافة تخصصاتها.</li>
                            <li><strong>شروط الالتحاق:</strong> أن يكون الطالب حاصلاً على شهادة الثانوية العامة (العلمي/الأدبي بحسب متطلبات التخصص).</li>
                            <li><strong>الوثائق المطلوبة للتسجيل:</strong>
                                <ul>
                                    <li>أصل شهادة الثانوية العامة مع صورتين طبق الأصل معمدة.</li>
                                    <li>عدد 12 صورة شخصية حديثة مقاس (4×6) بخلفية بيضاء.</li>
                                    <li>صورة من البطاقة الشخصية أو جواز السفر للطالب.</li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Section 3: البرامج والتخصصات المتاحة بالفرع -->
                <div id="sec-branch-majors" class="branch-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="branch-sub-title">البرامج الأكاديمية والتخصصات المتاحة بالفرع</h2>
                    <p class="branch-text-paragraph" style="margin-bottom:15px;">
                        تتوفر في فرع دمنة خدير التخصصات والأقسام الأكاديمية المعتمدة التالية:
                    </p>

                    <div class="branch-majors-grid">
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span>🩺 بكالوريوس مساعد طبيب عام</span>
                        </div>
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span>💊 بكالوريوس الصيدلة السريرية</span>
                        </div>
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span>💻 بكالوريوس تكنولوجيا المعلومات (IT)</span>
                        </div>
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span><i class="fa-solid fa-chart-line" style="margin-left: 5px;"></i> بكالوريوس المحاسبة والعلوم المالية</span>
                        </div>
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span>💼 بكالوريوس إدارة أعمال دولية</span>
                        </div>
                        <div class="branch-major-item">
                            <div class="branch-major-bullet"></div>
                            <span>🎨 بكالوريوس تصميم جرافيكس</span>
                        </div>
                    </div>
                </div>

                <!-- Section 4: معرض صور الكلية (صورة واحدة تتغير تلقائياً) -->
                <div id="sec-branch-gallery" class="branch-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="branch-sub-title">معرض صور الكلية بالفرع</h2>
                    <p class="branch-text-paragraph" style="margin-bottom:10px;">
                        جولة مصورة سريعة تستعرض البيئة التعليمية والمختبرات والمباني في فرع دمنة خدير:
                    </p>

                    <!-- Slideshow Box -->
                    <div class="branch-gallery-box">
                        <button class="gallery-arrow-btn prev-btn" onclick="changeSlide(-1)">❮</button>
                        <button class="gallery-arrow-btn next-btn" onclick="changeSlide(1)">❯</button>
                        
                        <img class="branch-slide-img active" src="images/slider_campus.jpg?v=3" alt="حرم فرع دمنة خدير">
                        <img class="branch-slide-img" src="images/slider_vision.jpg?v=3" alt="مكتبة الكلية والقاعات">
                        <img class="branch-slide-img" src="images/slider_mission.jpg?v=3" alt="المختبرات التخصصية بالفرع">
                        
                        <div class="gallery-dots-indicator">
                            <span class="gallery-dot active" onclick="setSlide(0)"></span>
                            <span class="gallery-dot" onclick="setSlide(1)"></span>
                            <span class="gallery-dot" onclick="setSlide(2)"></span>
                        </div>
                    </div>

                    <!-- Photo Download Controls (حفظ الصورة الحالية وحفظ جميع الصور) -->
                    <div style="display: flex; justify-content: center; gap: 12px; margin-top: 15px; flex-wrap: wrap;">
                        <button onclick="downloadCurrentBranchPhoto()" class="branch-gallery-download-btn" title="تنزيل الصورة المعروضة حالياً">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> حفظ الصورة حالياً
                        </button>
                        <button onclick="downloadAllBranchPhotos()" class="branch-gallery-download-btn" style="background:#085859;" title="تنزيل كافة صور المعرض دفعة واحدة">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> حفظ جميع الصور
                        </button>
                    </div>
                </div>

                <!-- Section 4.5: معرض فيديوهات الكلية بالفرع -->
                <div id="sec-branch-video" class="branch-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="branch-sub-title">معرض فيديوهات الفرع</h2>
                    <p class="branch-text-paragraph" style="margin-bottom:10px;">
                        مشاهدة العروض المرئية والتعريفية لتجهيزات الفرع والبيئة التعليمية:
                    </p>
                    
                    <div class="branch-video-wrapper" onmouseenter="clearInterval(branchVideoTimer)" onmouseleave="resetBranchVideoTimer()">
                        <!-- Prev & Next Arrows -->
                        <button class="branch-video-nav-btn prev-btn" onclick="prevBranchVideoSlide()" title="الفيديو السابق">❮</button>
                        <button class="branch-video-nav-btn next-btn" onclick="nextBranchVideoSlide()" title="الفيديو التالي">❯</button>
                        
                        <!-- Dynamic Video Slide Container -->
                        <div class="branch-video-slide-box" id="branchVideoSlideBox">
                            <img id="branchVideoImg" src="images/slider_campus.jpg?v=3" alt="فيديوهات فرع دمنة خدير">
                            <div class="branch-video-play-btn-large" id="branchVideoPlayOverlayBtn" onclick="playCurrentBranchVideo()" title="تشغيل الفيديو الحقيقي" style="padding-left: 0; padding-right: 4px;">▶</div>
                            
                            <div class="branch-video-caption-bar" id="branchVideoCaptionBar">
                                <h4 id="branchVideoTitle">فيديو تعريفي بفرع دمنة خدير وتجهيزاته التعليمية</h4>
                                <p id="branchVideoDesc">استعراض للأقسام والمعامل والبيئة التدريسية في فرع الكلية بدمنة خدير</p>
                            </div>
                        </div>
                        
                        <!-- Video Controls Bar: Dots, Play & Download Options -->
                        <div class="branch-video-controls-bar">
                            <div class="branch-video-dots-wrap">
                                <span class="branch-video-dot active" onclick="showBranchVideoSlide(0)"></span>
                                <span class="branch-video-dot" onclick="showBranchVideoSlide(1)"></span>
                            </div>
                            
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <button onclick="playCurrentBranchVideo()" class="branch-video-play-action-btn" title="تشغيل الفيديو داخل المشغل">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg> تشغيل الفيديو
                                </button>
                                <button onclick="downloadCurrentBranchVideo()" class="branch-gallery-download-btn" title="تنزيل ملف الفيديو المعروض حالياً">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg> تنزيل الفيديو الحالي
                                </button>
                                <button onclick="downloadAllBranchVideos()" class="branch-gallery-download-btn" style="background:#085859;" title="تنزيل جميع ملفات الفيديو">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg> تنزيل جميع الفيديوهات
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Section 5: الموقع الجغرافي للفرع -->
                <div id="sec-branch-map" class="branch-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="branch-sub-title">خريطة الموقع للفرع</h2>
                    
                    <div class="branch-map-box">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3862.062839958742!2d44.3168285!3d13.4735515!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMTPCsDI4JzI0LjgiTiA0NMKwMTknMDAuNiJFCg!5e0!3m2!1sar!2sye!4v1700000000000!5m2!1sar!2sye" width="100%" height="320" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                <!-- Social Share Bar (المشاركة) -->
                <div class="branch-actions-bar">
                    <div class="share-group">
                        <span class="share-title-text">مشاركة</span>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                            <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            فيسبوك
                        </a>

                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('فرع دمنة خدير - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                            <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            تويتر
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('فرع دمنة خدير - كلية سماء المتميزين: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                            <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                            واتساب
                        </a>

                        <!-- Instagram -->
                        <button onclick="copyDamnahLink()" class="share-btn-item insta" title="انستجرام">
                            <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            انستجرام
                        </button>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('فرع دمنة خدير - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tg" title="تيليجرام">
                            <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                            تيليجرام
                        </a>
                    </div>
                </div>

            </div>

            <!-- Sidebar Navigation (العمود الأيسر للتنقل مع العلامة العنابية في اليمين) -->
            <div class="branch-sidebar-box">
                <ul class="branch-menu-list">
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-info', this)" class="branch-menu-link active">
                            <span>معلومات الاتصال</span>
                        </a>
                    </li>
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-admission', this)" class="branch-menu-link">
                            <span>القبول والتسجيل</span>
                        </a>
                    </li>
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-majors', this)" class="branch-menu-link">
                            <span>التخصصات المتاحة</span>
                        </a>
                    </li>
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-gallery', this)" class="branch-menu-link">
                            <span>معرض الصور</span>
                        </a>
                    </li>
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-video', this)" class="branch-menu-link">
                            <span>معرض الفيديو</span>
                        </a>
                    </li>
                    <li class="branch-menu-item">
                        <a onclick="scrollToBranchSection('sec-branch-map', this)" class="branch-menu-link">
                            <span>خريطة الفرع</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Navigation Pill Buttons (مربعات الفروع) -->
        <div class="branch-bottom-nav">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <a href="?p=branch_rahdah" class="nav-pill-btn branch-pill">
                🏢 الانتقال إلى فرع الراهدة
            </a>
        </div>

    </div>
</div>

<!-- Toast notification element -->
<div id="damnahToast">تم نسخ رابط الصفحة بنجاح! يمكنك مشاركته عبر انستجرام.</div>

<script>
function scrollToBranchSection(id, el) {
    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    
    // Toggle active class on sidebar links
    var links = document.querySelectorAll('.branch-menu-link');
    links.forEach(function(l) { l.classList.remove('active'); });
    el.classList.add('active');
}

function copyDamnahLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    
    var toast = document.getElementById("damnahToast");
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

// Automatic Slideshow Gallery Script
var currentSlideIndex = 0;
var slideElements = document.querySelectorAll('.branch-slide-img');
var dotElements = document.querySelectorAll('.gallery-dot');
var slideInterval = setInterval(autoChangeSlide, 6000); // 6 seconds loop

function autoChangeSlide() {
    changeSlide(1);
}

function changeSlide(direction) {
    currentSlideIndex += direction;
    if (currentSlideIndex >= slideElements.length) {
        currentSlideIndex = 0;
    } else if (currentSlideIndex < 0) {
        currentSlideIndex = slideElements.length - 1;
    }
    updateSlideshow();
    resetSlideTimer();
}

function setSlide(index) {
    currentSlideIndex = index;
    updateSlideshow();
    resetSlideTimer();
}

function updateSlideshow() {
    slideElements.forEach(function(slide) { slide.classList.remove('active'); });
    dotElements.forEach(function(dot) { dot.classList.remove('active'); });
    
    slideElements[currentSlideIndex].classList.add('active');
    dotElements[currentSlideIndex].classList.add('active');
}

function resetSlideTimer() {
    clearInterval(slideInterval);
    slideInterval = setInterval(autoChangeSlide, 6000);
}

// Pause slideshow on hover
var galleryContainer = document.querySelector('.branch-gallery-box');
if (galleryContainer) {
    galleryContainer.addEventListener('mouseenter', function() {
        clearInterval(slideInterval);
    });
    galleryContainer.addEventListener('mouseleave', function() {
        slideInterval = setInterval(autoChangeSlide, 6000);
    });
}

// Photo Gallery Data & Download Logic
const branchGalleryData = [
    { src: "images/slider_campus.jpg", title: "حرم فرع دمنة خدير" },
    { src: "images/slider_vision.jpg", title: "مكتبة الكلية والقاعات" },
    { src: "images/slider_mission.jpg", title: "المختبرات التخصصية بالفرع" }
];

function downloadCurrentBranchPhoto() {
    const currentPhoto = branchGalleryData[currentSlideIndex];
    const link = document.createElement("a");
    link.href = currentPhoto.src + "?v=3";
    link.target = "_blank";
    link.download = currentPhoto.title + ".jpg";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function downloadAllBranchPhotos() {
    branchGalleryData.forEach((photo, i) => {
        setTimeout(() => {
            const link = document.createElement("a");
            link.href = photo.src + "?v=3";
            link.target = "_blank";
            link.download = photo.title + ".jpg";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, i * 800);
    });
}

// Video Gallery Data & Logic
const branchVideoData = [
    { 
        poster: "images/slider_campus.jpg?v=3", 
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerBlazes.mp4",
        title: "فيديو تعريفي بفرع دمنة خدير وتجهيزاته التعليمية",
        desc: "استعراض للأقسام والمعامل والبيئة التدريسية في فرع الكلية بدمنة خدير"
    },
    { 
        poster: "images/slider_mission.jpg?v=3", 
        videoUrl: "https://commondatastorage.googleapis.com/gtv-videos-bucket/sample/ForBiggerEscapes.mp4",
        title: "جولة في الأقسام الطبية والتقنية بالفرع",
        desc: "نظرة عن قرب على التطبيق العملي والتدريب في المعامل الطبية والمختبرات بالفرع"
    }
];
let branchVideoIdx = 0;
let branchVideoTimer = setInterval(nextBranchVideoSlide, 8000);
let isBranchVideoPlaying = false;

function showBranchVideoSlide(index) {
    branchVideoIdx = (index + branchVideoData.length) % branchVideoData.length;
    const boxEl = document.getElementById("branchVideoSlideBox");
    
    boxEl.innerHTML = `
        <img id="branchVideoImg" src="${branchVideoData[branchVideoIdx].poster}" alt="فيديوهات فرع دمنة خدير">
        <div class="branch-video-play-btn-large" id="branchVideoPlayOverlayBtn" onclick="playCurrentBranchVideo()" title="تشغيل الفيديو الحقيقي">▶</div>
        <div class="branch-video-caption-bar" id="branchVideoCaptionBar">
            <h4 id="branchVideoTitle">${branchVideoData[branchVideoIdx].title}</h4>
            <p id="branchVideoDesc">${branchVideoData[branchVideoIdx].desc}</p>
        </div>
    `;
    isBranchVideoPlaying = false;
    
    var dots = document.querySelectorAll(".branch-video-dot");
    dots.forEach(function(dot, idx) {
        if (idx === branchVideoIdx) {
            dot.classList.add("active");
        } else {
            dot.classList.remove("active");
        }
    });
}

function playCurrentBranchVideo() {
    clearInterval(branchVideoTimer);
    const currentVid = branchVideoData[branchVideoIdx];
    const boxEl = document.getElementById("branchVideoSlideBox");
    
    boxEl.innerHTML = `
        <video id="activeBranchHtml5Player" controls autoplay style="width:100%; height:100%; object-fit:contain; background:#000;">
            <source src="${currentVid.videoUrl}" type="video/mp4">
            متصفحك لا يدعم مشغل الفيديوهات المباشرة.
        </video>
        <div class="branch-video-caption-bar" style="background: rgba(10,26,47,0.85);">
            <h4>▶ ${currentVid.title}</h4>
            <p style="color:#cbd5e1;">${currentVid.desc}</p>
        </div>
    `;
    isBranchVideoPlaying = true;
}

function nextBranchVideoSlide() {
    showBranchVideoSlide(branchVideoIdx + 1);
    resetBranchVideoTimer();
}

function prevBranchVideoSlide() {
    showBranchVideoSlide(branchVideoIdx - 1);
    resetBranchVideoTimer();
}

function resetBranchVideoTimer() {
    clearInterval(branchVideoTimer);
    if (!isBranchVideoPlaying) {
        branchVideoTimer = setInterval(nextBranchVideoSlide, 8000);
    }
}

function downloadCurrentBranchVideo() {
    const currentVid = branchVideoData[branchVideoIdx];
    const link = document.createElement("a");
    link.href = currentVid.videoUrl;
    link.target = "_blank";
    link.download = "فيديو_الفرع_" + (branchVideoIdx + 1) + ".mp4";
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
}

function downloadAllBranchVideos() {
    branchVideoData.forEach((vid, i) => {
        setTimeout(() => {
            const link = document.createElement("a");
            link.href = vid.videoUrl;
            link.target = "_blank";
            link.download = "فيديو_الفرع_" + (i + 1) + ".mp4";
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }, i * 800);
    });
}
</script>
