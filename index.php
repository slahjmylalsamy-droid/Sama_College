<?php
require_once 'db_connect.php';
define('INCLUDED_FROM_INDEX', true);
include_once 'pages/news_data.php';
include_once 'pages/latest_news_data.php';

$page_titles = [
    'about' => 'نبذة عن الكلية',
    'president' => 'عميد الكلية',
    'vision' => 'الرؤية والرسالة',
    'goals' => 'الأهداف والقيم',
    'strategy' => 'الخطة الاستراتيجية',
    'news' => 'الأخبار',
    'latest_news' => 'آخر الأخبار',
    'students' => 'شؤون الطلاب',
    'research' => 'الدراسات والبحوث',
    'library' => 'المكتبة',
    'jobs' => 'الوظائف',
    'contact' => 'اتصل بنا',
    'enroll' => 'طلب الالتحاق',
    'schedule' => 'التقويم الجامعي',
    'portal' => 'البوابة الإلكترونية',
    'attendance_kiosk' => 'جهاز البصمة الإلكتروني',
    'grades' => 'نتائج الامتحانات',
    'complaints' => 'تقديم شكوى / مقترح',
    'events' => 'الفعاليات والأنشطة',
    'major_it' => 'تقنية معلومات',
    'major_graphics' => 'جرافيكس',
    'major_arch' => 'هندسة معمارية',
    'major_accounting' => 'محاسبة',
    'major_business' => 'إدارة أعمال',
    'major_pharmacy' => 'صيدلة',
    'major_assistant' => 'مساعد طبيب',
    'major_dentist' => 'مساعد طبيب أسنان',
    'major_midwife' => 'قبالة وتوليد',
    'quality' => 'مركز التطوير وضمان الجودة',
    'planning' => 'إدارة التطوير والتخطيط الاستراتيجي',
    'students_affairs' => 'إدارة شؤون الطلاب',
    'finance' => 'إدارة الشئون المالية والإدارية',
    'it' => 'إدارة تكنولوجيا المعلومات',
    'medical_institute' => 'معهد الكلية للعلوم الطبية',
    'community_college' => 'كلية سماء المتميزين (كلية مجتمع خاصة)',
    'training_center' => 'مركز الكلية للتدريب والتأهيل الجامعي',
    'community_services' => 'مراكز خدمات المجتمع',
    'branch_damnah' => 'فرع دمنة خدير',
    'branch_rahdah' => 'فرع الراهدة',
    'announcements_public' => 'اعلانات هامة'
];

// ============================================================
// 1. تحديد الصفحة المطلوبة
// ============================================================
$page = isset($_GET['p']) ? $_GET['p'] : 'home';
if ($page === 'login') {
    header("Location: login.php");
    exit();
}
if ($page === 'academic_groups') {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['role'] === 'staff') {
            header("Location: admin/academic_groups.php");
        } else {
            header("Location: student/academic_groups.php");
        }
    } else {
        header("Location: login.php");
    }
    exit();
}

// ============================================================
// 2. معالجة تسجيل الدخول
// ============================================================
$login_error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $query = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
        if ($user['payment_status'] === 'pending') {
            $login_error = "<i class='fa-solid fa-triangle-exclamation' style='margin-left: 5px;'></i> حسابك قيد المراجعة. سيتم إشعارك عند قبول طلبك.";
        } else {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            $_SESSION['role'] = $user['role'];
            $_SESSION['permission'] = $user['permission_level'];
            $_SESSION['student_id'] = $user['student_id'];
            $_SESSION['department'] = $user['department'];
            $_SESSION['payment_status'] = $user['payment_status'];
            if ($user['permission_level'] >= 3) {
                $page = 'admin_dashboard';
            } elseif ($user['permission_level'] >= 2) {
                $page = 'staff_dashboard';
            } else {
                $page = 'student_dashboard';
            }
        }
    } else {
        $login_error = "❌ البريد الإلكتروني أو كلمة المرور غير صحيحة.";
    }
}

// ============================================================
// 3. معالجة تسجيل الخروج
// ============================================================
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}

// ============================================================
// 4. معالجة طلب الالتحاق
// ============================================================
$enroll_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($_POST)) {
    $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ فشل إرسال البيانات: حجم الملفات المرفقة كبير جداً. يرجى رفع صور بحجم أصغر (أقل من 2 ميجابايت).</div>';
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['enroll'])) {
    // التحقق من الأعمدة المضافة حديثاً في قاعدة البيانات وتحديث الجدول تلقائياً إن لزم الأمر (حماية ضد المزامنة المفقودة في الخوادم)
    $required_columns = [
        'english_name' => 'VARCHAR(150) DEFAULT NULL',
        'gender' => 'VARCHAR(20) DEFAULT NULL',
        'birth_date' => 'DATE DEFAULT NULL',
        'birth_place' => 'VARCHAR(150) DEFAULT NULL',
        'nationality' => 'VARCHAR(100) DEFAULT NULL',
        'address' => 'VARCHAR(255) DEFAULT NULL',
        'parent_phone' => 'VARCHAR(50) DEFAULT NULL',
        'whatsapp' => 'VARCHAR(50) DEFAULT NULL',
        'qualification_type' => 'VARCHAR(100) DEFAULT NULL',
        'total_marks' => 'VARCHAR(50) DEFAULT NULL',
        'seat_number' => 'VARCHAR(50) DEFAULT NULL',
        'high_school_percentage' => 'DECIMAL(5,2) DEFAULT NULL',
        'graduation_year' => 'VARCHAR(50) DEFAULT NULL',
        'school_name' => 'VARCHAR(200) DEFAULT NULL',
        'school_cert_image' => 'VARCHAR(255) DEFAULT NULL',
        'identity_image' => 'VARCHAR(255) DEFAULT NULL',
        'identity_type' => 'VARCHAR(100) DEFAULT NULL',
        'identity_number' => 'VARCHAR(100) DEFAULT NULL',
        'identity_place' => 'VARCHAR(150) DEFAULT NULL',
        'identity_issue_date' => 'DATE DEFAULT NULL',
        'branch' => 'VARCHAR(150) DEFAULT NULL',
        'college' => 'VARCHAR(150) DEFAULT NULL'
    ];
    $existing_columns = [];
    $res = mysqli_query($conn, "DESCRIBE users");
    if ($res) {
        while ($row = mysqli_fetch_assoc($res)) {
            $existing_columns[] = strtolower($row['Field']);
        }
    }
    foreach ($required_columns as $col => $definition) {
        if (!in_array(strtolower($col), $existing_columns)) {
            mysqli_query($conn, "ALTER TABLE users ADD COLUMN $col $definition");
        }
    }

    $full_name = mysqli_real_escape_string($conn, $_POST['full_name']);
    
    // التحقق من الاسم الرباعي
    $name_parts = preg_split('/\s+/', trim($_POST['full_name']));
    $name_parts = array_filter($name_parts);
    
    $phone_raw = trim($_POST['phone'] ?? '');
    $parent_phone_raw = trim($_POST['parent_phone'] ?? '');
    $whatsapp_raw = trim($_POST['whatsapp'] ?? '');
    
    $english_name_raw = trim($_POST['english_name'] ?? '');
    
    if (count($name_parts) < 4) {
        $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ خطأ أثناء التسجيل: يجب كتابة الاسم الرباعي كاملاً باللغة العربية.</div>';
    } elseif (!preg_match('/^[a-zA-Z\s.-]+$/', $english_name_raw)) {
        $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ خطأ أثناء التسجيل: يجب كتابة الاسم باللغة الإنجليزية فقط في حقل الاسم الإنجليزي.</div>';
    } elseif (!preg_match('/^[0-9]{9}$/', $phone_raw) || !preg_match('/^[0-9]{9}$/', $parent_phone_raw) || !preg_match('/^[0-9]{9}$/', $whatsapp_raw)) {
        $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ خطأ أثناء التسجيل: يجب أن تكون أرقام الهواتف (جوال الطالب، جوال ولي الأمر، رقم الواتس) صحيحة ومكونة من 9 أرقام.</div>';
    } else {
        $english_name = mysqli_real_escape_string($conn, $_POST['english_name'] ?? '');
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $department = mysqli_real_escape_string($conn, $_POST['department']);
        $password = md5($_POST['password']);
        
        // حقول التسجيل الجديدة
        $gender = mysqli_real_escape_string($conn, $_POST['gender'] ?? '');
        $birth_date = mysqli_real_escape_string($conn, $_POST['birth_date'] ?? '');
        $birth_place = mysqli_real_escape_string($conn, $_POST['birth_place'] ?? '');
        $nationality = mysqli_real_escape_string($conn, $_POST['nationality'] ?? '');
        $address = mysqli_real_escape_string($conn, $_POST['address'] ?? '');
        $parent_phone = mysqli_real_escape_string($conn, $_POST['parent_phone'] ?? '');
        $whatsapp = mysqli_real_escape_string($conn, $_POST['whatsapp'] ?? '');
        
        $qualification_type = mysqli_real_escape_string($conn, $_POST['qualification_type'] ?? '');
        $total_marks = mysqli_real_escape_string($conn, $_POST['total_marks'] ?? '');
        $seat_number = mysqli_real_escape_string($conn, $_POST['seat_number'] ?? '');
        $high_school_percentage = floatval($_POST['high_school_percentage'] ?? 0);
        $graduation_year = mysqli_real_escape_string($conn, $_POST['graduation_year'] ?? '');
        $school_name = mysqli_real_escape_string($conn, $_POST['school_name'] ?? '');
        
        // رفع صورة نتيجة الثانوية
        $school_cert_image = '';
        if (isset($_FILES['school_cert_image']) && $_FILES['school_cert_image']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['school_cert_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','pdf'])) {
                if (!is_dir('uploads/certificates')) {
                    mkdir('uploads/certificates', 0777, true);
                }
                $new_filename = time() . '_' . rand(1000, 9999) . '.' . $ext;
                $target = 'uploads/certificates/' . $new_filename;
                if (move_uploaded_file($_FILES['school_cert_image']['tmp_name'], $target)) {
                    $school_cert_image = $target;
                }
            }
        }
        
        $identity_type = mysqli_real_escape_string($conn, $_POST['identity_type'] ?? '');
        $identity_number = mysqli_real_escape_string($conn, $_POST['identity_number'] ?? '');
        $identity_place = mysqli_real_escape_string($conn, $_POST['identity_place'] ?? '');
        $identity_issue_date = mysqli_real_escape_string($conn, $_POST['identity_issue_date'] ?? '');
        
        // رفع صورة الهوية
        $identity_image = '';
        if (isset($_FILES['identity_image']) && $_FILES['identity_image']['error'] == 0) {
            $ext = strtolower(pathinfo($_FILES['identity_image']['name'], PATHINFO_EXTENSION));
            if (in_array($ext, ['jpg','jpeg','png','pdf'])) {
                if (!is_dir('uploads/identities')) {
                    mkdir('uploads/identities', 0777, true);
                }
                $new_filename = time() . '_' . rand(1000, 9999) . '.' . $ext;
                $target = 'uploads/identities/' . $new_filename;
                if (move_uploaded_file($_FILES['identity_image']['tmp_name'], $target)) {
                    $identity_image = $target;
                }
            }
        }
        
        $branch = mysqli_real_escape_string($conn, $_POST['branch'] ?? '');
        $college = mysqli_real_escape_string($conn, $_POST['college'] ?? '');
        
        // تحديد قيمة الكلية المقروءة للعرض
        if ($college == 'medical') $college_name = 'الأقسام الطبية';
        elseif ($college == 'engineering') $college_name = 'الأقسام الهندسية';
        elseif ($college == 'admin') $college_name = 'الأقسام الإدارية';
        else $college_name = $college;

        $student_id = date('Y') . rand(100, 999);
        
        $birth_date_val = !empty($birth_date) ? "'$birth_date'" : "NULL";
        $identity_issue_val = !empty($identity_issue_date) ? "'$identity_issue_date'" : "NULL";

        // التحقق من تكرار البريد الإلكتروني في قاعدة البيانات
        $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email = '$email'");
        if (mysqli_num_rows($check_email) > 0) {
            $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ خطأ أثناء التسجيل: البريد الإلكتروني مستخدم بالفعل من قبل طالب آخر. يرجى استخدام بريد إلكتروني مختلف.</div>';
        } else {
            $query = "INSERT INTO users (full_name, english_name, email, password, role, student_id, department, payment_status, permission_level,
                                        gender, birth_date, birth_place, nationality, address, parent_phone, whatsapp,
                                        qualification_type, total_marks, seat_number, high_school_percentage, graduation_year, school_name, school_cert_image,
                                        identity_type, identity_number, identity_place, identity_issue_date, identity_image, branch, college) 
                      VALUES ('$full_name', '$english_name', '$email', '$password', 'student', '$student_id', '$department', 'pending', 1,
                              '$gender', $birth_date_val, '$birth_place', '$nationality', '$address', '$parent_phone', '$whatsapp',
                              '$qualification_type', '$total_marks', '$seat_number', $high_school_percentage, '$graduation_year', '$school_name', '$school_cert_image',
                              '$identity_type', '$identity_number', '$identity_place', $identity_issue_val, '$identity_image', '$branch', '$college_name')";

            if (mysqli_query($conn, $query)) {
                $enroll_message = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">✅ تم تسجيل طلب التحاقك بنجاح! رقمك الجامعي المؤقت: <strong>' . $student_id . '</strong><br>الرجاء حفظ الرقم لتسجيل الدخول ومتابعة حالة الدفع والقبول.</div>';
                $show_success_modal = true;
            } else {
                $enroll_message = '<div style="background:#f8d7da;color:#4a151b;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #dc3545;font-family:\'Cairo\',sans-serif;direction:rtl;text-align:right;">❌ خطأ أثناء التسجيل: ' . mysqli_error($conn) . '</div>';
            }
        }
    }
}

// ============================================================
// 5. معالجة رفع إيصال الدفع
// ============================================================
$receipt_message = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['upload_receipt']) && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $transaction_number = mysqli_real_escape_string($conn, $_POST['transaction_number'] ?? '');
    $receipt_file = '';
    if (isset($_FILES['receipt_file']) && $_FILES['receipt_file']['error'] == 0) {
        $ext = strtolower(pathinfo($_FILES['receipt_file']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','pdf'])) {
            $new_filename = time() . '_' . $user_id . '.' . $ext;
            $target = 'uploads/receipts/' . $new_filename;
            if (move_uploaded_file($_FILES['receipt_file']['tmp_name'], $target)) { $receipt_file = $target; }
        }
    }
    if ($receipt_file) {
        $query = "INSERT INTO payments (user_id, receipt_file, transaction_number, uploaded_by) VALUES ($user_id, '$receipt_file', '$transaction_number', 'student')";
        if (mysqli_query($conn, $query)) {
            mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '📤 تم رفع إيصال الدفع. سيتم مراجعته.')");
            $receipt_message = '<div style="background:#d4edda;color:#155724;padding:15px;border-radius:8px;margin-bottom:20px;border-right:4px solid #28a745;">✅ تم رفع الإيصال بنجاح!</div>';
        }
    }
}

// ============================================================
// 6. معالجة تأكيد ورفض الدفع وقبول الطالب
// ============================================================
if (isset($_GET['confirm_payment']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    mysqli_query($conn, "UPDATE users SET payment_status = 'paid' WHERE id = $user_id");
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '✅ تم تأكيد دفعك!')");
    header("Location: index.php?p=manage_students&msg=paid"); exit();
}
if (isset($_GET['reject_payment']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    mysqli_query($conn, "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id");
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '❌ تم رفض الإيصال.')");
    header("Location: index.php?p=manage_students&msg=rejected"); exit();
}
if (isset($_GET['approve_student']) && isset($_GET['user_id'])) {
    $user_id = intval($_GET['user_id']);
    mysqli_query($conn, "UPDATE users SET payment_status = 'unpaid' WHERE id = $user_id");
    mysqli_query($conn, "INSERT INTO notifications (user_id, message) VALUES ($user_id, '🎓 تم قبول طلبك!')");
    header("Location: index.php?p=manage_students&msg=approved"); exit();
}

// ============================================================
// 7. التحقق من الصلاحيات
// ============================================================
$is_logged_in = isset($_SESSION['user_id']);
$permission = $_SESSION['permission'] ?? 0;
$payment_status = $_SESSION['payment_status'] ?? 'unpaid';
$is_admin = ($permission >= 3);
$is_staff = ($permission >= 2);
$is_student = ($permission >= 1 && $permission < 2);
$is_paid = ($payment_status === 'paid');

$public_pages = [
    'home', 'login', 'enroll', 'announcements_public', 'schedule', 'portal', 'grades', 'complaints', 'events', 'latest_news',
    'about', 'president', 'vision', 'goals', 'strategy',
    'news', 'students', 'research', 'library', 'jobs', 'contact',
    // Majors
    'major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife',
    // Admin
    'quality', 'planning', 'students_affairs', 'finance', 'it',
    // Centers
    'medical_institute', 'community_college', 'training_center', 'community_services',
    // Branches
    'branch_damnah', 'branch_rahdah'
];
$major_pages = [
    'major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife'
];
$center_pages = [
    'medical_institute', 'community_college', 'training_center', 'community_services'
];
$admin_pages = ['admin_dashboard', 'manage_students', 'manage_staff', 'manage_grades', 'upload_lecture', 'announcements', 'manage_schedule', 'manage_content', 'manage_permissions'];
$staff_pages = ['staff_dashboard', 'manage_grades', 'upload_lecture', 'announcements'];
$student_pages = ['student_dashboard', 'grades', 'schedule', 'lectures', 'study_plan', 'upload_receipt', 'complaints', 'events'];

$allowed_pages = $public_pages;
if ($is_admin) $allowed_pages = array_merge($allowed_pages, $admin_pages);
if ($is_staff) $allowed_pages = array_merge($allowed_pages, $staff_pages);
if ($is_student) $allowed_pages = array_merge($allowed_pages, $student_pages);
if ($page == 'grades' && $is_student && !$is_paid) $page = 'student_dashboard';
if (!in_array($page, $allowed_pages) && $page != 'home') $page = 'home';
?>

<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</title>

<style>
<?php
$theme_color = get_setting('theme_color', '#0d4748');
$accent_color = get_setting('accent_color', '#c5a059');

