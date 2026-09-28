<?php
// pages/attendance_kiosk.php - كشك بصمة الإصبع التفاعلي
require_once 'db_connect.php';

// إنشاء جدول حضور الطلاب إن لم يكن موجوداً لتسجيل حضور البصمة
mysqli_query($conn, "CREATE TABLE IF NOT EXISTS student_attendance (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    status ENUM('present', 'absent') DEFAULT 'present',
    FOREIGN KEY (student_id) REFERENCES users(id) ON DELETE CASCADE
)");

// معالجة تسجيل الحضور عبر AJAX POST
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'scan') {
    header('Content-Type: application/json; charset=utf-8');
    
    $user_id = intval($_POST['user_id']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $now = date('Y-m-d H:i:s');
    $date_today = date('Y-m-d');
    $time_now = date('H:i:s');
    
    // التحقق من وجود المستخدم
    $user_query = mysqli_query($conn, "SELECT full_name FROM users WHERE id = $user_id AND role = '$role'");
    if (mysqli_num_rows($user_query) === 0) {
        echo json_encode(['success' => false, 'message' => 'المستخدم غير مسجل في النظام']);
        exit();
    }
    
    $user_data = mysqli_fetch_assoc($user_query);
    $name = $user_data['full_name'];
    
    if ($role === 'staff') {
        // معالجة بصمة الموظف وتطبيق الخصومات
        $res = processEmployeeAttendance($user_id, $now);
        if ($res['status'] === 'exists') {
            echo json_encode([
                'success' => false,
                'message' => "⚠️ عذراً {$name}، لقد قمت بتسجيل حضورك لهذا اليوم مسبقاً!"
            ]);
        } elseif ($res['status'] === 'error') {
            echo json_encode(['success' => false, 'message' => 'فشلت معالجة بصمة الموظف.']);
        } else {
            $msg = "✅ تم تسجيل حضورك بنجاح يا {$name}.";
            if ($res['status'] === 'late') {
                $msg .= " دوامك متأخر بمقدار {$res['delay']} دقيقة. تم خصم {$res['deduction']} ريال وإشعار الإدارة.";
            } else {
                $msg .= " حضورك في الوقت الرسمي. دوام مبارك!";
            }
            echo json_encode([
                'success' => true,
                'message' => $msg,
                'status' => $res['status'],
                'delay' => $res['delay'] ?? 0,
                'deduction' => $res['deduction'] ?? 0
            ]);
        }
    } else {
        // معالجة بصمة الطالب
        $att_check = mysqli_query($conn, "SELECT id FROM student_attendance WHERE student_id = $user_id AND date = '$date_today'");
        if (mysqli_num_rows($att_check) > 0) {
            echo json_encode([
                'success' => false,
                'message' => "⚠️ عذراً الطالب {$name}، تم تسجيل حضورك اليوم مسبقاً!"
            ]);
        } else {
            $ins = mysqli_query($conn, "INSERT INTO student_attendance (student_id, date, time, status) VALUES ($user_id, '$date_today', '$time_now', 'present')");
            if ($ins) {
                echo json_encode([
                    'success' => true,
                    'message' => "🎓 أهلاً بك يا {$name}. تم تسجيل حضورك للمحاضرة بنجاح!",
                    'status' => 'present'
                ]);
            } else {
                echo json_encode(['success' => false, 'message' => 'فشل تسجيل حضور الطالب.']);
            }
        }
    }
    exit();
}

// جلب قائمة الطلاب والموظفين لعرضهم في الكشك الافتراضي للتجربة
$students_res = mysqli_query($conn, "SELECT id, full_name, student_id FROM users WHERE role='student' AND payment_status='paid' ORDER BY full_name ASC");
$staff_res = mysqli_query($conn, "SELECT id, full_name, uid FROM users WHERE role='staff' ORDER BY full_name ASC");
?>

<div style="max-width: 900px; margin: 40px auto; background: #ffffff; border-radius: 20px; box-shadow: 0 15px 50px rgba(7, 41, 40, 0.08); overflow: hidden; direction: rtl; text-align: right; font-family: 'Cairo', sans-serif; border: 1px solid #e2e8f0;">
    
    <!-- رأس شاشة البصمة -->
    <div style="background: linear-gradient(135deg, #085859, #0d4748); padding: 35px 20px; text-align: center; color: white; position: relative;">
        <h2 style="margin: 0; font-size: 28px; font-weight: 800; display: flex; align-items: center; justify-content: center; gap: 12px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><path d="M2 12C2 6.48 6.48 2 12 2s10 4.48 10 10-4.48 10-10 10S2 17.52 2 12z"></path><path d="M12 6v6l4 2"></path></svg>
            جهاز البصمة الإلكتروني الموحد
        </h2>
        <p style="margin: 10px 0 0; font-size: 15px; opacity: 0.85;">نظام مزامنة حضور الطلاب وتأخيرات الموظفين بالبصمة الحيوية للكلية</p>
        <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 4px; background: #1c7f7c;"></div>
    </div>

    <div style="padding: 40px;">
        
        <div style="display: grid; grid-template-columns: 1fr 1.2fr; gap: 40px; align-items: center;">
            
            <!-- القسم الأيمن: محاكي البصمة الفعلي -->
            <div style="background: #f8fafc; border-radius: 15px; padding: 30px; text-align: center; border: 1.5px dashed #cbd5e1; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 380px;">
                <div style="font-size: 14px; font-weight: 800; color: #085859; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 0.5px;">قارئ البصمة الحيوي (المحاكي)</div>
                
                <!-- حاوية البصمة والأنيميشن -->
                <div id="fingerprintContainer" style="width: 140px; height: 140px; border-radius: 50%; background: #ffffff; border: 3px solid #e2e8f0; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; position: relative; box-shadow: 0 4px 12px rgba(0,0,0,0.03);" onclick="triggerScan()">
                    <!-- أيقونة البصمة -->
                    <svg id="fingerprintSvg" xmlns="http://www.w3.org/2000/svg" width="70" height="70" viewBox="0 0 24 24" fill="none" stroke="#64748b" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" style="transition: all 0.3s;">
                        <path d="M12 2a10 10 0 0 0-10 10c0 2.2.9 4.2 2.3 5.7L6 16c-.7-.9-1-2.1-1-3.5 0-3.9 3.1-7 7-7s7 3.1 7 7c0 1.4-.3 2.6-1 3.5l1.7 1.7A9.9 9.9 0 0 0 22 12c0-5.5-4.5-10-10-10z"></path>
                        <path d="M12 8a4 4 0 0 0-4 4c0 1 .3 1.9.9 2.6L10.3 13A1.9 1.9 0 0 1 10 12c0-1.1.9-2 2-2s2 .9 2 2c0 .4-.1.7-.3.9l1.4 1.4c.6-.7.9-1.6.9-2.3 0-2.2-1.8-4-4-4z"></path>
                        <path d="M12 14c-1.1 0-2-.9-2-2"></path>
                        <path d="M8 12a4 4 0 0 1 8 0c0 1.5-.6 2.8-1.5 3.8l1.4 1.4c1.3-1.3 2.1-3.2 2.1-5.2 0-4.4-3.6-8-8-8S4 7.6 4 12c0 2 0 4 2.1 5.2l1.4-1.4C6.6 14.8 6 13.5 6 12a2 2 0 0 1 2-2z"></path>
                    </svg>
                    <!-- ليزر المسح الضوئي -->
                    <div id="scanLaser" style="position: absolute; left: 10%; right: 10%; height: 3px; background: #1c7f7c; top: 20%; border-radius: 5px; box-shadow: 0 0 12px #1c7f7c; display: none; animation: scanMove 1.8s infinite ease-in-out;"></div>
                </div>

                <!-- نص المساعد الصوتي/الحالة -->
                <div id="scannerStatus" style="margin-top: 25px; font-weight: 700; color: #64748b; font-size: 15px; transition: all 0.3s;">يرجى اختيار الموظف أو الطالب، ثم وضع الإصبع على القارئ للمسح.</div>
                
                <!-- زر بدء المسح التفاعلي -->
                <button type="button" id="btnStartScan" onclick="triggerScan()" style="margin-top: 25px; background: #085859; color: white; border: none; padding: 10px 25px; border-radius: 8px; font-size: 14px; font-weight: 700; cursor: pointer; transition: 0.3s; box-shadow: 0 4px 12px rgba(8,88,89,0.15); display: inline-flex; align-items: center; gap: 8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><path d="M12 2a10 10 0 1 0 10 10H12V2z"></path></svg>
                    ابدأ مسح البصمة
                </button>
            </div>
            
            <!-- القسم الأيسر: خيارات اختيار الطالب والموظف -->
            <div style="display: flex; flex-direction: column; gap: 20px;">
                
                <!-- تبديل الدور (موظف / طالب) -->
                <div>
                    <label style="display: block; font-weight: bold; color: #334155; margin-bottom: 8px; font-size: 15px;">اختر فئة الحضور:</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px;">
                        <button type="button" id="roleStaffBtn" onclick="selectRole('staff')" style="background: #085859; color: white; border: 1.5px solid #085859; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            💼 كادر وموظفي الكلية
                        </button>
                        <button type="button" id="roleStudentBtn" onclick="selectRole('student')" style="background: #ffffff; color: #334155; border: 1.5px solid #cbd5e1; padding: 12px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; text-align: center; display: flex; align-items: center; justify-content: center; gap: 8px;">
                            🎓 طلاب الكلية المقيدين
                        </button>
                    </div>
                </div>

                <!-- قائمة الموظفين (تظهر افتراضياً) -->
                <div id="staffSelectContainer">
                    <label style="display: block; font-weight: bold; color: #334155; margin-bottom: 8px; font-size: 15px;">اختر اسم الموظف:</label>
                    <select id="staffSelect" style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-family: 'Cairo', sans-serif; font-size: 15px; outline: none; background: white; cursor: pointer;">
                        <option value="">-- اختر الموظف لتبصيم الحضور --</option>
                        <?php while ($staff = mysqli_fetch_assoc($staff_res)): ?>
                            <option value="<?php echo $staff['id']; ?>">
                                <?php echo htmlspecialchars($staff['full_name']); ?> <?php echo !empty($staff['uid']) ? "(رقم البصمة: " . $staff['uid'] . ")" : ""; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- قائمة الطلاب (مخفية افتراضياً) -->
                <div id="studentSelectContainer" style="display: none;">
                    <label style="display: block; font-weight: bold; color: #334155; margin-bottom: 8px; font-size: 15px;">اختر اسم الطالب:</label>
                    <select id="studentSelect" style="width: 100%; padding: 12px; border: 1.5px solid #cbd5e1; border-radius: 8px; font-family: 'Cairo', sans-serif; font-size: 15px; outline: none; background: white; cursor: pointer;">
                        <option value="">-- اختر الطالب لتبصيم الحضور --</option>
                        <?php while ($student = mysqli_fetch_assoc($students_res)): ?>
                            <option value="<?php echo $student['id']; ?>">
                                <?php echo htmlspecialchars($student['full_name']); ?> (الرقم الأكاديمي: <?php echo htmlspecialchars($student['student_id']); ?>)
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>

                <!-- معلومات سياسة الدوام والخصومات -->
                <div style="background: #f0fdfa; border-right: 4px solid #1c7f7c; padding: 20px; border-radius: 8px; font-size: 13.5px; color: #0d4748; line-height: 1.6;">
                    <strong style="display: block; margin-bottom: 5px; font-size: 14.5px;">ℹ️ قواعد الدوام والمحاسبة:</strong>
                    * يبدأ الدوام الرسمي الساعة **08:00 صباحاً**.
                    <br>
                    * فترة السماح الافتراضية للتأخر هي **15 دقيقة**.
                    <br>
                    * عند تجاوز فترة السماح، يُطبق خصم قدره **50 ريال يمني** عن كل دقيقة تأخر مباشرة على الراتب الأساسي للموظف مع قيد محاسبي مزدوج وإشعار العميد.
                </div>

            </div>

        </div>

        <!-- رسالة النتيجة والتغذية الراجعة للبصمة -->
        <div id="scanResultBox" style="margin-top: 35px; padding: 20px; border-radius: 10px; text-align: center; font-weight: 700; font-size: 16px; display: none;"></div>

    </div>

    <!-- تذييل الصفحة للعودة -->
    <div style="background: #f8fafc; padding: 20px; text-align: center; border-top: 1px solid #e2e8f0;">
        <a href="?p=home" class="btn-back-to-home" style="display: inline-flex; align-items: center; gap: 8px; text-decoration: none; font-weight: 800; color: #085859; font-size: 15px;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
            العودة لصفحة الكلية الرئيسية
        </a>
    </div>

</div>

<!-- أنيميشن المسح بالليزر -->
<style>
@keyframes scanMove {
    0% {
        top: 20%;
        opacity: 0.3;
    }
    50% {
        top: 80%;
        opacity: 1;
        transform: scale(1.05);
    }
    100% {
        top: 20%;
        opacity: 0.3;
    }
}
</style>

<script>
let currentRole = 'staff';

function selectRole(role) {
    currentRole = role;
    const staffBtn = document.getElementById('roleStaffBtn');
    const studentBtn = document.getElementById('roleStudentBtn');
    const staffContainer = document.getElementById('staffSelectContainer');
    const studentContainer = document.getElementById('studentSelectContainer');
    const resultBox = document.getElementById('scanResultBox');
    
    resultBox.style.display = 'none';
    
    if (role === 'staff') {
        staffBtn.style.background = '#085859';
        staffBtn.style.color = '#ffffff';
        staffBtn.style.borderColor = '#085859';
        
        studentBtn.style.background = '#ffffff';
        studentBtn.style.color = '#334155';
        studentBtn.style.borderColor = '#cbd5e1';
        
        staffContainer.style.display = 'block';
        studentContainer.style.display = 'none';
    } else {
        studentBtn.style.background = '#085859';
        studentBtn.style.color = '#ffffff';
        studentBtn.style.borderColor = '#085859';
        
        staffBtn.style.background = '#ffffff';
        staffBtn.style.color = '#334155';
        staffBtn.style.borderColor = '#cbd5e1';
        
        staffContainer.style.display = 'none';
        studentContainer.style.display = 'block';
    }
}

function triggerScan() {
    const selectElem = currentRole === 'staff' ? document.getElementById('staffSelect') : document.getElementById('studentSelect');
    const userId = selectElem.value;
    const scannerStatus = document.getElementById('scannerStatus');
    const scanContainer = document.getElementById('fingerprintContainer');
    const fingerprintSvg = document.getElementById('fingerprintSvg');
    const laser = document.getElementById('scanLaser');
    const resultBox = document.getElementById('scanResultBox');
    
    if (!userId) {
        alert(currentRole === 'staff' ? 'الرجاء اختيار اسم الموظف أولاً!' : 'الرجاء اختيار اسم الطالب أولاً!');
        return;
    }
    
    // إخفاء كادر النتائج القديمة
    resultBox.style.display = 'none';
    
    // بدء تأثير المسح بالبصمة
    scannerStatus.innerText = '⏳ جاري التعرف على معالم البصمة الحيوية...';
    scannerStatus.style.color = '#085859';
    scanContainer.style.borderColor = '#1c7f7c';
    scanContainer.style.boxShadow = '0 0 25px rgba(28, 127, 124, 0.4)';
    fingerprintSvg.style.stroke = '#1c7f7c';
    laser.style.display = 'block';
    
    // إرسال طلب الحضور بعد ثانية ونصف لمحاكاة عملية المسح
    setTimeout(() => {
        const formData = new FormData();
        formData.append('action', 'scan');
        formData.append('user_id', userId);
        formData.append('role', currentRole);
        
        fetch(window.location.href, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            // إنهاء أنيميشن البصمة
            laser.style.display = 'none';
            scanContainer.style.boxShadow = 'none';
            
            if (data.success) {
                // حضور ناجح
                scanContainer.style.borderColor = '#22c55e';
                fingerprintSvg.style.stroke = '#22c55e';
                scannerStatus.innerText = '🟢 تم مسح البصمة بنجاح!';
                scannerStatus.style.color = '#22c55e';
                
                resultBox.style.display = 'block';
                resultBox.style.background = '#f0fdf4';
                resultBox.style.color = '#155724';
                resultBox.style.border = '1px solid #c3e6cb';
                resultBox.innerText = data.message;
            } else {
                // البصمة مسجلة مسبقاً أو خطأ
                scanContainer.style.borderColor = '#e11d48';
                fingerprintSvg.style.stroke = '#e11d48';
                scannerStatus.innerText = '🔴 تعذر تسجيل الحضور!';
                scannerStatus.style.color = '#e11d48';
                
                resultBox.style.display = 'block';
                resultBox.style.background = '#fff5f5';
                resultBox.style.color = '#721c24';
                resultBox.style.border = '1px solid #f5c6cb';
                resultBox.innerText = data.message;
            }
        })
        .catch(err => {
            console.error(err);
            laser.style.display = 'none';
            scannerStatus.innerText = '❌ حدث خطأ في الاتصال بالخادم!';
            scannerStatus.style.color = '#e11d48';
        });
    }, 1800);
}
</script>
