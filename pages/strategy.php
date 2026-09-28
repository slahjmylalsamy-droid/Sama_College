<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}
?>

<style>
.strategy-page-container {
    direction: rtl;
    font-family: 'Cairo', sans-serif;
    color: #333;
    max-width: 1000px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 40px 35px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}

.strategy-heading-title {
    font-size: 28px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 10px;
}

.strategy-heading-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 60px;
    height: 3px;
    background-color: #085859;
    border-radius: 2px;
}

.strategy-text-block {
    margin: 35px 0 30px;
    line-height: 2.2;
    font-size: 16px;
    color: #333333;
    text-align: justify;
}

.strategy-download-box {
    margin: 30px 0 40px;
}

.strategy-link-label {
    font-size: 15px;
    font-weight: 700;
    color: #444;
    margin-bottom: 6px;
}

.strategy-click-btn {
    display: inline-block;
    color: #085859;
    font-weight: 800;
    font-size: 16px;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.strategy-click-btn:hover {
    color: #0d4748;
    text-decoration: underline;
}

/* Actions and Share Bar */
.strategy-actions-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: flex-end;
    gap: 15px;
    margin-top: 45px;
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

/* Bottom Nav Buttons */
.strategy-bottom-nav {
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
    padding: 10px 22px;
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
#strategyToast {
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

#strategyToast.show {
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
</style>

<div style="background:#f4f6f9; padding: 40px 15px;">
    <div class="strategy-page-container">
        
        <h1 class="strategy-heading-title">الخطة الاستراتيجية</h1>

        <div class="strategy-text-block">
            <p>
                تم إعداد الخطة الاستراتيجية لكلية سماء المتميزين استجابة لرغبة الإدارة العليا والمتوسطة وجميع منتسبي الكلية في البدء بدوران عجلة التطوير والتخطيط الاستراتيجي في الكلية والتوجه نحو الحوكمة الإدارية والعمل المؤسسي وتعزيز اللامركزية الإدارية، وذلك لترجمة رؤية الكلية ورسالتها في تحقيق الجودة والتميز في مجال التعليم العالي والبحث العلمي وخدمة المجتمع، ومواكبة للرؤية الوطنية واستراتيجيات وزارة التعليم العالي ومجلس الاعتماد الأكاديمي وضمان جودة التعليم العالي في الجمهورية اليمنية. كما روعي في إعداد الخطة الاستراتيجية المنهجية العلمية المتعارف عليها في التخطيط الاستراتيجي، وفيما يلي استعراض لأبرز ملامح الخطة الاستراتيجية للكلية.
            </p>
        </div>

        <!-- Download / View Document Link -->
        <div class="strategy-download-box">
            <div class="strategy-link-label">للإطلاع &lt;&lt;&lt;</div>
            <a onclick="openStrategyDocument()" class="strategy-click-btn">أنقر هنا</a>
        </div>

        <!-- Social Share Bar (المشاركة) -->
        <div class="strategy-actions-bar">
            <div class="share-group">
                <span class="share-title-text">مشاركة</span>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                    <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </a>

                <!-- Twitter / X -->
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('الخطة الاستراتيجية - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                    <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                    تويتر
                </a>

                <!-- WhatsApp -->
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('الخطة الاستراتيجية - كلية سماء المتميزين: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                    <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                    واتساب
                </a>

                <!-- Instagram -->
                <button onclick="copyStrategyLink()" class="share-btn-item insta" title="انستجرام">
                    <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                    انستجرام
                </button>

                <!-- Telegram -->
                <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('الخطة الاستراتيجية - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tg" title="تيليجرام">
                    <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                    تيليجرام
                </a>
            </div>
        </div>

        <!-- College Strategy Graphic Banner (مكان الصورة أسفل أيقونات المشاركة مع الشعار) -->
        <div class="strategy-banner-container" style="margin: 35px 0 25px; text-align: center;">
            <div style="position: relative; display: inline-block; width: 100%; max-width: 850px; border-radius: 16px; overflow: hidden; box-shadow: 0 8px 30px rgba(0,0,0,0.12); border: 2px solid #e2e8f0; background: #072928;">
                <!-- College Emblem Badge Overlay -->
                <div style="position: absolute; top: 15px; right: 20px; background: rgba(255, 255, 255, 0.95); padding: 8px 16px; border-radius: 30px; display: flex; align-items: center; gap: 10px; box-shadow: 0 4px 15px rgba(0,0,0,0.18); z-index: 10; border: 1px solid #ffd700;">
                    <img src="images/logo.png?v=3" alt="شعار كلية سماء المتميزين" style="width: 32px; height: 32px; object-fit: contain;">
                    <span style="font-weight: 800; color: #0d4748; font-size: 13px; font-family: 'Cairo', sans-serif;">كلية سماء المتميزين</span>
                </div>

                <img src="images/college_strategy.png?v=3" alt="استراتيجية الكلية" style="width: 100%; height: auto; max-height: 420px; object-fit: contain !important; display: block; margin: 0 auto;">
            </div>
        </div>

        <!-- Bottom Navigation Pill Buttons -->
        <div class="strategy-bottom-nav">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <a href="?p=about" class="nav-pill-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> نبذة عن الكلية
            </a>
            <a href="?p=president" class="nav-pill-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg> عميد الكلية
            </a>
            <a href="?p=vision" class="nav-pill-btn">
                🎯 الرؤية والرسالة
            </a>
            <a href="?p=goals" class="nav-pill-btn">
                🎯 الأهداف والقيم
            </a>
        </div>

    </div>
</div>

<!-- Toast notification element -->
<div id="strategyToast">تم نسخ رابط الصفحة بنجاح! يمكنك مشاركته عبر انستجرام.</div>

<!-- Interactive Document Modal (نافذة وثيقة الخطة الاستراتيجية) -->
<div id="strategyDocModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(10, 26, 47, 0.8); backdrop-filter:blur(5px); z-index:99999; justify-content:center; align-items:center; padding:20px; direction:rtl; font-family:'Cairo', sans-serif;">
    <div style="background:#ffffff; width:100%; max-width:850px; max-height:88vh; border-radius:20px; box-shadow:0 15px 40px rgba(0,0,0,0.4); display:flex; flex-direction:column; overflow:hidden; border:2px solid #ffd700; animation: modalFadeIn 0.3s ease;">
        
        <!-- Modal Header -->
        <div style="background:#0d4748; color:#ffffff; padding:20px 25px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #085859;">
            <div style="display:flex; align-items:center; gap:12px;">
                <img src="images/logo.png?v=3" alt="شعار الكلية" style="width:38px; height:38px; object-fit:contain; background:#fff; border-radius:50%; padding:3px;">
                <div>
                    <h3 style="margin:0; font-size:18px; font-weight:800; color:#ffffff;">وثيقة الخطة الاستراتيجية</h3>
                    <span style="font-size:12px; color:#ffd700;">كلية سماء المتميزين - الجمهورية اليمنية</span>
                </div>
            </div>
            <button onclick="closeStrategyDocument()" style="background:none; border:none; color:#ffffff; font-size:24px; cursor:pointer; font-weight:bold; padding:0 8px; line-height:1;">✖</button>
        </div>

        <!-- Modal Body Content -->
        <div style="padding:30px; overflow-y:auto; line-height:2.1; font-size:15px; color:#333;" id="printableDocContent">
            <div style="text-align:center; margin-bottom:25px; border-bottom:2px dashed #eee; padding-bottom:20px;">
                <h2 style="color:#085859; margin-bottom:5px; font-size:22px; font-weight:800;">ملخص محاور الخطة الاستراتيجية للكلية</h2>
                <p style="color:#666; font-size:14px; margin:0;">رؤية مستقبلية نحو التميز الأكاديمي والتطوير المؤسسي المستدام</p>
            </div>

            <div style="margin-bottom:20px;">
                <h4 style="color:#0d4748; font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px;">
                    <span style="background:#085859; color:white; width:26px; height:26px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:13px;">1</span>
                    المحور الأول: الحوكمة والتطوير المؤسسي
                </h4>
                <p style="margin-right:34px; color:#444;">التوجه نحو اللامركزية الإدارية والتحول الرقمي الشامل في جميع المعاملات الإدارية والأكاديمية، وبناء كوادر بشرية كفؤة تحقق أهداف الكلية.</p>
            </div>

            <div style="margin-bottom:20px;">
                <h4 style="color:#0d4748; font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px;">
                    <span style="background:#085859; color:white; width:26px; height:26px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:13px;">2</span>
                    المحور الثاني: الجودة والاعتماد الأكاديمي
                </h4>
                <p style="margin-right:34px; color:#444;">تطبيق معايير الاعتماد الوطني الصادرة عن مجلس الاعتماد الأكاديمي وضمان جودة التعليم العالي بالجمهورية اليمنية، وتطوير الخطط والمناهج الدراسية باستمرار.</p>
            </div>

            <div style="margin-bottom:20px;">
                <h4 style="color:#0d4748; font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px;">
                    <span style="background:#085859; color:white; width:26px; height:26px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:13px;">3</span>
                    المحور الثالث: التوسع في البرامج النوعية
                </h4>
                <p style="margin-right:34px; color:#444;">استحداث أقسام وتخصصات حديثة في المجالات الطبية والتقنية والإدارية تتوافق مع متطلبات سوق العمل المحلي والإقليمي وتلبي رغبات الطلاب.</p>
            </div>

            <div style="margin-bottom:20px;">
                <h4 style="color:#0d4748; font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px;">
                    <span style="background:#085859; color:white; width:26px; height:26px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:13px;">4</span>
                    المحور الرابع: البحث العلمي وخدمة المجتمع
                </h4>
                <p style="margin-right:34px; color:#444;">تشجيع أعضاء الهيئة التدريسية والطلاب على النشر العلمي، وتقديم برامج تدريبية واستشارية مجتمعية مجانية تسهم في التنمية المستدامة.</p>
            </div>

            <div style="margin-bottom:10px;">
                <h4 style="color:#0d4748; font-size:17px; font-weight:800; display:flex; align-items:center; gap:8px;">
                    <span style="background:#085859; color:white; width:26px; height:26px; border-radius:50%; display:inline-flex; align-items:center; justify-content:center; font-size:13px;">5</span>
                    المحور الخامس: البنية التحتية والبيئة التعليمية
                </h4>
                <p style="margin-right:34px; color:#444;">تحديث القاعات الدراسية وتجهيز المعامل والمختبرات الطبية والتقنية بأحدث الوسائل والتقنيات لتوفير بيئة تعليمية محفزة للإبداع.</p>
            </div>
        </div>

        <!-- Modal Footer Actions -->
        <div style="background:#f9fafb; padding:15px 25px; display:flex; justify-content:space-between; align-items:center; border-top:1px solid #eee;">
            <div style="display:flex; gap:10px;">
                <button onclick="printStrategyModal()" style="background:#0d4748; color:white; border:none; padding:8px 18px; border-radius:6px; font-weight:700; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:6px;">
                    <i class="fa-solid fa-print" style="margin-left: 5px;"></i> طباعة الوثيقة
                </button>
                <button onclick="exportStrategyPDF()" style="background:#085859; color:white; border:none; padding:8px 18px; border-radius:6px; font-weight:700; cursor:pointer; font-size:14px; display:flex; align-items:center; gap:6px;">
                    <i class="fa-solid fa-file-pdf" style="margin-left: 5px;"></i> استخراج PDF
                </button>
            </div>
            <button onclick="closeStrategyDocument()" style="background:#e5e7eb; color:#374151; border:none; padding:8px 20px; border-radius:6px; font-weight:700; cursor:pointer; font-size:14px;">
                إغلاق
            </button>
        </div>

    </div>
</div>

<style>
@keyframes modalFadeIn {
    from { opacity: 0; transform: scale(0.95); }
    to { opacity: 1; transform: scale(1); }
}
</style>

<script>
function copyStrategyLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    
    var toast = document.getElementById("strategyToast");
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

function openStrategyDocument() {
    document.getElementById('strategyDocModal').style.display = 'flex';
}

function closeStrategyDocument() {
    document.getElementById('strategyDocModal').style.display = 'none';
}

function printStrategyModal() {
    var content = document.getElementById('printableDocContent').innerHTML;
    var printWindow = window.open('', '', 'height=650,width=900');
    printWindow.document.write('<html><head><title>الخطة الاستراتيجية - كلية سماء المتميزين</title>');
    printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">');
    printWindow.document.write('<style>body{font-family:"Cairo",sans-serif;direction:rtl;padding:30px;line-height:2;} h2{color:#085859;} h4{color:#0d4748;}</style>');
    printWindow.document.write('</head><body>');
    printWindow.document.write(content);
    printWindow.document.write('</body></html>');
    printWindow.document.close();
    printWindow.focus();
    setTimeout(function(){ printWindow.print(); }, 500);
}

function exportStrategyPDF() {
    printStrategyModal();
}

// Close modal when clicking outside content card
window.onclick = function(event) {
    var modal = document.getElementById('strategyDocModal');
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

