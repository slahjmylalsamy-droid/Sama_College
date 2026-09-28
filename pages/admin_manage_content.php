<?php
// pages/admin_manage_content.php - لوحة تعديل محتوى صفحات ومكونات الموقع بالكامل (CMS)
if (!defined('INCLUDED_FROM_INDEX') && !isset($is_admin)) {
    die("Direct access not allowed.");
}

$msg = "";
$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'slider';

// 1. معالجة تحديث السلايدر والشعار
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_slider_settings'])) {
    // تحديث إعدادات السلايدر في قاعدة البيانات
    $settings = [
        'slide1_image' => $_POST['slide1_image'],
        'slide1_title' => $_POST['slide1_title'],
        'slide1_text' => $_POST['slide1_text'],
        
        'slide2_image' => $_POST['slide2_image'],
        'slide2_title' => $_POST['slide2_title'],
        'slide2_text' => $_POST['slide2_text'],
        
        'slide3_image' => $_POST['slide3_image'],
        'slide3_title' => $_POST['slide3_title'],
        'slide3_text' => $_POST['slide3_text'],
        
        'logo_size' => $_POST['logo_size'],
        'footer_logo_size' => $_POST['footer_logo_size']
    ];
    
    $success = true;
    foreach ($settings as $key => $val) {
        $key = mysqli_real_escape_string($conn, $key);
        $val = mysqli_real_escape_string($conn, $val);
        $query = "INSERT INTO site_settings (setting_key, setting_value) 
                  VALUES ('$key', '$val') 
                  ON DUPLICATE KEY UPDATE setting_value = '$val'";
        if (!mysqli_query($conn, $query)) {
            $success = false;
        }
    }
    
    if ($success) {
        $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حفظ إعدادات السلايدر والشعار بنجاح!</div>';
    } else {
        $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ حدث خطأ أثناء الحفظ!</div>';
    }
}

// 2. معالجة تحديث محتوى الصفحات الفرعية الثابتة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_page_content'])) {
    $edit_page_key = mysqli_real_escape_string($conn, $_POST['edit_page_key']);
    $page_content = $_POST['page_content']; // نأخذ النص كاملاً مع الـ HTML
    $page_title = mysqli_real_escape_string($conn, $_POST['page_title']);
    
    $edit_page_key_db = mysqli_real_escape_string($conn, $edit_page_key);
    $page_content_db = mysqli_real_escape_string($conn, $page_content);
    
    // إذا قام بإفراغ النص، نحذفه من الجدول للعودة للصفحة الافتراضية
    if (empty(trim($page_content))) {
        $query = "DELETE FROM site_pages WHERE page_key = '$edit_page_key_db'";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم إفراغ الصفحة، وسيقوم الموقع الآن بالعودة لعرض الصفحة الافتراضية المنسقة مسبقاً!</div>';
        }
    } else {
        $query = "INSERT INTO site_pages (page_key, page_title, page_content) 
                  VALUES ('$edit_page_key_db', '$page_title', '$page_content_db') 
                  ON DUPLICATE KEY UPDATE page_content = '$page_content_db', page_title = '$page_title'";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حفظ محتوى صفحة (' . htmlspecialchars($_POST['page_title_raw']) . ') بنجاح ونشرها بالموقع!</div>';
        } else {
            $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء الحفظ: ' . mysqli_error($conn) . '</div>';
        }
    }
    $active_tab = 'pages';
}

// 3. معالجة عمليات التقويم الجامعي (إضافة، تعديل، حذف)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_calendar_event'])) {
    $event_id = intval($_POST['event_id']);
    $event_name = mysqli_real_escape_string($conn, $_POST['event_name']);
    $hijri_date = mysqli_real_escape_string($conn, $_POST['hijri_date']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $branch = mysqli_real_escape_string($conn, $_POST['branch']);
    
    if ($event_id > 0) {
        // تعديل
        $query = "UPDATE academic_calendar SET event_name='$event_name', hijri_date='$hijri_date', event_date='$event_date', status='$status', category='$category', branch='$branch' WHERE id=$event_id";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم تعديل الحدث بالتقويم بنجاح!</div>';
        }
    } else {
        // إضافة
        $query = "INSERT INTO academic_calendar (event_name, hijri_date, event_date, status, category, branch) VALUES ('$event_name', '$hijri_date', '$event_date', '$status', '$category', '$branch')";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم إضافة الحدث الجديد للتقويم الجامعي!</div>';
        }
    }
    $active_tab = 'calendar';
}

if (isset($_GET['delete_calendar_event'])) {
    $delete_id = intval($_GET['delete_calendar_event']);
    $query = "DELETE FROM academic_calendar WHERE id=$delete_id";
    if (mysqli_query($conn, $query)) {
        $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حذف الحدث من التقويم الجامعي بنجاح!</div>';
    }
    $active_tab = 'calendar';
}

