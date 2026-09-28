<?php
// pages/announcements_public.php - صفحة الإعلانات الهامة العامة والطلابية
if (!defined('conn') && !isset($conn)) {
    include 'db_connect.php';
}

// استعلام جلب الإعلانات مرتبة من الأحدث للأقدم
$query = "SELECT a.*, u.full_name as author_name FROM announcements a LEFT JOIN users u ON a.created_by = u.id ORDER BY a.created_at DESC";
$res_ann = mysqli_query($conn, $query);

// تحضير مصفوفة جافا سكربت لتفاصيل المودال
$ann_list = [];
if ($res_ann && mysqli_num_rows($res_ann) > 0) {
    while ($row = mysqli_fetch_assoc($res_ann)) {
        $ann_list[] = [
            'id' => $row['id'],
            'title' => $row['title'],
            'content' => $row['content'],
            'created_at' => date('Y/m/d h:i A', strtotime($row['created_at'])),
            'author' => $row['author_name'] ?? 'إدارة الكلية',
            'image_path' => $row['image_path'],
            'image2_path' => $row['image2_path'],
            'image3_path' => $row['image3_path'],
            'video_path' => $row['video_path']
        ];
    }
    // إعادة تعيين مؤشر النتائج لعرضها في الـ PHP لاحقاً
    mysqli_data_seek($res_ann, 0);
}
?>

