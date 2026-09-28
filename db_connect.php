<?php

// db_connect.php - اتصال قاعدة البيانات

$host = "localhost";

$user = "root";

$password = "";

$database = "sama_college";



$conn = mysqli_connect($host, $user, $password, $database);



if (!$conn) {

die("فشل الاتصال بقاعدة البيانات: " . mysqli_connect_error());

}



mysqli_set_charset($conn, "utf8mb4");



if (session_status() === PHP_SESSION_NONE) {

session_start();

}



// ============================================================

// دوال مساعدة للاستخدام في جميع أنحاء النظام

// ============================================================



// دالة لإضافة إشعار للمستخدم

function addNotification($user_id, $message) {

global $conn;

$message = mysqli_real_escape_string($conn, $message);

$query = "INSERT INTO notifications (user_id, message) VALUES ($user_id, '$message')";

return mysqli_query($conn, $query);

}



// دالة لجلب إشعارات المستخدم (غير المقروءة)

function getUnreadNotifications($user_id) {

global $conn;

$query = "SELECT * FROM notifications WHERE user_id = $user_id AND is_read = FALSE ORDER BY created_at DESC";

return mysqli_query($conn, $query);

}



// دالة لتحديد ما إذا كان الطالب مدفوعاً

function isStudentPaid($user_id) {

global $conn;

$query = "SELECT payment_status FROM users WHERE id = $user_id";

$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {

return $row['payment_status'] === 'paid';

}

return false;

}



// إضافة عمود الترم (semester) لجدول المستخدمين إن لم يكن موجوداً

$check_semester_column = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'semester'");

if ($check_semester_column && mysqli_num_rows($check_semester_column) == 0) {

mysqli_query($conn, "ALTER TABLE users ADD COLUMN semester VARCHAR(50) DEFAULT 'الترم الأول'");

}

// إضافة عمود نوع الكادر (staff_type) لجدول المستخدمين إن لم يكن موجوداً
$check_staff_type = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'staff_type'");
if ($check_staff_type && mysqli_num_rows($check_staff_type) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN staff_type ENUM('administrative', 'academic') DEFAULT 'administrative'");
}

// إضافة عمود الصلاحيات التفصيلية (page_permissions) لجدول المستخدمين إن لم يكن موجوداً
$check_permissions_col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'page_permissions'");
if ($check_permissions_col && mysqli_num_rows($check_permissions_col) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN page_permissions TEXT DEFAULT NULL");
}



// ============================================================

// إنشاء جداول تعديل المحتوى والإعدادات تلقائياً إن لم تكن موجودة

// ============================================================



// 1. جدول الإعدادات العامة (مثل حجم الشعار والسلايدر)

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS site_settings (

id INT AUTO_INCREMENT PRIMARY KEY,

setting_key VARCHAR(50) NOT NULL UNIQUE,

setting_value LONGTEXT NOT NULL

)");



// 2. جدول محتوى الصفحات الديناميكية

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS site_pages (

id INT AUTO_INCREMENT PRIMARY KEY,

page_key VARCHAR(50) NOT NULL UNIQUE,

page_title VARCHAR(100) NOT NULL,

page_content LONGTEXT NOT NULL,

updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP

)");



// دالة جلب الإعداد مع حفظ القيمة الافتراضية

function get_setting($key, $default) {

global $conn;

$res = mysqli_query($conn, "SELECT setting_value FROM site_settings WHERE setting_key = '" . mysqli_real_escape_string($conn, $key) . "'");

if ($res && mysqli_num_rows($res) > 0) {

$row = mysqli_fetch_assoc($res);

return $row['setting_value'];

}

// حفظ القيمة الافتراضية

mysqli_query($conn, "INSERT IGNORE INTO site_settings (setting_key, setting_value) VALUES ('" . mysqli_real_escape_string($conn, $key) . "', '" . mysqli_real_escape_string($conn, $default) . "')");

return $default;

}



// 3. جدول التقويم الجامعي الرسمي

