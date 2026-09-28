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

// جلب بارامترات الطلب
$group_name = isset($_GET['group']) ? mysqli_real_escape_string($conn, $_GET['group']) : '';
$last_id = isset($_GET['last_id']) ? intval($_GET['last_id']) : 0;

if (empty($group_name)) {
    echo json_encode(['status' => 'error', 'message' => 'اسم المجموعة غير محدد.']);
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
        
        // الطلاب لا يمكنهم الوصول لمجموعة الكادر
        if ($group_name === 'كادر الكلية') {
            echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالوصول لمجموعة كادر الكلية.']);
            exit();
        }
        
        // الطلاب لا يمكنهم قراءة رسائل مجموعة أخرى غير مجموعتهم
        if (trim($group_name) !== $student_group) {
            echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالوصول لمجموعة غير تخصصك ومستواك.']);
            exit();
        }
    } elseif ($user_role === 'staff' && $user_permission < 3) {
        // للمدرسين (مستوى صلاحية 2):
        // يسمح لهم بالوصول لمجموعة "كادر الكلية"
        // ويسمح لهم بالوصول فقط لمجموعات المواد التي يدرسونها (المواد التي قاموا برفع محاضرات لها مسبقاً)
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
                echo json_encode(['status' => 'error', 'message' => 'غير مصرح لك بالوصول لهذه المجموعة (أنت لا تدرس هذا التخصص).']);
                exit();
            }
        }
    }
}
// المدراء والأدمن والعمادة (صلاحيات >= 3): يسمح لهم بالوصول لجميع المجموعات بلا قيود.

// 2. جلب الرسائل
$query = "
    SELECT gm.*, u.full_name AS sender_name, u.role AS sender_role, u.permission_level AS sender_permission, u.image AS sender_image
    FROM group_messages gm
    JOIN users u ON gm.sender_id = u.id
    WHERE gm.group_name = '$group_name' AND gm.id > $last_id
    ORDER BY gm.id ASC
";

$result = mysqli_query($conn, $query);
$messages = [];

if ($result) {
    while ($row = mysqli_fetch_assoc($result)) {
        // تنسيق الوقت
        $time = date('h:i A', strtotime($row['created_at']));
        $time = str_replace(['AM', 'PM'], ['ص', 'م'], $time);
        
        $messages[] = [
            'id' => intval($row['id']),
            'sender_id' => intval($row['sender_id']),
            'sender_name' => htmlspecialchars($row['sender_name']),
            'sender_role' => $row['sender_role'],
            'sender_permission' => intval($row['sender_permission']),
            'sender_image' => $row['sender_image'],
            'message_text' => htmlspecialchars($row['message_text']),
            'attachment_path' => $row['attachment_path'],
            'message_type' => $row['message_type'],
            'time' => $time,
            'is_me' => (intval($row['sender_id']) === $user_id)
        ];
    }
}

echo json_encode(['status' => 'success', 'messages' => $messages]);
?>
