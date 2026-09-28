<?php
require_once '../db_connect.php';

if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'student') {
    header("Location: ../login.php");
    exit();
}

// جلب المحاضرات
$query = "
    SELECT l.*, s.subject_name, u.full_name as uploaded_by_name
    FROM lectures l
    JOIN subjects s ON l.subject_id = s.id
    JOIN users u ON l.uploaded_by = u.id
    ORDER BY l.upload_date DESC
";
$lectures = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <title>المحاضرات - كلية سماء المتميزين</title>
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
                <span class="text-sm text-gold bg-white/10 px-3 py-1 rounded">المحاضرات</span>
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
                <i class="fa-solid fa-file-pdf text-red-500"></i> المحاضرات الدراسية
            </h2>
            <p class="text-gray-500">جميع المحاضرات المتاحة للطلاب بصيغة PDF</p>
        </div>

        <?php if (mysqli_num_rows($lectures) > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <?php while ($row = mysqli_fetch_assoc($lectures)): ?>
                <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition group border-b-4 border-primary">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-14 h-14 bg-red-100 rounded-lg flex items-center justify-center text-red-500 text-2xl group-hover:bg-red-500 group-hover:text-white transition">
                            <i class="fa-regular fa-file-pdf"></i>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800 text-lg line-clamp-1"><?php echo $row['title']; ?></h3>
                            <span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded"><?php echo $row['subject_name']; ?></span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mb-2">
                        <i class="fa-regular fa-user ml-1"></i> رفع بواسطة: <?php echo $row['uploaded_by_name']; ?>
                    </p>
                    <p class="text-sm text-gray-400 mb-4">
                        <i class="fa-regular fa-calendar ml-1"></i> <?php echo date('d/m/Y h:i A', strtotime($row['upload_date'])); ?>
                    </p>
                    <a href="../<?php echo $row['file_path']; ?>" target="_blank" class="block text-center bg-primary hover:bg-primaryDark text-white font-bold py-2 rounded-lg transition">
                        <i class="fa-regular fa-eye ml-2"></i> عرض المحاضرة
                    </a>
                </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <div class="bg-white rounded-xl shadow-md p-6 text-center">
                <i class="fa-solid fa-file-circle-xmark text-4xl text-gray-300 mb-4"></i>
                <p class="text-gray-500">لا توجد محاضرات متاحة حالياً.</p>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>