mysqli_query($conn, "CREATE TABLE IF NOT EXISTS academic_calendar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_name VARCHAR(255) NOT NULL,
    hijri_date VARCHAR(100) NULL,
    event_date VARCHAR(100) NOT NULL,
    status VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    branch VARCHAR(50) NOT NULL DEFAULT 'main'
)");

// التأكد من تحديث الأعمدة إذا كان الجدول موجوداً مسبقاً
$check_hijri = mysqli_query($conn, "SHOW COLUMNS FROM academic_calendar LIKE 'hijri_date'");
if (mysqli_num_rows($check_hijri) == 0) {
    mysqli_query($conn, "ALTER TABLE academic_calendar ADD COLUMN hijri_date VARCHAR(100) NULL AFTER event_name");
}

$check_branch = mysqli_query($conn, "SHOW COLUMNS FROM academic_calendar LIKE 'branch'");
if (mysqli_num_rows($check_branch) == 0) {
    mysqli_query($conn, "ALTER TABLE academic_calendar ADD COLUMN branch VARCHAR(50) NOT NULL DEFAULT 'main' AFTER category");
}

// تعبئة التقويم بالبيانات الافتراضية إذا كان فارغاً
$cal_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM academic_calendar");
$cal_count = $cal_check ? mysqli_fetch_assoc($cal_check)['count'] : 0;

