<?php
require_once '../db_connect.php';

// التحقق من تسجيل الدخول ورتبة المدير (صلاحية >= 3)
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'staff' || $_SESSION['permission'] < 3) {
    header("Location: dashboard.php");
    exit();
}

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'student';

// جلب النطاق الزمني للتقرير (الافتراضي هو الشهر الحالي)
$date_from = isset($_GET['date_from']) ? $_GET['date_from'] : date('Y-m-01');
$date_to = isset($_GET['date_to']) ? $_GET['date_to'] : date('Y-m-t');

// -------------------------------------------------------------
// 1. تقرير حضور الطلاب
// -------------------------------------------------------------
$student_id_filter = isset($_GET['student_id']) ? intval($_GET['student_id']) : 0;
$dept_filter = isset($_GET['dept']) ? mysqli_real_escape_string($conn, $_GET['dept']) : '';
$level_filter = isset($_GET['level']) ? mysqli_real_escape_string($conn, $_GET['level']) : '';

$student_where = "role = 'student'";
if ($dept_filter) {
    $student_where .= " AND department = '$dept_filter'";
}
if ($level_filter) {
    $student_where .= " AND level = '$level_filter'";
}
$students_dropdown = mysqli_query($conn, "SELECT id, full_name, student_id FROM users WHERE $student_where ORDER BY full_name ASC");

// جلب تفاصيل حضور الطالب المحدد
$student_attendance = [];
$student_stats = ['present' => 0, 'absent' => 0, 'total' => 0];
$selected_student_name = "";
$selected_student_code = "";

if ($student_id_filter > 0) {
    // جلب بيانات الطالب
    $std_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT full_name, student_id, department, level FROM users WHERE id = $student_id_filter"));
    if ($std_info) {
        $selected_student_name = $std_info['full_name'];
        $selected_student_code = $std_info['student_id'] ? $std_info['student_id'] : 'STD-' . $student_id_filter;
        
        // جلب سجل الحضور
        $att_query = mysqli_query($conn, "SELECT * FROM student_attendance WHERE student_id = $student_id_filter AND date BETWEEN '$date_from' AND '$date_to' ORDER BY date ASC");
        while ($row = mysqli_fetch_assoc($att_query)) {
            $student_attendance[] = $row;
            if ($row['status'] == 'present') {
                $student_stats['present']++;
            } else {
                $student_stats['absent']++;
            }
            $student_stats['total']++;
        }
    }
}

// -------------------------------------------------------------
// 2. تقرير حضور الموظفين والمدرسين والخصومات المالية
// -------------------------------------------------------------
$staff_id_filter = isset($_GET['staff_id']) ? intval($_GET['staff_id']) : 0;
$staff_dropdown = mysqli_query($conn, "SELECT id, full_name, staff_type FROM users WHERE role = 'staff' ORDER BY staff_type DESC, full_name ASC");

$staff_attendance = [];
$staff_stats = [
    'present' => 0,
    'late' => 0,
    'total_delay' => 0,
    'total_deductions' => 0.00,
    'base_salary' => 0.00,
    'net_salary' => 0.00
];
$selected_staff_name = "";
$selected_staff_type = "";
$selected_staff_salary = 0;

if ($staff_id_filter > 0) {
    $stf_info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT full_name, staff_type, base_salary FROM users WHERE id = $staff_id_filter"));
    if ($stf_info) {
        $selected_staff_name = $stf_info['full_name'];
        $selected_staff_type = $stf_info['staff_type'] == 'academic' ? 'كادر تدريسي (أكاديمي)' : 'كادر إداري (وظائف)';
        $selected_staff_salary = floatval($stf_info['base_salary']);
        
        $staff_stats['base_salary'] = $selected_staff_salary;
        
        $stf_att_query = mysqli_query($conn, "SELECT * FROM employee_attendance WHERE user_id = $staff_id_filter AND date BETWEEN '$date_from' AND '$date_to' ORDER BY date ASC");
        while ($row = mysqli_fetch_assoc($stf_att_query)) {
            $staff_attendance[] = $row;
            if ($row['status'] == 'present') {
                $staff_stats['present']++;
            } elseif ($row['status'] == 'late') {
                $staff_stats['late']++;
                $staff_stats['total_delay'] += intval($row['delay_minutes']);
                $staff_stats['total_deductions'] += floatval($row['deduction_amount']);
            }
        }
        $staff_stats['net_salary'] = $staff_stats['base_salary'] - $staff_stats['total_deductions'];
    }
}
?>