function adjust_brightness_local($hex, $steps) {
    $steps = max(-255, min(255, $steps));
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
}
$dark_theme_color = adjust_brightness_local($theme_color, -40);
?>
:root{
    --main-color: <?php echo $theme_color; ?>;
    --dark-color: <?php echo $dark_theme_color; ?>;
    --accent-color: <?php echo $accent_color; ?>;
    --light-color:#eef5fb;
}
body{
    margin:0;
    font-family: Tahoma, sans-serif;
    background:#f4f6f9;
}
header{
    text-align:center;
    padding:20px;
    background:var(--main-color);
    color:white;
}
.logo{
    width:90px;
}
.slider{
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:40px;
    max-width:1200px;
    margin:auto;
    padding:50px 40px;
    background:white;
    position:relative;
}
.slider-img-wrap {
    flex: 1 1 55%;
    max-width: 58%;
    height: 480px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px;
    box-sizing: border-box;
    position: relative;
}
.slider-img-wrap img {
    max-width: 100%;
    max-height: 100%;
    width: auto;
    height: auto;
    object-fit: contain !important; /* عرض كامل 100% دون أي اقتطاع سواء كانت الصورة عرضية أو طولية */
    border-radius: 14px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.12);
    transition: all 0.5s ease;
}
.slider-content{
    flex: 1 1 40%;
    max-width: 42%;
}
.slider-content h2{
    color:var(--main-color);
    font-size:28px;
}
.slider-content p{
    line-height:1.9;
    font-size:17px;
    color:#444;
}
.prev, .next{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:var(--main-color);
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:50%;
    cursor:pointer;
    font-size:18px;
}
.prev{ right:10px; }
.next{ left:10px; }
.prev:hover, .next:hover{ background:var(--accent-color) !important; color:black !important; }
.dots{
    text-align:center;
    margin-top:15px;
}
.dot{
    height:12px;
    width:12px;
    margin:5px;
    background:#ccc;
    display:inline-block;
    border-radius:50%;
    cursor:pointer;
}
.dot.active{
    background:var(--main-color);
}
.services{
    padding:60px 20px;
    text-align:center;
    background:#eef2f7;
}
.services h2{
    color:var(--main-color);
    font-size:28px;
}
.services p{
    max-width:700px;
    margin:auto;
    margin-bottom:40px;
    line-height:1.8;
}
.services-boxes{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}
.box{
    background:white;
    padding:30px;
    border-radius:15px;
    text-decoration:none;
    color:black;
    position:relative;
    transition:0.4s;
    border-top:4px solid var(--main-color);
    box-shadow:0 8px 20px rgba(0,0,0,0.08);
}
.box:hover{
    background:var(--accent-color);
    color:black;
    transform:translateY(-8px);
}
.box h3{
    margin-bottom:10px;
}
.arrow{
    position:absolute;
    top:15px;
    left:15px;
    font-size:18px;
    transition:0.3s;
}
.box:hover .arrow{
    color:var(--main-color) !important;
    transform:translateX(-5px);
}
.hover-text{
    font-size:14px;
    opacity:0;
    transition:0.3s;
}
.box:hover .hover-text, .quick:hover .hover-text{
    opacity:1;
}
.box:hover .service-icon {
    stroke: var(--main-color) !important;
}
.quick-boxes{
    display:flex;
    justify-content:center;
    gap:30px;
    padding:50px 20px;
    background:white;
}
.quick{
    background:white;
    width:280px;
    padding:25px;
    border-radius:12px;
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
    text-align:center;
    transition:0.4s;
    border-top:4px solid var(--main-color);
}
.quick:hover{
    background:var(--accent-color);
    color:black;
    transform:translateY(-8px);
}
.quick:hover .quick-icon {
    stroke: var(--main-color) !important;
}
.quick h3{
    margin-bottom:10px;
}
.majors{
    padding:60px 20px;
    background:var(--light-color);
    text-align:center;
}
.majors h2{
    color:var(--main-color);
    margin-bottom:40px;
}
.major-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}
.major-box{
    background:white;
    border-radius:15px;
    overflow:hidden;
    box-shadow:0 6px 15px rgba(0,0,0,0.1);
    transition:0.4s;
    text-decoration:none;
    color:black;
}
.major-box img{
    width:100%;
    height:180px;
    object-fit:cover;
}
.major-box div{
    padding:15px;
}
.major-box:hover{
    transform:translateY(-8px);
    background:var(--accent-color);
    color:black;
}
.news-carousel{
    position:relative;
    padding:60px 20px;
    background:white;
}
.news-carousel h2{
    color:var(--main-color);
    text-align:center;
    margin-bottom:20px;
}
.news-container{
    display:flex;
    gap:20px;
    overflow:hidden;
}
.news-card{
    min-width:300px;
    background:#eef2f7;
    padding:20px;
    border-radius:12px;
    box-shadow:0 4px 15px rgba(0,0,0,0.1);
    flex-shrink:0;
    transition:0.3s;
}
.news-card:hover{
    transform:scale(1.05) translateY(-5px);
    background:var(--accent-color);
    color:black;
}
.news-prev, .news-next{
    position:absolute;
    top:50%;
    transform:translateY(-50%);
    background:var(--main-color);
    color:white;
    border:none;
    padding:10px 15px;
    border-radius:50%;
    cursor:pointer;
    font-size:20px;
    z-index:10;
}
.news-prev{ left:10px; }
.news-next{ right:10px; }
.news-prev:hover, .news-next:hover{ background:var(--accent-color) !important; color:black !important; }
.calendar{
    max-width:950px;
    margin:auto;
    padding:50px 20px;
    background:#f9faff;
    border-radius:15px;
    box-shadow:0 8px 20px rgba(0,0,0,0.1);
}
.calendar h2{
    text-align:center;
    color:var(--main-color);
    margin-bottom:30px;
}
.filters{
    display:flex;
    justify-content:center;
    gap:20px;
    margin-bottom:30px;
    flex-wrap:wrap;
}
.filters label{
    font-weight:bold;
    font-size:16px;
}
.filters select{
    padding:8px 12px;
    border-radius:8px;
    border:1px solid #ccc;
    font-size:15px;
}
.events-container{
    display:flex;
    flex-direction:column;
    gap:15px;
}
.event{
    padding:15px 20px;
    border-left:6px solid;
    border-radius:10px;
    background:white;
    transition:0.3s;
    font-size:16px;
    box-shadow:0 4px 12px rgba(0,0,0,0.08);
}
.event:hover{
    transform:translateY(-5px);
    color:white;
}
.event.lecture{ border-color:#1c7f7c; }
.event.lecture:hover{ background:#1c7f7c; }
.event.exam{ border-color:#f44336; }
.event.exam:hover{ background:#f44336; }
.event.announcement{ border-color:#ff9800; }
.event.announcement:hover{ background:#ff9800; }
.event.workshop{ border-color:#4caf50; }
.event.workshop:hover{ background:#4caf50; }
.official-footer{
    background: linear-gradient(135deg, var(--main-color), var(--dark-color));
    color:white;
    padding:80px 20px;
    text-align:center;
}
.official-footer h2{
    margin-bottom:20px;
    font-size:26px;
}
.official-footer p{
    line-height:1.9;
    font-size:16px;
}
.footer-contacts{
    margin-top:30px;
    line-height:2;
    font-size:15px;
}
.footer-logo{
    margin-top:40px;
}
.footer-logo img{
    width:110px;
}
.copy{
    margin-top:20px;
    font-size:14px;
    opacity:0.9;
}
.social-icons{
    margin-top:25px;
}
.social-icons a{
    display:inline-block;
    margin:0 10px;
    font-size:22px;
    width:50px;
    height:50px;
    line-height:50px;
    text-align:center;
    border-radius:50%;
    color:white;
    background:rgba(255,255,255,0.2);
    transition:0.3s;
}
.social-icons a:hover{
    background:white;
    color:var(--accent-color);
}
#topBtn{
    position:fixed;
    bottom:20px;
    left:20px;
    display:none;
    padding:10px 15px;
    background:var(--main-color);
    color:white;
    border:none;
    border-radius:8px;
    cursor:pointer;
}
@media(max-width:600px){
    .slider{
        flex-direction:column;
        padding:30px 15px;
    }
    .slider-img-wrap{
        width:100%;
        max-width:100%;
        height:360px;
    }
    .slider-content{
        width:100%;
        max-width:100%;
        text-align:center;
    }
    .slider-content h2{
        font-size:22px;
    }
    .quick-boxes{
        flex-direction:column;
        align-items:center;
    }
    .quick{
        width:90%;
    }
    .filters{
        flex-direction:column;
        align-items:center;
    }
    .filters select{
        width:80%;
    }
    .news-container{
        flex-direction:column;
    }
    .news-card{
        min-width:auto;
    }
}
.social-box:hover {
    background-color: var(--main-color) !important;
    color: white !important;
    transform: translateY(-4px);
    box-shadow: 0 4px 10px rgba(13, 71, 72, 0.2);
}
/* ===== قسم سجل معنا التفاعلي الجديد ===== */
.quick-register-section {
    display: flex;
    background: #f4f6f9;
    padding: 60px 40px;
    justify-content: center;
    align-items: center;
    direction: rtl;
    font-family: 'Cairo', sans-serif;
}

.register-container {
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    max-width: 1100px;
    background-image: linear-gradient(135deg, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.15) 100%), url('images/registration_bg.jpg?v=1.3');
    background-size: cover;
    background-position: center center;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    min-height: 540px;
    padding: 40px;
    box-sizing: border-box;
    position: relative;
}

.register-form-card {
    width: 100%;
    max-width: 410px;
    padding: 40px 35px;
    background: white;
    border-radius: 12px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.25);
    box-sizing: border-box;
    z-index: 2;
}

.register-form-card h3 {
    color: var(--main-color); /* لون عنابي رسمي جميل مطبق في الموقع */
    font-size: 24px;
    font-weight: 800;
    margin: 0 0 8px 0;
    text-align: right;
}

.register-form-card p.subtitle {
    color: var(--main-color); /* لون كرزي/عنابي مناسب للنصوص الفرعية بالصورة */
    font-size: 14px;
    margin: 0 0 35px 0;
    font-weight: 700;
    text-align: right;
}

.reg-form-group {
    margin-bottom: 22px;
    position: relative;
    text-align: right;
}

.reg-input-wrapper {
    display: flex;
    align-items: center;
    border-bottom: 1.5px solid #eaeaea;
    width: 100%;
    box-sizing: border-box;
    transition: border-color 0.3s;
}

.reg-input-wrapper:focus-within {
    border-bottom-color: var(--main-color);
}

.reg-field-icon {
    stroke: #777;
    margin-left: 10px; /* تباعد أيقونات الإدخال في التنسيق العربي RTL */
    transition: stroke 0.3s;
    flex-shrink: 0;
}

.reg-input-wrapper:focus-within .reg-field-icon {
    stroke: var(--main-color);
}

.reg-form-input, .reg-form-select {
    width: 100%;
    padding: 10px 0px;
    border: none !important;
    font-size: 15px;
    font-family: 'Cairo', sans-serif;
    color: #333;
    outline: none !important;
    background: transparent !important;
    box-sizing: border-box;
    border-radius: 0px !important;
}

.reg-form-select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    cursor: pointer;
    color: #555;
}

.captcha-box {
    background: #000;
    color: #ffffff;
    font-family: monospace;
    font-size: 17px;
    font-weight: bold;
    letter-spacing: 2px;
    padding: 4px 10px;
    border-radius: 3px;
    user-select: none;
    display: inline-block;
    text-align: center;
    box-shadow: inset 0 0 5px rgba(0,0,0,0.5);
}

.captcha-refresh-btn {
    background: none;
    border: none;
    color: var(--main-color);
    cursor: pointer;
    font-size: 15px;
    padding: 2px;
    transition: 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
}

.captcha-refresh-btn:hover {
    transform: rotate(180deg) scale(1.1);
}

.reg-submit-btn {
    width: auto;
    min-width: 120px;
    background: var(--main-color);
    color: white;
    border: none;
    padding: 10px 30px;
    border-radius: 4px;
    font-size: 16px;
    font-weight: 700;
    font-family: 'Cairo', sans-serif;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 4px 12px rgba(8, 88, 89, 0.15);
    display: inline-block;
    float: right;
}

.reg-submit-btn:hover {
    background: var(--main-color);
    transform: translateY(-2px);
    box-shadow: 0 6px 15px rgba(13, 71, 72, 0.25);
}

/* التجاوب للهواتف والأجهزة اللوحية */
@media (max-width: 900px) {
    .register-container {
        justify-content: center;
        padding: 30px 20px;
        min-height: auto;
    }
    .register-form-card {
        max-width: 100%;
    }
}
@media (max-width: 600px) {
    .quick-register-section {
        padding: 30px 15px;
    }
}

/* ستايل كروت الأخبار المتطابقة مع صفحة الأخبار */
.news-page-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-bottom: 4px solid var(--accent-color);
    cursor: pointer;
}
.news-page-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.news-page-card .news-card-content {
    padding: 20px;
    transition: all 0.3s ease;
    background: white;
}
.news-page-card:hover .news-card-content {
    background: #f0f7f7;
}
.news-page-card:hover h3 {
    color: var(--main-color) !important;
}
.news-page-card .read-more-link {
    display: inline-block;
    color: var(--main-color);
    font-weight: bold;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.news-page-card:hover .read-more-link {
    color: var(--main-color) !important;
    transform: translateX(-5px);
}
.btn-back-to-home {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    gap: 10px !important;
    background: var(--main-color) !important;
    color: white !important;
    padding: 10px 30px !important;
    border-radius: 50px !important;
    text-decoration: none !important;
    font-size: 15px !important;
    font-weight: bold !important;
    box-shadow: 0 4px 15px rgba(13, 71, 72, 0.2) !important;
    transition: all 0.3s ease !important;
    font-family: 'Cairo', sans-serif !important;
    border: none !important;
    cursor: pointer !important;
    direction: rtl !important;
}
.btn-back-to-home:hover {
    background: rgb(189, 214, 60) !important;
    transform: translateY(-2px) !important;
    box-shadow: 0 6px 20px rgba(189, 214, 60, 0.3) !important;
    color: var(--main-color) !important;
}
.btn-back-to-home svg {
    width: 18px !important;
    height: 18px !important;
    display: inline-block !important;
    vertical-align: middle !important;
}
/* Navigation pill hover styles override */
.nav-pill-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    box-shadow: 0 6px 18px rgba(189, 214, 60, 0.3) !important;
}
.nav-pill-btn.home-pill:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
}

/* Breadcrumb Hover Styles */
.breadcrumb-home-link {
    color: var(--main-color) !important;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.breadcrumb-home-link:hover {
    color: var(--accent-color) !important;
    transform: scale(1.15);
}
.breadcrumb-slash {
    color: var(--main-color);
    font-size: 16px;
    font-weight: bold;
    margin: 0 4px;
    transition: color 0.3s ease;
    cursor: default;
}
.breadcrumb-slash:hover {
    color: var(--accent-color) !important;
}
.breadcrumb-current-page {
    color: var(--main-color);
    font-weight: bold;
    font-size: 15px;
    transition: color 0.3s ease;
    cursor: default;
}
.breadcrumb-current-page:hover {
    color: var(--accent-color) !important;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>

<body>

<?php
// ============================================================
// الصفحة الرئيسية (لزوار)
$layout_pages = [
    'home', 'about', 'president', 'vision', 'goals', 'strategy',
    'news', 'latest_news', 'students', 'research', 'library', 'jobs', 'contact', 'enroll', 'schedule', 'portal', 'grades', 'complaints', 'events', 'announcements_public', 'attendance_kiosk',
    // Majors
    'major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife',
    // Admin
    'quality', 'planning', 'students_affairs', 'finance', 'it',
    // Centers
    'medical_institute', 'community_college', 'training_center', 'community_services',
    // Branches
    'branch_damnah', 'branch_rahdah'
];
if (in_array($page, $layout_pages) && !$is_logged_in && $page != 'enroll'):
?>

<header>
    <div style="display: inline-flex; align-items: center; justify-content: center; width: <?php echo get_setting('logo_size', '140'); ?>px; height: <?php echo get_setting('logo_size', '140'); ?>px; border-radius: 12px; background: white; padding: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.15); margin-bottom: 15px; border: 3px solid var(--accent-color); overflow: hidden;">
        <img src="logo.png?v=4" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="شعار الكلية">
    </div>
    <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
    <p>نحو مستقبل علمي مشرق</p>
</header>

<!-- ===== شريط التنقل العلوي مع ترتيب مناسب ===== -->
<nav style="background:var(--dark-color);padding:0;">

    <!-- الصف الأول -->
    <div style="background:var(--dark-color);padding:8px 20px;border-bottom:1px solid rgba(255,255,255,0.1);">
        <div style="max-width:1200px;margin:auto;display:flex;flex-wrap:wrap;justify-content:space-between;align-items:center;">

            <!-- الجهة اليمنى: الروابط -->
          <div style="display:flex;flex-wrap:wrap;gap:15px;align-items:center;">
            
<a href="?p=news" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">الأخبار</a>
<a href="?p=students" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">شؤون الطلاب</a>
<a href="?p=research" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">الدراسات والبحوث</a>
<a href="?p=library" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">المكتبة</a>
<a href="?p=jobs" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">الوظائف</a>
<a href="?p=contact" style="color:#ddd;text-decoration:none;font-size:14px;transition:0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='#ddd'">اتصل بنا</a> 
            </div>

            <!-- الجهة اليسرى: التاريخ + الساعة + أزرار -->
            <div style="display:flex;flex-wrap:wrap;gap:10px;align-items:center;">

                <!-- التاريخ -->
                <span id="liveDate" style="color:var(--accent-color);font-size:13px;font-weight:bold;"></span>
                
                <span style="color:#555;">|</span>
                
                <!-- الساعة -->
                <span id="liveClock" style="color:var(--accent-color);font-size:13px;font-weight:bold;"></span>
                
                <span style="color:#555;">|</span>

                <!-- زر دخول (أزرق) -->
                <a href="?p=login" style="background:#1c7f7c;color:white;text-decoration:none;font-size:13px;font-weight:bold;padding:5px 16px;border-radius:20px;transition:0.3s;display:inline-flex;align-items:center;gap:5px;" 
                   onmouseover="this.style.background='#0056b3'" 
                   onmouseout="this.style.background='#1c7f7c'">
                    <i class="fa-solid fa-arrow-right-to-bracket" style="font-size:12px;"></i> دخول
                </a>

                <!-- زر خروج (أحمر) -->
                <a href="?logout=1" style="background:#dc3545;color:white;text-decoration:none;font-size:13px;font-weight:bold;padding:5px 16px;border-radius:20px;transition:0.3s;display:inline-flex;align-items:center;gap:5px;" 
                   onmouseover="this.style.background='var(--main-color)'" 
                   onmouseout="this.style.background='#dc3545'">
                    <i class="fa-solid fa-right-from-bracket" style="font-size:12px;"></i> خروج
                </a>

                <!-- زر English (ذهبي) -->
                <a href="#" style="background:var(--accent-color);color:var(--dark-color);text-decoration:none;font-size:13px;font-weight:bold;padding:5px 14px;border-radius:20px;transition:0.3s;display:inline-flex;align-items:center;gap:5px;" 
                   onmouseover="this.style.background='#fff';this.style.color='var(--dark-color)'" 
                   onmouseout="this.style.background='var(--accent-color)';this.style.color='var(--dark-color)'">
                    <i class="fa-solid fa-globe" style="font-size:12px;"></i> English
                </a>

            </div>

        </div>
    </div>

<!-- الصف الثاني مع القوائم المنسدلة (ذهبي ← أبيض عند التمرير) -->
<style>
/* تنسيق القوائم المنسدلة الأفقية الفاخرة (بجوار بعضها البعض ومحاذاة لليمين) */
.nav-dropdown {
    display: none;
    position: absolute;
    top: 100%;
    right: 0; /* محاذاة لليمين بالنسبة لزر القائمة الرئيسي */
    background: #fbf9f4 !important; /* خلفية سكري مائل للابيض */
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.15);
    padding: 15px;
    z-index: 1000;
    border: 2px solid var(--dark-color); /* إطار أزرق داكن كالتذليل */
    
    /* تخطيط مرن أفقي بجوار بعض */
    flex-direction: row;
    flex-wrap: nowrap; /* لا يسمح بالالتفاف لكي تظهر بجوار بعضها البعض صفاً واحداً */
    justify-content: flex-start; /* يبدأ من اليمين في اتجاه RTL */
    gap: 12px;
    align-items: center;
    direction: rtl; /* اتجاه من اليمين لليسار */
}

/* القائمة العريضة للتخصصات تمنع تجاوز الحدود وتلتف */
.nav-dropdown.majors-grid {
    flex-wrap: wrap !important;
    width: 560px; /* عرض مناسب لكي تترتب التخصصات بمربعات بجانب بعضها وتلتف */
}

/* محاذاة القوائم العريضة لتكون بكامل عرض الهيدر وتبدأ من اليمين */
.nav-dropdown.nav-dropdown-full {
    left: 0 !important;
    width: 100% !important;
    border-radius: 0 0 10px 10px; /* زوايا منحنية في الأسفل فقط لتكامل المظهر */
}

/* تنسيق كرت الرابط بداخل القائمة */
.dropdown-link {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 16px;
    color: #ddd !important; /* لون النص فاتح كالسابق */
    text-decoration: none;
    font-size: 14px;
    background: var(--dark-color) !important; /* خلفية كحلي داكن كالسابق */
    border: 1px solid rgba(255, 255, 255, 0.1) !important; /* إطار خفيف فاتح */
    border-radius: 6px;
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
    min-width: 165px;
    box-sizing: border-box;
    direction: rtl;
}

/* النص على اليمين */
.dropdown-link span {
    flex: 1;
    text-align: right;
    font-family: 'Cairo', sans-serif;
}

/* السهم الأنيق على اليسار في زاوية اليسار */
.dropdown-link i {
    font-family: Arial, sans-serif !important; /* استخدام خط قياسي مدعوم لضمان ظهور السهم بدون إنترنت */
    font-style: normal !important;
    font-size: 16px !important; /* حجم ممتاز للسهم */
    color: var(--accent-color); /* لون سهم ذهبي كالسابق */
    transition: all 0.3s ease;
    margin-right: 12px; /* مسافة أمان لكي يظهر السهم في زاوية اليسار */
    display: inline-block !important; /* ضمان الظهور */
    transform: none !important; /* التراجع عن أي تحويل افتراضي للخط */
}

/* تأثيرات الهوفر الجذابة للكرت */
.dropdown-link:hover {
    background: var(--accent-color) !important; /* خلفية ذهبية عند الهوفر */
    color: var(--dark-color) !important; /* نص كحلي داكن */
    border-color: var(--accent-color) !important;
    box-shadow: 0 4px 12px rgba(255, 215, 0, 0.25);
    transform: translateY(-2px);
}

/* تحويل السهم للون الداكن وتحريكه لليسار عند الهوفر ليعطي مظهراً جذاباً */
.dropdown-link:hover i {
    color: var(--dark-color) !important;
    transform: translateX(-5px) !important; /* إبقاء اتجاه اليسار مع التحريك يساراً */
}
</style>
<div style="background:var(--dark-color);padding:12px 20px;border-top:1px solid rgba(255,255,255,0.05);">
    <div style="max-width:1200px;margin:auto;display:flex;flex-wrap:wrap;justify-content:center;gap:20px;align-items:center;position:relative;">

        <!-- عن الكلية -->
        <div style="display:inline-block;">
            <a href="#" style="color:var(--accent-color);text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='var(--accent-color)';document.getElementById('dropdown-about').style.display='flex'" 
               onmouseout="this.style.color='var(--accent-color)';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-about').matches(':hover')){ document.getElementById('dropdown-about').style.display='none'; } }, 200);">
                عن الكلية <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-about" class="nav-dropdown nav-dropdown-full"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=about" class="dropdown-link"><span>نبذة عن الكلية</span><i>←</i></a>
                <a href="?p=president" class="dropdown-link"><span>عميد الكلية</span><i>←</i></a>
                <a href="?p=vision" class="dropdown-link"><span>الرؤية والرسالة</span><i>←</i></a>
                <a href="?p=goals" class="dropdown-link"><span>الأهداف والقيم</span><i>←</i></a>
                <a href="?p=strategy" class="dropdown-link"><span>الخطة الاستراتيجية</span><i>←</i></a>
            </div>
        </div>

        <!-- التخصصات -->
        <div style="position:relative;display:inline-block;">
            <a href="#" style="color:var(--accent-color);text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='var(--accent-color)';document.getElementById('dropdown-majors').style.display='flex'" 
               onmouseout="this.style.color='var(--accent-color)';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-majors').matches(':hover')){ document.getElementById('dropdown-majors').style.display='none'; } }, 200);">
                التخصصات <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-majors" class="nav-dropdown majors-grid"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=major_it" class="dropdown-link"><span>تقنية معلومات</span><i>←</i></a>
                <a href="?p=major_graphics" class="dropdown-link"><span>جرافيكس</span><i>←</i></a>
                <a href="?p=major_arch" class="dropdown-link"><span>هندسة معمارية</span><i>←</i></a>
                <a href="?p=major_accounting" class="dropdown-link"><span>محاسبة</span><i>←</i></a>
                <a href="?p=major_business" class="dropdown-link"><span>إدارة أعمال</span><i>←</i></a>
                <a href="?p=major_pharmacy" class="dropdown-link"><span>صيدلة</span><i>←</i></a>
                <a href="?p=major_assistant" class="dropdown-link"><span>مساعد طبيب</span><i>←</i></a>
                <a href="?p=major_dentist" class="dropdown-link"><span>مساعد طبيب أسنان</span><i>←</i></a>
                <a href="?p=major_midwife" class="dropdown-link"><span>قبالة وتوليد</span><i>←</i></a>
            </div>
        </div>

        <!-- إدارة الكلية -->
        <div style="display:inline-block;">
            <a href="#" style="color:var(--accent-color);text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='var(--accent-color)';document.getElementById('dropdown-admin').style.display='flex'" 
               onmouseout="this.style.color='var(--accent-color)';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-admin').matches(':hover')){ document.getElementById('dropdown-admin').style.display='none'; } }, 200);">
                إدارة الكلية <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-admin" class="nav-dropdown nav-dropdown-full"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=quality" class="dropdown-link"><span>مركز التطوير وضمان الجودة</span><i>←</i></a>
                <a href="?p=planning" class="dropdown-link"><span>إدارة التطوير والتخطيط الاستراتيجي</span><i>←</i></a>
                <a href="?p=students_affairs" class="dropdown-link"><span>إدارة شؤون الطلاب</span><i>←</i></a>
                <a href="?p=finance" class="dropdown-link"><span>إدارة الشئون المالية والإدارية</span><i>←</i></a>
                <a href="?p=it" class="dropdown-link"><span>إدارة تكنولوجيا المعلومات</span><i>←</i></a>
            </div>
        </div>

        <!-- المراكز -->
        <div style="display:inline-block;">
            <a href="#" style="color:var(--accent-color);text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='var(--accent-color)';document.getElementById('dropdown-centers').style.display='flex'" 
               onmouseout="this.style.color='var(--accent-color)';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-centers').matches(':hover')){ document.getElementById('dropdown-centers').style.display='none'; } }, 200);">
                المراكز <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-centers" class="nav-dropdown nav-dropdown-full"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=medical_institute" class="dropdown-link"><span>معهد الكلية للعلوم الطبية</span><i>←</i></a>
                <a href="?p=community_college" class="dropdown-link"><span>كلية سماء المتميزين (كلية مجتمع خاصة)</span><i>←</i></a>
                <a href="?p=training_center" class="dropdown-link"><span>مركز الكلية للتدريب والتأهيل الجامعي</span><i>←</i></a>
                <a href="?p=community_services" class="dropdown-link"><span>مراكز خدمات المجتمع</span><i>←</i></a>
            </div>
        </div>

        <!-- الفروع -->
        <div style="display:inline-block;">
            <a href="#" style="color:var(--accent-color);text-decoration:none;font-size:15px;font-weight:500;transition:0.3s;border-bottom:2px solid transparent;padding-bottom:4px;display:flex;align-items:center;gap:5px;" 
               onmouseover="this.style.color='white';this.style.borderBottomColor='var(--accent-color)';document.getElementById('dropdown-branches').style.display='flex'" 
               onmouseout="this.style.color='var(--accent-color)';this.style.borderBottomColor='transparent';setTimeout(function(){ if(!document.getElementById('dropdown-branches').matches(':hover')){ document.getElementById('dropdown-branches').style.display='none'; } }, 200);">
                الفروع <i class="fa-solid fa-chevron-down" style="font-size:10px;"></i>
            </a>
            <div id="dropdown-branches" class="nav-dropdown nav-dropdown-full"
                 onmouseover="this.style.display='flex'" onmouseout="this.style.display='none'">
                <a href="?p=branch_damnah" class="dropdown-link"><span>فرع دمنة خدير</span><i>←</i></a>
                <a href="?p=branch_rahdah" class="dropdown-link"><span>فرع الراهدة</span><i>←</i></a>
            </div>
        </div>
    </div>
</div>
</nav>
<?php
endif;

if ($page == 'home' && !$is_logged_in):
$slide1_title = get_setting('slide1_title', 'مؤسسة كلية سماء المتميزين') ?: 'مؤسسة كلية سماء المتميزين';
$slide1_text = get_setting('slide1_text', 'كلية سماء المتميزين هي مؤسسة تعليمية رائدة تسعى لبناء جيل مبدع ومتميز وتقديم برامج أكاديمية حديثة.') ?: 'كلية سماء المتميزين هي مؤسسة تعليمية رائدة تسعى لبناء جيل مبدع ومتميز وتقديم برامج أكاديمية حديثة.';
$slide1_image = get_setting('slide1_image', 'images/slider_campus.jpg?v=3') ?: 'images/slider_campus.jpg?v=3';

$slide2_title = get_setting('slide2_title', 'معامل تطبيقية حديثة ومجهزة بالكامل') ?: 'معامل تطبيقية حديثة ومجهزة بالكامل';
$slide2_text = get_setting('slide2_text', 'ندعم الدراسة النظرية بالتطبيق العملي لضمان الكفاءة والتميز') ?: 'ندعم الدراسة النظرية بالتطبيق العملي لضمان الكفاءة والتميز';
$slide2_image = get_setting('slide2_image', 'images/slider_vision.jpg?v=3') ?: 'images/slider_vision.jpg?v=3';

$slide3_title = get_setting('slide3_title', 'شهادات معتمدة ونخبة من أعضاء هيئة التدريس') ?: 'شهادات معتمدة ونخبة من أعضاء هيئة التدريس';
$slide3_text = get_setting('slide3_text', 'نضمن لك مستقبلاً مهنياً واعداً محلياً وإقليمياً') ?: 'نضمن لك مستقبلاً مهنياً واعداً محلياً وإقليمياً';
$slide3_image = get_setting('slide3_image', 'images/slider_mission.jpg?v=3') ?: 'images/slider_mission.jpg?v=3';
?>
<!-- ===== السلايدر ===== -->
<section class="slider">
<button class="prev" onclick="prevSlide()">❮</button>
<button class="next" onclick="nextSlide()">❯</button>
<div class="slider-img-wrap">
    <img id="sliderImage" src="<?php echo $slide1_image; ?>" alt="شعار الكلية">
</div>
<div class="slider-content">
<h2 id="title"><?php echo htmlspecialchars($slide1_title); ?></h2>
<p id="text"><?php echo htmlspecialchars($slide1_text); ?></p>
</div>
</section>

<div class="dots">
<span class="dot active" onclick="currentSlide(0)"></span>
<span class="dot" onclick="currentSlide(1)"></span>
<span class="dot" onclick="currentSlide(2)"></span>
</div>

<script>
var slides = [
    { title: <?php echo json_encode($slide1_title); ?>, text: <?php echo json_encode($slide1_text); ?>, image: <?php echo json_encode($slide1_image); ?> },
    { title: <?php echo json_encode($slide2_title); ?>, text: <?php echo json_encode($slide2_text); ?>, image: <?php echo json_encode($slide2_image); ?> },
    { title: <?php echo json_encode($slide3_title); ?>, text: <?php echo json_encode($slide3_text); ?>, image: <?php echo json_encode($slide3_image); ?> }
];
var currentSlideIndex = 0;

function showSlide(index) {
    if (index < 0) index = slides.length - 1;
    if (index >= slides.length) index = 0;
    currentSlideIndex = index;
    
    var img = document.getElementById('sliderImage');
    var title = document.getElementById('title');
    var text = document.getElementById('text');
    var dots = document.querySelectorAll('.dot');
    
    if (img) img.src = slides[currentSlideIndex].image;
    if (title) title.innerText = slides[currentSlideIndex].title;
    if (text) text.innerText = slides[currentSlideIndex].text;
    
    dots.forEach(function(dot, idx) {
        if (idx === currentSlideIndex) {
            dot.classList.add('active');
        } else {
            dot.classList.remove('active');
        }
    });
}

function nextSlide() {
    showSlide(currentSlideIndex + 1);
}

function prevSlide() {
    showSlide(currentSlideIndex - 1);
}

function currentSlide(index) {
    showSlide(index);
}

// Auto rotate every 5 seconds
var sliderInterval = setInterval(nextSlide, 5000);
</script>

<!-- ===== قسم الخدمات ===== -->
<section class="services">
<h2>وعطاء سماء المتميزين مستمر</h2>
<p>تقديم وتطوير البرامج التعليمية والأنشطة البحثية والخدمات التدريبية والاستشارية في مختلف المجالات</p>
<div class="services-boxes">
    <a href="?p=enroll" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>التسجيل (Online)</h3><p class="hover-text">اختر تخصصك، أكتب بياناتك، وقدم طلب التحاقك</p></a>
    <a href="?p=schedule" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--main-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>التقويم الجامعي</h3><p class="hover-text">التقويم الجامعي للعام الدراسي 2026</p></a>
    <a href="?p=portal" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>البوابة الإلكترونية</h3><p class="hover-text">البوابة الموحدة للطلاب والكادر التعليمي</p></a>
    <a href="?p=grades" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--main-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>نتائج الامتحانات</h3><p class="hover-text">الاطلاع على نتائج الامتحانات فور صدورها</p></a>
    <a href="?p=complaints" class="box"><div class="arrow">➜</div><h3><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="service-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>تقديم شكوى / مقترح</h3><p class="hover-text">شاركنا آراءك ومقترحاتك</p></a>
</div>
</section>

<!-- ===== المربعين ===== -->
<section class="quick-boxes">
    <a href="?p=events" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--main-color)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>فعاليات وأنشطة</h3><p class="hover-text">تابعوا أحدث الفعاليات والأنشطة الطلابية، الندوات العلمية، وورش العمل التدريبية التي تنظمها الكلية بشكل مستمر.</p></a>
    <a href="?p=announcements_public" class="quick"><h3><svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="quick-icon" style="vertical-align: middle; margin-left: 8px; transition: stroke 0.4s;"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path><path d="M13.73 21a2 2 0 0 1-3.46 0"></path></svg>إعلان هام</h3><p class="hover-text">اطلعوا على التنويهات الإدارية العاجلة، ومواعيد التسجيل والقبول، والقرارات الرسمية الصادرة من عمادة الكلية.</p></a>
</section>

<!-- ===== قسم سجل معنا التفاعلي الجديد ===== -->
<section class="quick-register-section">
    <div class="register-container">
        <!-- الجانب الأيسر: كرت التسجيل الفوري -->
        <div class="register-form-card">
            <h3>سجل معنا</h3>
            <p class="subtitle">ارسل بياناتك والتخصص الذي ترغب به</p>
            
            <form id="landing-register-form" onsubmit="submitQuickRegisterForm(event)">
                <!-- الاسم بالكامل -->
                <div class="reg-form-group">
                    <div class="reg-input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <input type="text" id="reg-name" class="reg-form-input" placeholder="الاسم بالكامل" required>
                    </div>
                </div>
                
                <!-- البريد الإلكتروني -->
                <div class="reg-form-group">
                    <div class="reg-input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <input type="email" id="reg-email" class="reg-form-input" placeholder="البريد الإلكتروني" required>
                    </div>
                </div>
                
                <!-- التلفون -->
                <div class="reg-form-group">
                    <div class="reg-input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"></rect><line x1="12" y1="18" x2="12.01" y2="18"></line></svg>
                        <input type="tel" id="reg-phone" class="reg-form-input" placeholder="التلفون" required>
                    </div>
                </div>
                
                <!-- التخصص المرغوب -->
                <div class="reg-form-group" style="position: relative;">
                    <div class="reg-input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>
                        <select id="reg-major" class="reg-form-select" required style="padding-left: 20px;">
                            <option value="" disabled selected>اختر التخصص</option>
                            <option value="تقنية المعلومات">تقنية المعلومات (IT)</option>
                            <option value="محاسبة">محاسبة</option>
                            <option value="إدارة أعمال">إدارة أعمال</option>
                            <option value="هندسة معمارية">هندسة معمارية</option>
                            <option value="قبالة وتوليد">قبالة وتوليد</option>
                            <option value="مساعد طبيب">مساعد طبيب</option>
                            <option value="صيدلة">صيدلة</option>
                        </select>
                        <span style="position: absolute; left: 0; top: 15px; color: #999; font-size: 10px; pointer-events: none;">▼</span>
                    </div>
                </div>
                
                <!-- كود التحقق -->
                <div class="reg-form-group">
                    <div class="reg-input-wrapper">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#777" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="reg-field-icon"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect><path d="M7 11V7a5 5 0 0 1 10 0v4"></path></svg>
                        <input type="text" id="reg-captcha" class="reg-form-input" style="border:none; outline:none; font-size:15px; text-align:right; flex-grow:1; margin-right:10px;" placeholder="كود التحقق" required>
                        <div style="display: flex; align-items: center; gap: 8px; margin-left: 5px; flex-shrink:0;">
                            <div id="quick-captcha-box" class="captcha-box" style="margin-bottom:0;">------</div>
                            <button type="button" class="captcha-refresh-btn" onclick="generateQuickCaptcha()" title="تحديث رمز التحقق">
                                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><polyline points="23 4 23 10 17 10"></polyline><path d="M20.49 15a9 9 0 1 1-2.12-9.36L23 10"></path></svg>
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- زر الارسال -->
                <div style="margin-top: 30px; display: flex; justify-content: flex-start; width: 100%;">
                    <button type="submit" class="reg-submit-btn">ارسال</button>
                </div>
            </form>
            <script>
            (function() {
                var quickCaptchaVal = '';
                window.generateQuickCaptcha = function() {
                    var chars = '0123456789';
                    var length = 6;
                    var code = '';
                    for (var i = 0; i < length; i++) {
                        code += chars[Math.floor(Math.random() * chars.length)];
                    }
                    quickCaptchaVal = code;
                    var box = document.getElementById('quick-captcha-box');
                    if (box) {
                        box.innerText = code;
                    }
                };

                window.submitQuickRegisterForm = function(event) {
                    event.preventDefault();
                    var captchaInput = document.getElementById('reg-captcha').value.trim();
                    if (captchaInput !== quickCaptchaVal) {
                        alert("❌ كود التحقق غير صحيح. يرجى المحاولة مرة أخرى.");
                        generateQuickCaptcha();
                        document.getElementById('reg-captcha').value = '';
                        return;
                    }
                    
                    var fullName = document.getElementById('reg-name').value;
                    var email = document.getElementById('reg-email').value;
                    var phone = document.getElementById('reg-phone').value;
                    var major = document.getElementById('reg-major').value;
                    
                    var modalHtml = '';
                    modalHtml += '<div id="quick-success-modal" style="position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); display: flex; justify-content: center; align-items: center; z-index: 99999; font-family: \'Cairo\', sans-serif;">';
                    modalHtml += '  <div style="background: white; padding: 40px 30px; border-radius: 20px; text-align: center; max-width: 450px; width: 90%; box-shadow: 0 10px 30px rgba(0,0,0,0.3); border-top: 5px solid #0d4748; direction: rtl;">';
                    modalHtml += '      <div style="width: 80px; height: 80px; background: #e6f4ea; border-radius: 50%; display: flex; justify-content: center; align-items: center; margin: 0 auto 20px;">';
                    modalHtml += '          <svg xmlns="http://www.w3.org/2000/svg" width="45" height="45" viewBox="0 0 24 24" fill="none" stroke="#137333" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><polyline points="20 6 9 17 4 12"></polyline></svg>';
                    modalHtml += '      </div>';
                    modalHtml += '      <h3 style="color: #0d4748; font-size: 24px; font-weight: 800; margin-bottom: 10px;">تم إرسال طلبك بنجاح!</h3>';
                    modalHtml += '      <p style="color: #555; font-size: 15px; line-height: 1.6; margin-bottom: 25px;">مرحباً بك يا <strong>' + fullName + '</strong>، لقد تم استلام رغبتك في دراسة تخصص <strong>' + major + '</strong>. سيتواصل معك مختص القبول والتسجيل قريباً عبر رقم الهاتف: ' + phone + ' لتأكيد خطوات التسجيل والقبول.</p>';
                    modalHtml += '      <button onclick="document.getElementById(\'quick-success-modal\').remove();" style="background: #0d4748; color: white; border: none; padding: 10px 30px; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: all 0.3s;" onmouseover="this.style.background=\'#1c7f7c\';" onmouseout="this.style.background=\'#0d4748\';">موافق</button>';
                    modalHtml += '  </div>';
                    modalHtml += '</div>';
                    
                    var div = document.createElement('div');
                    div.innerHTML = modalHtml;
                    document.body.appendChild(div.firstElementChild);
                    
                    document.getElementById('landing-register-form').reset();
                    generateQuickCaptcha();
                };

                // Initialize immediately since the HTML is already parsed
                generateQuickCaptcha();
            })();
            </script>
        </div>
    </div>
</section>

<!-- ===== التخصصات ===== -->
<section class="majors">
<h2>التخصصات المتاحة</h2>
<div class="major-grid">
    <a href="?p=major_it" class="major-box"><img src="images/hero_img1.png"><div><h3>تقنية المعلومات</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_accounting" class="major-box"><img src="images/hero_img2.png"><div><h3>محاسبة</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_business" class="major-box"><img src="images/img1.jpg"><div><h3>إدارة أعمال</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_arch" class="major-box"><img src="images/slider_mission.jpg"><div><h3>هندسة معمارية</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_midwife" class="major-box"><img src="images/slider_vision.jpg"><div><h3>قبالة وتوليد</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_assistant" class="major-box"><img src="images/news_launch.jpg"><div><h3>مساعد طبيب</h3><p>للمزيد من التفاصيل</p></div></a>
    <a href="?p=major_pharmacy" class="major-box"><img src="images/project_epilepsy_1.jpg"><div><h3>صيدلة</h3><p>للمزيد من التفاصيل</p></div></a>
</div>
</section>

<!-- ===== آخر الأخبار المطور كصفحة الأخبار تماماً ===== -->
<section class="homepage-news" style="padding: 60px 20px; background: #f8fafc; direction: rtl; border-top: 1px solid #eaeaea;">
    <!-- عنوان القسم متطابق تماماً مع صفحة الأخبار -->
    <div style="text-align:right; margin-bottom:30px; max-width:1100px; margin-left:auto; margin-right:auto;">
        <h1 style="color:var(--main-color);font-size:28px;margin-bottom:5px;border-bottom:3px solid var(--accent-color);padding-bottom:15px;display:inline-block; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">
            📰 آخر الأخبار
        </h1>
        <p style="color:#666;margin-top:10px;">آخر الأخبار في كلية سماء المتميزين</p>
    </div>
    
    <!-- شبكة كروت الأخبار (3 كروت متجاوبة متطابقة تماماً) -->
    <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(320px,1fr)); gap:25px; max-width:1100px; margin: 0 auto 40px;">
        <?php
        $home_latest_news = array_slice($latest_news_items, 0, 3, true);
        foreach ($home_latest_news as $news_id => $item):
            $js_data = htmlspecialchars(json_encode(array_merge($item, ['id' => $news_id])), ENT_QUOTES, 'UTF-8');
        ?>
            <div class="news-page-card" onclick="openLatestNewsModal(<?php echo $js_data; ?>)">
                <?php if (isset($item['images']) && is_array($item['images']) && count($item['images']) > 0): ?>
                    <div style="height:200px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f0f2f5;">
                        <img src="<?php echo $item['images'][0]; ?>" alt="<?php echo $item['title']; ?>" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                <?php elseif (isset($item['image']) && !empty($item['image'])): ?>
                    <div style="height:200px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f0f2f5;">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                <?php else: ?>
                    <div style="height:200px;background:<?php echo $item['gradient']; ?>;display:flex;align-items:center;justify-content:center;color:white;font-size:50px;">
                        <?php echo $item['icon']; ?>
                    </div>
                <?php endif; ?>
                <div class="news-card-content">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                        <span style="color:var(--accent-color);font-size:12px;font-weight:bold;background:var(--accent-color)20;padding:3px 12px;border-radius:20px;"><?php echo $item['badge']; ?></span>
                        <span style="color:#999;font-size:12px;">📅 <?php echo $item['date']; ?></span>
                    </div>
                    <h3 style="color:var(--main-color);font-size:17px;margin-bottom:10px;line-height:1.6;transition: color 0.3s ease; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;"><?php echo $item['title']; ?></h3>
                    <p style="color:#555;font-size:14px;line-height:1.7;margin-bottom:15px; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;"><?php echo $item['summary']; ?></p>
                    <a href="javascript:void(0)" onclick="event.stopPropagation(); openLatestNewsModal(<?php echo $js_data; ?>)" class="read-more-link">المزيد ←</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- زر عرض الكل بالأسفل على اليسار -->
    <div style="max-width: 1100px; margin: 0 auto; display: flex; justify-content: flex-end;">
        <a href="?p=latest_news" style="background: var(--main-color); color: white; padding: 10px 25px; border-radius: 4px; text-decoration: none; font-weight: bold; font-size: 15px; transition: 0.3s; box-shadow: 0 4px 10px rgba(8, 88, 89,0.2); font-family: Tahoma, 'Segoe UI', Arial, sans-serif;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='var(--main-color)'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='var(--main-color)'; this.style.color='white'; this.style.transform='none'">عرض الكل</a>
    </div>
</section>

<!-- ===== قسم إحصائيات الكلية ===== -->
<section style="background-color: rgb(189, 214, 60); color: var(--main-color); padding: 75px 4% 95px 4%; direction: rtl; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
        
        <!-- الجزء العلوي: النص والعناوين -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 40px; margin-bottom: 60px;">
            <!-- العناوين (على اليمين) -->
            <div style="flex: 1; min-width: 300px; text-align: right;">
                <span style="color: rgba(13, 71, 72, 0.7); font-size: 15px; font-weight: bold; display: block; margin-bottom: 12px; font-family: Tahoma, 'Segoe UI', Arial, sans-serif; letter-spacing: 0.5px;">إحصائيات الكلية</span>
                <h2 style="color: var(--main-color); font-size: 35px; font-weight: bold; margin: 0; line-height: 1.2; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">كلية سماء المتميزين</h2>
            </div>
            
            <!-- الوصف (على اليسار) -->
            <div style="flex: 1.8; min-width: 350px;">
                <p style="color: rgba(13, 71, 72, 0.9); font-size: 15px; line-height: 1.8; margin: 0; text-align: justify; font-family: Tahoma, 'Segoe UI', Arial, sans-serif; font-weight: 500;">
                    كلية سماء المتميزين للعلوم الصحية والتكنولوجيا هي مؤسسة تعليمية رائدة مرخصة رسمياً من الجهات المختصة. بدأت الكلية مسيرتها في تقديم البرامج الطبية والتقنية المتميزة لتأهيل الطلاب وإعدادهم لسوق العمل بأعلى مستويات الجودة والكفاءة الأكاديمية والتدريب العملي في مختلف التخصصات الطبية والصحية والتقنية.
                </p>
            </div>
        </div>
        
        <!-- الجزء السفلي: شبكة الإحصائيات (موزعة بمسافات متناسقة ومحاذاة مركزية لكل عنصر) -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px; margin-top: 30px;">
            <!-- بطاقة 1 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">12</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">برنامج أكاديمي</span>
            </div>
            <!-- بطاقة 2 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">2</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">فرع</span>
            </div>
            <!-- بطاقة 3 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">3500</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">خريج</span>
            </div>
            <!-- بطاقة 4 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">5</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, 'Segoe UI', Arial, sans-serif;">مبنى</span>
            </div>
        </div>
        
    </div>
</section>
<?php
endif;

// Render subpages inside the layout if we are on one of the layout pages
if (in_array($page, $layout_pages) && !$is_logged_in):
    // Render breadcrumbs if not on home page
    if ($page != 'home' && $page != 'enroll'):
        $current_title = isset($page_titles[$page]) ? $page_titles[$page] : '';
?>
<div class="breadcrumb-container" style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: 'Cairo', sans-serif; direction: rtl; justify-content: flex-start;">
        <a href="?p=home" class="breadcrumb-home-link" title="الرئيسية">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        </a>
        <span class="breadcrumb-slash">/</span>
        <span class="breadcrumb-current-page">
            <?php echo $current_title; ?>
        </span>
    </div>
</div>
<?php
    endif; // Closes if ($page != 'home' && $page != 'enroll')

    // Render section banner / dropdown menu if the page is in one of the categories
    $about_pages = ['about', 'president', 'vision', 'goals', 'strategy'];
    $major_pages = ['major_it', 'major_graphics', 'major_arch', 'major_accounting', 'major_business', 'major_pharmacy', 'major_assistant', 'major_dentist', 'major_midwife'];
    $admin_pages = ['quality', 'planning', 'students_affairs', 'finance', 'it'];
    $center_pages = ['medical_institute', 'community_college', 'training_center', 'community_services'];
    $branch_pages = ['branch_damnah', 'branch_rahdah'];

    $banner_title = '';
    $links = [];
    if (in_array($page, $about_pages)) {
        $banner_title = 'من نحن';
        $links = [
            'about' => 'نبذة عن الكلية',
            'president' => 'عميد الكلية',
            'vision' => 'الرؤية والرسالة',
            'goals' => 'الأهداف والقيم',
            'strategy' => 'الخطة الاستراتيجية'
        ];
    } elseif (in_array($page, $major_pages)) {
        $banner_title = 'التخصصات';
        $links = [
            'major_it' => 'تقنية معلومات',
            'major_graphics' => 'جرافيكس',
            'major_arch' => 'هندسة معمارية',
            'major_accounting' => 'محاسبة',
            'major_business' => 'إدارة أعمال',
            'major_pharmacy' => 'صيدلة',
            'major_assistant' => 'مساعد طبيب',
            'major_dentist' => 'مساعد طبيب أسنان',
            'major_midwife' => 'قبالة وتوليد'
        ];
    } elseif (in_array($page, $admin_pages)) {
        $banner_title = 'إدارة الكلية';
        $links = [
            'quality' => 'مركز التطوير وضمان الجودة',
            'planning' => 'إدارة التطوير والتخطيط الاستراتيجي',
            'students_affairs' => 'إدارة شؤون الطلاب',
            'finance' => 'إدارة الشئون المالية والإدارية',
            'it' => 'إدارة تكنولوجيا المعلومات'
        ];
    } elseif (in_array($page, $center_pages)) {
        $banner_title = 'المراكز';
        $links = [
            'medical_institute' => 'معهد الكلية للعلوم الطبية',
            'community_college' => 'كلية سماء المتميزين',
            'training_center' => 'مركز الكلية للتدريب والتأهيل الجامعي',
            'community_services' => 'مراكز خدمات المجتمع'
        ];
    } elseif (in_array($page, $branch_pages)) {
        $banner_title = 'الفروع';
        $links = [
            'branch_damnah' => 'فرع دمنة خدير',
            'branch_rahdah' => 'فرع الراهدة'
        ];
    }

    if (!empty($banner_title)):
?>
<div class="subpage-dropdown-banner" style="background:#f4f6f9; padding: 20px 20px 0;">
    <div style="max-width:900px; margin:auto; display:flex; justify-content:flex-end;">
        <div style="position:relative; width:180px;">
            <!-- Banner button -->
            <div onclick="toggleBannerMenu()" style="width:100%; background:var(--main-color); color:white; display:flex; align-items:center; justify-content:space-between; padding:10px 14px; border-left:4px solid var(--main-color); direction:rtl; font-family:'Cairo', sans-serif; border-radius:4px; box-shadow:0 4px 10px rgba(0,0,0,0.1); cursor:pointer; user-select:none;">
                <span style="font-size:15px; font-weight:bold; color:white;"><?php echo $banner_title; ?></span>
                <span id="bannerMenuIcon" style="font-size:16px; color:white; user-select:none; display:inline-block; transition:transform 0.2s ease;">☰</span>
            </div>
            
            <!-- Dropdown Menu -->
            <div id="bannerDropdownMenu" style="display:none; position:absolute; top:100%; right:0; width:100%; background:white; border-radius:4px; border:1px solid #eaeaea; box-shadow:0 8px 25px rgba(0,0,0,0.15); z-index:1000; margin-top:5px; direction:rtl; font-family:'Cairo', sans-serif; overflow:hidden;">
                <?php foreach ($links as $link_page => $link_title): 
                    $is_current = ($page == $link_page);
                ?>
                    <a href="?p=<?php echo $link_page; ?>" style="display:block; padding:10px 15px; text-decoration:none; color:<?php echo $is_current ? 'var(--main-color)' : '#333'; ?>; font-size:14px; font-weight:<?php echo $is_current ? 'bold' : 'normal'; ?>; border-bottom:1px solid #f0f0f0; transition:all 0.2s ease; background:<?php echo $is_current ? '#f0f7f7' : 'transparent'; ?>;"
                       onmouseover="this.style.background='#f4f6f9'; this.style.color='var(--main-color)';"
                       onmouseout="this.style.background='<?php echo $is_current ? '#f0f7f7' : 'transparent'; ?>'; this.style.color='<?php echo $is_current ? 'var(--main-color)' : '#333'; ?>';">
                        <?php echo $link_title; ?>
                    </a>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<script>
function toggleBannerMenu() {
    var menu = document.getElementById('bannerDropdownMenu');
    var icon = document.getElementById('bannerMenuIcon');
    if (menu && icon) {
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'block';
            icon.innerHTML = '✖';
            icon.style.transform = 'rotate(90deg)';
        } else {
            menu.style.display = 'none';
            icon.innerHTML = '☰';
            icon.style.transform = 'none';
        }
    }
}
window.addEventListener('click', function(e) {
    var menu = document.getElementById('bannerDropdownMenu');
    var icon = document.getElementById('bannerMenuIcon');
    if (menu && menu.style.display === 'block') {
        var clickedInside = e.target.closest('[onclick="toggleBannerMenu()"]') || e.target.closest('#bannerDropdownMenu');
        if (!clickedInside) {
            menu.style.display = 'none';
            if (icon) {
                icon.innerHTML = '☰';
                icon.style.transform = 'none';
            }
        }
    }
});
</script>
<?php
    endif;

    // Generic check for custom database page content
    $db_page_check = mysqli_query($conn, "SELECT page_content FROM site_pages WHERE page_key = '" . mysqli_real_escape_string($conn, $page) . "'");
    $db_page = $db_page_check ? mysqli_fetch_assoc($db_page_check) : null;
    
    $db_page_rendered = false;
    if ($db_page && !empty(trim($db_page['page_content']))):
        $db_page_rendered = true;
