الاسم العربي والاسم الإنجليزي -->", "StartLine": 1305, "TargetContent": "            <!-- الخطوة الثانية: البيانات الشخصية -->
// pages/events.php - صفحة الفعاليات والأنشطة العامة والطلابية
We implemented the routing, layout wrapping, dynamic breadcrumbs, custom category section banners, and a master-detail structure on the news page in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) and [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php).
26 AM, but `git_recovered_v2_44.php` was updated at 4:30 AM! This means there's a need to consider how to evaluate these objects properly! I think sorting them by commit date may be a good idea, but the script orders files in directory order. I must figure out which one is the latest or cleanest to proceed!
جوال ولي الأمر ورقم الواتس -->
// 1. تحديد الصفحة المطلوبة
// تصنيفات الفعاليات
Added `define('INCLUDED_FROM_INDEX', true);` at the top of [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to authorize pages included inside it.
start_marker = "<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->
    'حفلات ومناسبات' => 'حفلات ومناسبات',
Updated the `$public_pages` array in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to authorize all subpages for:
new_modal_code = """<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->
<div id="latestNewsDetailsModal" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.25); width:100%; max-width:700px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden; display:flex; flex-direction:column; max-height:90vh;">
- **Centers:** `medical_institute`, `community_college`, `training_center`, `community_services`
  Line 153: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <div style="background:#0f3460; color:white; padding:20px; font-weight:bold; font-size:17px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #008080;">
            <span id="news_modal_badge" style="background:#008080; padding:2px 10px; border-radius:30px; font-size:12px; font-weight:bold; color:white; margin-left:10px;">أخرى</span>
            <span id="news_modal_title" style="flex-grow:1; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">تفاصيل الخبر</span>
            <button onclick="closeLatestNewsModal()" style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; margin-right:15px;">&times;</button>
Included all of the above subpages in the `$layout_pages` array so they automatically render inside the global header/navigation and footer wrapper.
            $login_error = "<i class='fa-solid fa-triangle-exclamation' style='margin-left: 5px;'></i> حسابك قيد المراجعة. سيتم إشعارك عند قبول طلبك.";
        <!-- جسم المودال -->
   - Includes social sharing buttons (Facebook, Twitter/X, WhatsApp, Telegram, Copy Link) matching the premium aesthetics of the events page.
- Implemented clean, premium, dynamic content cards for the new majors, admin, and center subpages.
            <!-- معرض الصور والفيديو -->
            <div id="news_modal_media_gallery_wrapper" style="margin-bottom:20px;">
- Implemented a breadcrumb trail bar with a home SVG icon linking to `?p=home`, a separator `/`, and the page title, styled with burgundy colors and displayed on all visitor subpages.
                <div id="news_modal_media_viewer" style="width:100%; height:260px; background:#f8fafc; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 15px rgba(0,0,0,0.05); position:relative;">
                    <!-- سيتم ملؤه ديناميكياً -->
<div style="max-width:1150px; margin:30px auto; padding:0 20px; font-family:'Cairo', sans-serif; direction:rtl; text-align:right;">
  - Background color: Dark red / burgundy (`#7d0f3f`).
                <!-- شبكة مصغرات الصور (Thumbnails) -->
    <div style="display:flex; justify-content:space-between; align-items:center; background:#f8fafc; padding:12px 20px; border-radius:12px; border:1px solid #e2e8f0; margin-bottom:30px; flex-wrap:wrap; gap:10px;">
  - Right text: Section category name ("من نحن" for About, "التخصصات" for Majors, "إدارة الكلية" for Admin, "المراكز" for Centers, and "الفروع" for Branches).
        <p style="color:#666; font-size:15px; max-width:600px; margin:0 auto; line-height:1.7;">تابع الفعاليات الأكاديمية، والندوات العلمية، وورش العمل التدريبية، والأنشطة الطلابية والرياضية التي تنظمها الكلية على مدار العام.</p>
- **Sizing & Alignment Update:** Tuned the banner width to a highly compact and elegant size (`width: 180px`), with optimized inner padding (`10px 14px`) and typography sizes (`15px` for text and `16px` for menu icon). The banner is aligned to the **left side** of the page (aligned to the left edge of the main content wrapper card) using RTL flex layouts.
- **Interactive Dropdown Menu:** Added an interactive dropdown menu to the banner. When a user clicks anywhere on the banner, it toggles a clean dropdown showing all other subpages inside the current category. The current active page is automatically highlighted with a light background (`#fdf2f4`) and bold burgundy text. The menu automatically closes when the user clicks outside.
- **Menu Close Icon (✖):** Enhanced the toggle script to swap the hamburger icon (☰) with a close cross icon (✖) and rotate it by 90 degrees when the menu is active.
        $login_error = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
        $login_error = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
            <a href="index.php" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a>
                <h4 style="margin:0 0 10px 0; color:#0f3460; font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;"> تفاصيل ومحاور الفعالية:</h4>
                <p id="modal_event_desc" style="color:#4a5568; font-size:14px; line-height:1.7; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify;"></p>
                thumbBtn.innerHTML = `<div style="width:100%; height:100%; background:#0f3460; display:flex; align-items:center; justify-content:center; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:#0f3460; font-size:14px; margin-left:10px;"> مشاركة الفعالية:</span>
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_receipt']) && isset($_SESSION['user_id'])) {
  - Dual action download buttons: **` تنزيل الصورة المعروضة`** and **` تنزيل جميع الصور`**.
                    <a id="share_fb" href="" target="_blank" class="share-btn-item fb" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#1877f2'; this.style.color='white'; this.style.borderColor='#1877f2';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
    if (isset($_FILES['receipt_file']) && $_FILES['receipt_file']['error'] == 0) {
- Created [pages/vision.php](file:///c:/xampp1/htdocs/Sama_College/pages/vision.php) matching the user's reference image:
  - **Title:** `الرؤية والرسالة` with a burgundy underline.
  - **Left Section Banner:** `من نحن` with a dark burgundy background, blue stripe, and animated hamburger menu icon.
                    <a id="share_tw" href="" target="_blank" class="share-btn-item tw" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#000'; this.style.color='white'; this.style.borderColor='#000';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
    - **`الرؤية:`** (in red font `#b91c1c`) الريادة محلياً والتُميّز إقليماً في مجال التعليم العالي والبحث العلمي وخدمة المجتمع.
    - **`الرسالة:`** (in red font `#b91c1c`) تقديم خدمة تعليمية وبحثية ومجتمعية ذات جودة عالية لإعداد مخرجات كفؤة تتمتع بالمعرفة والمهارة تسهم في تحقيق التنمية المستدامة من خلال بيئة أكاديمية وإدارية وتقنية محفزة.
  - **Social Sharing Bar:** `مشاركة` label followed by Facebook, Twitter, WhatsApp, Instagram (with link copy toast), and Telegram buttons.
  - **Bottom Navigation Pill Buttons:** Clean navigation pills linking to `الرئيسية`, `نبذة عن الكلية`, `عميد الكلية`, `الأهداف والقيم`, and `الخطة الاستراتيجية`.
                    <a href="${media.url}" download="${media.url.substring(media.url.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                    <a id="share_wa" href="" target="_blank" class="share-btn-item wa" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#25d366'; this.style.color='white'; this.style.borderColor='#25d366';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 32 32" style="width:16px; height:16px;"><path fill="currentColor" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
  - **Title:** `الأهداف والقيم` with a burgundy underline.
  - **Section 1 Heading:** `الأهداف:` (in red font `#b91c1c`) followed by a numbered list of the 5 main college goals.
  - **Section 2 Heading:** `القيم:` (in red font `#b91c1c`) followed by a numbered list of the 5 core college values.
  - **Social Sharing Bar:** `مشاركة` label followed by Facebook, Twitter, WhatsApp, Instagram (with link copy toast), and Telegram buttons.
                    <a id="share_tg" href="" target="_blank" class="share-btn-item tg" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#0088cc'; this.style.color='white'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
                        var videoId = (match && match[2].length == 11) ? match[2] : null;
- Updated [pages/strategy.php](file:///c:/xampp1/htdocs/Sama_College/pages/strategy.php):
  - **Removed Dates:** Removed `2026-2030م` / `2021-2025م` from the main title heading and introductory text as requested by the user. Title set to simply **`الخطة الاستراتيجية`**.
>' . $student_id . '</strong><br>الرجاء حفظ الرقم لتسجيل الدخول ومتابعة حالة الدفع والقبول.</div>';
                    <button onclick="copyEventShareLink()" class="share-btn-item insta" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#e1306c'; this.style.color='white'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        انستجرام
### 21. Development & Quality Assurance Center Page Implementation (`pages/quality.php`)
                        viewer.innerHTML = `<video src="${videoUrl}" controls autoplay style="width:100%; height:100%; background:#000;"></video>
                        <a href="${videoUrl}" download="${videoUrl.substring(videoUrl.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                    <button onclick="copyEventShareLink()" class="share-btn-item copy" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#008080'; this.style.color='white'; this.style.borderColor='#008080';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
  - **Section 2: `كلمة عميد المركز`:** Dean/Director statement card for Dr. Mohamed Ahmed Abdulwahab Al-Samei.
  - **Section 3: `الهيكل التنظيمي`:** Clean visual hierarchy org-chart diagram.
  - **Section 4: `وحدات المركز`:** Grid of 4 unit cards (Planning & Accreditation Unit, Evaluation Unit, Training Unit, Documentation Unit).
  - **Relocated Social Sharing Bar:** Moved the `مشاركة` bar to the **very end** of the main content column below Section 4, placing it right before the bottom navigation pill buttons as explicitly requested.
}
### 22. Strategic Planning & Development Administration Page Implementation (`pages/planning.php`)
- Created [pages/planning.php](file:///c:/xampp1/htdocs/Sama_College/pages/planning.php) matching the user's reference screenshot:
  - **Title:** `إدارة التطوير والتخطيط الاستراتيجي` with a burgundy underline.
  - **Sidebar Menu (Right Column):** Renders **`الخطة الاستراتيجية`** with a **burgundy accent bar** on the right side matching the screenshot layout.
            <a href="index.php" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a>
  - **Strategy Presentation Box:** Displays the strategy graphic banner (`images/college_strategy.png`) with an overlay card containing the college emblem logo and burgundy text **`استراتيجية الكلية`**, alongside left/right preview arrows.
  - **Strategic Pillars & Tasks:** Detailed strategic objectives and administration duties list.
  - **Social Sharing Bar:** Placed at the very end of the content column before the bottom navigation pill buttons.
    var shareUrl = window.location.origin + window.location.pathname + '?p=latest_news&id=' + news.id;
    var shareTitle = news.title + ' - كلية سماء المتميزين';
- Created [pages/students_affairs.php](file:///c:/xampp1/htdocs/Sama_College/pages/students_affairs.php) matching the user's reference screenshot:
  - **Title:** `إدارة شؤون الطلاب` with a burgundy underline.
  - **Sidebar Menu (Right Column):** Renders **`عن الإدارة`** with a **burgundy accent bar** on the right side `-`, alongside **`أقسام الإدارة`**.
  - **Exact Paragraph Text:** "تم إنشاء الإدارة لتتولى الاشراف على كل ما يتعلق بشؤون الطلاب والطالبات أثناء دراستهم بالكلية، وذلك من خلال تقديم الخدمات التي يحتاجونها، وتقديمها بأرقى المواصفات...
    document.getElementById('news_share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('news_share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    document.getElementById('news_share_tg').href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    border-radius: 8px;
### 24. Financial Affairs Administration Page Implementation (`pages/finance.php`)
- Created [pages/finance.php](file:///c:/xampp1/htdocs/Sama_College/pages/finance.php) with rich icon graphics and banking details:
  - **Title:** `إدارة الشؤون المالية` with a burgundy underline.
  - **Sidebar Menu (Right Column):** Renders `عن الإدارة`, `مهام واختصاصات الإدارة`, `أقسام الإدارة المالية`, `قنوات السداد البنكي`.
  - **4 Interactive Feature Cards:** Flexible Tuition, Electronic Payment, Governance, Discounts.
    document.getElementById('modal_event_loc').innerText = event.location || 'حرم الكلية الرئيسي';
  - **Approved Banking Channels Card:** Kuraimi Bank, Tadhamon Bank, Jawwali Wallet.
  - **Social Sharing Bar:** Placed at the very end of the content column before the bottom navigation pill buttons.
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '✅ تم تأكيد دفعك!')");
    header("Location: index.php?p=manage_students&msg=paid"); exit();
- Created [pages/it.php](file:///c:/xampp1/htdocs/Sama_College/pages/it.php) with high-tech icons, IT services, and helpdesk contact details:
  - **Title:** `إدارة تكنولوجيا المعلومات` with a burgundy underline.
  - **Sidebar Menu (Right Column):** Renders `عن الإدارة`, `خدمات تكنولوجيا المعلومات`, `أقسام تكنولوجيا المعلومات`, `الدعم الفني والمساندة`.
    mysqli_query($conn, "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id");
    -  **المعامل والذكاء الاصطناعي:** Modern computer labs & AI software.
    -  **إنترنت وشبكات فايبر:** High-speed Wi-Fi and fiber connectivity.
    - ️ **الأمن السيبراني:** Cybersecurity, firewalls, and data server protection.
    -  **الأنظمة والبوابة الرقمية:** Academic portal, student Portal, and emails.
  - **IT Departments Grid:** Systems & Software, Networks & Security, Tech Support & Maintenance, Digital Learning & Website.
    mysqli_query($conn, "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id");
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, ' تم قبول طلبك!')");
    header("Location: index.php?p=manage_students&msg=approved"); exit();
### 26. Context-Sensitive Bottom Navigation Buttons per Category
- Customized the bottom navigation pill buttons bar to render **ONLY** the relevant subpages for that specific section:
  - **Category `عن الكلية`** (`about.php`, `president.php`, `vision.php`, `goals.php`, `strategy.php`): Displays links exclusively to `نبذة عن الكلية`, `عميد الكلية`, `الرؤية والرسالة`, `الأهداف والقيم`, `الخطة الاستراتيجية`.
  - **Category `إدارة الكلية`** (`quality.php`, `planning.php`, `students_affairs.php`, `finance.php`, `it.php`): Displays links exclusively to `مركز التطوير وضمان الجودة`, `إدارة التطوير والتخطيط`, `إدارة شؤون الطلاب`, `إدارة الشؤون المالية`, `إدارة تكنولوجيا المعلومات`.
  - **Category `المراكز`** (`medical_institute.php`, `community_college.php`, `training_center.php`, `community_services.php`): Displays links exclusively to `المعهد الطبي العالي`, `كلية المجتمع`, `مركز التدريب والتأهيل`, `مركز خدمة المجتمع والدراسات`.
  - **Category `الفروع`** (`branch_damnah.php`, `branch_rahdah.php`): Displays links exclusively to `فرع دمنة خدير`, `فرع الراهدة`.
$permission = $_SESSION['permission'] ?? 0;
$payment_status = $_SESSION['payment_status'] ?? 'unpaid';
- Created all 4 Center pages with custom icon feature cards, programs/courses grids, sidebar navigation, social share bars, and context-sensitive Center bottom navigation pill buttons:
  1. `medical_institute.php`: **المعهد الطبي العالي** (Physician Assistant, Pharmacy Tech, Medical Labs, Nursing & Midwifery).
  2. `community_college.php`: **كلية المجتمع** (IT & Networking, Graphics, Business & Accounting, Interior Design).
  3. `training_center.php`: **مركز التدريب والتأهيل** (English TOEFL/IELTS, Programming & AI, Emergency Healthcare, Digital Marketing).
  4. `community_services.php`: **مركز خدمة المجتمع والدراسات** (Medical Caravans, Awareness Initiatives, Annual Job Fair, Field Studies).
    transform: translateY(-3px);
    'home', 'login', 'enroll', 'announcements_public', 'schedule', 'portal', 'grades', 'complaints', 'events',
- Created both Branch pages with contact details, degree awarded, admission rules, list of programs, automated photo slideshow gallery, interactive location maps, social share bars, and context-sensitive bottom navigation pills toggling between branches.
    'news', 'students', 'research', 'library', 'jobs', 'contact',
### 29. Image Slider Syntax and Display Fixes (news.php & students_affairs.php)
- Corrected a CSS/HTML tag nesting issue on the news detailed page ([news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php)) where the dynamic image slider code was incorrectly injected inside the style block.
- Standardized image aspect ratio display behaviors for both the slide gallery and single images in [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php) using `max-width: 100%`, `max-height: 520px`, `width: auto`, `height: auto`, and `object-fit: contain !important` to ensure full image visibility without cropping.
- Updated the student binders archive banner in [students_affairs.php](file:///c:/xampp1/htdocs/Sama_College/pages/students_affairs.php) from `object-fit: cover` to `object-fit: contain !important` to prevent cropping on responsive screens.
- Verified all 23 subpage PHP scripts compiled successfully with zero syntax errors.
    'medical_institute', 'community_college', 'training_center', 'community_services',
### 30. Header Login and Logout buttons (index.php)
- Configured the top header buttons statically as requested:
  - Blue **دخول** (Login) button linking to `?p=login`.
$admin_pages = ['admin_dashboard', 'manage_students', 'manage_staff', 'manage_grades', 'upload_lecture', 'announcements', 'manage_schedule', 'manage_content', 'manage_permissions'];
$staff_pages = ['staff_dashboard', 'manage_grades', 'upload_lecture', 'announcements'];
$student_pages = ['student_dashboard', 'grades', 'schedule', 'lectures', 'study_plan', 'upload_receipt', 'complaints', 'events'];
### 31. Home Page Quick Access Boxes Reordering (index.php)
- Reordered the quick access boxes/cards inside the services grid on the homepage.
if ($is_admin) $allowed_pages = array_merge($allowed_pages, $admin_pages);
if ($is_staff) $allowed_pages = array_merge($allowed_pages, $staff_pages);
  2. **التقويم الجامعي**
  3. **البوابة الإلكترونية**
  4. **نتائج الامتحانات**
  5. **تقديم شكوى / مقترح**

### 32. Full 4-Step Enrollment Page Overhaul (index.php)
- Overhauled the online enrollment page (`?p=enroll`) to feature a premium multi-step wizard.
- **Database Schema Update**: Modified the `users` table to add columns for gender, birth_date, birth_place, nationality, address, qualification_type, high_school_percentage, graduation_year, school_name, identity_type, identity_number, identity_issue_date, branch, and college, storing all enrollment details.
- **Top Banner Graphic**: Designed a custom responsive top banner featuring a burgundy-to-navy gradient background, gold bottom border, floating college logo emblem, and styled text elements matching the layout of the user's reference image.
- **Step 1 (Program Selector)**: Renders الفرع (Branch), القسم (Department) categorized by field of study (العلوم الطبية والصحية, العلوم التقنية والحاسوب, العلوم الإدارية والمالية, العلوم الهندسية), and التخصص (Specialization - dynamic options loaded via JS based on selected department).
<title>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</title>
- **Step 3 (Previous Qualification)**: Collects Qualification Type, High School Percentage/Grade (50-100%), Graduation Year, and School Name.
- **Step 4 (Identity & Account Setup)**: Collects Identity Type, Identity Number, Issue Date, Account Password, and a declaration checkbox confirming input correctness.
- **Validation**: Each step contains a conditional next button that is enabled only when all step fields are filled out, providing a fluid UX.
    --main-color:#0f3460;
### 33. Program Selector (Step 1) Dropdown Bug Fixes
- **State Retention on Page Reload**: Configured `branchSelect` options to retain the selected state using PHP conditional tags. Added a DOMContentLoaded script block that automatically restores the selected `collegeSelect` and `departmentSelect` dropdown values on page load if the form is reloaded due to a validation error.
- **Robust JavaScript Compatibility**: Converted `.forEach` loops inside `updateColleges()` and `updateDepartments()` to standard `for` loops to prevent execution failure on older mobile/tablet browsers.
- **Auto-Navigation & Field Initialization**: Resolved the issue where navigating back to Step 1 after a validation reload displayed disabled, empty dropdowns, ensuring a smooth, premium user experience.
    margin:0;
### 34. Success Modal Display & Database Reliability Fixes
- **Moved Success Modal**: Repositioned `successModal` HTML out of the `enrollWizardContainer` parent container to be directly on the outer page layout. This ensures that the modal shows up perfectly on page reload even when the wizard container starts as hidden (`display: none;`).
- **Self-Healing Database Check**: Embedded a dynamic check in `index.php` that inspects the database columns on form submission. If any of the required columns (like `gender`, `birth_date`, `branch`, etc.) are missing from the `users` table, the script automatically issues `ALTER TABLE` commands to add them on the fly. This prevents SQL insertion failures and guarantees the success modal appears.
- **Updated Account Numbers**: Added all payment channels and accounts (`3007722396`, `3086295309`, and `3053343518`) to the modal's success text to cover all valid options for students.
    text-align:center;
### 35. Online Registration Layout & Printed Receipt Branding Alignment
- **Isolated Registration Portal (No Header/Footer)**: Configured the public header, navigation menu, breadcrumbs, and footer to be conditionally hidden when the request page is `enroll` (`?p=enroll`). This yields a dedicated, clean, distraction-free registration portal experience.
- **Printed Receipt Color Re-branding**: Updated the styles in the `printReceipt(data)` JavaScript generator to align fully with the college's navy blue logo colors (replacing the red `#751214` accent colors with Navy `#0f3460` and soft blue/gray backgrounds `#eef4f8`/`#f2f7fb`).
- **Table & Label Colorization**: Made all section titles ("أولاً", "ثانياً", "ثالثاً"), labels (e.g. "الاسم رباعي (عربي):", "الجنس:", "الجنسية:"), and table borders blue to meet the user's detailed brand layout instructions.

// MISSING LINE 324
// MISSING LINE 325
// MISSING LINE 326
// MISSING LINE 327
// MISSING LINE 328
// MISSING LINE 329
- **RTL Direction for Date Cell**: Changed the CSS styling of the date metadata table cell in `printReceipt` to `direction: rtl` (keeping the alignment `text-align: left`). This ensures that mixed alphanumeric date strings (like `27 / يوليو / 2026 م` and `13 / صفر / 1448 هـ`) render in the correct visual right-to-left order without digits and letters getting reversed.
- **Robust Hijri Extraction**: Programmed a custom loop using `Intl.DateTimeFormat.formatToParts` to extract the Hijri day, month, and year values separately. This guarantees a clean output format and avoids duplicate characters like `هـ هـ` regardless of the client browser's default locale.

### 38. Printed Receipt PDF Saving Delay Bug Fix
- **Delayed Window Closing**: Added a 1.5-second (1500ms) delay via `setTimeout` before executing `window.close()` on the printed receipt window's `onafterprint` event. This prevents modern browsers (Chrome, Edge, mobile webviews) from aborting the asynchronous "Save as PDF" download process when the initiating window is immediately closed.

### 39. Academic Calendar Page Overhaul
- **Dual-Purpose Schedule Handler**: Modified the `?p=schedule` routing handler in `index.php` to serve two roles: showing the personal weekly lecture schedule for logged-in students, and a beautiful, public academic calendar for guests/visitors.
- **Student Dashboard Tabs**: Added interactive tab buttons (`SwitchCalendarTab`) for logged-in students to toggle seamlessly between their weekly lecture schedule and the official academic calendar.
- **Detailed Academic Timeline**: Built a premium, interactive academic calendar for the 2026/2027 academic year with category filtering (All, Semester 1, Semester 2, Exams, Vacations) and a dedicated print utility (`printAcademicCalendar`).

### 40. Public Access & Modularization of Academic Calendar Page
- **Public Page Authorization**: Added `'schedule'` to both the `$public_pages` and `$layout_pages` arrays in `index.php`. This allows non-logged-in public guests to access `?p=schedule` and ensures that the public header/nav and footer load around the page.
- **Created academic_calendar.php**: Created a modular template file at [academic_calendar.php](file:///c:/xampp1/htdocs/Sama_College/pages/academic_calendar.php) to contain the entire interactive academic calendar HTML, CSS, filter tabs script, and print layout.
- **Conditional Wrapper**: Programmed a conditional check `if (!$is_logged_in)` in the modular template file. This prevents double-nested card boxes and styling issues when the template is loaded inside the student portal dashboard versus the public visitor pages.

### 41. PDF Export & Social Sharing for Academic Calendar
- **Save as PDF Button**: Added a "حفظ كـ PDF" button next to the print button, linking to a new JavaScript function `saveCalendarAsPDF()`. It dynamically opens a print preview window with the title set to `التقويم_الأكاديمي_لكلية_سماء_المتميزين_2026_2027` so that browser PDF engines automatically suggest a beautiful filename, and includes the 1.5-second auto-close delay.
- **Social Sharing Icons**: Built a modern, hover-responsive social sharing bar below the calendar table, supporting sharing to WhatsApp, Telegram, Facebook, X (Twitter), and a "Copy Link" utility with an auto-dismissing success alert.

// MISSING LINE 350
// MISSING LINE 351
// MISSING LINE 352
// MISSING LINE 353
// MISSING LINE 354

### 43. Robust Inline SVG Sharing Icons
- **SVG Social Icons Integration**: Replaced Font Awesome webfont-based icons in the rectangular sharing buttons with inline SVG path elements for Facebook, Twitter/X, WhatsApp, Telegram, and Instagram. This ensures the icons are fully embedded in the HTML document and render instantly offline, resolving the issue where some browsers blocked or failed to load the webfont-based social icons.

### 44. Breadcrumbs Title Fix for Academic Calendar Page
- **Breadcrumb Mapping**: Added `'schedule' => 'التقويم الجامعي'` to the `$page_titles` array in `index.php`. This fixes the breadcrumb navigation bar, which was previously displaying an empty space after the `/` separator, ensuring it now correctly displays "الرئيسية / التقويم الجامعي" to match the rest of the application's navigation styling.

### 45. Unified Electronic Portal Gateway Page
- **Created portal.php**: Created a premium, responsive unified portal gateway template at [portal.php](file:///c:/xampp1/htdocs/Sama_College/pages/portal.php) that acts as the entry point for all college users.
- **Card-Based Interface**: Designed three beautiful, hover-responsive information cards explaining the exact features and target audiences for: (1) Student Portal, (2) Staff/Faculty Portal, and (3) Administrator Portal.
- **Auto-routing for Active Sessions**: Programmed a PHP greeting check at the top of the portal gateway to detect if the user is already logged in, showing their name and a direct dashboard link to prevent redundant logins.
- **Authorized Guest Access**: Added `'portal'` to the `$public_pages` and `$layout_pages` arrays in `index.php`, included the template file in routing switches, mapped the title in `$page_titles`, and updated the homepage's portal box card to redirect to `?p=portal`.

### 46. Comprehensive Administrator Control (CMS & Permissions Manager)
- **Automatic Database Tables**: Appended SQL creation queries in `db_connect.php` to automatically instantiate `site_settings`, `site_pages`, and `academic_calendar` tables.
- **Dynamic Homepage Slider & Logo Sizes**: Connected the main header logo size, footer logo size, and all three homepage slides (image, title, text) to retrieve values dynamically from the database.
- **Generic Page Router Interceptor**: Programmed a router check in `index.php` that intercepts public page rendering. If the administrator publishes custom HTML/text content in `site_pages` for a specific page, it renders it instantly; otherwise, it falls back to the default static PHP template.
- **Admin CMS Editor (manage_content.php)**: Created [admin_manage_content.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_content.php) allowing the admin to dynamically modify homepage slides, logo sizes, any public subpage content, and fully manage (add, edit, delete) the Academic Calendar.
- **Admin Permissions Manager (manage_permissions.php)**: Created [admin_manage_permissions.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_permissions.php) providing the administrator full control to view all users, modify names/emails/roles, change permissions, manage student payment statuses, or delete accounts.
- **Staff Deletion Bugfix**: Implemented the missing `$_GET['delete']` handler for the `manage_staff` block in `index.php`.

### 47. Public Exam Results Query Page by College Card ID
- **Created public_grades_query.php**: Designed a detailed public query interface at [public_grades_query.php](file:///c:/xampp1/htdocs/Sama_College/pages/public_grades_query.php) wrapped inside the guest layout.
- **Card ID Search**: Allows students to query their grades by typing their college card ID (student ID, e.g., `2026001`).
- **Tuition Payment Block**: Integrated a check against the `payment_status` database field. If unpaid or pending, the system displays a secure, friendly alert explaining that grades are temporarily locked and provides details on how to settle tuition or upload receipts.
- **Academic Transcript Card**: For paid students, renders their full name, ID, major/department, level, and a detailed subjects table (marks for attendance, participation, year work, final exam, total, and grade letter).
- **Dynamic GPA & Estimates**: Computes the student's terminal GPA percentage and automatically maps it to standard general estimates (Excellent, Very Good, Good, Pass, Fail).
- **Printable Transcripts & Signatures**: Provides a "Print" and "Save as PDF" handler that formats the transcript professionally with centered college logo headers and signature slots (Dean, Registrar, Student Affairs) for official verification.
- **Authorized Guest Access**: Added `'grades'` to the `$public_pages` and `$layout_pages` arrays in `index.php`, included the new public template in routing switches, and mapped the title in `$page_titles`.

### 48. SVG Sharing Icons Integration on Exam Results
- **SVG Social Icons**: Replaced the text buttons with beautiful inline SVG icons (Facebook, Twitter/X, WhatsApp, Telegram) in the sharing widget of `pages/public_grades_query.php`.
- **Aesthetic Consistency**: Styled the buttons with hover micro-animations and border effects to exactly match the academic calendar's premium styling.
- **Home Navigation**: Standardized the primary redirection button styling to return back to the main homepage.

### 49. Student Semester Field Migration & Printed Transcript Layout
- **Database Migration**: Added an ALTER TABLE database check in `db_connect.php` to dynamically register the `semester` (الترم / الفصل الدراسي) column in the `users` table.
- **Admin Control Over Semester**: Updated the user permissions manager at [admin_manage_permissions.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_permissions.php) to support editing the student's academic semester alongside their level and department.
- **Transcript Info Expansion**: Modified [public_grades_query.php](file:///c:/xampp1/htdocs/Sama_College/pages/public_grades_query.php) to display both the Level (المستوى الدراسي) and Term/Semester (الترم / الفصل الدراسي) in the grades metadata grid and in the printable document view.
- **Printed Logo Sizing**: Adjusted the print stylesheet's logo max-height to `75px` to ensure the college emblem is beautifully proportioned and doesn't overlap text when printing.




// MISSING LINE 399

### 51. College and Department Separation & Instagram Icon Integration
- **Field Separation (College vs Department)**: Split "التخصص والقسم" into two distinct fields: (1) "القسم / الكلية" (mapped to `college` column) and (2) "التخصص" (mapped to `department` column) in both the public screen and printed transcripts.
- **Admin Management of College Field**: Enhanced [admin_manage_permissions.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_permissions.php) to support database edits of the `college` (القسم/الكلية) field separately inside the user edit modal.
- **Instagram Sharing Widget**: Integrated the missing Instagram sharing button with its official SVG icon in the share layout of [public_grades_query.php](file:///c:/xampp1/htdocs/Sama_College/pages/public_grades_query.php), including clipboard copying and confirmation alerts.

### 52. Logged-In Student Dashboard Integration for Grades
- **Unified Switch routing**: Replaced the student grades dashboard switch block inside `index.php` with the new [public_grades_query.php](file:///c:/xampp1/htdocs/Sama_College/pages/public_grades_query.php) layout.
- **Session Auto-Query logic**: Programmed auto-fetch rules inside `public_grades_query.php`. If a student is logged in, it automatically pulls their details from the database and loads their grades transcript directly, bypassing the guest card ID query form.

### 53. Complete Field Separation and Print Logo Rescaling
- **Separate Fields**: Separated the combined "التخصص والقسم" text into two separate elements (القسم / الكلية) and (التخصص الأكاديمي) in both screen and printed document renders of the transcript page.
- **Printed Logo Maximization**: Increased the max-height limit of the college logo inside the print stylesheet from `110px` to `145px` to make the emblem look bold and prominent on physical print layouts.


- **No More OS Emojis**: Replaced all device-dependent text emojis (, , , , , ) in the student info block with custom, vector-based inline SVG icons styled in the brand's teal color (`#008080`).
- **Unified Print Aesthetics**: Cleaned up the printable script's metadata section to use plain, color-themed labels rather than browser emojis to guarantee a highly professional look on printed documents.
- **Instagram Social Integration**: Added the Instagram sharing button directly to the public share block with its official pink gradient brand color, connecting it to the clipboard copying link helper script.

### 55. Unified Complaints & Suggestions Submission and Tracking Portal
- **Database Schema**: Added auto-creation of the `complaints` table in `db_connect.php` to store submission details (reference code, contact info, category, status, and admin responses).
- **Public & Student Submission Form**: Designed and built [complaints.php](file:///c:/xampp1/htdocs/Sama_College/pages/complaints.php) equipped with validation, sender classification, category selection, message text area, and simple math security checking.
- **Reference Code Generator**: Programmed a random, collision-free code generator (`COMP-XXXXX`) that outputs a tracking code to the user upon submission.
- **Live Complaint Tracking**: Integrated a real-time status tracker in the submission interface allowing users to input their reference code and instantly view status timelines and official administration responses.
- **Admin Management Panel**: Created a fourth tab ` الشكاوى والمقترحات` in [admin_manage_content.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_content.php) where administrators can view all incoming submissions, write official replies, update resolution statuses, and delete records.
- **Routing Integration**: Linked "تقديم شكوى / مقترح" on the homepage services grid to `?p=complaints` and registered complaints in public page and title lists inside `index.php`.

### 56. Dashboard Routing for Registered Users on Complaints Portal
- **Dashboard Fallthrough Fix**: Added routing logic inside the logged-in dashboard conditional switch in `index.php`. Now, when a registered student, admin, or staff member visits `?p=complaints`, the page displays the full complaints portal form and tracking box inside the authenticated panel template instead of rendering an empty container.

### 57. Public Website Layout Registration for Guest Complaints Portal
- **Layout Registration Fix**: Added `'complaints'` to the `$layout_pages` array in `index.php`. This registers the complaints page in the global public layout, ensuring that guest users (who are not logged in) see the page rendered inside the college website wrapper (with header, footer, styling, and navigation links) instead of receiving a blank page.
window.print();
### 58. Admin Dashboard Shortcuts & Real-Time Submission Indicators
- **Dashboard Metrics Integration**: Embedded two new stats blocks in the main Admin Dashboard screen: "إجمالي الشكاوى" (Total Complaints count) and "شكاوى جديدة" (Pending Complaints count) to give the admin immediate awareness of submission queues.
- **Teal Alert & Shortcut Badge**: Built a customized quick action button on the main Admin Dashboard wrapping the complaints target with a dynamic red notification badge displaying the number of unread submissions.

### 59. Interactive Events & Activities Portal with Administrative CMS
- **Database Schema**: Added auto-creation of the `events` table in `db_connect.php` to store details (title, description, category, event_date, location, image_path).
- **Default Seed Data**: Programmed automatic seeding of three premium default events (Freshmen Welcome Ceremony, AI Programming Workshop, and Sports Futsal Tournament) in `db_connect.php` if the table is empty.
- **Category Filter Page**: Created [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php) rendering a premium events grid with dynamic category filter options (حفلات ومناسبات، ورش عمل، أنشطة رياضية، علمية وثقافية، أخرى) and inline SVG markers.
- **Details Modal Viewer**: Integrated a modal detail viewer in JavaScript that displays the full event description, location, date, and image in a premium popup container upon clicking a card.
- **Admin CMS Controls**: Built a fifth tab ` الفعاليات والأنشطة` in [admin_manage_content.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_content.php) allowing administrators to add new events, modify existing ones with real-time field loading, and delete records.
- **Routing Integration**: Linked "فعاليات وأنشطة" on the homepage quick boxes to `?p=events` and registered the page in allowed lists, public layout arrays, and page titles inside `index.php`.

### 60. Multi-Media Gallery Carousel & HTML5 Video Player inside Events
- **Interactive Multi-Media Modal**: Re-coded the events details modal in [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php). It now features a live main viewer display alongside a row of clickable thumbnail previews for up to 3 gallery images and a video.
- **YouTube & HTML5 Video Support**: Added smart URL parsing in the details viewer. Clicked video thumbnails render YouTube `<iframe>` frames (with autoplay) or standard HTML5 video controls for direct paths, automatically stopping playback when the modal is closed.
- **Extended Admin CMS Fields**: Updated the event editor form in [admin_manage_content.php](file:///c:/xampp1/htdocs/Sama_College/pages/admin_manage_content.php) with additional inputs for second and third gallery images (`image2_path`, `image3_path`) and video links (`video_path`).
- **Database CRUD Alignment**: Adjusted SQL update and insert queries to handle the three images and video URLs in CP1256 encoding to preserve Arabic text formatting.
    transform:translateX(-5px);
    transform:translateX(-5px);
.hover-text{
    font-size:14px;
    font-size:14px;
    transition:0.3s;
    transition:0.3s;
.box:hover .hover-text, .quick:hover .hover-text{
.box:hover .hover-text, .quick:hover .hover-text{
    opacity:1;
.box:hover .service-icon {
### 63. Instagram Share Action and Navigation Return Breadcrumb box
- **Instagram Action Separation**: Separated the sharing block inside [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php) details modal. The Instagram share button now uses its official branding colors (`#e1306c`) and SVG icon to trigger link copying, distinct from the generic "Copy Link" button.
- **Top Return breadcrumb Navigation**: Embedded a premium return container box at the top of the events grid. It features breadcrumb indicators ("الصفحة الرئيسية / الفعاليات والأنشطة") and quick actions for "العودة للرئيسية" (Return to main site) and "كل الفعاليات" (All events reset).
    padding:50px 20px;
### 64. Modal Footer Homepage Return button Integration
- **Modal Footer Redirect Action**: Positioned the return button directly in the modal details footer in [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php). Added a teal button next to the default dark blue "إغلاق النافذة" button that links directly back to the homepage (`index.php`).
- **Clean Sizing Layout**: Removed the top breadcrumbs return bar from the top of the public grid interface to ensure layout cleanliness according to user preference.
    padding:50px 20px;
### 65. Bottom Page Homepage Return Button
- **Bottom Return Box**: Inserted a prominent, pill-shaped return button ("العودة للصفحة الرئيسية") at the bottom of [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php), directly below the cards grid and above the website footer.
- **Micro-Animations & Styling**: Styled the bottom return button using the primary dark blue color scheme (`#0f3460`) with smooth teal (`#008080`) hover color shifts, upward translation slides, and shadow glows.
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
### 66. Image Sizing Resolution & Modal Button Hover Micro-animations
- **Original Sizing Containment**: Fixed the active media viewer's dynamic images inside [events.php](file:///c:/xampp1/htdocs/Sama_College/pages/events.php) modal to `max-width: 100%; max-height: 100%; width: auto; height: auto` to prevent distortion, stretching, or pixelation, keeping logos and photography 100% complete and sharp.
- **Elevation and Color Hover Transitions**: Implemented dedicated CSS classes (`modal-btn-primary` and `modal-btn-secondary`) for the modal footer buttons, adding a smooth `300ms` translate slide (`translateY(-3px)`), shadow projection shifts, and color transformations on hover.
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
### 67. Public Announcements Page Integration (announcements_public)
- **Route Registering**: Added route handling in the main router block of [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to bind the visitor query `?p=announcements_public` to include the new file.
- **Interface Creation**: Created the new file [announcements_public.php](file:///c:/xampp1/htdocs/Sama_College/pages/announcements_public.php) styled in clean Cairo font containing:
  - Mega-banner header displaying megaphone icons.
  - A dynamic, client-side, instant query filter search bar.
  - Database-driven announcements cards feed pulling from the SQL `announcements` table.
  - Interactive details modal showing the full announcement content, a full social media share bar (Facebook, Twitter/X, WhatsApp, Telegram, Instagram link copy, Copy Link), and success toast alert triggers.
  - A large homepage return navigation button at the bottom of the page layout.
.quick:hover .quick-icon {
- **Dashboard Inclusion Handling**: Added page routing inside the logged-in dashboard block of [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (around line 2980) so that students, staff, and administrators can access and view the public announcements page while logged into their accounts.
- **Dashboard Inclusion Handling**: Added page routing inside the logged-in dashboard block of [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (around line 2980) so that students, staff, and administrators can access and view the public announcements page while logged into their accounts.
### 69. Theme Layout Wrapping for Public Announcements
- **Layout Pages List Alignment**: Registered the `'announcements_public'` page parameter key within the `$layout_pages` array in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (line 740).
- **Blank View Resolution**: This enables the page to be fully wrapped inside the site's default template wrapper (including header logo banner, navigation menu, page margins, and main styling context) for guest/public visits instead of rendering a blank view.
.majors{
### 70. Multi-Media Support & Image Download Action for Announcements
- **Database Schema Migration**: Added columns `image_path`, `image2_path`, `image3_path`, and `video_path` to the SQL `announcements` database table and seeded initial announcements with mock files.
- **Admin CMS Panel Update**: Expanded the admin/staff announcements insertion form in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to support file uploads (for 3 images) and direct URL input paths for images and video, with automatic target directory creation and upload handler.
- **Public Page Media Gallery**: Upgraded [announcements_public.php](file:///c:/xampp1/htdocs/Sama_College/pages/announcements_public.php) details modal to include a thumbnail-based gallery list (supporting image/video types) and styled active media viewer.
- **Download Active Image Button**: Added a dedicated, glassmorphism-style "حفظ الصورة" (Save/Download Image) button superimposed on the active image viewer, enabling users to download the displayed media file directly to their devices.
    color:var(--main-color);
    color:var(--main-color);
    margin-bottom:40px;
.major-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
.major-box{
### 73. Landing Page Quick Link Descriptions Optimization
- **Events & Activities Description**: Replaced the specific event description with a comprehensive, professional summary inviting visitors to discover ongoing cultural, scientific, and training programs at the college.
- **Important Announcements Description**: Updated the text to introduce administrative announcements, deanship decisions, and registration guidelines to better describe the destination page.
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
### 74. Hover Text Interaction for Home page Quick link cards (.quick)
- **HTML Structure Update**: Wrapped the descriptive text of both "فعاليات وأنشطة" and "إعلان هام" inside `<p class="hover-text">` tags in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (line 1048).
- **CSS Styling integration**: Added rules so that the descriptions remain hidden initially (with `opacity: 0` and smooth `300ms` transitions) and reveal themselves fully (`opacity: 1`) only when the visitor hovers their cursor over the card.
    color:black;
### 75. Official Icons Integration for Services Cards (index.php)
- **Official Icons Placement**: Integrated professional and official FontAwesome icons into all 5 services grid cards inside [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (line 1038):
  - **التسجيل (Online)**: A pen-to-square document icon (`fa-pen-to-square`) in custom teal.
  - **التقويم الجامعي**: A calendar days icon (`fa-calendar-days`) in dark blue.
  - **البوابة الإلكترونية**: A graduation cap academic icon (`fa-graduation-cap`) in teal.
  - **نتائج الامتحانات**: A report card invoice icon (`fa-file-invoice`) in dark blue.
  - **تقديم شكوى / مقترح**: A comment dots feedback icon (`fa-comment-dots`) in teal.
    // فتح نافذة الطباعة باسم ملف مهيأ لحفظه كـ PDF تلقائياً باسم معبر
### 76. Offline-Friendly Inline SVG Icons Integration (index.php)
- **CORS & Offline Immunity**: Swapped FontAwesome icon nodes inside services boxes for inline vector SVG icons (Feather Icon set) to ensure 100% offline functionality and zero dependency on external CDN resources.
- **Dynamic Color Hover Transitions**: Applied the `service-icon` class to all SVGs and added CSS hover rules in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (line 459) to transition the icon stroke color dynamically to pure white (`#fff`) when cards are hovered.
    color:white;
### 77. Inline SVG Icons Integration for Quick Link Cards (.quick)
- **Official Icons Placement**: Integrated offline-friendly, high-contrast inline vector SVG icons into the headers of both quick link cards inside [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) (line 1053):
  - **فعاليات وأنشطة**: An academic ribbon medal/award icon in dark blue.
  - **إعلان هام**: A ringing notification bell icon in custom teal.
- **Hover Color Transitions**: Integrated CSS rules (`.quick:hover .quick-icon`) so that the icons dynamically transition to a pure white stroke color when a visitor hovers their cursor over the card.
}
### 78. Landing Page Split-Screen Quick Registration Section ("سجل معنا")
- **Layout and Graphics**: Implemented a responsive split-screen section directly below the two quick link boxes in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php).
  - Left column displays a beautiful, custom-generated background image of a registration application desk (`images/registration_bg.jpg`) with a dark, high-contrast overlay.
  - Right column contains an elegant, white floating registration card titled "سجل معنا".
- **Interactive Form and validation**:
  - Form fields include: Full Name, Email, Phone, Major dropdown selection (pre-filled with IT, Accounting, Business, Architecture, Midwifery, Medical Assistant, and Pharmacy), and a Captcha security code input.
  - Included a dynamic 6-digit Captcha generation system with a rotation refresh button.
  - Implemented an elegant, programmatically generated success overlay modal with checkmark animations and custom feedback messages.
    overflow:hidden;
### 79. Visual Match of Quick Registration Form to Screenshot Design
- **Clean Background Image Side**: Removed all text overlays and titles from the left side of the split section (`.register-bg-side` in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php)) to make it display purely the background image `images/registration_bg.jpg`.
- **Underline Input Fields**: Refactored the form layout to use input elements with bottom borders only, removing labels and relying on styled placeholders to match the screenshot exactly.
- **RTL Select Arrow overlay**: Added a grey dropdown down-arrow (`▼`) positioned absolutely on the left of the choose major field.
- **Inline Captcha Verification**: Placed the captcha number generator box inline next to the text input line.
- **Right-Aligned Submit Button**: Updated the submit button container to float the "ارسال" button to the right side of the card with custom sizing.
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
### 80. Customized College Registration Sheet Background Graphic
- **Programmatic Customization**: Wrote a Python image processing script using Pillow to compile a high-fidelity college registration paper layout directly onto `images/registration_bg.jpg`.
- **Branding Assets Overlaid**: Embedded the official Sama College logo (`logo.png`), institution name ("كلية سماء المتميزين"), and official form title ("استمارة طلب تسجيل") at the top center of a white paper template complete with realistic fields ("اسم الطالب الرباعي", "التخصص المطلوب", "رقم الهاتف المحمول", etc.) and custom drop shadows.
.news-card:hover{
### 81. Browser Cache-Busting for Background Image URL
- **Immediate Visual Update**: Added a version query string parameter (`?v=1.2`) to the background image reference URL within `.register-bg-side` in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to force client browsers to bypass cached images and load the newly compiled custom registration template instantly.
    color:white;
### 82. Restoration of Original Photographic Registration Background Image
- **Background Restored**: Reverted `images/registration_bg.jpg` to the original high-quality photographic image showing the registration form on a desk.
- **Cache-Busting updated**: Incremented the version parameter to `?v=1.3` to trigger browser refresh.
    top:50%;
### 83. Floating Quick Registration Card Overlaid on Full-Width Background
- **Full-Width Background Image**: Configured `.register-container` in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to display the background image (`images/registration_bg.jpg`) across its full width instead of split columns.
- **Floating Overlaid Form Card**: Removed the left background-side column from the HTML. Placed the white registration form card (`.register-form-card`) directly inside the full-width background container, styling it with absolute padding, a neat drop shadow, and floating corners so it sits elegantly "on top" of the background image on the right.
    border:none;
### 84. Vector Inline SVG Icons in Registration Input Underline Lines
- **Unified Input Wrapper**: Integrated `.reg-input-wrapper` containers surrounding both the inline vector SVG icons and the text inputs in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php).
- **RTL Icon Placement and Styling**: Added 5 high-contrast, offline-friendly inline SVG icons: User icon for Name, Mail/Envelope for Email, Smartphone/Device for Phone, Graduation Cap for Major, and Key/Lock for Captcha.
- **Active Focus Color Transitions**: Configured CSS focus selectors (`.reg-input-wrapper:focus-within`) to transition the entire underline and the corresponding inline SVG icon stroke color dynamically to maroon/crimson (`#7d0f3f`) when a field is focused.
    z-index:10;
### 85. News Carousel Migration and Layout Upgrade
- **Homepage Cleanup**: Completely removed the news carousel section HTML block from [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php).
- **Premium Latest News Section in news.php**: Integrated a dynamic, image-based "Latest News" section at the bottom of the news details view in [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php).
  - Displays a clean row of 3 latest news cards dynamically populated from the `$news_items` array.
  - Each card contains the main image, date, and title with a custom maroon horizontal dash (`―`).
  - Added a "View All" (عرض الكل) button on the bottom left (aligned via flex-end in RTL) linking to the news list view.
    margin:auto;
### 86. Homepage News Section Integration below Majors Section
- **Shared News Data File**: Created [news_data.php](file:///c:/xampp1/htdocs/Sama_College/pages/news_data.php) containing the `$news_items` array, and included it at the top of both [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) and [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php).
- **Homepage News Grid**: Rendered the premium image-based "Latest News" section directly below the "Available Majors" (`majors`) section on the homepage in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php).
  - Dynamically extracts and loops through the 3 latest news items.
  - Implemented the identical visual layout (square image, date, bold title with maroon dash, and "View All" bottom-left maroon button) as in the details view.
.calendar h2{
### 87. Visual Alignment of Homepage News Cards with News Page Design
- **Global CSS Availability**: Moved the news list page CSS card rules (`.news-page-card`, `.news-card-content`, `.read-more-link`, etc.) to the global header style block of [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php).
- **Exact Layout Replication**: Updated the homepage Latest News section below the majors section to use the identical HTML structure as the news page listing:
  - Header: `" أخبار وفعاليات الكلية"` with a yellow bottom border and subtitle.
  - Cards: displays image/gradient fallbacks, yellow date/badge, summary paragraphs, and `"المزيد ←"` read more link.
- **Database Schema**: Created a `news` table in the database and pre-populated it with the 6 default news articles to ensure backward data compatibility.
- **Dynamic News Retrieval**: Rewrote [news_data.php](file:///c:/xampp1/htdocs/Sama_College/pages/news_data.php) to query the database table dynamically and build the `$news_items` array in real-time.
- **Admin Management Panel**: Created a new admin dashboard page [manage_news.php](file:///c:/xampp1/htdocs/Sama_College/admin/manage_news.php) allowing college staff to post new news articles (with image uploads, customized badges, fallback icons, and gradients) and delete existing entries.
- **Navbar Links Propagation**: Updated all admin dashboard files in `admin/` to include the "إدارة الأخبار" link in their navigation header.
    flex-wrap:wrap;
}
.filters label{
    font-weight:bold;
    font-size:16px;
- **Functional Consistency**: Confirmed that the homepage Latest News cards still retrieve and display the static news array items using the visually identical design of the news page.
.filters select{
### 90. Update News Section Title to 'أخبار الكلية
- **Header Text Updates**: Changed the section header title from `"أخبار وفعاليات الكلية"` to `"أخبار الكلية"` and corrected subtitles in both the homepage [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) and the news listing [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php).
    border:1px solid #ccc;
### 91. Remove Bottom News Slider from News Details View
- **Details View Cleanup**: Completely removed the bottom `"آخر الأخبار"` news slider container block from [news.php](file:///c:/xampp1/htdocs/Sama_College/pages/news.php) when viewing a single news article, ensuring the reader is focused entirely on the content of the article itself.

### 92. Decouple Latest News Section to a Dedicated Page
- **Independent Dataset**: Created [latest_news_data.php](file:///c:/xampp1/htdocs/Sama_College/pages/latest_news_data.php) to serve as a separate, self-contained data source for the Latest News section.
- **Dedicated Subpage**: Created [latest_news.php](file:///c:/xampp1/htdocs/Sama_College/pages/latest_news.php) and registered the route `'latest_news'` in [index.php](file:///c:/xampp1/htdocs/Sama_College/index.php) to render the Latest News listing and detail views completely independent of the main news page.
- **Homepage Integration**: Updated the homepage news section title to `"آخر الأخبار"`, changed the news cards loop to load from `$latest_news_items`, and redirected all card links and the "View All" button to `?p=latest_news`.
























// MISSING LINE 631
// MISSING LINE 632
// MISSING LINE 633
// MISSING LINE 634
// MISSING LINE 635
// MISSING LINE 636
// MISSING LINE 637
// MISSING LINE 638
// MISSING LINE 639
// MISSING LINE 640
// MISSING LINE 641
// MISSING LINE 642
// MISSING LINE 643
// MISSING LINE 644
// MISSING LINE 645
// MISSING LINE 646
// MISSING LINE 647
// MISSING LINE 648
// MISSING LINE 649
// MISSING LINE 650
// MISSING LINE 651
// MISSING LINE 652
// MISSING LINE 653
// MISSING LINE 654
// MISSING LINE 655
// MISSING LINE 656
// MISSING LINE 657
// MISSING LINE 658
// MISSING LINE 659
// MISSING LINE 660
// MISSING LINE 661
// MISSING LINE 662
// MISSING LINE 663
// MISSING LINE 664
// MISSING LINE 665
// MISSING LINE 666
// MISSING LINE 667
// MISSING LINE 668
// MISSING LINE 669
// MISSING LINE 670
// MISSING LINE 671
// MISSING LINE 672
// MISSING LINE 673
// MISSING LINE 674
// MISSING LINE 675
// MISSING LINE 676
// MISSING LINE 677
// MISSING LINE 678
// MISSING LINE 679
    bottom:20px;
    left:20px;
    display:none;
    padding:10px 15px;
    background:var(--main-color);
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
@media(max-width:600px){
    .slider{
        flex-direction:column;
        padding:30px 15px;
    }
    .slider-img-wrap{
        width:100%;
        max-width:100%;
        height:360px;
    }
    .slider-content{
        width:100%;
        max-width:100%;
        text-align:center;
    }
    .slider-content h2{
        font-size:22px;
    }
    .quick-boxes{
        flex-direction:column;
        align-items:center;
    }
    .quick{
        width:90%;
    }
    .filters{
        flex-direction:column;
        align-items:center;
    }
    .filters select{
        min-width:auto;
    }
    .news-container{
        flex-direction:column;
    background-color: #0f3460 !important;
    color: white !important;
    transform: translateY(-4px);
    box-shadow: 0 4px 10px rgba(15, 52, 96, 0.2);
}
.social-box:hover {
    background-color: #0f3460 !important;
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    transform: translateY(-4px);
    box-shadow: 0 4px 10px rgba(15, 52, 96, 0.2);
    box-shadow: 0 4px 10px rgba(15, 52, 96, 0.2);
/* ===== قسم سجل معنا التفاعلي الجديد ===== */
/* ===== قسم سجل معنا التفاعلي الجديد ===== */
<span class="dot active" onclick="currentSlide(0)"></span>
// ============================================================
// الصفحة الرئيسية (لزوار)
    justify-content: center;
    'home', 'about', 'president', 'vision', 'goals', 'strategy',
    'news', 'students', 'research', 'library', 'jobs', 'contact', 'enroll', 'schedule', 'portal', 'grades', 'complaints', 'events',
    font-family: 'Cairo', sans-serif;
    'major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife',
<p>تقديم وتطوير البرامج التعليمية والأنشطة البحثية والخدمات التدريبية والاستشارية في مختلف المجالات</p>
    'quality', 'planning', 'students_affairs', 'finance', 'it',
    <a href="?p=enroll" class="box"><div class="arrow">➜</div><h3>التسجيل (Online)</h3><p class="hover-text">اختر تخصصك، أكتب بياناتك، وقدم طلب التحاقك</p></a>
    <a href="?p=schedule" class="box"><div class="arrow">➜</div><h3>التقويم الجامعي</h3><p class="hover-text">التقويم الجامعي للعام الدراسي 2026</p></a>
    <a href="?p=login" class="box"><div class="arrow">➜</div><h3>البوابة الإلكترونية</h3><p class="hover-text">بوابة الطالب الإلكترونية للكلية</p></a>
    <a href="#" class="box"><div class="arrow">➜</div><h3>تقديم شكوى / مقترح</h3><p class="hover-text">شاركنا آراءك ومقترحاتك</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
if (in_array($page, $layout_pages) && !$is_logged_in && $page != 'enroll'):
    background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.15) 100%), url('images/registration_bg.jpg?v=1.3');
    background-size: cover;
<!-- ===== المربعين ===== -->
    <div style="display: inline-flex; align-items: center; justify-content: center; width: 140px; height: 140px; border-radius: 12px; background: white; padding: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin-bottom: 15px; border: 3px solid #ffd700; overflow: hidden;">
        <img src="logo.png?v=4" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="شعار الكلية">
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
    <p>نحو مستقبل علمي مشرق</p>
    background-position: center center;
    position: relative;
<!-- ===== شريط التنقل العلوي مع ترتيب مناسب ===== -->
<nav style="background:var(--dark-color);padding:0;">
    justify-content: center;
    color: white;
    position: relative;
    padding: 40px 35px;
    background: white;
    border-radius: 12px;
.register-form-card {
    font-weight: 800;
    margin-bottom: 15px;
<button onclick="window.print()" class="export-action-btn">
    text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    justify-content: center;
    background: white;
    box-sizing: border-box;
    font-size: 16px;
    line-height: 1.8;
    color: rgba(255,255,255,0.9);
    color: #7d0f3f; /* لون عنابي رسمي جميل مطبق في الموقع */
    font-size: 24px;
    font-weight: 800;
    margin: 0 0 8px 0;
    text-align: right;
    padding: 40px;
    display: flex;
.register-form-card p.subtitle {
    color: #b01a4e; /* لون كرزي/عنابي مناسب للنصوص الفرعية بالصورة */
    background: white;
    border-right: 1px solid #f0f0f0;
    position: relative;
    text-align: right;
.register-form-card h3 {
    color: #7d0f3f; /* لون عنابي رسمي جميل مطبق في الموقع */
.reg-form-input, .reg-form-select {
    margin-bottom: 22px;
    margin-bottom: 8px;
    border: none !important;
    border-bottom: 1.5px solid #eaeaea !important;
.register-form-card p.subtitle {
    font-family: 'Cairo', sans-serif;
    font-size: 14.5px;
    outline: none !important;
    background: transparent !important;
    border-bottom: 1.5px solid #eaeaea !important;
    box-sizing: border-box;
    font-family: 'Cairo', sans-serif;
    margin-bottom: 18px;
    text-align: right;
.reg-form-input:focus, .reg-form-select:focus {
    border-bottom-color: #7d0f3f !important;
    box-shadow: none !important;
    display: block;
    font-size: 13.5px;
    font-weight: 700;
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
.reg-form-input, .reg-form-select {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 8px;
    align-items: center;
    font-family: 'Cairo', sans-serif;
    margin-top: 5px;
    border-bottom: 1.5px solid #eaeaea;
    transition: 0.3s;
    box-sizing: border-box;
.captcha-box {
    background: #000;
.reg-form-input:focus, .reg-form-select:focus {
    border-color: #7d0f3f;
    box-shadow: 0 0 0 3px rgba(125, 15, 63, 0.1);
}

.captcha-container {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-top: 5px;
}

.captcha-box {
    background: #000;
    color: #00ff66;
    font-family: 'Courier New', Courier, monospace;
    font-size: 20px;
    font-weight: 900;
    letter-spacing: 5px;
    padding: 8px 16px;
    border-radius: 6px;
    user-select: none;
    display: inline-block;
    text-align: center;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.5);
}

.captcha-refresh-btn {
    background: none;
    border: none;
    color: #7d0f3f;
    cursor: pointer;
    font-size: 16px;
    padding: 5px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.captcha-refresh-btn:hover {
    transform: rotate(180deg) scale(1.1);
}

.reg-submit-btn {
    width: 100%;
    background: #7d0f3f;
    color: white;
    border: none;
    padding: 12px;
    border-radius: 8px;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Cairo', sans-serif;
    cursor: pointer;
    background: #0f3460;
    box-shadow: 0 4px 10px rgba(125, 15, 63, 0.2);
    box-shadow: 0 6px 15px rgba(15, 52, 96, 0.25);
.reg-submit-btn:hover {
    background: #0f3460;
/* التجاوب للهواتف والأجهزة اللوحية */
    box-shadow: 0 6px 15px rgba(15, 52, 96, 0.25);
    box-shadow: 0 6px 15px rgba(15, 52, 96, 0.3);
        flex-direction: column;
/* التجاوب للهواتف والأجهزة اللوحية */
/* التجاوب للهواتف والأجهزة اللوحية */
@media (max-width: 900px) {
        justify-content: center;
        flex-direction: column;
        min-height: auto;
    .register-form-card {
    .register-form-card {
        padding: 35px 25px;
        padding: 30px;
    }
@media (max-width: 600px) {
    .quick-register-section {
        padding: 30px 15px;
        border-right: none;
        border-top: 1px solid #f0f0f0;
</style>
}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    .quick-register-section {
        padding: 30px 15px;
    }
<body>
</style>
<?php
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
// الصفحة الرئيسية (لزوار)
$layout_pages = [
// MISSING LINE 927
// MISSING LINE 928
// MISSING LINE 929
// MISSING LINE 930
// MISSING LINE 931
// MISSING LINE 932
// MISSING LINE 933
// MISSING LINE 934
// MISSING LINE 935
// MISSING LINE 936
// MISSING LINE 937
// MISSING LINE 938
// MISSING LINE 939
// MISSING LINE 940
// MISSING LINE 941
// MISSING LINE 942
// MISSING LINE 943
// MISSING LINE 944
// MISSING LINE 945
// MISSING LINE 946
// MISSING LINE 947
// MISSING LINE 948
// MISSING LINE 949
// MISSING LINE 950
// MISSING LINE 951
// MISSING LINE 952
// MISSING LINE 953
// MISSING LINE 954
// MISSING LINE 955
// MISSING LINE 956
// MISSING LINE 957
// MISSING LINE 958
// MISSING LINE 959
<body>

<?php
// ============================================================
// الصفحة الرئيسية (لزوار)
$layout_pages = [
    'home', 'about', 'president', 'vision', 'goals', 'strategy',
    'news', 'students', 'research', 'library', 'jobs', 'contact', 'enroll', 'schedule', 'portal', 'grades', 'complaints', 'events', 'announcements_public',
    // Majors
    'major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife',
    // Admin
    'quality', 'planning', 'students_affairs', 'finance', 'it',
    // Centers
    'medical_institute', 'community_college', 'training_center', 'community_services',
    // Branches
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=medical_institute" class="dropdown-link"><span>معهد الكلية للعلوم الطبية</span><i>←</i></a>
                <a href="?p=community_college" class="dropdown-link"><span>كلية سماء المتميزين (كلية مجتمع خاصة)</span><i>←</i></a>
                <a href="?p=training_center" class="dropdown-link"><span>مركز الكلية للتدريب والتأهيل الجامعي</span><i>←</i></a>
                <a href="?p=community_services" class="dropdown-link"><span>مراكز خدمات المجتمع</span><i>←</i></a>
            </div>
        </div>

        <!-- الفروع -->
        <div style="display:inline-block;">
            <a href="#" style="color:#ffd700;text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='#ffd700';document.getElementById('dropdown-branches').style.display='flex'" 
               onmouseout="this.style.color='#ffd700';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-branches').matches(':hover')){ document.getElementById('dropdown-branches').style.display='none'; } }, 200);">
                الفروع <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-branches" class="nav-dropdown nav-dropdown-full"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=branch_damnah" class="dropdown-link"><span>فرع دمنة خدير</span><i>←</i></a>
                <a href="?p=branch_rahdah" class="dropdown-link"><span>فرع الراهدة</span><i>←</i></a>
            </div>
        </div>

    </div>
</div>
</nav>
<?php
endif;

// ============================================================
// محتوى الصفحات العامة
// ============================================================
if ($page == 'home' && !$is_logged_in):
?>

<!-- ===== السلايدر ===== -->
<section class="slider">
<button class="prev" onclick="prevSlide()">❮</button>
<button class="next" onclick="nextSlide()">❯</button>
<div class="slider-img-wrap">
    <img id="sliderImage" src="images/slider_campus.jpg?v=3" alt="مبنى كلية سماء المتميزين">
</div>
<div class="slider-content">
<h2 id="title">مؤسسة كلية سماء المتميزين</h2>
<p id="text">كلية سماء المتميزين هي مؤسسة تعليمية رائدة تسعى لبناء جيل مبدع ومتميز وتقديم برامج أكاديمية حديثة.</p>
</div>
</section>

<div class="dots">
<span class="dot active" onclick="currentSlide(0)"></span>
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
</div>
<div class="dots">
<!-- ===== قسم الخدمات ===== -->
<span class="dot" onclick="currentSlide(1)"></span>
<h2>وعطاء سماء المتميزين مستمر</h2>
</div>
<div class="services-boxes">
    <a href="?p=enroll" class="box"><div class="arrow">➜</div><h3>التسجيل (Online)</h3><p class="hover-text">اختر تخصصك، أكتب بياناتك، وقدم طلب التحاقك</p></a>
    <a href="?p=schedule" class="box"><div class="arrow">➜</div><h3>التقويم الجامعي</h3><p class="hover-text">التقويم الجامعي للعام الدراسي 2026</p></a>
    <a href="?p=login" class="box"><div class="arrow">➜</div><h3>البوابة الإلكترونية</h3><p class="hover-text">بوابة الطالب الإلكترونية للكلية</p></a>
<p>تقديم وتطوير البرامج التعليمية والأنشطة البحثية والخدمات التدريبية والاستشارية في مختلف المجالات</p>
    <a href="#" class="box"><div class="arrow">➜</div><h3>تقديم شكوى / مقترح</h3><p class="hover-text">شاركنا آراءك ومقترحاتك</p></a>
    <a href="?p=enroll" class="box"><div class="arrow">➜</div><h3>التسجيل (Online)</h3><p class="hover-text">اختر تخصصك، أكتب بياناتك، وقدم طلب التحاقك</p></a>
<p>تقديم وتطوير البرامج التعليمية والأنشطة البحثية والخدمات التدريبية والاستشارية في مختلف المجالات</p>
    <a href="?p=portal" class="box"><div class="arrow">➜</div><h3>البوابة الإلكترونية</h3><p class="hover-text">البوابة الموحدة للطلاب والكادر التعليمي</p></a>
    <a href="?p=enroll" class="box"><div class="arrow">➜</div><h3><i class="fa-solid fa-pen-to-square" style="color: #008080; margin-left: 8px;"></i>التسجيل (Online)</h3><p class="hover-text">اختر تخصصك، أكتب بياناتك، وقدم طلب التحاقك</p></a>
    <a href="?p=schedule" class="box"><div class="arrow">➜</div><h3><i class="fa-solid fa-calendar-days" style="color: #0f3460; margin-left: 8px;"></i>التقويم الجامعي</h3><p class="hover-text">التقويم الجامعي للعام الدراسي 2026</p></a>
    <a href="?p=portal" class="box"><div class="arrow">➜</div><h3><i class="fa-solid fa-graduation-cap" style="color: #008080; margin-left: 8px;"></i>البوابة الإلكترونية</h3><p class="hover-text">البوابة الموحدة للطلاب والكادر التعليمي</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3><i class="fa-solid fa-file-invoice" style="color: #0f3460; margin-left: 8px;"></i>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
    <a href="?p=schedule" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>التقويم الجامعي</h3><p class="hover-text">التقويم الجامعي للعام الدراسي 2026</p></a>
    <a href="?p=portal" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>البوابة الإلكترونية</h3><p class="hover-text">البوابة الموحدة للطلاب والكادر التعليمي</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
    <a href="?p=events" class="quick"><h3>فعاليات وأنشطة</h3><p>تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3>إعلان هام</h3><p>اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
</section>

<!-- ===== التخصصات ===== -->
<section class="quick-boxes">
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>إعلان هام</h3><p class="hover-text">اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
    <a href="?p=major_it" class="major-box"><img src="images/hero_img1.png"><div><h3>تقنية المعلومات</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_accounting" class="major-box"><img src="images/hero_img2.png"><div><h3>محاسبة</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_business" class="major-box"><img src="images/img1.jpg"><div><h3>إدارة أعمال</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_midwife" class="major-box"><img src="images/slider_vision.jpg"><div><h3>قبالة وتوليد</h3><p>للمزيد من التفاصيل</p></div></a>
<div class="major-grid">
    <a href="?p=major_it" class="major-box"><img src="images/hero_img1.png"><div><h3>تقنية المعلومات</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_accounting" class="major-box"><img src="images/hero_img2.png"><div><h3>محاسبة</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_business" class="major-box"><img src="images/img1.jpg"><div><h3>إدارة أعمال</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_midwife" class="major-box"><img src="images/slider_vision.jpg"><div><h3>قبالة وتوليد</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_assistant" class="major-box"><img src="images/news_launch.jpg"><div><h3>مساعد طبيب</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_pharmacy" class="major-box"><img src="images/project_epilepsy_1.jpg"><div><h3>صيدلة</h3><p>للمزيد من التفاصيل</p></div></a>
</div>
    <div class="news-card"><h4>تدريب على مهارات القيادة</h4><p>أقامت الكلية برنامج تدريبي لتطوير مهارات القيادة والإدارة.</p></div>
    <div class="news-card"><h4>مسابقة ابتكار طلابية</h4><p>نظمت الكلية مسابقة للابتكار العلمي بين طلبة التخصصات المختلفة.</p></div>
<!-- ===== الأخبار ===== -->
<section class="news-carousel">
<h2>آخر الأخبار</h2>
<button class="news-prev" id="newsPrev">❮</button>
<button class="news-next" id="newsNext">❯</button>
// Render subpages inside the layout if we are on one of the layout pages
    <div class="news-card"><h4>مناقشة بحث تخرج لطلبة تقنية المعلومات</h4><p>تمت مناقشة مشاريع التخرج لطلبة المستوى الرابع وسط حضور أكاديمي مميز.</p></div>
    <div class="news-card"><h4>ورشة عمل حول ريادة الأعمال</h4><p>أقامت الكلية ورشة لتعزيز مهارات الابتكار وريادة الأعمال لطلبة إدارة الأعمال.</p></div>
    <div class="news-card"><h4>إعلان نتائج الفصل الدراسي الأول</h4><p>تعلن عمادة القبول والتسجيل عن صدور النتائج عبر البوابة الإلكترونية.</p></div>
    <div class="news-card"><h4>تدريب على مهارات القيادة</h4><p>أقامت الكلية برنامج تدريبي لتطوير مهارات القيادة والإدارة.</p></div>
    <div class="news-card"><h4>مسابقة ابتكار طلابية</h4><p>نظمت الكلية مسابقة للابتكار العلمي بين طلبة التخصصات المختلفة.</p></div>
            'president' => 'عميد الكلية',
            'vision' => 'الرؤية والرسالة',
            'goals' => 'الأهداف والقيم',
            'strategy' => 'الخطة الاستراتيجية',
            'about' => 'عن الكلية',
            'president' => 'عميد الكلية',
            'research' => 'الدراسات والبحوث',
            'goals' => 'الأهداف والقيم',
            'strategy' => 'الخطة الاستراتيجية',
            'contact' => 'اتصل بنا',
            'enroll' => 'طلب الالتحاق',
            'research' => 'الدراسات والبحوث',
            'major_it' => 'تقنية معلومات',
            'major_it' => 'تقنية معلومات',
            'major_arch' => 'هندسة معمارية',
            'enroll' => 'طلب الالتحاق',
            'schedule' => 'التقويم الجامعي',
            'portal' => 'البوابة الإلكترونية',
            'grades' => 'نتائج الامتحانات',
            'major_dentist' => 'مساعد طبيب أسنان',
            'major_it' => 'تقنية معلومات',
            'major_it' => 'تقنية معلومات',
            'quality' => 'مركز التطوير وضمان الجودة',
            'planning' => 'إدارة التطوير والتخطيط الاستراتيجي',
            'students_affairs' => 'إدارة شؤون الطلاب',
            'finance' => 'إدارة الشئون المالية والإدارية',
            'it' => 'إدارة تكنولوجيا المعلومات',
            'major_assistant' => 'مساعد طبيب',
            'medical_institute' => 'معهد الكلية للعلوم الطبية',
            'community_college' => 'كلية سماء المتميزين (كلية مجتمع خاصة)',
            'training_center' => 'مركز الكلية للتدريب والتأهيل الجامعي',
            'community_services' => 'مراكز خدمات المجتمع',
            // Branches
            'branch_damnah' => 'فرع دمنة خدير',
            'branch_rahdah' => 'فرع الراهدة'
        ];
        $current_title = isset($page_titles[$page]) ? $page_titles[$page] : '';
?>
<div style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: 'Cairo', sans-serif; direction: rtl; justify-content: flex-start;">
        <a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a>
    elseif ($page == 'finance'):
        include 'pages/finance.php';
    elseif ($page == 'students'):
        include 'pages/students.php';
    elseif (in_array($page, $major_pages)):
<div style="min-height:100vh;background:#f4f6f9;padding:40px 20px;font-family:'Cairo', sans-serif;">
<h2>وعطاء سماء المتميزين مستمر</h2>
<p>تقديم وتطوير البرامج التعليمية والأنشطة البحثية والخدمات التدريبية والاستشارية في مختلف المجالات</p>
        <!-- الحاوية الأولى: اختيار التخصص والفرع (المظهر الأصلي بالكامل) -->
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>إعلان هام</h3><p class="hover-text">اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
    <a href="?p=complaints" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>تقديم شكوى / مقترح</h3><p class="hover-text">شاركنا آراءك ومقترحاتك</p></a>
                    <h2 style="margin: 0; font-size: 22px; font-weight: bold; line-height: 1.4; color: white;">كلية سماء المتميزين</h2>
                    <div style="font-size: 13px; opacity: 0.9; margin-top: 2px;">للعلوم الصحية والتكنولوجيا</div>
        <!-- الجانب الأيمن: الخلفية الإعلانية للكلية -->
<!-- ===== المربعين ===== -->
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>إعلان هام</h3><p class="hover-text">اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
            <h3>سجل معنا</h3>
            <p class="subtitle">ارسل بياناتك والتخصص الذي ترغب به</p>
<!-- ===== قسم سجل معنا التفاعلي الجديد ===== -->
        var clickedInside = e.target.closest('[onclick="toggleBannerMenu()"]') || e.target.closest('#bannerDropdownMenu');
        <!-- الجانب الأيسر: كرت التسجيل الفوري -->
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#0f3460" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>إعلان هام</h3><p class="hover-text">اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
            <h2>كلية سماء المتميزين العلوم الطبية والتقنية</h2>
            <p>انضم إلينا اليوم وابدأ رحلتك الأكاديمية نحو التميز المهني. نوفر لك أفضل الكوادر التعليمية والمعامل الحديثة المجهزة بأعلى التقنيات العالمية في تخصصات التقنية ومساعد الطبيب والصيدلة والقبالة والتوليد.</p>
                <!-- البريد الإلكتروني -->
                <!-- الاسم بالكامل -->
                    <input type="email" id="reg-email" class="reg-form-input" placeholder="البريد الإلكتروني" required>
                    <input type="text" id="reg-name" class="reg-form-input" placeholder="الاسم بالكامل" required>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">يقدم هذا المركز خدمات تدريبية وتعليمية واستشارية متخصصة لرفع كفاءة المجتمع المحلي وتلبية احتياجات التنمية المستدامة من خلال <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نوفر بيئة تدريبية مجهزة بأحدث التقنيات وبإشراف نخبة من الخبراء والأكاديميين المتخصصين.</p>
    <a href="?p=major_business" class="major-box"><img src="images/img1.jpg"><div><h3>إدارة أعمال</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_midwife" class="major-box"><img src="images/slider_vision.jpg"><div><h3>قبالة وتوليد</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_assistant" class="major-box"><img src="images/news_launch.jpg"><div><h3>مساعد طبيب</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_pharmacy" class="major-box"><img src="images/project_epilepsy_1.jpg"><div><h3>صيدلة</h3><p>للمزيد من التفاصيل</p></div></a>
                    <input type="text" id="reg-name" class="reg-form-input" placeholder="أدخل اسمك الرباعي" required>
                    <select id="reg-major" class="reg-form-select" required>
                    <input type="tel" id="reg-phone" class="reg-form-input" placeholder="التلفون" required>
                        <option value="تقنية المعلومات">تقنية المعلومات (IT)</option>
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 15px;">القسم :</label>
                        <select id="collegeSelect" name="college" required disabled style="width: 100%; padding: 14px 20px; border: 1.5px solid #7d0f3f; border-radius: 30px; font-size: 15px; font-family: 'Cairo', sans-serif; background: #eee; cursor: not-allowed; transition: all 0.3s; box-sizing: border-box;" onchange="updateDepartments(); validateStep1();">
                        <option value="هندسة معمارية">هندسة معمارية</option>
                        <option value="قبالة وتوليد">قبالة وتوليد</option>
                        <option value="مساعد طبيب">مساعد طبيب</option>
                        <option value="تقنية المعلومات">تقنية المعلومات (IT)</option>
        <h1 style="color:#0f3460;border-bottom:3px solid #ffd700;padding-bottom:15px;"> <?php echo $current_title; ?></h1>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">يقدم هذا المركز خدمات تدريبية وتعليمية واستشارية متخصصة لرفع كفاءة المجتمع المحلي وتلبية احتياجات التنمية المستدامة من خلال <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نوفر بيئة تدريبية مجهزة بأحدث التقنيات وبإشراف نخبة من الخبراء والأكاديميين المتخصصين.</p>
                        <select id="departmentSelect" name="department" required disabled style="width: 100%; padding: 14px 20px; border: 1.5px solid #7d0f3f; border-radius: 30px; font-size: 15px; font-family: 'Cairo', sans-serif; background: #eee; cursor: not-allowed; transition: all 0.3s; box-sizing: border-box;" onchange="validateStep1()">
                        <option value="مساعد طبيب">مساعد طبيب</option>
            <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; text-align: center;">
                <a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a>
                    <label for="reg-major">اختر التخصص <span style="color:#e53e3e;">*</span></label>
                    <!-- زر التالي -->
                        <option value="" disabled selected>-- اختر التخصص المطلوب --</option>
                        <button type="button" id="nextBtn" disabled onclick="goToStep(2)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">يقدم هذا المركز خدمات تدريبية وتعليمية واستشارية متخصصة لرفع كفاءة المجتمع المحلي وتلبية احتياجات التنمية المستدامة من خلال <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نوفر بيئة تدريبية مجهزة بأحدث التقنيات وبإشراف نخبة من الخبراء والأكاديميين المتخصصين.</p>
                <div style="text-align:center;margin-top:25px;"><a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a></div>
            <!-- البنر العلوي الفاخر الأصلي للكلية -->
            <div style="background: linear-gradient(135deg, #7d0f3f, #0f3460); color: white; padding: 25px 25px; position: relative; display: flex; align-items: center; justify-content: space-between; border-bottom: 5px solid #ffd700; direction: rtl;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
        <!-- الحاوية الثانية: معالج خطوات البيانات الشخصية والتعليمية والهوية (مظهر الاستمارة الرسمية) -->
        <div id="enrollWizardContainer" style="max-width:850px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);overflow:hidden;border: 1px solid #e2e8f0; padding: 30px; display: none;">
                        <input type="text" id="reg-captcha" class="reg-form-input" style="border:none; outline:none; font-size:15px; text-align:right; flex-grow:1; margin-right:15px;" placeholder="كود التحقق" required>
            <!-- البنر التعليمي العنابي الموضح بالصورة -->
            <div style="background: #7c1212; color: white; padding: 20px 15px; border-radius: 12px; font-weight: bold; font-size: 16px; text-align: center; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(124, 18, 18, 0.15); line-height: 1.6; direction: rtl;">
                قم بتعبئة كافة البيانات المطلوبة كما ورد بالنص في إستمارة الثانوية العامة
        <div id="enrollStep1Container" style="max-width:650px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.1);overflow:hidden;border: 1px solid #e2e8f0; display: block;">
            <!-- البنر العلوي الفاخر الأصلي للكلية -->
            <!-- الوعاء الداخلي الفاتح ذو الزوايا المستديرة والإطار الخفيف المماثل للصورة -->
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">تختص هذه الإدارة بالإشراف على سير العملية التعليمية والإدارية وتقديم أفضل الخدمات لطلبة الكلية ومنتسبيها في إطار <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نسعى جاهدين للتطوير المستمر وتطبيق معايير الجودة والشفافية لتحقيق التميز المؤسسي والأكاديمي.</p>
        <a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a>
                    <div style="font-size: 13px; opacity: 0.9; margin-top: 2px;">للعلوم الصحية والتكنولوجيا</div>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="reg-email" class="reg-form-input" placeholder="البريد الإلكتروني" required>
            <!-- الوعاء الداخلي الفاتح ذو الزوايا المستديرة والإطار الخفيف المماثل للصورة -->
            <div style="border: 1.5px solid #e5e7eb; border-radius: 20px; padding: 30px; background: #fafafa; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
                <h3 style="color: #7c1212; text-align: right; margin-top: 0; margin-bottom: 25px; font-weight: bold; font-size: 18px; direction: rtl;"> البيانات الشخصية</h3>
        <!-- الحاوية الثانية: معالج خطوات البيانات الشخصية والتعليمية والهوية (مظهر الاستمارة الرسمية) -->
                    <div style="width: 85px; height: 85px; border-radius: 50%; background: white; padding: 6px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 2.5px solid #ffd700;">
                <h3 id="wizardStepTitle" style="color: #7c1212; text-align: right; margin-top: 0; margin-bottom: 25px; font-weight: bold; font-size: 18px; direction: rtl;">البيانات الشخصية</h3>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
            <div style="background: #751214; color: white; padding: 22px 15px; border-radius: 12px; font-weight: bold; font-size: 16px; text-align: center; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(117, 18, 20, 0.15); line-height: 1.6; direction: rtl;">
                قم بتعبئة كافة البيانات المطلوبة كما ورد بالنص في إستمارة الثانوية العامة
                <h3 style="color: #7c1212; text-align: right; margin-top: 0; margin-bottom: 25px; font-weight: bold; font-size: 18px; direction: rtl;"> البيانات الشخصية</h3>
                <!-- صف 1: الاسم العربي والاسم الإنجليزي -->
            <!-- مؤشر تبويبات الاستمارة العلوي (مظهر تفاعلي للون فقط ولا ينتقل عند النقر) -->
    <a href="?p=major_it" class="major-box"><img src="images/hero_img1.png"><div><h3>تقنية المعلومات</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_accounting" class="major-box"><img src="images/hero_img2.png"><div><h3>محاسبة</h3><p>للمزيد من التفاصيل</p></div></a>
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep2()">
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep2()">
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">تختص هذه الإدارة بالإشراف على سير العملية التعليمية والإدارية وتقديم أفضل الخدمات لطلبة الكلية ومنتسبيها في إطار <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">يقدم هذا المركز خدمات تدريبية وتعليمية واستشارية متخصصة لرفع كفاءة المجتمع المحلي وتلبية احتياجات التنمية المستدامة من خلال <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نوفر بيئة تدريبية مجهزة بأحدث التقنيات وبإشراف نخبة من الخبراء والأكاديميين المتخصصين.</p>
                        <input type="text" id="englishName" name="english_name" required placeholder="الأسم باللغة الإنجليزية ......" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep2()">
                            <option value="المركز الرئيسي - دمنة خدير">المركز الرئيسي - دمنة خدير</option>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
                <h3 id="wizardStepTitle" style="color: #7d6b6b; text-align: right; margin-top: 0; margin-bottom: 30px; font-weight: bold; font-size: 22px; direction: rtl; text-shadow: 0 1px 1px rgba(0,0,0,0.05);">البيانات الشخصية</h3>
    <a href="?p=major_assistant" class="major-box"><img src="images/news_launch.jpg"><div><h3>مساعد طبيب</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_pharmacy" class="major-box"><img src="images/project_epilepsy_1.jpg"><div><h3>صيدلة</h3><p>للمزيد من التفاصيل</p></div></a>
    <!-- مودال النجاح بعد التسجيل (موضوع خارج حاويات الخطوات لضمان ظهوره دائماً) -->
    <div id="successModal" style="display: none; position: fixed; z-index: 99999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
    <div class="news-card"><h4>مناقشة بحث تخرج لطلبة تقنية المعلومات</h4><p>تمت مناقشة مشاريع التخرج لطلبة المستوى الرابع وسط حضور أكاديمي مميز.</p></div>
    <div class="news-card"><h4>ورشة عمل حول ريادة الأعمال</h4><p>أقامت الكلية ورشة لتعزيز مهارات الابتكار وريادة الأعمال لطلبة إدارة الأعمال.</p></div>
    <div class="news-card"><h4>إعلان نتائج الفصل الدراسي الأول</h4><p>تعلن عمادة القبول والتسجيل عن صدور النتائج عبر البوابة الإلكترونية.</p></div>
    <div class="news-card"><h4>تدريب على مهارات القيادة</h4><p>أقامت الكلية برنامج تدريبي لتطوير مهارات القيادة والإدارة.</p></div>
    <div class="news-card"><h4>مسابقة ابتكار طلابية</h4><p>نظمت الكلية مسابقة للابتكار العلمي بين طلبة التخصصات المختلفة.</p></div>
            <!-- الوعاء الداخلي الفاتح ذو الزوايا المستديرة والإطار الخفيف المماثل للصورة -->
    <div class="news-card"><h4>مناقشة بحث تخرج لطلبة تقنية المعلومات</h4><p>تمت مناقشة مشاريع التخرج لطلبة المستوى الرابع وسط حضور أكاديمي مميز.</p></div>
    <div class="news-card"><h4>ورشة عمل حول ريادة الأعمال</h4><p>أقامت الكلية ورشة لتعزيز مهارات الابتكار وريادة الأعمال لطلبة إدارة الأعمال.</p></div>
    <div class="news-card"><h4>إعلان نتائج الفصل الدراسي الأول</h4><p>تعلن عمادة القبول والتسجيل عن صدور النتائج عبر البوابة الإلكترونية.</p></div>
    <div class="news-card"><h4>تدريب على مهارات القيادة</h4><p>أقامت الكلية برنامج تدريبي لتطوير مهارات القيادة والإدارة.</p></div>
    <div class="news-card"><h4>مسابقة ابتكار طلابية</h4><p>نظمت الكلية مسابقة للابتكار العلمي بين طلبة التخصصات المختلفة.</p></div>
                        <select id="nationality" name="nationality" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep2()">
            <!-- الخطوة الثانية: البيانات الشخصية -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl; align-items: center;">
                <h3 id="wizardStepTitle" style="color: #7d6b6b; text-align: right; margin-top: 0; margin-bottom: 30px; font-weight: bold; font-size: 22px; direction: rtl; text-shadow: 0 1px 1px rgba(0,0,0,0.05);">البيانات الشخصية</h3>
                        <button type="button" id="nextBtn" disabled onclick="goToStep(2)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
            <!-- الخطوة الثانية: البيانات الشخصية -->
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; color: #4a4a4a; font-weight: bold;">
                <div style="text-align:center;margin-top:25px;"><a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a></div>
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
                        <span id="fullNameError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب كتابة الاسم الرباعي كاملاً باللغة العربية</span>
                    <div style="text-align: right;">
        <!-- الحاوية الثانية: معالج خطوات البيانات الشخصية والتعليمية والهوية (مظهر الاستمارة الرسمية) -->
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
                        <input type="text" id="englishName" name="english_name" required placeholder="الأسم باللغة الإنجليزية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
            <!-- البنر التعليمي العنابي الموضح بالصورة -->
            <div style="background: #751214; color: white; padding: 22px 15px; border-radius: 12px; font-weight: bold; font-size: 16px; text-align: center; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(117, 18, 20, 0.15); line-height: 1.6; direction: rtl;">
                قم بتعبئة كافة البيانات المطلوبة كما ورد بالنص في إستمارة الثانوية العامة
                        <select id="birthPlace" name="birth_place" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep2()">
    <a href="?p=major_it" class="major-box"><img src="images/hero_img1.png"><div><h3>تقنية المعلومات</h3><p>للمزيد من التفاصيل</p></div></a>
            <!-- مؤشر تبويبات الاستمارة العلوي (مظهر تفاعلي للون فقط ولا ينتقل عند النقر) -->
    <a href="?p=major_business" class="major-box"><img src="images/img1.jpg"><div><h3>إدارة أعمال</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_midwife" class="major-box"><img src="images/slider_vision.jpg"><div><h3>قبالة وتوليد</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_assistant" class="major-box"><img src="images/news_launch.jpg"><div><h3>مساعد طبيب</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_pharmacy" class="major-box"><img src="images/project_epilepsy_1.jpg"><div><h3>صيدلة</h3><p>للمزيد من التفاصيل</p></div></a>
                            <option value="حضرموت">حضرموت</option>
            <!-- الوعاء الداخلي الفاتح ذو الزوايا المستديرة والإطار الخفيف المماثل للصورة -->
            <div style="border: 1.5px solid #e0e0e0; border-radius: 20px; padding: 30px; background: #fafafa; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
<!-- ===== آخر الأخبار المطور كصفحة الأخبار تماماً ===== -->
<!-- ===== آخر الأخبار المطور كصفحة الأخبار تماماً ===== -->
    <!-- عنوان القسم مع خط أحمر صغير بالأسفل محاذى لليمين -->
                <h3 id="wizardStepTitle" style="color: #7d6b6b; text-align: right; margin-top: 0; margin-bottom: 30px; font-weight: bold; font-size: 22px; direction: rtl; text-shadow: 0 1px 1px rgba(0,0,0,0.05);">البيانات الشخصية</h3>
        <h2 style="color:#0f3460; font-size: 24px; font-weight: bold; margin: 0; display: inline-block; border-bottom: 3px solid #7d0f3f; padding-bottom: 8px; font-family:'Cairo', sans-serif;">آخر الأخبار</h2>
            <!-- الخطوة الثانية: البيانات الشخصية -->
                            <option value="الجوف">الجوف</option>
        <p style="color:#666;margin-top:10px;">آخر الأخبار والفعاليات في كلية سماء المتميزين</p>
        <p style="color:#666;margin-top:10px;">آخر الأخبار في كلية سماء المتميزين</p>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl;">
                <!-- الصف الأول: نوع الثانوية - مكان الحصول عليه مدرسة - العام الدراسي -->
    <!-- شبكة كروت الأخبار (3 كروت متجاوبة متطابقة تماماً) -->
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()" onblur="showFullNameError()">
            <a href="?p=news&id=<?php echo $news_id; ?>" style="text-decoration: none; color: inherit; display: block; background: white; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.06); transition: 0.3s; box-sizing: border-box;" onmouseover="this.style.transform='translateY(-6px)'; this.style.boxShadow='0 12px 25px rgba(0,0,0,0.12)'" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.06)'">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">نوع الثانوية</label>
                        <select id="qualificationType" name="qualification_type" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الأسم الإنجليزي</label>
                        <input type="text" id="englishName" name="english_name" required placeholder="الأسم باللغة الإنجليزية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="this.value = this.value.replace(/[^a-zA-Z\s.-]/g, ''); validateStep2();">
                        <span id="englishNameError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب كتابة الاسم باللغة الإنجليزية فقط</span>
                            <option value="ثانوية خارج الوطن">ثانوية خارج الوطن</option>
                        <img src="<?php echo $item['images'][0]; ?>" alt="<?php echo $item['title']; ?>" style="width:100%; height:100%; object-fit:cover;">
                <!-- صف 4: العنوان الحالي وجوال الطالب -->
                <!-- صف 4: العنوان الحالي وجوال الطالب -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl; align-items: center;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 14px;">العنوان الحالي :</label>
                        <input type="text" id="address" name="address" required placeholder="يرجى إدخال عنوانك الحالي بشكل صحيح......" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep2()">
                        <input type="text" id="address" name="address" required placeholder="يرجى إدخال عنوانك الحالي بشكل صحيح......" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep2()">
                    <div style="height:200px;background:<?php echo $item['gradient']; ?>;display:flex;align-items:center;justify-content:center;color:white;font-size:50px;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 14px;">جوال الطالب :</label>
                                <input type="radio" name="gender" value="ذكر" required style="width: 18px; height: 18px; accent-color: #751214; cursor: pointer;" onchange="validateStep2()">
                            <span style="background: #f1f1f1; border-left: 1px solid #d1d5db; padding: 12px 15px; color: #7c1212; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr;">967+</span>
                            <input type="text" id="phone" name="phone" required placeholder="الجوال الخاص بالطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                            <input type="text" id="phone" name="phone" required placeholder="الجوال الخاص بالطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                                <input type="radio" name="gender" value="أنثى" style="width: 18px; height: 18px; accent-color: #751214; cursor: pointer;" onchange="validateStep2()">
    <!-- زر عرض الكل بالأسفل على اليسار -->
                    <h3 style="color:#0f3460;font-size:17px;margin-bottom:10px;line-height:1.6;transition: color 0.3s ease;"><?php echo $item['title']; ?></h3>
        <a href="?p=news" style="background: #7d0f3f; color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(125,15,63,0.2); font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#0f3460'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#7d0f3f'; this.style.transform='none'">عرض الكل</a>
                <!-- صف 5: جوال ولي الأمر ورقم الواتس -->
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الجنسية</label>
                        <select id="nationality" name="nationality" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep2()">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 14px;">جوال ولي الأمر :</label>
                            <span style="background: #f1f1f1; border-left: 1px solid #d1d5db; padding: 12px 15px; color: #7c1212; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr;">967+</span>
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
    <!-- زر عرض الكل بالأسفل على اليسار -->
        <a href="?p=news" style="background: #7d0f3f; color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(125,15,63,0.2); font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#0f3460'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#7d0f3f'; this.style.transform='none'">عرض الكل</a>
        <a href="?p=latest_news" style="background: #7d0f3f; color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(125,15,63,0.2); font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#0f3460'; this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#7d0f3f'; this.style.transform='none'">عرض الكل</a>
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">جوال الطالب</label>
                            <span style="background: #f1f1f1; border-left: 1px solid #d1d5db; padding: 12px 15px; color: #7c1212; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr;">967+</span>
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                            <input type="text" id="phone" name="phone" required placeholder="الجوال الخاص بالطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                        <input type="text" id="totalMarks" name="total_marks" required placeholder="مجموع الثانوية العامة" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                <!-- صف 3: مكان الميلاد وتاريخ الميلاد -->
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">العنوان الحالي</label>
                        <input type="text" id="address" name="address" required placeholder="يرجى إدخال عنوانك الحالي بشكل صحيح......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
                    <button type="button" id="nextBtn2" disabled onclick="goToStep(3)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
                    <button type="button" onclick="goToStep(1)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                    <button type="button" onclick="goToStep(1)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                    <button type="button" onclick="goToStep(1)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="phone" name="phone" required placeholder="الجوال الخاص بالطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                <h3 style="color: #7c1212; text-align: right; margin-top: 0; margin-bottom: 25px; font-weight: bold; font-size: 18px; direction: rtl;"> بيانات المؤهل السابق</h3>
                        <input type="text" id="seatNumber" name="seat_number" required placeholder="رقم الجلوس" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">العنوان الحالي</label>
                        <input type="text" id="address" name="address" required placeholder="يرجى إدخال عنوانك الحالي بشكل صحيح......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 14px;">نوع المؤهل السابق :</label>
                    <select id="qualificationType" name="qualification_type" required style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                    <label style="display: block; font-weight: bold; margin-bottom: 12px; color: #4a4a4a; font-size: 14px;">ارفق صورة نتيجة الثانوية العامة</label>
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                        <option value="ثانوية خارج الوطن">ثانوية خارج الوطن</option>
                        <span id="phoneError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب أن يكون الرقم صحيحاً ومكوناً من 9 أرقام</span>
                <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 20px; direction: ltr;">
                    <button type="button" id="nextBtn2" disabled onclick="goToStep(3)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
                    <button type="button" onclick="goToStep(1)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">معدل الثانوية (%)</label>
                        <input type="number" id="highSchoolPercentage" name="high_school_percentage" required min="50" max="100" step="0.01" placeholder="مثال: 85.50" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    <button type="button" onclick="goToStep(2)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                        <select id="graduationYear" name="graduation_year" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                    <button type="button" onclick="goToStep(1)" style="padding: 10px 30px; background: #751214; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5e0e10'" onmouseout="this.style.background='#751214'">السابق</button>
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                        <select id="qualificationType" name="qualification_type" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                        <div style="display: flex; border: 1.5px solid #e0e0e0; border-radius: 15px; overflow: hidden; background: #fff; box-sizing: border-box;">
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: #751214; font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()">
                            <option value="ثانوية خارج الوطن">ثانوية خارج الوطن</option>
                        <span id="whatsappError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب أن يكون الرقم صحيحاً ومكوناً من 9 أرقام</span>
                    <button type="button" id="nextBtn2" disabled onclick="goToStep(3)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
                    <button type="button" onclick="goToStep(1)" style="padding: 12px 25px; background: #6c757d; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5a6268'" onmouseout="this.style.background='#6c757d'">→ السابق</button>
                    <!-- مكان الحصول عليه مدرسة -->
                <!-- أزرار الخطوة الثانية -->
                    <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">اسم المدرسة المتخرج منها</label>
                    <input type="text" id="schoolName" name="school_name" required placeholder="اكتب اسم المدرسة كاملة" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    <input type="text" id="schoolName" name="school_name" required placeholder="اكتب اسم المدرسة كاملة" style="width: 100%; padding: 12px 20px; border: 1px solid #d1d5db; border-radius: 25px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box;" oninput="validateStep3()">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: 'Cairo', sans-serif; direction: rtl; justify-content: flex-start;">
        <a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a></div>
                    <button type="button" onclick="goToStep(3)" style="padding: 10px 30px; background: #751214; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5e0e10'" onmouseout="this.style.background='#751214'">السابق</button>
                    <button type="submit" id="submitBtn" name="enroll" disabled style="padding: 10px 30px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">تقديم طلب الالتحاق</button>
                        <input type="file" id="identityImage" name="identity_image" required accept="image/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onchange="updateIdentityFileLabel(this)">
                        <input type="file" id="identityImage" name="identity_image" required accept="image/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onchange="updateIdentityFileLabel(this)">
            <div id="termsModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
                        <input type="password" id="password" name="password" required placeholder="استخدم كلمة مرور قوية لتسجيل الدخول لاحقاً" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep4()">
                    <!-- الهيدر الخاص بالمودال -->
            <!-- مؤشر الدوائر (1 - 2 - 3) في الجزء السفلي الموضح بالصورة -->
                        <h3 style="margin: 0; color: #111; font-weight: 800; font-size: 22px;">شروط القبول والتسجيل</h3>
                        <span onclick="closeTermsModal()" style="font-size: 28px; font-weight: bold; cursor: pointer; color: #888; transition: color 0.2s;" onmouseover="this.style.color='#751214'" onmouseout="this.style.color='#888'">&times;</span>
            </div> <!-- إغلاق الخطوة الرابعة -->
                    <div id="circle1" style="width: 32px; height: 32px; border-radius: 50%; background: #7c1212; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; box-shadow: 0 2px 8px rgba(124,18,18,0.25);">1</div>
                    <div id="circle2" style="width: 32px; height: 32px; border-radius: 50%; background: #ccc; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">2</div>
            <!-- الخيارات الإضافية أسفل الصندوق ذو الخلفية الرمادية (خارج الصندوق وعلى الخلفية البيضاء) -->
            <div id="termsModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
                            <span id="identityUploadText" style="color: #777; font-size: 13px; font-family: 'Cairo', sans-serif;"> اضغط هنا لرفع صورة الهوية</span>
                    <!-- الهيدر الخاص بالمودال -->
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e0e0e0; padding-bottom: 15px; margin-bottom: 20px;">
                        <h3 style="margin: 0; color: #111; font-weight: 800; font-size: 22px;">شروط القبول والتسجيل</h3>
                        الموافقة على <a href="#" style="color: #751214; text-decoration: underline; font-weight: bold;">سياسة القبول والتسجيل</a>
    elseif ($page == 'complaints'):
                    <span id="declarationError" style="color: #751214; font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">يجب قبول الموافقة على الشروط</span>
                    <!-- المحتوى الخاص بالشروط -->
                    <div style="max-height: 400px; overflow-y: auto; text-align: right; line-height: 1.8; font-size: 15px; color: #333; padding-left: 10px;">
                        <h4 style="color: #751214; font-weight: bold; font-size: 17px; margin-top: 0; margin-bottom: 15px; border-bottom: 1px dashed #e0e0e0; padding-bottom: 5px;">اللوائح الأكاديمية:</h4>
                    <span id="recaptchaError" style="color: #751214; font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">الرجاء تأكيد انك لست روبوت</span>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يسمح بالتحويل من تخصص إلى آخر خلال أسبوعين من بدء الدراسة بحسب قواعد لائحة شئون الطلاب الموحدة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحق للطلبة وقف القيد بعد اجتياز السنة الأولى بنجاح خلال أسبوعين من بداية العام الدراسي التالي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">الالتزام باللوائح والأنظمة الأكاديمية، والالتزام بحضور المحاضرات (النظرية والعملية والحقلية والسريرية).</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يُنذر الطالب/ـة إذا بلغت نسبة الغياب 25% من إجمالي محاضرات المقرر ويُبلغ ولي الأمر إذا تجاوز أكثر من ذلك.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحرم الطالب/ـة من الامتحانات النهائية للمقررات إذا وصلت نسبة الغياب 50% في المقرر بدون عذر مقبول.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">تُعقد الامتحانات التكميلية خلال الإجازة الصيفية وقبل العام الدراسي التالي للذين لديهم أقل من أربع مقررات رسوب في العام.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">لا يسمح بانتقال الطلبة إلى مستوى أعلى إذا تجاوزت مقررات الرسوب/الغير مقاصة أكثر من 3 مقررات، (الطلبة المقيدون في برنامج وزارة الصحة يشترط عليهم النجاح بجميع المقررات للانتقال إلى مستوى أعلى).</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">على الطلبة قراءة واستيعاب لائحة شؤون الطلاب المودع نسخة منها في المكتبة للاطلاع على بقية اللوائح والأنظمة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">عدم المعرفة باللوائح والأنظمة الأكاديمية لا تعطي الطلبة حق الاعتراض على تطبيقها.</li>
        include 'pages/it.php';
            <!-- زر السابق أسفل الدوائر للرجوع للخطوة 3 -->
            <div id="step4PrevContainer" style="display: none; text-align: center; margin-top: 15px; margin-bottom: 15px;">
                        <h4 style="color: #751214; font-weight: bold; font-size: 17px; margin-top: 20px; margin-bottom: 15px; border-bottom: 1px dashed #e0e0e0; padding-bottom: 5px;">الرسوم:</h4>
                    <div style="text-align: center; margin-top: 25px; border-top: 1.5px solid #e0e0e0; padding-top: 15px;">
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل لمرة واحدة فقط، رسوم الأنشطة سنوياً، رسوم البطاقة الأكاديمية فصلياً وتُسدد بداية كل فصل دراسي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل والأنشطة والبطاقة لا ترد مهما كانت الأسباب، وتُعاد الرسوم الدراسية كاملة إذا أنسحب الطالب قبل بدء الدراسة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">في حالة الانسحاب بعد بدء الدراسة في الجامعة تخصم 5% من الرسوم السنوية عن كل أسبوع من بدء الدراسة أو من بعد التسجيل، وتُلغى كافة التخفيضات التي أستحقها الطالبـ/ـة المفصول/المنسحب في الفصول الدراسية السابقة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">
                                يتم تسديد الرسوم الدراسية السنوية على 2-4 أقساط، الطالب غير المُسدد كامل الرسوم السنوية:
            <!-- الخيارات الإضافية أسفل الصندوق ذو الخلفية الرمادية (خارج الصندوق وعلى الخلفية البيضاء) -->
                                    <li style="margin-bottom: 5px;">(أ) يُحرم من دخول امتحانات نهاية الفصل الدراسي.</li>
                                    <li style="margin-bottom: 5px;">(ب) تلغى أي تخفيضات أو منح جزئية حصل عليها الطالب شاملاً المُرسلين بموجب عقود مع الجامعة.</li>
                        <h4 style="color: #751214; font-weight: bold; font-size: 17px; margin-top: 20px; margin-bottom: 15px; border-bottom: 1px dashed #e0e0e0; padding-bottom: 5px;">الرسوم:</h4>
                        <ol style="padding-right: 20px; margin: 0; list-style-type: decimal;">
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل لمرة واحدة فقط، رسوم الأنشطة سنوياً، رسوم البطاقة الأكاديمية فصلياً وتُسدد بداية كل فصل دراسي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل والأنشطة والبطاقة لا ترد مهما كانت الأسباب، وتُعاد الرسوم الدراسية كاملة إذا أنسحب الطالب قبل بدء الدراسة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">في حالة الانسحاب بعد بدء الدراسة في الجامعة تخصم 5% من الرسوم السنوية عن كل أسبوع من بدء الدراسة أو من بعد التسجيل، وتُلغى كافة التخفيضات التي أستحقها الطالبـ/ـة المفصول/المنسحب في الفصول الدراسية السابقة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">أي تخفيض أو إعفاء من الرسوم الدراسية (منح) لا تشمل الرسوم المعملية والتطبيقية.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">لا يُمنح الطالب الخريج إفادة تخرج ولا تُرسل وثائقه للتعميد إلا بعد استكمال برنامج التدريب وتعبئة نماذج إخلاء طرف من الجامعة وسدد كافة الرسوم.</li>
                                <ul style="list-style-type: none; padding-right: 15px; margin-top: 5px;">
                                    <li style="margin-bottom: 5px;">(أ) يُحرم من دخول امتحانات نهاية الفصل الدراسي.</li>
                                    <li style="margin-bottom: 5px;">(ب) تلغى أي تخفيضات أو منح جزئية حصل عليها الطالب شاملاً المُرسلين بموجب عقود مع الجامعة.</li>
                    <!-- الفوتر الخاص بالمودال -->
                    <div style="text-align: center; margin-top: 25px; border-top: 1.5px solid #e0e0e0; padding-top: 15px;">
                            <li style="margin-bottom: 12px; padding-right: 5px;">الجهات المرتبطة مع الجامعة بعقود يخضع طلابها لكافة لوائح الجامعة وشروط العقد ساري المفعول.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحصل الطالب/ـة على تخفيض حال سداد الرسوم الدراسية مقدماً خلال أسبوعين من بداية العام أو الفصل الدراسي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">الطلبة الذين عليهم تدريب سريري في المستشفيات أو العيادات يضاف عليهم رسوم رمزية حسب ما يتقرر في سنة التدريب.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">أي تخفيض أو إعفاء من الرسوم الدراسية (منح) لا تشمل الرسوم المعملية والتطبيقية.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">لا يُمنح الطالب الخريج إفادة تخرج ولا تُرسل وثائقه للتعميد إلا بعد استكمال برنامج التدريب وتعبئة نماذج إخلاء طرف من الجامعة وسدد كافة الرسوم.</li>
            <!-- الخيارات الإضافية أسفل الصندوق ذو الخلفية الرمادية (خارج الصندوق وعلى الخلفية البيضاء) -->
            <div id="step4ExtraOptions" style="display: none; justify-content: space-between; align-items: center; margin-top: 25px; margin-bottom: 25px; direction: rtl; padding: 0 10px;">
                <!-- الموافقة على سياسة القبول والتسجيل -->
                    <!-- الفوتر الخاص بالمودال -->
                    <input type="checkbox" id="declaration" required style="cursor: pointer; transform: scale(1.2); accent-color: #751214;" onchange="validateStep4()">
                        <button type="button" onclick="closeTermsModal()" style="padding: 8px 30px; background: #751214; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='#5e0e10'" onmouseout="this.style.background='#751214'">موافق</button>
                        الموافقة على <a href="#" onclick="openTermsModal(event)" style="color: #007bff; text-decoration: underline; font-weight: bold;">سياسة القبول والتسجيل</a>
                    </label>
                    <span id="declarationError" style="color: #751214; font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">يجب قبول الموافقة على الشروط</span>
    var branch = document.getElementById("branchSelect").value;
            <!-- مودال النجاح بعد التسجيل -->
            <div id="successModal" style="display: none; position: fixed; z-index: 99999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
                <div style="background-color: white; margin: auto; padding: 40px 30px; border-radius: 20px; box-shadow: 0 15px 40px rgba(0,0,0,0.3); width: 100%; max-width: 650px; text-align: center; font-family: 'Cairo', sans-serif; box-sizing: border-box; border-top: 6px solid #28a745;">
                    <!-- علامة الصح الخضراء -->
                    <div style="width: 70px; height: 70px; border-radius: 50%; border: 3px solid #28a745; background-color: #eef9eef0; display: flex; align-items: center; justify-content: center; margin: 0 auto 20px auto; color: #28a745; font-size: 35px; font-weight: bold;">
        nextBtn2.style.cursor = "pointer";
        nextBtn.style.background = "#7c1212";
        nextBtn.style.color = "white";
                    <!-- عنوان النجاح -->
                    <h2 style="margin: 0 0 15px 0; font-size: 24px; font-weight: bold; color: #111;">نجاح!</h2>
        nextBtn2.style.cursor = "not-allowed";
                    <!-- نص الرسالة المعدل مع حسابات بنك الكريمي الجديدة -->
                    <p style="font-size: 15px; color: #555; line-height: 1.8; margin-bottom: 30px; padding: 0 10px;">
                        تم التسجيل بنجاح .. الرجاء ايداع رسوم التسجيل (شامل البطاقة + الانشطة) مبلغ 30,000 ر.ي لحساب الكلية <strong style="color: #751214;">3007722396</strong> أو <strong style="color: #751214;">3086295309</strong> طرف بنك الكريمي للتمويل الأصغر الإسلامي.
function validateStep3() {
    var qual = document.getElementById("qualificationType").value;
                    <!-- أزرار التحكم -->
                    <div style="display: flex; justify-content: center; gap: 15px; direction: rtl;">
                        <!-- زر طباعة باللون الأخضر -->
                        <button type="button" onclick="triggerReceiptPrint()" style="padding: 10px 40px; background-color: #008000; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#006400'" onmouseout="this.style.backgroundColor='#008000'">طباعة</button>
                        <!-- زر إغلاق باللون الأحمر المفرغ -->
                        <button type="button" onclick="closeSuccessModal()" style="padding: 10px 40px; background-color: white; color: #ff0000; border: 1.5px solid #ff0000; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#ffebee'" onmouseout="this.style.backgroundColor='white'">إغلاق</button>
    if (qual !== "" && percentage !== "" && year !== "" && school !== "") {
    var nationality = document.getElementById("nationality").value;
    var phone = document.getElementById("phone").value.trim();
    var parentPhone = document.getElementById("parentPhone").value.trim();
            <!-- الخيارات الإضافية أسفل الصندوق ذو الخلفية الرمادية (خارج الصندوق وعلى الخلفية البيضاء) -->
            <div id="step4ExtraOptions" style="display: none; justify-content: space-between; align-items: center; margin-top: 25px; margin-bottom: 25px; direction: rtl; padding: 0 10px;">
                <!-- الموافقة على سياسة القبول والتسجيل -->
                <div style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="declaration" required style="cursor: pointer; transform: scale(1.2); accent-color: #751214;" onchange="validateStep4()">
                    <label for="declaration" style="font-size: 13px; color: #555; cursor: pointer; user-select: none;">
                        الموافقة على <a href="#" onclick="openTermsModal(event)" style="color: #007bff; text-decoration: underline; font-weight: bold;">سياسة القبول والتسجيل</a>
        nextBtn2.disabled = false;
                    <span id="declarationError" style="color: #751214; font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">يجب قبول الموافقة على الشروط</span>
        nextBtn2.style.color = "white";
    var idType = document.getElementById("identityType").value;
                <div style="display: flex; align-items: center; gap: 8px; direction: ltr;">
                    <span id="recaptchaError" style="color: #751214; font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">الرجاء تأكيد انك لست روبوت</span>
                    <label for="recaptchaMock" style="font-size: 13px; color: #555; cursor: pointer; user-select: none; font-family: sans-serif;">
    var password = document.getElementById("password").value.trim();
    var declaration = document.getElementById("declaration").checked;
                    <input type="checkbox" id="recaptchaMock" required style="cursor: pointer; transform: scale(1.2); accent-color: #751214;" onchange="validateStep4()">
    var phone = document.getElementById("phone").value.trim();
    var parentPhone = document.getElementById("parentPhone").value.trim();
    if (idType !== "" && idNum !== "" && idDate !== "" && email !== "" && password !== "" && declaration) {
            <!-- زر تسجيل (التقديم النهائي) الموضح بالصورة -->
    if (idType !== "" && idNum !== "" && idDate !== "" && email !== "" && password !== "" && declaration) {
                <button type="submit" id="submitBtn" name="enroll" disabled style="padding: 10px 50px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">تسجيل</button>
    var school = document.getElementById("schoolName").value.trim();
    if (fullName !== "" && englishName !== "" && genderVal !== null && birthDate !== "" &&
            <!-- زر السابق أسفل الدوائر للرجوع للخطوة 3 -->
            <div id="step4PrevContainer" style="display: none; text-align: center; margin-top: 15px; margin-bottom: 15px;">
                <button type="button" onclick="goToStep(3)" style="padding: 10px 30px; background: #751214; color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#5e0e10'" onmouseout="this.style.background='#751214'">السابق</button>
    var nationality = document.getElementById("nationality").value;
    var phone = document.getElementById("phone").value.trim();
            <!-- مؤشر الدوائر (1 - 2 - 3) في الجزء السفلي الموضح بالصورة -->
            <div style="display: flex; align-items: center; justify-content: center; position: relative; margin: 35px auto 15px auto; width: 100%; direction: rtl;">
                <div style="position: absolute; top: 50%; left: 15%; right: 15%; height: 3px; background: #e0e0e0; z-index: 1; transform: translateY(-50%);"></div>
                <div style="display: flex; justify-content: space-between; width: 70%; position: relative; z-index: 2;">
                    <div id="circle1" style="width: 32px; height: 32px; border-radius: 50%; background: #7c1212; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; box-shadow: 0 2px 8px rgba(124,18,18,0.25);">1</div>
                    <div id="circle2" style="width: 32px; height: 32px; border-radius: 50%; background: #ccc; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">2</div>
    // التحقق من الاسم الرباعي (4 أجزاء أو أكثر مفصولة بمسافات)
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var whatsapp = document.getElementById("whatsapp").value.trim();
    var nationality = document.getElementById("nationality").value;
            <div style="text-align:center;margin-top:25px;"><a href="?p=home" class="btn-back-to-home"><i class="fa-solid fa-house"></i> العودة لصفحة الرئيسية</a></div>
        </div> <!-- إغلاق الحاوية الثانية enrollWizardContainer -->
    var idNum = document.getElementById("identityNumber").value.trim();
    // التحقق من الاسم الرباعي (4 أجزاء أو أكثر مفصولة بمسافات)
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var password = document.getElementById("password").value.trim();
        document.getElementById("enrollStep1Container").style.display = "none";
    // التحقق من الاسم الرباعي (4 أجزاء أو أكثر مفصولة بمسافات)
        birthPlace !== "" && nationality !== "" && phone !== "" && parentPhone !== "" && whatsapp !== "" && address !== "") {
        document.getElementById("step1").style.display = "none";
    if (idType !== "" && idNum !== "" && idDate !== "" && email !== "" && password !== "" && declaration) {
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
        errorSpan.style.display = "block";
    // التحقق من أرقام الهواتف (يجب أن تتكون من 9 أرقام)
        nextBtn2.style.background = "#ccc";
        var title = "البيانات الشخصية";
        if (step === 3) title = "بيانات المؤهل السابق";
    // التحقق من الاسم الإنجليزي (حروف إنجليزية ومسافات ونقاط وعلامات وصل)
        if (step === 4) title = "بيانات الهوية";
        document.getElementById("wizardStepTitle").innerText = title;
        // تحديث ألوان مؤشرات الخطوات العلوية
        // تحديث دوائر الخطوات السفلية (1 - 2 - 3)
        document.getElementById("tabStep3").style.color = (step === 3) ? "#7c1212" : "#888";
        document.getElementById("tabStep4").style.color = (step === 4) ? "#7c1212" : "#888";
            var circle = document.getElementById("circle" + i);
        // تحديث دوائر الخطوات السفلية (1 - 2 - 3)
    // التحقق من الاسم الإنجليزي (حروف إنجليزية ومسافات ونقاط وعلامات وصل)
    // التحقق من أرقام الهواتف (يجب أن تتكون من 9 أرقام)
        { value: "مساعد طبيب (بكالوريوس)", text: "مساعد طبيب (بكالوريوس)" },
        { value: "قبالة وتوليد (بكالوريوس)", text: "قبالة وتوليد (بكالوريوس)" },
        { value: "دبلوم صيدلة", text: "دبلوم صيدلة" },
        { value: "دبلوم مساعد طبيب", text: "دبلوم مساعد طبيب" },
        { value: "دبلوم مختبرات طبية", text: "دبلوم مختبرات طبية" },
        { value: "دبلوم تمريض", text: "دبلوم تمريض" },
        { value: "دبلوم قبالة وتوليد", text: "دبلوم قبالة وتوليد" }
                    circle.style.boxShadow = "none";
        if (step === 2) validateStep2();
        { value: "تقنية المعلومات (بكالوريوس)", text: "تقنية المعلومات (بكالوريوس)" },
        { value: "دبلوم تقنية معلومات وشبكات", text: "دبلوم تقنية معلومات وشبكات" },
        { value: "دبلوم تصميم جرافيكس", text: "دبلوم تصميم جرافيكس" }
    var isPhoneValid = phoneRegex.test(phone);
    if (fullName !== "" && isFullNameQuad && englishName !== "" && genderVal !== null && birthDate !== "" &&
        { value: "محاسبة (بكالوريوس)", text: "محاسبة (بكالوريوس)" },
        { value: "إدارة أعمال (بكالوريوس)", text: "إدارة أعمال (بكالوريوس)" },
        { value: "دبلوم محاسبة وإدارة", text: "دبلوم محاسبة وإدارة" }
        whatsapp !== "" && isWhatsappValid &&
        pError.style.display = "block";
        { value: "هندسة معمارية (بكالوريوس)", text: "هندسة معمارية (بكالوريوس)" },
        { value: "دبلوم تصميم داخلي", text: "دبلوم تصميم داخلي" }
    <!-- الجزء العلوي للفوتر (أزرق داكن) -->
    <div style="background: linear-gradient(135deg, #0f3460, #08213f); color: white; padding: 60px 20px 140px; text-align: center; position: relative;">
        <h2 style="margin: 0 0 15px; font-size: 26px; font-weight: bold;">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h2>
        <p style="margin: 0 auto 30px; max-width: 700px; line-height: 1.8; font-size: 15px; opacity: 0.9;">مؤسسة تعليمية رائدة تسعى لإعداد كوادر متميزة في المجال الصحي والتقني وفق أحدث المعايير الأكاديمية.</p>
    var branchSelect = document.getElementById("branchSelect");
        <!-- خط جذاب فاصل وعنوان تواصل معنا -->
        <div style="border-top: 1.5px solid rgba(255, 255, 255, 0.25); width: 85%; max-width: 850px; margin: 35px auto 25px;"></div>
        birthPlace !== "" && nationality !== "" &&
        phone !== "" && isPhoneValid &&
    collegeSelect.innerHTML = '<option value="">اختر القسم</option>';
    departmentSelect.innerHTML = '<option value="">اختر التخصص</option>';
    var qual = document.getElementById("qualificationType").value;
        nextBtn2.disabled = false;
        nextBtn2.style.background = "#751214";
            { value: "medical", text: "العلوم الطبية والصحية" },
            { value: "tech", text: "العلوم التقنية والحاسوب" },
            { value: "admin", text: "العلوم الإدارية والمالية" },
            { value: "engineering", text: "العلوم الهندسية" }
        nextBtn2.style.background = "#ccc";
        parentPhone !== "" && isParentPhoneValid &&
        for (var i = 0; i < colleges.length; i++) {
            var opt = document.createElement("option");
            var opt = document.createElement("option");
        nextBtn2.style.background = "#751214";
            collegeSelect.appendChild(opt);
    var fullName = document.getElementById("fullName").value.trim();
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var errorSpan = document.getElementById("fullNameError");
    if (fullName !== "" && nameParts.length < 4) {
        collegeSelect.style.background = "#fff";
        collegeSelect.style.cursor = "pointer";
        errorSpan.style.display = "none";
        collegeSelect.style.background = "#eee";
        collegeSelect.style.cursor = "not-allowed";
        collegeSelect.style.cursor = "not-allowed";
    var qual = document.getElementById("qualificationType").value;
    var school = document.getElementById("schoolName").value.trim();
    var school = document.getElementById("schoolName").value.trim();
    var totalMarks = document.getElementById("totalMarks").value.trim();
    var percentage = document.getElementById("highSchoolPercentage").value;
    var percentage = document.getElementById("highSchoolPercentage").value;
    var seatNumber = document.getElementById("seatNumber").value.trim();
    var certFile = document.getElementById("schoolCertImage").files;
    var departmentSelect = document.getElementById("departmentSelect");
    var departmentSelect = document.getElementById("departmentSelect");
    var selectedCollege = collegeSelect.value;
    if (qual !== "" && school !== "" && year !== "" && totalMarks !== "" && percentage !== "" && seatNumber !== "" && certFile.length > 0) {
    departmentSelect.innerHTML = '<option value="">اختر التخصص</option>';
    if (selectedCollege && departments[selectedCollege]) {
        departments[selectedCollege].forEach(function(dep) {
        departments[selectedCollege].forEach(function(dep) {
            var opt = document.createElement("option");
            var opt = document.createElement("option");
            departmentSelect.appendChild(opt);
            departmentSelect.appendChild(opt);
    var qual = document.getElementById("qualificationType").value;
    var school = document.getElementById("schoolName").value.trim();
    var year = document.getElementById("graduationYear").value;
    var totalMarks = document.getElementById("totalMarks").value.trim();
    var percentage = document.getElementById("highSchoolPercentage").value;
    var seatNumber = document.getElementById("seatNumber").value.trim();
    var certFile = document.getElementById("schoolCertImage").files;
        departmentSelect.style.cursor = "not-allowed";
    var nextBtn3 = document.getElementById("nextBtn3");
        departmentSelect.style.cursor = "not-allowed";
    if (qual !== "" && school !== "" && year !== "" && totalMarks !== "" && percentage !== "" && seatNumber !== "" && certFile.length > 0) {
        nextBtn3.disabled = false;
    var branch = document.getElementById("branchSelect").value;
    var college = document.getElementById("collegeSelect").value;
    var department = document.getElementById("departmentSelect").value;
    var department = document.getElementById("departmentSelect").value;
    var department = document.getElementById("departmentSelect").value;
    if (branch !== "" && college !== "" && department !== "") {
        nextBtn3.style.color = "#888";
        nextBtn3.style.cursor = "not-allowed";
        nextBtn.style.color = "white";
        nextBtn.style.cursor = "pointer";
function showPhoneError(inputId, errorId) {
    var phoneVal = document.getElementById(inputId).value.trim();
    var wrapper = document.getElementById("fileUploadWrapper");
    var label = document.getElementById("fileUploadText");
    if (phoneVal !== "" && !phoneRegex.test(phoneVal)) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        wrapper.style.background = "#eef9f0";
function validateStep2() {
        label.innerText = " اضغط هنا لرفع صورة النتيجة";
    var englishName = document.getElementById("englishName").value.trim();
    var genderVal = document.querySelector('input[name="gender"]:checked');
    var qual = document.getElementById("qualificationType").value;
    var school = document.getElementById("schoolName").value.trim();
    var nationality = document.getElementById("nationality").value;
    var totalMarks = document.getElementById("totalMarks").value.trim();
    var percentage = document.getElementById("highSchoolPercentage").value;
    var seatNumber = document.getElementById("seatNumber").value.trim();
    var idNum = document.getElementById("identityNumber").value.trim();
    var idDate = document.getElementById("identityIssueDate").value;
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    // التحقق من الاسم الرباعي (4 أجزاء أو أكثر مفصولة بمسافات)
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var submitBtn = document.getElementById("submitBtn");
        nextBtn3.style.color = "white";
    // إخفاء رسالة الخطأ تلقائياً بمجرد إكمال الاسم الرباعي
    var errorSpan = document.getElementById("fullNameError");
        submitBtn.style.background = "#28a745";
        nextBtn3.style.background = "#ccc";
        submitBtn.style.cursor = "pointer";
        nextBtn3.style.cursor = "not-allowed";
    // التحقق من الاسم الإنجليزي (حروف إنجليزية ومسافات ونقاط وعلامات وصل)
        submitBtn.style.background = "#ccc";
    var isEnglishNameValid = englishRegex.test(englishName);
        submitBtn.style.cursor = "not-allowed";
    var wrapper = document.getElementById("fileUploadWrapper");
    var label = document.getElementById("fileUploadText");
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        document.getElementById("enrollStep1Container").style.display = "block";
        document.getElementById("enrollWizardContainer").style.display = "none";
    // التحقق من أرقام الهواتف (يجب أن تتكون من 9 أرقام)
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
    var isWhatsappValid = phoneRegex.test(whatsapp);
        nextBtn2.style.cursor = "pointer";
    // إخفاء رسائل الخطأ تلقائياً بمجرد أن تصبح الأرقام صحيحة أثناء الكتابة
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
    var idDate = document.getElementById("identityIssueDate").value;
    var idPlace = document.getElementById("identityPlace").value.trim();
        document.getElementById("parentPhoneError").style.display = "none";
    var declaration = document.getElementById("declaration").checked;
        document.getElementById("step4").style.display = "none";
        document.getElementById("whatsappError").style.display = "none";
        document.getElementById("step" + step).style.display = "block";
    if (idType !== "" && idNum !== "" && idDate !== "" && email !== "" && password !== "" && declaration) {
    if (fullName !== "" && isFullNameQuad && englishName !== "" && isEnglishNameValid && genderVal !== null && birthDate !== "" &&
        var title = "البيانات الشخصية";
        if (step === 3) title = "بيانات المؤهل السابق";
        if (step === 4) title = "بيانات الهوية";
    if (idType !== "" && idPlace !== "" && idNum !== "" && idDate !== "" &&
        email !== "" && password !== "" && declaration && recaptchaMock && idImage.length > 0) {
        // تحديث ألوان مؤشرات الخطوات العلوية
        document.getElementById("tabStep2").style.color = (step === 2) ? "#751214" : "#000";
        document.getElementById("tabStep3").style.color = (step === 3) ? "#751214" : "#000";
        document.getElementById("tabStep4").style.color = (step === 4) ? "#751214" : "#000";
    var phoneRegex = /^[0-9]{9}$/;
        // تحديث دوائر الخطوات السفلية (1 - 2 - 3)
    if (phoneVal !== "" && !phoneRegex.test(phoneVal)) {
        errorSpan.style.display = "block";
        document.getElementById("enrollStep1Container").style.display = "block";
        document.getElementById("enrollWizardContainer").style.display = "none";
                if (i === wizardStep) {
        document.getElementById("step1").style.display = "block";
                    circle.style.boxShadow = "0 2px 8px rgba(117,18,20,0.25)";
    var wrapper = document.getElementById("identityUploadWrapper");
        document.getElementById("step4").style.display = "none";
                    circle.style.boxShadow = "none";
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
        label.innerText = " اضغط هنا لرفع صورة الهوية";
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "none";
    var password = document.getElementById("password").value.trim();
    var idImage = document.getElementById("identityImage").files;
</script>
        document.getElementById("step" + step).style.display = "block";
    endif;
    // إخفاء رسائل الخطأ تلقائياً عند تحديد مربعات الاختيار
        var title = "البيانات الشخصية";
        if (step === 3) title = "بيانات المؤهل السابق";
        if (step === 4) title = "بيانات الهوية";
        document.getElementById("wizardStepTitle").innerText = title;
    <!-- الجزء العلوي للفوتر (أزرق داكن) -->
        // تحديث ألوان مؤشرات الخطوات العلوية
        <h2 style="margin: 0 0 15px; font-size: 26px; font-weight: bold;">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h2>
        <p style="margin: 0 auto 30px; max-width: 700px; line-height: 1.8; font-size: 15px; opacity: 0.9;">مؤسسة تعليمية رائدة تسعى لإعداد كوادر متميزة في المجال الصحي والتقني وفق أحدث المعايير الأكاديمية.</p>
        document.getElementById("tabStep4").style.color = (step === 4) ? "#751214" : "#000";
        <!-- خط جذاب فاصل وعنوان تواصل معنا -->
    // تفعيل زر التسجيل بمجرد ملء الحقول الأساسية
        <h3 style="color: white; font-size: 20px; font-weight: bold; margin: 0 0 20px 0; font-family:'Cairo', sans-serif; text-align: center;">تواصل معنا</h3>
        email !== "" && password !== "" && idImage.length > 0) {
        <div style="display: flex; flex-direction: column; align-items: center; gap: 12px; font-size: 14px; opacity: 0.95; margin-bottom: 20px;">
        submitBtn.style.background = "#751214";
        submitBtn.style.color = "white";
        label.innerText = " اضغط هنا لرفع صورة النتيجة";
                    circle.style.boxShadow = "0 2px 8px rgba(117,18,20,0.25)";
        wrapper.style.background = "#fff";
                    circle.style.background = "#ccc";
                    circle.style.boxShadow = "none";
        submitBtn.style.cursor = "not-allowed";
            }
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
    var idPlace = document.getElementById("identityPlace").value.trim();
    var idNum = document.getElementById("identityNumber").value.trim();
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
        label.innerText = " اضغط هنا لرفع صورة النتيجة";
    var password = document.getElementById("password").value.trim();
    var idImage = document.getElementById("identityImage").files;
<?php
    var submitBtn = document.getElementById("submitBtn");
    var label = document.getElementById("fileUploadText");
    // إخفاء رسائل الخطأ تلقائياً عند تحديد مربعات الاختيار
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
    var idPlace = document.getElementById("identityPlace").value.trim();
    <!-- الجزء العلوي للفوتر (أزرق داكن) -->
        label.innerText = " اضغط هنا لرفع صورة النتيجة";
    var idImage = document.getElementById("identityImage").files;
        wrapper.style.background = "#fff";
        document.getElementById("recaptchaError").style.display = "none";
        isValid = false;
    // إخفاء رسائل الخطأ تلقائياً عند تحديد مربعات الاختيار
    // تفعيل زر التسجيل بمجرد ملء الحقول الأساسية
    if (idType !== "" && idPlace !== "" && idNum !== "" && idDate !== "" &&
        email !== "" && password !== "" && idImage.length > 0) {
    var idPlace = document.getElementById("identityPlace").value.trim();
        document.getElementById("declarationError").style.display = "none";
    var idDate = document.getElementById("identityIssueDate").value;
    var email = document.getElementById("email").value.trim();
        document.getElementById("recaptchaError").style.display = "none";
    var idImage = document.getElementById("identityImage").files;
    if (input.files && input.files.length > 0) {
    // تفعيل زر التسجيل بمجرد ملء الحقول الأساسية
    if (idType !== "" && idPlace !== "" && idNum !== "" && idDate !== "" && idImage.length > 0) {
    // إخفاء رسائل الخطأ تلقائياً عند تحديد مربعات الاختيار
    var declaration = document.getElementById("declaration").checked;
        label.innerText = " اضغط هنا لرفع صورة الهوية";
        wrapper.style.borderColor = "#e0e0e0";
        wrapper.style.background = "#fff";
        document.getElementById("declarationError").style.display = "none";
        submitBtn.style.background = "#ccc";
        submitBtn.disabled = true;
        document.getElementById("recaptchaError").style.display = "none";
        submitBtn.style.color = "#888";
        submitBtn.style.cursor = "not-allowed";
    // تفعيل زر التسجيل بمجرد ملء الحقول الأساسية
        document.getElementById("enrollWizardContainer").style.display = "none";
        email !== "" && password !== "" && idImage.length > 0) {
        document.getElementById("step1").style.display = "block";
    var declaration = document.getElementById("declaration").checked;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
        submitBtn.style.cursor = "pointer";
    var decError = document.getElementById("declarationError");
    var recError = document.getElementById("recaptchaError");
        submitBtn.style.cursor = "not-allowed";
        submitBtn.style.color = "#888";
        submitBtn.style.cursor = "not-allowed";
    if (!declaration) {
        decError.style.display = "block";
    var declaration = document.getElementById("declaration").checked;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
    var declaration = document.getElementById("declaration").checked;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
    var recError = document.getElementById("recaptchaError");
    var decError = document.getElementById("declarationError");
    var recError = document.getElementById("recaptchaError");
        isValid = false;
    if (!declaration) {
        decError.style.display = "block";
        isValid = false;
        decError.style.display = "block";
        decError.style.display = "none";
    } else {
        decError.style.display = "none";
function updateIdentityFileLabel(input) {
    var wrapper = document.getElementById("identityUploadWrapper");
    var label = document.getElementById("identityUploadText");
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        wrapper.style.background = "#eef9f0";
    return isValid;
        label.innerText = " اضغط هنا لرفع صورة الهوية";
        wrapper.style.borderColor = "#e0e0e0";
        wrapper.style.background = "#fff";
    var wrapper = document.getElementById("identityUploadWrapper");
    var label = document.getElementById("identityUploadText");
    var wrapper = document.getElementById("identityUploadWrapper");
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
    document.getElementById("termsModal").style.display = "flex";
        label.innerText = " اضغط هنا لرفع صورة الهوية";
        wrapper.style.borderColor = "#e0e0e0";
        label.innerText = " اضغط هنا لرفع صورة الهوية";
    document.getElementById("termsModal").style.display = "none";
        wrapper.style.background = "#fff";
    }
function openSuccessModal() {
    document.getElementById("successModal").style.display = "flex";
        document.getElementById("enrollStep1Container").style.display = "block";
        document.getElementById("enrollWizardContainer").style.display = "none";
function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
    document.getElementById("termsModal").style.display = "none";
        // إخفاء خيارات الخطوة الرابعة الخارجية
        printReceipt(successStudentData.studentId, successStudentData.fullName, successStudentData.department, successStudentData.branch);
        document.getElementById("step4SubmitContainer").style.display = "none";
        window.print();
function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
    window.location.href = "?p=home";
function printReceipt(studentId, fullName, dept, branch) {
    var printWindow = window.open('', '_blank');
    printWindow.document.write('<html><head><title>سند تسجيل - كلية سماء المتميزين</title>');
    printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">');
        printReceipt(successStudentData.studentId, successStudentData.fullName, successStudentData.department, successStudentData.branch);
    printWindow.document.write('body { font-family: "Cairo", sans-serif; direction: rtl; padding: 40px; text-align: center; color: #333; }');
    printWindow.document.write('.receipt-card { border: 2px solid #751214; padding: 30px; border-radius: 15px; max-width: 600px; margin: auto; box-shadow: 0 0 10px rgba(0,0,0,0.1); }');
    printWindow.document.write('.logo { max-width: 100px; margin-bottom: 15px; }');
    printWindow.document.write('h2 { color: #751214; margin-bottom: 5px; }');
    printWindow.document.write('.info-row { display: flex; justify-content: space-between; margin: 15px 0; border-bottom: 1px solid #eee; padding-bottom: 8px; font-size: 16px; }');
    printWindow.document.write('.label { font-weight: bold; color: #555; }');
    printWindow.document.write('.value { color: #111; }');
    printWindow.document.write('<html><head><title>سند تسجيل - كلية سماء المتميزين</title>');
    printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">');
    printWindow.document.write('<div class="receipt-card">');
    printWindow.document.write('<h2>كلية سماء المتميزين</h2>');
    printWindow.document.write('<p style="margin-top:0;color:#777;font-size:14px;">للعلوم الصحية والتكنولوجيا</p>');
    printWindow.document.write('<h3 style="margin:25px 0; border-bottom: 2px solid #751214; padding-bottom: 10px;">بطاقة التسجيل الأولي</h3>');
    printWindow.document.write('h2 { color: #751214; margin-bottom: 5px; }');
    printWindow.document.write('<div class="info-row"><span class="label">الاسم رباعي:</span><span class="value">' + fullName + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">الرقم الجامعي المؤقت:</span><span class="value" style="font-weight:bold;color:#751214;">' + studentId + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">القسم/التخصص:</span><span class="value">' + dept + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">الفرع:</span><span class="value">' + branch + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">تاريخ التسجيل:</span><span class="value">' + new Date().toLocaleDateString("ar-YE") + '</span></div>');
    printWindow.document.write('<div class="receipt-card">');
    printWindow.document.write('<h2>كلية سماء المتميزين</h2>');
    printWindow.document.write('الرجاء إيداع رسوم التسجيل (شامل البطاقة + الأنشطة) بمبلغ 30,000 ر.ي لحساب الكلية <strong>3007722396</strong> أو <strong>3086295309</strong> لدى بنك الكريمي للتمويل الأصغر الإسلامي، وتسليم الإيصال للقبول النهائي.');
    printWindow.document.write('<h3 style="margin:25px 0; border-bottom: 2px solid #751214; padding-bottom: 10px;">بطاقة التسجيل الأولي</h3>');
        document.getElementById("tabStep2").style.color = (step === 2) ? "#751214" : "#000";
    printWindow.document.write('<div class="info-row"><span class="label">الاسم رباعي:</span><span class="value">' + fullName + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">الرقم الجامعي المؤقت:</span><span class="value" style="font-weight:bold;color:#751214;">' + studentId + '</span></div>');
    printWindow.document.write('<div class="info-row"><span class="label">القسم/التخصص:</span><span class="value">' + dept + '</span></div>');
        // تحديث دوائر الخطوات السفلية (1 - 2 - 3)
    printWindow.document.write('<div class="info-row"><span class="label">تاريخ التسجيل:</span><span class="value">' + new Date().toLocaleDateString("ar-YE") + '</span></div>');
        for (var i = 1; i <= 3; i++) {
            var circle = document.getElementById("circle" + i);
    printWindow.document.write('الرجاء إيداع رسوم التسجيل (شامل البطاقة + الأنشطة) بمبلغ 30,000 ر.ي لحساب الكلية <strong>3007722396</strong> أو <strong>3086295309</strong> لدى بنك الكريمي للتمويل الأصغر الإسلامي، وتسليم الإيصال للقبول النهائي.');
        document.getElementById("enrollWizardContainer").style.display = "none";
                    circle.style.background = "#751214";
    printWindow.document.write('<script>window.onload = function() { window.print(); window.onafterprint = function() { window.close(); }; }<\/script>');
    document.getElementById("successModal").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
                }
        // إخفاء خيارات الخطوة الرابعة الخارجية
        document.getElementById("step4ExtraOptions").style.display = "none";
        document.getElementById("enrollStep1Container").style.display = "block";
        document.getElementById("enrollWizardContainer").style.display = "none";
        if (step === 3) validateStep3();
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
    var printWindow = window.open('', '_blank');
        document.getElementById("step1").style.display = "none";
    var days = ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
<!-- ===== الفوتر ===== -->
<footer style="margin-top: 50px;">
    <!-- الجزء العلوي للفوتر (عنابي) -->
    <div style="background: #751214; color: white; padding: 60px 20px 140px; text-align: center; position: relative;">
        <div style="margin: 0 auto 35px; max-width: 850px; font-family: 'Cairo', sans-serif;">
            <h2 style="font-size: 22px; font-weight: 800; color: #ffd700; margin: 0 0 12px 0; font-family: 'Cairo', sans-serif; letter-spacing: 0.5px;">
                كلية سماء المتميزين للعلوم الصحية والتكنولوجيا
            </h2>
            <p style="line-height: 2; font-size: 14.5px; opacity: 0.9; color: #f7fafc; margin: 0;">
                هي مؤسسة تعليمية رائدة مرخصة رسمياً من وزارة التعليم العالي والبحث العلمي ووزارة الصحة العامة والسكان، تقدم برامج أكاديمية متميزة لبناء جيل مبدع ومؤهل تكنولوجياً وطبياً.
            </p>
        </div>
        
        <!-- خط فاصل خفيف -->
        <div style="width: 100%; max-width: 600px; height: 1px; background: rgba(255, 255, 255, 0.15); margin: 30px auto;"></div>

        <!-- تواصل معنا -->
        <h3 style="color: white; font-size: 19px; font-weight: bold; margin: 0 0 25px 0; font-family: 'Cairo', sans-serif;">تواصل معنا</h3>
        
        <div style="display: flex; flex-direction: column; align-items: center; gap: 15px; font-size: 14px; line-height: 1.8; color: #f7fafc; max-width: 900px; margin: 0 auto; font-family: 'Cairo', sans-serif;">
            <!-- المركز الرئيسي -->
            <div style="text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; direction: rtl; margin-bottom: 5px; flex-wrap: wrap;">
                    <span style="display: inline-flex; align-items: center; gap: 6px; color: #ffd700; font-weight: bold;">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        المركز الرئيسي:
                    </span>
                    <span>دمنة خدير - شارع شمعة، خلف سوق الناشري</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px; direction: rtl; font-size: 13.5px; opacity: 0.9; flex-wrap: wrap;">
                    <span style="color: #ffd700; font-weight: bold; margin-left: 5px;">أرقام التواصل:</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:04323058" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">04-323058</a>
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align: middle;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        <a href="tel:770821112" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">770821112</a> - 
                        <a href="tel:733045299" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">733045299</a> - 
                        <a href="tel:736863982" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">736863982</a>
                    </span>
                </div>
            </div>
            
            <div style="width: 100%; max-width: 300px; height: 1px; background: rgba(255, 255, 255, 0.08); margin: 8px auto;"></div>

            <!-- فرع الراهدة -->
            <div style="text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; direction: rtl; margin-bottom: 5px; flex-wrap: wrap;">
                    <span style="display: inline-flex; align-items: center; gap: 6px; color: #ffd700; font-weight: bold;">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        فرع الراهدة:
                    </span>
                    <span>طريق عدن - مدخل حي الجنوبيين - مستوصف ابن سينا سابقاً</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px; direction: rtl; font-size: 13.5px; opacity: 0.9; flex-wrap: wrap;">
                    <span style="color: #ffd700; font-weight: bold; margin-left: 5px;">أرقام التواصل:</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:04323058" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">04-323058</a>
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align: middle;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        <a href="tel:770821112" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">770821112</a> - 
                        <a href="tel:733045299" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">733045299</a> - 
                        <a href="tel:736863982" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">736863982</a>
                    </span>
                </div>
            </div>

            <!-- البريد الإلكتروني -->
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; direction: rtl;">
                <span style="display: inline-flex; align-items: center; gap: 6px; color: #ffd700; font-weight: bold;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    البريد الإلكتروني:
                </span>
                <a href="mailto:klytalmtmyzyn@gmail.com" style="color: white; text-decoration: none; font-weight: bold; transition: color 0.3s;" onmouseover="this.style.color='#ffd700'" onmouseout="this.style.color='white'">klytalmtmyzyn@gmail.com</a>
            </div>
        </div>
        
        <!-- الشعار في المنتصف متداخل بين القسمين -->
        <div style="position: absolute; bottom: -70px; left: 50%; transform: translateX(-50%); width: 140px; height: 140px; border-radius: 12px; background: white; box-shadow: 0 8px 24px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: center; padding: 8px; border: 3px solid #ffd700; overflow: hidden; z-index: 10;">
            <img src="footer-logo.png?v=4" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="شعار الكلية">
        </div>
    </div>

    <!-- الجزء السفلي للفوتر (أبيض) -->
    <div style="background: white; color: #333; padding: 110px 20px 50px; text-align: center; border-top: 1px solid #eaeaea; font-family: 'Cairo', sans-serif;">
        <style>
            .footer-social-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 6px;
                border: 2px solid #751214;
                background: transparent;
                color: #751214;
                text-decoration: none;
                transition: all 0.3s ease;
                box-sizing: border-box;
            }
            .footer-social-link:hover {
                transform: translateY(-3px);
                color: white;
                background: #751214;
                box-shadow: 0 6px 12px rgba(117, 18, 20, 0.2);
            }
        </style>
        
        <!-- حقوق النشر وتصميم بلاتفورم -->
        <div style="font-size: 14px; color: #333; font-weight: bold; margin-bottom: 8px; font-family: 'Cairo', sans-serif;">
            حقوق النشر محفوظة لكلية سماء المتميزين &copy; 2026
        </div>
        <div style="font-size: 13px; color: #666; margin-bottom: 25px; font-family: 'Cairo', sans-serif; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <span>تصميم وبرمجة:</span>
            <img src="images/developer_logo.jpg" style="width: 45px; height: 45px; border-radius: 50%; vertical-align: middle; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" alt="سمية هزاع السامعي" title="سمية هزاع السامعي">
        </div>

        <!-- الروابط الاجتماعية -->
        <div style="display: flex; justify-content: center; gap: 15px;">
            <!-- WhatsApp -->
            <a href="https://whatsapp.com/channel/0029VawXrtb6WaKmdjWzpN2L" target="_blank" class="footer-social-link" title="واتساب">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
            </a>
            <!-- Telegram -->
            <a href="https://t.me/Samaalmutamaizeencollege" target="_blank" class="footer-social-link" title="تليجرام">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
            </a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100068909298876" target="_blank" class="footer-social-link" title="فيسبوك">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
        </div>
    </div>
</footer>

<button onclick="scrollToTop()" id="topBtn" style="display: none; position: fixed; bottom: 20px; left: 20px; z-index: 99; border: none; outline: none; background-color: #7d0f3f; color: white; cursor: pointer; padding: 12px 16px; border-radius: 50%; font-size: 16px; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.25);" onmouseover="this.style.background='#5a0a2c'; this.style.transform='translateY(-3px)';" onmouseout="this.style.background='#7d0f3f'; this.style.transform='none';">⬆</button>

<script>
window.onscroll = function() { scrollFunction() };
function scrollFunction() {
    var topBtn = document.getElementById("topBtn");
    if (topBtn) {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            topBtn.style.display = "block";
        } else {
            topBtn.style.display = "none";
        }
    }
}
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
<?php 
endif; // Closes if ($page != 'enroll')
endif; // Closes layout wrapper check (starts at line 1419)
?>

<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->
<div id="latestNewsDetailsModal" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.25); width:100%; max-width:700px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden; display:flex; flex-direction:column; max-height:90vh;">
        
        <!-- رأس المودال -->
        <div style="background:#0f3460; color:white; padding:20px; font-weight:bold; font-size:17px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #008080;">
            <span id="news_modal_badge" style="background:#008080; padding:2px 10px; border-radius:30px; font-size:12px; font-weight:bold; color:white; margin-left:10px;">أخرى</span>
            <span id="news_modal_title" style="flex-grow:1; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">تفاصيل الخبر</span>
            <button onclick="closeLatestNewsModal()" style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; margin-right:15px;">&times;</button>
        </div>
        
        <!-- جسم المودال -->
        <div style="padding:25px; overflow-y:auto; flex-grow:1;">
            
            <!-- معرض الصور والفيديو -->
            <div id="news_modal_media_gallery_wrapper" style="margin-bottom:20px;">
                <!-- شاشة العرض الرئيسية للوسائط -->
                <div id="news_modal_media_viewer" style="width:100%; height:260px; background:#f8fafc; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 15px rgba(0,0,0,0.05); position:relative;">
                    <!-- سيتم ملؤه ديناميكياً -->
                </div>
                
                <!-- شبكة مصغرات الصور (Thumbnails) -->
                <div id="news_modal_media_thumbnails" style="display:flex; justify-content:center; gap:10px; margin-top:12px; flex-wrap:wrap;">
                    <!-- سيتم توليدها ديناميكياً -->
                </div>
            </div>

            <!-- تفاصيل النشر والجهة -->
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:15px; margin-bottom:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <strong>تاريخ النشر:</strong>
                    <span id="news_modal_date" style="font-weight:bold; color:#0f3460;"></span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#008080" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <strong>الجهة الناشرة:</strong>
                    <span id="news_modal_publisher" style="font-weight:bold; color:#0f3460;">عمادة الكلية</span>
                </div>
            </div>

            <!-- محتوى الخبر -->
            <div style="margin-bottom:15px;">
                <h4 style="margin:0 0 10px 0; color:#0f3460; font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;"><i class="fa-regular fa-file-lines" style="margin-left: 5px;"></i> تفاصيل ومحاور الخبر:</h4>
                <p id="news_modal_desc" style="color:#4a5568; font-size:14px; line-height:1.7; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify; font-family:'Cairo', sans-serif;"></p>
                
                <!-- شريط مشاركة الخبر مع كافة الأيقونات -->
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:#0f3460; font-size:14px; margin-left:10px;"><i class="fa-solid fa-share-nodes" style="margin-left: 5px;"></i> مشاركة الخبر:</span>
                    
                    <!-- Facebook -->
                    <a id="news_share_fb" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#1877f2'; this.style.color='white'; this.style.borderColor='#1877f2';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        فيسبوك
                    </a>

                    <!-- Twitter / X -->
                    <a id="news_share_tw" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#000'; this.style.color='white'; this.style.borderColor='#000';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        تويتر
                    </a>

                    <!-- WhatsApp -->
                    <a id="news_share_wa" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#25d366'; this.style.color='white'; this.style.borderColor='#25d366';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 32 32" style="width:16px; height:16px;"><path fill="currentColor" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                        واتساب
                    </a>

                    <!-- Telegram -->
                    <a id="news_share_tg" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#0088cc'; this.style.color='white'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
                        تلجرام
                    </a>

                    <!-- Instagram -->
                    <button id="news_share_ig" onclick="copyNewsShareLink()" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#e1306c'; this.style.color='white'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0 3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        انستجرام
                    </button>

                    <!-- Copy Link -->
                    <button onclick="copyNewsShareLink()" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#008080'; this.style.color='white'; this.style.borderColor='#008080';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        نسخ الرابط
                    </button>
                </div>
            </div>
        </div>

        <!-- أسفل المودال -->
        <div style="background:#f8fafc; padding:15px 25px; display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #edf2f7;">
            <button onclick="closeLatestNewsModal()" class="modal-btn-primary" style="background:#008080; border-color:#008080;"><i class="fa-solid fa-house" style="margin-left: 5px;"></i> العودة للصفحة الرئيسية</button>
            <button onclick="closeLatestNewsModal()" class="modal-btn-secondary">إغلاق النافذة</button>
        </div>
    </div>
</div>

<script>
window.currentNewsShareUrl = "";
function copyNewsShareLink() {
    if (window.currentNewsShareUrl) {
        navigator.clipboard.writeText(window.currentNewsShareUrl).then(function() {
            alert("تم نسخ رابط الخبر بنجاح!");
        }).catch(function() {
            var tempInput = document.createElement("input");
            tempInput.value = window.currentNewsShareUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert("تم نسخ رابط الخبر بنجاح!");
        });
    }
}

function openLatestNewsModal(news) {
    document.getElementById('news_modal_title').innerText = news.title;
    document.getElementById('news_modal_badge').innerText = news.badge || 'أخرى';
    document.getElementById('news_modal_date').innerText = news.date;
    document.getElementById('news_modal_desc').innerText = news.content;
    
    var viewer = document.getElementById('news_modal_media_viewer');
    var thumbs = document.getElementById('news_modal_media_thumbnails');
    
    viewer.innerHTML = "";
    thumbs.innerHTML = "";
    
    var mediaList = [];
    
    // إضافة الصور
    if (news.images && Array.isArray(news.images)) {
        news.images.forEach(function(img, index) {
            mediaList.push({ type: 'image', url: img });
        });
    } else if (news.image && news.image.trim() !== '') {
        mediaList.push({ type: 'image', url: news.image });
    }
    
    // إضافة الفيديو (يدعم كلاً من يوتيوب وروابط الفيديوهات المحلية MP4)
    if (news.video_path && news.video_path.trim() !== '') {
        mediaList.push({ type: 'video', url: news.video_path });
    }
    
    if (mediaList.length === 0) {
        var fallbackGrad = news.gradient || "linear-gradient(135deg,#7d0f3f,#0f3460)";
        var fallbackIcon = news.icon || "🎉";
        viewer.innerHTML = `<div style="width:100%; height:100%; background:${fallbackGrad}; display:flex; align-items:center; justify-content:center; color:white; font-size:70px;">${fallbackIcon}</div>`;
        document.getElementById('news_modal_media_gallery_wrapper').style.display = 'none';
    } else {
        document.getElementById('news_modal_media_gallery_wrapper').style.display = 'block';
        
        mediaList.forEach(function(media, index) {
            var thumbBtn = document.createElement('div');
            thumbBtn.style.width = '70px';
            thumbBtn.style.height = '50px';
            thumbBtn.style.borderRadius = '8px';
            thumbBtn.style.overflow = 'hidden';
            thumbBtn.style.cursor = 'pointer';
            thumbBtn.style.border = '2px solid #e2e8f0';
            thumbBtn.style.transition = '0.2s';
            thumbBtn.style.position = 'relative';
            thumbBtn.style.background = '#000';
            
            if (media.type === 'image') {
                thumbBtn.innerHTML = `<img src="${media.url}" style="width:100%; height:100%; object-fit:cover;">`;
            } else {
                thumbBtn.innerHTML = `<div style="width:100%; height:100%; background:#0f3460; display:flex; align-items:center; justify-content:center; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                </div>`;
            }
            
            thumbBtn.onclick = function() {
                var children = thumbs.children;
                for (var i = 0; i < children.length; i++) {
                    children[i].style.borderColor = '#e2e8f0';
                    children[i].style.transform = 'none';
                }
                
                thumbBtn.style.borderColor = '#008080';
                thumbBtn.style.transform = 'scale(1.05)';
                
                if (media.type === 'image') {
                    viewer.innerHTML = `<img src="${media.url}" style="max-width:100%; max-height:100%; width:auto; height:auto; object-fit:contain; animation: fadeIn 0.3s ease-in-out;">
                    <a href="${media.url}" download="${media.url.substring(media.url.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        حفظ الصورة
                    </a>`;
                } else {
                    var videoUrl = media.url;
                    if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                        var match = videoUrl.match(regExp);
                        var videoId = (match && match[2].length == 11) ? match[2] : null;
                        
                        if (videoId) {
                            viewer.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1" style="width:100%; height:100%; border:none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <a href="https://ssyoutube.com/watch?v=${videoId}" target="_blank" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                حفظ الفيديو
                            </a>`;
                        } else {
                            viewer.innerHTML = `<div style="padding:20px; text-align:center; color:#e53e3e;">رابط يوتيوب غير صالح</div>`;
                        }
                    } else {
                        viewer.innerHTML = `<video src="${videoUrl}" controls autoplay style="width:100%; height:100%; background:#000;"></video>
                        <a href="${videoUrl}" download="${videoUrl.substring(videoUrl.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            حفظ الفيديو
                        </a>`;
                    }
                }
            };
            
            thumbs.appendChild(thumbBtn);
            
            if (index === 0) {
                thumbBtn.click();
            }
        });
    }
    
    var shareUrl = window.location.origin + window.location.pathname + '?p=latest_news&id=' + news.id;
    var shareTitle = news.title + ' - كلية سماء المتميزين';
    
    window.currentNewsShareUrl = shareUrl;
    
    document.getElementById('news_share_fb').href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    document.getElementById('news_share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('news_share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    document.getElementById('news_share_tg').href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    
    document.getElementById('latestNewsDetailsModal').style.display = 'flex';
}

function closeLatestNewsModal() {
    var viewer = document.getElementById('news_modal_media_viewer');
    if (viewer) viewer.innerHTML = "";
    document.getElementById('latestNewsDetailsModal').style.display = 'none';
}

window.addEventListener('click', function(e) {
    var modal = document.getElementById('latestNewsDetailsModal');
    if (e.target == modal) {
        closeLatestNewsModal();
    }
});
</script>
<script src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>