if ($cal_count == 0) {
    $default_events = [
        // الفرع الرئيسي
        ["بدء عملية القبول والتسجيل للعام الجديد", "17 صفر 1448 هـ", "1 أغسطس 2026 م", "نشط حالياً", "semester1", "main"],
        ["بدء الدراسة للفصل الدراسي الأول", "30 صفر 1448 هـ", "12 سبتمبر 2026 م", "قريباً", "semester1", "main"],
        ["امتحانات نهاية الفصل الدراسي الأول", "23 رجب 1448 هـ", "2 يناير 2027 م", "قريباً", "semester1 exams", "main"],
        ["بدء إجازة منتصف العام الأكاديمي", "7 شعبان 1448 هـ", "16 يناير 2027 م", "قريباً", "vacations", "main"],
        ["بدء الدراسة للفصل الدراسي الثاني", "28 شعبان 1448 هـ", "6 فبراير 2027 م", "قريباً", "semester2", "main"],
        ["امتحانات نهاية الفصل الدراسي الثاني", "29 ذو القعدة 1448 هـ", "5 يونيو 2027 م", "قريباً", "semester2 exams", "main"],

        // فرع الراهدة
        ["بدء عملية القبول والتسجيل للعام الجديد - فرع الراهدة", "17 صفر 1448 هـ", "1 أغسطس 2026 م", "نشط حالياً", "semester1", "rahdah"],
        ["بدء الدراسة للفصل الدراسي الأول - فرع الراهدة", "30 صفر 1448 هـ", "12 سبتمبر 2026 م", "قريباً", "semester1", "rahdah"],
        ["امتحانات نهاية الفصل الدراسي الأول - فرع الراهدة", "23 رجب 1448 هـ", "2 يناير 2027 م", "قريباً", "semester1 exams", "rahdah"],
        ["بدء إجازة منتصف العام الأكاديمي - فرع الراهدة", "7 شعبان 1448 هـ", "16 يناير 2027 م", "قريباً", "vacations", "rahdah"],
        ["بدء الدراسة للفصل الدراسي الثاني - فرع الراهدة", "28 شعبان 1448 هـ", "6 فبراير 2027 م", "قريباً", "semester2", "rahdah"],
        ["امتحانات نهاية الفصل الدراسي الثاني - فرع الراهدة", "29 ذو القعدة 1448 هـ", "5 يونيو 2027 م", "قريباً", "semester2 exams", "rahdah"]
    ];

    foreach ($default_events as $ev) {
        $name = mysqli_real_escape_string($conn, $ev[0]);
        $hijri = mysqli_real_escape_string($conn, $ev[1]);
        $date = mysqli_real_escape_string($conn, $ev[2]);
        $status = mysqli_real_escape_string($conn, $ev[3]);
        $cat = mysqli_real_escape_string($conn, $ev[4]);
        $branch = mysqli_real_escape_string($conn, $ev[5]);
        mysqli_query($conn, "INSERT INTO academic_calendar (event_name, hijri_date, event_date, status, category, branch) VALUES ('$name', '$hijri', '$date', '$status', '$cat', '$branch')");
    }
} else {
    // إذا كان هناك بيانات سابقة ولكن لا توجد بيانات لفرع الراهدة، نقوم بإضافة فرع الراهدة
    $rahdah_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM academic_calendar WHERE branch='rahdah'");
    $rahdah_count = $rahdah_check ? mysqli_fetch_assoc($rahdah_check)['count'] : 0;
    if ($rahdah_count == 0) {
        $rahdah_events = [
            ["بدء عملية القبول والتسجيل للعام الجديد - فرع الراهدة", "17 صفر 1448 هـ", "1 أغسطس 2026 م", "نشط حالياً", "semester1", "rahdah"],
            ["بدء الدراسة للفصل الدراسي الأول - فرع الراهدة", "30 صفر 1448 هـ", "12 سبتمبر 2026 م", "قريباً", "semester1", "rahdah"],
            ["امتحانات نهاية الفصل الدراسي الأول - فرع الراهدة", "23 رجب 1448 هـ", "2 يناير 2027 م", "قريباً", "semester1 exams", "rahdah"],
            ["بدء إجازة منتصف العام الأكاديمي - فرع الراهدة", "7 شعبان 1448 هـ", "16 يناير 2027 م", "قريباً", "vacations", "rahdah"],
            ["بدء الدراسة للفصل الدراسي الثاني - فرع الراهدة", "28 شعبان 1448 هـ", "6 فبراير 2027 م", "قريباً", "semester2", "rahdah"],
            ["امتحانات نهاية الفصل الدراسي الثاني - فرع الراهدة", "29 ذو القعدة 1448 هـ", "5 يونيو 2027 م", "قريباً", "semester2 exams", "rahdah"]
        ];
        foreach ($rahdah_events as $ev) {
            $name = mysqli_real_escape_string($conn, $ev[0]);
            $hijri = mysqli_real_escape_string($conn, $ev[1]);
            $date = mysqli_real_escape_string($conn, $ev[2]);
            $status = mysqli_real_escape_string($conn, $ev[3]);
            $cat = mysqli_real_escape_string($conn, $ev[4]);
            $branch = mysqli_real_escape_string($conn, $ev[5]);
            mysqli_query($conn, "INSERT INTO academic_calendar (event_name, hijri_date, event_date, status, category, branch) VALUES ('$name', '$hijri', '$date', '$status', '$cat', '$branch')");
        }
    }
}