?>
        <div style="background:white; padding:40px; border-radius:20px; box-shadow:0 10px 40px rgba(0,0,0,0.05); direction:rtl; text-align:right; font-family:'Cairo', sans-serif; border-top: 5px solid var(--main-color); margin-top:20px; margin-bottom: 20px;">
            <h2 style="color:var(--main-color); margin-bottom:20px; font-weight:bold;"><?php echo htmlspecialchars($page_titles[$page] ?? 'محتوى الصفحة'); ?></h2>
            <div style="line-height:2; font-size:16px; color:#333; text-align:justify;"><?php echo $db_page['page_content']; ?></div>
            <div style="margin-top: 30px; border-top: 1px solid #eee; padding-top: 20px; text-align: center;">
                <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            </div>
        </div>
<?php
    endif;

    // Page switcher block starts
    if (!$db_page_rendered):
        if ($page == 'about'):
        include 'pages/about.php';
    elseif ($page == 'president'):
        include 'pages/president.php';
    elseif ($page == 'vision'):
        include 'pages/vision.php';
    elseif ($page == 'goals'):
        include 'pages/goals.php';
    elseif ($page == 'strategy'):
        include 'pages/strategy.php';
    elseif ($page == 'news'):
        include 'pages/news.php';
    elseif ($page == 'latest_news'):
        include 'pages/latest_news.php';
    elseif ($page == 'students'):
        include 'pages/students.php';
    elseif ($page == 'research'):
        include 'pages/research.php';
    elseif ($page == 'library'):
        include 'pages/library.php';
    elseif ($page == 'jobs'):
        include 'pages/jobs.php';
    elseif ($page == 'contact'):
        include 'pages/contact.php';
    elseif ($page == 'complaints'):
        include 'pages/complaints.php';
    elseif ($page == 'events'):
        include 'pages/events.php';
    elseif ($page == 'announcements_public'):
        include 'pages/announcements_public.php';
    elseif ($page == 'quality'):
        include 'pages/quality.php';
    elseif ($page == 'planning'):
        include 'pages/planning.php';
    elseif ($page == 'students_affairs'):
        include 'pages/students_affairs.php';
    elseif ($page == 'finance'):
        include 'pages/finance.php';
    elseif ($page == 'it'):
        include 'pages/it.php';
    elseif (in_array($page, $major_pages)):
        include 'pages/major.php';
    elseif (in_array($page, $admin_pages)):