// 4. معالجة الرد على الشكاوى والمقترحات وحذفها
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['reply_complaint'])) {
    $complaint_id = intval($_POST['complaint_id']);
    $admin_response = mysqli_real_escape_string($conn, $_POST['admin_response']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    
    $query = "UPDATE complaints SET admin_response='$admin_response', status='$status' WHERE id=$complaint_id";
    if (mysqli_query($conn, $query)) {
        $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم تسجيل الرد الإداري وتحديث حالة الطلب بنجاح!</div>';
    } else {
        $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء تحديث الرد: ' . mysqli_error($conn) . '</div>';
    }
    $active_tab = 'complaints';
}

if (isset($_GET['delete_complaint'])) {
    $delete_id = intval($_GET['delete_complaint']);
    $query = "DELETE FROM complaints WHERE id=$delete_id";
    if (mysqli_query($conn, $query)) {
        $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حذف الشكوى/المقترح بنجاح من قاعدة البيانات!</div>';
    }
    $active_tab = 'complaints';
}

// 6. معالجة عمليات الفعاليات والأنشطة (إضافة، تعديل، حذف)
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_event'])) {
    $event_id = intval($_POST['event_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $event_date = mysqli_real_escape_string($conn, $_POST['event_date']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $image_path = mysqli_real_escape_string($conn, $_POST['image_path']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    
    if ($event_id > 0) {
        // تعديل
        $query = "UPDATE events SET title='$title', description='$description', event_date='$event_date', location='$location', image_path='$image_path', category='$category' WHERE id=$event_id";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم تعديل الفعالية/النشاط بنجاح!</div>';
        } else {
            $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء التعديل: ' . mysqli_error($conn) . '</div>';
        }
    } else {
        // إضافة
        $query = "INSERT INTO events (title, description, event_date, location, image_path, category) VALUES ('$title', '$description', '$event_date', '$location', '$image_path', '$category')";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم إضافة الفعالية/النشاط الجديد بنجاح!</div>';
        } else {
            $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء الإضافة: ' . mysqli_error($conn) . '</div>';
        }
    }
    $active_tab = 'events';
}

if (isset($_GET['delete_event'])) {
    $delete_id = intval($_GET['delete_event']);
    $query = "DELETE FROM events WHERE id=$delete_id";
    if (mysqli_query($conn, $query)) {
        $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حذف الفعالية/النشاط بنجاح!</div>';
    }
    $active_tab = 'events';
}

// 5. قائمة الصفحات الفرعية القابلة للتعديل
$editable_pages = [
    'about' => 'عن الكلية',
    'president' => 'عميد الكلية',
    'vision' => 'الرؤية والرسالة',
    'goals' => 'الأهداف والقيم',
    'strategy' => 'الخطة الاستراتيجية',
    'students' => 'شؤون الطلاب',
    'research' => 'الدراسات والبحوث',
    'library' => 'المكتبة الأكاديمية',
    'jobs' => 'فرص العمل والوظائف',
    'contact' => 'اتصل بنا'
];

$selected_page_key = isset($_GET['edit_page']) ? $_GET['edit_page'] : 'about';
if (!array_key_exists($selected_page_key, $editable_pages)) {
    $selected_page_key = 'about';
}

// جلب المحتوى الحالي للصفحة المحددة
$db_page_res = mysqli_query($conn, "SELECT page_content FROM site_pages WHERE page_key = '$selected_page_key'");
$current_page_content = "";
if ($db_page_res && mysqli_num_rows($db_page_res) > 0) {
    $row = mysqli_fetch_assoc($db_page_res);
    $current_page_content = $row['page_content'];
}
?>

<?php echo $msg; ?>

<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);margin-bottom:25px;direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <h2 style="color:#0d4748;margin-top:0;display:flex;align-items:center;gap:10px;">📝 إدارة وتعديل محتوى صفحات الموقع (CMS)</h2>
    <p style="color:#666;">بصفتك مديراً للنظام، يمكنك تعديل أي جزء من الموقع بنفسك؛ سواء السلايدر الرئيسي بالواجهة، حجم الشعار، أو استبدال محتوى أي صفحة فرعية بالكامل بنصوص وتنسيقات HTML مخصصة.</p>
    
    <!-- شريط التبويبات -->
        <a href="?p=manage_content&tab=slider" style="padding:10px 20px;text-decoration:none;font-weight:bold;color:<?php echo $active_tab=='slider' ? '#0d4748':'#666'; ?>;border-bottom:3px solid <?php echo $active_tab=='slider' ? '#ffd700':'transparent'; ?>;">🖼️ السلايدر والشعار (الرئيسية)</a>
        <a href="?p=manage_content&tab=pages" style="padding:10px 20px;text-decoration:none;font-weight:bold;color:<?php echo $active_tab=='pages' ? '#0d4748':'#666'; ?>;border-bottom:3px solid <?php echo $active_tab=='pages' ? '#ffd700':'transparent'; ?>;">📄 محتوى الصفحات الفرعية</a>
        <a href="?p=manage_content&tab=calendar" style="padding:10px 20px;text-decoration:none;font-weight:bold;color:<?php echo $active_tab=='calendar' ? '#0d4748':'#666'; ?>;border-bottom:3px solid <?php echo $active_tab=='calendar' ? '#ffd700':'transparent'; ?>;">📆 التقويم الجامعي</a>
        <a href="?p=manage_content&tab=complaints" style="padding:10px 20px;text-decoration:none;font-weight:bold;color:<?php echo $active_tab=='complaints' ? '#0d4748':'#666'; ?>;border-bottom:3px solid <?php echo $active_tab=='complaints' ? '#ffd700':'transparent'; ?>;">📩 الشكاوى والمقترحات</a>
        <a href="?p=manage_content&tab=events" style="padding:10px 20px;text-decoration:none;font-weight:bold;color:<?php echo $active_tab=='events' ? '#0d4748':'#666'; ?>;border-bottom:3px solid <?php echo $active_tab=='events' ? '#ffd700':'transparent'; ?>;">📅 الفعاليات والأنشطة</a>
    </div>
