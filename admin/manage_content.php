<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

$selected_page = isset($_GET['page']) ? mysqli_real_escape_string($conn, $_GET['page']) : 'home';

// قائمة الصفحات المتاحة للتحرير البصري المبسط
$editable_pages = [
    'home' => 'الصفحة الرئيسية للكلية',
    'about' => 'من نحن وعن الكلية',
    'president' => 'كلمة عميد الكلية',
    'vision' => 'الرؤية والرسالة',
    'goals' => 'الأهداف الاستراتيجية',
    'students' => 'شؤون الطلاب والوثائق',
    'research' => 'الدراسات والبحوث',
    'library' => 'المكتبة الإلكترونية',
    'jobs' => 'الوظائف والتوظيف',
    'contact' => 'اتصل بنا وفروع الكلية'
];

// 1. معالجة الحفظ البصري المبسط
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_visual_content'])) {
    if ($selected_page == 'home') {
        // حفظ إعدادات الصفحة الرئيسية (السلادير والترحيب والعدادات)
        $home_settings = [
            'slide1_image' => $_POST['slide1_image'],
            'slide1_title' => $_POST['slide1_title'],
            'slide1_text' => $_POST['slide1_text'],
            
            'slide2_image' => $_POST['slide2_image'],
            'slide2_title' => $_POST['slide2_title'],
            'slide2_text' => $_POST['slide2_text'],
            
            'slide3_image' => $_POST['slide3_image'],
            'slide3_title' => $_POST['slide3_title'],
            'slide3_text' => $_POST['slide3_text'],
            
            'welcome_title' => $_POST['welcome_title'],
            'welcome_text' => $_POST['welcome_text'],
            
            'stats1_num' => $_POST['stats1_num'],
            'stats1_label' => $_POST['stats1_label'],
            
            'stats2_num' => $_POST['stats2_num'],
            'stats2_label' => $_POST['stats2_label'],
            
            'stats3_num' => $_POST['stats3_num'],
            'stats3_label' => $_POST['stats3_label'],
            
            'theme_color' => $_POST['theme_color'],
            'accent_color' => $_POST['accent_color']
        ];
        
        $success = true;
        foreach ($home_settings as $key => $val) {
            $key_db = mysqli_real_escape_string($conn, $key);
            $val_db = mysqli_real_escape_string($conn, $val);
            $query = "INSERT INTO site_settings (setting_key, setting_value) 
                      VALUES ('$key_db', '$val_db') 
                      ON DUPLICATE KEY UPDATE setting_value = '$val_db'";
            if (!mysqli_query($conn, $query)) {
                $success = false;
            }
        }
        if ($success) {
            $msg = "✅ تم حفظ إعدادات وتصميم الصفحة الرئيسية وتطبيق الألوان بنجاح!";
        } else {
            $error = "❌ فشل حفظ بعض الإعدادات في قاعدة البيانات.";
        }
    } else {
        // حفظ الصفحات الفرعية الأخرى وتوليد كود الـ HTML لها برمجياً بالخلفية
        $page_title_input = $_POST['visual_page_title'];
        $sec1_title = $_POST['sec1_title'];
        $sec1_text = $_POST['sec1_text'];
        $sec1_image = $_POST['sec1_image'];
        
        $sec2_title = $_POST['sec2_title'];
        $sec2_text = $_POST['sec2_text'];
        $sec2_image = $_POST['sec2_image'];
        
        // بناء كود HTML منسق وفخم تلقائياً ليظهر للزائر دون تعامل المدير مع الأكواد
        $generated_html = '
        <div class="cms-page-wrapper" style="direction:rtl; text-align:right;">
            <!-- القسم الأول -->
            <div style="display:flex; flex-direction:column; md-flex-direction:row; gap:30px; margin-bottom:40px; align-items:center;">
                <div style="flex:1;">
                    <h3 style="font-size:22px; font-weight:bold; color:var(--main-color); margin-bottom:15px; border-right:4px solid var(--accent-color); padding-right:10px;">'.htmlspecialchars($sec1_title).'</h3>
                    <p style="font-size:16px; line-height:1.8; color:#4a5568; text-align:justify;">'.nl2br(htmlspecialchars($sec1_text)).'</p>
                </div>';
        
        if (!empty($sec1_image)) {
            $generated_html .= '
                <div style="flex:1; max-width:500px;">
                    <img src="'.htmlspecialchars($sec1_image).'" alt="'.htmlspecialchars($sec1_title).'" style="width:100%; height:auto; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.08);">
                </div>';
        }
        
        $generated_html .= '
            </div>
            
            <!-- القسم الثاني -->
            <div style="display:flex; flex-direction:column; md-flex-direction:row-reverse; gap:30px; margin-top:40px; align-items:center; border-t:1px solid #edf2f7; padding-top:40px;">
                <div style="flex:1;">
                    <h3 style="font-size:22px; font-weight:bold; color:var(--main-color); margin-bottom:15px; border-right:4px solid var(--accent-color); padding-right:10px;">'.htmlspecialchars($sec2_title).'</h3>
                    <p style="font-size:16px; line-height:1.8; color:#4a5568; text-align:justify;">'.nl2br(htmlspecialchars($sec2_text)).'</p>
                </div>';
                
        if (!empty($sec2_image)) {
            $generated_html .= '
                <div style="flex:1; max-width:500px;">
                    <img src="'.htmlspecialchars($sec2_image).'" alt="'.htmlspecialchars($sec2_title).'" style="width:100%; height:auto; border-radius:15px; box-shadow:0 10px 25px rgba(0,0,0,0.08);">
                </div>';
        }
        
        $generated_html .= '
            </div>
        </div>';
        
        $title_db = mysqli_real_escape_string($conn, $page_title_input);
        $html_db = mysqli_real_escape_string($conn, $generated_html);
        $key_db = mysqli_real_escape_string($conn, $selected_page);
        
        $query = "INSERT INTO site_pages (page_key, page_title, page_content) 
                  VALUES ('$key_db', '$title_db', '$html_db') 
                  ON DUPLICATE KEY UPDATE page_title = '$title_db', page_content = '$html_db'";
                  
        if (mysqli_query($conn, $query)) {
            $msg = "✅ تم حفظ ونشر محتوى صفحة (" . $editable_pages[$selected_page] . ") بنجاح للجمهور!";
            
            // حفظ الحقول المفردة في site_settings للرجوع إليها وتعبئتها في المرة القادمة
            $fields = [
                $selected_page.'_sec1_title' => $sec1_title,
                $selected_page.'_sec1_text' => $sec1_text,
                $selected_page.'_sec1_image' => $sec1_image,
                $selected_page.'_sec2_title' => $sec2_title,
                $selected_page.'_sec2_text' => $sec2_text,
                $selected_page.'_sec2_image' => $sec2_image
            ];
            foreach ($fields as $fk => $fv) {
                $fk_db = mysqli_real_escape_string($conn, $fk);
                $fv_db = mysqli_real_escape_string($conn, $fv);
                mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('$fk_db', '$fv_db') ON DUPLICATE KEY UPDATE setting_value = '$fv_db'");
            }
        } else {
            $error = "❌ فشل حفظ الصفحة: " . mysqli_error($conn);
        }
    }
}