?>
<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;">
    <div style="max-width:900px;margin:auto;background:white;border-radius:20px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
        <h1 style="color:var(--main-color);border-bottom:3px solid var(--accent-color);padding-bottom:15px;">🏢 <?php echo $current_title; ?></h1>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">تختص هذه الإدارة بالإشراف على سير العملية التعليمية والإدارية وتقديم أفضل الخدمات لطلبة الكلية ومنتسبيها في إطار <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نسعى جاهدين للتطوير المستمر وتطبيق معايير الجودة والشفافية لتحقيق التميز المؤسسي والأكاديمي.</p>
        <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>
</div>
<?php
    elseif ($page == 'medical_institute'):
        include 'pages/medical_institute.php';
    elseif ($page == 'community_college'):
        include 'pages/community_college.php';
    elseif ($page == 'training_center'):
        include 'pages/training_center.php';
    elseif ($page == 'community_services'):
        include 'pages/community_services.php';
    elseif ($page == 'branch_damnah'):
        include 'pages/branch_damnah.php';
    elseif ($page == 'branch_rahdah'):
        include 'pages/branch_rahdah.php';
    elseif (in_array($page, $center_pages)):
?>
<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;">
    <div style="max-width:900px;margin:auto;background:white;border-radius:20px;padding:40px;box-shadow:0 4px 20px rgba(0,0,0,0.1);">
        <h1 style="color:var(--main-color);border-bottom:3px solid var(--accent-color);padding-bottom:15px;">🔬 <?php echo $current_title; ?></h1>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:20px;">يقدم هذا المركز خدمات تدريبية وتعليمية واستشارية متخصصة لرفع كفاءة المجتمع المحلي وتلبية احتياجات التنمية المستدامة من خلال <?php echo $current_title; ?>.</p>
        <p style="line-height:2;font-size:17px;color:#444;margin-top:10px;">نوفر بيئة تدريبية مجهزة بأحدث التقنيات وبإشراف نخبة من الخبراء والأكاديميين المتخصصين.</p>
        <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>
</div>
<?php
    elseif ($page == 'schedule'):
        include 'pages/academic_calendar.php';
    elseif ($page == 'portal'):
        include 'pages/portal.php';
    elseif ($page == 'attendance_kiosk'):
        include 'pages/attendance_kiosk.php';
    elseif ($page == 'grades'):
        include 'pages/public_grades_query.php';
    elseif ($page == 'enroll'):
?>
<div style="min-height:100vh;background:#f4f6f9;padding:40px 20px;font-family:'Cairo', sans-serif;">
    <!-- مودال النجاح بعد التسجيل (موضوع خارج حاويات الخطوات لضمان ظهوره دائماً) -->
    <div id="successModal" style="display: none; position: fixed; z-index: 99999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.6); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
        <div style="background-color: white; margin: auto; padding: 40px 30px; border-radius: 12px; box-shadow: 0 15px 40px rgba(0,0,0,0.15); width: 100%; max-width: 650px; text-align: center; font-family: 'Cairo', sans-serif; box-sizing: border-box; border: 1px solid #eaeaea;">
            <!-- علامة الصح الخضراء الدائرية المتناسقة مع الصورة -->
            <div style="display: flex; justify-content: center; margin-bottom: 20px;">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#2ebb59" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="width: 75px; height: 75px;">
                    <circle cx="12" cy="12" r="10" fill="#eefaf2"></circle>
                    <polyline points="16 9 11 14 8 11"></polyline>
                </svg>
            </div>
            
            <!-- عنوان النجاح -->
            <h2 style="margin: 0 0 15px 0; font-size: 24px; font-weight: bold; color: #111;">نجاح!</h2>
            
            <!-- نص الرسالة الموحد تماماً كما بالصورة -->
            <p style="font-size: 15px; color: #7f8c8d; line-height: 1.8; margin-bottom: 30px; padding: 0 10px; font-weight: 500;">
                تم التسجيل بنجاح .. الرجاء ايداع رسوم التسجيل (شامل البطاقة + الانشطة) مبلغ 30,000 ر.ي لحساب الجامعة 3053343518 طرف بنك الكريمي للتمويل الأصغر الإسلامي
            </p>
            
            <!-- أزرار التحكم -->
            <div style="display: flex; justify-content: center; gap: 15px; direction: rtl;">
                <!-- زر طباعة باللون الأخضر -->
                <button type="button" onclick="triggerReceiptPrint()" style="padding: 10px 40px; background-color: #008000; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.2s;" onmouseover="this.style.backgroundColor='#006400'" onmouseout="this.style.backgroundColor='#008000'">طباعة</button>
                <!-- زر إغلاق باللون الأحمر المفرغ -->
                <button type="button" onclick="closeSuccessModal()" style="padding: 10px 40px; background-color: white; color: #ff0000; border: 1.5px solid #ff0000; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: all 0.2s;" onmouseover="this.style.backgroundColor='#ffebee'" onmouseout="this.style.backgroundColor='white'">إغلاق</button>
            </div>
        </div>
    </div>

