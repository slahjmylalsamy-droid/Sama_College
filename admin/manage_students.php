<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول وأن المستخدم مدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$msg = "";
$error = "";

// 1. معالجة الإجراءات (القبول، تأكيد الدفع، الرفض، الحذف)
// -------------------------------------------------------------

// حذف طالب
if (isset($_GET['delete'])) {
    $delete_id = intval($_GET['delete']);
    
    // جلب الصورة لحذفها من المجلد
    $img_query = mysqli_query($conn, "SELECT image FROM users WHERE id = $delete_id AND role='student'");
    if ($img_row = mysqli_fetch_assoc($img_query)) {
        if (!empty($img_row['image']) && file_exists('../' . $img_row['image'])) {
            unlink('../' . $img_row['image']);
        }
    }
    
    // حذف الطالب وكافة البيانات المتعلقة به
    mysqli_query($conn, "DELETE FROM users WHERE id = $delete_id AND role='student'");
    mysqli_query($conn, "DELETE FROM grades WHERE student_id = $delete_id");
    mysqli_query($conn, "DELETE FROM payments WHERE user_id = $delete_id");
    mysqli_query($conn, "DELETE FROM notifications WHERE user_id = $delete_id");
    
    header("Location: manage_students.php?msg=deleted");
    exit();
}

// قبول طالب (تغيير من pending إلى unpaid)
if (isset($_GET['approve_student']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $query = "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id AND role='student'";
    if (mysqli_query($conn, $query)) {
        $notif_query = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '🎓 تم قبول طلبك في الكلية! يمكنك الآن تسجيل الدخول ومتابعة إجراءات الرسوم.')";
        mysqli_query($conn, $notif_query);
        header("Location: manage_students.php?msg=approved");
        exit();
    }
}

// تأكيد الدفع (تغيير إلى paid)
if (isset($_GET['confirm_payment']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    
    // جلب اسم الطالب ومبلغ الدفع للتسجيل المحاسبي
    $student_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT full_name FROM users WHERE id = $user_id AND role='student'"));
    $student_name = $student_info['full_name'] ?? 'طالب غير معروف';
    
    $payment_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id, amount FROM payments WHERE user_id = $user_id ORDER BY id DESC LIMIT 1"));
    $payment_amount = isset($payment_info['amount']) ? floatval($payment_info['amount']) : 30000.00;
    $payment_id = isset($payment_info['id']) ? intval($payment_info['id']) : 0;
    
    $query = "UPDATE users SET payment_status = 'paid' WHERE id = $user_id AND role='student'";
    if (mysqli_query($conn, $query)) {
        // تحديث حالة إيصال الدفع في جدول payments إن وجد
        mysqli_query($conn, "UPDATE payments SET status = 'approved' WHERE user_id = $user_id ORDER BY id DESC LIMIT 1");
        
        // --- القيد المحاسبي المزدوج للتسجيل التلقائي للرسوم ---
        $cash_acc = getAccountIdByCode('101');
        $income_acc = getAccountIdByCode('401');
        if ($cash_acc && $income_acc) {
            $journal_details = [
                ['account_id' => $cash_acc, 'debit' => $payment_amount, 'credit' => 0.00, 'notes' => "تحصيل رسوم دراسية من الطالب: {$student_name}"],
                ['account_id' => $income_acc, 'debit' => 0.00, 'credit' => $payment_amount, 'notes' => "تحصيل رسوم دراسية من الطالب: {$student_name}"]
            ];
            $admin_id = $_SESSION['user_id'] ?? 1;
            addJournalEntry(date('Y-m-d'), "إثبات سداد الرسوم الدراسية - الطالب {$student_name}", 'payment', $payment_id, $journal_details, $admin_id);
        }
        // ----------------------------------------------------
        
        $notif_query = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '✅ تم تأكيد دفعك! يمكنك الآن مشاهدة درجاتك وجميع خدمات الطالب.')";
        mysqli_query($conn, $notif_query);
        header("Location: manage_students.php?msg=paid");
        exit();
    }
}

