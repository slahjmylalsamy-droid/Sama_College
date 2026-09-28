<?php
// pages/admin_manage_permissions.php - إدارة صلاحيات وأدوار جميع المستخدمين للكلية
if (!defined('INCLUDED_FROM_INDEX') && !isset($is_admin)) {
    die("Direct access not allowed.");
}

$msg = "";

// 1. معالجة تحديث بيانات وصلاحيات المستخدم
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update_user'])) {
    $user_id = intval($_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $permission_level = intval($_POST['permission_level']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $college = mysqli_real_escape_string($conn, $_POST['college']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $semester = mysqli_real_escape_string($conn, $_POST['semester']);
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // التحقق من عدم تعديل صلاحيات المدير نفسه لمنع إغلاق حسابه بالخطأ
    if ($user_id == $_SESSION['user_id'] && ($permission_level < 3 || $role != 'staff')) {
        $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> لا يمكنك إلغاء صلاحيات الإدارة عن حسابك الحالي!</div>';
    } else {
        $query = "UPDATE users SET 
                    full_name = '$full_name',
                    email = '$email',
                    role = '$role', 
                    permission_level = $permission_level, 
                    payment_status = '$payment_status',
                    department = " . ($role == 'student' ? "'$department'" : "NULL") . ",
                    college = " . ($role == 'student' ? "'$college'" : "NULL") . ",
                    level = " . ($role == 'student' ? "'$level'" : "NULL") . ",
                    semester = " . ($role == 'student' ? "'$semester'" : "NULL") . "
                  WHERE id = $user_id";
                  
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم تحديث بيانات وصلاحيات المستخدم بنجاح!</div>';
        } else {
            $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء التحديث: ' . mysqli_error($conn) . '</div>';
        }
    }
}

// 2. معالجة حذف المستخدم بالكامل
if (isset($_GET['delete_user'])) {
    $delete_id = intval($_GET['delete_user']);
    if ($delete_id == $_SESSION['user_id']) {
        $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> لا يمكنك حذف حسابك الحالي!</div>';
    } else {
        $query = "DELETE FROM users WHERE id = $delete_id";
        if (mysqli_query($conn, $query)) {
            $msg = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم حذف حساب المستخدم بالكامل من النظام!</div>';
        } else {
            $msg = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;">❌ خطأ أثناء الحذف: ' . mysqli_error($conn) . '</div>';
        }
    }
}

// الفلترة والبحث
$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';
$filter_role = isset($_GET['filter_role']) ? mysqli_real_escape_string($conn, $_GET['filter_role']) : '';

$where_clauses = ["1=1"];
if (!empty($search)) {
    $where_clauses[] = "(full_name LIKE '%$search%' OR email LIKE '%$search%' OR student_id LIKE '%$search%')";
}
if (!empty($filter_role)) {
    if ($filter_role == 'admin') {
        $where_clauses[] = "permission_level >= 3";
    } elseif ($filter_role == 'staff') {
        $where_clauses[] = "role = 'staff' AND permission_level = 2";
    } elseif ($filter_role == 'student') {
        $where_clauses[] = "role = 'student'";
    }
}
$where_sql = implode(" AND ", $where_clauses);

// جلب المستخدمين
$users_res = mysqli_query($conn, "SELECT * FROM users WHERE $where_sql ORDER BY role DESC, permission_level DESC, id DESC");
?>

<?php echo $msg; ?>

<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);margin-bottom:25px;direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <h2 style="color:#0d4748;margin-top:0;display:flex;align-items:center;gap:10px;">🔑 إدارة صلاحيات المستخدمين والأدوار</h2>
    <p style="color:#666;">يمكنك تعديل رتبة أي مستخدم (طالب، موظف عادي، مدير بالنظام)، بالإضافة إلى تفعيل أو إلغاء حالة دفع الرسوم المالية مباشرة أو حذف الحسابات.</p>
    
    <!-- محرك البحث والفلاتر -->
    <form method="GET" style="display:flex;flex-wrap:wrap;gap:10px;margin-top:20px;">
        <input type="hidden" name="p" value="manage_permissions">
        <input type="text" name="search" placeholder="ابحث بالاسم، البريد أو الرقم الجامعي..." value="<?php echo htmlspecialchars($search); ?>" style="flex:2;min-width:200px;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;">
        <select name="filter_role" style="flex:1;min-width:150px;padding:10px;border:1px solid #ddd;border-radius:8px;font-family:'Cairo',sans-serif;">
            <option value="">كل الرتب</option>
            <option value="student" <?php if($filter_role=='student') echo 'selected'; ?>>الطلاب</option>
            <option value="staff" <?php if($filter_role=='staff') echo 'selected'; ?>>الموظفين</option>
            <option value="admin" <?php if($filter_role=='admin') echo 'selected'; ?>>المدراء</option>
        </select>
        <button type="submit" style="background:#0d4748;color:white;padding:10px 25px;border:none;border-radius:8px;cursor:pointer;font-weight:bold;font-family:'Cairo',sans-serif;">بحث وتصفية</button>
        <a href="?p=manage_permissions" style="background:#eee;color:#333;padding:10px 20px;border-radius:8px;text-decoration:none;font-weight:bold;text-align:center;line-height:22px;">إعادة تعيين</a>
    </form>
