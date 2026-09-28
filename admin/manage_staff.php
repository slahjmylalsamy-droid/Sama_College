<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة الحذف
// -------------------------------------------------------------
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    if ($delete_id == $_SESSION['user_id']) {
        $error = "❌ لا يمكنك حذف حسابك الشخصي الذي تستخدمه حالياً لتسجيل الدخول!";
    } else {
        $query = "DELETE FROM users WHERE id = $delete_id AND role = 'staff'";
        if (mysqli_query($conn, $query)) {
            header("Location: manage_staff.php?msg=deleted");
            exit();
        } else {
            $error = "❌ حدث خطأ أثناء محاولة الحذف: " . mysqli_error($conn);
        }
    }
}

// 2. معالجة إضافة موظف جديد
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_staff'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $permission = intval($_POST['permission']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $base_salary = floatval($_POST['base_salary']);
    $work_start = mysqli_real_escape_string($conn, $_POST['work_start_time']);
    $work_end = mysqli_real_escape_string($conn, $_POST['work_end_time']);
    
    // التحقق من عدم تكرار البريد
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "❌ البريد الإلكتروني مسجل مسبقاً لمستخدم آخر!";
    } else {
        $query = "INSERT INTO users (full_name, email, password, role, permission_level, payment_status, uid, base_salary, work_start_time, work_end_time, staff_type) 
                  VALUES ('$full_name', '$email', '$password', 'staff', $permission, 'paid', '$uid', $base_salary, '$work_start', '$work_end', 'administrative')";
        if (mysqli_query($conn, $query)) {
            $msg = "✅ تم إضافة الموظف وتحديد راتبه وساعات دوامه بنجاح!";
        } else {
            $error = "❌ خطأ أثناء الإضافة: " . mysqli_error($conn);
        }
    }
}

// 3. معالجة تحديث بيانات الموظف (تعديل الراتب والدوام ورقم البصمة)
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_staff'])) {
    $staff_id = intval($_POST['staff_id']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $base_salary = floatval($_POST['base_salary']);
    $work_start = mysqli_real_escape_string($conn, $_POST['work_start_time']);
    $work_end = mysqli_real_escape_string($conn, $_POST['work_end_time']);
    $permission = intval($_POST['permission']);
    
    $query = "UPDATE users SET uid = '$uid', base_salary = $base_salary, work_start_time = '$work_start', work_end_time = '$work_end', permission_level = $permission WHERE id = $staff_id AND role = 'staff'";
    if (mysqli_query($conn, $query)) {
        $msg = "✅ تم تحديث بيانات الموظف بنجاح!";
    } else {
        $error = "❌ خطأ أثناء التحديث: " . mysqli_error($conn);
    }
}

// 3. جلب رسائل الحالة
// -------------------------------------------------------------
if (isset($_GET['msg']) && $_GET['msg'] == 'deleted') {
    $msg = "🗑️ تم حذف الموظف بنجاح من النظام.";
}

