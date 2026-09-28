<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

// جلب بيانات الطالب المحدثة
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$is_paid = ($user['payment_status'] === 'paid');
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة الطالب - كلية سماء المتميزين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#006654',
                        primaryDark: '#004c3f',
                        gold: '#c5a059',
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-cairo bg-gray-100 min-h-screen flex flex-col">
    <!-- الشريط العلوي -->
    <nav class="bg-primary text-white shadow-lg no-print">
        <div class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center gap-3">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-graduation-cap text-2xl text-gold"></i>
                <span class="text-xl font-bold">كلية سماء المتميزين</span>
                <span class="text-xs text-gold bg-white/10 px-3 py-1 rounded">بوابة الطالب</span>
            </div>
            
            <!-- قائمة التنقل -->
            <div class="flex items-center gap-2 md:gap-4 flex-wrap">
                <a href="dashboard.php" class="bg-white/20 px-3 py-1 rounded-lg text-sm font-semibold">الرئيسية</a>
                <a href="grades.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الدرجات</a>
                <a href="schedule.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الجدول</a>
                <a href="lectures.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">المحاضرات</a>
                <a href="study_plan.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الخطة الدراسية</a>
                <a href="upload_receipt.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">رفع إيصال الدفع</a>
                <a href="academic_groups.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition flex items-center gap-1"><i class="fa-solid fa-comments"></i> المجموعات</a>
                <a href="../logout.php" class="bg-red-50 hover:bg-red-600 px-3 py-1 rounded-lg transition text-sm text-red-700 hover:text-white font-bold">
                    <i class="fa-solid fa-sign-out-alt"></i> خروج
                </a>
            </div>
        </div>
    </nav>

    <!-- المحتوى الرئيسي -->
    <div class="container mx-auto px-4 py-8 flex-grow">
        
        <!-- معلومات الطالب -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6 border-r-4 border-primary">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div class="space-y-1.5">
                    <h2 class="text-2xl font-bold text-gray-800">مرحباً، <?php echo $user['full_name']; ?></h2>
                    <p class="text-gray-500"><i class="fa-solid fa-id-card ml-1"></i> الرقم الجامعي: <span class="font-mono"><?php echo $user['student_id']; ?></span></p>
                    <p class="text-gray-500"><i class="fa-solid fa-graduation-cap ml-1"></i> القسم: <?php echo $user['department']; ?> | المستوى: <?php echo $user['level'] ?? '-'; ?></p>
                    <p class="text-gray-500">
                        <i class="fa-solid fa-wallet ml-1"></i> حالة الرسوم: 
                        <span class="<?php echo $is_paid ? 'text-green-600' : 'text-red-600'; ?> font-bold">
                            <?php echo $is_paid ? '✅ مدفوع ومفعل' : '❌ غير مدفوع'; ?>
                        </span>
                    </p>
                </div>
                <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center border shadow-inner">
                    <?php if (!empty($user['image']) && file_exists('../' . $user['image'])): ?>
                        <img src="../<?php echo $user['image']; ?>" class="w-20 h-20 rounded-full object-cover">
                    <?php else: ?>
                        <i class="fa-solid fa-user-graduate text-4xl text-primary"></i>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- تنبيه عدم دفع الرسوم -->
        <?php if (!$is_paid): ?>
        <div class="bg-red-50 border-r-4 border-red-500 p-5 rounded-lg mb-6 shadow-sm flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="font-bold text-red-700 flex items-center gap-2">
                    <i class="fa-solid fa-circle-exclamation"></i> تنبيه هام: قيود الرسوم الدراسية لم تُسدد
                </h3>
                <p class="text-gray-600 text-sm mt-1">لا يمكنك الاطلاع على درجاتك الحالية إلا بعد تسديد الرسوم ورفع إيصال الدفع ومراجعته وتأكيده من شؤون الطلاب.</p>
            </div>
            <a href="upload_receipt.php" class="bg-primary hover:bg-primaryDark text-white px-5 py-2.5 rounded-lg text-sm font-bold shadow transition flex-shrink-0 flex items-center gap-1">
                <i class="fa-solid fa-cloud-arrow-up"></i> رفع إيصال الدفع الآن
            </a>
        </div>
        <?php endif; ?>

        <!-- قائمة الخدمات الطلابية -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-6">
            <!-- الدرجات -->
            <a href="grades.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 <?php echo $is_paid ? 'border-primary' : 'border-gray-300 opacity-60'; ?>">
                <div class="w-16 h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4 <?php echo $is_paid ? 'group-hover:bg-primary group-hover:text-white' : ''; ?> transition">
                    <i class="fa-solid fa-chart-simple text-2xl text-primary <?php echo $is_paid ? 'group-hover:text-white' : 'text-gray-400'; ?>"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">الدرجات والنتائج</h3>
                <p class="text-gray-500 text-xs mt-1"><?php echo $is_paid ? 'عرض كشف الدرجات والرسم البياني' : 'محجوبة حتى سداد الرسوم'; ?></p>
            </a>

            <!-- الجدول الدراسي -->
            <a href="schedule.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 border-gold">
                <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-gold group-hover:text-white transition">
                    <i class="fa-solid fa-calendar-days text-2xl text-gold group-hover:text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">الجدول الدراسي</h3>
                <p class="text-gray-500 text-xs mt-1">عرض مواعيد المحاضرات الأسبوعية</p>
            </a>

            <!-- المحاضرات -->
            <a href="lectures.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 border-blue-500">
                <div class="w-16 h-16 bg-blue-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-blue-500 group-hover:text-white transition">
                    <i class="fa-solid fa-file-pdf text-2xl text-blue-500 group-hover:text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">المحاضرات</h3>
                <p class="text-gray-500 text-xs mt-1">تحميل المحاضرات والمقررات بصيغة PDF</p>
            </a>

            <!-- الخطة الدراسية -->
            <a href="study_plan.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 border-purple-500">
                <div class="w-16 h-16 bg-purple-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-purple-500 group-hover:text-white transition">
                    <i class="fa-solid fa-book-open text-2xl text-purple-500 group-hover:text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">الخطة الدراسية</h3>
                <p class="text-gray-500 text-xs mt-1">عرض المقررات والمستويات لتخصصك</p>
            </a>

            <!-- رفع إيصال الدفع -->
            <a href="upload_receipt.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 border-green-500">
                <div class="w-16 h-16 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-green-500 group-hover:text-white transition">
                    <i class="fa-solid fa-receipt text-2xl text-green-500 group-hover:text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">إيصالات الدفع</h3>
                <p class="text-gray-500 text-xs mt-1">رفع إيصالات رسوم الدراسة لمراجعتها</p>
            </a>

            <!-- المجموعات الأكاديمية المشتركة -->
            <a href="academic_groups.php" class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition text-center group border-b-4 border-sky-500">
                <div class="w-16 h-16 bg-sky-500/10 rounded-full flex items-center justify-center mx-auto mb-4 group-hover:bg-sky-500 group-hover:text-white transition">
                    <i class="fa-solid fa-comments text-2xl text-sky-500 group-hover:text-white"></i>
                </div>
                <h3 class="text-lg font-bold text-gray-800">مجموعة التخصص</h3>
                <p class="text-gray-500 text-xs mt-1">تواصل تفاعلي فوري مع العمادة والدكاترة</p>
            </a>
        </div>
    </div>

    <!-- التذييل -->
    <footer class="bg-primaryDark text-white py-4 text-center text-sm no-print mt-auto">
        <p>© 2026 كلية سماء المتميزين - جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>