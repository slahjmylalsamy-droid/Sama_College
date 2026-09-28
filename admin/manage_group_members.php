<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة إضافة عضو يدوي لمجموعة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_member'])) {
    $user_id = intval($_POST['user_id']);
    
    // اسم المجموعة: إما المختار من القائمة أو المكتوب يدوياً
    $group_name = "";
    if (!empty($_POST['custom_group_name'])) {
        $group_name = trim($_POST['custom_group_name']);
    } else {
        $group_name = trim($_POST['group_name']);
    }
    
    $group_name = mysqli_real_escape_string($conn, $group_name);
    
    if ($user_id > 0 && !empty($group_name)) {
        // التحقق من عدم التكرار
        $check = mysqli_query($conn, "SELECT id FROM group_manual_members WHERE group_name = '$group_name' AND user_id = $user_id");
        if (mysqli_num_rows($check) > 0) {
            $error = "⚠️ هذا المستخدم مضاف بالفعل لهذه المجموعة!";
        } else {
            $sql = "INSERT INTO group_manual_members (group_name, user_id) VALUES ('$group_name', $user_id)";
            if (mysqli_query($conn, $sql)) {
                $msg = "✅ تم إضافة العضو للمجموعة بنجاح!";
            } else {
                $error = "❌ خطأ أثناء الإضافة: " . mysqli_error($conn);
            }
        }
    } else {
        $error = "⚠️ يرجى اختيار مستخدم وتحديد اسم مجموعة صحيح.";
    }
}

// 2. معالجة إزالة عضو من مجموعة
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    $sql = "DELETE FROM group_manual_members WHERE id = $delete_id";
    if (mysqli_query($conn, $sql)) {
        $msg = "🗑️ تم إزالة العضو من المجموعة بنجاح.";
    } else {
        $error = "❌ خطأ أثناء الإزالة: " . mysqli_error($conn);
    }
}

