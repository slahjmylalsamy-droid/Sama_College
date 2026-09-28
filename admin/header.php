<?php
// admin/header.php - الهيدر والقائمة الجانبية المشتركة لكافة لوحات تحكم الإدارة
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once '../db_connect.php';

// التحقق من الصلاحية العامة
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../index.php?p=login");
    exit();
}

$user_id_session = intval($_SESSION['user_id']);
$user_perm_query = mysqli_query($conn, "SELECT page_permissions, permission_level FROM users WHERE id = $user_id_session");
$user_perms = null;
$user_permission_level = 0;
if ($user_perm_query && $row = mysqli_fetch_assoc($user_perm_query)) {
    $user_permission_level = intval($row['permission_level']);
    if (!empty($row['page_permissions'])) {
        $user_perms = json_decode($row['page_permissions'], true);
    }
}

// دالة التحقق من صلاحية صفحة محددة
function isPageAllowed($page) {
    global $user_perms, $user_permission_level;
    // السوبر أدمن صلاحيات كاملة
    if ($user_permission_level >= 3) {
        return true;
    }
    // الصفحة الرئيسية للوحة التحكم والمجموعات المشتركة متاحة للكل
    if ($page === 'dashboard.php' || $page === 'academic_groups.php') {
        return true;
    }
    // فحص الصلاحية في حقل الـ JSON
    if (isset($user_perms[$page]) && $user_perms[$page] === true) {
        return true;
    }
    return false;
}

$current_page = basename($_SERVER['PHP_SELF']);

