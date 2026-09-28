<?php
require_once 'db_connect.php';

// إذا كان المستخدم مسجل دخوله مسبقاً، يوجه للوحة التحكم المناسبة
if (isset($_SESSION['user_id'])) {
    if ($_SESSION['role'] == 'staff') {
        header("Location: admin/dashboard.php");
    } else {
        header("Location: student/dashboard.php");
    }
    exit();
}

$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        
        if ($user['payment_status'] === 'pending') {
            $error = "<i class='fa-solid fa-triangle-exclamation' style='margin-left: 5px;'></i> حسابك قيد المراجعة. سيتم إشعارك عند قبول طلبك.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['permission'] = $user['permission_level'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['payment_status'] = $user['payment_status'];
            
            if ($user['role'] == 'staff') {
                header("Location: admin/dashboard.php");
            } else {
                header("Location: student/dashboard.php");
            }
            exit();
        }
    } else {
        $error = "البريد الإلكتروني أو كلمة المرور غير صحيحة";
    }
}
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول - كلية سماء المتميزين</title>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#006654',
                        primaryLight: '#00856e',
                        primaryDark: '#004c3f',
                        gold: '#c5a059',
                        goldLight: '#dcc18b',
                    },
                    fontFamily: {
                        cairo: ['Cairo', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>
<body class="font-cairo bg-gray-50 min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full p-8 border-t-4 border-gold">
        <div class="text-center mb-8">
            <div class="w-20 h-20 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-4">
                <i class="fa-solid fa-graduation-cap text-4xl text-primary"></i>
            </div>
            <h2 class="text-2xl font-bold text-primary">كلية سماء المتميزين</h2>
            <p class="text-gray-500 text-sm">للعلوم الصحية والتكنولوجيا</p>
        </div>
        
        <h3 class="text-xl font-bold text-center text-gray-800 mb-6">تسجيل الدخول إلى البوابة الإلكترونية</h3>
        
        <?php if ($error): ?>
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded mb-4 text-center">
                <i class="fa-solid fa-circle-exclamation ml-2"></i>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="mb-4">
                <label class="block text-gray-700 font-semibold mb-2">البريد الإلكتروني</label>
                <div class="relative">
                    <i class="fa-solid fa-envelope absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="email" name="email" required class="w-full border border-gray-300 rounded-lg py-3 pr-10 pl-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="admin@college.com">
                </div>
            </div>
            
            <div class="mb-6">
                <label class="block text-gray-700 font-semibold mb-2">كلمة المرور</label>
                <div class="relative">
                    <i class="fa-solid fa-lock absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="password" name="password" required class="w-full border border-gray-300 rounded-lg py-3 pr-10 pl-3 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary" placeholder="••••••">
                </div>
            </div>
            
            <button type="submit" class="w-full bg-primary hover:bg-primaryDark text-white font-bold py-3 rounded-lg transition duration-300 shadow-lg hover:shadow-xl">
                <i class="fa-solid fa-arrow-left ml-2"></i> دخول
            </button>
        </form>
        
        <div class="text-center mt-6 text-sm text-gray-500 bg-gray-50 p-3 rounded-lg">
            <p class="font-semibold text-gray-700">بيانات الدخول التجريبية:</p>
            <p>👤 admin@college.com | 🔑 123456</p>
            <p class="mt-1">👤 ahmed@student.com | 🔑 123456</p>
        </div>
        
        <div class="text-center mt-6">
            <a href="index.php" class="text-primary hover:text-primaryDark hover:underline transition">
                <i class="fa-solid fa-arrow-right ml-1"></i> العودة إلى الصفحة الرئيسية
            </a>
        </div>
    </div>
</body>
</html>