</div>

<?php if ($active_tab == 'slider'): ?>
<!-- تبويب السلايدر -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <form method="POST">
        <h3 style="color:#0d4748;border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:20px;">🖼️ تعديل السلايدر الدوار بالصفحة الرئيسية</h3>
        
        <!-- الشريحة الأولى -->
        <div style="background:#f9fbfd;padding:20px;border-radius:10px;border-right:4px solid #0d4748;margin-bottom:20px;">
            <h4 style="margin-top:0;color:#0d4748;">الشريحة الأولى (Slide 1)</h4>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:10px;">
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">العنوان الرئيسي</label>
                    <input type="text" name="slide1_title" value="<?php echo htmlspecialchars(get_setting('slide1_title', 'مؤسسة كلية سماء المتميزين')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">رابط الصورة (Image URL)</label>
                    <input type="text" name="slide1_image" value="<?php echo htmlspecialchars(get_setting('slide1_image', 'images/slider_campus.jpg?v=3')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">الوصف والنص التعريفي</label>
                <textarea name="slide1_text" required rows="2" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;"><?php echo htmlspecialchars(get_setting('slide1_text', 'كلية سماء المتميزين هي مؤسسة تعليمية رائدة تسعى لبناء جيل مبدع ومتميز وتقديم برامج أكاديمية حديثة.')); ?></textarea>
            </div>
        </div>

        <!-- الشريحة الثانية -->
        <div style="background:#fefdf9;padding:20px;border-radius:10px;border-right:4px solid #085859;margin-bottom:20px;">
            <h4 style="margin-top:0;color:#085859;">الشريحة الثانية (Slide 2)</h4>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:10px;">
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">العنوان الرئيسي</label>
                    <input type="text" name="slide2_title" value="<?php echo htmlspecialchars(get_setting('slide2_title', 'رسالتنا')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">رابط الصورة (Image URL)</label>
                    <input type="text" name="slide2_image" value="<?php echo htmlspecialchars(get_setting('slide2_image', 'images/slider_mission.jpg?v=3')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">الوصف والنص التعريفي</label>
                <textarea name="slide2_text" required rows="2" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;"><?php echo htmlspecialchars(get_setting('slide2_text', 'نلتزم بتقديم تعليم نوعي في بيئة محفزة للإبداع وتنمية المهارات العملية والمهنية.')); ?></textarea>
            </div>
        </div>

        <!-- الشريحة الثالثة -->
        <div style="background:#f6fbf8;padding:20px;border-radius:10px;border-right:4px solid #10b981;margin-bottom:30px;">
            <h4 style="margin-top:0;color:#10b981;">الشريحة الثالثة (Slide 3)</h4>
            <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:10px;">
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">العنوان الرئيسي</label>
                    <input type="text" name="slide3_title" value="<?php echo htmlspecialchars(get_setting('slide3_title', 'رؤيتنا')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">رابط الصورة (Image URL)</label>
                    <input type="text" name="slide3_image" value="<?php echo htmlspecialchars(get_setting('slide3_image', 'images/slider_vision.jpg?v=3')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">الوصف والنص التعريفي</label>
                <textarea name="slide3_text" required rows="2" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;"><?php echo htmlspecialchars(get_setting('slide3_text', 'أن تكون كلية سماء المتميزين نموذجاً تعليمياً رائداً في التميز الأكاديمي وخدمة المجتمع.')); ?></textarea>
            </div>
        </div>

        <h3 style="color:#0d4748;border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:20px;">🛡️ تعديل حجم شعار الكلية (Logo Size)</h3>
        <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
            <div>
                <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">حجم شعار الهيدر العلوي (بالبكسل)</label>
                <input type="number" name="logo_size" value="<?php echo htmlspecialchars(get_setting('logo_size', '140')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                <span style="color:#999;font-size:12px;">الحجم الافتراضي: 140 بكسل (العرض والارتفاع)</span>
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:14px;margin-bottom:5px;">حجم شعار الفوتر السفلي (بالبكسل)</label>
                <input type="number" name="footer_logo_size" value="<?php echo htmlspecialchars(get_setting('footer_logo_size', '160')); ?>" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                <span style="color:#999;font-size:12px;">الحجم الافتراضي: 160 بكسل (العرض والارتفاع)</span>
            </div>
        </div>

        <button type="submit" name="save_slider_settings" style="background:#0d4748;color:white;padding:12px 30px;border:none;border-radius:8px;cursor:pointer;font-weight:bold;font-family:'Cairo',sans-serif;">💾 حفظ إعدادات الواجهة</button>
    </form>
</div>