</div>

<!-- جدول عرض وتعديل الصلاحيات -->
<div style="background:white;padding:25px;border-radius:12px;box-shadow:0 4px 12px rgba(0,0,0,0.08);overflow-x:auto;direction:rtl;text-align:right;font-family:'Cairo', sans-serif;">
    <table style="width:100%;border-collapse:collapse;min-width:900px;">
        <thead>
            <tr style="background:#0d4748;color:white;">
                <th style="padding:12px;text-align:right;">المستخدم</th>
                <th style="padding:12px;text-align:center;">الدور بالنظام</th>
                <th style="padding:12px;text-align:center;">مستوى الصلاحية</th>
                <th style="padding:12px;text-align:center;">القسم / المستوى</th>
                <th style="padding:12px;text-align:center;">حالة الدفع المالية</th>
                <th style="padding:12px;text-align:center;">التحكم والإجراءات</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($users_res) > 0): while($row = mysqli_fetch_assoc($users_res)): ?>
            <tr style="border-bottom:1px solid #eee;transition:0.2s;" onmouseover="this.style.background='#fafafa';" onmouseout="this.style.background='none';">
                <!-- اسم المستخدم وبريده -->
                <td style="padding:15px;vertical-align:middle;">
                    <strong style="color:#333;display:block;"><?php echo htmlspecialchars($row['full_name']); ?></strong>
                    <span style="color:#666;font-size:12px;display:block;"><?php echo htmlspecialchars($row['email']); ?></span>
                    <?php if(!empty($row['student_id'])): ?>
                        <span style="background:#eef2f7;color:#0d4748;padding:2px 8px;border-radius:12px;font-size:11px;display:inline-block;margin-top:4px;">ID: <?php echo htmlspecialchars($row['student_id']); ?></span>
                    <?php endif; ?>
                </td>
                
                <!-- الدور الحالي -->
                <td style="padding:15px;text-align:center;vertical-align:middle;">
                    <?php if ($row['role'] == 'student'): ?>
                        <span style="background:#ebf8ff;color:#2b6cb0;padding:5px 12px;border-radius:20px;font-size:13px;font-weight:bold;">🎓 طالب</span>
                    <?php else: ?>
                        <span style="background:#fefcbf;color:#b7791f;padding:5px 12px;border-radius:20px;font-size:13px;font-weight:bold;">💼 موظف / كادر</span>
                    <?php endif; ?>
                </td>
                
                <!-- مستوى الصلاحية -->
                <td style="padding:15px;text-align:center;vertical-align:middle;">
                    <?php 
                    if ($row['permission_level'] >= 3) {
                        echo '<span style="background:#fed7d7;color:#c53030;padding:5px 12px;border-radius:20px;font-size:13px;font-weight:bold;">👑 مدير نظام</span>';
                    } elseif ($row['permission_level'] == 2) {
                        echo '<span style="background:#e6fffa;color:#2c7a7b;padding:5px 12px;border-radius:20px;font-size:13px;font-weight:bold;">👨‍🏫 موظف عادي</span>';
                    } else {
                        echo '<span style="background:#edf2f7;color:#4a5568;padding:5px 12px;border-radius:20px;font-size:13px;">طالب (مستوى 1)</span>';
                    }
                    ?>
                </td>
                
                <!-- القسم والمستوى للطلاب -->
                <td style="padding:15px;text-align:center;vertical-align:middle;color:#555;font-size:13px;">
                    <?php 
                    if ($row['role'] == 'student') {
                        echo htmlspecialchars($row['college'] ?? 'غير محدد') . ' <br><span style="color:#888;">(' . htmlspecialchars($row['department'] ?? 'غير محدد') . ')</span><br><b>' . htmlspecialchars($row['level'] ?? '-') . '</b>';
                    } else {
                        echo '<span style="color:#aaa;">-</span>';
                    }
                    ?>
                </td>
                
                <!-- حالة الرسوم والدفع -->
                <td style="padding:15px;text-align:center;vertical-align:middle;">
                    <?php if ($row['role'] == 'student'): ?>
                        <?php if ($row['payment_status'] == 'paid'): ?>
                            <span style="background:#c6f6d5;color:#22543d;padding:4px 10px;border-radius:15px;font-size:12px;font-weight:bold;">🟢 مدفوع</span>
                        <?php elseif ($row['payment_status'] == 'pending'): ?>
                            <span style="background:#feebc8;color:#744210;padding:4px 10px;border-radius:15px;font-size:12px;font-weight:bold;">🟡 معلق / للمراجعة</span>
                        <?php else: ?>
                            <span style="background:#fed7d7;color:#742a2a;padding:4px 10px;border-radius:15px;font-size:12px;font-weight:bold;">🔴 غير مدفوع</span>
                        <?php endif; ?>
                    <?php else: ?>
                        <span style="color:#aaa;">-</span>
                    <?php endif; ?>
                </td>
                
                <!-- الإجراءات والتحكم -->
                <td style="padding:15px;text-align:center;vertical-align:middle;">
                    <!-- زر تعديل الصلاحيات -->
                    <button type="button" onclick="openEditModal(<?php echo htmlspecialchars(json_encode($row)); ?>)" style="background:#3182ce;color:white;padding:6px 12px;border:none;border-radius:6px;cursor:pointer;font-family:'Cairo',sans-serif;font-size:12px;font-weight:bold;margin-left:5px;">✍️ تعديل</button>
                    
                    <!-- زر حذف الحساب -->
                    <?php if ($row['id'] != $_SESSION['user_id']): ?>
                        <a href="?p=manage_permissions&delete_user=<?php echo $row['id']; ?>" style="background:#e53e3e;color:white;padding:6px 12px;border-radius:6px;text-decoration:none;font-size:12px;font-weight:bold;display:inline-block;" onclick="return confirm('<i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> تحذير هام جداً:\nهل أنت متأكد تماماً من حذف هذا المستخدم نهائياً من قاعدة البيانات؟ لا يمكن التراجع عن هذا الإجراء وسيتم حذف جميع سجلاته ودرجاته!')">🗑️ حذف</a>
                    <?php else: ?>
                        <span style="color:#aaa;font-size:12px;">حسابك الحالي</span>
                    <?php endif; ?>
                </td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
                <td colspan="6" style="text-align:center;color:#999;padding:30px;">لم يتم العثور على أي مستخدمين يطابقون شروط البحث.</td>
            </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- مودال التعديل التفاعلي العائم (Modal) -->
