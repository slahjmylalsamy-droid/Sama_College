-- ============================================================
-- إنشاء قاعدة البيانات واستخدامها
-- ============================================================
CREATE DATABASE IF NOT EXISTS sama_college;
USE sama_college;

-- ============================================================
-- قاعدة البيانات: sama_college (نسخة نظيفة وكاملة)
-- ============================================================

-- 1. جدول المستخدمين (الطلاب والموظفين)
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('student', 'staff') DEFAULT 'student',
    permission_level INT DEFAULT 1,
    student_id VARCHAR(20) UNIQUE NULL,
    department VARCHAR(100) NULL,
    level VARCHAR(50) NULL,
    image VARCHAR(500) NULL,
    payment_status ENUM('pending', 'unpaid', 'paid') DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 2. جدول المواد الدراسية
CREATE TABLE subjects (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_name VARCHAR(100) NOT NULL,
    subject_code VARCHAR(20) UNIQUE NOT NULL,
    department VARCHAR(100) NULL,
    level VARCHAR(50) NULL
);

-- 3. جدول الدرجات
CREATE TABLE grades (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    subject_id INT NOT NULL,
    final_grade DECIMAL(5,2) NULL,
    year_work DECIMAL(5,2) NULL,
    attendance_grade DECIMAL(5,2) NULL,
    participation_grade DECIMAL(5,2) NULL,
    total_grade DECIMAL(5,2) NULL,
    grade_letter VARCHAR(2) NULL,
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);

-- 4. جدول المحاضرات
CREATE TABLE lectures (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_id INT NOT NULL,
    title VARCHAR(200) NOT NULL,
    file_path VARCHAR(500) NOT NULL,
    uploaded_by INT NOT NULL,
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE,
    FOREIGN KEY (uploaded_by) REFERENCES users(id) ON DELETE CASCADE
);

-- 5. جدول الجدول الدراسي
CREATE TABLE schedule (
    id INT AUTO_INCREMENT PRIMARY KEY,
    subject_id INT NOT NULL,
    day_of_week VARCHAR(20),
    start_time TIME NOT NULL,
    end_time TIME NOT NULL,
    room VARCHAR(50) NULL,
    FOREIGN KEY (subject_id) REFERENCES subjects(id) ON DELETE CASCADE
);

-- 6. جدول الإعلانات
CREATE TABLE announcements (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(200) NOT NULL,
    content TEXT NOT NULL,
    created_by INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (created_by) REFERENCES users(id) ON DELETE CASCADE
);

-- 7. جدول المدفوعات (الإيصالات)
CREATE TABLE payments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    amount DECIMAL(10,2) NOT NULL DEFAULT 0,
    payment_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    receipt_file VARCHAR(500) NULL,
    transaction_number VARCHAR(100) NULL,
    uploaded_by ENUM('student', 'staff') DEFAULT 'student',
    status ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    notes TEXT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- 8. جدول الإشعارات الداخلية
CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    message TEXT NOT NULL,
    is_read BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);

-- ============================================================
-- البيانات التجريبية (لتجربة الموقع فوراً)
-- ============================================================

-- المستخدمين
INSERT INTO users (full_name, email, password, role, permission_level, student_id, department, level, payment_status) VALUES
('مدير الكلية', 'admin@college.com', MD5('123456'), 'staff', 3, NULL, NULL, NULL, 'paid'),
('موظف الكلية', 'staff@college.com', MD5('123456'), 'staff', 2, NULL, NULL, NULL, 'paid'),
('أحمد محمد', 'ahmed@student.com', MD5('123456'), 'student', 1, '2024001', 'علوم الحاسوب', 'المستوى الأول', 'unpaid'),
('سارة علي', 'sara@student.com', MD5('123456'), 'student', 1, '2024002', 'علوم الحاسوب', 'المستوى الأول', 'paid');

-- المواد الدراسية
INSERT INTO subjects (subject_name, subject_code, department, level) VALUES
('قواعد البيانات', 'DB101', 'علوم الحاسوب', 'المستوى الأول'),
('برمجة الويب', 'WEB201', 'علوم الحاسوب', 'المستوى الثاني'),
('الذكاء الاصطناعي', 'AI301', 'علوم الحاسوب', 'المستوى الثالث'),
('تشريح', 'ANAT101', 'العلوم الطبية', 'المستوى الأول'),
('صيدلة سريرية', 'CLP101', 'صيدلة', 'المستوى الثاني');

-- الإعلانات
INSERT INTO announcements (title, content, created_by) VALUES
('📢 بدء التسجيل للفصل الدراسي الجديد', 'يسر عمادة الكلية الإعلان عن بدء التسجيل للفصل الدراسي الأول للعام الجامعي 2026/2027 اعتباراً من 1 سبتمبر 2026.', 1),
('🎓 تخفيضات للطلاب المتفوقين', 'تعلن الكلية عن تخفيض 30% من الرسوم الدراسية للطلاب الحاصلين على معدل 90% فأعلى.', 1);