<?php elseif ($active_tab == 'pages'): ?>
<!-- تبويب الصفحات الفرعية -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <h3 style="color:#0d4748;border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:20px;">📄 تعديل محتوى الصفحات الداخلية للموقع</h3>
    
    <!-- اختيار الصفحة المراد تعديلها -->
    <div style="margin-bottom:25px;background:#f4f6f9;padding:15px;border-radius:10px;display:flex;align-items:center;gap:15px;flex-wrap:wrap;">
        <strong style="color:#333;">اختر الصفحة التي ترغب في تعديل محتواها:</strong>
        <select onchange="window.location.href='?p=manage_content&tab=pages&edit_page=' + this.value" style="padding:8px 15px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;font-size:14px;font-weight:bold;color:#0d4748;">
            <?php foreach($editable_pages as $key => $title): ?>
                <option value="<?php echo $key; ?>" <?php if($selected_page_key == $key) echo 'selected'; ?>><?php echo $title; ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <form method="POST">
        <input type="hidden" name="edit_page_key" value="<?php echo htmlspecialchars($selected_page_key); ?>">
        <input type="hidden" name="page_title" value="<?php echo htmlspecialchars($editable_pages[$selected_page_key]); ?>">
        <input type="hidden" name="page_title_raw" value="<?php echo htmlspecialchars($editable_pages[$selected_page_key]); ?>">
        
        <div style="margin-bottom:20px;">
            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:5px;flex-wrap:wrap;">
                <label style="font-weight:bold;font-size:15px;color:#333;">محرر محتوى الصفحة (يدعم لغة HTML و النصوص العادية):</label>
                <span style="color:#d97706;font-size:12px;font-weight:bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> اتركه فارغاً تماماً للعودة للصفحة المنسقة مسبقاً بالنظام.</span>
            </div>
            <textarea name="page_content" rows="18" style="width:100%;padding:15px;border:1px solid #ddd;border-radius:8px;font-family:monospace;font-size:14px;direction:rtl;line-height:1.6;box-sizing:border-box;" placeholder="اكتب هنا محتوى الصفحة. يمكنك إدخال نصوص منسقة أو أكواد HTML لعرض جداول أو فقرات مخصصة..."><?php echo htmlspecialchars($current_page_content); ?></textarea>
        </div>

        <div style="background:#fffbeb;border-right:4px solid #d97706;padding:15px;border-radius:8px;margin-bottom:25px;font-size:13px;line-height:1.7;color:#92400e;">
            <strong>💡 تلميح للمدير:</strong> يمكنك استخدام وسوم الـ HTML الأساسية مثل <code>&lt;p&gt;</code> للفقرات، <code>&lt;strong&gt;</code> للنصوص العريضة، و <code>&lt;h3&gt;</code> للعناوين الفرعية، أو حتى نسخ ولصق الجداول لتخصيص محتواك بالكامل.
        </div>

        <button type="submit" name="save_page_content" style="background:#0d4748;color:white;padding:12px 30px;border:none;border-radius:8px;cursor:pointer;font-weight:bold;font-family:'Cairo',sans-serif;">💾 حفظ ونشر محتوى صفحة (<?php echo $editable_pages[$selected_page_key]; ?>)</button>
    </form>
</div>

<?php elseif ($active_tab == 'calendar'): 
    // جلب جميع أحداث التقويم الجامعي
    $calendar_events = mysqli_query($conn, "SELECT * FROM academic_calendar ORDER BY id ASC");
