<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة حفظ الصلاحيات المخصصة للمستخدم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save_permissions'])) {
    $target_user_id = intval($_POST['target_user_id']);
    
    // قائمة الصفحات الممكن إعطاء صلاحيات عليها
    $available_pages = [
        'dashboard.php',
        'manage_schedule.php',
        'manage_students.php',
        'manage_teachers.php',
        'manage_staff.php',
        'upload_lecture.php',
        'manage_fingerprints.php',
        'accounting.php',
        'manage_permissions.php',
        'reports.php',
        'announcements.php',
        'manage_grades.php',
        'manage_content.php'
    ];
    
    $granted_permissions = [];
    foreach ($available_pages as $page) {
        $post_key = str_replace('.', '_', $page);
        if (isset($_POST['perm_' . $post_key]) && $_POST['perm_' . $post_key] == '1') {
            $granted_permissions[$page] = true;
        } else {
            $granted_permissions[$page] = false;
        }
    }
    
    $json_perms = mysqli_real_escape_string($conn, json_encode($granted_permissions));
    
    // حفظ الصلاحيات في عمود page_permissions للمستخدم المحدد
    $update = mysqli_query($conn, "UPDATE users SET page_permissions = '$json_perms' WHERE id = $target_user_id AND role = 'staff'");
    if ($update) {
        $msg = "✅ تم تحديث وحفظ صلاحيات المستخدم بنجاح وتفعيلها فوراً!";
    } else {
        $error = "❌ فشل تحديث الصلاحيات في قاعدة البيانات.";
    }
}

// جلب قائمة كافة موظفي ومدرسي النظام للفلترة والاختيار
$users_list = mysqli_query($conn, "SELECT id, full_name, email, permission_level, staff_type, page_permissions FROM users WHERE role = 'staff' ORDER BY staff_type DESC, full_name ASC");
?>

