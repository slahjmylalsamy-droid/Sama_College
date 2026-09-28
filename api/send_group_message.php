<?php
header('Content-Type: application/json');
require_once '../db_connect.php';

// التحقق من تسجيل الدخول
if (!isset($_SESSION['user_id'])) {
    echo json_encode(['status' => 'error', 'message' => 'يجب تسجيل الدخول أولاً.']);
    exit();
}

$user_id = intval($_SESSION['user_id']);
$user_role = $_SESSION['role'];
$user_permission = intval($_SESSION['permission'] ?? 1);

// جلب بارامترات المدخلات
$group_name = isset($_POST['group_name']) ? mysqli_real_escape_string($conn, $_POST['group_name']) : '';
$message_text = isset($_POST['message_text']) ? mysqli_real_escape_string($conn, $_POST['message_text']) : '';
$message_type = isset($_POST['message_type']) ? mysqli_real_escape_string($conn, $_POST['message_type']) : 'text';

if (empty($group_name)) {
    echo json_encode(['status' => 'error', 'message' => 'اسم المجموعة مطلوب.']);
    exit();
}

// 1. التحقق من الصلاحيات والوصول للمجموعة
$has_access = false;

// التحقق من التعيين اليدوي أولاً
$manual_check = mysqli_query($conn, "SELECT id FROM group_manual_members WHERE group_name = '$group_name' AND user_id = $user_id");
if ($manual_check && mysqli_num_rows($manual_check) > 0) {
    $has_access = true;
}

if (!$has_access) {
    if ($user_role === 'student') {
        // جلب قسم ومستوى الطالب الحالي
        $u_query = mysqli_query($conn, "SELECT department, level FROM users WHERE id = $user_id");
        $u_data = mysqli_fetch_assoc($u_query);
        $student_group = trim(($u_data['department'] ?? '') . ' - ' . ($u_data['level'] ?? ''));
        
        // الطلاب لا يمكنهم الإرسال لمجموعة الكادر
        if ($group_name === 'كادر الكلية') {
            echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالوصول لمجموعة كادر الكلية.']);
            exit();
        }
        
        // الطلاب لا يمكنهم الإرسال لمجموعة غير مجموعتهم
        if (trim($group_name) !== $student_group) {
            echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالإرسال لمجموعة غير تخصصك ومستواك.']);
            exit();
        }
        
        // الطلاب لا يمكنهم إرسال إعلان رسمي
        if ($message_type === 'announcement') {
            $message_type = 'text'; // تحويلها لرسالة عادية
        }
    } elseif ($user_role === 'staff' && $user_permission < 3) {
        // للمدرسين (مستوى صلاحية 2):
        if ($group_name !== 'كادر الكلية') {
            $allowed_groups = [];
            $l_query = mysqli_query($conn, "
                SELECT DISTINCT s.department, s.level 
                FROM lectures l 
                JOIN subjects s ON l.subject_id = s.id 
                WHERE l.uploaded_by = $user_id
            ");
            while ($row = mysqli_fetch_assoc($l_query)) {
                $allowed_groups[] = trim($row['department'] . ' - ' . $row['level']);
            }
            
            if (!in_array(trim($group_name), $allowed_groups)) {
                echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالإرسال لهذه المجموعة (أنت لا تدرس هذا التخصص).']);
                exit();
            }
        }
    }
}
    // المدرس لا يمكنه إرسال اعتراض
    if ($message_type === 'objection') {
        $message_type = 'text';
    }
}

// 2. معالجة رفع الملفات والمرفقات أو التسجيل الصوتي
$attachment_path = null;

if (isset($_FILES['attachment']) && $_FILES['attachment']['error'] === UPLOAD_ERR_OK) {
    $file = $_FILES['attachment'];
    $filename = $file['name'];
    $tmp_name = $file['tmp_name'];
    $size = $file['size'];
    
    // التحقق من الحجم (أقصى حد 15 ميجابايت)
    if ($size > 15 * 1024 * 1024) {
        echo json_encode(['status' => 'error', 'message' => 'حجم الملف كبير جداً. الحد الأقصى 15 ميجابايت.']);
        exit();
    }
    
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
    
    if ($message_type === 'voice') {
        // التحقق من امتدادات الصوت
        $allowed_voice = ['wav', 'mp3', 'webm', 'ogg', 'm4a'];
        if (!in_array($ext, $allowed_voice)) {
            // في تسجيلات الجوال قد يتم رفعها كـ blob بدون امتداد واضح، نعطيها افتراضياً wav
            if (empty($ext)) {
                $ext = 'wav';
            } else {
                echo json_encode(['status' => 'error', 'message' => 'صيغة التسجيل الصوتي غير مدعومة.']);
                exit();
            }
        }
        
        $dest_dir = '../uploads/group_voice/';
        $new_filename = 'voice_' . time() . '_' . rand(1000, 9999) . '.' . $ext;
        $attachment_path = 'uploads/group_voice/' . $new_filename;
    } else {
        // التحقق من امتدادات الملفات العامة
        $allowed_exts = ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'zip', 'rar'];
        if (!in_array($ext, $allowed_exts)) {
            echo json_encode(['status' => 'error', 'message' => 'امتداد الملف المرفق غير مسموح به.']);
            exit();
        }
        
        $dest_dir = '../uploads/group_attachments/';
        $new_filename = 'attach_' . time() . '_' . rand(1000, 9999) . '_' . preg_replace('/[^a-zA-Z0-9_.-]/', '', $filename);
        $attachment_path = 'uploads/group_attachments/' . $new_filename;
    }
    
    // نقل الملف المرفوع
    if (!move_uploaded_file($tmp_name, $dest_dir . $new_filename)) {
        echo json_encode(['status' => 'error', 'message' => 'فشل رفع الملف إلى الخادم.']);
        exit();
    }
}

// 3. التحقق من توفر نص أو مرفق لمنع إرسال رسالة فارغة
if (empty($message_text) && empty($attachment_path)) {
    echo json_encode(['status' => 'error', 'message' => 'لا يمكن إرسال رسالة فارغة.']);
    exit();
}

// 4. حفظ الرسالة في قاعدة البيانات
$sql = "INSERT INTO group_messages (group_name, sender_id, message_text, attachment_path, message_type)
        VALUES ('$group_name', $user_id, ";
$sql .= (!empty($message_text) ? "'$message_text'" : "NULL") . ", ";
$sql .= (!empty($attachment_path) ? "'$attachment_path'" : "NULL") . ", ";
$sql .= "'$message_type')";

if (mysqli_query($conn, $sql)) {
    $inserted_id = mysqli_insert_id($conn);
    echo json_encode([
        'status' => 'success',
        'message' => 'تم إرسال الرسالة بنجاح.',
        'message_id' => $inserted_id,
        'attachment_path' => $attachment_path
    ]);
} else {
    echo json_encode(['status' => 'error', 'message' => 'خطأ في حفظ الرسالة: ' . mysqli_error($conn)]);
}
?>
