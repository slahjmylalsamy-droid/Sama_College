<!-- صفحة التقويم الأكاديمي والجامعي الرسمي -->
<?php if (!$is_logged_in): ?>
<div style="background:white; padding:40px; border-radius:20px; box-shadow:0 10px 40px rgba(0,0,0,0.05); overflow:hidden; direction:rtl; text-align:right; font-family:'Cairo', sans-serif; border-top: 5px solid #0d4748; margin-top:20px;">
<?php endif; ?>
    
    <div style="text-align:center; margin-bottom:35px; position:relative;">
        <h2 style="color:#0d4748; margin:0 0 10px; font-size:26px; font-weight:bold; display:flex; align-items:center; justify-content:center; gap:10px;">
            📆 التقويم الأكاديمي للجامعة للعام 2026 / 2027 م
        </h2>
        <p style="color:#666; margin:0 auto; max-width:650px; font-size:15px; line-height:1.7;">الخطة الزمنية التفصيلية المعتمدة للأنشطة التعليمية، الاختبارات، والإجازات الرسمية للعام الدراسي.</p>
        <div style="width:70px; height:4px; background:#ffd700; margin:15px auto 0; border-radius:2px;"></div>
    </div>

    <!-- مفاتيح تبديل الفروع بتصميم زجاجي ممتاز وعصري -->
    <div style="display:flex; justify-content:center; align-items:center; gap:10px; margin:0 auto 30px; background:#f4f6f9; padding:6px; border-radius:12px; max-width:420px; box-shadow:inset 0 2px 4px rgba(0,0,0,0.03); direction:rtl;">
        <button id="branch-btn-main" onclick="switchBranch('main')" style="flex:1; padding:10px 20px; background:#0d4748; color:white; border:none; border-radius:8px; font-size:14px; font-weight:bold; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 4px 10px rgba(13,71,72,0.15); font-family:'Cairo',sans-serif;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            الفرع الرئيسي
        </button>
        <button id="branch-btn-rahdah" onclick="switchBranch('rahdah')" style="flex:1; padding:10px 20px; background:transparent; color:#555; border:none; border-radius:8px; font-size:14px; font-weight:bold; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; font-family:'Cairo',sans-serif;">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
            فرع الراهدة
        </button>
    </div>
    
    <!-- شريط الفلترة والأزرار التفاعلية للتقويم -->
    <div style="display:flex; flex-wrap:wrap; justify-content:space-between; align-items:center; gap:15px; margin-bottom:25px; border-bottom:1.5px solid #f4f6f8; padding-bottom:20px; direction:rtl;">
        <div style="display:flex; flex-wrap:wrap; gap:8px;" id="calendarFilters">
            <button onclick="filterCalendar('all')" class="cal-filter-btn active-btn" style="padding:8px 18px; background:#0d4748; color:white; border:none; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:all 0.2s; font-family:'Cairo',sans-serif;">الكل</button>
            <button onclick="filterCalendar('semester1')" class="cal-filter-btn" style="padding:8px 18px; background:#f4f6f9; color:#555; border:none; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:all 0.2s; font-family:'Cairo',sans-serif;">الفصل الأول</button>
            <button onclick="filterCalendar('semester2')" class="cal-filter-btn" style="padding:8px 18px; background:#f4f6f9; color:#555; border:none; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:all 0.2s; font-family:'Cairo',sans-serif;">الفصل الثاني</button>
            <button onclick="filterCalendar('exams')" class="cal-filter-btn" style="padding:8px 18px; background:#f4f6f9; color:#555; border:none; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:all 0.2s; font-family:'Cairo',sans-serif;">الاختبارات</button>
            <button onclick="filterCalendar('vacations')" class="cal-filter-btn" style="padding:8px 18px; background:#f4f6f9; color:#555; border:none; border-radius:8px; font-size:13px; font-weight:bold; cursor:pointer; transition:all 0.2s; font-family:'Cairo',sans-serif;">الإجازات والطلبات</button>
        </div>
        <div style="display:flex; gap:10px;">
            <button onclick="printAcademicCalendar()" style="background:#16a34a; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow: 0 4px 10px rgba(22,163,74,0.15); font-family:'Cairo',sans-serif;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#16a34a'; this.style.color='white'; this.style.transform='none';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 5px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة التقويم
            </button>
            <button onclick="saveCalendarAsPDF()" style="background:#0d4748; color:white; padding:10px 20px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:all 0.3s; box-shadow: 0 4px 10px rgba(13, 71, 72,0.15); font-family:'Cairo',sans-serif;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='#0d4748'; this.style.color='white'; this.style.transform='none';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 5px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
            </button>
        </div>
    </div>
    
    <!-- جدول التقويم الجامعي التفاعلي -->
    <div style="overflow-x:auto; direction:rtl;">
        <table style="width:100%; border-collapse:collapse; text-align:right; min-width:700px;" id="calendarTable">
            <thead>
                <tr style="background:#0d4748; color:white;">
                    <th style="padding:15px; width:35%; border-radius: 0 10px 10px 0;">الحدث / النشاط الأكاديمي</th>
                    <th style="padding:15px; width:20%;">التاريخ الهجري</th>
                    <th style="padding:15px; width:20%;">التاريخ الميلادي</th>
                    <th style="padding:15px; width:13%;">المدة / الحالة</th>
                    <th style="padding:15px; width:12%; border-radius: 10px 0 0 10px;">التصنيف</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $cal_res = mysqli_query($conn, "SELECT * FROM academic_calendar ORDER BY id ASC");
                while ($row = mysqli_fetch_assoc($cal_res)):
                    // Map category for filter compatibility
                    $cat_class = $row['category'];
                    
                    // Map category for label
                    $cat_label = "أخرى";
                    if (strpos($row['category'], 'semester1') !== false) {
                        $cat_label = "الفصل الأول";
                    } elseif (strpos($row['category'], 'semester2') !== false) {
                        $cat_label = "الفصل الثاني";
                    } elseif (strpos($row['category'], 'vacations') !== false) {
                        $cat_label = "الإجازات";
                    } elseif (strpos($row['category'], 'exams') !== false) {
                        $cat_label = "الاختبارات";
                    }
                    
                    // Map status color
                    $status_style = "color:#666; font-size:13px;";
                    if ($row['status'] == 'مكتمل') {
                        $status_style = "background:#d1e7dd; color:#0f5132; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:bold;";
                    } elseif ($row['status'] == 'نشط حالياً') {
                        $status_style = "background:#fff3cd; color:#664d03; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:bold;";
                    } elseif ($row['status'] == 'قريباً' || $row['status'] == 'إجازة رسمية' || strpos($row['status'], 'يوم') !== false || strpos($row['status'], 'أيام') !== false) {
                        $status_style = "background:#e2e3e5; color:#41464b; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:bold;";
                        if ($row['status'] == 'إجازة رسمية') {
                            $status_style = "background:#e8f4fd; color:#0f5132; padding:3px 10px; border-radius:20px; font-size:12px; font-weight:bold;";
                        } elseif (strpos($row['status'], 'يوم') !== false || strpos($row['status'], 'أيام') !== false) {
                            $status_style = "color:#666; font-size:13px;";
                        }
                    }
                ?>
                <tr class="cal-row <?php echo htmlspecialchars($cat_class); ?>" data-branch="<?php echo htmlspecialchars($row['branch']); ?>" style="border-bottom:1px solid #f0f0f0;">
                    <td style="padding:15px; font-weight:bold; color:#333;"><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td style="padding:15px; color:#555;"><?php echo htmlspecialchars($row['hijri_date']); ?></td>
                    <td style="padding:15px; color:#555;"><?php echo htmlspecialchars($row['event_date']); ?></td>
                    <td style="padding:15px;"><span style="<?php echo $status_style; ?>"><?php echo htmlspecialchars($row['status']); ?></span></td>
                    <td style="padding:15px; color:#666; font-size:13px;"><?php echo htmlspecialchars($cat_label); ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <!-- قسم مشاركة التقويم -->
    <div style="margin-top: 35px; padding-top: 25px; border-top: 1.5px solid #f4f6f8; text-align: center; direction: rtl;">
        <span style="font-size: 16px; font-weight: bold; color: #0d4748; display: inline-block; margin-left: 20px; vertical-align: middle; margin-bottom: 10px;">مشاركة الصفحة</span>
        <div style="display: inline-flex; justify-content: center; gap: 10px; flex-wrap: wrap; vertical-align: middle; margin-bottom: 10px;">
            <!-- فيسبوك -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #3b5998; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#f0f4f9'; this.style.borderColor='#3b5998';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                فيسبوك
            </a>
            <!-- تويتر -->
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('التقويم الأكاديمي الرسمي لكلية سماء المتميزين 2026/2027: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #1da1f2; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#f0f8ff'; this.style.borderColor='#1da1f2';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                تويتر
            </a>
            <!-- واتساب -->
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('التقويم الأكاديمي الرسمي لكلية سماء المتميزين للعام الجامعي 2026/2027: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #25d366; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#e8fced'; this.style.borderColor='#25d366';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
                واتساب
            </a>
            <!-- تيليجرام -->
            <a href="https://t.me/share/url?url=<?php echo urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('التقويم الأكاديمي الرسمي لكلية سماء المتميزين للعام الجامعي 2026/2027'); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #0088cc; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#e6f4fc'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M20.66 4.98l-2.76 13c-.15.68-.55.85-1.12.53l-4.2-3.1-2.03 1.95c-.22.22-.4.4-.83.4l.3-4.23 7.68-6.93c.33-.3-.07-.46-.5-.18L7.66 13.5l-4.1-1.28c-.9-.28-.9-.88.18-1.3L19.9 4.7c.75-.28 1.4.16 1.13 1.25z"/></svg>
                تيليجرام
            </a>
            <!-- انستجرام -->
            <a href="javascript:void(0);" onclick="shareInstagram()" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #e1306c; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#ecf4f4'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                انستجرام
            </a>
        </div>
        <div id="copyAlert" style="display: none; color: #16a34a; font-size: 13px; font-weight: bold; margin-top: 10px; transition: all 0.3s;">✓ تم نسخ رابط التقويم بنجاح!</div>
        
        <!-- زر العودة للصفحة الرئيسية -->
        <div style="margin-top: 30px;">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
        </div>
    </div>

<?php if (!$is_logged_in): ?>
</div>
<?php endif; ?>

<script>
    var currentBranch = 'main';
    var currentCategory = 'all';

    function updateCalendarFilters() {
        var rows = document.getElementsByClassName('cal-row');
        for (var i = 0; i < rows.length; i++) {
            var branchMatch = rows[i].getAttribute('data-branch') === currentBranch;
            var categoryMatch = currentCategory === 'all' || rows[i].classList.contains(currentCategory);
            
            if (branchMatch && categoryMatch) {
                rows[i].style.display = 'table-row';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    function filterCalendar(category) {
        currentCategory = category;
        var buttons = document.getElementsByClassName('cal-filter-btn');
        
        // تحديث ألوان أزرار الفلترة
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].style.background = '#f4f6f9';
            buttons[i].style.color = '#555';
            buttons[i].classList.remove('active-btn');
        }
        
        // تحديد الزر النشط المستهدف
        var targetBtn = event.currentTarget;
        if (targetBtn) {
            targetBtn.style.background = '#0d4748';
            targetBtn.style.color = 'white';
            targetBtn.classList.add('active-btn');
        }
        
        updateCalendarFilters();
    }
    
    function switchBranch(branch) {
        currentBranch = branch;
        
        var btnMain = document.getElementById('branch-btn-main');
        var btnRahdah = document.getElementById('branch-btn-rahdah');
        
        if (branch === 'main') {
            btnMain.style.background = '#0d4748';
            btnMain.style.color = 'white';
            btnMain.style.boxShadow = '0 4px 10px rgba(13,71,72,0.15)';
            
            btnRahdah.style.background = 'transparent';
            btnRahdah.style.color = '#555';
            btnRahdah.style.boxShadow = 'none';
        } else {
            btnRahdah.style.background = '#0d4748';
            btnRahdah.style.color = 'white';
            btnRahdah.style.boxShadow = '0 4px 10px rgba(13,71,72,0.15)';
            
            btnMain.style.background = 'transparent';
            btnMain.style.color = '#555';
            btnMain.style.boxShadow = 'none';
        }
        
        updateCalendarFilters();
    }
    
    function printAcademicCalendar() {
        var printWin = window.open('', '_blank');
        var branchText = currentBranch === 'main' ? 'الفرع الرئيسي' : 'فرع الراهدة';
        printWin.document.write('<html><head><title>التقويم الأكاديمي - كلية سماء المتميزين</title>');
        printWin.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">');
        printWin.document.write('<style>');
        printWin.document.write('body { font-family: "Cairo", sans-serif; direction: rtl; padding: 20px; background: #fff; -webkit-print-color-adjust: exact; print-color-adjust: exact; }');
        printWin.document.write('.header-title { text-align: center; margin-bottom: 12px; border-bottom: 2px solid #0d4748; padding-bottom: 8px; }');
        printWin.document.write('.header-title h1 { color: #0d4748; font-size: 19px; margin: 0 0 5px; font-weight: bold; }');
        printWin.document.write('.header-title p { color: #444; margin: 0; font-size: 12.5px; font-weight: bold; }');
        printWin.document.write('.cal-table { width: 100%; border-collapse: collapse; text-align: right; margin-top: 10px; }');
        printWin.document.write('.cal-table th { background: #0d4748; color: white; padding: 8px 12px; font-size: 12px; border: 1px solid #0d4748; }');
        printWin.document.write('.cal-table td { padding: 6px 12px; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; font-size: 11px; color: #333; }');
        printWin.document.write('@media print {');
        printWin.document.write('  body { padding: 0; background: none; margin: 8mm 12mm 8mm 12mm; }');
        printWin.document.write('  @page { size: A4; margin: 0; }');
        printWin.document.write('}');
        printWin.document.write('</style></head><body>');
        
        printWin.document.write('<div class="header-title">');
        printWin.document.write('<img src="images/logo.png" style="max-height: 80px; width: auto; display: block; margin: 0 auto 10px auto;" onerror="this.src=\'logo.png\';">');
        printWin.document.write('<h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>');
        printWin.document.write('<p>📆 التقويم الأكاديمي الرسمي للعام الجامعي 2026 / 2027 م - ' + branchText + '</p>');
        printWin.document.write('</div>');
        
        printWin.document.write('<table class="cal-table">');
        printWin.document.write('<thead><tr><th>الحدث / النشاط الأكاديمي</th><th>التاريخ الهجري</th><th>التاريخ الميلادي</th><th>المدة / الحالة</th><th>التصنيف</th></tr></thead>');
        printWin.document.write('<tbody>');
        
        var rows = document.getElementById('calendarTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for(var i=0; i<rows.length; i++) {
            if(rows[i].style.display !== 'none') {
                printWin.document.write('<tr>' + rows[i].innerHTML + '</tr>');
            }
        }
        
        printWin.document.write('</tbody></table>');
        printWin.document.write('<script>window.onload = function() { window.print(); window.onafterprint = function() { setTimeout(function() { window.close(); }, 500); }; }<\/script>');
        printWin.document.write('</body></html>');
        printWin.document.close();
    }

    function saveCalendarAsPDF() {
        var printWin = window.open('', '_blank');
        var branchText = currentBranch === 'main' ? 'الفرع الرئيسي' : 'فرع الراهدة';
        var pdfTitle = 'التقويم_الأكاديمي_لكلية_سماء_المتميزين_2026_2027_' + (currentBranch === 'main' ? 'الفرع_الرئيسي' : 'فرع_الراهدة');
        printWin.document.write('<html><head><title>' + pdfTitle + '</title>');
        printWin.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">');
        printWin.document.write('<style>');
        printWin.document.write('body { font-family: "Cairo", sans-serif; direction: rtl; padding: 20px; background: #fff; -webkit-print-color-adjust: exact; print-color-adjust: exact; }');
        printWin.document.write('.header-title { text-align: center; margin-bottom: 12px; border-bottom: 2px solid #0d4748; padding-bottom: 8px; }');
        printWin.document.write('.header-title h1 { color: #0d4748; font-size: 19px; margin: 0 0 5px; font-weight: bold; }');
        printWin.document.write('.header-title p { color: #444; margin: 0; font-size: 12.5px; font-weight: bold; }');
        printWin.document.write('.cal-table { width: 100%; border-collapse: collapse; text-align: right; margin-top: 10px; }');
        printWin.document.write('.cal-table th { background: #0d4748; color: white; padding: 8px 12px; font-size: 12px; border: 1px solid #0d4748; }');
        printWin.document.write('.cal-table td { padding: 6px 12px; border-bottom: 1px solid #e2e8f0; border-left: 1px solid #e2e8f0; border-right: 1px solid #e2e8f0; font-size: 11px; color: #333; }');
        printWin.document.write('@media print {');
        printWin.document.write('  body { padding: 0; background: none; margin: 8mm 12mm 8mm 12mm; }');
        printWin.document.write('  @page { size: A4; margin: 0; }');
        printWin.document.write('}');
        printWin.document.write('</style></head><body>');
        
        printWin.document.write('<div class="header-title">');
        printWin.document.write('<img src="images/logo.png" style="max-height: 80px; width: auto; display: block; margin: 0 auto 10px auto;" onerror="this.src=\'logo.png\';">');
        printWin.document.write('<h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>');
        printWin.document.write('<p>📆 التقويم الأكاديمي الرسمي للعام الجامعي 2026 / 2027 م - ' + branchText + '</p>');
        printWin.document.write('</div>');
        
        printWin.document.write('<table class="cal-table">');
        printWin.document.write('<thead><tr><th>الحدث / النشاط الأكاديمي</th><th>التاريخ الهجري</th><th>التاريخ الميلادي</th><th>المدة / الحالة</th><th>التصنيف</th></tr></thead>');
        printWin.document.write('<tbody>');
        
        var rows = document.getElementById('calendarTable').getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        for(var i=0; i<rows.length; i++) {
            if(rows[i].style.display !== 'none') {
                printWin.document.write('<tr>' + rows[i].innerHTML + '</tr>');
            }
        }
        
        printWin.document.write('</tbody></table>');
        printWin.document.write('<script>window.onload = function() { window.print(); window.onafterprint = function() { setTimeout(function() { window.close(); }, 500); }; }<\/script>');
        printWin.document.write('</body></html>');
        printWin.document.close();
    }

    function copyCalendarLink() {
        var dummy = document.createElement('input'),
        text = window.location.href;
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand('copy');
        document.body.removeChild(dummy);
        
        var alertBox = document.getElementById('copyAlert');
        alertBox.style.display = 'block';
        setTimeout(function() {
            alertBox.style.display = 'none';
        }, 2000);
    }

    function shareInstagram() {
        copyCalendarLink();
        alert("✓ تم نسخ رابط التقويم بنجاح! يمكنك الآن لصقه ومشاركته في قصة (Story) أو رسائل إنستغرام الخاصة بك.");
    }
    
    // تشغيل التصفية عند تحميل الصفحة مباشرة
    document.addEventListener("DOMContentLoaded", function() {
        updateCalendarFilters();
    });
</script>
