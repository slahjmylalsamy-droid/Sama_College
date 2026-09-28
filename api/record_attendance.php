<?php
// api/record_attendance.php - واجهة برمجية لاستقبال حركات البصمة الحقيقية من البرنامج الوسيط على اللابتوب
require_once '../db_connect.php';

header('Content-Type: application/json; charset=utf-8');

// التحقق من استقبال البيانات المطلوبة (رقم البصمة UID)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // استقبال البيانات سواء كانت JSON أو Form Post
    $json_data = json_decode(file_get_contents('php://input'), true);
    
    $uid = isset($json_data['uid']) ? mysqli_real_escape_string($conn, $json_data['uid']) : '';
    if (empty($uid) && isset($_POST['uid'])) {
        $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    }
    
    if (empty($uid)) {
        echo json_encode(['success' => false, 'message' => 'عذراً، لم يتم إرسال رقم البصمة UID']);
        exit();
    }
    
    $now = date('Y-m-d H:i:s');
    $date_today = date('Y-m-d');
    $time_now = date('H:i:s');
    
    // البحث عن المستخدم المرتبط برقم البصمة UID
    $user_query = mysqli_query($conn, "SELECT id, full_name, role FROM users WHERE uid = '$uid'");
    if (!$user_query || mysqli_num_rows($user_query) === 0) {
        echo json_encode(['success' => false, 'message' => "رقم البصمة ($uid) غير مسجل لأي مستخدم في قاعدة البيانات"]);
        exit();
    }
    
    $user = mysqli_fetch_assoc($user_query);
    $user_id = $user['id'];
    $name = $user['full_name'];
    $role = $user['role'];
    
    if ($role === 'staff') {
        // معالجة حضور الموظف وتطبيق الخصومات المحاسبية والإشعارات تلقائياً
        $res = processEmployeeAttendance($user_id, $now);
        
        if ($res['status'] === 'exists') {
            echo json_encode([
                'success' => false, 
                'message' => "الموظف {$name} مسجل حضور مسبقاً لهذا اليوم"
            ]);
        } elseif ($res['status'] === 'error') {
            echo json_encode(['success' => false, 'message' => 'حدث خطأ في النظام أثناء المعالجة']);
        } else {
            $msg = "تم تسجيل حضور الموظف {$name} بنجاح.";
            if ($res['status'] === 'late') {
                $msg .= " دوام متأخر. دقائق التأخير: {$res['delay']} دقيقة. الخصم المحتسب: {$res['deduction']} ريال.";
            }
            echo json_encode([
                'success' => true,
                'message' => $msg,
                'details' => $res
            ]);
        }
    } else {
        // معالجة حضور الطالب بالبصمة
        $att_check = mysqli_query($conn, "SELECT id FROM student_attendance WHERE student_id = $user_id AND date = '$date_today'");
        if (mysqli_num_rows($att_check) > 0) {
            echo json_encode([
                'success' => false,
                'message' => "الطالب {$name} مسجل حضور مسبقاً لهذا اليوم"
            ]);
        } else {
            mysqli_query($conn, "CREATE TABLE IF NOT EXISTS student_attendance (
                id INT AUTO_INCREMENT PRIMARY KEY,
                student_id INT NOT NULL,
                date DATE NOT NULL,
                time TIME NOT NULL,
                status ENUM('present', 'absent') DEFAULT 'present',
                FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
            )");
            
            $ins = mysqli_query($conn, "INSERT INTO student_attendance (student_id, date, time, status) VALUES ($user_id, '$date_today', '$time_now', 'present')");
            if ($ins) {
                echo json_encode([
                    'success' => true,
                    'message' => "تم تسجيل حضور الطالب {$name} بنجاح في تمام الساعة {$time_now}"
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'فشل تسجيل حضور الطالب']);
            }
        }
    }
} else {
    echo json_encode(['success' => false, 'message' => 'عذراً، يجب استخدام طلبات POST لإرسال حركات البصمة']);
}
?>
