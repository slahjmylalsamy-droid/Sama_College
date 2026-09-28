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

// 1. معالجة حذف درجة
// -------------------------------------------------------------
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $query = "DELETE FROM grades WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_grades.php?msg=deleted");
        exit();
    } else {
        $error = "❌ خطأ أثناء حذف الدرجة: " . mysqli_error($conn);
    }
}

// 2. معالجة إضافة درجة جديدة
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_grade'])) {
    $student_id = intval($_POST['student_id']);
    $subject_id = intval($_POST['subject_id']);
    $final_grade = floatval($_POST['final_grade']);
    $year_work = floatval($_POST['year_work']);
    $attendance = floatval($_POST['attendance']);
    $participation = floatval($_POST['participation']);
    
    // التحقق مما إذا كانت الدرجة لنفس الطالب والمادة مسجلة مسبقاً
    $check = mysqli_query($conn, "SELECT id FROM grades WHERE student_id = $student_id AND subject_id = $subject_id");
    if (mysqli_num_rows($check) > 0) {
        $error = "❌ درجة هذا الطالب للمادة المحددة مسجلة مسبقاً! يمكنك تعديلها أو حذفها أولاً.";
    } else {
        // حساب المجموع والتقدير (معدل الحسابي من 4 خانات)
        $total = ($final_grade + $year_work + $attendance + $participation) / 4;
        
        $letter = 'F';
        if ($total >= 90) $letter = 'A';
        elseif ($total >= 80) $letter = 'B';
        elseif ($total >= 70) $letter = 'C';
        elseif ($total >= 60) $letter = 'D';
        
        $query = "INSERT INTO grades (student_id, subject_id, final_grade, year_work, attendance_grade, participation_grade, total_grade, grade_letter) 
                  VALUES ($student_id, $subject_id, $final_grade, $year_work, $attendance, $participation, $total, '$letter')";
        
        if (mysqli_query($conn, $query)) {
            // إرسال إشعار للطالب
            $notif_message = "📊 تم رصد درجة جديدة لك في مادة: " . mysqli_fetch_assoc(mysqli_query($conn, "SELECT subject_name FROM subjects WHERE id=$subject_id"))['subject_name'] . " بنسبة: " . number_format($total, 1) . "% ($letter)";
            mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($student_id, '$notif_message')");
            
            $msg = "✅ تم رصد وإضافة الدرجة بنجاح!";
        } else {
            $error = "❌ خطأ أثناء الحفظ: " . mysqli_error($conn);
        }
    }
}

// 3. جلب رسائل الحالة
// -------------------------------------------------------------
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "🗑️ تم حذف الدرجة بنجاح من سجلات الطالب.";
}

// 4. جلب الطلاب النشطين والمواد وقائمة الدرجات
// -------------------------------------------------------------
$students_list = mysqli_query($conn, "SELECT id, full_name, student_id FROM users WHERE role='student' AND payment_status='paid'");
$subjects_list = mysqli_query($conn, "SELECT * FROM subjects");
$grades_list = mysqli_query($conn, "SELECT g.*, u.full_name, u.student_id as s_id, s.subject_name FROM grades g JOIN users u ON g.student_id = u.id JOIN subjects s ON g.subject_id = s.id ORDER BY g.id DESC");
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

        <!-- إضافة درجة جديدة -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-primary">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-primary"></i> رصد درجة جديدة لطالب
            </h2>
            
            <?php if (mysqli_num_rows($students_list) > 0): ?>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اختر الطالب (المدفوعين فقط)</label>
                    <select name="student_id" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر الطالب...</option>
                        <?php while($row = mysqli_fetch_assoc($students_list)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['full_name']; ?> (<?php echo $row['student_id']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اختر المادة</label>
                    <select name="subject_id" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر المادة...</option>
                        <?php mysqli_data_seek($subjects_list, 0); while($row = mysqli_fetch_assoc($subjects_list)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?> (<?php echo $row['subject_code']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">درجة الاختبار النهائي (من 100)</label>
                    <input type="number" name="final_grade" placeholder="0 - 100" min="0" max="100" step="0.01" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">أعمال السنة (من 100)</label>
                    <input type="number" name="year_work" placeholder="0 - 100" min="0" max="100" step="0.01" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">درجة الحضور (من 100)</label>
                    <input type="number" name="attendance" placeholder="0 - 100" min="0" max="100" step="0.01" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">درجة المشاركة (من 100)</label>
                    <input type="number" name="participation" placeholder="0 - 100" min="0" max="100" step="0.01" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div class="md:col-span-3 text-left mt-2">
                    <button type="submit" name="add_grade" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow-md">
                        <i class="fa-solid fa-plus ml-1"></i> رصد وحساب النتيجة تلقائياً
                    </button>
                </div>
            </form>
            <?php else: ?>
                <div class="p-4 bg-yellow-50 text-yellow-800 rounded-lg flex items-center gap-2">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                    <span>لا يوجد طلاب (مفعلين ومدفوعين) في قاعدة البيانات حالياً لرصد درجاتهم.</span>
                </div>
            <?php endif; ?>
        </div>

        <!-- جدول قائمة الدرجات المرصودة -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-chart-bar text-primary"></i> سجل الدرجات المرصودة بالكامل
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-sm font-bold border-b">اسم الطالب</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الرقم الجامعي</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">المادة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">النهائي</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">أعمال السنة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الحضور</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">المشاركة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b text-primary">المعدل</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">التقدير</th>
                        <th class="px-4 py-3 text-sm font-bold border-b text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (mysqli_num_rows($grades_list) > 0): ?>
                        <?php while($row = mysqli_fetch_assoc($grades_list)): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo $row['full_name']; ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-500"><?php echo $row['s_id']; ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo $row['subject_name']; ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo number_format($row['final_grade'], 1); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo number_format($row['year_work'], 1); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo number_format($row['attendance_grade'], 1); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo number_format($row['participation_grade'], 1); ?></td>
                            <td class="px-4 py-3 text-sm font-bold text-primary"><?php echo number_format($row['total_grade'], 1); ?>%</td>
                            <td class="px-4 py-3 text-sm">
                                <span class="px-2.5 py-1 rounded text-white text-xs font-bold
                                    <?php 
                                        $letter = $row['grade_letter'];
                                        if ($letter == 'A') echo 'bg-green-500';
                                        elseif ($letter == 'B') echo 'bg-blue-500';
                                        elseif ($letter == 'C') echo 'bg-yellow-500';
                                        elseif ($letter == 'D') echo 'bg-orange-500';
                                        else echo 'bg-red-500';
                                    ?>
                                ">
                                    <?php echo $letter; ?>
                                </span>
                            </td>
                            <td class="px-4 py-3 text-sm text-center">
                                <a href="manage_grades.php?delete=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('هل تريد حذف هذه الدرجة نهائياً؟')">
                                    <i class="fa-solid fa-trash-can"></i> حذف
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="10" class="text-center text-gray-500 py-8">لا توجد درجات مرصودة حالياً.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
