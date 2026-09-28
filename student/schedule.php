<?php
require_once '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

// جلب الجدول الدراسي
$query = "
    SELECT s.subject_name, sch.day_of_week, sch.start_time, sch.end_time, sch.room
    FROM schedule sch
    JOIN subjects s ON sch.subject_id = s.id
    ORDER BY FIELD(sch.day_of_week, 'السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس')
";
$schedule = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الجدول الدراسي - كلية سماء المتميزين</title>
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
<body class="font-cairo bg-gray-100">
    <nav class="bg-primary text-white shadow-lg">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-3">
                <i class="fa-solid fa-graduation-cap text-2xl text-gold"></i>
                <span class="text-xl font-bold">كلية سماء المتميزين</span>
                <span class="text-sm text-gold bg-white/10 px-3 py-1 rounded">الجدول الدراسي</span>
            </div>
            <div class="flex items-center gap-4">
                <span class="hidden md:inline">مرحباً، <?php echo $_SESSION['user_name']; ?></span>
                <a href="dashboard.php" class="bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg transition text-sm">
                    <i class="fa-solid fa-arrow-right ml-1"></i> العودة
                </a>
                <a href="../logout.php" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded-lg transition text-sm">
                    <i class="fa-solid fa-sign-out-alt ml-1"></i> خروج
                </a>
            </div>
        </div>
    </nav>

    <div class="container mx-auto px-4 py-8">
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-primary"></i> جدول المحاضرات الأسبوعي
            </h2>
            <p class="text-gray-500">الأسبوع الدراسي الحالي</p>
        </div>

        <?php if (mysqli_num_rows($schedule) > 0): ?>
            <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-primary text-white">
                            <th class="px-4 py-3 rounded-tr-lg">اليوم</th>
                            <th class="px-4 py-3">المادة</th>
                            <th class="px-4 py-3">من</th>
                            <th class="px-4 py-3">إلى</th>
                            <th class="px-4 py-3 rounded-tl-lg">القاعة</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $day_colors = [
                            'السبت' => 'border-blue-500',
                            'الأحد' => 'border-green-500',
                            'الاثنين' => 'border-yellow-500',
                            'الثلاثاء' => 'border-purple-500',
                            'الأربعاء' => 'border-pink-500',
                            'الخميس' => 'border-orange-500',
                        ];
                        while ($row = mysqli_fetch_assoc($schedule)): 
                            $color = $day_colors[$row['day_of_week']] ?? 'border-gray-300';
                        ?>
                        <tr class="border-r-4 <?php echo $color; ?> hover:bg-gray-50 transition">
                            <td class="px-4 py-3 font-bold"><?php echo $row['day_of_week']; ?></td>
                            <td class="px-4 py-3"><?php echo $row['subject_name']; ?></td>
                            <td class="px-4 py-3"><?php echo date('h:i A', strtotime($row['start_time'])); ?></td>
                            <td class="px-4 py-3"><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                            <td class="px-4 py-3"><?php echo $row['room'] ?? 'غير محدد'; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

            <!-- زر الطباعة -->
            <div class="mt-6 text-center">
                <button onclick="window.print()" class="bg-primary hover:bg-primaryDark text-white font-bold py-2 px-6 rounded-lg transition">
                    <i class="fa-solid fa-print ml-2"></i> طباعة الجدول
                </button>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <i class="fa-solid fa-calendar-xmark text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">لا يوجد جدول دراسي مسجل حتى الآن.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>