<div id="editUserModal" style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);z-index:9999;justify-content:center;align-items:center;direction:rtl;font-family:'Cairo',sans-serif;">
    <div style="background:white;padding:30px;border-radius:15px;max-width:550px;width:90%;box-shadow:0 10px 30px rgba(0,0,0,0.3);position:relative;text-align:right;">
        <span onclick="closeEditModal()" style="position:absolute;top:15px;left:20px;font-size:25px;cursor:pointer;color:#888;">&times;</span>
        <h3 style="color:#0d4748;margin-top:0;border-bottom:2px solid #ffd700;padding-bottom:10px;margin-bottom:20px;">⚙️ تعديل صلاحيات وبيانات المستخدم</h3>
        
        <form method="POST" id="editUserForm">
            <input type="hidden" name="user_id" id="modal_user_id">
            
            <div style="margin-bottom:15px;">
                <label style="display:block;font-weight:bold;margin-bottom:5px;">الاسم الكامل</label>
                <input type="text" name="full_name" id="modal_full_name" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;">
            </div>
            
            <div style="margin-bottom:15px;">
                <label style="display:block;font-weight:bold;margin-bottom:5px;">البريد الإلكتروني</label>
                <input type="email" name="email" id="modal_email" required style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;box-sizing:border-box;">
            </div>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:15px;margin-bottom:15px;">
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:5px;">نوع الدور (Role)</label>
                    <select name="role" id="modal_role" onchange="toggleModalRoleFields()" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                        <option value="student">طالب (Student)</option>
                        <option value="staff">موظف / كادر (Staff)</option>
                    </select>
                </div>
                <div>
                    <label style="display:block;font-weight:bold;margin-bottom:5px;">صلاحية التحكم</label>
                    <select name="permission_level" id="modal_permission_level" style="width:100%;padding:10px;border:1px solid #ddd;border-radius:8px;">
                        <option value="1">1 - طالب عادي</option>
                        <option value="2">2 - موظف ذو صلاحيات عادية</option>
                        <option value="3">3 - مدير ذو صلاحيات كاملة</option>
                    </select>
                </div>
            </div>

            <!-- حقول مخصصة للطلاب فقط -->
            <div id="modal_student_fields" style="display:none;background:#f9fbfd;padding:15px;border-radius:10px;border:1px dashed #bee3f8;margin-bottom:15px;">
                <h4 style="margin:0 0 10px;color:#2b6cb0;font-size:14px;">🎓 خيارات الطالب الأكاديمية والمالية:</h4>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:bold;margin-bottom:5px;">القسم / الكلية</label>
                        <input type="text" name="college" id="modal_college" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:bold;margin-bottom:5px;">التخصص</label>
                        <input type="text" name="department" id="modal_department" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;">
                    </div>
                </div>
                <div style="display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:10px;">
                    <div>
                        <label style="display:block;font-size:12px;font-weight:bold;margin-bottom:5px;">المستوى الأكاديمي</label>
                        <input type="text" name="level" id="modal_level" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block;font-size:12px;font-weight:bold;margin-bottom:5px;">الترم / الفصل الدراسي</label>
                        <input type="text" name="semester" id="modal_semester" placeholder="مثال: الترم الأول" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;">
                    </div>
                </div>
                <div style="margin-bottom:10px;">
                    <label style="display:block;font-size:12px;font-weight:bold;margin-bottom:5px;">حالة سداد الرسوم</label>
                    <select name="payment_status" id="modal_payment_status" style="width:100%;padding:8px;border:1px solid #ddd;border-radius:6px;box-sizing:border-box;">
                        <option value="unpaid">🔴 غير مدفوع</option>
                        <option value="pending">🟡 معلق / قيد المراجعة</option>
                        <option value="paid">🟢 مدفوع بالكامل</option>
                    </select>
                </div>
            </div>

            <div style="display:flex;justify-content:flex-end;gap:10px;margin-top:20px;">
                <button type="button" onclick="closeEditModal()" style="background:#e2e8f0;color:#4a5568;border:none;padding:10px 20px;border-radius:8px;cursor:pointer;font-family:'Cairo',sans-serif;font-weight:bold;">إلغاء</button>
                <button type="submit" name="update_user" style="background:#0d4748;color:white;border:none;padding:10px 25px;border-radius:8px;cursor:pointer;font-family:'Cairo',sans-serif;font-weight:bold;">حفظ التغييرات</button>
            </div>
        </form>
    </div>
</div>

<script>
function openEditModal(user) {
    document.getElementById('modal_user_id').value = user.id;
    document.getElementById('modal_full_name').value = user.full_name;
    document.getElementById('modal_email').value = user.email;
    document.getElementById('modal_role').value = user.role;
    document.getElementById('modal_permission_level').value = user.permission_level;
    document.getElementById('modal_department').value = user.department || '';
    document.getElementById('modal_college').value = user.college || '';
    document.getElementById('modal_level').value = user.level || '';
    document.getElementById('modal_semester').value = user.semester || '';
    document.getElementById('modal_payment_status').value = user.payment_status || 'unpaid';
    
    toggleModalRoleFields();
    
    document.getElementById('editUserModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editUserModal').style.display = 'none';
}

function toggleModalRoleFields() {
    const role = document.getElementById('modal_role').value;
    const studentFields = document.getElementById('modal_student_fields');
    if (role === 'student') {
        studentFields.style.display = 'block';
    } else {
        studentFields.style.display = 'none';
    }
}

// إغلاق المودال عند النقر خارج المحتوى
window.onclick = function(event) {
    const modal = document.getElementById('editUserModal');
    if (event.target == modal) {
        closeEditModal();
    }
}
</script>
