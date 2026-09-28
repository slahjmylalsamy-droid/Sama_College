<USER_REQUEST>
<?php
require_once 'db_connect.php';

// ============================================================
// 1. تحديد الصفحة المطلوبة
// ============================================================
$page = isset($_GET['p']) ? $_GET['p'] : 'home';

// ============================================================
// 2. معالجة تسجيل الدخول
// ============================================================
$login_error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($user['payment_status'] === 'pending') {
            $login_error = "⚠️ حسابك قيد المراجعة. سيتم إشعارك عند قبول طلبك.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['permission'] = $user['permission_level'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['payment_status'] = $user['payment_status'];
            if ($user['permission_level'] >= 3) {
                $page = 'admin_dashboard';
            } elseif ($user['permission_level'] >= 2) {
                $page = 'staff_dashboard';
            } else {
                $page = 'student_dashboard';
            }
        }
    } else {
        $login_error = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
    }
}

// ============================================================
// 3. معالجة تسجيل الخروج
// =============================
<truncated 45215 bytes>
===============================================
// المحاضرات
// ============================================================
elseif ($page == 'lectures' && $is_student):
    $lectures = mysqli_query($conn, "SELECT l.*, s.subject_name, u.full_name as uploaded_by_name FROM lectures l JOIN subjects s ON l.subject_id = s.id JOIN users u ON l.uploaded_by = u.id ORDER BY l.upload_date DESC");
?>
    <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">📚 المحاضرات الدراسية</h2>
        <?php if (mysqli_num_rows($lectures) > 0): ?>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <?php while($row=mysqli_fetch_assoc($lectures)): ?>
            <div class="border rounded-xl p-4 hover:shadow-lg transition">
                <div class="flex items-center gap-3 mb-3"><i class="fa-regular fa-file-pdf text-3xl text-red-500"></i><div><h3 class="font-bold"><?php echo $row['title']; ?></h3><span class="text-xs bg-primary/10 text-primary px-2 py-1 rounded"><?php echo $row['subject_name']; ?></span></div></div>
                <p class="text-sm text-gray-500">رفع بواسطة: <?php echo $row['uploaded_by_name']; ?></p>
                <p class="text-sm text-gray-400 mb-3"><?php echo date('d/m/Y', strtotime($row['upload_date'])); ?></p>
                <a href="<?php echo $row['file_path']; ?>" target="_blank" class="block text-center bg-primary text-white py-2 rounded-lg hover:bg-primaryDark transition">عرض المحاضرة</a>
            </div>
            <?php endwhile; ?>
        </div>
        <?php else: ?><p class="text-gray-500 text-center py-8">لا توجد محاضرات متاحة حالياً.</p><?php endif; ?>
    </div>

<?php
// ============================================================
// إدارة الطلاب (للمدير)
// ======
<truncated 28690 bytes>

NOTE: The output was truncated because it was too long. Use a more targeted query or a smaller range to get the information you need.