<div style="max-width:1000px; margin:30px auto; padding:0 20px; font-family:'Cairo', sans-serif; direction:rtl; text-align:right;">

    <!-- قسم الترويسة -->
    <div style="text-align:center; margin-bottom:40px;">
        <h2 style="color:#0d4748; font-size:28px; font-weight:800; margin:0 0 10px 0;"><i class="fa-solid fa-bullhorn" style="margin-left: 5px;"></i> إعلانات هامة وعاجلة</h2>
        <p style="color:#666; font-size:15px; max-width:600px; margin:0 auto; line-height:1.7;">تابع آخر التنويهات، ومواعيد التسجيل، وقرارات العمادة، وإعلانات النتائج الرسمية الصادرة عن إدارة كلية سماء المتميزين.</p>
    </div>

    <!-- شريط البحث والتصفية -->
    <div style="margin-bottom:30px; display:flex; justify-content:center;">
        <div style="position:relative; width:100%; max-width:550px;">
            <input type="text" id="announcementSearch" onkeyup="filterAnnouncements()" placeholder="🔍 ابحث عن إعلان معين..." style="width:100%; padding:12px 20px 12px 45px; border:1.5px solid #e2e8f0; border-radius:30px; font-size:14px; font-family:'Cairo', sans-serif; outline:none; transition:all 0.3s; box-shadow:0 4px 10px rgba(0,0,0,0.02); direction:rtl; text-align:right;" onfocus="this.style.borderColor='#1c7f7c'; this.style.boxShadow='0 4px 15px rgba(0, 128, 128, 0.08)';" onblur="this.style.borderColor='#e2e8f0'; this.style.boxShadow='0 4px 10px rgba(0,0,0,0.02)';">
        </div>
    </div>

    <!-- شبكة الإعلانات -->
    <div id="announcementsGrid" style="display:grid; grid-template-columns:1fr; gap:20px; margin-bottom:40px;">
        <?php 
        if ($res_ann && mysqli_num_rows($res_ann) > 0):
            while ($row = mysqli_fetch_assoc($res_ann)):
                $clean_content = strip_tags($row['content']);
                $snippet = mb_strimwidth($clean_content, 0, 180, '...');
                
                // التحقق من وجود مرفقات لعرض أيقونات توضيحية على الكرت
                $has_images = (!empty($row['image_path']) || !empty($row['image2_path']) || !empty($row['image3_path']));
                $has_video = !empty($row['video_path']);
        ?>
            <div class="ann-card" data-title="<?php echo htmlspecialchars($row['title']); ?>" data-content="<?php echo htmlspecialchars($clean_content); ?>" style="background:white; border-radius:16px; padding:25px; box-shadow:0 4px 15px rgba(0,0,0,0.04); border-right:5px solid #ffc107; transition:all 0.3s ease; display:flex; flex-direction:column; justify-content:space-between; gap:12px;" onmouseover="this.style.transform='translateY(-4px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.04)';">
                
                <div>
                    <!-- رأس الكرت -->
                    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:10px; margin-bottom:10px;">
                        <span style="background:#fff3cd; color:#856404; font-size:12px; font-weight:bold; padding:4px 12px; border-radius:30px; display:inline-flex; align-items:center; gap:5px;">
                            🔔 تنويه رسمي
                        </span>
                        <div style="display:inline-flex; align-items:center; gap:8px;">
                            <?php if ($has_images): ?>
                                <span title="يحتوي على معرض صور" style="background:#e0f2fe; color:#0369a1; font-size:11px; font-weight:bold; padding:3px 8px; border-radius:15px; display:inline-flex; align-items:center; gap:3px;">🖼️ صور</span>
                            <?php endif; ?>
                            <?php if ($has_video): ?>
                                <span title="يحتوي على فيديو ملحق" style="background:#fef2f2; color:#b91c1c; font-size:11px; font-weight:bold; padding:3px 8px; border-radius:15px; display:inline-flex; align-items:center; gap:3px;">🎥 فيديو</span>
                            <?php endif; ?>
                            <span style="color:#888; font-size:12.5px; display:inline-flex; align-items:center; gap:5px; font-weight:bold; margin-right:5px;">
                                📅 <?php echo date('Y/m/d', strtotime($row['created_at'])); ?>
                            </span>
                        </div>
                    </div>

                    <!-- العنوان والمحتوى المختصر -->
                    <h3 style="color:#0d4748; font-size:18px; font-weight:bold; margin:0 0 10px 0; line-height:1.5;"><?php echo htmlspecialchars($row['title']); ?></h3>
                    
                    <div style="display:flex; gap:15px; align-items:flex-start; flex-direction:row; flex-wrap:wrap; margin-bottom:5px;">
                        <?php if (!empty($row['image_path'])): ?>
                            <div style="width:100px; height:70px; border-radius:8px; overflow:hidden; border:1px solid #e2e8f0; flex-shrink:0;">
                                <img src="<?php echo htmlspecialchars($row['image_path']); ?>" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        <?php endif; ?>
                        <p style="color:#555; font-size:14px; line-height:1.7; margin:0; text-align:justify; flex:1; min-width:200px;"><?php echo htmlspecialchars($snippet); ?></p>
                    </div>
                </div>

                <!-- زر التفاصيل الكاملة -->
                <div style="display:flex; justify-content:space-between; align-items:center; border-top:1px solid #edf2f7; padding-top:15px; margin-top:5px; flex-wrap:wrap; gap:10px;">
                    <span style="font-size:12px; color:#777; font-weight:bold;">✍️ الناشر: <?php echo htmlspecialchars($row['author_name'] ?? 'إدارة الكلية'); ?></span>
                    <button type="button" onclick="openAnnModal(<?php echo $row['id']; ?>)" style="background:#0d4748; color:white; border:none; padding:7px 18px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; transition:all 0.3s; display:inline-flex; align-items:center; gap:6px;" onmouseover="this.style.background='#1c7f7c';" onmouseout="this.style.background='#0d4748';">
                        🔍 قراءة الإعلان والمرفقات
                    </button>
                </div>

            </div>
        <?php 
            endwhile; 
        else:
        ?>
            <div id="noAnnouncementsPlaceholder" style="background:#f8fafc; border:1.5px dashed #cbd5e1; padding:50px 20px; text-align:center; border-radius:16px; color:#777; font-size:16px;">
                📢 لا توجد أي إعلانات أو تنويهات منشورة حالياً.
            </div>
        <?php endif; ?>
    </div>

    <!-- زر العودة للرئيسية في أسفل الصفحة -->
    <div style="text-align:center; margin:50px auto 10px; padding-top:20px; border-top:1px solid #e2e8f0;">
        <a href="index.php" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>

</div>

