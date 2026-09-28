<?php
// pages/events.php - صفحة الفعاليات والأنشطة العامة والطلابية
if (!defined('conn') && !isset($conn)) {
    include 'db_connect.php';
}

// تصنيفات الفعاليات
$categories = [
    'الكل' => 'الكل',
    'حفلات ومناسبات' => 'حفلات ومناسبات',
    'ورش عمل' => 'ورش عمل',
    'أنشطة رياضية' => 'أنشطة رياضية',
    'علمية وثقافية' => 'علمية وثقافية',
    'أخرى' => 'أخرى'
];

$selected_cat = isset($_GET['cat']) ? mysqli_real_escape_string($conn, $_GET['cat']) : 'الكل';
if (!array_key_exists($selected_cat, $categories)) {
    $selected_cat = 'الكل';
}

// استعلام جلب الفعاليات
if ($selected_cat === 'الكل') {
    $query = "SELECT * FROM events ORDER BY event_date DESC";
} else {
    $query = "SELECT * FROM events WHERE category = '$selected_cat' ORDER BY event_date DESC";
}
$res_events = mysqli_query($conn, $query);
?>

<div style="max-width:1150px; margin:30px auto; padding:0 20px; font-family:'Cairo', sans-serif; direction:rtl; text-align:right;">
    
    <!-- قسم الترويسة -->
    <div style="text-align:center; margin-bottom:40px;">
        <h2 style="color:#0d4748; font-size:28px; font-weight:800; margin:0 0 10px 0;">📅 فعاليات وأنشطة كلية سماء المتميزين</h2>
        <p style="color:#666; font-size:15px; max-width:600px; margin:0 auto; line-height:1.7;">تابع الفعاليات الأكاديمية، والندوات العلمية، وورش العمل التدريبية، والأنشطة الطلابية والرياضية التي تنظمها الكلية على مدار العام.</p>
    </div>

    <!-- شريط تصفية التصنيفات -->
    <div style="display:flex; justify-content:center; gap:10px; margin-bottom:35px; flex-wrap:wrap;">
        <?php foreach ($categories as $key => $val): 
            $isActive = ($selected_cat === $key);
            $bg = $isActive ? 'linear-gradient(135deg, #0d4748, #1c7f7c)' : '#f8fafc';
            $color = $isActive ? 'white' : '#4a5568';
            $border = $isActive ? 'none' : '1.5px solid #e2e8f0';
        ?>
            <a href="?p=events&cat=<?php echo urlencode($key); ?>" style="text-decoration:none; display:inline-block; padding:10px 22px; border-radius:30px; font-size:14px; font-weight:bold; background:<?php echo $bg; ?>; color:<?php echo $color; ?>; border:<?php echo $border; ?>; box-shadow:0 4px 6px rgba(0,0,0,0.02); transition:all 0.3s;">
                <?php echo $val; ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- شبكة الفعاليات -->
    <div style="display:grid; grid-template-columns:repeat(auto-fill, minmax(320px, 1fr)); gap:25px; margin-bottom:40px;">
        <?php 
        if ($res_events && mysqli_num_rows($res_events) > 0):
            while ($row = mysqli_fetch_assoc($res_events)): 
                // تحديد لون الشارة بناءً على التصنيف
                $cat_color = "#1c7f7c";
                if ($row['category'] === 'حفلات ومناسبات') $cat_color = "#3b82f6";
                elseif ($row['category'] === 'ورش عمل') $cat_color = "#9333ea";
                elseif ($row['category'] === 'أنشطة رياضية') $cat_color = "#16a34a";
                elseif ($row['category'] === 'علمية وثقافية') $cat_color = "#eab308";
        ?>
            <div style="background:white; border-radius:16px; overflow:hidden; box-shadow:0 8px 25px rgba(0,0,0,0.04); display:flex; flex-direction:column; transition:0.3s; border:1px solid #f1f5f9;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 12px 35px rgba(0,0,0,0.08)';" onmouseout="this.style.transform='none'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.04)';">
                
                <!-- صورة الكرت للفعالية -->
                <?php if (!empty($row['image_path'])): ?>
                    <div style="width: 100%; background: #f8fafc; position:relative; border-bottom:1px solid #f1f5f9; display: flex; justify-content: center; align-items: center; overflow: hidden;">
                        <img src="<?php echo htmlspecialchars($row['image_path']); ?>" style="width:100%; height:auto; max-height:300px; display:block; object-fit:contain;" alt="">
                        <span style="position:absolute; bottom:12px; right:12px; background:<?php echo $cat_color; ?>; color:white; font-size:11px; font-weight:bold; padding:4px 10px; border-radius:30px;"><?php echo htmlspecialchars($row['category']); ?></span>
                    </div>
                <?php else: ?>
                    <div style="height:180px; background:linear-gradient(135deg, #0d4748 0%, <?php echo $cat_color; ?> 100%); position:relative; display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.15);">
                        <svg xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        <span style="position:absolute; bottom:12px; right:12px; background:<?php echo $cat_color; ?>; color:white; font-size:11px; font-weight:bold; padding:4px 10px; border-radius:30px;"><?php echo htmlspecialchars($row['category']); ?></span>
                    </div>
                <?php endif; ?>

                <!-- محتوى كرت الفعالية -->
                <div style="padding:20px; display:flex; flex-direction:column; flex-grow:1;">
                    <h3 style="color:#0d4748; font-size:17px; font-weight:bold; margin:0 0 10px 0; line-height:1.5;"><?php echo htmlspecialchars($row['title']); ?></h3>
                    
                    <p style="color:#666; font-size:13.5px; line-height:1.6; margin:0 0 20px 0; flex-grow:1;">
                        <?php 
                        $desc = htmlspecialchars($row['description']);
                        if (mb_strlen($desc) > 100) {
                            echo mb_substr($desc, 0, 95) . '...';
                        } else {
                            echo $desc;
                        }
                        ?>
                    </p>

                    <!-- تفاصيل الفعالية (التاريخ والموقع) -->
                    <div style="border-top:1px solid #f1f5f9; padding-top:15px; margin-bottom:15px; display:flex; flex-direction:column; gap:8px;">
                        <div style="display:flex; align-items:center; gap:8px; color:#4a5568; font-size:12.5px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                            <strong>التاريخ:</strong>
                            <span><?php echo date('Y/m/d', strtotime($row['event_date'])); ?></span>
                        </div>
                        <div style="display:flex; align-items:center; gap:8px; color:#4a5568; font-size:12.5px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                            <strong>الموقع:</strong>
                            <span><?php echo htmlspecialchars($row['location'] ?? 'حرم الكلية الرئيسي'); ?></span>
                        </div>
                    </div>

                    <button type="button" onclick="openEventModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" style="width:100%; background:#0d4748; color:white; border:none; padding:8px 12px; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background='#1c7f7c';" onmouseout="this.style.background='#0d4748';">
                        🔍 عرض التفاصيل الكاملة
                    </button>
                </div>

            </div>
        <?php 
            endwhile; 
        else:
        ?>
            <div style="grid-column:1/-1; background:#f8fafc; border:1.5px dashed #cbd5e1; padding:50px; text-align:center; border-radius:16px; color:#777; font-size:16px;">
                📢 لا توجد أي فعاليات أو أنشطة معلن عنها حالياً ضمن هذا التصنيف.
            </div>
        <?php endif; ?>
    </div>

    <!-- زر العودة للرئيسية في أسفل الصفحة -->
    <div style="text-align:center; margin:50px auto 10px; padding-top:20px; border-top:1px solid #e2e8f0;">
        <a href="index.php" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>