?>
<!-- تبويب التقويم الجامعي -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <h3 style="color:#0d4748;border-bottom:1px solid #eee;padding-bottom:10px;margin-bottom:20px;">📅 إدارة جدول التقويم الجامعي</h3>
    
    <!-- نموذج إضافة/تعديل حدث -->
    <div style="background:#f9fbfd;padding:20px;border-radius:10px;border:1px solid #bee3f8;margin-bottom:25px;">
        <h4 id="form_title" style="margin-top:0;color:#2b6cb0;margin-bottom:15px;">➕ إضافة حدث جديد للتقويم</h4>
        <form method="POST" id="calendarForm">
            <input type="hidden" name="event_id" id="event_id" value="0">
            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(200px,1fr));gap:15px;margin-bottom:15px;">
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">اسم الحدث / النشاط الأكاديمي</label>
                    <input type="text" name="event_name" id="event_name" required placeholder="مثال: بدء اختبارات الفصل الثاني" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">التاريخ الهجري</label>
                    <input type="text" name="hijri_date" id="hijri_date" placeholder="مثال: 17 صفر 1448 هـ" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">التاريخ الميلادي بالتفصيل</label>
                    <input type="text" name="event_date" id="event_date" required placeholder="مثال: الأحد، 15 مارس 2026 م" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">المدة / الحالة</label>
                    <input type="text" name="status" id="status" required placeholder="مثال: نشط حالياً، مكتمل، قريباً، إجازة رسمية، 15 يوم" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">التصنيف والفئة</label>
                    <select name="category" id="category_select" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;">
                        <option value="semester1">الفصل الدراسي الأول (semester1)</option>
                        <option value="semester1 exams">اختبارات الفصل الأول (semester1 exams)</option>
                        <option value="semester2">الفصل الدراسي الثاني (semester2)</option>
                        <option value="semester2 exams">اختبارات الفصل الثاني (semester2 exams)</option>
                        <option value="vacations">الإجازات الرسمية (vacations)</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:bold;font-size:13px;margin-bottom:5px;">الفرع المستهدف</label>
                    <select name="branch" id="branch_select" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;">
                        <option value="main">الفرع الرئيسي (main)</option>
                        <option value="rahdah">فرع الراهدة (rahdah)</option>
                    </select>
                </div>
            </div>
            <div style="display:flex;gap:10px;">
                <button type="submit" name="save_calendar_event" style="background:#0d4748;color:white;padding:10px 25px;border:none;border-radius:8px;cursor:pointer;font-weight:bold;font-family:'Cairo',sans-serif;">💾 حفظ الحدث</button>
                <button type="button" onclick="resetCalendarForm()" id="cancel_edit_btn" style="display:none;background:#e2e8f0;color:#4a5568;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-family:'Cairo',sans-serif;font-weight:bold;">إلغاء التعديل</button>
            </div>
        </form>
    </div>

    <!-- جدول عرض الأحداث الحالية -->
    <h4 style="color:#0d4748;margin-bottom:15px;">📋 قائمة أحداث التقويم المعتمدة</h4>
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;min-width:700px;">
            <thead>
                <tr style="background:#0d4748;color:white;">
                    <th style="padding:10px;text-align:right;">#</th>
                    <th style="padding:10px;text-align:right;">النشاط الأكاديمي</th>
                    <th style="padding:10px;text-align:right;">التاريخ الهجري</th>
                    <th style="padding:10px;text-align:right;">التاريخ الميلادي</th>
                    <th style="padding:10px;text-align:center;">المدة / الحالة</th>
                    <th style="padding:10px;text-align:center;">التصنيف</th>
                    <th style="padding:10px;text-align:center;">الفرع</th>
                    <th style="padding:10px;text-align:center;">التحكم</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; while($row = mysqli_fetch_assoc($calendar_events)): ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:10px;"><?php echo $i++; ?></td>
                    <td style="padding:10px;font-weight:bold;"><?php echo htmlspecialchars($row['event_name']); ?></td>
                    <td style="padding:10px;"><?php echo htmlspecialchars($row['hijri_date']); ?></td>
                    <td style="padding:10px;"><?php echo htmlspecialchars($row['event_date']); ?></td>
                    <td style="padding:10px;text-align:center;"><span style="background:#f1f5f9;padding:3px 8px;border-radius:12px;font-size:12px;font-weight:bold;"><?php echo htmlspecialchars($row['status']); ?></span></td>
                    <td style="padding:10px;text-align:center;color:#666;font-size:12px;"><?php echo htmlspecialchars($row['category']); ?></td>
                    <td style="padding:10px;text-align:center;color:#666;font-size:12px;font-weight:bold;"><?php echo $row['branch'] == 'rahdah' ? 'فرع الراهدة' : 'الفرع الرئيسي'; ?></td>
                    <td style="padding:10px;text-align:center;">
                        <button onclick="editCalendarEvent(<?php echo htmlspecialchars(json_encode($row)); ?>)" style="background:#3182ce;color:white;padding:4px 8px;border:none;border-radius:4px;cursor:pointer;font-family:'Cairo',sans-serif;font-size:11px;font-weight:bold;margin-left:5px;">✍️ تعديل</button>
                        <a href="?p=manage_content&delete_calendar_event=<?php echo $row['id']; ?>" style="background:#e53e3e;color:white;padding:4px 8px;border-radius:4px;text-decoration:none;font-size:11px;font-weight:bold;display:inline-block;" onclick="return confirm('حذف الحدث من التقويم؟')">🗑️ حذف</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function editCalendarEvent(event) {
    document.getElementById('event_id').value = event.id;
    document.getElementById('event_name').value = event.event_name;
    document.getElementById('hijri_date').value = event.hijri_date || '';
    document.getElementById('event_date').value = event.event_date;
    document.getElementById('status').value = event.status;
    document.getElementById('category_select').value = event.category;
    document.getElementById('branch_select').value = event.branch || 'main';
    
    document.getElementById('form_title').innerText = '✍️ تعديل الحدث المحدد بالتقويم';
    document.getElementById('cancel_edit_btn').style.display = 'inline-block';
    
    // التمرير لأعلى النموذج
    document.getElementById('calendarForm').scrollIntoView({ behavior: 'smooth' });
}

function resetCalendarForm() {
    document.getElementById('event_id').value = 0;
    document.getElementById('event_name').value = '';
    document.getElementById('hijri_date').value = '';
    document.getElementById('event_date').value = '';
    document.getElementById('status').value = '';
    document.getElementById('category_select').value = 'semester1';
    document.getElementById('branch_select').value = 'main';
    
    document.getElementById('form_title').innerText = '➕ إضافة حدث جديد للتقويم';
    document.getElementById('cancel_edit_btn').style.display = 'none';
}
</script>
<?php endif; ?>

