<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}
?>

<style>
.planning-page-container {
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

.planning-heading-title {
    font-size: 28px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 30px;
    position: relative;
    padding-bottom: 10px;
}

.planning-heading-title::after {
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
.planning-master-grid {
    display: grid;
    grid-template-columns: 1fr 260px;
    gap: 40px;
    align-items: start;
}

@media (max-width: 900px) {
    .planning-master-grid {
        grid-template-columns: 1fr;
    }
}

/* Sidebar Menu (قائمة الخطة الاستراتيجية والإدارة) */
.planning-sidebar-box {
    background: #ffffff;
    border-right: 2px solid #e5e7eb;
    padding-right: 15px;
    padding-left: 5px;
    position: sticky;
    top: 100px;
}

.planning-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.planning-menu-item {
    margin-bottom: 8px;
}

.planning-menu-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
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

.planning-menu-link:hover {
    color: #085859;
    background: #f0f7f7;
    border-radius: 6px;
}

.planning-menu-link.active {
    color: #085859;
    font-weight: 800;
}

/* Burgundy indicator line on the right matching the reference image */
.planning-menu-link.active::after {
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
.planning-section-card {
    background: #ffffff;
    margin-bottom: 35px;
    padding-bottom: 25px;
}

.planning-sub-title {
    color: #0d4748;
    font-size: 24px;
    font-weight: 800;
    margin-bottom: 8px;
}

.planning-sub-caption {
    color: #666;
    font-size: 15px;
    margin-bottom: 25px;
}

/* Strategy Image Box matching screenshot layout */
.strategy-banner-box {
    position: relative;
    width: 100%;
    max-width: 800px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border: 1px solid #e2e8f0;
    background: #f8fafc;
    margin-bottom: 30px;
}

.strategy-banner-img {
    width: 100%;
    height: auto;
    max-height: 400px;
    object-fit: contain !important;
    display: block;
}

/* Overlay Card matching screenshot (شعار الكلية + استراتيجية الكلية) */
.strategy-overlay-card {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(255, 255, 255, 0.95);
    border-radius: 12px;
    padding: 20px 30px;
    display: flex;
    align-items: center;
    gap: 20px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    border: 2px solid #ffd700;
}

.strategy-badge-red {
    background: #085859;
    color: #ffffff;
    padding: 15px 30px;
    border-radius: 8px;
    font-size: 20px;
    font-weight: 800;
    text-align: center;
}

.strategy-badge-logo {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
}

.strategy-badge-logo img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.strategy-badge-logo span {
    font-size: 12px;
    font-weight: 800;
    color: #0d4748;
}

/* Arrows controls overlay on bottom right matching screenshot */
.strategy-controls-overlay {
    position: absolute;
    bottom: 20px;
    left: 20px;
    display: flex;
    gap: 8px;
}

.strategy-control-btn {
    width: 40px;
    height: 40px;
    background: rgba(255, 255, 255, 0.85);
    border: 1px solid #d1d5db;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    color: #374151;
    cursor: pointer;
    transition: all 0.2s ease;
}

.strategy-control-btn:hover {
    background: #0d4748;
    color: white;
    border-color: #0d4748;
}

.planning-text-paragraph {
    line-height: 2.2;
    font-size: 15px;
    color: #333333;
    text-align: justify;
    margin-bottom: 20px;
}

.planning-bullet-list {
    padding-right: 20px;
    line-height: 2.2;
    font-size: 15px;
    color: #333;
    margin-bottom: 25px;
}

.planning-bullet-list li {
    margin-bottom: 10px;
}

/* Actions and Share Bar */
.planning-actions-bar {
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

/* Bottom Nav Buttons */
.planning-bottom-nav {
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
#planningToast {
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

#planningToast.show {
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
    <div class="planning-page-container">
        
        <h1 class="planning-heading-title">إدارة التطوير والتخطيط الاستراتيجي</h1>

        <div class="planning-master-grid">
            
            <!-- Main Content Area (العمود الأيمن الرئيسي) -->
            <div class="planning-content-column">
                
                <!-- Section: الخطة الاستراتيجية -->
                <div id="sec-plan" class="planning-section-card">
                    <h2 class="planning-sub-title">الخطة الاستراتيجية</h2>
                    <div class="planning-sub-caption">الخطة الاستراتيجية لكلية سماء المتميزين</div>

                    <!-- Strategy Image Presentation Box matching reference image -->
                    <div class="strategy-banner-box">
                        <img src="images/college_strategy.png?v=3" alt="الخطة الاستراتيجية" class="strategy-banner-img">
                        
                        <!-- Overlay Card matching uploaded image -->
                        <div class="strategy-overlay-card">
                            <div class="strategy-badge-logo">
                                <img src="images/logo.png?v=3" alt="شعار الكلية">
                                <span>كلية سماء المتميزين</span>
                            </div>
                            <div class="strategy-badge-red">
                                استراتيجية الكلية
                            </div>
                        </div>

                        <!-- Slide control arrows overlay -->
                        <div class="strategy-controls-overlay">
                            <button onclick="openStrategyDocument()" class="strategy-control-btn" title="السابق">❮</button>
                            <button onclick="openStrategyDocument()" class="strategy-control-btn" title="التالي">❯</button>
                        </div>
                    </div>

                    <p class="planning-text-paragraph">
                        تتولى إدارة التطوير والتخطيط الاستراتيجي في كلية سماء المتميزين إعداد وصياغة الخطة الاستراتيجية للكلية، ومتابعة تنفيذ خططها التنفيذية والبرامج التطويرية بكفاءة عالية، وذلك لضمان تحقيق رؤية الكلية ورسالتها في التميز الأكاديمي والمؤسسي.
                    </p>

                    <div style="color:#b91c1c; font-size:18px; font-weight:800; margin-top:25px; margin-bottom:12px;">أبرز محاور التخطيط الاستراتيجي:</div>
                    <ul class="planning-bullet-list">
                        <li><strong>الحوكمة والإدارة الذكية:</strong> تطوير البنية الإدارية والتوجه نحو التحول الرقمي الشامل.</li>
                        <li><strong>التوسع البرامجي النوعي:</strong> إدخال أقسام وتخصصات حديثة تلبي احتياجات التنمية ومُتطلبات سوق العمل.</li>
                        <li><strong>الاعتماد والجودة الشاملة:</strong> تطبيق المعايير الوطنية الصادرة عن مجلس الاعتماد الأكاديمي.</li>
                        <li><strong>تطوير القدرات البشرية:</strong> تأهيل الكوادر الأكاديمية والإدارية من خلال برامج التدريب المستمر.</li>
                    </ul>
                </div>

                <!-- Section: مهام واختصاصات الإدارة -->
                <div id="sec-tasks" class="planning-section-card" style="border-top:1px solid #f0f0f0; padding-top:25px;">
                    <h2 class="planning-sub-title" style="font-size:20px;">مهام واختصاصات الإدارة</h2>
                    <ul class="planning-bullet-list">
                        <li>إعداد وصياغة ومراجعة الخطة الاستراتيجية العامة للكلية والخطط التشغيلية التابعة لها.</li>
                        <li>متابعة وتقويم مستوى إنجاز المؤشرات الاستراتيجية مع مختلف الأقسام والمراكز.</li>
                        <li>تقديم الاستشارات الفنية والتنظيمية لتطوير الأداء المؤسسي بالكلية.</li>
                    </ul>
                </div>

                <!-- Social Share Bar (المشاركة - في آخر جزء من محتوى العمود) -->
                <div class="planning-actions-bar">
                    <div class="share-group">
                        <span class="share-title-text">مشاركة</span>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                            <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            فيسبوك
                        </a>

                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('إدارة التطوير والتخطيط الاستراتيجي - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                            <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            تويتر
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('إدارة التطوير والتخطيط الاستراتيجي - كلية سماء المتميزين: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                            <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                            واتساب
                        </a>

                        <!-- Instagram -->
                        <button onclick="copyPlanningLink()" class="share-btn-item insta" title="انستجرام">
                            <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            انستجرام
                        </button>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('إدارة التطوير والتخطيط الاستراتيجي - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tg" title="تيليجرام">
                            <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                            تيليجرام
                        </a>
                    </div>
                </div>

            </div>

            <!-- Sidebar Navigation (العمود الأيسر للتنقل مع العلامة العنابية في اليمين) -->
            <div class="planning-sidebar-box">
                <ul class="planning-menu-list">
                    <li class="planning-menu-item">
                        <a onclick="scrollToPlan('sec-plan', this)" class="planning-menu-link active">
                            <span>الخطة الاستراتيجية</span>
                        </a>
                    </li>
                    <li class="planning-menu-item">
                        <a onclick="scrollToPlan('sec-tasks', this)" class="planning-menu-link">
                            <span>مهام واختصاصات الإدارة</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <!-- Bottom Navigation Pill Buttons (إدارة الكلية) -->
        <div class="planning-bottom-nav">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <a href="?p=quality" class="nav-pill-btn">
                ✨ مركز التطوير وضمان الجودة
            </a>
            <a href="?p=planning" class="nav-pill-btn">
                📈 إدارة التطوير والتخطيط
            </a>
            <a href="?p=students_affairs" class="nav-pill-btn">
                👨‍🎓 إدارة شؤون الطلاب
            </a>
            <a href="?p=finance" class="nav-pill-btn">
                💼 إدارة الشؤون المالية
            </a>
            <a href="?p=it" class="nav-pill-btn">
                💻 إدارة تكنولوجيا المعلومات
            </a>
        </div>

    </div>
</div>

<!-- Toast notification element -->
<div id="planningToast">تم نسخ رابط الصفحة بنجاح! يمكنك مشاركته عبر انستجرام.</div>

<script>
function scrollToPlan(id, el) {
    document.getElementById(id).scrollIntoView({ behavior: 'smooth' });
    
    // Toggle active class on sidebar links
    var links = document.querySelectorAll('.planning-menu-link');
    links.forEach(function(l) { l.classList.remove('active'); });
    el.classList.add('active');
}

function copyPlanningLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    
    var toast = document.getElementById("planningToast");
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}
</script>
