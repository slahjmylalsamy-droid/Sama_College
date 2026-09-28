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

// 1. معالجة حذف محاضرة
// -------------------------------------------------------------
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    
    // جلب مسار الملف لحذفه من الخادم
    $file_query = mysqli_query($conn, "SELECT file_path FROM lectures WHERE id = $delete_id");
    if ($file_row = mysqli_fetch_assoc($file_query)) {
        $file_to_delete = '../' . $file_row['file_path'];
        if (!empty($file_row['file_path']) && file_exists($file_to_delete)) {
            unlink($file_to_delete);
        }
    }
    
    $query = "DELETE FROM lectures WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        header("Location: upload_lecture.php?msg=deleted");
        exit();
    } else {
        $error = "❌ خطأ أثناء حذف المحاضرة: " . mysqli_error($conn);
    }
}

// 2. معالجة رفع محاضرة جديدة
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_lecture'])) {
    $subject_id = intval($_POST['subject_id']);
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $file_path = '';
    
    if (isset($_FILES['lecture_file']) && $_FILES['lecture_file']['error'] == 0) {
        $allowed = ['pdf'];
        $ext = strtolower(pathinfo($_FILES['lecture_file']['name'], PATHINFO_EXTENSION));
        
        if ($ext !== 'pdf') {
            $error = "❌ خطأ: يرجى رفع ملفات بصيغة PDF فقط!";
        } else {
            $new_filename = time() . '_' . $subject_id . '_' . rand(100, 999) . '.' . $ext;
            $target = '../uploads/lectures/' . $new_filename;
            
            // التأكد من وجود المجلد
            if (!file_exists('../uploads/lectures')) {
                mkdir('../uploads/lectures', 0777, true);
            }
            
            if (move_uploaded_file($_FILES['lecture_file']['tmp_name'], $target)) {
                $file_path = 'uploads/lectures/' . $new_filename;
            } else {
                $error = "❌ خطأ أثناء نقل الملف إلى خادم الرفع.";
            }
        }
    } else {
        $error = "❌ خطأ: لم يتم اختيار ملف أو حدثت مشكلة أثناء الرفع.";
    }
    
    if ($file_path) {
        $query = "INSERT INTO lectures (subject_id, title, file_path, uploaded_by) VALUES ($subject_id, '$title', '$file_path', $user_id)";
        if (mysqli_query($conn, $query)) {
            // إرسال إشعار لجميع طلاب هذا القسم أو الكلية بشكل عام
            // هنا نرسل إشعاراً عاماً للطلاب (نقوم بإضافته في جدول الإشعارات)
            $students_res = mysqli_query($conn, "SELECT id FROM users WHERE role='student'");
            $subject_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT subject_name FROM subjects WHERE id=$subject_id"))['subject_name'];
            $notif_msg = "📚 تم رفع محاضرة جديدة بعنوان ($title) في مادة ($subject_name).";
            while ($student = mysqli_fetch_assoc($students_res)) {
                $s_id = $student['id'];
                mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($s_id, '$notif_msg')");
            }
            
            $msg = "✅ تم رفع وتوثيق المحاضرة بنجاح!";
        } else {
            $error = "❌ خطأ أثناء الحفظ في قاعدة البيانات: " . mysqli_error($conn);
        }
    }
}

// 3. جلب رسائل الحالة
// -------------------------------------------------------------
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "🗑️ تم حذف المحاضرة وملفها من الخادم بنجاح.";
}

// 4. جلب المواد والمحاضرات المرفوعة
// -------------------------------------------------------------
$subjects = mysqli_query($conn, "SELECT * FROM subjects");
$lectures_list = mysqli_query($conn, "
    SELECT l.*, s.subject_name, u.full_name 
    FROM lectures l 
    JOIN subjects s ON l.subject_id = s.id 
    JOIN users u ON l.uploaded_by = u.id 
    ORDER BY l.upload_date DESC
");
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

        <!-- إضافة محاضرة جديدة -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-primary max-w-3xl mx-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-cloud-arrow-up text-primary"></i> رفع ملف محاضرة جديد (PDF)
            </h2>
            <form method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اختر المادة</label>
                    <select name="subject_id" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر المادة...</option>
                        <?php while($row = mysqli_fetch_assoc($subjects)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?> (<?php echo $row['subject_code']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">عنوان المحاضرة</label>
                    <input type="text" name="title" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary" placeholder="مثال: الفصل الأول - مقدمة عامة">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">ملف المحاضرة (صيغة PDF فقط)</label>
                    <input type="file" name="lecture_file" accept=".pdf" required class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
                <button type="submit" name="upload_lecture" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow-md w-full">
                    <i class="fa-solid fa-upload ml-1"></i> رفع ونشر المحاضرة للطلاب
                </button>
            </form>
        </div>

        <!-- جدول قائمة المحاضرات المرفوعة -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-file-pdf text-primary"></i> المحاضرات المرفوعة حالياً بالكلية
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-sm font-bold border-b">اسم المادة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">عنوان المحاضرة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">رُفعت بواسطة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">تاريخ الرفع</th>
                        <th class="px-4 py-3 text-sm font-bold border-b text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (mysqli_num_rows($lectures_list) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($lectures_list)): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo $row['subject_name']; ?></td>
                            <td class="px-4 py-3 text-sm flex items-center gap-2">
                                <i class="fa-regular fa-file-pdf text-red-500 text-lg"></i>
                                <a href="../<?php echo $row['file_path']; ?>" target="_blank" class="text-primary hover:underline font-semibold">
                                    <?php echo $row['title']; ?>
                                </a>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-500"><?php echo $row['full_name']; ?></td>
                            <td class="px-4 py-3 text-sm text-gray-400 font-mono"><?php echo date('d/m/Y h:i A', strtotime($row['upload_date'])); ?></td>
                            <td class="px-4 py-3 text-sm text-center">
                                <div class="flex gap-2 justify-center">
                                    <a href="../<?php echo $row['file_path']; ?>" target="_blank" class="bg-primary hover:bg-primaryDark text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition">
                                        <i class="fa-regular fa-eye"></i> عرض
                                    </a>
                                    <?php if ($is_admin || $row['uploaded_by'] == $user_id): ?>
                                        <a href="upload_lecture.php?delete=<?php echo $row['id']; ?>" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1 rounded text-xs font-semibold shadow-sm transition border border-red-200" onclick="return confirm('هل تريد حذف هذه المحاضرة نهائياً من خادم الكلية؟')">
                                            <i class="fa-solid fa-trash-can"></i> حذف
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center text-gray-500 py-8">لا توجد محاضرات مرفوعة حالياً.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