<?php if ($active_tab == 'complaints'): ?>
<!-- ============================================================
     تبويب إدارة الشكاوى والمقترحات للطلاب والزوار
     ============================================================ -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);direction:rtl;text-align:right;">
    <h3 style="color:#0d4748;margin-top:0;margin-bottom:20px;border-bottom:2.5px solid #1c7f7c;padding-bottom:10px;display:flex;align-items:center;gap:8px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
        إدارة الشكاوى والمقترحات المستلمة
    </h3>
    
    <?php
    // جلب جميع الشكاوى والمقترحات
    $q_complaints = "SELECT * FROM complaints ORDER BY created_at DESC";
    $res_complaints = mysqli_query($conn, $q_complaints);
    ?>
    
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;text-align:right;font-size:13.5px;min-width:900px;">
            <thead>
                <tr style="background:#0d4748;color:white;">
                    <th style="padding:12px; border-radius:0 8px 8px 0;">الرقم المرجعي</th>
                    <th style="padding:12px;">بيانات المرسل</th>
                    <th style="padding:12px;">نوع المرسل</th>
                    <th style="padding:12px;">التصنيف والموضوع</th>
                    <th style="padding:12px;text-align:center;">التاريخ</th>
                    <th style="padding:12px;text-align:center;">الحالة</th>
                    <th style="padding:12px;text-align:center; border-radius:8px 0 0 8px; width:15%;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                if ($res_complaints && mysqli_num_rows($res_complaints) > 0):
                    while ($row = mysqli_fetch_assoc($res_complaints)): 
                        $status = $row['status'];
                        $bg = "#f3f4f6"; $fg = "#4b5563";
                        if ($status === 'قيد المراجعة') { $bg = "#fffbeb"; $fg = "#d97706"; }
                        elseif ($status === 'جاري التحقق') { $bg = "#eff6ff"; $fg = "#2563eb"; }
                        elseif ($status === 'تم الرد والحل') { $bg = "#f0fdf4"; $fg = "#16a34a"; }
                        elseif ($status === 'مغلقة') { $bg = "#f3f4f6"; $fg = "#4b5563"; }
                ?>
                <tr style="border-bottom:1px solid #eee; transition:0.2s;" onmouseover="this.style.background='#fbfcfe';" onmouseout="this.style.background='none';">
                    <td style="padding:14px;font-family:monospace;font-weight:bold;color:#0d4748;font-size:14.5px;"><?php echo htmlspecialchars($row['reference_code']); ?></td>
                    <td style="padding:14px;">
                        <strong><?php echo htmlspecialchars($row['sender_name'] ?? 'مجهول / سري 👤'); ?></strong><br>
                        <span style="color:#777;font-size:12px;"><?php echo htmlspecialchars($row['sender_phone'] ?? 'بلا هاتف'); ?></span>
                        <span style="color:#999;font-size:11px;"><?php echo $row['sender_email'] ? ' - '.$row['sender_email'] : ''; ?></span>
                    </td>
                    <td style="padding:14px;color:#555;"><?php echo htmlspecialchars($row['sender_type']); ?></td>
                    <td style="padding:14px;">
                        <span style="background:#f0fdfa;color:#1c7f7c;padding:2px 8px;border-radius:4px;font-size:11px;font-weight:bold;"><?php echo htmlspecialchars($row['category']); ?></span><br>
                        <span style="font-weight:bold;color:#333;font-size:13px;"><?php echo htmlspecialchars($row['subject']); ?></span>
                    </td>
                    <td style="padding:14px;text-align:center;color:#666;font-size:12px;"><?php echo date('Y/m/d H:i', strtotime($row['created_at'])); ?></td>
                    <td style="padding:14px;text-align:center;">
                        <span style="background:<?php echo $bg; ?>; color:<?php echo $fg; ?>; padding:3px 10px; border-radius:15px; font-size:11.5px; font-weight:bold; border:1px solid <?php echo $fg; ?>33; display:inline-block;">
                            <?php echo $status; ?>
                        </span>
                    </td>
                    <td style="padding:14px;text-align:center;">
                        <button onclick="openReplyModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" style="background:#16a34a;color:white;padding:5px 10px;border:none;border-radius:6px;cursor:pointer;font-family:'Cairo',sans-serif;font-size:11.5px;font-weight:bold;margin-left:5px;">💬 رد ومتابعة</button>
                        <a href="?p=manage_content&delete_complaint=<?php echo $row['id']; ?>" style="background:#e53e3e;color:white;padding:5px 10px;border-radius:6px;text-decoration:none;font-size:11.5px;font-weight:bold;display:inline-block;" onclick="return confirm('حذف هذه الشكوى بشكل نهائي؟')">🗑️ حذف</a>
                    </td>
                </tr>
                <?php 
                    endwhile; 
                else:
                ?>
                <tr>
                    <td colspan="7" style="padding:40px;text-align:center;color:#999;font-size:15px;">📥 لا توجد أي شكاوى أو مقترحات مستلمة في النظام حتى الآن.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- مودال الرد على الشكوى ومتابعتها -->
