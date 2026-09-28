<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول وأن المستخدم موظف أو مدير (صلاحية >= 2)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 2) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";
$permission = $_SESSION['permission'] ?? 0;
$is_admin = ($permission >= 3);
$user_id = $_SESSION['user_id'];

// 1. معالجة حذف إعلان
// -------------------------------------------------------------
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $query = "DELETE FROM announcements WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        header("Location: announcements.php?msg=deleted");
        exit();
    } else {
        $error = "❌ خطأ أثناء حذف الإعلان: " . mysqli_error($conn);
    }
}

// 2. معالجة إضافة إعلان جديد
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_announcement'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $content = mysqli_real_escape_string($conn, $_POST['content']);
    
    $query = "INSERT INTO announcements (title, content, created_by) VALUES ('$title', '$content', $user_id)";
    if (mysqli_query($conn, $query)) {
        // إرسال إشعار لكافة الطلاب
        $students_res = mysqli_query($conn, "SELECT id FROM users WHERE role='student'");
        $notif_msg = "📢 إعلان جديد: $title";
        while ($student = mysqli_fetch_assoc($students_res)) {
            $s_id = $student['id'];
            mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($s_id, '$notif_msg')");
        }
        
        $msg = "✅ تم نشر الإعلان للطلاب بنجاح!";
    } else {
        $error = "❌ خطأ أثناء النشر: " . mysqli_error($conn);
    }
}

// 3. جلب رسائل الحالة
// -------------------------------------------------------------
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "🗑️ تم حذف الإعلان بنجاح من البوابة العامة للكلية.";
}

// 4. جلب قائمة الإعلانات
// -------------------------------------------------------------
$announcements = mysqli_query($conn, "SELECT a.*, u.full_name FROM announcements a JOIN users u ON a.created_by = u.id ORDER BY a.created_at DESC");
?>

<?php include_once 'header.php'; ?>
        <!-- الرسائل -->
        <?php if ($msg): ?>
            <div class="bg-green-100 border-r-4 border-green-500 text-green-700 px-4 py-3 rounded-lg mb-6 shadow">
                <?php echo $msg; ?>
            </div>
        <?php endif; ?>
        <?php if ($error): ?>
            <div class="bg-red-100 border-r-4 border-red-500 text-red-700 px-4 py-3 rounded-lg mb-6 shadow">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <!-- نشر إعلان جديد -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-primary max-w-3xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-bullhorn text-primary"></i> نشر إعلان عام جديد بالكلية
            </h2>
            <form method="POST" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">عنوان الإعلان</label>
                    <input type="text" name="title" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary" placeholder="أدخل عنواناً واضحاً ومختصراً...">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">محتوى الإعلان بالتفصيل</label>
                    <textarea name="content" required rows="5" class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary" placeholder="اكتب محتوى الإعلان هنا..."></textarea>
                </div>
                <button type="submit" name="add_announcement" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow-md w-full">
                    <i class="fa-solid fa-paper-plane ml-1"></i> نشر الإعلان فوراً للطلاب
                </button>
            </form>
        </div>

        <!-- قائمة الإعلانات الحالية -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-list-ul text-primary"></i> الإعلانات المنشورة حالياً بالبوابة
            </h2>
            <div class="space-y-4">
                <?php if (mysqli_num_rows($announcements) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($announcements)): ?>
                        <div class="border border-gray-200 hover:border-gold rounded-xl p-5 bg-gray-50 flex flex-col md:flex-row justify-between items-start md:items-center gap-4 transition shadow-sm border-r-4 border-r-gold">
                            <div class="flex-grow">
                                <h3 class="font-bold text-gray-800 text-lg"><?php echo $row['title']; ?></h3>
                                <p class="text-gray-600 mt-2 text-sm whitespace-pre-wrap"><?php echo $row['content']; ?></p>
                                <div class="flex items-center gap-4 mt-3 text-xs text-gray-400">
                                    <span><i class="fa-solid fa-user ml-1"></i> الكاتب: <?php echo $row['full_name']; ?></span>
                                    <span><i class="fa-regular fa-calendar ml-1"></i> <?php echo date('d/m/Y h:i A', strtotime($row['created_at'])); ?></span>
                                </div>
                            </div>
                            <div class="w-full md:w-auto text-left flex-shrink-0">
                                <a href="announcements.php?delete=<?php echo $row['id']; ?>" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1.5 rounded-lg text-xs font-semibold shadow-sm transition border border-red-200 inline-block text-center" onclick="return confirm('هل أنت متأكد من حذف هذا الإعلان نهائياً من الكلية؟')">
                                    <i class="fa-solid fa-trash-can ml-1"></i> حذف الإعلان
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>
                <?php else: ?>
                    <p class="text-gray-500 text-center py-8">لا توجد إعلانات منشورة حتى الآن.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