// فحص صلاحية الصفحة الحالية
if (!isPageAllowed($current_page)) {
    ?>
    <!DOCTYPE html>
    <html lang="ar" dir="rtl">
    <head>
        <meta charset="UTF-8">
        <title>غير مصرح بالدخول</title>
        <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: {
                            cairo: ['Cairo', 'sans-serif'],
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-gray-100 font-cairo min-h-screen flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-8 text-center border-t-4 border-red-500">
            <div class="w-20 h-20 bg-red-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-red-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m0-8V5m0 16a9 9 0 110-18 9 9 0 010 18z" />
                </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">عذراً، غير مصرح لك بدخول هذه الصفحة</h3>
            <p class="text-gray-500 text-sm mb-6">لقد قام مدير النظام بحجب هذه الصفحة عن حسابك. إذا كنت بحاجة للوصول، يرجى مراجعة الإدارة.</p>
            <a href="dashboard.php" class="inline-block bg-teal-600 hover:bg-teal-700 text-white font-bold py-2.5 px-6 rounded-lg text-sm transition">
                العودة للرئيسية
            </a>
        </div>
    </body>
    </html>
    <?php
    exit();
}
?>
<?php
$theme_color = get_setting('theme_color', '#006654');
$accent_color = get_setting('accent_color', '#c5a059');

if (!function_exists('adjust_brightness_local')) {
    function adjust_brightness_local($hex, $steps) {
        $steps = max(-255, min(255, $steps));
        $hex = str_replace('#', '', $hex);
        if (strlen($hex) == 3) {
            $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
        }
        $r = hexdec(substr($hex, 0, 2));
        $g = hexdec(substr($hex, 2, 2));
        $b = hexdec(substr($hex, 4, 2));
        
        $r = max(0, min(255, $r + $steps));
        $g = max(0, min(255, $g + $steps));
        $b = max(0, min(255, $b + $steps));
        
        return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
    }
}

$primary_dark = adjust_brightness_local($theme_color, -40);
$sidebar_bg = adjust_brightness_local($theme_color, -60);
$active_item = adjust_brightness_local($theme_color, -30);
?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة التحكم الإدارية - كلية سماء المتميزين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '<?php echo $theme_color; ?>',
                        primaryDark: '<?php echo $primary_dark; ?>',
                        gold: '<?php echo $accent_color; ?>',
                        sidebarBg: '<?php echo $sidebar_bg; ?>',
                        activeItem: '<?php echo $active_item; ?>',
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        /* لتنسيق التمرير والجدول */
        .custom-border {
            border: 1px solid #cbd5e1;
        }
        table {
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #64748b;
        }
        .active-menu-item {
            background-color: <?php echo $active_item; ?> !important;
            border-right: 5px solid <?php echo $accent_color; ?>;
            color: <?php echo $accent_color; ?> !important;
        }
    </style>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col">

<!-- الحاوية الكلية للتقسيم: جانبية يمين + محتوى يسار -->
<div class="flex flex-1 min-h-screen">
    
    <!-- القائمة الجانبية اليمنى (القائمة الرئيسية) - مطابقة تماماً للمرفق بالصورة -->
    <aside class="w-64 bg-sidebarBg text-white flex flex-col shrink-0 no-print border-l border-teal-950">
        <!-- ترويسة القائمة الجانبية -->
        <div class="p-5 border-b border-teal-900 text-center bg-teal-950">
            <h2 class="text-lg font-extrabold text-gold tracking-wide">القائمة الرئيسية</h2>
        </div>
        
        <!-- روابط التنقل المفلترة حسب الصلاحيات لكل مستخدم -->
        <nav class="flex-1 py-4 space-y-1">
            <?php if (isPageAllowed('dashboard.php')): ?>
            <a href="dashboard.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'dashboard.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-gauge w-5 text-center text-gold"></i>
                <span>لوحة التحكم</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('manage_schedule.php')): ?>
            <a href="manage_schedule.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_schedule.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-layer-group w-5 text-center text-gold"></i>
                <span>التخصصات والجدول</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('manage_students.php')): ?>
            <a href="manage_students.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_students.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-user-graduate w-5 text-center text-gold"></i>
                <span>الطلاب</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('manage_teachers.php')): ?>
            <a href="manage_teachers.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_teachers.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-chalkboard-user w-5 text-center text-gold"></i>
                <span>المدرسون</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('manage_staff.php')): ?>
            <a href="manage_staff.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_staff.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-users-gear w-5 text-center text-gold"></i>
                <span>الموظفون</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('upload_lecture.php')): ?>
            <a href="upload_lecture.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'upload_lecture.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-book w-5 text-center text-gold"></i>
                <span>المواد والمحاضرات</span>
            </a>
            <?php endif; ?>
            
            <?php if (isPageAllowed('manage_fingerprints.php')): ?>
            <a href="manage_fingerprints.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_fingerprints.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-fingerprint w-5 text-center text-gold"></i>
                <span>البصمات الحيوية</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('accounting.php')): ?>
            <a href="accounting.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'accounting.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-chart-pie w-5 text-center text-gold"></i>
                <span>الحسابات والمالية</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('reports.php')): ?>
            <a href="reports.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'reports.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-chart-line w-5 text-center text-gold"></i>
                <span>التقارير التفصيلية</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('manage_permissions.php')): ?>
            <a href="manage_permissions.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_permissions.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-user-lock w-5 text-center text-gold"></i>
                <span>إدارة الصلاحيات</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('announcements.php')): ?>
            <a href="announcements.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'announcements.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-bullhorn w-5 text-center text-gold"></i>
                <span>إعلانات الكلية</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('manage_grades.php')): ?>
            <a href="manage_grades.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_grades.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-graduation-cap w-5 text-center text-gold"></i>
                <span>الدرجات والنتائج</span>
            </a>
            <?php endif; ?>

            <?php if (isPageAllowed('manage_content.php')): ?>
            <a href="manage_content.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_content.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-file-signature w-5 text-center text-gold"></i>
                <span>إدارة المحتوى (CMS)</span>
            </a>
            <?php endif; ?>

            <a href="academic_groups.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'academic_groups.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-comments w-5 text-center text-gold"></i>
                <span>المجموعات المشتركة</span>
            </a>

            <?php if ($user_permission_level >= 3): ?>
            <a href="manage_group_members.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-gray-300 hover:bg-teal-900/50 hover:text-white transition <?php echo $current_page == 'manage_group_members.php' ? 'active-menu-item' : ''; ?>">
                <i class="fa-solid fa-users-gear w-5 text-center text-gold"></i>
                <span>أعضاء المجموعات</span>
            </a>
            <?php endif; ?>
            
            <a href="../logout.php" class="flex items-center gap-3 px-6 py-3 text-sm font-bold text-red-400 hover:bg-red-950/40 transition">
                <i class="fa-solid fa-sign-out-alt w-5 text-center text-red-400"></i>
                <span>تسجيل الخروج</span>
            </a>
        </nav>
    </aside>

    <!-- القسم الأيسر: الهيدر العلوي + منطقة عرض المحتوى -->
    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        
        <!-- الهيدر العلوي - مطابق تماماً للصورة المرفقة -->
        <header class="bg-[#072928] text-white py-3.5 px-6 flex flex-col md:flex-row justify-between items-center gap-3 border-b border-teal-950 no-print">
            
            <!-- الجهة اليمنى: التاريخ والوقت الهجري/الميلادي والساعة -->
            <div class="flex flex-col text-xs text-gold font-bold text-right">
                <span id="header_date"><?php echo date('Y/m/d'); ?> م</span>
                <span id="header_clock" class="mt-1 font-mono">00:00:00 م</span>
            </div>

            <!-- المنتصف: شريط الترحيب المتحرك المميز -->
            <div class="flex-1 max-w-xl bg-teal-950/60 border border-teal-900 px-4 py-1.5 rounded-lg text-center overflow-hidden">
                <marquee direction="right" scrollamount="4" class="text-xs md:text-sm font-semibold text-gray-100">
                    مرحباً بك في نظام متابعة الحضور والغياب لطلاب كلية سماء المتميزين للعلوم الصحية والتكنولوجيا باستخدام تقنية البصمة
                </marquee>
            </div>

            <!-- الجهة اليسرى: دور المستخدم والاسم -->
            <div class="flex items-center gap-3 bg-white/5 border border-white/10 px-4 py-1.5 rounded-lg text-xs md:text-sm">
                <span class="text-gold font-bold">الدور:</span>
                <span class="font-bold text-white"><?php echo $_SESSION['permission'] >= 3 ? 'admin' : 'staff'; ?></span>
                <span class="text-gray-400">|</span>
                <span class="font-medium text-gray-300"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
            </div>

        </header>

        <!-- الجزء الفرعي للتنقل والتحديث السريع -->
        <div class="bg-gray-200 border-b border-gray-300 px-6 py-2 flex justify-between items-center no-print text-xs md:text-sm">
            <div class="flex items-center gap-2">
                <button type="button" onclick="location.reload()" class="bg-white hover:bg-gray-50 border border-gray-400 text-gray-700 px-3 py-1.5 rounded font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-rotate"></i> حديث البيانات
                </button>
                <button type="button" onclick="history.back()" class="bg-white hover:bg-gray-50 border border-gray-400 text-gray-700 px-3 py-1.5 rounded font-bold transition flex items-center gap-1.5">
                    <i class="fa-solid fa-circle-arrow-left"></i> رجوع
                </button>
            </div>
            
            <div class="font-bold text-gray-700">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</div>
        </div>

        <!-- بداية منطقة المحتوى الفعلي للصفحات -->
        <div class="p-6 flex-grow">
