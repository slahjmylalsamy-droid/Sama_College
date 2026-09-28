<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة حذف موعد
// -------------------------------------------------------------
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $query = "DELETE FROM schedule WHERE id = $delete_id";
    if (mysqli_query($conn, $query)) {
        header("Location: manage_schedule.php?msg=deleted");
        exit();
    } else {
        $error = "❌ خطأ أثناء الحذف: " . mysqli_error($conn);
    }
}

// 2. معالجة إضافة موعد جديد
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_schedule'])) {
    $subject_id = intval($_POST['subject_id']);
    $day_of_week = mysqli_real_escape_string($conn, $_POST['day_of_week']);
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $room = mysqli_real_escape_string($conn, $_POST['room']);
    
    // التحقق من عدم وجود تضارب في القاعة والوقت واليوم
    $conflict = mysqli_query($conn, "
        SELECT * FROM schedule 
        WHERE day_of_week = '$day_of_week' 
        AND room = '$room' 
        AND (
            (start_time <= '$start_time' AND end_time > '$start_time') OR 
            (start_time < '$end_time' AND end_time >= '$end_time') OR
            ('$start_time' <= start_time AND '$end_time' > start_time)
        )
    ");
    
    if (mysqli_num_rows($conflict) > 0) {
        $error = "⚠️ خطأ: هناك تعارض في الجدول! القاعة ($room) محجوزة بالفعل في هذا الوقت يوم ($day_of_week).";
    } else {
        $query = "INSERT INTO schedule (subject_id, day_of_week, start_time, end_time, room) 
                  VALUES ($subject_id, '$day_of_week', '$start_time', '$end_time', '$room')";
        
        if (mysqli_query($conn, $query)) {
            $msg = "✅ تم إضافة موعد المحاضرة إلى الجدول بنجاح!";
        } else {
            $error = "❌ خطأ أثناء الحفظ: " . mysqli_error($conn);
        }
    }
}

// 3. جلب رسائل الحالة
// -------------------------------------------------------------
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "🗑️ تم حذف موعد المحاضرة بنجاح من الجدول.";
}

// 4. جلب قائمة المواد والجدول الكامل
// -------------------------------------------------------------
$subjects_list = mysqli_query($conn, "SELECT * FROM subjects");
$schedule_list = mysqli_query($conn, "
    SELECT sch.*, s.subject_name, s.subject_code 
    FROM schedule sch 
    JOIN subjects s ON sch.subject_id = s.id 
    ORDER BY FIELD(sch.day_of_week, 'السبت', 'الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس'), sch.start_time ASC
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

        <!-- إضافة موعد جديد -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-gold">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-gold"></i> إضافة موعد محاضرة جديد للجدول
            </h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-5 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اختر المادة</label>
                    <select name="subject_id" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر المادة...</option>
                        <?php while($row = mysqli_fetch_assoc($subjects_list)): ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo $row['subject_name']; ?> (<?php echo $row['subject_code']; ?>)</option>
                        <?php endwhile; ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اليوم</label>
                    <select name="day_of_week" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر اليوم...</option>
                        <option value="السبت">السبت</option>
                        <option value="الأحد">الأحد</option>
                        <option value="الاثنين">الاثنين</option>
                        <option value="الثلاثاء">الثلاثاء</option>
                        <option value="الأربعاء">الأربعاء</option>
                        <option value="الخميس">الخميس</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">من (وقت البدء)</label>
                    <input type="time" name="start_time" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">إلى (وقت النهاية)</label>
                    <input type="time" name="end_time" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">القاعة / الفصل</label>
                    <input type="text" name="room" required placeholder="مثال: قاعة 3، معمل الحاسوب" class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div class="md:col-span-5 text-left mt-2">
                    <button type="submit" name="add_schedule" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow-md">
                        <i class="fa-solid fa-plus ml-1"></i> إضافة الموعد للجدول الدراسي
                    </button>
                </div>
            </form>
        </div>

        <!-- جدول مواعيد المحاضرات -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-calendar-days text-primary"></i> الجدول الأسبوعي للمحاضرات
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-primary text-white">
                        <th class="px-4 py-3 text-sm rounded-tr-lg">اليوم الدراسي</th>
                        <th class="px-4 py-3 text-sm">رمز المادة</th>
                        <th class="px-4 py-3 text-sm">اسم المادة</th>
                        <th class="px-4 py-3 text-sm">من</th>
                        <th class="px-4 py-3 text-sm">إلى</th>
                        <th class="px-4 py-3 text-sm">القاعة الدراسيّة</th>
                        <th class="px-4 py-3 text-sm rounded-tl-lg text-center">الإجراءات</th>
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
                    if (mysqli_num_rows($schedule_list) > 0):
                        while($row = mysqli_fetch_assoc($schedule_list)): 
                            $color = $day_colors[$row['day_of_week']] ?? 'border-gray-300';
                    ?>
                        <tr class="border-b border-r-4 <?php echo $color; ?> hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-bold"><?php echo $row['day_of_week']; ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-500"><?php echo $row['subject_code']; ?></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-800"><?php echo $row['subject_name']; ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-600"><?php echo date('h:i A', strtotime($row['start_time'])); ?></td>
                            <td class="px-4 py-3 text-sm font-mono text-gray-600"><?php echo date('h:i A', strtotime($row['end_time'])); ?></td>
                            <td class="px-4 py-3 text-sm"><?php echo $row['room']; ?></td>
                            <td class="px-4 py-3 text-sm text-center">
                                <a href="manage_schedule.php?delete=<?php echo $row['id']; ?>" class="bg-red-50 hover:bg-red-100 text-red-600 px-3 py-1 rounded text-xs font-semibold shadow-sm transition border border-red-200" onclick="return confirm('هل أنت متأكد من حذف هذا الموعد من الجدول؟')">
                                    <i class="fa-solid fa-trash-can"></i> حذف
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="text-center text-gray-500 py-8">لا يوجد جدول محاضرات مسجل حالياً.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