<?php if (isset($show_success_modal) && $show_success_modal): ?>
<script>
var successStudentData = {
    studentId: "<?php echo addslashes($student_id); ?>",
    fullName: "<?php echo addslashes($full_name); ?>",
    englishName: "<?php echo addslashes($english_name); ?>",
    email: "<?php echo addslashes($email); ?>",
    phone: "<?php echo addslashes($phone); ?>",
    whatsapp: "<?php echo addslashes($whatsapp); ?>",
    parentPhone: "<?php echo addslashes($parent_phone); ?>",
    address: "<?php echo addslashes($address); ?>",
    gender: "<?php echo addslashes($gender); ?>",
    birthDate: "<?php echo addslashes($birth_date); ?>",
    birthPlace: "<?php echo addslashes($birth_place); ?>",
    nationality: "<?php echo addslashes($nationality); ?>",
    qualificationType: "<?php echo addslashes($qualification_type); ?>",
    schoolName: "<?php echo addslashes($school_name); ?>",
    graduationYear: "<?php echo addslashes($graduation_year); ?>",
    totalMarks: "<?php echo addslashes($total_marks); ?>",
    highSchoolPercentage: "<?php echo addslashes($high_school_percentage); ?>",
    seatNumber: "<?php echo addslashes($seat_number); ?>",
    identityType: "<?php echo addslashes($identity_type); ?>",
    identityNumber: "<?php echo addslashes($identity_number); ?>",
    identityPlace: "<?php echo addslashes($identity_place); ?>",
    identityIssueDate: "<?php echo addslashes($identity_issue_date); ?>",
    collegeName: "<?php echo addslashes($college_name); ?>",
    department: "<?php echo addslashes($department); ?>",
    branch: "<?php echo addslashes($branch); ?>"
};
document.addEventListener("DOMContentLoaded", function() {
    openSuccessModal();
});
</script>
<?php endif; ?>

    <form method="POST" id="enrollForm" enctype="multipart/form-data" onsubmit="return validateStep4OnSubmit()">

    <!-- الحاوية الأولى: اختيار التخصص والفرع (المظهر الأصلي بالكامل) -->
        <div id="enrollStep1Container" style="max-width:650px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.1);overflow:hidden;border: 1px solid #e2e8f0; display: block;">
            <!-- البنر العلوي الفاخر الأصلي للكلية -->
            <div style="background: linear-gradient(135deg, var(--main-color), var(--main-color)); color: white; padding: 25px 25px; position: relative; display: flex; align-items: center; justify-content: space-between; border-bottom: 5px solid var(--accent-color); direction: rtl;">
                <div style="flex: 1; text-align: right; padding-left: 15px;">
                    <div style="background: var(--accent-color); color: var(--main-color); display: inline-block; padding: 4px 12px; border-radius: 4px; font-size: 11px; font-weight: bold; margin-bottom: 8px; font-family:'Cairo', sans-serif;">التسجيل مفتوح في كافة التخصصات</div>
                    <h2 style="margin: 0; font-size: 22px; font-weight: bold; line-height: 1.4; color: white;">كلية سماء المتميزين</h2>
                    <div style="font-size: 13px; opacity: 0.9; margin-top: 2px;">للعلوم الصحية والتكنولوجيا</div>
                    <div style="display: flex; gap: 15px; margin-top: 15px; font-size: 12px; opacity: 0.8; flex-wrap: wrap;">
                        <span>🌐 www.sama.edu.ye</span>
                    </div>
                </div>
                <div style="display: flex; flex-direction: column; align-items: center; gap: 5px;">
                    <div style="width: 85px; height: 85px; border-radius: 50%; background: white; padding: 6px; display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 12px rgba(0,0,0,0.15); border: 2.5px solid var(--accent-color);">
                        <img src="logo.png?v=4" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="شعار الكلية">
                    </div>
                    <span style="color: var(--accent-color); font-size: 11px; font-weight: bold; margin-top: 3px;">التميز والريادة</span>
                </div>
            </div>

            <div style="padding: 40px;">
                <?php echo $enroll_message; ?>
                
                <div id="step1">
                    <!-- اختيار الفرع -->
                    <div style="margin-bottom: 25px; text-align: right; direction: rtl;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 15px;">الفرع :</label>
                        <select id="branchSelect" name="branch" required style="width: 100%; padding: 14px 20px; border: 1.5px solid var(--main-color); border-radius: 30px; font-size: 15px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; transition: all 0.3s; box-sizing: border-box;" onchange="updateColleges(); validateStep1();">
                            <option value="">اختر الفرع</option>
                            <option value="المركز الرئيسي - دمنة خدير" <?php echo (isset($_POST['branch']) && $_POST['branch'] == 'المركز الرئيسي - دمنة خدير') ? 'selected' : ''; ?>>المركز الرئيسي - دمنة خدير</option>
                            <option value="فرع الراهدة" <?php echo (isset($_POST['branch']) && $_POST['branch'] == 'فرع الراهدة') ? 'selected' : ''; ?>>فرع الراهدة</option>
                        </select>
                    </div>

                    <!-- اختيار القسم -->
                    <div style="margin-bottom: 25px; text-align: right; direction: rtl;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 15px;">القسم :</label>
                        <select id="collegeSelect" name="college" required disabled style="width: 100%; padding: 14px 20px; border: 1.5px solid var(--main-color); border-radius: 30px; font-size: 15px; font-family: 'Cairo', sans-serif; background: #eee; cursor: not-allowed; transition: all 0.3s; box-sizing: border-box;" onchange="updateDepartments(); validateStep1();">
                            <option value="">اختر القسم</option>
                        </select>
                    </div>

                    <!-- اختيار التخصص -->
                    <div style="margin-bottom: 30px; text-align: right; direction: rtl;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #333; font-size: 15px;">التخصص :</label>
                        <select id="departmentSelect" name="department" required disabled style="width: 100%; padding: 14px 20px; border: 1.5px solid var(--main-color); border-radius: 30px; font-size: 15px; font-family: 'Cairo', sans-serif; background: #eee; cursor: not-allowed; transition: all 0.3s; box-sizing: border-box;" onchange="validateStep1()">
                            <option value="">اختر التخصص</option>
                        </select>
                    </div>

                    <!-- زر التالي -->
                    <div style="display: flex; justify-content: flex-end; margin-top: 30px; direction: ltr;">
                        <button type="button" id="nextBtn" disabled onclick="goToStep(2)" style="padding: 12px 35px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي ←</button>
                    </div>
                </div>
                <div style="text-align:center;margin-top:25px;"><a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a></div>
            </div>
        </div>

        <!-- الحاوية الثانية: معالج خطوات البيانات الشخصية والتعليمية والهوية (مظهر الاستمارة الرسمية) -->
        <div id="enrollWizardContainer" style="max-width:850px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 40px rgba(0,0,0,0.06);overflow:hidden;border: 1px solid #e2e8f0; padding: 30px; display: none;">
            
            <!-- البنر التعليمي العنابي الموضح بالصورة -->
            <div style="background: var(--main-color); color: white; padding: 22px 15px; border-radius: 12px; font-weight: bold; font-size: 16px; text-align: center; margin-bottom: 25px; box-shadow: 0 4px 15px rgba(8, 88, 89, 0.15); line-height: 1.6; direction: rtl;">
                قم بتعبئة كافة البيانات المطلوبة كما ورد بالنص في إستمارة الثانوية العامة
            </div>

            <!-- مؤشر تبويبات الاستمارة العلوي (مظهر تفاعلي للون فقط ولا ينتقل عند النقر) -->
            <div style="display: flex; justify-content: space-around; padding: 10px 20px; margin-bottom: 15px; direction: rtl;">
                <span id="tabStep2" class="step-indicator-tab">البيانات الشخصية</span>
                <span id="tabStep3" class="step-indicator-tab">بيانات المؤهل السابق</span>
                <span id="tabStep4" class="step-indicator-tab">بيانات الهوية</span>
            </div>

            <!-- الوعاء الداخلي الفاتح ذو الزوايا المستديرة والإطار الخفيف المماثل للصورة -->
            <div style="border: 1.5px solid #e0e0e0; border-radius: 20px; padding: 30px; background: #fafafa; box-shadow: 0 4px 20px rgba(0,0,0,0.01);">
                <?php echo $enroll_message; ?>
                
                <!-- عنوان الخطوة التفاعلي -->
                <h3 id="wizardStepTitle" style="color: #7d6b6b; text-align: right; margin-top: 0; margin-bottom: 30px; font-weight: bold; font-size: 22px; direction: rtl; text-shadow: 0 1px 1px rgba(0,0,0,0.05);">البيانات الشخصية</h3>

            <!-- الخطوة الثانية: البيانات الشخصية -->
            <div id="step2" style="display: none;">

                <!-- صف 1: الاسم العربي والاسم الإنجليزي -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الأسم العربي</label>
                        <input type="text" id="fullName" name="full_name" required placeholder="الأسم الرباعي باللغة العربية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()" onblur="showFullNameError()">
                        <span id="fullNameError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب كتابة الاسم الرباعي كاملاً باللغة العربية</span>
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الأسم الإنجليزي</label>
                        <input type="text" id="englishName" name="english_name" required placeholder="الأسم باللغة الإنجليزية ......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="this.value = this.value.replace(/[^a-zA-Z\s.-]/g, ''); validateStep2();">
                        <span id="englishNameError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب كتابة الاسم باللغة الإنجليزية فقط</span>
                    </div>
                </div>

                <!-- صف 2: الجنس والجنسية -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl; align-items: center;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الجنس</label>
                        <div style="display: flex; gap: 25px; align-items: center; padding: 8px 5px; direction: rtl;">
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; color: #4a4a4a; font-weight: bold;">
                                <span>ذكر</span>
                                <input type="radio" name="gender" value="ذكر" required style="width: 18px; height: 18px; accent-color: var(--main-color); cursor: pointer;" onchange="validateStep2()">
                            </label>
                            <label style="display: flex; align-items: center; gap: 8px; cursor: pointer; font-size: 14px; color: #4a4a4a; font-weight: bold;">
                                <span>أنثى</span>
                                <input type="radio" name="gender" value="أنثى" style="width: 18px; height: 18px; accent-color: var(--main-color); cursor: pointer;" onchange="validateStep2()">
                            </label>
                        </div>
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">الجنسية</label>
                        <select id="nationality" name="nationality" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep2()">
                            <option value="">اختر الجنسية</option>
                            <option value="يمني">يمني</option>
                            <option value="سعودي">سعودي</option>
                            <option value="مصري">مصري</option>
                            <option value="سوداني">سوداني</option>
                            <option value="جيبوتي">جيبوتي</option>
                            <option value="صومالي">صومالي</option>
                            <option value="آخر">آخر</option>
                        </select>
                    </div>
                </div>

                <!-- صف 3: مكان الميلاد وتاريخ الميلاد -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">مكان الميلاد</label>
                        <select id="birthPlace" name="birth_place" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep2()">
                            <option value="">اختر مكان الميلاد......</option>
                            <option value="تعز">تعز</option>
                            <option value="إب">إب</option>
                            <option value="صنعاء">صنعاء (الأمانة)</option>
                            <option value="محافظة صنعاء">محافظة صنعاء</option>
                            <option value="عدن">عدن</option>
                            <option value="الحديدة">الحديدة</option>
                            <option value="حضرموت">حضرموت</option>
                            <option value="لحج">لحج</option>
                            <option value="أبين">أبين</option>
                            <option value="الضالع">الضالع</option>
                            <option value="عمران">عمران</option>
                            <option value="ذمار">ذمار</option>
                            <option value="حجة">حجة</option>
                            <option value="البيضاء">البيضاء</option>
                            <option value="صعدة">صعدة</option>
                            <option value="الجوف">الجوف</option>
                            <option value="مأرب">مأرب</option>
                            <option value="شبوة">شبوة</option>
                            <option value="ريمة">ريمة</option>
                            <option value="المحويت">المحويت</option>
                            <option value="المهرة">المهرة</option>
                            <option value="سقطرى">سقطرى</option>
                            <option value="خارج اليمن">خارج اليمن</option>
                        </select>
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">تاريخ الميلاد</label>
                        <input type="date" id="birthDate" name="birth_date" required placeholder="قس/رهش/موي" style="width: 100%; padding: 10px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" onchange="validateStep2()">
                    </div>
                </div>

                <!-- صف 4: العنوان الحالي وجوال الطالب -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl; align-items: center;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">العنوان الحالي</label>
                        <input type="text" id="address" name="address" required placeholder="يرجى إدخال عنوانك الحالي بشكل صحيح......" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep2()">
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">جوال الطالب</label>
                        <div style="display: flex; border: 1.5px solid #e0e0e0; border-radius: 15px; overflow: hidden; background: #fff; box-sizing: border-box;">
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: var(--main-color); font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="phone" name="phone" required placeholder="الجوال الخاص بالطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()" onblur="showPhoneError('phone', 'phoneError')">
                        </div>
                        <span id="phoneError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب أن يكون الرقم صحيحاً ومكوناً من 9 أرقام</span>
                    </div>
                </div>

                <!-- صف 5: جوال ولي الأمر ورقم الواتس -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 30px; direction: rtl; align-items: center;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">جوال ولي الأمر</label>
                        <div style="display: flex; border: 1.5px solid #e0e0e0; border-radius: 15px; overflow: hidden; background: #fff; box-sizing: border-box;">
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: var(--main-color); font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="parentPhone" name="parent_phone" required placeholder="الجوال الخاص بولي امر الطالب......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()" onblur="showPhoneError('parentPhone', 'parentPhoneError')">
                        </div>
                        <span id="parentPhoneError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب أن يكون الرقم صحيحاً ومكوناً من 9 أرقام</span>
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">رقم الواتس</label>
                        <div style="display: flex; border: 1.5px solid #e0e0e0; border-radius: 15px; overflow: hidden; background: #fff; box-sizing: border-box;">
                            <span style="background: #f1f1f1; border-left: 1.5px solid #e0e0e0; padding: 12px 15px; color: var(--main-color); font-weight: bold; font-size: 14px; display: flex; align-items: center; justify-content: center; direction: ltr; user-select: none;">967+</span>
                            <input type="text" id="whatsapp" name="whatsapp" required placeholder="رقم الواتس الخاص بك......" style="flex: 1; border: none; padding: 12px 20px; font-size: 14px; font-family: 'Cairo', sans-serif; outline: none; background: transparent;" oninput="validateStep2()" onblur="showPhoneError('whatsapp', 'whatsappError')">
                        </div>
                        <span id="whatsappError" style="color: red; font-size: 12px; display: none; margin-top: 5px; direction: rtl; text-align: right; font-weight: bold;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يجب أن يكون الرقم صحيحاً ومكوناً من 9 أرقام</span>
                    </div>
                </div>

                <!-- أزرار الخطوة الثانية -->
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px; direction: rtl;">
                    <button type="button" onclick="goToStep(1)" style="padding: 10px 30px; background: var(--main-color); color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#054445'" onmouseout="this.style.background='var(--main-color)'">السابق</button>
                    <button type="button" id="nextBtn2" disabled onclick="goToStep(3)" style="padding: 10px 30px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي</button>
                </div>
            </div>

            <!-- الخطوة الثالثة: بيانات المؤهل السابق -->
            <div id="step3" style="display: none;">

                <!-- الصف الأول: نوع الثانوية - مكان الحصول عليه مدرسة - العام الدراسي -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px; direction: rtl;">
                    <!-- نوع الثانوية -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">نوع الثانوية</label>
                        <select id="qualificationType" name="qualification_type" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                            <option value="">اختر نوع الثانوية.....</option>
                            <option value="ثانويه عامه - علمي">ثانويه عامه - علمي</option>
                            <option value="ثانويه عامه - أدبي">ثانويه عامه - أدبي</option>
                            <option value="ثانوية خارج الوطن">ثانوية خارج الوطن</option>
                        </select>
                    </div>

                    <!-- مكان الحصول عليه مدرسة -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">مكان الحصول عليه مدرسة:</label>
                        <input type="text" id="schoolName" name="school_name" required placeholder="اسم المدرسة...." style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    </div>

                    <!-- العام الدراسي -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">العام الدراسي</label>
                        <select id="graduationYear" name="graduation_year" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep3()">
                            <option value="">اختر العام...</option>
                            <?php
                            $curr_y = intval(date('Y'));
                            for ($y = $curr_y; $y >= $curr_y - 10; $y--) {
                                $prev_y = $y - 1;
                                $formatted = "$prev_y/$y";
                                echo "<option value=\"$formatted\">$formatted</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <!-- الصف الثاني: المجموع - النسبة المئوية - رقم الجلوس -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 25px; direction: rtl;">
                    <!-- المجموع -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">المجموع</label>
                        <input type="text" id="totalMarks" name="total_marks" required placeholder="مجموع الثانوية العامة" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    </div>

                    <!-- النسبة المئوية -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">النسبة المئوية</label>
                        <input type="number" id="highSchoolPercentage" name="high_school_percentage" required min="50" max="100" step="0.01" placeholder="المعدل...." style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    </div>

                    <!-- رقم الجلوس -->
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">رقم الجلوس</label>
                        <input type="text" id="seatNumber" name="seat_number" required placeholder="رقم الجلوس" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep3()">
                    </div>
                </div>

                <!-- الصف الثالث: ارفق صورة نتيجة الثانوية العامة -->
                <div style="text-align: center; margin-top: 30px; margin-bottom: 30px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 12px; color: #4a4a4a; font-size: 14px;">ارفق صورة نتيجة الثانوية العامة</label>
                    <div style="display: inline-block; position: relative; width: 100%; max-width: 400px;">
                        <input type="file" id="schoolCertImage" name="school_cert_image" required accept="image/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onchange="updateFileLabel(this)">
                        <div id="fileUploadWrapper" style="border: 2px dashed #e0e0e0; border-radius: 15px; padding: 15px; background: #fff; text-align: center; transition: all 0.3s;">
                            <span id="fileUploadText" style="color: #777; font-size: 13px; font-family: 'Cairo', sans-serif;">📁 اضغط هنا لرفع صورة النتيجة</span>
                        </div>
                    </div>
                </div>

                <!-- أزرار الخطوة الثالثة -->
                <div style="display: flex; justify-content: center; gap: 15px; margin-top: 20px; direction: rtl;">
                    <button type="button" onclick="goToStep(2)" style="padding: 10px 30px; background: var(--main-color); color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#054445'" onmouseout="this.style.background='var(--main-color)'">السابق</button>
                    <button type="button" id="nextBtn3" disabled onclick="goToStep(4)" style="padding: 10px 30px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">التالي</button>
                </div>
            </div>

            <!-- الخطوة الرابعة: بيانات الهوية وكلمة المرور -->
            <div id="step4" style="display: none;">

                <!-- الصف الأول: نوع الهوية وجهة الإصدار -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">نوع الهوية</label>
                        <select id="identityType" name="identity_type" required style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; background: #fff; cursor: pointer; box-sizing: border-box;" onchange="validateStep4()">
                            <option value="">اختر نوع الهوية...</option>
                            <option value="جواز سفر">جواز سفر</option>
                            <option value="بطاقة شخصية">بطاقة شخصية</option>
                            <option value="وثيقة استبيان مؤقت">وثيقة استبيان مؤقت</option>
                        </select>
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">جهة الإصدار</label>
                        <input type="text" id="identityPlace" name="identity_place" required placeholder="مكان الحصول عليها..." style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep4()">
                    </div>
                </div>

                <!-- الصف الثاني: رقم الهوية وتاريخ الإصدار -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 20px; direction: rtl;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">رقم الهوية</label>
                        <input type="text" id="identityNumber" name="identity_number" required placeholder="أرقام الهوية" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep4()">
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">تاريخ الإصدار</label>
                        <input type="date" id="identityIssueDate" name="identity_issue_date" required style="width: 100%; padding: 10px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" onchange="validateStep4()">
                    </div>
                </div>


                <!-- الصف الثالث: البريد الإلكتروني وكلمة المرور -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px; margin-bottom: 25px; direction: rtl;">
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">البريد الإلكتروني</label>
                        <input type="email" id="email" name="email" required placeholder="example@domain.com" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep4()">
                    </div>
                    <div style="text-align: right;">
                        <label style="display: block; font-weight: bold; margin-bottom: 8px; color: #4a4a4a; font-size: 14px;">كلمة مرور الحساب</label>
                        <input type="password" id="password" name="password" required placeholder="استخدم كلمة مرور قوية لتسجيل الدخول لاحقاً" style="width: 100%; padding: 12px 20px; border: 1.5px solid #e0e0e0; border-radius: 15px; font-size: 14px; font-family: 'Cairo', sans-serif; box-sizing: border-box; background: #fff;" oninput="validateStep4()">
                    </div>
                </div>

                <!-- الصف الرابع: ارفق صورة الهوية -->
                <div style="text-align: center; margin-top: 25px; margin-bottom: 15px;">
                    <label style="display: block; font-weight: bold; margin-bottom: 12px; color: #4a4a4a; font-size: 14px;">ارفق صورة الهوية</label>
                    <div style="display: inline-block; position: relative; width: 100%; max-width: 400px;">
                        <input type="file" id="identityImage" name="identity_image" required accept="image/*" style="opacity: 0; position: absolute; top: 0; left: 0; width: 100%; height: 100%; cursor: pointer;" onchange="updateIdentityFileLabel(this)">
                        <div id="identityUploadWrapper" style="border: 2px dashed #e0e0e0; border-radius: 15px; padding: 15px; background: #fff; text-align: center; transition: all 0.3s;">
                            <span id="identityUploadText" style="color: #777; font-size: 13px; font-family: 'Cairo', sans-serif;">📁 اضغط هنا لرفع صورة الهوية</span>
                        </div>
                    </div>
                </div>

            </div> <!-- إغلاق الخطوة الرابعة -->
            
            </div> <!-- إغلاق الوعاء الداخلي الفاتح -->

            <!-- مودال شروط القبول والتسجيل -->
            <div id="termsModal" style="display: none; position: fixed; z-index: 9999; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); backdrop-filter: blur(5px); justify-content: center; align-items: center; direction: rtl; padding: 20px; box-sizing: border-box;">
                <div style="background-color: #fcfbf7; margin: auto; padding: 30px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.25); width: 100%; max-width: 800px; border: 1.5px solid #e0e0e0; font-family: 'Cairo', sans-serif; box-sizing: border-box;">
                    <!-- الهيدر الخاص بالمودال -->
                    <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #e0e0e0; padding-bottom: 15px; margin-bottom: 20px;">
                        <h3 style="margin: 0; color: #111; font-weight: 800; font-size: 22px;">شروط القبول والتسجيل</h3>
                        <span onclick="closeTermsModal()" style="font-size: 28px; font-weight: bold; cursor: pointer; color: #888; transition: color 0.2s;" onmouseover="this.style.color='var(--main-color)'" onmouseout="this.style.color='#888'">&times;</span>
                    </div>
                    
                    <!-- المحتوى الخاص بالشروط -->
                    <div style="max-height: 400px; overflow-y: auto; text-align: right; line-height: 1.8; font-size: 15px; color: #333; padding-left: 10px;">
                        <h4 style="color: var(--main-color); font-weight: bold; font-size: 17px; margin-top: 0; margin-bottom: 15px; border-bottom: 1px dashed #e0e0e0; padding-bottom: 5px;">اللوائح الأكاديمية:</h4>
                        <ol style="padding-right: 20px; margin: 0 0 25px 0; list-style-type: decimal;">
                            <li style="margin-bottom: 12px; padding-right: 5px;">يسمح بالتحويل من تخصص إلى آخر خلال أسبوعين من بدء الدراسة بحسب قواعد لائحة شئون الطلاب الموحدة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحق للطلبة وقف القيد بعد اجتياز السنة الأولى بنجاح خلال أسبوعين من بداية العام الدراسي التالي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">الالتزام باللوائح والأنظمة الأكاديمية، والالتزام بحضور المحاضرات (النظرية والعملية والحقلية والسريرية).</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يُنذر الطالب/ـة إذا بلغت نسبة الغياب 25% من إجمالي محاضرات المقرر ويُبلغ ولي الأمر إذا تجاوز أكثر من ذلك.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحرم الطالب/ـة من الامتحانات النهائية للمقررات إذا وصلت نسبة الغياب 50% في المقرر بدون عذر مقبول.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">تُعقد الامتحانات التكميلية خلال الإجازة الصيفية وقبل العام الدراسي التالي للذين لديهم أقل من أربع مقررات رسوب في العام.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">لا يسمح بانتقال الطلبة إلى مستوى أعلى إذا تجاوزت مقررات الرسوب/الغير مقاصة أكثر من 3 مقررات، (الطلبة المقيدون في برنامج وزارة الصحة يشترط عليهم النجاح بجميع المقررات للانتقال إلى مستوى أعلى).</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">على الطلبة قراءة واستيعاب لائحة شؤون الطلاب المودع نسخة منها في المكتبة للاطلاع على بقية اللوائح والأنظمة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">عدم المعرفة باللوائح والأنظمة الأكاديمية لا تعطي الطلبة حق الاعتراض على تطبيقها.</li>
                        </ol>

                        <h4 style="color: var(--main-color); font-weight: bold; font-size: 17px; margin-top: 20px; margin-bottom: 15px; border-bottom: 1px dashed #e0e0e0; padding-bottom: 5px;">الرسوم:</h4>
                        <ol style="padding-right: 20px; margin: 0; list-style-type: decimal;">
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل لمرة واحدة فقط، رسوم الأنشطة سنوياً، رسوم البطاقة الأكاديمية فصلياً وتُسدد بداية كل فصل دراسي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">رسوم التسجيل والأنشطة والبطاقة لا ترد مهما كانت الأسباب، وتُعاد الرسوم الدراسية كاملة إذا أنسحب الطالب قبل بدء الدراسة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">في حالة الانسحاب بعد بدء الدراسة في الجامعة تخصم 5% من الرسوم السنوية عن كل أسبوع من بدء الدراسة أو من بعد التسجيل، وتُلغى كافة التخفيضات التي أستحقها الطالبـ/ـة المفصول/المنسحب في الفصول الدراسية السابقة.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">
                                يتم تسديد الرسوم الدراسية السنوية على 2-4 أقساط، الطالب غير المُسدد كامل الرسوم السنوية:
                                <ul style="list-style-type: none; padding-right: 15px; margin-top: 5px;">
                                    <li style="margin-bottom: 5px;">(أ) يُحرم من دخول امتحانات نهاية الفصل الدراسي.</li>
                                    <li style="margin-bottom: 5px;">(ب) تلغى أي تخفيضات أو منح جزئية حصل عليها الطالب شاملاً المُرسلين بموجب عقود مع الجامعة.</li>
                                </ul>
                            </li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">الجهات المرتبطة مع الجامعة بعقود يخضع طلابها لكافة لوائح الجامعة وشروط العقد ساري المفعول.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">يحصل الطالب/ـة على تخفيض حال سداد الرسوم الدراسية مقدماً خلال أسبوعين من بداية العام أو الفصل الدراسي.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">الطلبة الذين عليهم تدريب سريري في المستشفيات أو العيادات يضاف عليهم رسوم رمزية حسب ما يتقرر في سنة التدريب.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">أي تخفيض أو إعفاء من الرسوم الدراسية (منح) لا تشمل الرسوم المعملية والتطبيقية.</li>
                            <li style="margin-bottom: 12px; padding-right: 5px;">لا يُمنح الطالب الخريج إفادة تخرج ولا تُرسل وثائقه للتعميد إلا بعد استكمال برنامج التدريب وتعبئة نماذج إخلاء طرف من الجامعة وسدد كافة الرسوم.</li>
                        </ol>
                    </div>
                    
                    <!-- الفوتر الخاص بالمودال -->
                    <div style="text-align: center; margin-top: 25px; border-top: 1.5px solid #e0e0e0; padding-top: 15px;">
                        <button type="button" onclick="closeTermsModal()" style="padding: 8px 30px; background: var(--main-color); color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s;" onmouseover="this.style.background='#054445'" onmouseout="this.style.background='var(--main-color)'">موافق</button>
                    </div>
                </div>
            </div>



            <!-- الخيارات الإضافية أسفل الصندوق ذو الخلفية الرمادية (خارج الصندوق وعلى الخلفية البيضاء) -->
            <div id="step4ExtraOptions" style="display: none; justify-content: space-between; align-items: center; margin-top: 25px; margin-bottom: 25px; direction: rtl; padding: 0 10px;">
                <!-- الموافقة على سياسة القبول والتسجيل -->
                <div style="display: flex; align-items: center; gap: 8px;">
                    <input type="checkbox" id="declaration" required style="cursor: pointer; transform: scale(1.2); accent-color: var(--main-color);" onchange="validateStep4()">
                    <label for="declaration" style="font-size: 13px; color: #555; cursor: pointer; user-select: none;">
                        الموافقة على <a href="#" onclick="openTermsModal(event)" style="color: #1c7f7c; text-decoration: underline; font-weight: bold;">سياسة القبول والتسجيل</a>
                    </label>
                    <span id="declarationError" style="color: var(--main-color); font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">يجب قبول الموافقة على الشروط</span>
                </div>
                <!-- I'm not a robot -->
                <div style="display: flex; align-items: center; gap: 8px; direction: ltr;">
                    <span id="recaptchaError" style="color: var(--main-color); font-size: 13px; display: none; font-weight: bold; margin-right: 10px;">الرجاء تأكيد انك لست روبوت</span>
                    <label for="recaptchaMock" style="font-size: 13px; color: #555; cursor: pointer; user-select: none; font-family: sans-serif;">
                        I'm not a robot
                    </label>
                    <input type="checkbox" id="recaptchaMock" required style="cursor: pointer; transform: scale(1.2); accent-color: var(--main-color);" onchange="validateStep4()">
                </div>
            </div>

            <!-- زر تسجيل (التقديم النهائي) الموضح بالصورة -->
            <div id="step4SubmitContainer" style="display: none; text-align: center; margin-bottom: 30px;">
                <button type="submit" id="submitBtn" name="enroll" disabled style="padding: 10px 50px; background: #ccc; color: #888; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: not-allowed; transition: all 0.3s ease; font-family:'Cairo', sans-serif;">تسجيل</button>
            </div>

            <!-- زر السابق أسفل الدوائر للرجوع للخطوة 3 -->
            <div id="step4PrevContainer" style="display: none; text-align: center; margin-top: 15px; margin-bottom: 15px;">
                <button type="button" onclick="goToStep(3)" style="padding: 10px 30px; background: var(--main-color); color: white; border: none; border-radius: 8px; font-size: 15px; font-weight: bold; cursor: pointer; transition: background 0.3s; font-family:'Cairo', sans-serif;" onmouseover="this.style.background='#054445'" onmouseout="this.style.background='var(--main-color)'">السابق</button>
            </div>

            <!-- مؤشر الدوائر (1 - 2 - 3) في الجزء السفلي الموضح بالصورة -->
            <div style="display: flex; align-items: center; justify-content: center; position: relative; margin: 35px auto 15px auto; width: 100%; direction: rtl;">
                <div style="position: absolute; top: 50%; left: 15%; right: 15%; height: 3px; background: #e0e0e0; z-index: 1; transform: translateY(-50%);"></div>
                <div style="display: flex; justify-content: space-between; width: 70%; position: relative; z-index: 2;">
                    <div id="circle1" style="width: 32px; height: 32px; border-radius: 50%; background: var(--main-color); color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px; box-shadow: 0 2px 8px rgba(124,18,18,0.25);">1</div>
                    <div id="circle2" style="width: 32px; height: 32px; border-radius: 50%; background: #ccc; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">2</div>
                    <div id="circle3" style="width: 32px; height: 32px; border-radius: 50%; background: #ccc; color: white; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 14px;">3</div>
                </div>
            </div>

            <div style="text-align:center;margin-top:25px;"><a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a></div>
        </div> <!-- إغلاق الحاوية الثانية enrollWizardContainer -->

    </form>
</div>

<style>
select:focus, input:focus {
    border-color: var(--main-color) !important;
    outline: none;
    box-shadow: 0 0 10px rgba(124,18,18,0.15);
}
.step-indicator-tab {
    font-weight: bold;
    font-size: 15px;
    color: #888;
    transition: color 0.3s ease;
    cursor: default;
    user-select: none;
}
.step-indicator-tab:hover {
    color: var(--main-color);
}
</style>

<script src="html2pdf.bundle.min.js"></script>
<script>
var departments = {
    medical: [
        { value: "صيدلة", text: "صيدلة" },
        { value: "مساعد طبيب", text: "مساعد طبيب" },
        { value: "قبالة وتوليد", text: "قبالة وتوليد" }
    ],
    engineering: [
        { value: "تقنية معلومات IT", text: "تقنية معلومات IT" },
        { value: "هندسة معمارية", text: "هندسة معمارية" }
    ],
    admin: [
        { value: "محاسبة", text: "محاسبة" },
        { value: "إدارة أعمال", text: "إدارة أعمال" }
    ]
};

function updateColleges() {
    var branchSelect = document.getElementById("branchSelect");
var collegeSelect = document.getElementById("collegeSelect");
    var departmentSelect = document.getElementById("departmentSelect");
    var selectedBranch = branchSelect.value;
    
    collegeSelect.innerHTML = '<option value="">اختر القسم</option>';
    departmentSelect.innerHTML = '<option value="">اختر التخصص</option>';
    
    if (selectedBranch !== "") {
        var colleges = [
            { value: "medical", text: "الأقسام الطبية" },
            { value: "engineering", text: "الأقسام الهندسية" },
            { value: "admin", text: "الأقسام الإدارية" }
        ];
        
        for (var i = 0; i < colleges.length; i++) {
            var col = colleges[i];
            var opt = document.createElement("option");
            opt.value = col.value;
            opt.text = col.text;
            collegeSelect.appendChild(opt);
        }
        
        collegeSelect.disabled = false;
        collegeSelect.style.background = "#fff";
        collegeSelect.style.cursor = "pointer";
    } else {
        collegeSelect.disabled = true;
        collegeSelect.style.background = "#eee";
        collegeSelect.style.cursor = "not-allowed";
    }
    
    departmentSelect.disabled = true;
    departmentSelect.style.background = "#eee";
    departmentSelect.style.cursor = "not-allowed";
}

function updateDepartments() {
    var collegeSelect = document.getElementById("collegeSelect");
    var departmentSelect = document.getElementById("departmentSelect");
    var selectedCollege = collegeSelect.value;
    
    departmentSelect.innerHTML = '<option value="">اختر التخصص</option>';
    if (selectedCollege && departments[selectedCollege]) {
        var deps = departments[selectedCollege];
        for (var i = 0; i < deps.length; i++) {
            var dep = deps[i];
            var opt = document.createElement("option");
            opt.value = dep.value;
            opt.text = dep.text;
            departmentSelect.appendChild(opt);
        }
        
        departmentSelect.disabled = false;
        departmentSelect.style.background = "#fff";
        departmentSelect.style.cursor = "pointer";
    } else {
        departmentSelect.disabled = true;
        departmentSelect.style.background = "#eee";
        departmentSelect.style.cursor = "not-allowed";
    }
}

function validateStep1() {
    var branch = document.getElementById("branchSelect").value;
    var college = document.getElementById("collegeSelect").value;
    var department = document.getElementById("departmentSelect").value;
    var nextBtn = document.getElementById("nextBtn");
    
    if (branch !== "" && college !== "" && department !== "") {
        nextBtn.disabled = false;
        nextBtn.style.background = "var(--main-color)";
        nextBtn.style.color = "white";
        nextBtn.style.cursor = "pointer";
    } else {
        nextBtn.disabled = true;
        nextBtn.style.background = "#ccc";
        nextBtn.style.color = "#888";
        nextBtn.style.cursor = "not-allowed";
    }
}

function validateStep2() {
    var fullName = document.getElementById("fullName").value.trim();
    var englishName = document.getElementById("englishName").value.trim();
    var genderVal = document.querySelector('input[name="gender"]:checked');
    var birthDate = document.getElementById("birthDate").value;
    var birthPlace = document.getElementById("birthPlace").value;
    var nationality = document.getElementById("nationality").value;
    var phone = document.getElementById("phone").value.trim();
    var parentPhone = document.getElementById("parentPhone").value.trim();
    var whatsapp = document.getElementById("whatsapp").value.trim();
    var address = document.getElementById("address").value.trim();
    
    var nextBtn2 = document.getElementById("nextBtn2");
    
    // التحقق من الاسم الرباعي (4 أجزاء أو أكثر مفصولة بمسافات)
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var isFullNameQuad = (nameParts.length >= 4);
    
    // إخفاء رسالة الخطأ تلقائياً بمجرد إكمال الاسم الرباعي
    var errorSpan = document.getElementById("fullNameError");
    if (fullName === "" || isFullNameQuad) {
        errorSpan.style.display = "none";
    }
    
    // التحقق من الاسم الإنجليزي (حروف إنجليزية ومسافات ونقاط وعلامات وصل)
    var englishRegex = /^[a-zA-Z\s.-]+$/;
    var isEnglishNameValid = englishRegex.test(englishName);
    
    var engError = document.getElementById("englishNameError");
    if (englishName !== "" && !isEnglishNameValid) {
        engError.style.display = "block";
    } else {
        engError.style.display = "none";
    }
    
    // التحقق من أرقام الهواتف (يجب أن تتكون من 9 أرقام)
    var phoneRegex = /^[0-9]{9}$/;
    
    var isPhoneValid = phoneRegex.test(phone);
    var isParentPhoneValid = phoneRegex.test(parentPhone);
    var isWhatsappValid = phoneRegex.test(whatsapp);
    
    // إخفاء رسائل الخطأ تلقائياً بمجرد أن تصبح الأرقام صحيحة أثناء الكتابة
    if (phone === "" || isPhoneValid) {
        document.getElementById("phoneError").style.display = "none";
    }
    if (parentPhone === "" || isParentPhoneValid) {
        document.getElementById("parentPhoneError").style.display = "none";
    }
    if (whatsapp === "" || isWhatsappValid) {
        document.getElementById("whatsappError").style.display = "none";
    }
    
    if (fullName !== "" && isFullNameQuad && englishName !== "" && isEnglishNameValid && genderVal !== null && birthDate !== "" && 
        birthPlace !== "" && nationality !== "" && 
        phone !== "" && isPhoneValid && 
        parentPhone !== "" && isParentPhoneValid && 
        whatsapp !== "" && isWhatsappValid && 
        address !== "") {
        nextBtn2.disabled = false;
        nextBtn2.style.background = "var(--main-color)";
        nextBtn2.style.color = "white";
        nextBtn2.style.cursor = "pointer";
    } else {
        nextBtn2.disabled = true;
        nextBtn2.style.background = "#ccc";
        nextBtn2.style.color = "#888";
        nextBtn2.style.cursor = "not-allowed";
    }
}

function showFullNameError() {
    var fullName = document.getElementById("fullName").value.trim();
    var nameParts = fullName.split(/\s+/).filter(function(part) { return part.length > 0; });
    var errorSpan = document.getElementById("fullNameError");
    if (fullName !== "" && nameParts.length < 4) {
        errorSpan.style.display = "block";
    } else {
        errorSpan.style.display = "none";
    }
}

function showPhoneError(inputId, errorId) {
    var phoneVal = document.getElementById(inputId).value.trim();
    var phoneRegex = /^[0-9]{9}$/;
    var errorSpan = document.getElementById(errorId);
    if (phoneVal !== "" && !phoneRegex.test(phoneVal)) {
        errorSpan.style.display = "block";
    } else {
        errorSpan.style.display = "none";
    }
}

function validateStep3() {
    var qual = document.getElementById("qualificationType").value;
    var school = document.getElementById("schoolName").value.trim();
    var year = document.getElementById("graduationYear").value;
    var totalMarks = document.getElementById("totalMarks").value.trim();
    var percentage = document.getElementById("highSchoolPercentage").value;
    var seatNumber = document.getElementById("seatNumber").value.trim();
    var certFile = document.getElementById("schoolCertImage").files;
    
    var nextBtn3 = document.getElementById("nextBtn3");
    
    if (qual !== "" && school !== "" && year !== "" && totalMarks !== "" && percentage !== "" && seatNumber !== "" && certFile.length > 0) {
        nextBtn3.disabled = false;
        nextBtn3.style.background = "var(--main-color)";
        nextBtn3.style.color = "white";
        nextBtn3.style.cursor = "pointer";
    } else {
        nextBtn3.disabled = true;
        nextBtn3.style.background = "#ccc";
        nextBtn3.style.color = "#888";
        nextBtn3.style.cursor = "not-allowed";
    }
}

function updateFileLabel(input) {
    var wrapper = document.getElementById("fileUploadWrapper");
    var label = document.getElementById("fileUploadText");
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        wrapper.style.background = "#eef9f0";
    } else {
        label.innerText = "📁 اضغط هنا لرفع صورة النتيجة";
        wrapper.style.borderColor = "#e0e0e0";
        wrapper.style.background = "#fff";
    }
    validateStep3();
}

