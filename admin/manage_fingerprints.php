<?php
// admin/manage_fingerprints.php - إدارة البصمات الحيوية للطلاب والموظفين
require_once '../db_connect.php';

// التحقق من تسجيل الدخول وصلاحيات المدير
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة الإجراءات عبر POST
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // تسجيل بصمة لمستخدم محدد
    if (isset($_POST['action']) && $_POST['action'] == 'save_fingerprint') {
        $target_user_id = intval($_POST['target_user_id']);
        $new_uid = mysqli_real_escape_string($conn, $_POST['uid']);
        
        // التحقق من أن رقم UID غير مكرر لمستخدم آخر
        $check_uid = mysqli_query($conn, "SELECT id, full_name FROM users WHERE uid = '$new_uid' AND id != $target_user_id");
        if ($check_uid && mysqli_num_rows($check_uid) > 0) {
            $existing_user = mysqli_fetch_assoc($check_uid);
            $error = "❌ خطأ: رقم البصمة ($new_uid) مسجل مسبقاً باسم: " . $existing_user['full_name'];
        } else {
            $update = mysqli_query($conn, "UPDATE users SET uid = '$new_uid' WHERE id = $target_user_id");
            if ($update) {
                $msg = "✅ تم تسجيل وتفعيل بصمة الإصبع بنجاح في قاعدة البيانات!";
            } else {
                $error = "❌ فشل تحديث بيانات البصمة في قاعدة البيانات.";
            }
        }
    }
    
    // إزالة البصمة لمستخدم محدد
    if (isset($_POST['action']) && $_POST['action'] == 'delete_fingerprint') {
        $target_user_id = intval($_POST['target_user_id']);
        $update = mysqli_query($conn, "UPDATE users SET uid = NULL WHERE id = $target_user_id");
        if ($update) {
            $msg = "🗑️ تم إزالة البصمة بنجاح.";
        } else {
            $error = "❌ فشل إزالة البصمة.";
        }
    }
}

// 2. فئة البحث وعرض البيانات (طلاب أو موظفين)
$type = isset($_GET['type']) ? $_GET['type'] : 'student';

// الفلاتر
$search_name = isset($_GET['search_name']) ? mysqli_real_escape_string($conn, $_GET['search_name']) : '';
$search_id = isset($_GET['search_id']) ? mysqli_real_escape_string($conn, $_GET['search_id']) : '';
$search_dept = isset($_GET['search_dept']) ? mysqli_real_escape_string($conn, $_GET['search_dept']) : '';

$where_clauses = ["role = '$type'"];
if (!empty($search_name)) {
    $where_clauses[] = "full_name LIKE '%$search_name%'";
}
if (!empty($search_id)) {
    if ($type == 'student') {
        $where_clauses[] = "student_id LIKE '%$search_id%'";
    } else {
        $where_clauses[] = "uid LIKE '%$search_id%'";
    }
}
if (!empty($search_dept) && $type == 'student') {
    $where_clauses[] = "department = '$search_dept'";
}

$where_sql = implode(" AND ", $where_clauses);

// جلب المستخدمين بناء على الفلاتر
if ($type == 'student') {
    $users_list = mysqli_query($conn, "SELECT * FROM users WHERE $where_sql ORDER BY full_name ASC");
} else {
    $users_list = mysqli_query($conn, "SELECT * FROM users WHERE $where_sql ORDER BY full_name ASC");
}

$total_count = mysqli_num_rows($users_list);
?>

