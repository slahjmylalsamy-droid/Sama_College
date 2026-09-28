<?php
require_once '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// جلب درجات الطالب
$query = "
    SELECT s.subject_name, g.final_grade, g.year_work, g.attendance_grade, g.participation_grade, g.total_grade, g.grade_letter
    FROM grades g
    JOIN subjects s ON g.subject_id = s.id
    WHERE g.student_id = $user_id
";
$grades = mysqli_query($conn, $query);

// جلب بيانات الطالب
$user_query = "SELECT * FROM users WHERE id = $user_id";
$user_result = mysqli_query($conn, $user_query);
$user = mysqli_fetch_assoc($user_result);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>الدرجات - كلية سماء المتميزين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <span class="text-sm text-gold bg-white/10 px-3 py-1 rounded">الدرجات</span>
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
            <h2 class="text-2xl font-bold text-gray-800">📊 درجاتي الدراسية</h2>
            <p class="text-gray-500">الاسم: <?php echo $user['full_name']; ?> | الرقم الجامعي: <?php echo $user['student_id']; ?></p>
        </div>

        <?php if ($user['payment_status'] === 'paid'): ?>
            <?php if (mysqli_num_rows($grades) > 0): ?>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <!-- جدول الدرجات -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">تفاصيل الدرجات</h3>
                        <div class="overflow-x-auto">
                            <table class="w-full text-right">
                                <thead class="bg-gray-100">
                                    <tr>
                                        <th class="px-4 py-2">المادة</th>
                                        <th class="px-4 py-2">نهائي</th>
                                        <th class="px-4 py-2">أعمال سنة</th>
                                        <th class="px-4 py-2">حضور</th>
                                        <th class="px-4 py-2">مشاركة</th>
                                        <th class="px-4 py-2">المجموع</th>
                                        <th class="px-4 py-2">التقدير</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row = mysqli_fetch_assoc($grades)): ?>
                                    <tr class="border-b hover:bg-gray-50">
                                        <td class="px-4 py-2 font-semibold"><?php echo $row['subject_name']; ?></td>
                                        <td class="px-4 py-2"><?php echo $row['final_grade'] ?? '-'; ?></td>
                                        <td class="px-4 py-2"><?php echo $row['year_work'] ?? '-'; ?></td>
                                        <td class="px-4 py-2"><?php echo $row['attendance_grade'] ?? '-'; ?></td>
                                        <td class="px-4 py-2"><?php echo $row['participation_grade'] ?? '-'; ?></td>
                                        <td class="px-4 py-2 font-bold text-primary"><?php echo $row['total_grade'] ?? '-'; ?></td>
                                        <td class="px-4 py-2">
                                            <span class="px-2 py-1 rounded text-white text-sm
                                                <?php 
                                                    $letter = $row['grade_letter'] ?? '';
                                                    if ($letter == 'A') echo 'bg-green-500';
                                                    else if ($letter == 'B') echo 'bg-blue-500';
                                                    else if ($letter == 'C') echo 'bg-yellow-500';
                                                    else if ($letter == 'D') echo 'bg-orange-500';
                                                    else echo 'bg-red-500';
                                                ?>
                                            ">
                                                <?php echo $letter; ?>
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- رسم بياني -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-bold text-gray-800 mb-4">📈 رسم بياني للتقدم</h3>
                        <canvas id="gradesChart" class="w-full h-64"></canvas>
                    </div>
                </div>
            <?php else: ?>
                <div class="bg-white rounded-xl shadow-md p-6 text-center">
                    <i class="fa-solid fa-circle-info text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">لا توجد درجات مسجلة لك حتى الآن.</p>
                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="bg-red-50 border-r-4 border-red-500 p-6 rounded-lg text-center shadow-md">
                <i class="fa-solid fa-lock text-5xl text-red-500 mb-4 animate-bounce"></i>
                <h3 class="text-xl font-bold text-red-700">⛔ غير مصرح لك بمشاهدة الدرجات والنتائج</h3>
                <p class="text-gray-600 mt-2">لم تقم بدفع الرسوم الدراسية أو أن إيصال الدفع الخاص بك قيد المراجعة حالياً.</p>
                <p class="text-gray-500 text-sm mt-1">يرجى رفع إيصال الدفع أو مراجعة شؤون الطلاب لتفعيل الحساب.</p>
                <a href="upload_receipt.php" class="inline-block mt-4 bg-primary hover:bg-primaryDark text-white px-6 py-2.5 rounded-lg transition text-sm font-bold shadow">
                    <i class="fa-solid fa-upload ml-1"></i> رفع إيصال الدفع الآن
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if ($user['payment_status'] === 'paid' && mysqli_num_rows($grades) > 0): ?>
    <script>
        // إعداد البيانات للرسم البياني
        const ctx = document.getElementById('gradesChart').getContext('2d');
        const labels = [];
        const totals = [];
        const colors = ['#006654', '#c5a059', '#3b82f6', '#f59e0b', '#ef4444', '#8b5cf6'];

        <?php 
        // إعادة تشغيل المؤشر لجلب البيانات مرة أخرى
        mysqli_data_seek($grades, 0);
        $i = 0;
        while ($row = mysqli_fetch_assoc($grades)): 
        ?>
            labels.push('<?php echo $row['subject_name']; ?>');
            totals.push(<?php echo $row['total_grade'] ?? 0; ?>);
        <?php 
            $i++;
        endwhile; 
        ?>

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'الدرجة النهائية',
                    data: totals,
                    backgroundColor: colors.slice(0, labels.length),
                    borderColor: '#006654',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        max: 100
                    }
                }
            }
        });
    </script>
    <?php endif; ?>
</body>
</html>