// رفض الدفع (تغيير إلى unpaid)
if (isset($_GET['reject_payment']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    $query = "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id AND role='student'";
    if (mysqli_query($conn, $query)) {
        // تحديث حالة إيصال الدفع في جدول payments إن وجد
        mysqli_query($conn, "UPDATE payments SET status = 'rejected' WHERE user_id = $user_id ORDER BY id DESC LIMIT 1");
        
        $notif_query = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '❌ تم رفض إيصال الدفع الخاص بك. برجاء التواصل مع شؤون الطلاب وإعادة الرفع.')";
        mysqli_query($conn, $notif_query);
        header("Location: manage_students.php?msg=rejected");
        exit();
    }
}

// 2. معالجة إضافة طالب جديد
// -------------------------------------------------------------
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_student'])) {
    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $department = mysqli_real_escape_string($conn, $_POST['department']);
    $level = mysqli_real_escape_string($conn, $_POST['level']);
    $payment_status = mysqli_real_escape_string($conn, $_POST['payment_status']);
    
    // التحقق من تكرار البريد الإلكتروني أو الرقم الجامعي
    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email' OR student_id='$student_id'");
    if (mysqli_num_rows($check) > 0) {
        $error = "❌ البريد الإلكتروني أو الرقم الجامعي مسجل مسبقاً!";
    } else {
        $image_path = '';
        if (isset($_FILES['student_image']) && $_FILES['student_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png'];
            $ext = strtolower(pathinfo($_FILES['student_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, $allowed)) {
                $new_filename = time() . '_' . $student_id . '.' . $ext;
                $target = '../uploads/students/' . $new_filename;
                // التأكد من وجود المجلد
                if (!file_exists('../uploads/students')) {
                    mkdir('../uploads/students', 0777, true);
                }
                if (move_uploaded_file($_FILES['student_image']['tmp_name'], $target)) {
                    $image_path = 'uploads/students/' . $new_filename;
                }
            }
        }
        
        $query = "INSERT INTO users (full_name, email, password, role, student_id, department, level, payment_status, image, permission_level) 
                  VALUES ('$full_name', '$email', '$password', 'student', '$student_id', '$department', '$level', '$payment_status', '$image_path', 1)";
        
        if (mysqli_query($conn, $query)) {
            $msg = "✅ تم إضافة الطالب بنجاح!";
        } else {
            $error = "❌ خطأ أثناء الإضافة: " . mysqli_error($conn);
        }
    }
}

// 3. جلب الرسائل من الـ URL
// -------------------------------------------------------------
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == 'paid') $msg = "✅ تم تأكيد الدفع للطالب وتفعيل حسابك بنجاح!";
    if ($_GET['msg'] == 'rejected') $msg = "❌ تم رفض إيصال الدفع وإرسال إشعار للطالب.";
    if ($_GET['msg'] == 'approved') $msg = "✅ تم قبول الطالب ونقل حالته إلى (غير مدفوع).";
    if ($_GET['msg'] == 'deleted') $msg = "🗑️ تم حذف الطالب وكافة سجلاته بنجاح.";
}

// 4. الفلترة وجلب البيانات
// -------------------------------------------------------------
$filter_department = isset($_GET['dept']) ? mysqli_real_escape_string($conn, $_GET['dept']) : '';
$filter_level = isset($_GET['level']) ? mysqli_real_escape_string($conn, $_GET['level']) : '';

$where = "WHERE role='student'";
if ($filter_department) $where .= " AND department = '$filter_department'";
if ($filter_level) $where .= " AND level = '$filter_level'";

$students = mysqli_query($conn, "SELECT * FROM users $where ORDER BY id DESC");
$departments = mysqli_query($conn, "SELECT DISTINCT department FROM users WHERE role='student' AND department IS NOT NULL");
?>