<div id="replyComplaintModal" style="display:none; position:fixed; z-index:9999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:20px; box-shadow:0 15px-40px rgba(0,0,0,0.3); width:100%; max-width:650px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden;">
        <div style="background:#0d4748; color:white; padding:20px; font-weight:bold; font-size:16px; display:flex; justify-content:space-between; align-items:center;">
            <span>💬 تفاصيل الشكوى والرد الإداري عليها</span>
            <button onclick="closeReplyModal()" style="background:none; border:none; color:white; font-size:24px; cursor:pointer;">&times;</button>
        </div>
        
        <form method="POST" action="" style="padding:25px;">
            <input type="hidden" name="complaint_id" id="modal_complaint_id">
            
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:10px; padding:15px; margin-bottom:20px; font-size:13.5px; line-height:1.6; max-height:180px; overflow-y:auto;">
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:10px; margin-bottom:10px; border-bottom:1px solid #e2e8f0; padding-bottom:8px;">
                    <div><strong>الرقم المرجعي:</strong> <span id="modal_ref_code" style="font-family:monospace; font-weight:bold; color:#0d4748;"></span></div>
                    <div><strong>نوع وطبيعة المرسل:</strong> <span id="modal_sender_type" style="color:#1c7f7c; font-weight:bold;"></span></div>
                </div>
                <div style="margin-bottom:8px;"><strong>الموضوع:</strong> <span id="modal_subject" style="font-weight:bold; color:#333;"></span></div>
                <div><strong>محتوى الرسالة:</strong><br><p id="modal_message" style="margin:5px 0 0 0; color:#555; white-space:pre-wrap;"></p></div>
            </div>
            
            <div style="margin-bottom:15px;">
                <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">الرد الإداري الرسمي (العمادة / شؤون الطلاب):</label>
                <textarea name="admin_response" id="modal_admin_response" required rows="5" placeholder="أكتب الرد الرسمي الواضح للرد على الشكوى أو المقترح..." style="width:100%; padding:10px; border:1.5px solid #cbd5e1; border-radius:8px; font-family:'Cairo',sans-serif; font-size:14px; line-height:1.6; box-sizing:border-box; resize:vertical;"></textarea>
            </div>
            
            <div style="margin-bottom:20px;">
                <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">تحديث حالة الطلب:</label>
                <select name="status" id="modal_status" required style="width:100%; padding:10px; border:1.5px solid #cbd5e1; border-radius:8px; font-family:'Cairo',sans-serif; font-size:14px; box-sizing:border-box; background:white;">
                    <option value="قيد المراجعة">🟡 قيد المراجعة</option>
                    <option value="جاري التحقق">🔵 جاري التحقق والدراسة</option>
                    <option value="تم الرد والحل">🟢 تم الرد وحل المشكلة</option>
                    <option value="مغلقة">🔴 إغلاق الطلب دون رد</option>
                </select>
            </div>
            
            <div style="display:flex; justify-content:flex-end; gap:10px; margin-top:20px;">
                <button type="button" onclick="closeReplyModal()" style="background:#e2e8f0; color:#4a5568; border:none; padding:10px 20px; border-radius:8px; cursor:pointer; font-weight:bold; font-family:'Cairo',sans-serif;">إلغاء</button>
                <button type="submit" name="reply_complaint" style="background:#16a34a; color:white; border:none; padding:10px 25px; border-radius:8px; cursor:pointer; font-weight:bold; font-family:'Cairo',sans-serif;">إرسال وحفظ الرد</button>
            </div>
        </form>
    </div>
</div>

<script>
function openReplyModal(complaint) {
    document.getElementById('modal_complaint_id').value = complaint.id;
    document.getElementById('modal_ref_code').innerText = complaint.reference_code;
    document.getElementById('modal_sender_type').innerText = complaint.sender_type + ' (' + complaint.category + ')';
    document.getElementById('modal_subject').innerText = complaint.subject;
    document.getElementById('modal_message').innerText = complaint.message;
    document.getElementById('modal_admin_response').value = complaint.admin_response || '';
    document.getElementById('modal_status').value = complaint.status || 'قيد المراجعة';
    
    document.getElementById('replyComplaintModal').style.display = 'flex';
}

function closeReplyModal() {
    document.getElementById('replyComplaintModal').style.display = 'none';
}
</script>
<?php endif; ?>