<!-- مودال التفاصيل الكاملة للإعلان -->
<div id="annDetailsModal" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.25); width:100%; max-width:680px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden; display:flex; flex-direction:column; max-height:95vh; animation: fadeIn 0.3s ease-in-out;">
        
        <!-- رأس المودال -->
        <div style="background:#0d4748; color:white; padding:20px; font-weight:bold; font-size:17px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #ffc107;">
            <span style="background:#ffc107; padding:2px 12px; border-radius:30px; font-size:12px; font-weight:bold; color:#333; margin-left:10px;">إعلان هام</span>
            <span id="modal_ann_title" style="flex-grow:1; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">تفاصيل الإعلان الرسمي</span>
            <button onclick="closeAnnModal()" style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; margin-right:15px;">&times;</button>
        </div>
        
        <!-- جسم المودال -->
        <div style="padding:25px; overflow-y:auto; flex-grow:1;">
            
            <!-- قسم الوسائط المتعددة (معرض الصور والفيديو) -->
            <div id="modal_media_container" style="display:none; margin-bottom:20px;">
                <div style="background:#072928; border-radius:12px; height:320px; display:flex; align-items:center; justify-content:center; position:relative; overflow:hidden; border:1px solid #e2e8f0;">
                    <img id="modal_active_image" src="" style="max-width:100%; max-height:100%; width:auto; height:auto; object-fit:contain; display:none;">
                    <video id="modal_active_video" src="" controls style="max-width:100%; max-height:100%; display:none;"></video>
                    
                    <!-- زر حفظ وتنزيل الصورة -->
                    <a id="modal_download_btn" href="" download="" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:none; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        حفظ الصورة
                    </a>
                </div>
                <div id="modal_thumbnails" style="display:flex; gap:10px; overflow-x:auto; padding:8px 0 3px; margin-top:8px;">
                    <!-- مصغرات المعرض تضاف هنا ديناميكياً -->
                </div>
            </div>

            <!-- معلومات الإعلان -->
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:15px; margin-bottom:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <strong>تاريخ النشر:</strong>
                    <span id="modal_ann_date" style="font-weight:bold; color:#0d4748;"></span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffc107" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    <strong>الناشر المسؤول:</strong>
                    <span id="modal_ann_author" style="font-weight:bold; color:#0d4748;"></span>
                </div>
            </div>

            <div style="margin-bottom:15px;">
                <h4 style="margin:0 0 10px 0; color:#0d4748; font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;"><i class="fa-regular fa-file-lines" style="margin-left: 5px;"></i> بيان وتفاصيل الإعلان:</h4>
                <p id="modal_ann_content" style="color:#4a5568; font-size:14.5px; line-height:1.8; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify;"></p>
                
                <!-- شريط أزرار المشاركة -->
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:#0d4748; font-size:14px; margin-left:10px;"><i class="fa-solid fa-share-nodes" style="margin-left: 5px;"></i> مشاركة الإعلان:</span>
                    
                    <!-- Facebook -->
                    <a id="share_fb" href="" target="_blank" class="share-btn-item fb" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#1877f2'; this.style.color='white'; this.style.borderColor='#1877f2';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        فيسبوك
                    </a>

                    <!-- Twitter / X -->
                    <a id="share_tw" href="" target="_blank" class="share-btn-item tw" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#000'; this.style.color='white'; this.style.borderColor='#000';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        تويتر
                    </a>

                    <!-- WhatsApp -->
                    <a id="share_wa" href="" target="_blank" class="share-btn-item wa" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#25d366'; this.style.color='white'; this.style.borderColor='#25d366';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 32 32" style="width:16px; height:16px;"><path fill="currentColor" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                        واتساب
                    </a>

                    <!-- Telegram -->
                    <a id="share_tg" href="" target="_blank" class="share-btn-item tg" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#0088cc'; this.style.color='white'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
                        تلجرام
                    </a>

                    <!-- Instagram (Copies link and shows alert) -->
                    <button onclick="copyAnnShareLink()" class="share-btn-item insta" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#e1306c'; this.style.color='white'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        انستجرام
                    </button>

                    <!-- Copy Link -->
                    <button onclick="copyAnnShareLink()" class="share-btn-item copy" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#1c7f7c'; this.style.color='white'; this.style.borderColor='#1c7f7c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        نسخ الرابط
                    </button>
                </div>
            </div>
            
        </div>

        <!-- أسفل المودال -->
        <div style="background:#f8fafc; padding:15px 25px; display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #edf2f7;">
            <a href="index.php" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <button onclick="closeAnnModal()" class="modal-btn-secondary">إغلاق النافذة</button>
        </div>

    </div>
</div>