// 4. جدول الشكاوى والمقترحات
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS complaints (
    id INT AUTO_INCREMENT PRIMARY KEY,
    reference_code VARCHAR(50) NOT NULL UNIQUE,
    sender_name VARCHAR(100) NULL,
    sender_phone VARCHAR(50) NULL,
    sender_email VARCHAR(100) NULL,
    sender_type VARCHAR(50) NOT NULL,
    category VARCHAR(50) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    status VARCHAR(50) DEFAULT 'قيد المراجعة',
    admin_response TEXT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// 5. جدول الفعاليات والأنشطة
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    event_date DATE NOT NULL,
    location VARCHAR(150) NULL,
    image_path VARCHAR(255) NULL,
    image2_path VARCHAR(255) NULL,
    image3_path VARCHAR(255) NULL,
    video_path VARCHAR(255) NULL,
    category VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// إضافة أعمدة معرض الصور والفيديو لجدول الفعاليات إن لم تكن موجودة
$check_img2 = mysqli_query($conn, "SHOW COLUMNS FROM events LIKE 'image2_path'");
if ($check_img2 && mysqli_num_rows($check_img2) == 0) {
    mysqli_query($conn, "ALTER TABLE events ADD COLUMN image2_path VARCHAR(255) DEFAULT NULL");
}
$check_img3 = mysqli_query($conn, "SHOW COLUMNS FROM events LIKE 'image3_path'");
if ($check_img3 && mysqli_num_rows($check_img3) == 0) {
    mysqli_query($conn, "ALTER TABLE events ADD COLUMN image3_path VARCHAR(255) DEFAULT NULL");
}
$check_vid = mysqli_query($conn, "SHOW COLUMNS FROM events LIKE 'video_path'");
if ($check_vid && mysqli_num_rows($check_vid) == 0) {
    mysqli_query($conn, "ALTER TABLE events ADD COLUMN video_path VARCHAR(255) DEFAULT NULL");
}

// تعبئة الفعاليات بالبيانات الافتراضية إذا كان الجدول فارغاً
$events_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM events");
$events_count = $events_check ? mysqli_fetch_assoc($events_check)['count'] : 0;
if ($events_count == 0) {
    $default_events = [
        [
            "🎉 حفل استقبال الطلاب الجدد وتكريم أوائل الكلية",
            "تقيم إدارة الكلية الحفل السنوي لاستقبال الطلاب الجدد الملتحقين بالعام الدراسي الجديد 2026/2027، وتكريم الطلاب الأوائل والمتميزين في مختلف الأقسام العلمية للعام السابق، تشجيعاً لهم على مواصلة التميز والإبداع والابتكار.",
            "2026-09-15",
            "القاعة الكبرى بالكلية - الدور الثاني",
            "images/slider_campus.jpg",
            "images/campus1.jpg",
            "images/campus2.jpg",
            "https://www.w3schools.com/html/mov_bbb.mp4",
            "حفلات ومناسبات"
        ],
        [
            "💻 ورشة عمل: الذكاء الاصطناعي وتطبيقاته في البرمجة الحديثة",
            "ورشة عمل تفاعلية مكثفة تهدف إلى تقديم أساسيات أدوات الذكاء الاصطناعي المساعدة في البرمجة وكيفية دمجها في بيئة العمل البرمجية لتحسين الإنتاجية وتطوير البرمجيات بكفاءة عالية بما يواكب التطور التكنولوجي المعاصر.",
            "2026-10-10",
            "معمل الحاسوب المركزي - مبنى التقنية",
            "images/slider_mission.jpg",
            "images/hero_img1.png",
            "images/img1.jpg",
            "https://www.w3schools.com/html/movie.mp4",
            "ورش عمل"
        ],
        [
            "🏆 البطولة الرياضية السنوية لكرة القدم الخماسية",
            "تنطلق منافسات البطولة الرياضية السنوية لكرة القدم الخماسية بين طلاب الأقسام المختلفة بالكلية، بهدف تعزيز الروح الرياضية والأنشطة البدنية والترابط الإيجابي بين طلاب التخصصات الطبية والتقنية.",
            "2026-11-05",
            "الملعب الرياضي الرئيسي للكلية",
            "images/slider_vision.jpg",
            "images/hero_img2.png",
            "images/news_launch.jpg",
            "https://www.w3schools.com/html/mov_bbb.mp4",
            "أنشطة رياضية"
        ]
    ];
    foreach ($default_events as $ev) {
        $title = mysqli_real_escape_string($conn, $ev[0]);
        $desc = mysqli_real_escape_string($conn, $ev[1]);
        $date = mysqli_real_escape_string($conn, $ev[2]);
        $loc = mysqli_real_escape_string($conn, $ev[3]);
        $img1 = mysqli_real_escape_string($conn, $ev[4]);
        $img2 = mysqli_real_escape_string($conn, $ev[5]);
        $img3 = mysqli_real_escape_string($conn, $ev[6]);
        $vid = mysqli_real_escape_string($conn, $ev[7]);
        $cat = mysqli_real_escape_string($conn, $ev[8]);
        
        mysqli_query($conn, "INSERT INTO events (title, description, event_date, location, image_path, image2_path, image3_path, video_path, category) 
                             VALUES ('$title', '$desc', '$date', '$loc', '$img1', '$img2', '$img3', '$vid', '$cat')");
    }
}

// ============================================================
// 6. تهيئة وتحديث قاعدة بيانات الحضور والمحاسبة تلقائياً
// ============================================================

// أ. تحديث جدول المستخدمين بإضافة أعمدة البصمة، الراتب، وساعات الدوام
$check_uid_col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'uid'");
if ($check_uid_col && mysqli_num_rows($check_uid_col) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN uid VARCHAR(20) NULL AFTER student_id");
}

$check_salary_col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'base_salary'");
if ($check_salary_col && mysqli_num_rows($check_salary_col) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN base_salary DECIMAL(10,2) DEFAULT 0.00 AFTER role");
}

$check_start_col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'work_start_time'");
if ($check_start_col && mysqli_num_rows($check_start_col) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN work_start_time TIME DEFAULT '08:00:00'");
}

$check_end_col = mysqli_query($conn, "SHOW COLUMNS FROM users LIKE 'work_end_time'");
if ($check_end_col && mysqli_num_rows($check_end_col) == 0) {
    mysqli_query($conn, "ALTER TABLE users ADD COLUMN work_end_time TIME DEFAULT '14:00:00'");
}

// ب. إنشاء جدول الحضور والانصراف للموظفين
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS employee_attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    date DATE NOT NULL,
    check_in TIME NULL,
    check_out TIME NULL,
    status ENUM('present', 'late', 'absent') DEFAULT 'present',
    delay_minutes INT DEFAULT 0,
    deduction_amount DECIMAL(10,2) DEFAULT 0.00,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
)");

// ج. إنشاء جدول سياسات حضور الموظفين
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS attendance_policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    policy_name VARCHAR(100) NOT NULL,
    grace_period_minutes INT DEFAULT 15,
    penalty_per_minute DECIMAL(10, 2) DEFAULT 50.00
)");