function validateStep4() {
    var idType = document.getElementById("identityType").value;
    var idPlace = document.getElementById("identityPlace").value.trim();
    var idNum = document.getElementById("identityNumber").value.trim();
    var idDate = document.getElementById("identityIssueDate").value;
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    var idImage = document.getElementById("identityImage").files;
    
    var submitBtn = document.getElementById("submitBtn");
    
    // إخفاء رسائل الخطأ تلقائياً عند تحديد مربعات الاختيار
    var declaration = document.getElementById("declaration").checked;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
    
    if (declaration) {
        document.getElementById("declarationError").style.display = "none";
    }
    if (recaptchaMock) {
        document.getElementById("recaptchaError").style.display = "none";
    }
    
    // تفعيل زر التسجيل بمجرد ملء الحقول الأساسية
    if (idType !== "" && idPlace !== "" && idNum !== "" && idDate !== "" && 
        email !== "" && password !== "" && idImage.length > 0) {
        submitBtn.disabled = false;
        submitBtn.style.background = "var(--main-color)";
        submitBtn.style.color = "white";
        submitBtn.style.cursor = "pointer";
    } else {
        submitBtn.disabled = true;
        submitBtn.style.background = "#ccc";
        submitBtn.style.color = "#888";
        submitBtn.style.cursor = "not-allowed";
    }
}

function validateStep4OnSubmit() {
    var declaration = document.getElementById("declaration").checked;
    var recaptchaMock = document.getElementById("recaptchaMock").checked;
    
    var decError = document.getElementById("declarationError");
    var recError = document.getElementById("recaptchaError");
    
    var isValid = true;
    
    if (!declaration) {
        decError.style.display = "block";
        isValid = false;
    } else {
        decError.style.display = "none";
    }
    
    if (!recaptchaMock) {
        recError.style.display = "block";
        isValid = false;
    } else {
        recError.style.display = "none";
    }
    
    return isValid;
}

function updateIdentityFileLabel(input) {
    var wrapper = document.getElementById("identityUploadWrapper");
    var label = document.getElementById("identityUploadText");
    if (input.files && input.files.length > 0) {
        label.innerText = "✅ تم اختيار: " + input.files[0].name;
        wrapper.style.borderColor = "#28a745";
        wrapper.style.background = "#eef9f0";
    } else {
        label.innerText = "📁 اضغط هنا لرفع صورة الهوية";
        wrapper.style.borderColor = "#e0e0e0";
        wrapper.style.background = "#fff";
    }
    validateStep4();
}

function openTermsModal(e) {
    if (e) e.preventDefault();
    document.getElementById("termsModal").style.display = "flex";
}

function closeTermsModal() {
    document.getElementById("termsModal").style.display = "none";
}

function openSuccessModal() {
    document.getElementById("successModal").style.display = "flex";
}

function closeSuccessModal() {
    document.getElementById("successModal").style.display = "none";
    window.location.href = "?p=home";
}

function triggerReceiptPrint() {
    if (typeof successStudentData !== 'undefined') {
        printReceipt(successStudentData);
    } else {
        window.print();
    }
}