<style>
.modal-btn-primary {
    background: #1c7f7c;
    color: white !important;
    border: 1px solid #1c7f7c;
    padding: 8px 22px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: bold;
    text-decoration: none !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(0, 128, 128, 0.15);
}
.modal-btn-primary:hover {
    background: #0d4748;
    border-color: #0d4748;
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(13, 71, 72, 0.25);
}
.modal-btn-secondary {
    background: #0d4748;
    color: white !important;
    border: 1px solid #0d4748;
    padding: 8px 22px;
    border-radius: 8px;
    font-size: 13px;
    font-weight: bold;
    text-decoration: none !important;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    box-shadow: 0 2px 8px rgba(13, 71, 72, 0.15);
}
.modal-btn-secondary:hover {
    background: #085859;
    border-color: #085859;
    transform: translateY(-3px);
    box-shadow: 0 4px 12px rgba(8, 88, 89, 0.25);
}
@keyframes fadeIn {
    from { opacity: 0; transform: scale(0.98); }
    to { opacity: 1; transform: scale(1); }
}
</style>

<script>
// تمرير بيانات الإعلانات من PHP للجافا سكربت
const announcementsData = <?php echo json_encode($ann_list); ?>;

function openAnnModal(id) {
    const ann = announcementsData.find(a => a.id == id);
    if (!ann) return;
    
    document.getElementById('modal_ann_title').innerText = ann.title;
    document.getElementById('modal_ann_date').innerText = ann.created_at;
    document.getElementById('modal_ann_author').innerText = ann.author;
    document.getElementById('modal_ann_content').innerText = ann.content;
    
    // بناء وتشغيل معرض الميديا في المودال
    const activeImg = document.getElementById('modal_active_image');
    const activeVid = document.getElementById('modal_active_video');
    const downloadBtn = document.getElementById('modal_download_btn');
    const thumbContainer = document.getElementById('modal_thumbnails');
    
    activeImg.style.display = 'none';
    activeVid.style.display = 'none';
    downloadBtn.style.display = 'none';
    thumbContainer.innerHTML = '';
    
    let mediaItems = [];
    if (ann.image_path && ann.image_path.trim() !== '') mediaItems.push({type: 'image', url: ann.image_path.trim()});
    if (ann.image2_path && ann.image2_path.trim() !== '') mediaItems.push({type: 'image', url: ann.image2_path.trim()});
    if (ann.image3_path && ann.image3_path.trim() !== '') mediaItems.push({type: 'image', url: ann.image3_path.trim()});
    if (ann.video_path && ann.video_path.trim() !== '') mediaItems.push({type: 'video', url: ann.video_path.trim()});
    
    if (mediaItems.length > 0) {
        document.getElementById('modal_media_container').style.display = 'block';
        
        // إعداد المرفق الأول كنشط
        setAnnActiveMedia(mediaItems[0]);
        
        // توليد المصغرات
        mediaItems.forEach((item, index) => {
            const thumb = document.createElement('div');
            thumb.className = 'ann-thumb-item' + (index === 0 ? ' active' : '');
            thumb.style.cssText = "width:65px; height:50px; border-radius:8px; border:2.5px solid #e2e8f0; overflow:hidden; cursor:pointer; flex-shrink:0; transition:0.2s; position:relative; background:#000;";
            if (index === 0) thumb.style.borderColor = '#1c7f7c';
            
            if (item.type === 'image') {
                thumb.innerHTML = `<img src="${item.url}" style="width:100%; height:100%; object-fit:cover;">`;
            } else {
                thumb.innerHTML = `
                    <video src="${item.url}" style="width:100%; height:100%; object-fit:cover;"></video>
                    <div style="position:absolute; top:0; left:0; width:100%; height:100%; background:rgba(0,0,0,0.5); display:flex; align-items:center; justify-content:center;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="white"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                    </div>`;
            }
            
            thumb.onclick = function() {
                document.querySelectorAll('.ann-thumb-item').forEach(t => {
                    t.style.borderColor = '#e2e8f0';
                });
                thumb.style.borderColor = '#1c7f7c';
                setAnnActiveMedia(item);
            };
            
            thumbContainer.appendChild(thumb);
        });
    } else {
        document.getElementById('modal_media_container').style.display = 'none';
    }
    
    // إعداد روابط المشاركة
    const shareUrl = window.location.origin + window.location.pathname + '?p=announcements_public&ann_id=' + ann.id;
    const shareTitle = ann.title + ' - كلية سماء المتميزين';
    
    document.getElementById('share_fb').href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    document.getElementById('share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    document.getElementById('share_tg').href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    
    window.currentAnnShareUrl = shareUrl;
    
    document.getElementById('annDetailsModal').style.display = 'flex';
}

function setAnnActiveMedia(item) {
    const activeImg = document.getElementById('modal_active_image');
    const activeVid = document.getElementById('modal_active_video');
    const downloadBtn = document.getElementById('modal_download_btn');
    
    // إيقاف تشغيل الفيديو النشط حالياً إن وُجد
    activeVid.pause();
    
    // إعداد رابط تنزيل الملف ومحاذاة التنزيل التلقائي له
    downloadBtn.href = item.url;
    downloadBtn.download = item.url.substring(item.url.lastIndexOf('/') + 1);
    downloadBtn.style.display = 'inline-flex';
    
    if (item.type === 'image') {
        activeVid.style.display = 'none';
        activeImg.src = item.url;
        activeImg.style.display = 'block';
        
        // إعداد نص أيقونة التحميل للصورة
        downloadBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            حفظ الصورة
        `;
    } else {
        activeImg.style.display = 'none';
        activeVid.src = item.url;
        activeVid.style.display = 'block';
        
        // إعداد نص أيقونة التحميل للفيديو
        downloadBtn.innerHTML = `
            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
            حفظ الفيديو
        `;
    }
}

function closeAnnModal() {
    document.getElementById('modal_active_video').pause();
    document.getElementById('annDetailsModal').style.display = 'none';
}

window.onclick = function(e) {
    var modal = document.getElementById('annDetailsModal');
    if (e.target == modal) {
        closeAnnModal();
    }
}

function copyAnnShareLink() {
    if (window.currentAnnShareUrl) {
        navigator.clipboard.writeText(window.currentAnnShareUrl).then(function() {
            showToastMessage("تم نسخ رابط الإعلان بنجاح!");
        }).catch(function() {
            var tempInput = document.createElement("input");
            tempInput.value = window.currentAnnShareUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            showToastMessage("تم نسخ رابط الإعلان بنجاح!");
        });
    }
}

function showToastMessage(message) {
    var toast = document.getElementById('annToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'annToast';
        toast.style.cssText = "position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:#072928; color:white; padding:12px 24px; border-radius:8px; z-index:999999; font-family:'Cairo',sans-serif; font-size:14px; font-weight:bold; box-shadow:0 4px 15px rgba(0,0,0,0.3); border:1px solid #ffc107; transition:0.3s; opacity:0; pointer-events:none;";
        document.body.appendChild(toast);
    }
    toast.innerText = message;
    toast.style.opacity = '1';
    setTimeout(function() {
        toast.style.opacity = '0';
    }, 2500);
}

// فلترة البحث الفوري
function filterAnnouncements() {
    const query = document.getElementById('announcementSearch').value.toLowerCase().trim();
    const cards = document.getElementsByClassName('ann-card');
    let visibleCount = 0;
    
    for (let i = 0; i < cards.length; i++) {
        const title = cards[i].getAttribute('data-title').toLowerCase();
        const content = cards[i].getAttribute('data-content').toLowerCase();
        
        if (title.includes(query) || content.includes(query)) {
            cards[i].style.display = 'flex';
            visibleCount++;
        } else {
            cards[i].style.display = 'none';
        }
    }
    
    // إظهار تنويه في حال عدم وجود نتائج
    let placeholder = document.getElementById('noResultsPlaceholder');
    if (visibleCount === 0 && cards.length > 0) {
        if (!placeholder) {
            placeholder = document.createElement('div');
            placeholder.id = 'noResultsPlaceholder';
            placeholder.style.cssText = "background:#f8fafc; border:1.5px dashed #cbd5e1; padding:50px 20px; text-align:center; border-radius:16px; color:#777; font-size:16px; grid-column: 1/-1;";
            placeholder.innerHTML = "🔍 لم نعثر على أي نتائج تطابق بحثك.";
            document.getElementById('announcementsGrid').appendChild(placeholder);
        }
    } else {
        if (placeholder) {
            placeholder.remove();
        }
    }
}

// الكشف التلقائي عن معرف الإعلان في الرابط لفتح المودال عند التحميل
window.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var annId = urlParams.get('ann_id');
    if (annId) {
        openAnnModal(annId);
    }
});
</script>