<?php include_once 'header.php'; ?>
        <!-- الإشعارات -->
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

        <!-- أدوات التصفية والبحث -->
        <div class="bg-white rounded-xl shadow-md p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">
            <div class="flex items-center gap-2">
                <i class="fa-solid fa-filter text-primary"></i>
                <span class="font-bold text-gray-700">تصفية القائمة:</span>
            </div>
            <form method="GET" class="flex flex-wrap gap-3 w-full md:w-auto">
                <select name="dept" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
                    <option value="">جميع الأقسام</option>
                    <?php while($d = mysqli_fetch_assoc($departments)): ?>
                        <option value="<?php echo $d['department']; ?>" <?php echo $filter_department == $d['department'] ? 'selected' : ''; ?>>
                            <?php echo $d['department']; ?>
                        </option>
                    <?php endwhile; ?>
                </select>
                <select name="level" class="border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
                    <option value="">جميع المستويات</option>
                    <option value="المستوى الأول" <?php echo $filter_level == 'المستوى الأول' ? 'selected' : ''; ?>>المستوى الأول</option>
                    <option value="المستوى الثاني" <?php echo $filter_level == 'المستوى الثاني' ? 'selected' : ''; ?>>المستوى الثاني</option>
                    <option value="المستوى الثالث" <?php echo $filter_level == 'المستوى الثالث' ? 'selected' : ''; ?>>المستوى الثالث</option>
                    <option value="المستوى الرابع" <?php echo $filter_level == 'المستوى الرابع' ? 'selected' : ''; ?>>المستوى الرابع</option>
                </select>
                <button type="submit" class="bg-primary hover:bg-primaryDark text-white px-5 py-2 rounded-lg text-sm transition">
                    تصفية
                </button>
                <a href="manage_students.php" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-5 py-2 rounded-lg text-sm transition">
                    إعادة تعيين
                </a>
            </form>
        </div>

        <!-- قسم إضافة طالب جديد -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8 border-t-4 border-primary">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-user-plus text-primary"></i> إضافة طالب جديد
            </h2>
            <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">الاسم الكامل</label>
                    <input type="text" name="full_name" placeholder="أدخل الاسم الرباعي" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">البريد الإلكتروني</label>
                    <input type="email" name="email" placeholder="example@college.com" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">كلمة المرور</label>
                    <input type="text" name="password" placeholder="الافتراضية: 123456" value="123456" class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">الرقم الجامعي</label>
                    <input type="text" name="student_id" placeholder="مثال: 2026115" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">القسم</label>
                    <select name="department" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر القسم</option>
                        <option>علوم الحاسوب</option>
                        <option>نظم المعلومات</option>
                        <option>العلوم الطبية</option>
                        <option>تمريض</option>
                        <option>صيدلة</option>
                        <option>مختبرات طبية</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">المستوى</label>
                    <select name="level" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">اختر المستوى</option>
                        <option>المستوى الأول</option>
                        <option>المستوى الثاني</option>
                        <option>المستوى الثالث</option>
                        <option>المستوى الرابع</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">حالة الدفع والتفعيل</label>
                    <select name="payment_status" required class="w-full border rounded-lg px-4 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="pending">قيد المراجعة (معلق)</option>
                        <option value="unpaid">مقبول - غير مدفوع</option>
                        <option value="paid">مقبول - مدفوع ومفعل</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">صورة الطالب الشخصية</label>
                    <input type="file" name="student_image" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-primary/10 file:text-primary hover:file:bg-primary/20">
                </div>
                <div class="md:col-span-4 text-left">
                    <button type="submit" name="add_student" class="bg-primary hover:bg-primaryDark text-white font-bold py-2.5 px-6 rounded-lg text-sm transition shadow-md">
                        <i class="fa-solid fa-check ml-1"></i> إضافة الطالب وحفظ البيانات
                    </button>
                </div>
            </form>
        </div>

        <!-- جدول قائمة الطلاب -->
        <div class="bg-white rounded-xl shadow-md p-6 overflow-x-auto">
            <h2 class="text-xl font-bold text-gray-800 mb-4 flex items-center gap-2">
                <i class="fa-solid fa-users text-primary"></i> قائمة الطلاب المقيدين في الكلية (<?php echo mysqli_num_rows($students); ?> طالب)
            </h2>
            <table class="w-full text-right border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-gray-700">
                        <th class="px-4 py-3 text-sm font-bold border-b">#</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الصورة</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الاسم الكامل</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">البريد الإلكتروني</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">الرقم الجامعي</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">القسم</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">المستوى</th>
                        <th class="px-4 py-3 text-sm font-bold border-b">حالة الدفع</th>
                        <th class="px-4 py-3 text-sm font-bold border-b text-center">الإجراءات والعمليات</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php 
                    $i = 1; 
                    while($row = mysqli_fetch_assoc($students)): 
                        $status_colors = [
                            'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'unpaid' => 'bg-red-100 text-red-800 border-red-200',
                            'paid' => 'bg-green-100 text-green-800 border-green-200'
                        ]; 
                        $status_labels = [
                            'pending' => 'قيد المراجعة',
                            'unpaid' => 'غير مدفوع',
                            'paid' => 'مدفوع'
                        ];
                    ?>
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-4 py-3 text-sm"><?php echo $i++; ?></td>
                        <td class="px-4 py-3 text-sm">
                            <?php if(!empty($row['image']) && file_exists('../' . $row['image'])): ?>
                                <img src="../<?php echo $row['image']; ?>" class="w-10 h-10 rounded-full object-cover border">
                            <?php else: ?>
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center border text-gray-400">
                                    <i class="fa-solid fa-user"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo $row['full_name']; ?></td>
                        <td class="px-4 py-3 text-sm text-gray-500"><?php echo $row['email']; ?></td>
                        <td class="px-4 py-3 text-sm font-mono text-gray-600"><?php echo $row['student_id']; ?></td>
                        <td class="px-4 py-3 text-sm"><?php echo $row['department']; ?></td>
                        <td class="px-4 py-3 text-sm"><?php echo $row['level'] ?? '-'; ?></td>
                        <td class="px-4 py-3 text-sm">
                            <span class="px-2.5 py-1 rounded-full text-xs font-bold border <?php echo $status_colors[$row['payment_status']]; ?>">
                                <?php echo $status_labels[$row['payment_status']]; ?>
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm text-center">
                            <div class="flex flex-wrap gap-1 justify-center">
                                <?php if ($row['payment_status'] == 'pending'): ?>
                                    <a href="manage_students.php?approve_student=1&user_id=<?php echo $row['id']; ?>" class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('هل أنت متأكد من قبول طلب التحاق هذا الطالب؟')">
                                        <i class="fa-solid fa-user-check"></i> قبول الطالب
                                    </a>
                                <?php endif; ?>
                                
                                <?php if ($row['payment_status'] == 'unpaid'): ?>
                                    <a href="manage_students.php?confirm_payment=1&user_id=<?php echo $row['id']; ?>" class="bg-primary hover:bg-primaryDark text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('تأكيد استلام الرسوم وتفعيل حساب الطالب؟')">
                                        <i class="fa-solid fa-receipt"></i> تأكيد الدفع
                                    </a>
                                    <a href="manage_students.php?reject_payment=1&user_id=<?php echo $row['id']; ?>" class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('هل تريد رفض الحوالة وإعلام الطالب؟')">
                                        <i class="fa-solid fa-times-circle"></i> رفض الإيصال
                                    </a>
                                <?php endif; ?>
                                
                                <a href="manage_students.php?delete=<?php echo $row['id']; ?>" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs font-semibold shadow-sm transition" onclick="return confirm('⚠️ تحذير: سيتم حذف الطالب وكافة درجاته وإيصالاته نهائياً. هل أنت متأكد؟')">
                                    <i class="fa-solid fa-trash-can"></i> حذف
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <?php include_once 'footer.php'; ?>