// د. تعبئة سياسة الحضور الافتراضية إذا كانت فارغة
$policy_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM attendance_policies");
$policy_count = $policy_check ? mysqli_fetch_assoc($policy_check)['count'] : 0;
if ($policy_count == 0) {
    mysqli_query($conn, "INSERT INTO attendance_policies (policy_name, grace_period_minutes, penalty_per_minute) VALUES ('السياسة العامة للدوام الرسمي', 15, 50.00)");
}

// هـ. إنشاء جدول دليل الحسابات للنظام المحاسبي
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_code VARCHAR(20) NOT NULL UNIQUE,
    account_name VARCHAR(100) NOT NULL,
    account_type ENUM('asset', 'liability', 'equity', 'income', 'expense') NOT NULL,
    balance DECIMAL(15,2) DEFAULT 0.00,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// و. تعبئة الحسابات الافتراضية إذا كانت فارغة
$accounts_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM accounts");
$accounts_count = $accounts_check ? mysqli_fetch_assoc($accounts_check)['count'] : 0;
if ($accounts_count == 0) {
    $default_accounts = [
        ['101', 'الخزينة النقدية', 'asset', 500000.00],
        ['201', 'دائنون - رواتب وأجور', 'liability', 0.00],
        ['401', 'إيرادات الرسوم الدراسية', 'income', 0.00],
        ['501', 'مصروفات الرواتب والأجور', 'expense', 0.00],
        ['502', 'مصروفات الخصومات والجزاءات', 'expense', 0.00],
        ['503', 'مصروفات مشتريات ومستلزمات', 'expense', 0.00]
    ];
    foreach ($default_accounts as $acc) {
        $code = $acc[0];
        $name = $acc[1];
        $type = $acc[2];
        $bal = $acc[3];
        mysqli_query($conn, "INSERT INTO accounts (account_code, account_name, account_type, balance) VALUES ('$code', '$name', '$type', $bal)");
    }
}