$staff = mysqli_query($conn, "SELECT * FROM users WHERE role='staff' AND (staff_type='administrative' OR staff_type IS NULL OR staff_type='') ORDER BY id DESC");
$attendance_logs = mysqli_query($conn, "SELECT ea.*, u.full_name FROM employee_attendance ea JOIN users u ON ea.user_id = u.id WHERE u.role='staff' AND (u.staff_type='administrative' OR u.staff_type IS NULL OR u.staff_type='') ORDER BY ea.date DESC, ea.check_in DESC LIMIT 50");
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

        <!-- إضافة موظف جديد -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-gold">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-shield text-gold"></i> إضافة موظف جديد وتحديد نظام دوامه وراتبه
            </h2>
            <form method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">الاسم الكامل للموظف</label>
                    <input type="text" name="full_name" placeholder="مثال: د. محمد علي" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" placeholder="staff@college.com" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">كلمة المرور الافتراضية</label>
                    <input type="text" name="password" value="123456" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">مستوى الصلاحية</label>
                    <select name="permission" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="2">موظف عادي (رفع محاضرات ودرجات وإعلانات)</option>
                        <option value="3">مدير نظام (صلاحيات كاملة + الطلاب والموظفين والجدول)</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">معرّف بصمة الإصبع (UID)</label>
                    <input type="text" name="uid" placeholder="مثال: 5" class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">الراتب الشهري الأساسي (ريال)</label>
                    <input type="number" step="0.01" name="base_salary" value="150000.00" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">بداية الدوام الرسمي</label>
                    <input type="time" name="work_start_time" value="08:00" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">نهاية الدوام الرسمي</label>
                    <input type="time" name="work_end_time" value="14:00" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div class="md:col-span-4 text-left">
                    <button type="submit" name="add_staff" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow">
                        <i class="fa-solid fa-check ml-1"></i> إضافة الموظف وتفعيل حسابه
                    </button>
                </div>
            </form>
        </div>

        <!-- جدول قائمة الموظفين -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto mb-8">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-users-gear text-primary"></i> قائمة الكادر الإداري والوظيفي (<?php echo mysqli_num_rows($staff); ?> موظف)
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-sm font-bold border-b">#</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">اسم الموظف</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">البريد الإلكتروني</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">رقم البصمة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الراتب الأساسي</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">ساعات العمل</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">رتبة الصلاحية</th>
                        <th class="px-4 py-3 text-sm font-bold border-b text-center">الإجراءات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    $i = 1; 
                    while($row = mysqli_fetch_assoc($staff)): 
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm"><?php echo $i++; ?></td>
                        <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td class="px-4 py-3 text-sm text-gray-500"><?php echo htmlspecialchars($row['email']); ?></td>
                        <td class="px-4 py-3 text-sm font-semibold text-teal-700"><?php echo htmlspecialchars($row['uid'] ?? 'لم يربط'); ?></td>
                        <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo number_format($row['base_salary'], 2); ?> ر.ي</td>
                        <td class="px-4 py-3 text-sm text-gray-600"><?php echo $row['work_start_time'] . ' - ' . $row['work_end_time']; ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php if ($row['permission_level'] >= 3): ?>
                                <span class="bg-red-100 text-red-800 border border-red-200 px-3 py-1 rounded-full text-xs font-bold">
                                    مدير النظام
                                </span>
                            <?php else: ?>
                                <span class="bg-blue-100 text-blue-800 border border-blue-200 px-3 py-1 rounded-full text-xs font-bold">
                                    موظف عادي
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-sm text-center flex items-center justify-center gap-2">
                            <button type="button" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" class="bg-amber-500 hover:bg-amber-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition">
                                <i class="fa-solid fa-edit"></i> تعديل
                            </button>
                            <?php if ($row['id'] != $_SESSION['user_id']): ?>
                                <a href="manage_staff.php?delete=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('هل أنت متأكد من حذف هذا الحساب الإداري نهائياً؟')">
                                    <i class="fa-solid fa-trash-can"></i> حذف
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-gray-400 font-semibold italic">حسابك الحالي</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- جدول سجلات الحضور والانصراف بالبصمة -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-fingerprint text-teal-600"></i> سجل حضور الموظفين بالبصمة الحيوية
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-sm font-bold border-b">الموظف</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">التاريخ</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">وقت البصمة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الحالة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">دقائق التأخير</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الخصم المحتسب</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php if (mysqli_num_rows($attendance_logs) == 0): ?>
                        <tr>
                            <td colspan="6" class="px-4 py-6 text-center text-gray-400 italic">لا توجد سجلات حضور بالبصمة مسجلة بعد.</td>
                        </tr>
                    <?php else: ?>
                        <?php while ($log = mysqli_fetch_assoc($attendance_logs)): ?>
                        <tr class="hover:bg-gray-50 transition">
                            <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo htmlspecialchars($log['full_name']); ?></td>
                            <td class="px-4 py-3 text-sm text-gray-600"><?php echo htmlspecialchars($log['date']); ?></td>
                            <td class="px-4 py-3 text-sm font-semibold text-gray-700"><?php echo htmlspecialchars($log['check_in']); ?></td>
                            <td class="px-4 py-3 text-sm">
                                <?php if ($log['status'] == 'present'): ?>
                                    <span class="bg-green-100 text-green-800 border border-green-200 px-2.5 py-0.5 rounded text-xs font-bold">حاضر</span>
                                <?php else: ?>
                                    <span class="bg-rose-100 text-rose-800 border border-rose-200 px-2.5 py-0.5 rounded text-xs font-bold">متأخر</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-4 py-3 text-sm font-semibold <?php echo $log['delay_minutes'] > 0 ? 'text-rose-600' : 'text-gray-500'; ?>">
                                <?php echo $log['delay_minutes']; ?> دقيقة
                            </td>
                            <td class="px-4 py-3 text-sm font-bold <?php echo $log['deduction_amount'] > 0 ? 'text-rose-600' : 'text-gray-500'; ?>">
                                <?php echo number_format($log['deduction_amount'], 2); ?> ر.ي
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- مودال تعديل بيانات الموظف (Modal) -->
    <div id="editStaffModal" class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-xl shadow-xl w-full max-w-lg p-6 mx-4 border-t-4 border-primary">
            <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-edit text-primary"></i> تعديل بيانات الموظف والراتب والدوام
            </h3>
            <form method="POST">
                <input type="hidden" name="staff_id" id="edit_staff_id">
                <div class="grid grid-cols-1 gap-4 mb-5">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">اسم الموظف (للقراءة فقط)</label>
                        <input type="text" id="edit_full_name" readonly class="w-full bg-gray-100 border rounded-lg px-4 py-2 text-sm focus:outline-none cursor-not-allowed">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">مستوى الصلاحية</label>
                        <select name="permission" id="edit_permission" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                            <option value="2">موظف عادي</option>
                            <option value="3">مدير نظام</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">معرف بصمة الإصبع (UID)</label>
                        <input type="text" name="uid" id="edit_uid" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    </div>
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">الراتب الأساسي (ريال)</label>
                        <input type="number" step="0.01" name="base_salary" id="edit_base_salary" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                    </div>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">بداية الدوام</label>
                            <input type="time" name="work_start_time" id="edit_work_start" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1">نهاية الدوام</label>
                            <input type="time" name="work_end_time" id="edit_work_end" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        </div>
                    </div>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeEditModal()" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-4 py-2 rounded-lg text-sm font-bold transition">إلغاء</button>
                    <button type="submit" name="update_staff" class="bg-primary hover:bg-primaryDark text-white px-5 py-2 rounded-lg text-sm font-bold transition">حفظ التغييرات</button>
                </div>
            </form>
        </div>
    </div>



    <script>
        function openEditModal(staffData) {
            document.getElementById('edit_staff_id').value = staffData.id;
            document.getElementById('edit_full_name').value = staffData.full_name;
            document.getElementById('edit_permission').value = staffData.permission_level;
            document.getElementById('edit_uid').value = staffData.uid || '';
            document.getElementById('edit_base_salary').value = staffData.base_salary;
            document.getElementById('edit_work_start').value = staffData.work_start_time;
            document.getElementById('edit_work_end').value = staffData.work_end_time;
            
            document.getElementById('editStaffModal').classList.remove('hidden');
        }

        function closeEditModal() {
            document.getElementById('editStaffModal').classList.add('hidden');
        }
    </script>
<?php include_once 'footer.php'; ?>