// 3. جلب البيانات المطلوبة للعرض
// جلب قائمة المجموعات الافتراضية
$groups_query = mysqli_query($conn, "
    SELECT DISTINCT department, level 
    FROM subjects 
    WHERE department IS NOT NULL AND department != '' 
    AND level IS NOT NULL AND level != ''
    ORDER BY department ASC, level ASC
");
$default_groups = [];
while ($row = mysqli_fetch_assoc($groups_query)) {
    $default_groups[] = $row['department'] . ' - ' . $row['level'];
}

// جلب قائمة المستخدمين للاختيار (طلاب وموظفين)
$users_query = mysqli_query($conn, "SELECT id, full_name, role, email, student_id, staff_type FROM users ORDER BY role DESC, full_name ASC");

// جلب قائمة الأعضاء المضافين يدوياً حالياً مع بياناتهم للجدول
$assignments_query = mysqli_query($conn, "
    SELECT gmm.*, u.full_name, u.role, u.email, u.student_id, u.staff_type
    FROM group_manual_members gmm
    JOIN users u ON gmm.user_id = u.id
    ORDER BY gmm.group_name ASC, u.full_name ASC
");
?>

<?php include_once 'header.php'; ?>

<!-- حاوية إدارة المجموعات وأعضائها -->
<div class="p-6">
    <div class="mb-6 flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-800 flex items-center gap-2">
                <i class="fa-solid fa-users-gear text-primary"></i> إدارة وتخصيص أعضاء المجموعات
            </h1>
            <p class="text-gray-500 text-sm mt-1">تتيح لك هذه الصفحة إدخال أو إزالة دكتور أو طالب يدوياً من أي مجموعة تفاعلية بالكلية بشكل مستقل.</p>
        </div>
        <a href="academic_groups.php" class="bg-primary hover:bg-primaryDark text-white px-4 py-2 rounded-lg text-sm font-bold shadow transition flex items-center gap-1">
            <i class="fa-solid fa-comments"></i> الانتقال للمحادثات
        </a>
    </div>

    <!-- رسائل التغذية الراجعة -->
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
        
        <!-- كرت إضافة عضو جديد للمجموعة -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-gold lg:col-span-1">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-plus-circle text-gold"></i> إضافة مستخدم لمجموعة
            </h2>
            
            <form method="POST" class="space-y-4">
                <!-- اختيار المستخدم -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">اختر الطالب أو الدكتور</label>
                    <select name="user_id" required class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary select2">
                        <option value="">-- اختر المستخدم --</option>
                        <?php while($row = mysqli_fetch_assoc($users_query)): ?>
                            <?php 
                            $label = $row['full_name'];
                            if ($row['role'] === 'student') {
                                $label .= " (طالب - رقم جامعي: " . ($row['student_id'] ?? '-') . ")";
                            } else {
                                $label .= " (كادر - " . ($row['staff_type'] === 'academic' ? 'أكاديمي' : 'إداري') . ")";
                            }
                            ?>
                            <option value="<?php echo $row['id']; ?>"><?php echo htmlspecialchars($label); ?></option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- اختيار المجموعة الافتراضية -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">المجموعات الافتراضية المتاحة</label>
                    <select name="group_name" id="groupSelect" class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary">
                        <option value="">-- اختر مجموعة --</option>
                        <option value="كادر الكلية">كادر الكلية (الخاصة بالدكاترة والإدارة)</option>
                        <?php foreach($default_groups as $grp): ?>
                            <option value="<?php echo htmlspecialchars($grp); ?>"><?php echo htmlspecialchars($grp); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- أو كتابة مجموعة مخصصة -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">أو اكتب اسم مجموعة مخصص</label>
                    <input type="text" name="custom_group_name" placeholder="مثال: لجان الامتحانات، كادر الصيدلة" class="w-full border rounded-lg px-4 py-2.5 text-sm focus:outline-none focus:border-primary">
                    <span class="text-[11px] text-gray-400 mt-1 block">ملاحظة: اتركه فارغاً في حال اخترت مجموعة من القائمة العلوية.</span>
                </div>

                <button type="submit" name="add_member" class="w-full bg-primary hover:bg-primaryDark text-white font-bold py-2.5 rounded-lg text-sm transition shadow mt-2">
                    <i class="fa-solid fa-user-plus ml-1"></i> حفظ وتأكيد الإضافة
                </button>
            </form>
        </div>

        <!-- جدول الأعضاء المسجلين حالياً يدوياً -->
        <div class="bg-white rounded-xl shadow-md p-6 border-t-4 border-primary lg:col-span-2">
            <h2 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-list-check text-primary"></i> قائمة الأعضاء المضافين يدوياً
            </h2>
            
            <div class="overflow-x-auto">
                <table class="w-full text-right border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b">
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700">اسم المجموعة</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700">الاسم</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700">الدور</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700">الإيميل / الرقم الجامعي</th>
                            <th class="px-4 py-3 text-sm font-semibold text-gray-700 text-center">إجراءات</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        <?php if (mysqli_num_rows($assignments_query) > 0): ?>
                            <?php while($row = mysqli_fetch_assoc($assignments_query)): ?>
                                <tr class="hover:bg-slate-50/50 transition">
                                    <td class="px-4 py-3.5 text-sm font-bold text-primary"><?php echo htmlspecialchars($row['group_name']); ?></td>
                                    <td class="px-4 py-3.5 text-sm text-gray-800 font-semibold"><?php echo htmlspecialchars($row['full_name']); ?></td>
                                    <td class="px-4 py-3.5 text-sm text-gray-600">
                                        <?php if ($row['role'] === 'student'): ?>
                                            <span class="bg-blue-50 text-blue-700 px-2 py-0.5 rounded text-xs font-semibold">طالب</span>
                                        <?php else: ?>
                                            <span class="bg-amber-50 text-amber-700 px-2 py-0.5 rounded text-xs font-semibold">
                                                كادر (<?php echo $row['staff_type'] === 'academic' ? 'أكاديمي' : 'إداري'; ?>)
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3.5 text-sm text-gray-500 font-mono">
                                        <?php echo $row['role'] === 'student' ? htmlspecialchars($row['student_id']) : htmlspecialchars($row['email']); ?>
                                    </td>
                                    <td class="px-4 py-3.5 text-sm text-center">
                                        <a href="manage_group_members.php?delete=<?php echo $row['id']; ?>" 
                                           class="bg-red-50 hover:bg-red-500 text-red-600 hover:text-white px-3 py-1 rounded text-xs font-bold transition inline-block shadow-sm"
                                           onclick="return confirm('هل أنت متأكد من إزالة هذا العضو من المجموعة؟')">
                                            <i class="fa-solid fa-trash-can"></i> إزالة
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" class="px-4 py-8 text-center text-gray-400 text-sm">
                                    <i class="fa-solid fa-user-slash text-3xl mb-2 block"></i>
                                    لا توجد تعيينات يدوية مسجلة حالياً.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<?php include_once 'footer.php'; ?>
