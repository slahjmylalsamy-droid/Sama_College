<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = $user_id";
$result = mysqli_query($conn, $query);
$user = mysqli_fetch_assoc($result);

$department = $user['department'] ?? '';

// جلب مواد القسم أو المواد العامة المشتركة
$subjects = mysqli_query($conn, "SELECT * FROM subjects WHERE department = '$department' OR department IS NULL");
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>الخطة الدراسية - كلية سماء المتميزين</title>
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
                <span class="text-xs text-gold bg-white/10 px-3 py-1 rounded">الخطة الدراسية</span>
            </div>
            
            <!-- قائمة التنقل -->
            <div class="flex items-center gap-2 md:gap-4 flex-wrap">
                <a href="dashboard.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الرئيسية</a>
                <a href="grades.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الدرجات</a>
                <a href="schedule.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">الجدول</a>
                <a href="lectures.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">المحاضرات</a>
                <a href="study_plan.php" class="bg-white/20 px-3 py-1 rounded-lg text-sm font-semibold">الخطة الدراسية</a>
                <a href="upload_receipt.php" class="hover:bg-white/10 px-3 py-1 rounded-lg text-sm transition">رفع إيصال الدفع</a>
                <a href="../logout.php" class="bg-red-50 hover:bg-red-600 px-3 py-1 rounded-lg transition text-sm">
                    <i class="fa-solid fa-sign-out-alt"></i> خروج
                </a>
            </div>
        </div>
    </nav>

    <!-- المحتوى الرئيسي -->
    <div class="container mx-auto px-4 py-8 flex-grow">
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-book-open text-primary"></i> الخطة الدراسية الأكاديمية
            </h2>
            <p class="text-gray-500 mt-1">القسم الأكاديمي: <span class="font-bold text-primary"><?php echo $department; ?></span> | مدة الدراسة: 4 سنوات (8 فصول دراسية)</p>
        </div>

        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="px-4 py-3 text-sm rounded-tr-lg">#</th>
                        <th class="px-4 py-3 text-sm">رمز المادة</th>
                        <th class="px-4 py-3 text-sm">المادة الدراسية</th>
                        <th class="px-4 py-3 text-sm rounded-tl-lg">المستوى الدراسي المقترح</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    if ($subjects && mysqli_num_rows($subjects) > 0):
                        $i = 1;
                        $levels = ['المستوى الأول', 'المستوى الثاني', 'المستوى الثالث', 'المستوى الرابع'];
                        while($row = mysqli_fetch_assoc($subjects)): 
                            $level = $levels[($i - 1) % 4];
                    ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm text-gray-400"><?php echo $i++; ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-600 font-bold"><?php echo $row['subject_code']; ?></td>
                            <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo $row['subject_name']; ?></td>
                            <td class="px-4 py-3 text-sm">
                                <span class="bg-primary/10 text-primary px-3 py-1 rounded-full text-xs font-semibold">
                                    <?php echo $row['level'] ?? $level; ?>
                                </span>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="4" class="text-center text-gray-500 py-8">لم يتم العثور على خطة دراسية مسجلة لقسمك حالياً.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-6 p-5 bg-gold/10 rounded-xl border-r-4 border-gold shadow-sm">
            <h3 class="font-bold text-gray-800 text-lg flex items-center gap-1.5">
                <i class="fa-solid fa-circle-info text-gold animate-pulse"></i> إرشادات التسجيل الأكاديمي
            </h3>
            <p class="text-gray-600 text-sm mt-2">
                1. تبدأ الدراسة الأكاديمية للفصل الأول في 1 سبتمبر 2026.<br>
                2. يجب على الطلاب مراجعة مرشديهم الأكاديميين قبل تسجيل المواد للفصل الدراسي التالي لضمان تلبية المتطلبات المسبقة للمقررات.<br>
                3. يُنصح بالالتزام بتسلسل المستويات للحفاظ على التقدم الأكاديمي.
            </p>
        </div>
    </div>

    <!-- التذييل -->
    <footer class="bg-primaryDark text-white py-4 text-center text-sm no-print mt-auto">
        <p>© 2026 كلية سماء المتميزين - جميع الحقوق محفوظة</p>
    </footer>
</body>
</html>
