# -*- coding: utf-8 -*-
import sys

# Read db_connect.php up to the point before academic_calendar check
with open('db_connect.php', 'r', encoding='cp1256') as f:
    content = f.read()

# Let's find the position of "$cal_check = mysqli_query($conn,"
pos = content.find("$cal_check = mysqli_query($conn,")
if pos == -1:
    print("Error: Could not find key line in db_connect.php")
    sys.exit(1)

# Slice the file to get the clean header part
header_part = content[:pos]

# Rebuild the rest of the file in clean UTF-8
rest_of_file = """$cal_check = mysqli_query($conn, "SELECT COUNT(*) as count FROM academic_calendar");
$cal_count = $cal_check ? mysqli_fetch_assoc($cal_check)['count'] : 0;
if ($cal_count == 0) {
    $default_events = [
        ["📅 بدء عملية التنسيق والقبول الإلكتروني", "الأحد، 1 يونيو 2026 م", "مكتمل", "semester1"],
        ["🎓 بدء الدراسة للفصل الدراسي الأول والتهيئة للطلاب الجدد", "الثلاثاء، 1 سبتمبر 2026 م", "نشط حالياً", "semester1"],
        ["🛑 إغلاق باب القبول والتسجيل لجميع الأقسام", "الأربعاء، 30 سبتمبر 2026 م", "قريباً", "semester1"],
        ["📝 اختبارات منتصف الفصل الدراسي الأول (الترم الأول)", "من 20 إلى 29 أكتوبر 2026 م", "10 أيام", "semester1 exams"],
        ["📖 توقف الدراسة للمراجعة والاستعداد لاختبارات الفصل الأول", "من 10 إلى 15 ديسمبر 2026 م", "6 أيام", "semester1"],
        ["✍️ الاختبارات النهائية للفصل الدراسي الأول", "من 16 إلى 31 ديسمبر 2026 م", "15 يوم", "semester1 exams"],
        ["🌴 إجازة منتصف العام الدراسي لجميع الطلاب", "من 1 إلى 10 يناير 2027 م", "إجازة رسمية", "vacations"],
        ["🎓 بدء الدراسة للفصل الدراسي الثاني", "الثلاثاء، 12 يناير 2027 م", "قريباً", "semester2"],
        ["📝 اختبارات منتصف الفصل الدراسي الثاني (الترم الثاني)", "من 1 إلى 10 مارس 2027 م", "10 أيام", "semester2 exams"],
        ["🌙 إجازة عيد الفطر المبارك", "من 27 مارس إلى 5 أبريل 2027 م", "إجازة رسمية", "vacations"],
        ["✍️ الاختبارات النهائية للفصل الدراسي الثاني", "من 15 إلى 30 مايو 2027 م", "15 يوم", "semester2 exams"],
        ["☀ بدء الإجازة الصيفية السنوية للطلاب والتهيأة للعام الجديد", "الثلاثاء، 1 يونيو 2027 م", "إجازة رسمية", "vacations"]
    ];
    foreach ($default_events as $ev) {
        $name = mysqli_real_escape_string($conn, $ev[0]);
        $date = mysqli_real_escape_string($conn, $ev[1]);
        $status = mysqli_real_escape_string($conn, $ev[2]);
        $cat = mysqli_real_escape_string($conn, $ev[3]);
        mysqli_query($conn, "INSERT INTO academic_calendar (event_name, event_date, status, category) VALUES ('$name', '$date', '$status', '$cat')");
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
?>"""

# Combine and write in UTF-8
full_content = header_part + rest_of_file
with open('db_connect.php', 'w', encoding='utf-8') as f:
    f.write(full_content)

print("db_connect.php successfully restored and saved in UTF-8!")