<?php include_once 'header.php'; ?>

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6 border-t-4 border-gold">
        <h2 class="text-2xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <i class="fa-solid fa-user-lock text-gold"></i> لوحة التحكم بالصلاحيات وإدارة وصول المستخدمين
        </h2>
        
        <p class="text-sm text-gray-500 mb-6 border-b pb-4">
            قم باختيار الموظف أو المدرس من القائمة الجانبية لتخصيص الصفحات والأقسام المسموح له بزيارتها والعمل عليها داخل لوحة التحكم، وإخفاء باقي الأجزاء منه بالكامل.
        </p>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- العمود الأول: قائمة المستخدمين -->
            <div class="md:col-span-1 border-l pl-6">
                <h3 class="font-bold text-gray-700 mb-4 flex items-center gap-1.5 text-md">
                    <i class="fa-solid fa-users text-primary"></i> حدد المستخدم:
                </h3>
                <div class="space-y-2 max-h-[500px] overflow-y-auto">
                    <?php 
                    while ($user = mysqli_fetch_assoc($users_list)): 
                        $type_label = $user['staff_type'] == 'academic' ? '🎓 مدرس' : '💼 موظف إداري';
                        $type_color = $user['staff_type'] == 'academic' ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : 'bg-teal-50 text-teal-700 border-teal-200';
                        
                        // فك صلاحيات المستخدم الحالية
                        $perms_array = [];
                        if (!empty($user['page_permissions'])) {
                            $perms_array = json_decode($user['page_permissions'], true);
                        }
                    ?>
                    <div id="user_card_<?php echo $user['id']; ?>" onclick='selectUserForPermissions(<?php echo json_encode($user); ?>, <?php echo json_encode($perms_array); ?>)' class="p-3.5 border rounded-lg hover:border-primary hover:bg-gray-50 cursor-pointer transition flex justify-between items-center bg-white">
                        <div>
                            <p class="font-bold text-sm text-gray-800"><?php echo htmlspecialchars($user['full_name']); ?></p>
                            <p class="text-xs text-gray-500 font-medium mt-0.5"><?php echo htmlspecialchars($user['email']); ?></p>
                        </div>
                        <span class="text-[10px] font-bold px-2 py-0.5 rounded border <?php echo $type_color; ?>">
                            <?php echo $type_label; ?>
                        </span>
                    </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <!-- العمود الثاني والثالث: نموذج تحديد الصلاحيات -->
            <div class="md:col-span-2">
                <div id="no_user_selected" class="h-full flex flex-col items-center justify-center py-20 text-gray-400">
                    <i class="fa-solid fa-shield-halved text-6xl mb-4 animate-pulse"></i>
                    <p class="font-bold text-sm">برجاء تحديد مستخدم من القائمة لرسم وإعداد صلاحياته.</p>
                </div>
                
                <form method="POST" id="permissions_form" class="hidden">
                    <input type="hidden" name="target_user_id" id="target_user_id">
                    
                    <div class="bg-gray-50 border rounded-xl p-5 mb-6">
                        <div class="flex justify-between items-center mb-4">
                            <div>
                                <h3 class="font-extrabold text-gray-800 text-lg" id="selected_user_name">---</h3>
                                <p class="text-xs text-gray-500" id="selected_user_email">---</p>
                            </div>
                            <div class="text-left">
                                <button type="button" onclick="toggleAllCheckboxes(true)" class="text-xs font-bold text-primary hover:underline ml-3">تحديد الكل</button>
                                <button type="button" onclick="toggleAllCheckboxes(false)" class="text-xs font-bold text-red-500 hover:underline">إلغاء تحديد الكل</button>
                            </div>
                        </div>
                        
                        <!-- تقسيم الصفحات في مجموعات -->
                        <div class="space-y-6">
                            
                            <!-- مجموعة شؤون الطلاب والدراسة -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-1 mb-3">🎓 شؤون الطلاب والأكاديميات</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_students_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إدارة شؤون الطلاب</p>
                                            <p class="text-[10px] text-gray-400">القبول والتسجيل وتأكيد الرسوم</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_schedule_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">التخصصات والجداول</p>
                                            <p class="text-[10px] text-gray-400">إدارة الأقسام والجدول الدراسي</p>
                                        </div>
                                    </label>

                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_upload_lecture_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">المواد والمحاضرات</p>
                                            <p class="text-[10px] text-gray-400">رفع الملازم والمناهج الدراسية</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_grades_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">الدرجات والنتائج</p>
                                            <p class="text-[10px] text-gray-400">إدخال درجات الطلاب واعتمادها</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- مجموعة الموارد البشرية والرواتب -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-1 mb-3">💼 الموارد البشرية والحضور الحسابي</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_teachers_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إدارة شؤون المدرسين</p>
                                            <p class="text-[10px] text-gray-400">سجل الكادر الأكاديمي والتدريسي</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_staff_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إدارة شؤون الموظفين</p>
                                            <p class="text-[10px] text-gray-400">سجل الكادر الإداري والوظيفي</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_fingerprints_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">البصمات الحيوية</p>
                                            <p class="text-[10px] text-gray-400">تسجيل وتوثيق بصمة الـ USB للطلاب/الموظفين</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                            
                            <!-- مجموعة التقارير والنظام المحاسبي والـ CMS -->
                            <div>
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b pb-1 mb-3">⚙️ الحسابات وإدارة النظام والمحتوى</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_accounting_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">الحسابات والمالية</p>
                                            <p class="text-[10px] text-gray-400">دليل الحسابات والقيود اليومية والصرف</p>
                                        </div>
                                    </label>

                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_reports_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">التقارير التفصيلية</p>
                                            <p class="text-[10px] text-gray-400">تقارير الطلاب والموظفين الرسمية الجاهزة للطباعة</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_content_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إدارة محتوى الموقع (CMS)</p>
                                            <p class="text-[10px] text-gray-400">تعديل نصوص وصور الموقع والصفحات ديناميكياً</p>
                                        </div>
                                    </label>

                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_announcements_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إعلانات الكلية</p>
                                            <p class="text-[10px] text-gray-400">إضافة إعلانات للطلاب وبوابة الإعلانات</p>
                                        </div>
                                    </label>

                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_manage_permissions_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">إدارة الصلاحيات</p>
                                            <p class="text-[10px] text-gray-400">شاشة المدير لمنح وحجب الصفحات عن الموظفين</p>
                                        </div>
                                    </label>
                                    
                                    <label class="flex items-center gap-3 p-3 bg-white border rounded-lg hover:bg-gray-50 cursor-pointer transition">
                                        <input type="checkbox" name="perm_dashboard_php" value="1" class="w-4 h-4 text-primary focus:ring-primary rounded">
                                        <div>
                                            <p class="text-sm font-bold text-gray-800">الصفحة الرئيسية للوحة التحكم</p>
                                            <p class="text-[10px] text-gray-400">لوحة الإحصائيات والإشعارات السريعة</p>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="flex justify-end gap-3">
                        <button type="submit" name="save_permissions" class="bg-primary hover:bg-primaryDark text-white font-bold px-8 py-3 rounded-lg text-sm shadow transition">
                            <i class="fa-solid fa-save ml-1"></i> حفظ وتحديث الصلاحيات
                        </button>
                    </div>
                </form>
            </div>
            
        </div>
    </div>

    <script>
        function selectUserForPermissions(user, perms) {
            // تلوين الكارد المحدد وتجريد غيره
            document.querySelectorAll("[id^='user_card_']").forEach(card => {
                card.classList.remove('border-primary', 'bg-teal-50/20');
            });
            document.getElementById('user_card_' + user.id).classList.add('border-primary', 'bg-teal-50/20');
            
            // تهيئة بيانات العرض
            document.getElementById('no_user_selected').classList.add('hidden');
            document.getElementById('permissions_form').classList.remove('hidden');
            
            document.getElementById('target_user_id').value = user.id;
            document.getElementById('selected_user_name').innerText = user.full_name;
            document.getElementById('selected_user_email').innerText = user.email;
            
            // تفريغ كافة الـ checkboxes أولاً
            document.querySelectorAll("#permissions_form input[type='checkbox']").forEach(chk => {
                chk.checked = false;
            });
            
            // ملء الـ checkboxes بناء على صلاحيات المستخدم الممررة
            const available_pages = [
                'dashboard.php',
                'manage_schedule.php',
                'manage_students.php',
                'manage_teachers.php',
                'manage_staff.php',
                'upload_lecture.php',
                'manage_fingerprints.php',
                'accounting.php',
                'manage_permissions.php',
                'reports.php',
                'announcements.php',
                'manage_grades.php',
                'manage_content.php'
            ];
            
            available_pages.forEach(page => {
                const post_key = 'perm_' + page.replace('.', '_');
                const checkbox = document.getElementsByName(post_key)[0];
                if (checkbox) {
                    // إذا كانت الصلاحية موجودة في المصفوفة ومحددة بقيمة true
                    if (perms && perms[page] === true) {
                        checkbox.checked = true;
                    }
                }
            });
        }
        
        function toggleAllCheckboxes(val) {
            document.querySelectorAll("#permissions_form input[type='checkbox']").forEach(chk => {
                chk.checked = val;
            });
        }
    </script>

<?php include_once 'footer.php'; ?>
