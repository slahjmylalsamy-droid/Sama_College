import os

path = r"c:\xampp1\htdocs\Sama_College\index.php"

with open(path, "r", encoding="utf-8") as f:
    lines = f.readlines()

print(f"Original index.php line count: {len(lines)}")

# Keep lines 1 to 2675 (index 0 to 2674)
keep_lines = lines[:2675]

footer_and_modal = """    printWindow.document.write('</body></html>');
    printWindow.document.close();
}
</script>
<?php 
endif; // Closes the page content switcher (which started at line 1604)

// Render global footer for public pages
if ($page != 'enroll'): // Only render footer if not on enroll page
?>
<!-- ===== الفوتر ===== -->
<footer style="background: linear-gradient(135deg, #0f3460, #08213f); color: white; padding: 40px 20px; margin-top: 50px; text-align: center; font-family: 'Cairo', sans-serif;">
    <div style="max-width: 1200px; margin: auto;">
        <h2 style="margin: 0 0 10px; font-size: 22px; font-weight: bold; color: white;">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h2>
        <p style="margin: 0 auto 25px; max-width: 700px; line-height: 1.8; font-size: 14px; opacity: 0.9; color: #cbd5e1;">مؤسسة تعليمية رائدة تسعى لإعداد كوادر متميزة في المجال الصحي والتقني وفق أحدث المعايير الأكاديمية.</p>
        
        <style>
            .footer-social-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.1);
                color: white;
                text-decoration: none;
                transition: all 0.3s ease;
                box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            }
            .footer-social-link:hover {
                transform: translateY(-3px);
                box-shadow: 0 6px 12px rgba(0,0,0,0.15);
            }
            .footer-social-link.whatsapp:hover { background: #25d366; }
            .footer-social-link.telegram:hover { background: #0088cc; }
            .footer-social-link.facebook:hover { background: #1877f2; }
        </style>
        <div style="display: flex; justify-content: center; gap: 15px; margin-bottom: 25px;">
            <!-- WhatsApp -->
            <a href="https://whatsapp.com/channel/0029VawXrtb6WaKmdjWzpN2L" target="_blank" class="footer-social-link whatsapp" title="واتساب">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
            </a>
            <!-- Telegram -->
            <a href="https://t.me/Samaalmutamaizeencollege" target="_blank" class="footer-social-link telegram" title="تليجرام">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
            </a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100068909298876" target="_blank" class="footer-social-link facebook" title="فيسبوك">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 20px; font-size: 13px; opacity: 0.8; color: #94a3b8;">
            &copy; <?php echo date('Y'); ?> كلية سماء المتميزين. جميع الحقوق محفوظة.
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
                <h4 style="margin:0 0 10px 0; color:#0f3460; font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;">📝 تفاصيل ومحاور الخبر:</h4>
                <p id="news_modal_desc" style="color:#4a5568; font-size:14px; line-height:1.7; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify; font-family:'Cairo', sans-serif;"></p>
                
                <!-- شريط مشاركة الخبر مع كافة الأيقونات -->
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:#0f3460; font-size:14px; margin-left:10px;">📢 مشاركة الخبر:</span>
                    
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
            <button onclick="closeLatestNewsModal()" class="modal-btn-primary" style="background:#008080; border-color:#008080;">🏠 العودة للصفحة الرئيسية</button>
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
                            viewer.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1" style="width:100%; height:100%; border:none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>`;
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
</body>
</html>"""

# Join the first 2675 lines with the footer and modal code
new_content = "".join(keep_lines) + footer_and_modal

with open(path, "w", encoding="utf-8") as f:
    f.write(new_content)

print("Applied correct fix to index.php successfully!")