function printReceipt(data) {
    // 1. Create a temporary off-screen container
    var container = document.createElement('div');
    container.style.position = 'fixed';
    container.style.left = '-9999px';
    container.style.top = '0';
    container.style.width = '800px';
    container.style.direction = 'rtl';
    container.style.fontFamily = '"Cairo", sans-serif';
    
    // 2. Build details
    var days = ['الأحد', 'الاثنين', 'الثلاثاء', 'الأربعاء', 'الخميس', 'الجمعة', 'السبت'];
    var now = new Date();
    var dayName = days[now.getDay()];
    
    // سنة ميلادية ملتصق بها حرف م (مثال: 2026م/08/18)
    var gregMonths = ['يناير', 'فبراير', 'مارس', 'أبريل', 'مايو', 'يونيو', 'يوليو', 'أغسطس', 'سبتمبر', 'أكتوبر', 'نوفمبر', 'ديسمبر'];
    var gregDate = now.getDate() + ' ' + gregMonths[now.getMonth()] + ' ' + now.getFullYear() + 'م';
    
    var hijriDate = "";
    try {
        var hijriFormatter = new Intl.DateTimeFormat('ar-YE-u-ca-islamic-umalqura', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
        hijriDate = hijriFormatter.format(now);
        if (!hijriDate.includes('هـ')) {
            hijriDate += ' هـ';
        }
    } catch(e) {
        hijriDate = "";
    }
    
    var hours = now.getHours();
    var minutes = String(now.getMinutes()).padStart(2, '0');
    var ampm = hours >= 12 ? 'م' : 'ص';
    var displayHours = hours % 12;
    displayHours = displayHours ? displayHours : 12;
    var timeStr = displayHours + ':' + minutes + ' ' + ampm;

    var html = '';
    html += '<style>';
    html += 'body { font-family: "Cairo", sans-serif; direction: rtl; color: #333; }';
    html += '.print-container { padding: 20px; background: #fff; }';
    html += '.section-title { background-color: #f0fdf4; border-right: 4px solid #16a34a; padding: 4px 10px; font-size: 11.5px; font-weight: bold; color: #16a34a; margin-top: 8px; margin-bottom: 4px; text-align: right; }';
    html += '.data-table { border: 1px solid #e2e8f0; width: 100%; margin-bottom: 4px; border-collapse: collapse; }';
    html += '.data-table td { border: 1px solid #cbd5e1; padding: 4px 8px; font-size: 10.5px; text-align: right; }';
    html += '.cell-label { font-weight: bold; color: #085859; background-color: #f8fafc; }';
    html += '.cell-value { color: #111; }';
    html += '.notice-box { border: 1px dashed #16a34a; background-color: #f0fdf4; padding: 8px 12px; border-radius: 8px; text-align: right; margin-top: 6px; font-size: 10px; }';
    html += '@media print {';
    html += '  body { padding: 0; background: none; margin: 8mm 12mm 8mm 12mm; }';
    html += '  .print-container { border: none; box-shadow: none; padding: 0; margin: 0; }';
    html += '  @page { size: A4; margin: 0; }';
    html += '}';
    html += '</style>';
    
    html += '<div class="print-container">';
    
    html += '<table style="width: 100%; border-collapse: collapse; margin-bottom: 6px;"><tr>';
    html += '<td style="width: 35%; text-align: right; vertical-align: middle;">';
    html += '<h3 style="margin: 0; color: #085859; font-size: 15px; font-weight: bold;">كلية سماء المتميزين</h3>';
    html += '<p style="margin: 2px 0 0; font-size: 10px; color: #555;">للعلوم الصحية والتكنولوجيا</p>';
    html += '<p style="margin: 4px 0 0; font-size: 12px; font-weight: bold; color: #16a34a;">ملخص طلب القبول الإلكتروني</p>';
    html += '</td>';
    html += '<td style="width: 30%; text-align: center; vertical-align: middle;">';
    html += '<img src="logo.png" style="max-height: 105px; width: auto;" onerror="this.style.display=\'none\';">';
    html += '</td>';
        html += '<td style="width: 35%; text-align: left; vertical-align: middle; direction: ltr; font-size: 10px; line-height: 1.4; color: #333;">';
    html += '<div><span style="font-weight: bold; color: #085859;">Temporary ID:</span> <span style="font-weight: bold; color: #16a34a;">' + data.studentId + '</span></div>';
    html += '<div style="direction: rtl; text-align: left;"><span style="font-weight: bold; color: #085859;">اليوم:</span> ' + dayName + '</div>';
    html += '<div style="direction: rtl; text-align: left;"><span style="font-weight: bold; color: #085859;">التاريخ:</span></div>';
    html += '<div style="padding-right: 5px; direction: rtl; text-align: left;">' + gregDate + '</div>';
    if (hijriDate !== "") {
        html += '<div style="padding-right: 5px; direction: rtl; text-align: left;">' + hijriDate + '</div>';
    }
    html += '<div style="direction: rtl; text-align: left;"><span style="font-weight: bold; color: #085859;">الوقت:</span> ' + timeStr + '</div>';
    html += '</td>';
    html += '</tr></table>';
    html += '<div style="border-bottom: 2px double #085859; margin-bottom: 8px;"></div>';
    
    html += '<div class="section-title">أولاً: البيانات الشخصية والاتصال</div>';
    html += '<table class="data-table">';
    html += '<tr><td class="cell-label" style="width: 20%;">الاسم رباعي (عربي):</td><td class="cell-value" style="width: 30%;">' + data.fullName + '</td>';
    html += '<td class="cell-label" style="width: 20%;">الاسم بالإنجليزية:</td><td class="cell-value" style="width: 30%;">' + data.englishName + '</td></tr>';
    html += '<tr><td class="cell-label">الجنس:</td><td class="cell-value">' + (data.gender === 'male' ? 'ذكر' : (data.gender === 'female' ? 'أنثى' : data.gender)) + '</td>';
    html += '<td class="cell-label">تاريخ الميلاد:</td><td class="cell-value">' + data.birthDate + '</td></tr>';
    html += '<tr><td class="cell-label">مكان الميلاد:</td><td class="cell-value">' + data.birthPlace + '</td>';
    html += '<td class="cell-label">الجنسية:</td><td class="cell-value">' + data.nationality + '</td></tr>';
    html += '<tr><td class="cell-label">البريد الإلكتروني:</td><td class="cell-value" style="direction: ltr; text-align: right;">' + data.email + '</td>';
    html += '<td class="cell-label">رقم الهاتف/الجوال:</td><td class="cell-value">' + data.phone + '</td></tr>';
    html += '<tr><td class="cell-label">رقم الواتساب:</td><td class="cell-value">' + data.whatsapp + '</td>';
    html += '<td class="cell-label">هاتف ولي الأمر:</td><td class="cell-value">' + data.parentPhone + '</td></tr>';
    html += '<tr><td class="cell-label">العنوان الحالي:</td><td class="cell-value" colspan="3">' + data.address + '</td></tr>';
    html += '</table>';
    
    html += '<div class="section-title">ثانياً: بيانات المؤهل العلمي والهوية</div>';
    html += '<table class="data-table">';
    html += '<tr><td class="cell-label" style="width: 20%;">نوع المؤهل:</td><td class="cell-value" style="width: 30%;">' + data.qualificationType + '</td>';
    html += '<td class="cell-label" style="width: 20%;">اسم المدرسة:</td><td class="cell-value" style="width: 30%;">' + data.schoolName + '</td></tr>';
    html += '<tr><td class="cell-label">سنة التخرج:</td><td class="cell-value">' + data.graduationYear + '</td>';
    html += '<td class="cell-label">المجموع / النسبة:</td><td class="cell-value">' + data.totalMarks + ' درجة (' + data.highSchoolPercentage + '%)</td></tr>';
    html += '<tr><td class="cell-label">رقم الجلوس:</td><td class="cell-value">' + data.seatNumber + '</td>';
    html += '<td class="cell-label">-</td><td class="cell-value">-</td></tr>';
    
    html += '<tr style="border-top: 1.5px solid #cbd5e1;"><td class="cell-label">نوع الهوية:</td><td class="cell-value">' + data.identityType + '</td>';
    html += '<td class="cell-label">رقم الهوية:</td><td class="cell-value">' + data.identityNumber + '</td></tr>';
    html += '<tr><td class="cell-label">جهة الإصدار:</td><td class="cell-value">' + data.identityPlace + '</td>';
    html += '<td class="cell-label">تاريخ الإصدار:</td><td class="cell-value">' + data.identityIssueDate + '</td></tr>';
    html += '</table>';
    
    html += '<div class="section-title">ثالثاً: الرغبة الأكاديمية والقبول</div>';
    html += '<table class="data-table">';
    html += '<tr><td class="cell-label" style="width: 20%;">الكلية المطلوبة:</td><td class="cell-value" style="width: 30%;">' + data.collegeName + '</td>';
    html += '<td class="cell-label" style="width: 20%;">التخصص/القسم:</td><td class="cell-value" style="width: 30%;">' + data.department + '</td></tr>';
    html += '<tr><td class="cell-label">الفرع المختار:</td><td class="cell-value">' + data.branch + '</td>';
    html += '<td class="cell-label">حالة القبول المبدئي:</td><td class="cell-value" style="color: #16a34a; font-weight: bold;">قيد المراجعة (بانتظار إيصال السداد)</td></tr>';
    html += '</table>';
    
    html += '<div class="notice-box">';
    html += '<h4 style="margin: 0 0 6px; color: #085859; font-size: 11px; font-weight: bold;">تعليمات تسديد الرسوم وتأكيد القبول:</h4>';
    html += '<ol style="margin: 0; padding-right: 20px; font-size: 9.5px; line-height: 1.5; color: #444;">';
    html += '<li>يرجى إيداع رسوم التسجيل بمبلغ <strong>30,000 ر.ي</strong> لحساب الجامعة <strong>3053343518</strong> أو لحساب الكلية <strong>3007722396</strong> أو <strong>3086295309</strong> طرف بنك الكريمي.</li>';
    html += '<li>بعد السداد، يرجى تسليم أصل إيصال السداد البنكي مع ملف الوثائق الكرتوني الرسمي إلى مكتب إدارة القبول والتسجيل بالكلية لتأكيد القبول النهائي.</li>';
    html += '<li>الوثائق المطلوبة: أصل شهادة الثانوية العامة مع صورتين معمدتين منها، صورتين شخصية حديثة (خلفية بيضاء)، وصورة الهوية الشخصية/جواز السفر.</li>';
    html += '</ol>';
    html += '</div>';
    
    html += '<table style="width: 100%; border-collapse: collapse; margin-top: 12px; font-size: 10.5px;"><tr>';
    html += '<td style="width: 33%; text-align: center; color: #085859;"><p style="margin: 0 0 12px;"><strong>توقيع الطالب:</strong></p><p>.......................................</p></td>';
    html += '<td style="width: 34%; text-align: center; color: #085859;"><p style="margin: 0 0 12px;"><strong>توقيع مختص القبول:</strong></p><p>.......................................</p></td>';
    html += '<td style="width: 33%; text-align: center; color: #085859;"><p style="margin: 0 0 12px;"><strong>ختم وتوقيع مسجل الكلية:</strong></p><p>.......................................</p></td>';
    html += '</tr></table>';
    
    html += '</div>';
    
    container.innerHTML = html;
    document.body.appendChild(container);
    
    function fallbackPrintAction() {
        var printWindow = window.open('', '_blank');
        if (printWindow) {
            printWindow.document.write('<html><head><title>ملخص طلب القبول</title>');
            printWindow.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">');
            printWindow.document.write('</head><body>' + html + '</body></html>');
            printWindow.document.close();
            printWindow.focus();
            setTimeout(function() {
                printWindow.print();
                printWindow.close();
                if (container && container.parentNode) {
                    document.body.removeChild(container);
                }
            }, 500);
        } else {
            alert("يرجى السماح بالنوافذ المنبثقة (Popups) في المتصفح لكي تتمكن من الطباعة.");
            if (container && container.parentNode) {
                document.body.removeChild(container);
            }
        }
    }
    
    if (typeof html2pdf !== 'undefined') {
        var opt = {
            margin: [8, 12, 8, 12],
            filename: "Sama_College_Receipt_" + data.studentId + ".pdf",
            image: { type: "jpeg", quality: 0.98 },
            html2canvas: { scale: 2, useCORS: true },
            jsPDF: { unit: "mm", format: "a4", orientation: "portrait" }
        };
        
        html2pdf().from(container).set(opt).save().then(function() {
            if (container && container.parentNode) {
                document.body.removeChild(container);
            }
        }).catch(function(err) {
            console.error("html2pdf save failed, falling back to window print:", err);
            fallbackPrintAction();
        });
    } else {
        console.warn("html2pdf library is not defined, falling back to window print");
        fallbackPrintAction();
    }
}
function goToStep(step) {
    if (step === 1) {
        document.getElementById("enrollStep1Container").style.display = "block";
        document.getElementById("enrollWizardContainer").style.display = "none";
        
        document.getElementById("step1").style.display = "block";
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
        
        document.getElementById("step4ExtraOptions").style.display = "none";
        document.getElementById("step4SubmitContainer").style.display = "none";
        document.getElementById("step4PrevContainer").style.display = "none";
        
        // Reset circles
        document.getElementById("circle1").style.background = "var(--main-color)";
        document.getElementById("circle2").style.background = "#ccc";
        document.getElementById("circle3").style.background = "#ccc";
        
        validateStep1();
    } else if (step === 2) {
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
        
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "block";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "none";
        
        document.getElementById("step4ExtraOptions").style.display = "none";
        document.getElementById("step4SubmitContainer").style.display = "none";
        document.getElementById("step4PrevContainer").style.display = "none";
        
        // Update indicators
        document.getElementById("tabStep2").style.color = "var(--main-color)";
        document.getElementById("tabStep3").style.color = "#888";
        document.getElementById("tabStep4").style.color = "#888";
        
        document.getElementById("circle1").style.background = "var(--main-color)";
        document.getElementById("circle2").style.background = "var(--main-color)";
        document.getElementById("circle3").style.background = "#ccc";
        document.getElementById("wizardStepTitle").innerText = "البيانات الشخصية";
        validateStep2();
    } else if (step === 3) {
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
        
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "block";
        document.getElementById("step4").style.display = "none";
        
        document.getElementById("step4ExtraOptions").style.display = "none";
        document.getElementById("step4SubmitContainer").style.display = "none";
        document.getElementById("step4PrevContainer").style.display = "none";
        
        // Update indicators
        document.getElementById("tabStep2").style.color = "#888";
        document.getElementById("tabStep3").style.color = "var(--main-color)";
        document.getElementById("tabStep4").style.color = "#888";
        
        document.getElementById("circle1").style.background = "var(--main-color)";
        document.getElementById("circle2").style.background = "var(--main-color)";
        document.getElementById("circle3").style.background = "var(--main-color)";
        document.getElementById("wizardStepTitle").innerText = "بيانات المؤهل السابق";
        validateStep3();
    } else if (step === 4) {
        document.getElementById("enrollStep1Container").style.display = "none";
        document.getElementById("enrollWizardContainer").style.display = "block";
        
        document.getElementById("step1").style.display = "none";
        document.getElementById("step2").style.display = "none";
        document.getElementById("step3").style.display = "none";
        document.getElementById("step4").style.display = "block";
        
        document.getElementById("step4ExtraOptions").style.display = "flex";
        document.getElementById("step4SubmitContainer").style.display = "block";
        document.getElementById("step4PrevContainer").style.display = "block";
        
        // Update indicators
        document.getElementById("tabStep2").style.color = "#888";
        document.getElementById("tabStep3").style.color = "#888";
        document.getElementById("tabStep4").style.color = "var(--main-color)";
        
        document.getElementById("circle1").style.background = "var(--main-color)";
        document.getElementById("circle2").style.background = "var(--main-color)";
        document.getElementById("circle3").style.background = "var(--main-color)";
        document.getElementById("wizardStepTitle").innerText = "بيانات الهوية";
        validateStep4();
    }
    
    // Scroll wizard to top
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
<?php 
endif; // Closes the page content switcher (which started at line 1604)
endif; // Closes the !$db_page_rendered check

// Render global footer for public pages
if ($page != 'enroll'): // Only render footer if not on enroll page
?>
<?php if ($page == 'home'): ?>
<!-- ===== قسم قالوا عنا (آراء الوزراء والزوار) ===== -->
<section style="padding: 60px 0; background: #fafafa; font-family: 'Cairo', sans-serif; overflow: hidden; border-top: 1px solid #eaeaea;">
    <div style="max-width: 1200px; margin: auto; padding: 0 20px;">
        <!-- الهيدر الخاص بالقسم -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; direction: rtl;">
            <div style="position: relative;">
                <h2 style="font-size: 24px; font-weight: 800; color: var(--main-color); margin: 0; position: relative; padding-bottom: 10px; text-align: right;">
                    قالوا عنا
                </h2>
                <div style="position: absolute; bottom: 0; right: 0; width: 60px; height: 3px; background: var(--accent-color); border-radius: 2px;"></div>
            </div>
            <!-- أزرار التحكم -->
            <div style="display: flex; gap: 10px; direction: ltr;">
                <button onclick="slideTestimonials('next')" class="testi-btn" aria-label="التالي">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slideTestimonials('prev')" class="testi-btn" aria-label="السابق">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <style>
            .testi-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 2px solid var(--main-color);
                background: transparent;
                color: var(--main-color);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                outline: none;
            }
            .testi-btn:hover {
                background: var(--main-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(8, 88, 89, 0.2);
            }
            .testi-container {
                position: relative;
                height: 380px;
                width: 100%;
                overflow: hidden;
            }
            .testi-card {
                position: absolute;
                width: 100%;
                max-width: 370px;
                left: 50%;
                background: white;
                border-radius: 16px;
                padding: 35px 30px;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03);
                border: 1px solid #e2e8f0;
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                min-height: 310px;
                transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease, border-color 0.3s ease, box-shadow 0.3s ease;
                box-sizing: border-box;
            }
            .testi-card:hover {
                box-shadow: 0 15px 35px rgba(8, 88, 89, 0.08);
                border-color: rgba(8, 88, 89, 0.15);
            }
            .quote-icon {
                position: absolute;
                top: 25px;
                left: 25px;
                color: rgba(8, 88, 89, 0.1);
                font-size: 60px;
                font-family: Georgia, serif;
                line-height: 1;
                pointer-events: none;
            }
            .testi-text {
                font-size: 14px;
                line-height: 1.8;
                color: #4a5568;
                margin: 0 0 25px;
                text-align: justify;
                font-weight: 500;
                direction: rtl;
            }
            .testi-footer {
                display: flex;
                align-items: center;
                border-top: 1px solid #f7fafc;
                padding-top: 15px;
                direction: rtl;
            }
            .testi-avatar {
                width: 52px;
                height: 52px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid var(--accent-color);
                box-shadow: 0 4px 8px rgba(0,0,0,0.1);
                margin-left: 15px;
            }
            .testi-info {
                display: flex;
                flex-direction: column;
                text-align: right;
            }
            .testi-name {
                font-size: 14px;
                font-weight: 700;
                color: var(--main-color);
                margin: 0;
            }
            .testi-title-ar {
                font-size: 11px;
                color: var(--main-color);
                margin: 2px 0 0;
                font-weight: 600;
            }
            .testi-title-en {
                font-size: 10px;
                color: #a0aec0;
                margin: 1px 0 0;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            /* مواضع الكروت بالتفصيل */
            .pos-center {
                transform: translate(-50%, 0) scale(1.03);
                z-index: 3;
                opacity: 1;
                border-top: 4px solid var(--main-color);
            }
            .pos-right {
                transform: translate(calc(-50% + 400px), 0) scale(0.95);
                z-index: 2;
                opacity: 0.75;
            }
            .pos-left {
                transform: translate(calc(-50% - 400px), 0) scale(0.95);
                z-index: 2;
                opacity: 0.75;
            }

            @media (max-width: 1024px) {
                .pos-right {
                    transform: translate(calc(-50% + 280px), 0) scale(0.93);
                }
                .pos-left {
                    transform: translate(calc(-50% - 280px), 0) scale(0.93);
                }
            }
            @media (max-width: 768px) {
                .testi-card {
                    max-width: 90%;
                }
                .pos-center {
                    transform: translate(-50%, 0) scale(1);
                    opacity: 1;
                    z-index: 3;
                }
                .pos-right {
                    transform: translate(calc(-50% + 115%), 0) scale(0.9);
                    opacity: 0;
                    z-index: 1;
                    pointer-events: none;
                }
                .pos-left {
                    transform: translate(calc(-50% - 115%), 0) scale(0.9);
                    opacity: 0;
                    z-index: 1;
                    pointer-events: none;
                }
            }
        </style>

        <div class="testi-container" id="testiContainer">
            <!-- الكارت الأول: أ. حسين علي حازب (يمين افتراضياً) -->
            <div class="testi-card pos-right" id="testiCard0">
                <div class="quote-icon">”</div>
                <p class="testi-text">
                    "ارتحت لما شاهدته في الكلية من تجهيزات وقاعات ومختبرات حديثة، وأتمنى لكلية سماء المتميزين مواصلة النهوض والتميز كمؤسسة تعليمية رائدة في رفد الوطن بالكوادر المؤهلة."
                </p>
                <div class="testi-footer">
                    <img src="images/author_hazeb.jpg" alt="أ. حسين علي حازب" class="testi-avatar">
                    <div class="testi-info">
                        <h4 class="testi-name">أ. حسين علي حازب</h4>
                        <span class="testi-title-ar">وزير التعليم العالي والبحث العلمي السابق</span>
                        <span class="testi-title-en">Hussein Ali Hazeb - Former Minister of Higher Education</span>
                    </div>
                </div>
            </div>

            <!-- الكارت الثاني: د. عبدالله الحامدي (منتصف افتراضياً - مميز) -->
            <div class="testi-card pos-center" id="testiCard1">
                <div class="quote-icon">”</div>
                <p class="testi-text">
                    "حققت الكلية أهدافاً أكاديمية ملموسة وتخرج منها كوادر يمنية متميزة في المجال الصحي والتقني. أتمنى لإدارة الكلية وكادرها التعليمي دوام التقدم والنجاح المستمر."
                </p>
                <div class="testi-footer">
                    <img src="images/author_hamdi.jpg" alt="د. عبدالله الحامدي" class="testi-avatar">
                    <div class="testi-info">
                        <h4 class="testi-name">د. عبدالله الحامدي</h4>
                        <span class="testi-title-ar">نائب وزير التربية والتعليم السابق</span>
                        <span class="testi-title-en">Dr Abdullah Al-Hamdi - Former Deputy Minister of Education</span>
                    </div>
                </div>
            </div>

            <!-- الكارت الثالث: الفريق/ سلطان السامعي (يسار افتراضياً) -->
            <div class="testi-card pos-left" id="testiCard2">
                <div class="quote-icon">”</div>
                <p class="testi-text">
                    "تعتبر كلية سماء المتميزين إحدى المؤسسات التعليمية البارزة التي توفر كافة الإمكانيات والتجهيزات الحديثة التي يحتاجها الطلاب للتحصيل العلمي والتطبيقي المتميز."
                </p>
                <div class="testi-footer">
                    <img src="images/author_sami.jpg" alt="الفريق/ سلطان السامعي" class="testi-avatar">
                    <div class="testi-info">
                        <h4 class="testi-name">الفريق/ سلطان السامعي</h4>
                        <span class="testi-title-ar">عضو المجلس السياسي الأعلى</span>
                        <span class="testi-title-en">Lieutenant General / Sultan Al-Sami</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// الحالات الابتدائية لمواقع الكروت الثلاثة
let testiStates = ['pos-right', 'pos-center', 'pos-left'];
let testiInterval = null;

function updateTestimonials() {
    const cards = [
        document.getElementById('testiCard0'),
        document.getElementById('testiCard1'),
        document.getElementById('testiCard2')
    ];
    
    cards.forEach((card, index) => {
        if (!card) return;
        // إزالة الكلاسات القديمة
        card.classList.remove('pos-right', 'pos-center', 'pos-left');
        
        // تعيين الكلاس الجديد بناءً على الحالة الحالية
        const stateClass = testiStates[index];
        card.classList.add(stateClass);
    });
}

function autoSlideTestimonials() {
    // الانتقال لكلام سلطان السامعي (اليسار يصبح بالمنتصف) يعني إزاحة الحالات باتجاه عقارب الساعة
    testiStates.unshift(testiStates.pop());
    updateTestimonials();
}

function slideTestimonials(direction) {
    console.log("Testimonials: manual rotation, direction:", direction);
    if (testiInterval) clearInterval(testiInterval);
    testiInterval = setInterval(autoSlideTestimonials, 5000);
    
    if (direction === 'next') {
        // التالي (اليسار يذهب للمنتصف)
        testiStates.unshift(testiStates.pop());
    } else {
        // السابق (اليمين يذهب للمنتصف)
        testiStates.push(testiStates.shift());
    }
    updateTestimonials();
}

// البدء التلقائي وإدارة مرور الماوس
function initTestimonials() {
    console.log("Testimonials loop carousel initialized successfully.");
    const container = document.getElementById('testiContainer');
    if (container) {
        container.addEventListener('mouseenter', () => {
            console.log("Testimonials: paused.");
            if (testiInterval) clearInterval(testiInterval);
        });
        container.addEventListener('mouseleave', () => {
            console.log("Testimonials: resumed.");
            if (testiInterval) clearInterval(testiInterval);
            testiInterval = setInterval(autoSlideTestimonials, 5000);
        });
    }
    if (testiInterval) clearInterval(testiInterval);
    testiInterval = setInterval(autoSlideTestimonials, 5000);
}

if (document.readyState !== 'loading') {
    initTestimonials();
} else {
    document.addEventListener('DOMContentLoaded', initTestimonials);
}
</script>

<!-- ===== قسم شركاء النجاح ===== -->
<section style="padding: 60px 0; background: #ffffff; font-family: 'Cairo', sans-serif; overflow: hidden; border-top: 1px solid #eaeaea;">
    <div style="max-width: 1200px; margin: auto; padding: 0 20px;">
        <!-- الهيدر الخاص بالقسم -->
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 40px; direction: rtl;">
            <div style="position: relative;">
                <h2 style="font-size: 24px; font-weight: 800; color: var(--main-color); margin: 0; position: relative; padding-bottom: 10px; text-align: right;">
                    شركاء النجاح
                </h2>
                <div style="position: absolute; bottom: 0; right: 0; width: 60px; height: 3px; background: var(--accent-color); border-radius: 2px;"></div>
            </div>
            <!-- أزرار التحكم -->
            <div style="display: flex; gap: 10px; direction: ltr;">
                <button onclick="slidePartners('next')" class="partner-btn" aria-label="التالي">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"/></svg>
                </button>
                <button onclick="slidePartners('prev')" class="partner-btn" aria-label="السابق">
                    <svg width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"/></svg>
                </button>
            </div>
        </div>

        <style>
            .partner-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 2px solid var(--main-color);
                background: transparent;
                color: var(--main-color);
                display: inline-flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.3s ease;
                outline: none;
            }
            .partner-btn:hover {
                background: var(--main-color);
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 10px rgba(8, 88, 89, 0.2);
            }
            .partner-container {
                position: relative;
                height: 220px;
                width: 100%;
                overflow: hidden;
            }
            .partner-card {
                position: absolute;
                width: 100%;
                max-width: 180px;
                height: 180px;
                left: 50%;
                background: white;
                border: 1px solid #e2e8f0;
                border-radius: 16px;
                padding: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                box-sizing: border-box;
                transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1), opacity 0.6s ease, border-color 0.3s ease;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.02);
            }
            .partner-card img {
                max-width: 100%;
                max-height: 100%;
                object-fit: contain;
            }
            .partner-card:hover {
                box-shadow: 0 12px 30px rgba(8, 88, 89, 0.08);
                border-color: rgba(8, 88, 89, 0.15);
            }

            /* مواضع الشركاء الدائرية */
            .partner-pos-center {
                transform: translate(-50%, 0) scale(1.05);
                z-index: 3;
                opacity: 1;
                border: 2px solid var(--main-color);
            }
            .partner-pos-right {
                transform: translate(calc(-50% + 220px), 0) scale(0.9);
                z-index: 2;
                opacity: 0.7;
            }
            .partner-pos-left {
                transform: translate(calc(-50% - 220px), 0) scale(0.9);
                z-index: 2;
                opacity: 0.7;
            }
            .partner-pos-hidden {
                transform: translate(-50%, 0) scale(0.5);
                z-index: 1;
                opacity: 0;
                pointer-events: none;
            }

            @media (max-width: 768px) {
                .partner-card {
                    max-width: 150px;
                    height: 150px;
                }
                .partner-pos-center {
                    transform: translate(-50%, 0) scale(1);
                    opacity: 1;
                    z-index: 3;
                }
                .partner-pos-right {
                    transform: translate(calc(-50% + 115%), 0) scale(0.8);
                    opacity: 0;
                    z-index: 1;
                    pointer-events: none;
                }
                .partner-pos-left {
                    transform: translate(calc(-50% - 115%), 0) scale(0.8);
                    opacity: 0;
                    z-index: 1;
                    pointer-events: none;
                }
                .partner-pos-hidden {
                    transform: translate(-50%, 0) scale(0.5);
                    opacity: 0;
                    z-index: 1;
                    pointer-events: none;
                }
            }
        </style>

        <div class="partner-container" id="partnerContainer">
            <!-- الكروت الستة للشركاء -->
            <div class="partner-card partner-pos-right" id="partnerCard0">
                <img src="images/partner_1.png" alt="بلاتفورم">
            </div>
            <div class="partner-card partner-pos-center" id="partnerCard1">
                <img src="images/partner_2.png" alt="المجلس الطبي">
            </div>
            <div class="partner-card partner-pos-left" id="partnerCard2">
                <img src="images/partner_3.png" alt="إبداع سوفت">
            </div>
            <div class="partner-card partner-pos-hidden" id="partnerCard3">
                <img src="images/partner_4.png" alt="مركز تقنية المعلومات">
            </div>
            <div class="partner-card partner-pos-hidden" id="partnerCard4">
                <img src="images/partner_5.png" alt="مجلس الاعتماد الأكاديمي">
            </div>
            <div class="partner-card partner-pos-hidden" id="partnerCard5">
                <img src="images/partner_6.png" alt="وزارة التعليم العالي">
            </div>
        </div>
    </div>
</section>

<script>
// الحالات الابتدائية لمواقع الشركاء الستة
let partnerStates = [
    'partner-pos-right',
    'partner-pos-center',
    'partner-pos-left',
    'partner-pos-hidden',
    'partner-pos-hidden',
    'partner-pos-hidden'
];
let partnerInterval = null;

function updatePartners() {
    const cards = [
        document.getElementById('partnerCard0'),
        document.getElementById('partnerCard1'),
        document.getElementById('partnerCard2'),
        document.getElementById('partnerCard3'),
        document.getElementById('partnerCard4'),
        document.getElementById('partnerCard5')
    ];
    
    cards.forEach((card, index) => {
        if (!card) return;
        // إزالة الكلاسات القديمة
        card.classList.remove('partner-pos-right', 'partner-pos-center', 'partner-pos-left', 'partner-pos-hidden');
        
        // تعيين الكلاس الجديد
        const stateClass = partnerStates[index];
        card.classList.add(stateClass);
    });
}

function autoSlidePartners() {
    // تدوير مصفوفة الحالات لعرض الشريك التالي بالمنتصف
    partnerStates.unshift(partnerStates.pop());
    updatePartners();
}

function slidePartners(direction) {
    console.log("Partners: manual rotation, direction:", direction);
    if (partnerInterval) clearInterval(partnerInterval);
    partnerInterval = setInterval(autoSlidePartners, 5000);
    
    if (direction === 'next') {
        partnerStates.unshift(partnerStates.pop());
    } else {
        partnerStates.push(partnerStates.shift());
    }
    updatePartners();
}

// تهيئة السلايدر الدائري للشركاء
function initPartners() {
    console.log("Partners rotating carousel initialized successfully.");
    const container = document.getElementById('partnerContainer');
    if (container) {
        container.addEventListener('mouseenter', () => {
            if (partnerInterval) clearInterval(partnerInterval);
        });
        container.addEventListener('mouseleave', () => {
            if (partnerInterval) clearInterval(partnerInterval);
            partnerInterval = setInterval(autoSlidePartners, 5000);
        });
    }
    if (partnerInterval) clearInterval(partnerInterval);
    partnerInterval = setInterval(autoSlidePartners, 5000);
}