// ز. إنشاء جدول قيود اليومية العامة (رأس القيد)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS journal_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    source_type VARCHAR(50) NOT NULL,
    source_id INT DEFAULT NULL,
    added_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// ح. إنشاء جدول تفاصيل قيود اليومية العامة (دائن ومدين)
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS journal_details (
    id INT AUTO_INCREMENT PRIMARY KEY,
    entry_id INT NOT NULL,
    account_id INT NOT NULL,
    debit DECIMAL(15,2) DEFAULT 0.00,
    credit DECIMAL(15,2) DEFAULT 0.00,
    notes VARCHAR(255) DEFAULT NULL,
    FOREIGN KEY (entry_id) REFERENCES journal_entries(id) ON DELETE CASCADE,
    FOREIGN KEY (account_id) REFERENCES accounts(id) ON DELETE CASCADE
)");

// ط. إنشاء جدول كشف المصروفات العامة
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS expenses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    amount DECIMAL(15,2) NOT NULL,
    expense_date DATE NOT NULL,
    description VARCHAR(255) NOT NULL,
    added_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

// ي. إنشاء جدول كشف وسجلات صرف الرواتب الشهرية للموظفين
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS salaries_log (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    month_year VARCHAR(7) NOT NULL,
    base_salary DECIMAL(10, 2) NOT NULL,
    total_deductions DECIMAL(10, 2) DEFAULT 0.00,
    net_salary DECIMAL(10, 2) NOT NULL,
    status ENUM('pending', 'paid') DEFAULT 'pending',
    paid_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);");

// ============================================================
// 7. الدوال البرمجية للنظام المحاسبي ونظام الحضور
// ============================================================

// دالة جلب معرّف الحساب عن طريق كود الحساب
function getAccountIdByCode($code) {
    global $conn;
    $code_escaped = mysqli_real_escape_string($conn, $code);
    $res = mysqli_query($conn, "SELECT id FROM accounts WHERE account_code = '$code_escaped'");
    if ($res && $row = mysqli_fetch_assoc($res)) {
        return $row['id'];
    }
    return null;
}

// دالة إضافة قيد محاسبي مزدوج وتعديل الأرصدة تلقائياً
function addJournalEntry($date, $description, $source_type, $source_id, $details, $added_by) {
    global $conn;
    $date_escaped = mysqli_real_escape_string($conn, $date);
    $desc_escaped = mysqli_real_escape_string($conn, $description);
    $st_escaped = mysqli_real_escape_string($conn, $source_type);
    $si_val = $source_id ? intval($source_id) : "NULL";
    $added_by_val = intval($added_by);

    $entry_query = "INSERT INTO journal_entries (entry_date, description, source_type, source_id, added_by) 
                    VALUES ('$date_escaped', '$desc_escaped', '$st_escaped', $si_val, $added_by_val)";
    if (mysqli_query($conn, $entry_query)) {
        $entry_id = mysqli_insert_id($conn);
        foreach ($details as $detail) {
            $account_id = intval($detail['account_id']);
            $debit = floatval($detail['debit'] ?? 0);
            $credit = floatval($detail['credit'] ?? 0);
            $notes = mysqli_real_escape_string($conn, $detail['notes'] ?? '');

            $detail_query = "INSERT INTO journal_details (entry_id, account_id, debit, credit, notes) 
                             VALUES ($entry_id, $account_id, $debit, $credit, '$notes')";
            mysqli_query($conn, $detail_query);

            // تحديث رصيد الحساب بناءً على نوعه
            $acc_query = mysqli_query($conn, "SELECT account_type FROM accounts WHERE id = $account_id");
            if ($acc_query && $acc_row = mysqli_fetch_assoc($acc_query)) {
                $type = $acc_row['account_type'];
                if (in_array($type, ['asset', 'expense'])) {
                    mysqli_query($conn, "UPDATE accounts SET balance = balance + $debit - $credit WHERE id = $account_id");
                } else {
                    mysqli_query($conn, "UPDATE accounts SET balance = balance - $debit + $credit WHERE id = $account_id");
                }
            }
        }
        return $entry_id;
    }
    return false;
}