<?php include_once 'header.php'; ?>
        
        <!-- التبديل بين الطلاب والموظفين -->
        <div class="flex justify-center gap-4 mb-6">
            <a href="?type=student" class="px-6 py-2.5 rounded-lg font-bold transition <?php echo $type == 'student' ? 'bg-primary text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-50 border'; ?>">
                🎓 إدارة بصمات الطلاب
            </a>
            <a href="?type=staff" class="px-6 py-2.5 rounded-lg font-bold transition <?php echo $type == 'staff' ? 'bg-primary text-white shadow' : 'bg-white text-gray-700 hover:bg-gray-50 border'; ?>">
                💼 إدارة بصمات الكادر والموظفين
            </a>
        </div>

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

        <!-- صندوق العناوين العلوي المظلم للقسم -->
        <div class="bg-[#072928] text-white py-3.5 px-6 rounded-t-xl flex justify-between items-center shadow-md">
            <h2 class="text-xl font-bold flex items-center gap-2">
                <i class="fa-solid fa-users text-gold"></i> إدارة الطلاب وبصماتهم الحيوية
            </h2>
            <a href="dashboard.php" class="bg-white/10 hover:bg-white/20 text-white px-4 py-1.5 rounded-lg text-sm font-semibold transition flex items-center gap-1.5">
                <i class="fa-solid fa-arrow-left"></i> رجوع
            </a>
        </div>

        <!-- 1. شريط البحث والفلترة (مطابق للشريط العلوي بالصورة) -->
        <div class="bg-gray-200 p-4 border-x border-b border-gray-300 flex flex-wrap items-center justify-between gap-4">
            <form method="GET" class="flex flex-wrap items-center gap-4 w-full md:w-auto">
                <input type="hidden" name="type" value="<?php echo $type; ?>">
                
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-800">اسم الطالب:</span>
                    <input type="text" name="search_name" value="<?php echo htmlspecialchars($search_name); ?>" class="border border-gray-400 px-3 py-1.5 text-sm rounded bg-white w-48 focus:outline-none">
                </div>

                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-800">رقم الطالب:</span>
                    <input type="text" name="search_id" value="<?php echo htmlspecialchars($search_id); ?>" class="border border-gray-400 px-3 py-1.5 text-sm rounded bg-white w-32 focus:outline-none">
                </div>

                <?php if ($type == 'student'): ?>
                <div class="flex items-center gap-2">
                    <span class="text-sm font-bold text-gray-800">التخصص:</span>
                    <select name="search_dept" class="border border-gray-400 px-3 py-1.5 text-sm rounded bg-white focus:outline-none">
                        <option value="">-- الكل --</option>
                        <option value="تقنية معلومات" <?php echo $search_dept == 'تقنية معلومات' ? 'selected' : ''; ?>>تقنية معلومات</option>
                        <option value="جرافيكس" <?php echo $search_dept == 'جرافيكس' ? 'selected' : ''; ?>>جرافيكس</option>
                        <option value="صيدلة" <?php echo $search_dept == 'صيدلة' ? 'selected' : ''; ?>>صيدلة</option>
                        <option value="مساعد طبيب" <?php echo $search_dept == 'مساعد طبيب' ? 'selected' : ''; ?>>مساعد طبيب</option>
                    </select>
                </div>
                <?php endif; ?>

                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-primary hover:bg-primaryDark text-white px-5 py-1.5 rounded text-sm font-bold shadow-sm transition flex items-center gap-1.5">
                        <i class="fa-solid fa-magnifying-glass"></i> بحث
                    </button>
                    <a href="?type=<?php echo $type; ?>" class="bg-teal-600 hover:bg-teal-700 text-white px-5 py-1.5 rounded text-sm font-bold shadow-sm transition flex items-center gap-1.5">
                        <i class="fa-solid fa-rotate-left"></i> مسح البحث
                    </a>
                </div>
            </form>
            <div class="text-sm font-bold text-gray-700">إجمالي الطلاب: <?php echo $total_count; ?></div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6 mt-6">
            
            <!-- 2. قسم نموذج البيانات (يسار / وسط) -->
            <div class="lg:col-span-4 flex flex-col gap-6">
                
                <!-- شاشة بيانات الطالب (مطابقة للتصميم والتقسيم في الصورة) -->
                <div class="bg-white rounded-xl shadow-md p-6 border border-gray-200">
                    <h3 class="text-md font-bold text-center text-gray-800 border-b pb-3 mb-6">بيانات الطالب</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-y-4 gap-x-8 text-sm">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">رقم الطالب:</span>
                            <input type="text" id="form_student_id" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">المجموعة:</span>
                            <input type="text" id="form_group" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">الاسم:</span>
                            <input type="text" id="form_name" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">الجنس:</span>
                            <input type="text" id="form_gender" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">التخصص:</span>
                            <input type="text" id="form_dept" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">المستوى:</span>
                            <input type="text" id="form_level" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>

                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">السنة الأكاديمية:</span>
                            <input type="text" id="form_year" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed">
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-gray-700">الحالة:</span>
                            <input type="text" id="form_status" value="نشط" readonly class="w-2/3 bg-gray-50 border border-gray-300 rounded px-3 py-1.5 outline-none cursor-not-allowed text-green-700 font-bold">
                        </div>
                    </div>

                    <!-- صندوق تفاعلي لتسجيل البصمة (مطابق تماماً للمستطيل في الصورة) -->
                    <div class="border border-gray-300 rounded-xl p-5 mt-6 text-center bg-gray-50 flex flex-col items-center justify-center min-h-[120px]">
                        <p id="fingerprint_info_text" class="text-gray-600 font-bold mb-4">اختر طالباً لعرض معلومات البصمة</p>
                        
                        <!-- زر تسجيل بصمة تفاعلي -->
                        <button type="button" id="btnRegisterFingerprint" disabled onclick="startFingerprintRegistration()" class="bg-teal-500 hover:bg-teal-600 disabled:bg-gray-300 text-white font-bold px-8 py-3 rounded-lg transition shadow-md flex items-center gap-2 cursor-pointer disabled:cursor-not-allowed">
                            <i class="fa-solid fa-fingerprint text-xl"></i> تسجيل بصمة
                        </button>
                    </div>

                </div>

            </div>

            <!-- 3. قسم أزرار التحكم الجانبية (يمين في لقطة الشاشة) -->
            <div class="lg:col-span-1 flex flex-col gap-4">
                <button type="button" onclick="alert('يرجى تحديد الطالب من الجدول في الأسفل أولاً')" class="w-full bg-[#1c7f7c] hover:bg-[#085859] text-white py-3.5 px-4 rounded-lg font-bold shadow transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-plus"></i> إضافة
                </button>
                <button type="button" onclick="alert('تعديل البيانات الأساسية متاح عبر شاشات إدارة الطلاب والموظفين')" class="w-full bg-[#1c7f7c] hover:bg-[#085859] text-white py-3.5 px-4 rounded-lg font-bold shadow transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-pen-to-square"></i> تعديل
                </button>
                <button type="button" onclick="clearSelectedForm()" class="w-full bg-[#1c7f7c] hover:bg-[#085859] text-white py-3.5 px-4 rounded-lg font-bold shadow transition flex items-center justify-center gap-2">
                    <i class="fa-solid fa-eraser"></i> مسح الحقل
                </button>
                <button type="button" id="btnDeleteFingerprint" disabled onclick="deleteFingerprint()" class="w-full bg-rose-600 hover:bg-rose-700 text-white py-3.5 px-4 rounded-lg font-bold shadow transition flex items-center justify-center gap-2 disabled:bg-gray-300 disabled:cursor-not-allowed">
                    <i class="fa-solid fa-trash-can"></i> حذف البصمة
                </button>
            </div>

        </div>

        <!-- 4. جدول الطلاب (مطابق للجدول ذو الحدود السوداء والصفوف الخضراء بالصورة) -->
        <div class="bg-white rounded-xl shadow-md p-6 mt-8 overflow-x-auto">
            <table class="w-full text-right border-collapse table-custom">
                <thead>
                    <tr class="bg-gray-100 text-gray-800">
                        <th class="px-4 py-2.5 text-sm font-bold">رقم الطالب</th>
                        <th class="px-4 py-2.5 text-sm font-bold">اسم الطالب</th>
                        <th class="px-4 py-2.5 text-sm font-bold">الجنس</th>
                        <th class="px-4 py-2.5 text-sm font-bold">التخصص</th>
                        <th class="px-4 py-2.5 text-sm font-bold">المستوى</th>
                        <th class="px-4 py-2.5 text-sm font-bold">السنة الأكاديمية</th>
                        <th class="px-4 py-2.5 text-sm font-bold">الحالة</th>
                        <th class="px-4 py-2.5 text-sm font-bold">تاريخ التسجيل</th>
                        <th class="px-4 py-2.5 text-sm font-bold">المجموعة</th>
                        <th class="px-4 py-2.5 text-sm font-bold text-center">البصمة</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-300">
                    <?php 
                    while ($row = mysqli_fetch_assoc($users_list)): 
                        $has_finger = !empty($row['uid']);
                    ?>
                    <tr id="row_<?php echo $row['id']; ?>" onclick='selectStudent(<?php echo json_encode($row); ?>, <?php echo $has_finger ? 'true' : 'false'; ?>)' class="hover:bg-blue-50 cursor-pointer transition <?php echo $has_finger ? 'bg-green-50' : ''; ?>">
                        <td class="px-4 py-2 text-sm font-mono"><?php echo $type == 'student' ? htmlspecialchars($row['student_id']) : 'EMP-' . $row['id']; ?></td>
                        <td class="px-4 py-2 text-sm font-bold text-gray-800"><?php echo htmlspecialchars($row['full_name']); ?></td>
                        <td class="px-4 py-2 text-sm"><?php echo $row['gender'] == 'female' || $row['gender'] == 'أنثى' ? 'أنثى' : 'ذكر'; ?></td>
                        <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($row['department'] ?? 'إداري'); ?></td>
                        <td class="px-4 py-2 text-sm"><?php echo htmlspecialchars($row['level'] ?? 'كادر'); ?></td>
                        <td class="px-4 py-2 text-sm">2026-2027</td>
                        <td class="px-4 py-2 text-sm text-green-700 font-bold">نشط</td>
                        <td class="px-4 py-2 text-sm"><?php echo date('Y-m-d', strtotime($row['created_at'])); ?></td>
                        <td class="px-4 py-2 text-sm">المجموعة الأولى</td>
                        <td class="px-4 py-2 text-sm text-center">
                            <span class="text-xs font-bold px-2.5 py-1 rounded-full <?php echo $has_finger ? 'bg-green-100 text-green-800' : 'bg-amber-100 text-amber-800'; ?>">
                                <?php echo $has_finger ? '✓ مسجلة' : 'غير مسجلة'; ?>
                            </span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

    </div>

    <!-- نافذة منبثقة تفاعلية لمحاكاة الاتصال الفعلي بجهاز البصمة (Modal) -->
    <div id="fingerprintSyncModal" class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md p-8 mx-4 border-t-6 border-teal-500 text-center">
            
            <div id="modal_scanning_graphics" class="relative w-28 h-28 bg-teal-50 rounded-full flex items-center justify-center mx-auto mb-6 border-2 border-teal-100">
                <i class="fa-solid fa-fingerprint text-5xl text-teal-600 animate-pulse"></i>
                <div class="absolute inset-x-4 top-1/2 h-0.5 bg-teal-500 animate-bounce"></div>
            </div>

            <h3 class="text-xl font-bold text-gray-800 mb-3" id="modal_title">جاري الاتصال بجهاز البصمة...</h3>
            <p class="text-gray-500 text-sm mb-6" id="modal_body">يرجى وضع إصبع الموظف/الطالب على قارئ البصمة المتصل باللابتوب.</p>
            
            <div class="flex flex-col gap-3">
                <div id="modal_loader" class="h-1 w-full bg-gray-200 rounded-full overflow-hidden">
                    <div class="h-full bg-teal-500 animate-infinite animate-duration-1000" style="width: 50%;"></div>
                </div>
                
                <!-- محاكاة استقبال القراءة (لأغراض العرض والتجربة) -->
                <div class="bg-amber-50 border border-amber-200 p-3 rounded-lg text-amber-800 text-xs font-semibold mt-2">
                    💡 محاكاة قراءة البصمة: سيقوم الجهاز بتوليد معرّف عشوائي وتوثيقه تلقائياً بعد 3 ثوانٍ.
                </div>

                <button type="button" onclick="closeFingerprintModal()" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-700 py-2.5 rounded-lg font-bold transition text-sm">
                    إلغاء العملية
                </button>
            </div>
        </div>
    </div>

    <!-- فورم مخفي للإرسال المحاسبي وقاعدة البيانات -->
    <form id="fingerprintSubmitForm" method="POST" class="hidden">
        <input type="hidden" name="action" value="save_fingerprint">
        <input type="hidden" name="target_user_id" id="post_user_id">
        <input type="hidden" name="uid" id="post_uid">
    </form>
    
    <form id="fingerprintDeleteForm" method="POST" class="hidden">
        <input type="hidden" name="action" value="delete_fingerprint">
        <input type="hidden" name="target_user_id" id="delete_post_user_id">
    </form>



    <script>
        let selectedUser = null;

        function selectStudent(userData, hasFinger) {
            selectedUser = userData;
            
            // إزالة التحديد النشط من كافة الصفوف
            document.querySelectorAll('.table-custom tbody tr').forEach(row => {
                row.classList.remove('active-row');
            });
            
            // تفعيل الصف المحدد
            document.getElementById('row_' + userData.id).classList.add('active-row');

            // ملء حقول فورم البيانات
            document.getElementById('form_student_id').value = userData.student_id ? userData.student_id : 'EMP-' + userData.id;
            document.getElementById('form_name').value = userData.full_name;
            document.getElementById('form_dept').value = userData.department ? userData.department : 'كادر إداري/تدريسي';
            document.getElementById('form_gender').value = userData.gender === 'female' || userData.gender === 'أنثى' ? 'أنثى' : 'ذكر';
            document.getElementById('form_level').value = userData.level ? userData.level : 'كادر الكلية';
            document.getElementById('form_year').value = '2026-2027';
            document.getElementById('form_group').value = 'المجموعة الأولى';

            // تفعيل أزرار التحكم والبصمة
            document.getElementById('btnRegisterFingerprint').disabled = false;
            document.getElementById('fingerprint_info_text').innerHTML = hasFinger 
                ? `🟢 البصمة مسجلة لهذا الشخص برقم البصمة الحيوية: <strong class="text-teal-700 font-bold">${userData.uid}</strong>`
                : `⚠️ لا توجد بصمة مسجلة لهذا الشخص بعد.`;
            
            // تفعيل زر حذف البصمة إن كانت مسجلة
            document.getElementById('btnDeleteFingerprint').disabled = !hasFinger;
        }

        function clearSelectedForm() {
            selectedUser = null;
            document.querySelectorAll('.table-custom tbody tr').forEach(row => {
                row.classList.remove('active-row');
            });

            document.getElementById('form_student_id').value = '';
            document.getElementById('form_name').value = '';
            document.getElementById('form_dept').value = '';
            document.getElementById('form_gender').value = '';
            document.getElementById('form_level').value = '';
            document.getElementById('form_year').value = '';
            document.getElementById('form_group').value = '';

            document.getElementById('btnRegisterFingerprint').disabled = true;
            document.getElementById('btnDeleteFingerprint').disabled = true;
            document.getElementById('fingerprint_info_text').innerText = 'اختر طالباً لعرض معلومات البصمة';
        }

        function startFingerprintRegistration() {
            if (!selectedUser) return;
            
            // إظهار نافذة تسجيل البصمة
            document.getElementById('fingerprintSyncModal').classList.remove('hidden');
            
            // محاكاة سحب البصمة وتوليد رقم البصمة الحيوي (UID) خلال 3 ثوانٍ
            setTimeout(() => {
                const generatedUid = Math.floor(Math.random() * 900) + 100; // توليد رقم عشوائي
                
                document.getElementById('modal_title').innerText = "🟢 تم قراءة البصمة بنجاح!";
                document.getElementById('modal_body').innerText = "تم التقاط البصمة الحيوية وتوليد رقم UID: " + generatedUid;
                
                setTimeout(() => {
                    // ملء وإرسال الفورم لحفظ البيانات في قاعدة البيانات
                    document.getElementById('post_user_id').value = selectedUser.id;
                    document.getElementById('post_uid').value = generatedUid;
                    
                    document.getElementById('fingerprintSubmitForm').submit();
                }, 1000);
            }, 2500);
        }

        function deleteFingerprint() {
            if (!selectedUser || !confirm('هل أنت متأكد من رغبتك في إزالة بصمة الإصبع المسجلة لهذا الشخص؟')) return;
            
            document.getElementById('delete_post_user_id').value = selectedUser.id;
            document.getElementById('fingerprintDeleteForm').submit();
        }

        function closeFingerprintModal() {
            document.getElementById('fingerprintSyncModal').classList.add('hidden');
        }
    </script>

<?php include_once 'footer.php'; ?>