if (document.readyState !== 'loading') {
    initPartners();
} else {
    document.addEventListener('DOMContentLoaded', initPartners);
}
</script>
<?php endif; ?>

<!-- ===== الفوتر ===== -->
<footer style="margin-top: 50px;">
    <!-- الجزء العلوي للفوتر (عنابي) -->
    <div style="background: var(--main-color); color: white; padding: 60px 20px 140px; text-align: center; position: relative;">
        <div style="margin: 0 auto 35px; max-width: 850px; font-family: 'Cairo', sans-serif;">
            <h2 style="font-size: 22px; font-weight: 800; color: var(--accent-color); margin: 0 0 12px 0; font-family: 'Cairo', sans-serif; letter-spacing: 0.5px;">
                كلية سماء المتميزين للعلوم الصحية والتكنولوجيا
            </h2>
            <p style="line-height: 2; font-size: 14.5px; opacity: 0.9; color: #f7fafc; margin: 0;">
                هي مؤسسة تعليمية رائدة مرخصة رسمياً من وزارة التعليم العالي والبحث العلمي ووزارة الصحة العامة والسكان، تقدم برامج أكاديمية متميزة لبناء جيل مبدع ومؤهل تكنولوجياً وطبياً.
            </p>
        </div>
        
        <!-- خط فاصل خفيف -->
        <div style="width: 100%; max-width: 600px; height: 1px; background: rgba(255, 255, 255, 0.15); margin: 30px auto;"></div>

        <!-- تواصل معنا -->
        <h3 style="color: white; font-size: 19px; font-weight: bold; margin: 0 0 25px 0; font-family: 'Cairo', sans-serif;">تواصل معنا</h3>
        
        <div style="display: flex; flex-direction: column; align-items: center; gap: 15px; font-size: 14px; line-height: 1.8; color: #f7fafc; max-width: 900px; margin: 0 auto; font-family: 'Cairo', sans-serif;">
            <!-- المركز الرئيسي -->
            <div style="text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; direction: rtl; margin-bottom: 5px; flex-wrap: wrap;">
                    <span style="display: inline-flex; align-items: center; gap: 6px; color: var(--accent-color); font-weight: bold;">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        المركز الرئيسي:
                    </span>
                    <span>تعز- دمنة خدير- شارع شمعة – خلف حلويات الناشري – مقابل خزان شاعر</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px; direction: rtl; font-size: 13.5px; opacity: 0.9; flex-wrap: wrap;">
                    <span style="color: var(--accent-color); font-weight: bold; margin-left: 5px;">أرقام التواصل:</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:04323058" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">04-323058</a>
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align: middle;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        <a href="tel:770821112" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">770821112</a> - 
                        <a href="tel:733045299" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">733045299</a> - 
                        <a href="tel:736863982" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">736863982</a>
                    </span>
                </div>
            </div>
            
            <div style="width: 100%; max-width: 300px; height: 1px; background: rgba(255, 255, 255, 0.08); margin: 8px auto;"></div>

            <!-- فرع الراهدة -->
            <div style="text-align: center;">
                <div style="display: flex; align-items: center; justify-content: center; gap: 8px; direction: rtl; margin-bottom: 5px; flex-wrap: wrap;">
                    <span style="display: inline-flex; align-items: center; gap: 6px; color: var(--accent-color); font-weight: bold;">
                        <svg width="15" height="15" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        فرع الراهدة:
                    </span>
                    <span>طريق عدن - مدخل حي الجنوبيين - مستوصف ابن سينا سابقاً</span>
                </div>
                <div style="display: flex; align-items: center; justify-content: center; gap: 15px; direction: rtl; font-size: 13.5px; opacity: 0.9; flex-wrap: wrap;">
                    <span style="color: var(--accent-color); font-weight: bold; margin-left: 5px;">أرقام التواصل:</span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="currentColor" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        <a href="tel:04323058" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">04-323058</a>
                    </span>
                    <span style="display: inline-flex; align-items: center; gap: 6px; direction: ltr;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="vertical-align: middle;"><rect x="5" y="2" width="14" height="20" rx="2" ry="2"/><line x1="12" y1="18" x2="12.01" y2="18"/></svg>
                        <a href="tel:770821112" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">770821112</a> - 
                        <a href="tel:733045299" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">733045299</a> - 
                        <a href="tel:736863982" style="color: white; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">736863982</a>
                    </span>
                </div>
            </div>

            <!-- البريد الإلكتروني -->
            <div style="display: flex; align-items: center; justify-content: center; gap: 12px; direction: rtl;">
                <span style="display: inline-flex; align-items: center; gap: 6px; color: var(--accent-color); font-weight: bold;">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" viewBox="0 0 24 24" style="vertical-align: middle;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    البريد الإلكتروني:
                </span>
                <a href="mailto:klytalmtmyzyn@gmail.com" style="color: white; text-decoration: none; font-weight: bold; transition: color 0.3s;" onmouseover="this.style.color='var(--accent-color)'" onmouseout="this.style.color='white'">klytalmtmyzyn@gmail.com</a>
            </div>
        </div>
        
        <!-- الشعار في المنتصف متداخل بين القسمين -->
        <div style="position: absolute; bottom: -70px; left: 50%; transform: translateX(-50%); width: 140px; height: 140px; border-radius: 12px; background: white; box-shadow: 0 8px 24px rgba(0,0,0,0.15); display: flex; align-items: center; justify-content: center; padding: 8px; border: 3px solid var(--accent-color); overflow: hidden; z-index: 10;">
            <img src="footer-logo.png?v=4" style="max-width: 100%; max-height: 100%; object-fit: contain;" alt="شعار الكلية">
        </div>
    </div>

    <!-- الجزء السفلي للفوتر (أبيض) -->
    <div style="background: white; color: #333; padding: 110px 20px 50px; text-align: center; border-top: 1px solid #eaeaea; font-family: 'Cairo', sans-serif;">
        <style>
            .footer-social-link {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                width: 42px;
                height: 42px;
                border-radius: 6px;
                border: 2px solid var(--main-color);
                background: transparent;
                color: var(--main-color);
                text-decoration: none;
                transition: all 0.3s ease;
                box-sizing: border-box;
            }
            .footer-social-link:hover {
                transform: translateY(-3px);
                color: white;
                background: var(--main-color);
                box-shadow: 0 6px 12px rgba(8, 88, 89, 0.2);
            }
        </style>
        
        <!-- حقوق النشر وتصميم بلاتفورم -->
        <div style="font-size: 14px; color: #333; font-weight: bold; margin-bottom: 8px; font-family: 'Cairo', sans-serif;">
            حقوق النشر محفوظة لكلية سماء المتميزين &copy; 2026
        </div>
        <div style="font-size: 13px; color: #666; margin-bottom: 25px; font-family: 'Cairo', sans-serif; display: flex; align-items: center; justify-content: center; gap: 8px;">
            <span>تصميم وبرمجة:</span>
            <img src="images/developer_logo.jpg" style="width: 45px; height: 45px; border-radius: 50%; vertical-align: middle; box-shadow: 0 2px 8px rgba(0,0,0,0.15); transition: transform 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='scale(1.1)'" onmouseout="this.style.transform='scale(1)'" alt="سمية هزاع السامعي" title="سمية هزاع السامعي">
        </div>

        <!-- الروابط الاجتماعية -->
        <div style="display: flex; justify-content: center; gap: 15px;">
            <!-- WhatsApp -->
            <a href="https://whatsapp.com/channel/0029VawXrtb6WaKmdjWzpN2L" target="_blank" class="footer-social-link" title="واتساب">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
            </a>
            <!-- Telegram -->
            <a href="https://t.me/Samaalmutamaizeencollege" target="_blank" class="footer-social-link" title="تليجرام">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
            </a>
            <!-- Facebook -->
            <a href="https://www.facebook.com/profile.php?id=100068909298876" target="_blank" class="footer-social-link" title="فيسبوك">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
            </a>
        </div>
    </div>
</footer>

<button onclick="scrollToTop()" id="topBtn" style="display: none; position: fixed; bottom: 20px; left: 20px; z-index: 99; border: none; outline: none; background-color: var(--main-color); color: white; cursor: pointer; padding: 12px 16px; border-radius: 50%; font-size: 16px; transition: all 0.3s; box-shadow: 0 4px 10px rgba(0,0,0,0.25);" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='var(--main-color)'; this.style.transform='translateY(-3px)';" onmouseout="this.style.background='var(--main-color)'; this.style.color='white'; this.style.transform='none';">⬆</button>

<script>
window.onscroll = function() { scrollFunction() };
function scrollFunction() {
    var topBtn = document.getElementById("topBtn");
    if (topBtn) {
        if (document.body.scrollTop > 300 || document.documentElement.scrollTop > 300) {
            topBtn.style.display = "block";
        } else {
            topBtn.style.display = "none";
        }
    }
}
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}
</script>
<?php 
endif; // Closes if ($page != 'enroll')
endif; // Closes layout wrapper check (starts at line 1419)
?>

<!-- مودال التفاصيل الكاملة لآخر الأخبار متطابق مع صفحة الفعاليات -->
<div id="latestNewsDetailsModal" style="display:none; position:fixed; z-index:99999; left:0; top:0; width:100%; height:100%; background:rgba(0,0,0,0.6); backdrop-filter:blur(5px); justify-content:center; align-items:center; direction:rtl; padding:20px; box-sizing:border-box;">
    <div style="background:white; border-radius:24px; box-shadow:0 20px 50px rgba(0,0,0,0.25); width:100%; max-width:700px; text-align:right; font-family:'Cairo',sans-serif; overflow:hidden; display:flex; flex-direction:column; max-height:90vh;">
        
        <!-- رأس المودال -->
        <div style="background:var(--main-color); color:white; padding:20px; font-weight:bold; font-size:17px; display:flex; justify-content:space-between; align-items:center; border-bottom:3px solid #1c7f7c;">
            <span id="news_modal_badge" style="background:#1c7f7c; padding:2px 10px; border-radius:30px; font-size:12px; font-weight:bold; color:white; margin-left:10px;">أخرى</span>
            <span id="news_modal_title" style="flex-grow:1; text-overflow:ellipsis; overflow:hidden; white-space:nowrap;">تفاصيل الخبر</span>
            <button onclick="closeLatestNewsModal()" style="background:none; border:none; color:white; font-size:28px; cursor:pointer; line-height:1; padding:0; margin-right:15px;">&times;</button>
        </div>
        
        <!-- جسم المودال -->
        <div style="padding:25px; overflow-y:auto; flex-grow:1;">
            
            <!-- معرض الصور والفيديو -->
            <div id="news_modal_media_gallery_wrapper" style="margin-bottom:20px;">
                <!-- شاشة العرض الرئيسية للوسائط -->
                <div id="news_modal_media_viewer" style="width:100%; height:260px; background:#f8fafc; border-radius:16px; overflow:hidden; display:flex; align-items:center; justify-content:center; box-shadow:0 4px 15px rgba(0,0,0,0.05); position:relative;">
                    <!-- سيتم ملؤه ديناميكياً -->
                </div>
                
                <!-- شبكة مصغرات الصور (Thumbnails) -->
                <div id="news_modal_media_thumbnails" style="display:flex; justify-content:center; gap:10px; margin-top:12px; flex-wrap:wrap;">
                    <!-- سيتم توليدها ديناميكياً -->
                </div>
            </div>

            <!-- تفاصيل النشر والجهة -->
            <div style="background:#f8fafc; border:1px solid #e2e8f0; border-radius:12px; padding:15px; margin-bottom:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px;">
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    <strong>تاريخ النشر:</strong>
                    <span id="news_modal_date" style="font-weight:bold; color:var(--main-color);"></span>
                </div>
                <div style="display:flex; align-items:center; gap:8px; font-size:13.5px; color:#333;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a8 8 0 0 0-8 8c0 5.25 8 12 8 12s8-6.75 8-12a8 8 0 0 0-8-8z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                    <strong>الجهة الناشرة:</strong>
                    <span id="news_modal_publisher" style="font-weight:bold; color:var(--main-color);">عمادة الكلية</span>
                </div>
            </div>

            <!-- محتوى الخبر -->
            <div style="margin-bottom:15px;">
                <h4 style="margin:0 0 10px 0; color:var(--main-color); font-size:15px; font-weight:bold; border-bottom:1.5px solid #edf2f7; padding-bottom:8px;"><i class="fa-regular fa-file-lines" style="color: #1c7f7c; margin-left: 5px;"></i> تفاصيل ومحاور الخبر:</h4>
                <p id="news_modal_desc" style="color:#4a5568; font-size:14px; line-height:1.7; white-space:pre-wrap; margin:0 0 25px 0; text-align:justify; font-family:'Cairo', sans-serif;"></p>
                
                <!-- شريط مشاركة الخبر مع كافة الأيقونات -->
                <div style="margin-top:25px; padding-top:15px; border-top:1.5px dashed #e2e8f0; display:flex; align-items:center; gap:10px; flex-wrap:wrap; direction:rtl;">
                    <span style="font-weight:800; color:var(--main-color); font-size:14px; margin-left:10px;"><i class="fa-solid fa-share-nodes" style="color: var(--main-color); margin-left: 5px;"></i> مشاركة الخبر:</span>
                    
                    <!-- Facebook -->
                    <a id="news_share_fb" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#1877f2'; this.style.color='white'; this.style.borderColor='#1877f2';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        فيسبوك
                    </a>

                    <!-- Twitter / X -->
                    <a id="news_share_tw" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#000'; this.style.color='white'; this.style.borderColor='#000';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        تويتر
                    </a>

                    <!-- WhatsApp -->
                    <a id="news_share_wa" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#25d366'; this.style.color='white'; this.style.borderColor='#25d366';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 32 32" style="width:16px; height:16px;"><path fill="currentColor" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                        واتساب
                    </a>

                    <!-- Telegram -->
                    <a id="news_share_tg" href="" target="_blank" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; text-decoration:none; font-size:13px; font-weight:700; transition:all 0.3s;" onmouseover="this.style.background='#0088cc'; this.style.color='white'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.61l-1.92 9.07c-.14.63-.52.79-1.04.5l-2.93-2.16-1.41 1.36c-.16.16-.29.29-.6.29l.21-3 5.46-4.93c.24-.22-.05-.34-.37-.13l-6.75 4.25-2.9-.91c-.63-.2-.64-.63.13-.93l11.35-4.38c.53-.19.99.13.82.93z"/></svg>
                        تلجرام
                    </a>

                    <!-- Instagram -->
                    <button id="news_share_ig" onclick="copyNewsShareLink()" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#e1306c'; this.style.color='white'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px;"><path fill="currentColor" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0 3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        انستجرام
                    </button>

                    <!-- Copy Link -->
                    <button onclick="copyNewsShareLink()" style="display:inline-flex; align-items:center; gap:8px; padding:6px 14px; border-radius:6px; border:1px solid #d1d5db; background:#fff; color:#4b5563; font-size:13px; font-weight:700; transition:all 0.3s; cursor:pointer;" onmouseover="this.style.background='#1c7f7c'; this.style.color='white'; this.style.borderColor='#1c7f7c';" onmouseout="this.style.background='#fff'; this.style.color='#4b5563'; this.style.borderColor='#d1d5db';">
                        <svg viewBox="0 0 24 24" style="width:16px; height:16px; fill:none; stroke:currentColor; stroke-width:2.5; stroke-linecap:round; stroke-linejoin:round;"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                        نسخ الرابط
                    </button>
                </div>
            </div>
        </div>

        <!-- أسفل المودال -->
        <div style="background:#f8fafc; padding:15px 25px; display:flex; justify-content:flex-end; gap:12px; border-top:1px solid #edf2f7;">
            <button onclick="closeLatestNewsModal()" class="modal-btn-primary" style="background:#1c7f7c; border-color:#1c7f7c;"><i class="fa-solid fa-house" style="margin-left: 5px;"></i> العودة للصفحة الرئيسية</button>
            <button onclick="closeLatestNewsModal()" class="modal-btn-secondary">إغلاق النافذة</button>
        </div>
    </div>
</div>

<script>
window.currentNewsShareUrl = "";
function copyNewsShareLink() {
    if (window.currentNewsShareUrl) {
        navigator.clipboard.writeText(window.currentNewsShareUrl).then(function() {
            alert("تم نسخ رابط الخبر بنجاح!");
        }).catch(function() {
            var tempInput = document.createElement("input");
            tempInput.value = window.currentNewsShareUrl;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            alert("تم نسخ رابط الخبر بنجاح!");
        });
    }
}

function openLatestNewsModal(news) {
    document.getElementById('news_modal_title').innerText = news.title;
    document.getElementById('news_modal_badge').innerText = news.badge || 'أخرى';
    document.getElementById('news_modal_date').innerText = news.date;
    document.getElementById('news_modal_desc').innerText = news.content;
    
    var viewer = document.getElementById('news_modal_media_viewer');
    var thumbs = document.getElementById('news_modal_media_thumbnails');
    
    viewer.innerHTML = "";
    thumbs.innerHTML = "";
    
    var mediaList = [];
    
    // إضافة الصور
    if (news.images && Array.isArray(news.images)) {
        news.images.forEach(function(img, index) {
            mediaList.push({ type: 'image', url: img });
        });
    } else if (news.image && news.image.trim() !== '') {
        mediaList.push({ type: 'image', url: news.image });
    }
    
    // إضافة الفيديو (يدعم كلاً من يوتيوب وروابط الفيديوهات المحلية MP4)
    if (news.video_path && news.video_path.trim() !== '') {
        mediaList.push({ type: 'video', url: news.video_path });
    }
    
    if (mediaList.length === 0) {
        var fallbackGrad = news.gradient || "linear-gradient(135deg,var(--main-color),var(--main-color))";
        var fallbackIcon = news.icon || "🎉";
        viewer.innerHTML = `<div style="width:100%; height:100%; background:${fallbackGrad}; display:flex; align-items:center; justify-content:center; color:white; font-size:70px;">${fallbackIcon}</div>`;
        document.getElementById('news_modal_media_gallery_wrapper').style.display = 'none';
    } else {
        document.getElementById('news_modal_media_gallery_wrapper').style.display = 'block';
        
        mediaList.forEach(function(media, index) {
            var thumbBtn = document.createElement('div');
            thumbBtn.style.width = '70px';
            thumbBtn.style.height = '50px';
            thumbBtn.style.borderRadius = '8px';
            thumbBtn.style.overflow = 'hidden';
            thumbBtn.style.cursor = 'pointer';
            thumbBtn.style.border = '2px solid #e2e8f0';
            thumbBtn.style.transition = '0.2s';
            thumbBtn.style.position = 'relative';
            thumbBtn.style.background = '#000';
            
            if (media.type === 'image') {
                thumbBtn.innerHTML = `<img src="${media.url}" style="width:100%; height:100%; object-fit:cover;">`;
            } else {
                thumbBtn.innerHTML = `<div style="width:100%; height:100%; background:var(--main-color); display:flex; align-items:center; justify-content:center; color:white;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="currentColor"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                </div>`;
            }
            
            thumbBtn.onclick = function() {
                var children = thumbs.children;
                for (var i = 0; i < children.length; i++) {
                    children[i].style.borderColor = '#e2e8f0';
                    children[i].style.transform = 'none';
                }
                
                thumbBtn.style.borderColor = '#1c7f7c';
                thumbBtn.style.transform = 'scale(1.05)';
                
                if (media.type === 'image') {
                    viewer.innerHTML = `<img src="${media.url}" style="max-width:100%; max-height:100%; width:auto; height:auto; object-fit:contain; animation: fadeIn 0.3s ease-in-out;">
                    <a href="${media.url}" download="${media.url.substring(media.url.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                        حفظ الصورة
                    </a>`;
                } else {
                    var videoUrl = media.url;
                    if (videoUrl.includes('youtube.com') || videoUrl.includes('youtu.be')) {
                        var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
                        var match = videoUrl.match(regExp);
                        var videoId = (match && match[2].length == 11) ? match[2] : null;
                        
                        if (videoId) {
                            viewer.innerHTML = `<iframe src="https://www.youtube.com/embed/${videoId}?autoplay=1" style="width:100%; height:100%; border:none;" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                            <a href="https://ssyoutube.com/watch?v=${videoId}" target="_blank" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                حفظ الفيديو
                            </a>`;
                        } else {
                            viewer.innerHTML = `<div style="padding:20px; text-align:center; color:#e53e3e;">رابط يوتيوب غير صالح</div>`;
                        }
                    } else {
                        viewer.innerHTML = `<video src="${videoUrl}" controls autoplay style="width:100%; height:100%; background:#000;"></video>
                        <a href="${videoUrl}" download="${videoUrl.substring(videoUrl.lastIndexOf('/') + 1)}" style="position:absolute; top:12px; right:12px; background:rgba(0,128,128,0.9); color:white; border:none; padding:8px 15px; border-radius:8px; font-size:12.5px; font-weight:bold; cursor:pointer; display:inline-flex; align-items:center; gap:6px; text-decoration:none; backdrop-filter:blur(2px); transition:0.3s; z-index:10; box-shadow:0 4px 12px rgba(0,0,0,0.25);" onmouseover="this.style.background='#1c7f7c'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='rgba(0,128,128,0.9)'; this.style.transform='none';">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                            حفظ الفيديو
                        </a>`;
                    }
                }
            };
            
            thumbs.appendChild(thumbBtn);
            
            if (index === 0) {
                thumbBtn.click();
            }
        });
    }
    
    var shareUrl = window.location.origin + window.location.pathname + '?p=latest_news&id=' + news.id;
    var shareTitle = news.title + ' - كلية سماء المتميزين';
    
    window.currentNewsShareUrl = shareUrl;
    
    document.getElementById('news_share_fb').href = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
    document.getElementById('news_share_tw').href = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    document.getElementById('news_share_wa').href = 'https://api.whatsapp.com/send?text=' + encodeURIComponent(shareTitle + ': ' + shareUrl);
    document.getElementById('news_share_tg').href = 'https://t.me/share/url?url=' + encodeURIComponent(shareUrl) + '&text=' + encodeURIComponent(shareTitle);
    
    document.getElementById('latestNewsDetailsModal').style.display = 'flex';
}

function closeLatestNewsModal() {
    var viewer = document.getElementById('news_modal_media_viewer');
    if (viewer) viewer.innerHTML = "";
    document.getElementById('latestNewsDetailsModal').style.display = 'none';
}

window.addEventListener('click', function(e) {
    var modal = document.getElementById('latestNewsDetailsModal');
    if (e.target == modal) {
        closeLatestNewsModal();
    }
});
</script>
<script src="script.js?v=<?php echo time(); ?>"></script>
</body>
</html>