<?php include_once 'header.php'; ?>

    <!-- تنسيقات مخصصة للطباعة -->
    <style>
        @media print {
            .no-print, nav, aside, header, footer, .bg-gray-200, form, button, .tabs-container {
                display: none !important;
            }
            body, main, .p-6, .print-container {
                background: white !important;
                padding: 0 !important;
                margin: 0 !important;
                width: 100% !important;
                direction: rtl !important;
            }
            .print-header {
                display: block !important;
                border-bottom: 3px double #072928;
                padding-bottom: 20px;
                margin-bottom: 30px;
            }
            table {
                width: 100% !important;
                border-collapse: collapse !important;
            }
            th, td {
                border: 1px solid #000 !important;
                padding: 8px !important;
                font-size: 12px !important;
            }
        }
        .print-header {
            display: none;
        }
    </style>

    <div class="max-w-6xl mx-auto bg-white rounded-xl shadow-md p-6 border-t-4 border-gold print-container">
        
        <!-- ترويسة الكلية الرسمية للطباعة الورقية (تظهر في الطباعة فقط) -->
        <div class="print-header text-center">
            <div class="flex justify-between items-center px-8 mb-4">
                <div class="text-right">
                    <h3 class="font-extrabold text-lg text-[#072928]">جمهورية اليمنية</h3>
                    <h4 class="font-bold text-sm text-gray-700">وزارة التعليم العالي والبحث العلمي</h4>
                    <h4 class="font-bold text-sm text-gray-700">كلية سماء المتميزين للعلوم الطبية والتكنولوجية</h4>
                </div>
                <div class="w-20 h-20">
                    <img src="../logo.png" alt="شعار الكلية" class="max-w-full max-h-full object-contain">
                </div>
                <div class="text-left text-xs text-gray-500 font-mono">
                    <p>التاريخ: <?php echo date('Y/m/d'); ?> م</p>
                    <p>المستند: تقرير حضور البصمة الحيوية</p>
                </div>
            </div>
            <h2 class="text-2xl font-extrabold text-[#072928] border-y py-2.5 my-4 bg-gray-50">
                <?php echo $tab == 'student' ? 'تقرير حضور وغياب الطلاب التفصيلي' : 'سند تقرير الحضور والمالية للكادر والتدريس'; ?>
            </h2>
            <div class="grid grid-cols-2 gap-4 text-right text-sm font-semibold px-8 mt-2">
                <?php if ($tab == 'student'): ?>
                    <p>اسم الطالب: <?php echo $selected_student_name; ?></p>
                    <p>الرقم الجامعي: <?php echo $selected_student_code; ?></p>
                <?php else: ?>
                    <p>الاسم الكادر: <?php echo $selected_staff_name; ?></p>
                    <p>نوع الكادر: <?php echo $selected_staff_type; ?></p>
                <?php endif; ?>
                <p>الفترة من: <?php echo $date_from; ?></p>
                <p>إلى: <?php echo $date_to; ?></p>
            </div>
        </div>

        <div class="tabs-container no-print flex border-b border-gray-200 mb-6 gap-4">
            <a href="?tab=student" class="py-2.5 px-6 font-bold text-sm transition <?php echo $tab == 'student' ? 'border-b-2 border-primary text-primary' : 'text-gray-500 hover:text-primary'; ?>">
                🎓 تقارير حضور ومستويات الطلاب
            </a>
            <a href="?tab=staff" class="py-2.5 px-6 font-bold text-sm transition <?php echo $tab == 'staff' ? 'border-b-2 border-primary text-primary' : 'text-gray-500 hover:text-primary'; ?>">
                💼 تقارير الحضور والمالية للمدرسين والموظفين
            </a>
        </div>

        <!-- 1. نموذج الفلترة والبحث (لا يظهر في الطباعة) -->
        <form method="GET" class="no-print bg-gray-50 border rounded-xl p-5 mb-8 grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
            <input type="hidden" name="tab" value="<?php echo $tab; ?>">
            
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">من تاريخ</label>
                <input type="date" name="date_from" value="<?php echo $date_from; ?>" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
            </div>
            
            <div>
                <label class="block text-xs font-bold text-gray-700 mb-1">إلى تاريخ</label>
                <input type="date" name="date_to" value="<?php echo $date_to; ?>" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
            </div>

            <?php if ($tab == 'student'): ?>
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">اختر التخصص والفرع</label>
                    <select name="dept" onchange="this.form.submit()" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">-- التخصص (الكل) --</option>
                        <option value="تقنية معلومات" <?php echo $dept_filter == 'تقنية معلومات' ? 'selected' : ''; ?>>تقنية معلومات</option>
                        <option value="محاسبة" <?php echo $dept_filter == 'محاسبة' ? 'selected' : ''; ?>>محاسبة</option>
                        <option value="صيدلة" <?php echo $dept_filter == 'صيدلة' ? 'selected' : ''; ?>>صيدلة</option>
                        <option value="مساعد طبيب" <?php echo $dept_filter == 'مساعد طبيب' ? 'selected' : ''; ?>>مساعد طبيب</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-xs font-bold text-gray-700 mb-1">اختر الطالب</label>
                    <select name="student_id" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">-- اختر الطالب للتقرير --</option>
                        <?php while ($s_row = mysqli_fetch_assoc($students_dropdown)): ?>
                            <option value="<?php echo $s_row['id']; ?>" <?php echo $student_id_filter == $s_row['id'] ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($s_row['full_name']) . " (" . ($s_row['student_id'] ? $s_row['student_id'] : $s_row['id']) . ")"; ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php else: ?>
                <div class="md:col-span-2">
                    <label class="block text-xs font-bold text-gray-700 mb-1">اختر المدرس أو الموظف</label>
                    <select name="staff_id" required class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:border-primary">
                        <option value="">-- اختر المدرس / الموظف --</option>
                        <?php while ($st_row = mysqli_fetch_assoc($staff_dropdown)): 
                            $type_pref = $st_row['staff_type'] == 'academic' ? '🎓 مدرس: ' : '💼 موظف: ';
                        ?>
                            <option value="<?php echo $st_row['id']; ?>" <?php echo $staff_id_filter == $st_row['id'] ? 'selected' : ''; ?>>
                                <?php echo $type_pref . htmlspecialchars($st_row['full_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
                </div>
            <?php endif; ?>

            <div class="md:col-span-4 text-left flex justify-end gap-2">
                <button type="submit" class="bg-primary hover:bg-primaryDark text-white font-bold px-6 py-2.5 rounded-lg text-sm transition shadow-md">
                    <i class="fa-solid fa-chart-line ml-1"></i> توليد التقرير
                </button>
                <?php if (($tab == 'student' && $student_id_filter > 0) || ($tab == 'staff' && $staff_id_filter > 0)): ?>
                    <button type="button" onclick="window.print()" class="bg-teal-600 hover:bg-teal-700 text-white font-bold px-6 py-2.5 rounded-lg text-sm transition shadow-md">
                        <i class="fa-solid fa-print ml-1"></i> طباعة التقرير
                    </button>
                <?php endif; ?>
            </div>
        </form>

        <!-- 2. عرض نتائج تقرير الطالب -->
        <?php if ($tab == 'student'): ?>
            <?php if ($student_id_filter > 0): ?>
                <!-- ملخص كروت الإحصاء -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8 no-print">
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-5 text-center">
                        <p class="text-blue-600 font-bold text-sm">إجمالي أيام الحضور</p>
                        <p class="text-3xl font-extrabold text-blue-900 mt-1"><?php echo $student_stats['present']; ?> أيام</p>
                    </div>
                    <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 text-center">
                        <p class="text-rose-600 font-bold text-sm">إجمالي أيام الغياب</p>
                        <p class="text-3xl font-extrabold text-rose-900 mt-1"><?php echo $student_stats['absent']; ?> أيام</p>
                    </div>
                    <div class="bg-teal-50 border border-teal-200 rounded-xl p-5 text-center">
                        <p class="text-teal-600 font-bold text-sm">معدل الانضباط</p>
                        <?php 
                        $ratio = $student_stats['total'] > 0 ? round(($student_stats['present'] / $student_stats['total']) * 100, 1) : 100;
                        ?>
                        <p class="text-3xl font-extrabold text-teal-900 mt-1"><?php echo $ratio; ?>%</p>
                    </div>
                </div>

                <!-- جدول تفاصيل حضور الطالب -->
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800">
                                <th class="px-4 py-3 text-sm font-bold border-b">اليوم والتاريخ</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">وقت البصمة</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">الحالة الحيوية</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">ملاحظات المستند</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (empty($student_attendance)): ?>
                                <tr>
                                    <td colspan="4" class="px-4 py-6 text-center text-gray-400 italic">لا توجد حركات بصمة مسجلة في هذا النطاق التاريخي.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($student_attendance as $row): ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo date('l, Y/m/d', strtotime($row['date'])); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700 font-mono"><?php echo htmlspecialchars($row['time']); ?></td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php if ($row['status'] == 'present'): ?>
                                            <span class="bg-green-100 text-green-800 border border-green-200 px-2.5 py-0.5 rounded text-xs font-bold print:border-0 print:bg-transparent">حضور بالبصمة</span>
                                        <?php else: ?>
                                            <span class="bg-red-100 text-red-800 border border-red-200 px-2.5 py-0.5 rounded text-xs font-bold print:border-0 print:bg-transparent">غياب</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm text-gray-500 italic">سجل حضور ذكي بالبصمة الحيوية</td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-16 text-gray-400">
                    <i class="fa-solid fa-graduation-cap text-6xl mb-4 animate-bounce"></i>
                    <p class="font-bold text-sm">برجاء اختيار الطالب من مربع التصفية بالأعلى لتوليد التقرير التفصيلي.</p>
                </div>
            <?php endif; ?>

        <!-- 3. عرض نتائج تقرير الموظفين والمدرسين والمالية -->
        <?php else: ?>
            <?php if ($staff_id_filter > 0): ?>
                <!-- ملخص كروت الإحصاء المالي والدوام -->
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8 no-print">
                    <div class="bg-teal-50 border border-teal-200 rounded-xl p-5 text-center">
                        <p class="text-teal-600 font-bold text-sm">الراتب الأساسي</p>
                        <p class="text-2xl font-extrabold text-teal-900 mt-1"><?php echo number_format($staff_stats['base_salary'], 2); ?> ر.ي</p>
                    </div>
                    <div class="bg-amber-50 border border-amber-200 rounded-xl p-5 text-center">
                        <p class="text-amber-600 font-bold text-sm">التأخيرات (دقائق)</p>
                        <p class="text-2xl font-extrabold text-amber-900 mt-1"><?php echo $staff_stats['total_delay']; ?> دقيقة</p>
                    </div>
                    <div class="bg-rose-50 border border-rose-200 rounded-xl p-5 text-center">
                        <p class="text-rose-600 font-bold text-sm">إجمالي الخصومات المحتسبة</p>
                        <p class="text-2xl font-extrabold text-rose-900 mt-1">-<?php echo number_format($staff_stats['total_deductions'], 2); ?> ر.ي</p>
                    </div>
                    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-5 text-center">
                        <p class="text-emerald-600 font-bold text-sm">صافي الراتب المستحق</p>
                        <p class="text-2xl font-extrabold text-emerald-950 mt-1"><?php echo number_format($staff_stats['net_salary'], 2); ?> ر.ي</p>
                    </div>
                </div>

                <!-- جدول تفاصيل حضور الموظف/المدرس المالي والدوامي -->
                <div class="overflow-x-auto">
                    <table class="w-full text-right border-collapse">
                        <thead>
                            <tr class="bg-gray-100 text-gray-800">
                                <th class="px-4 py-3 text-sm font-bold border-b">اليوم والتاريخ</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">وقت حضور البصمة</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">حالة الحضور</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">دقائق التأخير</th>
                                <th class="px-4 py-3 text-sm font-bold border-b">الخصم المطبق (YER)</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <?php if (empty($staff_attendance)): ?>
                                <tr>
                                    <td colspan="5" class="px-4 py-6 text-center text-gray-400 italic">لا توجد سجلات بصمة مسجلة لهذا الكادر في هذا النطاق التاريخي.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($staff_attendance as $row): ?>
                                <tr>
                                    <td class="px-4 py-3 text-sm font-bold text-gray-800"><?php echo date('l, Y/m/d', strtotime($row['date'])); ?></td>
                                    <td class="px-4 py-3 text-sm font-semibold text-gray-700 font-mono"><?php echo htmlspecialchars($row['check_in']); ?></td>
                                    <td class="px-4 py-3 text-sm">
                                        <?php if ($row['status'] == 'present'): ?>
                                            <span class="bg-green-100 text-green-800 border border-green-200 px-2.5 py-0.5 rounded text-xs font-bold print:border-0 print:bg-transparent">منضبط</span>
                                        <?php else: ?>
                                            <span class="bg-rose-100 text-rose-800 border border-rose-200 px-2.5 py-0.5 rounded text-xs font-bold print:border-0 print:bg-transparent">متأخر</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="px-4 py-3 text-sm font-semibold <?php echo $row['delay_minutes'] > 0 ? 'text-rose-600' : 'text-gray-500'; ?>"><?php echo $row['delay_minutes']; ?> دقيقة</td>
                                    <td class="px-4 py-3 text-sm font-bold <?php echo $row['deduction_amount'] > 0 ? 'text-rose-600' : 'text-gray-500'; ?>"><?php echo number_format($row['deduction_amount'], 2); ?> ر.ي</td>
                                </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="text-center py-16 text-gray-400">
                    <i class="fa-solid fa-users-gear text-6xl mb-4 animate-bounce"></i>
                    <p class="font-bold text-sm">برجاء اختيار المدرس أو الموظف من القائمة بالأعلى لتوليد كشف حسابه وحضوره المالي.</p>
                </div>
            <?php endif; ?>
        <?php endif; ?>
        
    </div>

<?php include_once 'footer.php'; ?>