// 2. جلب القيم الحالية من قاعدة البيانات لتعبئة الفورم
// الصفحة الرئيسية
function get_setting_local($key, $default) {
    global $conn;
    $res = mysqli_query($conn, "SELECT setting_value FROM site_settings WHERE setting_key = '" . mysqli_real_escape_string($conn, $key) . "'");
    if ($res && mysqli_num_rows($res) > 0) {
        return mysqli_fetch_assoc($res)['setting_value'];
    }
    return $default;
}

// إعدادات الهوم الحالية
$home_data = [
    'slide1_image' => get_setting_local('slide1_image', 'uploads/slider1.jpg'),
    'slide1_title' => get_setting_local('slide1_title', 'كلية سماء المتميزين للعلوم الطبية والتكنولوجية'),
    'slide1_text' => get_setting_local('slide1_text', 'بيئة تعليمية متطورة لإعداد كوادر طبية وهندسية منافسة'),
    
    'slide2_image' => get_setting_local('slide2_image', 'uploads/slider2.jpg'),
    'slide2_title' => get_setting_local('slide2_title', 'معامل تطبيقية حديثة ومجهزة بالكامل'),
    'slide2_text' => get_setting_local('slide2_text', 'ندعم الدراسة النظرية بالتطبيق العملي لضمان الكفاءة والتميز'),
    
    'slide3_image' => get_setting_local('slide3_image', 'uploads/slider3.jpg'),
    'slide3_title' => get_setting_local('slide3_title', 'شهادات معتمدة ونخبة من أعضاء هيئة التدريس'),
    'slide3_text' => get_setting_local('slide3_text', 'نضمن لك مستقبلاً مهنياً واعداً محلياً وإقليمياً'),
    
    'welcome_title' => get_setting_local('welcome_title', 'مرحباً بكم في صرح التميز الأكاديمي'),
    'welcome_text' => get_setting_local('welcome_text', 'تأسست كلية سماء المتميزين لتكون منارة علمية تقدم أفضل البرامج التعليمية الطبية والهندسية في اليمن.'),
    
    'stats1_num' => get_setting_local('stats1_num', '1200'),
    'stats1_label' => get_setting_local('stats1_label', 'طالب وطالبة'),
    
    'stats2_num' => get_setting_local('stats2_num', '45'),
    'stats2_label' => get_setting_local('stats2_label', 'أستاذ ومحاضر'),
    
    'stats3_num' => get_setting_local('stats3_num', '12'),
    'stats3_label' => get_setting_local('stats3_label', 'معمل تطبيقي'),
    
    'theme_color' => get_setting_local('theme_color', '#006654'),
    'accent_color' => get_setting_local('accent_color', '#c5a059')
];

