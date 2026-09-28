import os

filepath = r"c:\xampp1\htdocs\Sama_College\index.php"

with open(filepath, "r", encoding="utf-8") as f:
    content = f.read()

# Target tag to insert modal before
target = "</body>"

modal_html = """<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->
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
                
                <!-- شريط مشاركة الخبر -->
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
    
    if (news.images && Array.isArray(news.images)) {
        news.images.forEach(function(img, index) {
            mediaList.push({ type: 'image', url: img });
        });
    } else if (news.image && news.image.trim() !== '') {
        mediaList.push({ type: 'image', url: news.image });
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
            
            thumbBtn.innerHTML = `<img src="${media.url}" style="width:100%; height:100%; object-fit:cover;">`;
            
            thumbBtn.onclick = function() {
                var children = thumbs.children;
                for (var i = 0; i < children.length; i++) {
                    children[i].style.borderColor = '#e2e8f0';
                    children[i].style.transform = 'none';
                }
                
                thumbBtn.style.borderColor = '#008080';
                thumbBtn.style.transform = 'scale(1.05)';
                
                viewer.innerHTML = `<img src="${media.url}" style="max-width:100%; max-height:100%; width:auto; height:auto; object-fit:contain; animation: fadeIn 0.3s ease-in-out;">
                <a href="${media.url}" download="${media.url.substring(media.url.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#008080'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                    حفظ الصورة
                </a>`;
            };
            
            thumbs.appendChild(thumbBtn);
            
            if (index === 0) {
                thumbBtn.click();
            }
        });
    }
    
    var shareUrl = window.location.origin + window.location.pathname + '?p=latest_news&id=' + news.id;
    var shareTitle = news.title + ' - كلية سماء المتميزين';
    
    document.getElementById('news_share_fb').href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    document.getElementById('news_share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('news_share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    
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
"""

# Insert modal right before target </body>
if target in content:
    content = content.replace(target, modal_html + "\n" + target)
    with open(filepath, "w", encoding="utf-8") as f:
        f.write(content)
    print("Modal successfully injected!")
else:
    print("Error: Target </body> not found!")