</div>

<!-- مودال التفاصيل الكاملة للفعالية -->
<div id="eventDetailsModal" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.25); width:100%; max-width:700px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden; display:flex; flex-direction:column; max-height:90vh;">
        
        <!-- رأس المودال -->
        <div style="background:#0d4748; color:white; padding:20px; font-weight:bold; font-size:17px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #1c7f7c;">
            <span id="modal_event_cat" style="background:#1c7f7c; padding:2px 10px; border-radius:30px; font-size:12px; font-weight:bold; color:white; margin-left:10px;"></span>
            <span id="modal_event_title" style="flex-grow:1; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">تفاصيل الفعالية الأكاديمية</span>
            <button onclick="closeEventModal()" style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; margin-right:15px;">&times;</button>
        </div>
        
        <!-- جسم المودال -->
        <div style="padding:25px; overflow-y:auto; flex-grow:1;">
            
            <!-- معرض الصور والفيديو -->
            <div id="modal_media_gallery_wrapper" style="margin-bottom:20px;">
                <!-- شاشة العرض الرئيسية للوسائط (صورة أو فيديو) -->
                <div id="modal_media_viewer" style="width:100%; height:260px; background:#f8fafc; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 15px rgba(0,0,0,0.05); position:relative;">
                    <!-- سيتم تعبئتها ديناميكياً عبر الجافا سكربت بالصورة النشطة أو مشغل الفيديو -->
                </div>
                
                <!-- شبكة مصغرات الصور والفيديو (Gallery Thumbnails) -->
                <div id="modal_media_thumbnails" style="display:flex; justify-content:center; gap:10px; margin-top:12px; flex-wrap:wrap;">
                    <!-- سيتم توليد أزرار الصور والفيديو ديناميكياً هنا -->
                </div>
            </div>

            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:15px; margin-bottom:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <strong>تاريخ الفعالية:</strong>
                    <span id="modal_event_date" style="font-weight:bold; color:#0d4748;"></span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <strong>الموقع الجغرافي:</strong>
                    <span id="modal_event_loc" style="font-weight:bold; color:#0d4748;"></span>
                </div>
            </div>

            <div style="margin-bottom:15px;">
                <h4 style="margin:0 0 10px 0; color:#0d4748; font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;"><i class="fa-regular fa-file-lines" style="margin-left: 5px;"></i> تفاصيل ومحاور الفعالية:</h4>
                <p id="modal_event_desc" style="color:#4a5568; font-size:14px; line-height:1.7; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify;"></p>
                
                <!-- شريط أزرار المشاركة -->
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:#0d4748; font-size:14px; margin-left:10px;"><i class="fa-solid fa-share-nodes" style="margin-left: 5px;"></i> مشاركة الفعالية:</span>
                    
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
                    <button onclick="copyEventShareLink()" class="share-btn-item insta" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#e1306c'; this.style.color='white'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        انستجرام
                    </button>

                    <!-- Copy Link -->
                    <button onclick="copyEventShareLink()" class="share-btn-item copy" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#1c7f7c'; this.style.color='white'; this.style.borderColor='#1c7f7c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        نسخ الرابط
                    </button>
                </div>
            </div>
            
        </div>

        <!-- أسفل المودال -->
        <div style="background:#f8fafc; padding:15px 25px; display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #edf2f7;">
            <a href="index.php" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            <button onclick="closeEventModal()" class="modal-btn-secondary">إغلاق النافذة</button>
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
function openEventModal(event) {
    document.getElementById('modal_event_title').innerText = event.title;
    document.getElementById('modal_event_cat').innerText = event.category;
    document.getElementById('modal_event_date').innerText = event.event_date;
    document.getElementById('modal_event_loc').innerText = event.location || 'حرم الكلية الرئيسي';
    document.getElementById('modal_event_desc').innerText = event.description;
    
    // إعداد معرض الوسائط (3 صور وفيديو)
    var viewer = document.getElementById('modal_media_viewer');
    var thumbs = document.getElementById('modal_media_thumbnails');
    
    viewer.innerHTML = "";
    thumbs.innerHTML = "";
    
    var mediaList = [];
    
    // إضافة الصورة الرئيسية الأولى
    if (event.image_path && event.image_path.trim() !== '') {
        mediaList.push({ type: 'image', url: event.image_path, title: 'الصورة 1' });
    }
    // إضافة الصورة الثانية
    if (event.image2_path && event.image2_path.trim() !== '') {
        mediaList.push({ type: 'image', url: event.image2_path, title: 'الصورة 2' });
    }
    // إضافة الصورة الثالثة
    if (event.image3_path && event.image3_path.trim() !== '') {
        mediaList.push({ type: 'image', url: event.image3_path, title: 'الصورة 3' });
    }
    // إضافة الفيديو
    if (event.video_path && event.video_path.trim() !== '') {
        mediaList.push({ type: 'video', url: event.video_path, title: 'فيديو الفعالية' });
    }
    
    if (mediaList.length === 0) {
        // لا توجد وسائط، عرض صورة افتراضية ملونة
        var cat_color = "#1c7f7c";
        if (event.category === 'حفلات ومناسبات') cat_color = "#3b82f6";
        else if (event.category === 'ورش عمل') cat_color = "#9333ea";
        else if (event.category === 'أنشطة رياضية') cat_color = "#16a34a";
        else if (event.category === 'علمية وثقافية') cat_color = "#eab308";
        
        viewer.innerHTML = `<div style="width:100%; height:100%; background:linear-gradient(135deg, #0d4748 0%, ${cat_color} 100%); display:flex; align-items:center; justify-content:center; color:rgba(255,255,255,0.25);">
            <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        </div>`;
        document.getElementById('modal_media_gallery_wrapper').style.display = 'none';
    } else {
        document.getElementById('modal_media_gallery_wrapper').style.display = 'block';
        
        mediaList.forEach(function(media, index) {
            // إنشاء زر مصغر
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
                thumbBtn.innerHTML = `<div style="width:100%; height:100%; background:#0d4748; display:flex; align-items:center; justify-content:center; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                </div>`;
            }
            
            thumbBtn.onclick = function() {
                // إلغاء تفعيل البقية
                var children = thumbs.children;
                for (var i = 0; i < children.length; i++) {
                    children[i].style.borderColor = '#e2e8f0';
                    children[i].style.transform = 'none';
                }
                
                // تفعيل هذا المصغر
                thumbBtn.style.borderColor = '#1c7f7c';
                thumbBtn.style.transform = 'scale(1.05)';
                
                // تحديث العارض الرئيسي
                if (media.type === 'image') {
                    viewer.innerHTML = `<img src="${media.url}" style="max-width:100%; max-height:100%; width:auto; height:auto; object-fit:contain; animation: fadeIn 0.3s ease-in-out;">
                    <a href="${media.url}" download="${media.url.substring(media.url.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        حفظ الصورة
                    </a>`;
                } else {
                    // عرض الفيديو
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
                        <a href="${videoUrl}" download="${videoUrl.substring(videoUrl.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            حفظ الفيديو
                        </a>`;
                    }
                }
            };
            
            thumbs.appendChild(thumbBtn);
            
            // تفعيل العنصر الأول افتراضياً
            if (index === 0) {
                thumbBtn.click();
            }
        });
    }
    
    // إعداد روابط مشاركة الفعالية
    var shareUrl = window.location.origin + window.location.pathname + '?p=events&event_id=' + event.id;
    var shareTitle = event.title + ' - كلية سماء المتميزين';
    
    document.getElementById('share_fb').href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    document.getElementById('share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('share_wa').href = 'https://api.whatsapp.com/send?text=encodeURIComponent' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    // WhatsApp direct send needs exact parameter format
    document.getElementById('share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    document.getElementById('share_tg').href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    
    window.currentEventShareUrl = shareUrl;
    
    document.getElementById('eventDetailsModal').style.display = 'flex';
}

function closeEventModal() {
    var viewer = document.getElementById('modal_media_viewer');
    viewer.innerHTML = ""; // إيقاف تشغيل الفيديو عند إغلاق المودال
    document.getElementById('eventDetailsModal').style.display = 'none';
}

window.onclick = function(e) {
    var modal = document.getElementById('eventDetailsModal');
    if (e.target == modal) {
        closeEventModal();
    }
}

function copyEventShareLink() {
    if (window.currentEventShareUrl) {
        navigator.clipboard.writeText(window.currentEventShareUrl).then(function() {
            showToastMessage("تم نسخ رابط الفعالية بنجاح!");
        }).catch(function() {
            var tempInput = document.createElement("input");
            tempInput.value = window.currentEventShareUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            showToastMessage("تم نسخ رابط الفعالية بنجاح!");
        });
    }
}

function showToastMessage(message) {
    var toast = document.getElementById('eventsToast');
    if (!toast) {
        toast = document.createElement('div');
        toast.id = 'eventsToast';
        toast.style.cssText = "position:fixed; bottom:30px; left:50%; transform:translateX(-50%); background:#072928; color:white; padding:12px 24px; border-radius:8px; z-index:999999; font-family:'Cairo',sans-serif; font-size:14px; font-weight:bold; box-shadow:0 4px 15px rgba(0,0,0,0.3); border:1px solid #1c7f7c; transition:0.3s; opacity:0; pointer-events:none;";
        document.body.appendChild(toast);
    }
    toast.innerText = message;
    toast.style.opacity = '1';
    setTimeout(function() {
        toast.style.opacity = '0';
    }, 2500);
}

// الكشف التلقائي عن معرف الفعالية في الرابط لفتح المودال عند التحميل
window.addEventListener('DOMContentLoaded', function() {
    var urlParams = new URLSearchParams(window.location.search);
    var eventId = urlParams.get('event_id');
    if (eventId) {
        var btns = document.querySelectorAll('button[onclick]');
        for (var i = 0; i < btns.length; i++) {
            var clickAttr = btns[i].getAttribute('onclick');
            if (clickAttr && clickAttr.indexOf('openEventModal') !== -1) {
                // We parse the object safely by checking index click
                var match = clickAttr.match(/openEventModal\((.*?)\)/);
                if (match) {
                    try {
                        var evData = JSON.parse(match[1]);
                        if (evData.id == eventId) {
                            openEventModal(evData);
                            break;
                        }
                    } catch(e) {}
                }
            }
        }
    }
});
</script>