<?php if ($active_tab == 'events'): ?>
<!-- ============================================================
     تبويب إدارة الفعاليات والأنشطة (CMS)
     ============================================================ -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);direction:rtl;text-align:right;margin-bottom:25px;font-family:'Cairo', sans-serif;">
    <h3 style="color:#0d4748;margin-top:0;margin-bottom:20px;border-bottom:2.5px solid #1c7f7c;padding-bottom:10px;display:flex;align-items:center;gap:8px;">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
        إضافة وتعديل الفعاليات والأنشطة
    </h3>

    <form method="POST" id="eventForm" style="background:#f8fafc;padding:20px;border-radius:10px;border:1px solid #e2e8f0;margin-bottom:30px;">
        <h4 id="event_form_title" style="margin-top:0;color:#0d4748;font-weight:bold;margin-bottom:15px;">➕ إضافة فعالية أو نشاط جديد</h4>
        <input type="hidden" name="event_id" id="event_id" value="0">
        
        <div style="display:grid;grid-template-columns:2fr 1fr 1fr;gap:15px;margin-bottom:15px;">
            <div>
                <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">عنوان الفعالية / النشاط:</label>
                <input type="text" name="title" id="event_title" required placeholder="أدخل عنواناً جذاباً للفعالية" style="width:100%;padding:10px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">التصنيف:</label>
                <select name="category" id="event_category" required style="width:100%;padding:10px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;background:white;">
                    <option value="حفلات ومناسبات">🎉 حفلات ومناسبات</option>
                    <option value="ورش عمل">💻 ورش عمل</option>
                    <option value="أنشطة رياضية"><i class="fa-solid fa-trophy" style="margin-left: 5px;"></i> أنشطة رياضية</option>
                    <option value="علمية وثقافية">📚 علمية وثقافية</option>
                    <option value="أخرى">📢 أخرى</option>
                </select>
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">تاريخ إقامة الفعالية:</label>
                <input type="date" name="event_date" id="event_date_val" required style="width:100%;padding:9px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;text-align:right;">
            </div>
        </div>

        <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">
            <div>
                <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">الموقع / مكان الإقامة:</label>
                <input type="text" name="location" id="event_location" placeholder="مثال: القاعة الكبرى بالكلية" style="width:100%;padding:10px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;">
            </div>
            <div>
                <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">رابط صورة الفعالية (اختياري):</label>
                <input type="text" name="image_path" id="event_image_path" placeholder="مثال: images/events/seminar.jpg" style="width:100%;padding:10px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;text-align:left;">
            </div>
        </div>

        <div style="margin-bottom:20px;">
            <label style="display:block;font-weight:bold;font-size:13.5px;margin-bottom:6px;color:#4a5568;">التفاصيل ومحاور الفعالية بالكامل:</label>
            <textarea name="description" id="event_description" required rows="5" placeholder="أكتب تفاصيل الفعالية بدقة ومحاورها ليتعرف عليها الطلاب..." style="width:100%;padding:12px;border:1.5px solid #cbd5e1;border-radius:8px;box-sizing:border-box;font-family:'Cairo',sans-serif;line-height:1.6;resize:vertical;"></textarea>
        </div>

        <div style="display:flex;gap:10px;">
            <button type="submit" name="save_event" style="background:#1c7f7c;color:white;padding:10px 25px;border:none;border-radius:8px;font-weight:bold;cursor:pointer;">💾 حفظ الفعالية</button>
            <button type="button" id="cancel_event_edit" onclick="resetEventForm()" style="display:none;background:#e2e8f0;color:#4a5568;padding:10px 20px;border:none;border-radius:8px;font-weight:bold;cursor:pointer;">إلغاء التعديل</button>
        </div>
    </form>

    <h4 style="color:#0d4748;font-weight:bold;margin-bottom:15px;">📋 قائمة الفعاليات الحالية بالكلية</h4>
    <?php
    $res_ev = mysqli_query($conn, "SELECT * FROM events ORDER BY event_date DESC");
    ?>
    <div style="overflow-x:auto;">
        <table style="width:100%;border-collapse:collapse;font-size:13.5px;min-width:700px;">
            <thead>
                <tr style="background:#0d4748;color:white;">
                    <th style="padding:10px; border-radius:0 6px 6px 0;">#</th>
                    <th style="padding:10px;">العنوان</th>
                    <th style="padding:10px;">التصنيف</th>
                    <th style="padding:10px;">الموقع</th>
                    <th style="padding:10px;text-align:center;">التاريخ</th>
                    <th style="padding:10px;text-align:center; border-radius:6px 0 0 6px;">الإجراءات</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 1;
                if ($res_ev && mysqli_num_rows($res_ev) > 0):
                    while ($row = mysqli_fetch_assoc($res_ev)):
                ?>
                <tr style="border-bottom:1px solid #eee;">
                    <td style="padding:12px;"><?php echo $i++; ?></td>
                    <td style="padding:12px;font-weight:bold;color:#0d4748;"><?php echo htmlspecialchars($row['title']); ?></td>
                    <td style="padding:12px;"><span style="background:#f0fdf4;color:#1c7f7c;padding:2px 8px;border-radius:15px;font-size:11.5px;font-weight:bold;"><?php echo htmlspecialchars($row['category']); ?></span></td>
                    <td style="padding:12px;color:#555;"><?php echo htmlspecialchars($row['location'] ?? 'حرم الكلية'); ?></td>
                    <td style="padding:12px;text-align:center;color:#666;"><?php echo date('Y/m/d', strtotime($row['event_date'])); ?></td>
                    <td style="padding:12px;text-align:center;">
                        <button onclick="editEvent(<?php echo htmlspecialchars(json_encode($row)); ?>)" style="background:#3182ce;color:white;padding:4px 8px;border:none;border-radius:4px;cursor:pointer;font-family:'Cairo',sans-serif;font-size:11px;font-weight:bold;margin-left:5px;">✍️ تعديل</button>
                        <a href="?p=manage_content&tab=events&delete_event=<?php echo $row['id']; ?>" style="background:#e53e3e;color:white;padding:4px 8px;border-radius:4px;text-decoration:none;font-size:11px;font-weight:bold;display:inline-block;" onclick="return confirm('هل تريد بالتأكيد حذف هذه الفعالية نهائياً؟')">🗑️ حذف</a>
                    </td>
                </tr>
                <?php 
                    endwhile;
                else:
                ?>
                <tr><td colspan="6" style="padding:30px;text-align:center;color:#999;">لا توجد أي فعاليات مضافة بعد.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
function editEvent(event) {
    document.getElementById('event_id').value = event.id;
    document.getElementById('event_title').value = event.title;
    document.getElementById('event_category').value = event.category;
    document.getElementById('event_date_val').value = event.event_date;
    document.getElementById('event_location').value = event.location || '';
    document.getElementById('event_image_path').value = event.image_path || '';
    document.getElementById('event_image2_path').value = event.image2_path || '';
    document.getElementById('event_image3_path').value = event.image3_path || '';
    document.getElementById('event_video_path').value = event.video_path || '';
    document.getElementById('event_description').value = event.description;
    
    document.getElementById('event_form_title').innerText = '✍️ تعديل الفعالية / النشاط المحدد';
    document.getElementById('cancel_event_edit').style.display = 'inline-block';
    
    document.getElementById('eventForm').scrollIntoView({ behavior: 'smooth' });
}

function resetEventForm() {
    document.getElementById('event_id').value = '0';
    document.getElementById('event_title').value = '';
    document.getElementById('event_category').value = 'حفلات ومناسبات';
    document.getElementById('event_date_val').value = '';
    document.getElementById('event_location').value = '';
    document.getElementById('event_image_path').value = '';
    document.getElementById('event_description').value = '';
    
    document.getElementById('event_form_title').innerText = '➕ إضافة فعالية أو نشاط جديد';
    document.getElementById('cancel_event_edit').style.display = 'none';
}
</script>
<?php endif; ?>