// إعدادات الصفحات الفرعية الحالية
$page_db_title = $editable_pages[$selected_page] ?? '';
$page_sec1_title = get_setting_local($selected_page.'_sec1_title', 'عنوان القسم الأول هنا');
$page_sec1_text = get_setting_local($selected_page.'_sec1_text', 'اكتب تفاصيل ومحتوى القسم الأول هنا بشكل مبسط...');
$page_sec1_image = get_setting_local($selected_page.'_sec1_image', 'uploads/about1.jpg');

$page_sec2_title = get_setting_local($selected_page.'_sec2_title', 'عنوان القسم الثاني هنا');
$page_sec2_text = get_setting_local($selected_page.'_sec2_text', 'اكتب تفاصيل ومحتوى القسم الثاني هنا بشكل مبسط...');
$page_sec2_image = get_setting_local($selected_page.'_sec2_image', 'uploads/about2.jpg');
?>

<?php include_once 'header.php'; ?>

    <div class="max-w-7xl mx-auto bg-white rounded-xl shadow-md p-6 border-t-4 border-gold">
        <h2 class="text-2xl font-bold text-gray-800 mb-2 flex items-center gap-2">
            <i class="fa-solid fa-compass-drafting text-gold"></i> المحرر البصري التفاعلي للمدير العام (Visual CMS)
        </h2>
        <p class="text-xs text-gray-500 mb-6 border-b pb-4">
            نظام تحرير فوري مبسط: قم بتعديل النصوص وتغيير الصور والألوان على اليمين، وسيتحدث العرض التفاعلي على اليسار مباشرة ليطابق ما يراه الزائر!
        </p>

        <?php if ($msg): ?>
            <div class="bg-green-100 border-r-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- العمود الأيمن: قائمة الصفحات + فورم التعديل البسيط (عرض 5/12) -->
            <div class="lg:col-span-5 flex flex-col gap-6">
                
                <!-- قائمة تحديد الصفحة المراد تعديلها -->
                <div class="bg-gray-50 p-4 border rounded-xl">
                    <label class="block text-sm font-bold text-gray-700 mb-2">اختر الصفحة المراد تعديلها:</label>
                    <select onchange="location.href='?page=' + this.value" class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary font-bold">
                        <?php foreach ($editable_pages as $kp => $tp): ?>
                            <option value="<?php echo $kp; ?>" <?php echo $selected_page == $kp ? 'selected' : ''; ?>>
                                <?php echo $tp; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <!-- فورم التعديل البصري الخالي تماماً من الأكواد البرمجية -->
                <form method="POST" class="bg-white border rounded-xl p-5 shadow-sm space-y-5">
                    
                    <h3 class="font-extrabold text-primary border-b pb-2 text-md flex items-center gap-1.5">
                        <i class="fa-solid fa-edit text-gold"></i> حقول تعديل المحتوى
                    </h3>

                    <?php if ($selected_page == 'home'): ?>
                        <!-- حقول الصفحة الرئيسية -->
                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">🎨 الهوية البصرية والألوان</h4>
                            <div class="grid grid-cols-2 gap-3">
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1">اللون الأساسي</label>
                                    <input type="color" name="theme_color" id="input_theme_color" value="<?php echo $home_data['theme_color']; ?>" oninput="updateLiveHomePreview()" class="w-full h-10 border rounded-lg p-1">
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-600 mb-1">اللون الثانوي</label>
                                    <input type="color" name="accent_color" id="input_accent_color" value="<?php echo $home_data['accent_color']; ?>" oninput="updateLiveHomePreview()" class="w-full h-10 border rounded-lg p-1">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">📸 الشريحة الأولى في السلايدر</h4>
                            <div class="space-y-2">
                                <input type="text" name="slide1_title" id="input_slide1_title" value="<?php echo htmlspecialchars($home_data['slide1_title']); ?>" oninput="updateLiveHomePreview()" placeholder="العنوان العريض للشريحة 1" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary font-bold">
                                <input type="text" name="slide1_text" id="input_slide1_text" value="<?php echo htmlspecialchars($home_data['slide1_text']); ?>" oninput="updateLiveHomePreview()" placeholder="الوصف والفقرة الفرعية للشريحة 1" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary">
                                <input type="text" name="slide1_image" id="input_slide1_image" value="<?php echo htmlspecialchars($home_data['slide1_image']); ?>" oninput="updateLiveHomePreview()" placeholder="رابط صورة الخلفية للشريحة 1" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary font-mono">
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">📸 الشريحة الثانية في السلايدر</h4>
                            <div class="space-y-2">
                                <input type="text" name="slide2_title" id="input_slide2_title" value="<?php echo htmlspecialchars($home_data['slide2_title']); ?>" oninput="updateLiveHomePreview()" placeholder="العنوان العريض للشريحة 2" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary font-bold">
                                <input type="text" name="slide2_text" id="input_slide2_text" value="<?php echo htmlspecialchars($home_data['slide2_text']); ?>" oninput="updateLiveHomePreview()" placeholder="الوصف والفقرة الفرعية للشريحة 2" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary">
                                <input type="text" name="slide2_image" id="input_slide2_image" value="<?php echo htmlspecialchars($home_data['slide2_image']); ?>" oninput="updateLiveHomePreview()" placeholder="رابط صورة الخلفية للشريحة 2" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary font-mono">
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">👋 قسم الترحيب الرئيسي</h4>
                            <div class="space-y-2">
                                <input type="text" name="welcome_title" id="input_welcome_title" value="<?php echo htmlspecialchars($home_data['welcome_title']); ?>" oninput="updateLiveHomePreview()" placeholder="عنوان قسم الترحيب" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none focus:border-primary font-bold">
                                <textarea name="welcome_text" id="input_welcome_text" rows="3" oninput="updateLiveHomePreview()" placeholder="نص الترحيب بالكامل..." class="w-full border rounded-lg p-3 text-xs focus:outline-none focus:border-primary"><?php echo htmlspecialchars($home_data['welcome_text']); ?></textarea>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">📊 إحصائيات وعدادات الكلية</h4>
                            <div class="grid grid-cols-3 gap-2">
                                <div>
                                    <label class="block text-[10px] text-gray-500">العدد 1</label>
                                    <input type="text" name="stats1_num" id="input_stats1_num" value="<?php echo htmlspecialchars($home_data['stats1_num']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded px-2 py-1 text-xs">
                                    <input type="text" name="stats1_label" id="input_stats1_label" value="<?php echo htmlspecialchars($home_data['stats1_label']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded mt-1 px-2 py-0.5 text-[9px]">
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500">العدد 2</label>
                                    <input type="text" name="stats2_num" id="input_stats2_num" value="<?php echo htmlspecialchars($home_data['stats2_num']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded px-2 py-1 text-xs">
                                    <input type="text" name="stats2_label" id="input_stats2_label" value="<?php echo htmlspecialchars($home_data['stats2_label']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded mt-1 px-2 py-0.5 text-[9px]">
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500">العدد 3</label>
                                    <input type="text" name="stats3_num" id="input_stats3_num" value="<?php echo htmlspecialchars($home_data['stats3_num']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded px-2 py-1 text-xs">
                                    <input type="text" name="stats3_label" id="input_stats3_label" value="<?php echo htmlspecialchars($home_data['stats3_label']); ?>" oninput="updateLiveHomePreview()" class="w-full border rounded mt-1 px-2 py-0.5 text-[9px]">
                                </div>
                            </div>
                        </div>

                    <?php else: ?>
                        <!-- حقول تعديل الصفحات الفرعية الأخرى بشكل بصري ومبسط -->
                        <div>
                            <label class="block text-xs font-bold text-gray-700 mb-1">اسم وتسمية الصفحة</label>
                            <input type="text" name="visual_page_title" id="input_page_title" value="<?php echo htmlspecialchars($page_db_title); ?>" oninput="updateLivePagePreview()" class="w-full border rounded-lg px-3 py-2 text-xs focus:outline-none focus:border-primary font-bold">
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-teal-600 mb-2 border-b pb-1">📍 القسم الأول في الصفحة</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">عنوان القسم</label>
                                    <input type="text" name="sec1_title" id="input_sec1_title" value="<?php echo htmlspecialchars($page_sec1_title); ?>" oninput="updateLivePagePreview()" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none font-bold">
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">النص والمحتوى</label>
                                    <textarea name="sec1_text" id="input_sec1_text" rows="4" oninput="updateLivePagePreview()" class="w-full border rounded-lg p-2.5 text-xs focus:outline-none"><?php echo htmlspecialchars($page_sec1_text); ?></textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">رابط صورة القسم 1</label>
                                    <input type="text" name="sec1_image" id="input_sec1_image" value="<?php echo htmlspecialchars($page_sec1_image); ?>" oninput="updateLivePagePreview()" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none font-mono">
                                </div>
                            </div>
                        </div>

                        <div>
                            <h4 class="text-xs font-bold text-teal-600 mb-2 border-b pb-1">📍 القسم الثاني في الصفحة</h4>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">عنوان القسم الثاني</label>
                                    <input type="text" name="sec2_title" id="input_sec2_title" value="<?php echo htmlspecialchars($page_sec2_title); ?>" oninput="updateLivePagePreview()" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none font-bold">
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">النص والمحتوى للقسم الثاني</label>
                                    <textarea name="sec2_text" id="input_sec2_text" rows="4" oninput="updateLivePagePreview()" class="w-full border rounded-lg p-2.5 text-xs focus:outline-none"><?php echo htmlspecialchars($page_sec2_text); ?></textarea>
                                </div>
                                <div>
                                    <label class="block text-[10px] text-gray-500 mb-0.5">رابط صورة القسم 2</label>
                                    <input type="text" name="sec2_image" id="input_sec2_image" value="<?php echo htmlspecialchars($page_sec2_image); ?>" oninput="updateLivePagePreview()" class="w-full border rounded-lg px-3 py-1.5 text-xs focus:outline-none font-mono">
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="pt-3">
                        <button type="submit" name="save_visual_content" class="w-full bg-primary hover:bg-primaryDark text-white font-bold py-3 px-6 rounded-lg text-sm shadow transition">
                            <i class="fa-solid fa-save ml-1"></i> حفظ ونشر التغييرات على الموقع
                        </button>
                    </div>
                </form>

            </div>

            <!-- العمود الأيسر: شاشة العرض التفاعلية الحية للموقع (عرض 7/12) -->
            <div class="lg:col-span-7 flex flex-col gap-4">
                
                <h3 class="font-extrabold text-gray-700 text-sm flex items-center gap-1.5 px-2">
                    <i class="fa-solid fa-laptop text-primary"></i> شاشة المعاينة التفاعلية على جهاز كمبيوتر محمول (Laptop Viewport):
                </h3>
                
                <!-- Laptop Device Mockup Wrapper -->
                <div class="relative w-full max-w-3xl mx-auto">
                    
                    <!-- Screen Frame -->
                    <div class="relative border-[12px] border-gray-800 rounded-t-2xl bg-white shadow-2xl overflow-hidden" style="aspect-ratio: 16/10; min-height: 400px; display: flex; flex-direction: column;">
                        
                        <!-- Camera dot -->
                        <div class="absolute top-[3px] left-1/2 -translate-x-1/2 w-1.5 h-1.5 rounded-full bg-gray-900 z-50"></div>
                        
                        <!-- Browser Header Bar -->
                        <div class="bg-gray-800 text-gray-400 px-4 py-2 flex items-center gap-2 text-xs select-none shrink-0 border-b border-gray-900">
                            <div class="flex gap-1">
                                <span class="w-2.5 h-2.5 rounded-full bg-red-500 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-yellow-500 inline-block"></span>
                                <span class="w-2.5 h-2.5 rounded-full bg-green-500 inline-block"></span>
                            </div>
                            <div class="bg-gray-700 px-6 py-1 rounded text-center text-[10px] text-gray-200 truncate flex-grow max-w-md mx-auto font-mono">
                                http://localhost:8080/Sama_College/
                            </div>
                        </div>

                        <!-- Scrollable Site Preview Content -->
                        <div class="flex-grow overflow-y-auto bg-gray-50 flex flex-col">
                            
                            <!-- معاينة الهوم التفاعلية -->
                            <?php if ($selected_page == 'home'): ?>
                                <div class="flex-grow flex flex-col" id="preview_home_wrapper">
                                    
                                    <!-- السلايدر التفاعلي -->
                                    <div class="h-56 relative bg-cover bg-center flex items-center justify-center p-6 text-white text-center transition-all duration-300" id="live_slide1_bg" style="background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../<?php echo $home_data['slide1_image']; ?>');">
                                        <div>
                                            <h4 class="text-lg md:text-xl font-bold" id="live_slide1_title"><?php echo htmlspecialchars($home_data['slide1_title']); ?></h4>
                                            <p class="text-xs text-gray-200 mt-2 max-w-lg mx-auto" id="live_slide1_text"><?php echo htmlspecialchars($home_data['slide1_text']); ?></p>
                                        </div>
                                    </div>
                                    
                                    <!-- بار الترحيب والدعوة للاتصال -->
                                    <div class="p-8 text-center bg-white">
                                        <h3 class="text-lg font-bold text-gray-800" id="live_welcome_title" style="color: <?php echo $home_data['theme_color']; ?>;"><?php echo htmlspecialchars($home_data['welcome_title']); ?></h3>
                                        <p class="text-xs text-gray-600 mt-3 leading-relaxed max-w-xl mx-auto" id="live_welcome_text"><?php echo htmlspecialchars($home_data['welcome_text']); ?></p>
                                    </div>
                                    
                                    <!-- كروت العدادات الحية -->
                                    <div class="grid grid-cols-3 gap-4 p-6 bg-gray-50 border-t mt-auto">
                                        <div class="bg-white p-4 border rounded-xl text-center shadow-sm">
                                            <p class="text-2xl font-extrabold text-primary" id="live_stats1_num"><?php echo htmlspecialchars($home_data['stats1_num']); ?></p>
                                            <p class="text-xs text-gray-500 font-bold mt-1" id="live_stats1_label"><?php echo htmlspecialchars($home_data['stats1_label']); ?></p>
                                        </div>
                                        <div class="bg-white p-4 border rounded-xl text-center shadow-sm">
                                            <p class="text-2xl font-extrabold text-primary" id="live_stats2_num"><?php echo htmlspecialchars($home_data['stats2_num']); ?></p>
                                            <p class="text-xs text-gray-500 font-bold mt-1" id="live_stats2_label"><?php echo htmlspecialchars($home_data['stats2_label']); ?></p>
                                        </div>
                                        <div class="bg-white p-4 border rounded-xl text-center shadow-sm">
                                            <p class="text-2xl font-extrabold text-primary" id="live_stats3_num"><?php echo htmlspecialchars($home_data['stats3_num']); ?></p>
                                            <p class="text-xs text-gray-500 font-bold mt-1" id="live_stats3_label"><?php echo htmlspecialchars($home_data['stats3_label']); ?></p>
                                        </div>
                                    </div>

                                </div>
                            <?php else: ?>
                                <!-- معاينة الصفحات الفرعية التفاعلية -->
                                <div class="flex-grow p-8 flex flex-col bg-white" id="preview_page_wrapper">
                                    
                                    <!-- عنوان الصفحة -->
                                    <h2 class="text-xl font-extrabold border-b pb-4 mb-6 text-gray-800 flex items-center gap-1.5" style="color: <?php echo $home_data['theme_color']; ?>;">
                                        <span id="live_page_title"><?php echo htmlspecialchars($page_db_title); ?></span>
                                    </h2>
                                    
                                    <!-- القسم الأول -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mb-8">
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-700 border-r-4 border-gold pr-2 mb-3" id="live_sec1_title"><?php echo htmlspecialchars($page_sec1_title); ?></h4>
                                            <p class="text-xs text-gray-500 leading-relaxed text-justify" id="live_sec1_text"><?php echo nl2br(htmlspecialchars($page_sec1_text)); ?></p>
                                        </div>
                                        <div>
                                            <img id="live_sec1_image" src="../<?php echo $page_sec1_image; ?>" alt="صورة القسم الأول" class="w-full h-36 object-cover rounded-xl border shadow-sm">
                                        </div>
                                    </div>
                                    
                                    <!-- القسم الثاني -->
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-center mt-6 border-t pt-8">
                                        <div>
                                            <img id="live_sec2_image" src="../<?php echo $page_sec2_image; ?>" alt="صورة القسم الثاني" class="w-full h-36 object-cover rounded-xl border shadow-sm">
                                        </div>
                                        <div>
                                            <h4 class="text-sm font-bold text-gray-700 border-r-4 border-gold pr-2 mb-3" id="live_sec2_title"><?php echo htmlspecialchars($page_sec2_title); ?></h4>
                                            <p class="text-xs text-gray-500 leading-relaxed text-justify" id="live_sec2_text"><?php echo nl2br(htmlspecialchars($page_sec2_text)); ?></p>
                                        </div>
                                    </div>

                                </div>
                            <?php endif; ?>

                        </div>
                    </div>
                    
                    <!-- Laptop Lower Base/Keyboard Part -->
                    <div class="relative bg-gray-700 h-[14px] rounded-b-2xl w-[106%] -left-[3%] shadow-2xl border-t border-gray-600">
                        <!-- Opening notch -->
                        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-20 h-[6px] bg-gray-800 rounded-b-md"></div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- كود تحديث شاشة المعاينة تلقائياً عند الكتابة -->
    <script>
        function updateLiveHomePreview() {
            // تحديث نصوص السلايدر
            const s1_title = document.getElementById('input_slide1_title')?.value || '';
            const s1_text = document.getElementById('input_slide1_text')?.value || '';
            const s1_img = document.getElementById('input_slide1_image')?.value || '';
            
            if (document.getElementById('live_slide1_title')) {
                document.getElementById('live_slide1_title').innerText = s1_title;
                document.getElementById('live_slide1_text').innerText = s1_text;
                if (s1_img) {
                    document.getElementById('live_slide1_bg').style.backgroundImage = `linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('../${s1_img}')`;
                }
            }
            
            // تحديث نصوص الترحيب
            const w_title = document.getElementById('input_welcome_title')?.value || '';
            const w_text = document.getElementById('input_welcome_text')?.value || '';
            
            if (document.getElementById('live_welcome_title')) {
                document.getElementById('live_welcome_title').innerText = w_title;
                document.getElementById('live_welcome_text').innerText = w_text;
            }
            
            // تحديث العدادات
            const st1_num = document.getElementById('input_stats1_num')?.value || '';
            const st1_lbl = document.getElementById('input_stats1_label')?.value || '';
            const st2_num = document.getElementById('input_stats2_num')?.value || '';
            const st2_lbl = document.getElementById('input_stats2_label')?.value || '';
            const st3_num = document.getElementById('input_stats3_num')?.value || '';
            const st3_lbl = document.getElementById('input_stats3_label')?.value || '';
            
            if (document.getElementById('live_stats1_num')) {
                document.getElementById('live_stats1_num').innerText = st1_num;
                document.getElementById('live_stats1_label').innerText = st1_lbl;
                
                document.getElementById('live_stats2_num').innerText = st2_num;
                document.getElementById('live_stats2_label').innerText = st2_lbl;
                
                document.getElementById('live_stats3_num').innerText = st3_num;
                document.getElementById('live_stats3_label').innerText = st3_lbl;
            }
            
            // تحديث الألوان الحية في الهيدر والترحيب
            const primary_color = document.getElementById('input_theme_color')?.value || '#006654';
            if (document.getElementById('live_welcome_title')) {
                document.getElementById('live_welcome_title').style.color = primary_color;
            }
        }
        
        function updateLivePagePreview() {
            // تحديث نصوص صفحة التعديل
            const p_title = document.getElementById('input_page_title')?.value || '';
            const s1_title = document.getElementById('input_sec1_title')?.value || '';
            const s1_text = document.getElementById('input_sec1_text')?.value || '';
            const s1_img = document.getElementById('input_sec1_image')?.value || '';
            
            const s2_title = document.getElementById('input_sec2_title')?.value || '';
            const s2_text = document.getElementById('input_sec2_text')?.value || '';
            const s2_img = document.getElementById('input_sec2_image')?.value || '';
            
            if (document.getElementById('live_page_title')) {
                document.getElementById('live_page_title').innerText = p_title;
                document.getElementById('live_sec1_title').innerText = s1_title;
                document.getElementById('live_sec1_text').innerText = s1_text;
                if (s1_img) {
                    document.getElementById('live_sec1_image').src = s1_img.startsWith('http') || s1_img.startsWith('uploads') ? s1_img : '../' + s1_img;
                }
                
                document.getElementById('live_sec2_title').innerText = s2_title;
                document.getElementById('live_sec2_text').innerText = s2_text;
                if (s2_img) {
                    document.getElementById('live_sec2_image').src = s2_img.startsWith('http') || s2_img.startsWith('uploads') ? s2_img : '../' + s2_img;
                }
            }
        }
        
        // تشغيل المعاينة المبدئية عند التحميل
        window.onload = function() {
            updateLiveHomePreview();
            updateLivePagePreview();
        };
    </script>

<?php include_once 'footer.php'; ?>