// دالة معالجة الحضور والانصراف، حساب التأخير والخصومات، وتوثيق القيد المحاسبي وإشعار الإدارة
function processEmployeeAttendance($employee_id, $timestamp) {
    global $conn;
    $employee_id = intval($employee_id);
    
    $time_str = date('H:i:s', strtotime($timestamp));
    $date_str = date('Y-m-d', strtotime($timestamp));
    
    $user_res = mysqli_query($conn, "SELECT full_name, base_salary, work_start_time, work_end_time FROM users WHERE id = $employee_id");
    if (!$user_res || mysqli_num_rows($user_res) == 0) {
        return ['status' => 'error', 'message' => 'الموظف غير موجود بالنظام'];
    }
    $user = mysqli_fetch_assoc($user_res);
    
    $work_start = $user['work_start_time'];
    $start_seconds = strtotime($date_str . ' ' . $work_start);
    $checkin_seconds = strtotime($timestamp);
    
    $delay_minutes = 0;
    $status = 'present';
    $deduction = 0.00;
    
    $policy_res = mysqli_query($conn, "SELECT * FROM attendance_policies LIMIT 1");
    $policy = mysqli_fetch_assoc($policy_res);
    $grace_period = intval($policy['grace_period_minutes'] ?? 15);
    $penalty_per_min = floatval($policy['penalty_per_minute'] ?? 50.00);
    
    if ($checkin_seconds > $start_seconds) {
        $delay_minutes = floor(($checkin_seconds - $start_seconds) / 60);
        if ($delay_minutes > $grace_period) {
            $status = 'late';
            $deduction = ($delay_minutes - $grace_period) * $penalty_per_min;
        }
    }
    
    $att_check = mysqli_query($conn, "SELECT id FROM employee_attendance WHERE user_id = $employee_id AND date = '$date_str'");
    if ($att_check && mysqli_num_rows($att_check) == 0) {
        $ins_query = "INSERT INTO employee_attendance (user_id, date, check_in, status, delay_minutes, deduction_amount) 
                      VALUES ($employee_id, '$date_str', '$time_str', '$status', $delay_minutes, $deduction)";
        if (mysqli_query($conn, $ins_query)) {
            $attendance_id = mysqli_insert_id($conn);
            
            // في حال وجود خصم مالي، نقوم بتسجيل القيد المحاسبي فوراً
            if ($deduction > 0) {
                $expense_acc = getAccountIdByCode('502');
                $payable_acc = getAccountIdByCode('201');
                
                if ($expense_acc && $payable_acc) {
                    $details = [
                        ['account_id' => $expense_acc, 'debit' => $deduction, 'credit' => 0.00, 'notes' => "خصم تأخير الموظف {$user['full_name']} بمقدار $delay_minutes دقيقة"],
                        ['account_id' => $payable_acc, 'debit' => 0.00, 'credit' => $deduction, 'notes' => "خصم تأخير الموظف {$user['full_name']} بمقدار $delay_minutes دقيقة"]
                    ];
                    addJournalEntry($date_str, "خصم تأخير الموظف {$user['full_name']} - تاريخ $date_str", 'attendance', $attendance_id, $details, 1);
                }
            }
            
            // إرسال إشعار فوري للمدراء والعميد
            if ($status == 'late') {
                $notif_msg = "⚠️ الموظف {$user['full_name']} بصم متأخراً في تمام الساعة $time_str (تأخير $delay_minutes دقيقة)، تم خصم $deduction ريال تلقائياً.";
                $admins_res = mysqli_query($conn, "SELECT id FROM users WHERE permission_level >= 3");
                if ($admins_res) {
                    while ($admin = mysqli_fetch_assoc($admins_res)) {
                        addNotification($admin['id'], $notif_msg);
                    }
                }
            }
            
            return ['status' => $status, 'delay' => $delay_minutes, 'deduction' => $deduction];
        }
    }
    
    return ['status' => 'exists', 'message' => 'تم تسجيل حضور هذا اليوم مسبقاً'];
}
?>