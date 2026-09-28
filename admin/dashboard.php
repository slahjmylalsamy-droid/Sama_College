<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff') {
    header("Location: ../login.php");
    exit();
}

$permission = $_SESSION['permission'] ?? 0;
$is_admin = ($permission >= 3);

// جلب إحصائيات سريعة
$students_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role='student'");
$students = mysqli_fetch_assoc($students_count)['count'];

$pending_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role='student' AND payment_status='pending'"))['count'];
$unpaid_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role='student' AND payment_status='unpaid'"))['count'];
$paid_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role='student' AND payment_status='paid'"))['count'];

$staff_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM users WHERE role='staff'"))['count'];

$subjects_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM subjects");
$subjects = mysqli_fetch_assoc($subjects_count)['count'];

$lectures_count = mysqli_query($conn, "SELECT COUNT(*) as count FROM lectures");
$lectures = mysqli_fetch_assoc($lectures_count)['count'];

$announcements_count = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as count FROM announcements"))['count'];
?>

<?php include_once 'header.php'; ?>
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-r-4 border-gold">
            <h2 class="text-2xl font-bold text-gray-800">مرحباً، <?php echo $_SESSION['user_name']; ?></h2>
            <p class="text-gray-500 mt-1"><?php echo $is_admin ? '🔑 لديك صلاحيات كاملة لإدارة جميع جوانب النظام.' : '📋 يمكنك إدارة الدرجات، رفع المحاضرات، وإضافة الإعلانات.'; ?></p>
        </div>

        <!-- بطاقات الإحصائيات -->
        <?php if ($is_admin): ?>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-blue-500">
                <p class="text-gray-500 text-sm font-semibold">إجمالي الطلاب</p>
                <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $students; ?></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-yellow-500">
                <p class="text-gray-500 text-sm font-semibold">طلب التحاق معلق</p>
                <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $pending_count; ?></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-orange-500">
                <p class="text-gray-500 text-sm font-semibold">غير مدفوع</p>
                <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $unpaid_count; ?></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-green-500">
                <p class="text-gray-500 text-sm font-semibold">مدفوع ومفعل</p>
                <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $paid_count; ?></p>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-gold">
                <p class="text-gray-500 text-sm font-semibold">الموظفين</p>
                <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $staff_count; ?></p>
            </div>
        </div>
        <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-primary">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">المواد المسجلة</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $subjects; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-book text-2xl text-primary"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-blue-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">المحاضرات المرفوعة</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $lectures; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-blue-500/10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-file-pdf text-2xl text-blue-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-green-500">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">الإعلانات المنشورة</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $announcements_count; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-green-500/10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-bullhorn text-2xl text-green-500"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6 border-r-4 border-gold">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="text-gray-500 text-sm font-semibold">إجمالي الطلاب</p>
                        <p class="text-3xl font-bold text-gray-800 mt-1"><?php echo $students; ?></p>
                    </div>
                    <div class="w-12 h-12 bg-gold/10 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-users text-2xl text-gold"></i>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>

        <!-- الإشعارات الإدارية والتنبيهات -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-bell text-red-500 animate-pulse"></i> الإشعارات والتنبيهات الإدارية الأخيرة
            </h2>
            <div class="divide-y divide-gray-100">
                <?php
                $my_user_id = intval($_SESSION['user_id']);
                $notifs_query = mysqli_query($conn, "SELECT * FROM notifications WHERE user_id = $my_user_id ORDER BY id DESC LIMIT 6");
                if ($notifs_query && mysqli_num_rows($notifs_query) > 0):
                    while ($notif = mysqli_fetch_assoc($notifs_query)):
                ?>
                    <div class="flex items-start gap-3 py-3.5 last:pb-0 first:pt-0">
                        <div class="text-xl text-amber-500 bg-amber-50 w-10 h-10 rounded-full flex items-center justify-center shrink-0">
                            <i class="fa-solid fa-circle-exclamation"></i>
                        </div>
                        <div>
                            <p class="text-sm font-semibold text-gray-800"><?php echo htmlspecialchars($notif['message']); ?></p>
                            <span class="text-xs text-gray-400 font-medium"><?php echo htmlspecialchars($notif['created_at']); ?></span>
                        </div>
                    </div>
                <?php 
                    endwhile;
                else:
                ?>
                    <p class="text-gray-400 italic text-sm text-center py-4">لا توجد تنبيهات أو إشعارات إدارية جديدة.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- قائمة المهام السريعة -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-primary"></i> المهام السريعة
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <?php if ($is_admin): ?>
                <a href="manage_students.php" class="bg-primary/5 hover:bg-primary/10 border border-primary/20 text-primary p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-user-plus text-3xl mb-3"></i>
                    <span class="text-sm font-bold">إدارة الطلاب</span>
                </a>
                <a href="manage_staff.php" class="bg-gold/5 hover:bg-gold/10 border border-gold/20 text-gold p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-user-shield text-3xl mb-3"></i>
                    <span class="text-sm font-bold">إدارة الموظفين</span>
                </a>
                <?php endif; ?>
                <a href="manage_grades.php" class="bg-blue-500/5 hover:bg-blue-500/10 border border-blue-500/20 text-blue-600 p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-pen-to-square text-3xl mb-3"></i>
                    <span class="text-sm font-bold">إدارة الدرجات</span>
                </a>
                <a href="upload_lecture.php" class="bg-purple-500/5 hover:bg-purple-500/10 border border-purple-500/20 text-purple-600 p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-cloud-upload-alt text-3xl mb-3"></i>
                    <span class="text-sm font-bold">رفع محاضرة</span>
                </a>
                <a href="announcements.php" class="bg-green-500/5 hover:bg-green-500/10 border border-green-500/20 text-green-600 p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-plus-circle text-3xl mb-3"></i>
                    <span class="text-sm font-bold">إضافة إعلان</span>
                </a>
                <?php if ($is_admin): ?>
                <a href="manage_schedule.php" class="bg-orange-500/5 hover:bg-orange-500/10 border border-orange-500/20 text-orange-600 p-4 rounded-xl text-center transition flex flex-col items-center justify-center shadow-sm">
                    <i class="fa-solid fa-calendar-days text-3xl mb-3"></i>
                    <span class="text-sm font-bold">الجدول الدراسي</span>
                </a>
                <?php endif; ?>
            </div>
        </div>

        <!-- آخر الإعلانات المضافة -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-bullhorn text-gold"></i> الإعلانات الأخيرة المنشورة
            </h2>
            <?php
            $ann_query = mysqli_query($conn, "SELECT a.*, u.full_name FROM announcements a JOIN users u ON a.created_by = u.id ORDER BY a.created_at DESC LIMIT 3");
            if (mysqli_num_rows($ann_query) > 0):
                while ($ann = mysqli_fetch_assoc($ann_query)):
            ?>
                <div class="border-r-4 border-gold pr-4 py-3 bg-gray-50 rounded-lg mb-3 shadow-inner">
                    <h3 class="font-bold text-gray-800 text-lg"><?php echo $ann['title']; ?></h3>
                    <p class="text-gray-600 mt-1 text-sm"><?php echo $ann['content']; ?></p>
                    <div class="flex justify-between items-center mt-2 text-xs text-gray-400">
                        <span>بواسطة: <?php echo $ann['full_name']; ?></span>
                        <span><i class="fa-regular fa-clock ml-1"></i> <?php echo date('d/m/Y h:i A', strtotime($ann['created_at'])); ?></span>
                    </div>
                </div>
            <?php 
                endwhile;
            else: 
            ?>
                <p class="text-gray-500 text-center py-8">لا توجد إعلانات منشورة حتى الآن.</p>
            <?php endif; ?>
        </div>
<?php include_once 'footer.php'; ?>