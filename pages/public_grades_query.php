<!-- صفحات الاستعلام العام عن نتائج امتحانات الطلاب -->
<div style="background:white; padding:40px; border-radius:20px; box-shadow:0 10px 40px rgba(0,0,0,0.05); overflow:hidden; direction:rtl; text-align:right; font-family:'Cairo', sans-serif; border-top: 5px solid #0d4748; margin-top:20px; margin-bottom: 20px;">
    
    <div style="text-align:center; margin-bottom:35px; position:relative;">
        <h2 style="color:#0d4748; margin:0 0 10px; font-size:26px; font-weight:bold; display:flex; align-items:center; justify-content:center; gap:10px;">
            <i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> نظام الاستعلام عن نتائج الامتحانات
        </h2>
        <p style="color:#666; margin:0 auto; max-width:650px; font-size:15px; line-height:1.7;">أدخل الرقم الأكاديمي المكتوب على بطاقتك الجامعية للاطلاع على كشف الدرجات التفصيلي فور صدوره واعتماده.</p>
        <div style="width:70px; height:4px; background:#ffd700; margin:15px auto 0; border-radius:2px;"></div>
    </div>

    <?php
    $student_id_input = "";
    $searched = false;
    $student = null;
    $grades_list = [];
    $error_msg = "";
    
    // إذا كان الطالب مسجلاً دخوله بالفعل، نقوم بجلب بياناته ودرجاته تلقائياً دون الحاجة لكتابة رقمه الأكاديمي
    if (isset($is_logged_in) && $is_logged_in && isset($is_student) && $is_student && !$searched) {
        $query_student = "SELECT * FROM users WHERE id = " . intval($_SESSION['user_id']) . " AND role = 'student' LIMIT 1";
        $res_student = mysqli_query($conn, $query_student);
        if ($res_student && mysqli_num_rows($res_student) == 1) {
            $student = mysqli_fetch_assoc($res_student);
            $searched = true;
            $student_id_input = $student['student_id'];
            if ($student['payment_status'] !== 'paid') {
                $student = 'blocked';
            } else {
                $query_grades = "SELECT g.*, s.subject_name, s.subject_code 
                                 FROM grades g 
                                 JOIN subjects s ON g.subject_id = s.id 
                                 WHERE g.student_id = {$student['id']} 
                                 ORDER BY s.id ASC";
                $res_grades = mysqli_query($conn, $query_grades);
                while ($grade = mysqli_fetch_assoc($res_grades)) {
                    $grades_list[] = $grade;
                }
            }
        }
    }

    // معالجة طلب الاستعلام
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['query_grades'])) {
        $student_id_input = trim(mysqli_real_escape_string($conn, $_POST['student_id']));
        $searched = true;
        
        if (empty($student_id_input)) {
            $error_msg = "<i class='fa-solid fa-triangle-exclamation' style='margin-left: 5px;'></i> يرجى إدخال الرقم الأكاديمي للجامعة أولاً.";
        } else {
            // الاستعلام عن بيانات الطالب بالرقم الجامعي (student_id) أو الهوية الوطنية
            $query_student = "SELECT * FROM users WHERE student_id = '$student_id_input' AND role = 'student' LIMIT 1";
            $res_student = mysqli_query($conn, $query_student);
            
            if (mysqli_num_rows($res_student) == 1) {
                $student = mysqli_fetch_assoc($res_student);
                
                // التحقق من حالة دفع الرسوم الدراسية
                if ($student['payment_status'] !== 'paid') {
                    $student = 'blocked'; // النتائج محجوبة
                } else {
                    // جلب درجات الطالب مع أسماء المواد ورموزها
                    $query_grades = "SELECT g.*, s.subject_name, s.subject_code 
                                     FROM grades g 
                                     JOIN subjects s ON g.subject_id = s.id 
                                     WHERE g.student_id = {$student['id']} 
                                     ORDER BY s.id ASC";
                    $res_grades = mysqli_query($conn, $query_grades);
                    while ($grade = mysqli_fetch_assoc($res_grades)) {
                        $grades_list[] = $grade;
                    }
                }
            } else {
                $error_msg = "❌ الرقم الأكاديمي المدخل غير موجود بالنظام. يرجى التحقق من الرقم المكتوب على بطاقتك الجامعية والمحاولة مجدداً.";
            }
        }
    }
    ?>

    <?php if (!$searched || !empty($error_msg)): ?>
        <!-- واجهة الاستعلام والبحث -->
        <?php if (!empty($error_msg)): ?>
            <div style="background:#f4fafb; color:#c53030; padding:15px; border-radius:10px; margin-bottom:25px; border-right:4px solid #c53030; font-weight:bold; font-size:14px;">
                <?php echo $error_msg; ?>
            </div>
        <?php endif; ?>

        <div style="max-width:550px; margin:0 auto; background:#fafafa; border:1px solid #eaeaea; border-radius:15px; padding:35px; box-shadow:0 4px 15px rgba(0,0,0,0.02);">
            <div style="text-align:center; margin-bottom:25px;">
                <span style="font-size:50px;">🔍</span>
                <h3 style="color:#0d4748; margin:10px 0 5px; font-weight:bold;">البحث برقم البطاقة الجامعية</h3>
                <p style="color:#777; font-size:13px;">قم بكتابة رقمك الجامعي كامل كما هو موضح بالبطاقة (مثال: 2026001)</p>
            </div>
            
            <form method="POST">
                <div style="margin-bottom:20px;">
                    <label style="display:block; font-weight:bold; margin-bottom:8px; color:#333;">الرقم الجامعي الأكاديمي:</label>
                    <input type="text" name="student_id" placeholder="أدخل الرقم الأكاديمي هنا..." required 
                           style="width:100%; padding:14px; border:1.5px solid #ddd; border-radius:10px; font-size:16px; font-family:'Cairo',sans-serif; text-align:center; box-sizing:border-box;"
                           onfocus="this.style.borderColor='#0d4748';" onblur="this.style.borderColor='#ddd';">
                </div>
                <button type="submit" name="query_grades" 
                        style="width:100%; padding:14px; background:#0d4748; color:white; border:none; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; font-family:'Cairo',sans-serif;"
                        onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white';">
                    🔍 استعلام واستخراج النتيجة
                </button>
            </form>
        </div>

    <?php elseif ($student === 'blocked'): ?>
        <!-- حالة حجب النتائج بسبب عدم دفع الرسوم المدرسية -->
        <div style="max-width:600px; margin:40px auto; background:#fffaf0; border:1.5px solid #fbd38d; border-radius:20px; padding:45px 35px; text-align:center; box-shadow:0 10px 30px rgba(0,0,0,0.04); border-top:6px solid #dd6b20;">
            <div style="font-size:65px; margin-bottom:15px; animation: pulse 2s infinite;">🔒</div>
            <h3 style="color:#dd6b20; font-size:22px; font-weight:bold; margin:0 0 15px;">النتائج محجوبة مؤقتاً</h3>
            <p style="color:#666; font-size:15px; line-height:1.8; margin-bottom:25px;">عذراً، تظهر السجلات المالية أن الرسوم الدراسية الخاصة بهذا الرقم الجامعي لم تسدد بالكامل بعد، لذلك تم حجب كشف الدرجات بموجب اللائحة المالية للكلية.</p>
            
            <div style="background:white; padding:20px; border-radius:12px; border:1.5px dashed #fbd38d; margin-bottom:25px; text-align:right;">
                <h4 style="margin:0 0 10px 0; color:#dd6b20; font-weight:bold; font-size:14px;">💡 خطوات تفعيل الحساب وحظر الحجب:</h4>
                <ul style="margin:0; padding-right:20px; font-size:13.5px; color:#555; line-height:1.7;">
                    <li style="margin-bottom:8px;">سداد القسط المستحق للرسوم عبر المحاسب المالي للكلية أو عبر التحويلات المعتمدة.</li>
                    <li style="margin-bottom:8px;">الدخول لبوابة الطالب الإلكترونية ورفع صورة إيصال التحويل في تبويب "رفع إيصال الدفع".</li>
                    <li style="margin-bottom:0;">سيقوم موظف شؤون الطلاب بتفعيل حسابك فور التحقق، لتظهر نتيجتك فورا هنا!</li>
                </ul>
            </div>
            
            <div style="display:flex; justify-content:center; gap:15px; flex-wrap:wrap;">
                <a href="?p=grades" style="background:#eaeaea; color:#333; padding:12px 25px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:bold; transition:0.3s;" onmouseover="this.style.background='#dddddd';" onmouseout="this.style.background='#eaeaea';">← استعلام عن رقم آخر</a>
                <a href="?p=login" style="background:#0d4748; color:white; padding:12px 25px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:bold; transition:0.3s;" onmouseover="this.style.background='#072928';" onmouseout="this.style.background='#0d4748';">🔑 تسجيل الدخول للبوابة</a>
            </div>
        </div>

    <?php elseif ($student): ?>
        <!-- عرض النتيجة بالتفصيل الشديد لكشف الدرجات الأكاديمي -->
        
        <!-- كرت بيانات الطالب الرئيسي -->
        <div id="printResultArea">
            
            <!-- هيدر خاص للطباعة والـ PDF (مخفي في المتصفح الافتراضي ويظهر بالطباعة) -->
            <div style="display:none; text-align:center; border-bottom:3.5px solid #1c7f7c; padding-bottom:15px; margin-bottom:25px;" id="printHeaderLogo">
                <img src="images/logo.png" style="max-height:115px; width:auto; display:block; margin:0 auto 10px auto;" onerror="this.src='logo.png';">
                <h2 style="color:#0d4748; font-size:20px; font-weight:bold; margin:0 0 5px;">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h2>
                <p style="color:#666; font-size:12px; margin:0;">تقرير كشف درجات الطلاب الأكاديمي للفصل الدراسي المعتمد 2026/2027 م</p>
            </div>

            <div style="background:#f0fdfa; border:1px solid #99f6e4; border-radius:15px; padding:25px; margin-bottom:30px; display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:20px;">
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        الاسم الرباعي للطالب:
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['full_name']); ?></strong>
                </div>
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"></rect><line x1="1" y1="10" x2="23" y2="10"></line></svg>
                        الرقم الجامعي (ID):
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['student_id']); ?></strong>
                </div>
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><circle cx="12" cy="12" r="10"></circle><path d="M12 16v-4"></path><path d="M12 8h.01"></path></svg>
                        القسم / الكلية:
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['college'] ?? 'غير محدد'); ?></strong>
                </div>
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c0 2 2 3 6 3s6-1 6-3v-5"></path></svg>
                        التخصص الأكاديمي:
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['department'] ?? 'غير محدد'); ?></strong>
                </div>
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                        المستوى الدراسي:
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['level'] ?? '-'); ?></strong>
                </div>
                <div>
                    <span style="color:#777; font-size:13px; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle;"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
                        الترم / الفصل الدراسي:
                    </span>
                    <strong style="color:#0d4748; font-size:15px;"><?php echo htmlspecialchars($student['semester'] ?? '-'); ?></strong>
                </div>
            </div>

            <?php if (empty($grades_list)): ?>
                <div style="background:#ebf8ff; color:#2b6cb0; padding:20px; border-radius:10px; border-right:4px solid #2b6cb0; text-align:center;">
                    🎓 الطالب مسجل بقواعد بيانات الكلية، ولكن لم يتم رصد واعتماد أي درجات لمواده الدراسية لهذا الترم حتى الآن.
                </div>
            <?php else: ?>
                <!-- جدول كشف الدرجات التفصيلي -->
                <div style="overflow-x:auto;">
                    <table style="width:100%; border-collapse:collapse; text-align:right; min-width:750px;" id="gradesTranscriptTable">
                        <thead>
                            <tr style="background:linear-gradient(135deg, #0d4748, #1c7f7c); color:white;">
                                <th style="padding:12px; border-radius: 0 8px 8px 0; width:15%;">رمز المادة</th>
                                <th style="padding:12px; width:35%;">المادة الدراسية</th>
                                <th style="padding:12px; text-align:center; width:10%;">أعمال السنة</th>
                                <th style="padding:12px; text-align:center; width:10%;">الحضور</th>
                                <th style="padding:12px; text-align:center; width:10%;">المشاركة</th>
                                <th style="padding:12px; text-align:center; width:10%;">النهائي</th>
                                <th style="padding:12px; text-align:center; width:10%;">المجموع</th>
                                <th style="padding:12px; text-align:center; border-radius: 8px 0 0 8px; width:10%;">التقدير</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $total_sum = 0;
                            $count = 0;
                            foreach ($grades_list as $row): 
                                $total_sum += floatval($row['total_grade']);
                                $count++;
                            ?>
                            <tr style="border-bottom:1px solid #e2e8f0; transition:0.2s;" onmouseover="this.style.background='#fbfcfe';" onmouseout="this.style.background='none';">
                                <td style="padding:14px; color:#555; font-family:monospace; font-weight:bold;"><?php echo htmlspecialchars($row['subject_code'] ?? 'SUB'); ?></td>
                                <td style="padding:14px; font-weight:bold; color:#2d3748;"><?php echo htmlspecialchars($row['subject_name']); ?></td>
                                <td style="padding:14px; text-align:center; color:#4a5568;"><?php echo $row['year_work'] ?? '-'; ?></td>
                                <td style="padding:14px; text-align:center; color:#4a5568;"><?php echo $row['attendance_grade'] ?? '-'; ?></td>
                                <td style="padding:14px; text-align:center; color:#4a5568;"><?php echo $row['participation_grade'] ?? '-'; ?></td>
                                <td style="padding:14px; text-align:center; color:#4a5568;"><?php echo $row['final_grade'] ?? '-'; ?></td>
                                <td style="padding:14px; text-align:center; font-weight:bold; color:#0d4748;"><?php echo $row['total_grade'] ?? '-'; ?></td>
                                <td style="padding:14px; text-align:center;">
                                    <span style="background:#1c7f7c; color:white; padding:3px 10px; border-radius:15px; font-size:12px; font-weight:bold; display:inline-block; min-width:35px;"><?php echo htmlspecialchars($row['grade_letter'] ?? '-'); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <!-- حساب المعدل الأكاديمي والتقدير العام -->
                <?php 
                $average = $count > 0 ? ($total_sum / $count) : 0;
                
                // تحديد التقدير العام
                $g_estimate = "مقبول";
                $badge_color = "#4a5568";
                $badge_bg = "#edf2f7";
                
                if ($average >= 90) {
                    $g_estimate = "ممتاز 🌟";
                    $badge_color = "#1b5e20";
                    $badge_bg = "#e8f5e9";
                } elseif ($average >= 80) {
                    $g_estimate = "جيد جداً";
                    $badge_color = "#0d47a1";
                    $badge_bg = "#e3f2fd";
                } elseif ($average >= 70) {
                    $g_estimate = "جيد";
                    $badge_color = "#e65100";
                    $badge_bg = "#fff3e0";
                } elseif ($average >= 50) {
                    $g_estimate = "مقبول";
                    $badge_color = "#333";
                    $badge_bg = "#f4f4f4";
                } else {
                    $g_estimate = "ضعيف / راسب 🛑";
                    $badge_color = "#b71c1c";
                    $badge_bg = "#ffebee";
                }
                ?>
                <div style="margin-top:30px; display:grid; grid-template-columns:repeat(auto-fit, minmax(280px, 1fr)); gap:20px;">
                    <!-- كارت المعدل والتقدير -->
                    <div style="background:#fcfdfd; border:1px solid #d2e4f1; border-radius:12px; padding:20px; display:flex; align-items:center; gap:20px;">
                        <div style="font-size:45px; background:#e6f2fa; width:80px; height:80px; border-radius:10px; display:flex; align-items:center; justify-content:center; color:#0d4748;"><i class="fa-solid fa-chart-line"></i></div>
                        <div>
                            <span style="color:#777; font-size:13px; display:block;">المعدل المئوي العام للترم:</span>
                            <strong style="color:#0d4748; font-size:24px; font-weight:bold;"><?php echo number_format($average, 2); ?>%</strong>
                        </div>
                    </div>
                    
                    <div style="background:<?php echo $badge_bg; ?>; border:1px solid <?php echo $badge_color; ?>44; border-radius:12px; padding:20px; display:flex; align-items:center; gap:20px;">
                        <div style="font-size:45px; background:white; width:80px; height:80px; border-radius:10px; display:flex; align-items:center; justify-content:center; border:1px solid #eee; color:#ffd700;"><i class="fa-solid fa-trophy"></i></div>
                        <div>
                            <span style="color:#777; font-size:13px; display:block;">التقدير العام (GPA Category):</span>
                            <strong style="color:<?php echo $badge_color; ?>; font-size:22px; font-weight:bold;"><?php echo $g_estimate; ?></strong>
                        </div>
                    </div>
                </div>

                <!-- توقيعات كرت النتيجة للطباعة (مخفي في المتصفح ويظهر بالطباعة) -->
                <div style="display:none; justify-content:space-between; margin-top:60px; text-align:center; padding-top:20px; border-top:1.5px dashed #ccc;" id="printSignatures">
                    <div>
                        <p style="font-weight:bold; margin-bottom:50px;">المسجل العام للكلية</p>
                        <p>.......................................</p>
                    </div>
                    <div>
                        <p style="font-weight:bold; margin-bottom:50px;">إدارة شؤون الطلاب</p>
                        <p>.......................................</p>
                    </div>
                    <div>
                        <p style="font-weight:bold; margin-bottom:50px;">عمادة الكلية</p>
                        <p>.......................................</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <?php if (!empty($grades_list)): ?>
            <!-- أزرار التحكم والمشاركة والتنزيل -->
            <div style="margin-top:40px; padding-top:25px; border-top:1.5px solid #f4f6f8; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px;">
                <div style="display:flex; gap:10px;">
                    <button onclick="printStudentTranscript()" style="background:#16a34a; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(22,163,74,0.2);" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#16a34a'; this.style.color='white';">
                        <i class="fa-solid fa-print" style="margin-left: 5px;"></i> طباعة كشف الدرجات
                    </button>
                    <button onclick="printStudentTranscript()" style="background:#0d4748; color:white; padding:12px 25px; border:none; border-radius:8px; cursor:pointer; font-size:14px; font-weight:bold; display:flex; align-items:center; gap:8px; transition:0.3s; box-shadow:0 4px 12px rgba(13, 71, 72,0.2);" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white';">
                        <i class="fa-solid fa-file-pdf" style="margin-left: 5px;"></i> حفظ كملف PDF
                    </button>
                </div>
                
                <a href="?p=grades" style="background:#eee; color:#333; padding:12px 25px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:bold; transition:0.3s;" onmouseover="this.style.background='#dddddd';" onmouseout="this.style.background='#eee';">
                    🔍 استعلام جديد برقم آخر
                </a>
            </div>
            
            <script>
            function printStudentTranscript() {
                var printWin = window.open('', '_blank');
                printWin.document.write('<html><head><title>كشف_الدرجات_الجامعي_<?php echo htmlspecialchars($student['student_id']); ?></title>');
                printWin.document.write('<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700;800&display=swap" rel="stylesheet">');
                printWin.document.write('<style>');
                printWin.document.write('body { font-family: "Cairo", sans-serif; direction: rtl; padding: 25px; background: #fff; }');
                printWin.document.write('#printHeaderLogo { display: block !important; text-align: center; border-bottom: 3.5px solid #1c7f7c; padding-bottom: 15px; margin-bottom: 25px; }');
                printWin.document.write('.slider-content, .cal-filter-btn, button, a { display:none !important; }');
                printWin.document.write('#printSignatures { display: flex !important; justify-content: space-between; margin-top: 60px; text-align: center; }');
                printWin.document.write('table { width: 100%; border-collapse: collapse; text-align: right; margin-top: 20px; }');
                printWin.document.write('th { background: linear-gradient(135deg, #0d4748, #1c7f7c) !important; color: white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding: 12px; font-size: 14px; }');
                printWin.document.write('td { padding: 12px; border-bottom: 1px solid #ddd; font-size: 13px; color: #333; }');
                printWin.document.write('.transcript-info { background:#f0fdfa; border:1px solid #99f6e4; border-radius:10px; padding:20px; display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:20px; }');
                printWin.document.write('.gpa-card { background:#f0fdfa; border:1px solid #99f6e4; border-radius:10px; padding:15px; display:inline-block; margin-top:20px; margin-left:15px; width:45%; }');
                printWin.document.write('.badge { background:#1c7f7c !important; color:white !important; -webkit-print-color-adjust: exact; print-color-adjust: exact; padding:3px 10px; border-radius:15px; font-size:11px; }');
                printWin.document.write('</style></head><body>');
                
                // كتابة المحتوى
                printWin.document.write('<div id="printHeaderLogo">');
                printWin.document.write('<img src="images/logo.png" style="max-height: 145px; width: auto; display: block; margin: 0 auto 10px auto;" onerror="this.src=\'logo.png\';">');
                printWin.document.write('<h2 style="font-size:20px; font-weight:bold; margin:0 0 5px; color:#0d4748;">كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h2>');
                printWin.document.write('<p style="font-size:12px; color:#666; margin:0;"><i class="fa-solid fa-file-pdf" style="margin-left: 5px;"></i> تقرير كشف الدرجات الأكاديمي الرسمي للطلاب</p>');
                printWin.document.write('</div>');
                
                printWin.document.write('<div class="transcript-info" style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:20px; padding:15px; background:#f0fdfa; border:1px solid #99f6e4; border-radius:8px;">');
                printWin.document.write('<div><strong style="color:#0d4748;">الاسم الكامل: </strong><?php echo htmlspecialchars($student['full_name']); ?></div>');
                printWin.document.write('<div><strong style="color:#0d4748;">الرقم الجامعي: </strong><?php echo htmlspecialchars($student['student_id']); ?></div>');
                printWin.document.write('<div><strong style="color:#0d4748;">القسم / الكلية: </strong><?php echo htmlspecialchars($student['college'] ?? 'غير محدد'); ?></div>');
                printWin.document.write('<div><strong style="color:#0d4748;">التخصص الأكاديمي: </strong><?php echo htmlspecialchars($student['department'] ?? 'غير محدد'); ?></div>');
                printWin.document.write('<div><strong style="color:#0d4748;">المستوى الدراسي: </strong><?php echo htmlspecialchars($student['level'] ?? '-'); ?></div>');
                printWin.document.write('<div><strong style="color:#0d4748;">الترم / الفصل الدراسي: </strong><?php echo htmlspecialchars($student['semester'] ?? '-'); ?></div>');
                printWin.document.write('</div>');
                
                printWin.document.write('<table>');
                printWin.document.write('<thead><tr><th>رمز المادة</th><th>المادة الدراسية</th><th style="text-align:center;">أعمال السنة</th><th style="text-align:center;">الحضور</th><th style="text-align:center;">المشاركة</th><th style="text-align:center;">النهائي</th><th style="text-align:center;">المجموع</th><th style="text-align:center;">التقدير</th></tr></thead>');
                printWin.document.write('<tbody>');
                
                <?php foreach ($grades_list as $row): ?>
                printWin.document.write('<tr><td><?php echo htmlspecialchars($row['subject_code'] ?? 'SUB'); ?></td><td><strong><?php echo htmlspecialchars($row['subject_name']); ?></strong></td><td style="text-align:center;"><?php echo $row['year_work']; ?></td><td style="text-align:center;"><?php echo $row['attendance_grade']; ?></td><td style="text-align:center;"><?php echo $row['participation_grade']; ?></td><td style="text-align:center;"><?php echo $row['final_grade']; ?></td><td style="text-align:center; font-weight:bold; color:#0d4748;"><?php echo $row['total_grade']; ?></td><td style="text-align:center;"><span class="badge"><?php echo htmlspecialchars($row['grade_letter']); ?></span></td></tr>');
                <?php endforeach; ?>
                
                printWin.document.write('</tbody></table>');
                
                printWin.document.write('<div style="display:flex; margin-top:20px; justify-content:space-between;">');
                printWin.document.write('<div class="gpa-card"><strong>المعدل المئوي العام: </strong><?php echo number_format($average, 2); ?>%</div>');
                printWin.document.write('<div class="gpa-card" style="background:<?php echo $badge_bg; ?>; border-color:<?php echo $badge_color; ?>44; color:<?php echo $badge_color; ?>;"><strong>التقدير العام: </strong><?php echo $g_estimate; ?></div>');
                printWin.document.write('</div>');
                
                printWin.document.write('<div id="printSignatures">');
                printWin.document.write('<div><p style="font-weight:bold; margin-bottom:50px;">المسجل العام للكلية</p><p>.......................................</p></div>');
                printWin.document.write('<div><p style="font-weight:bold; margin-bottom:50px;">إدارة شؤون الطلاب</p><p>.......................................</p></div>');
                printWin.document.write('<div><p style="font-weight:bold; margin-bottom:50px;">عمادة الكلية</p><p>.......................................</p></div>');
                printWin.document.write('</div>');
                
                printWin.document.write('<script>window.onload = function() { window.print(); }<\/script>');
                printWin.document.write('</body></html>');
                printWin.document.close();
            }
            
            function copyResultLink() {
                var dummy = document.createElement('input'),
                text = window.location.href;
                document.body.appendChild(dummy);
                dummy.value = text;
                dummy.select();
                document.execCommand('copy');
                document.body.removeChild(dummy);
                
                var alertBox = document.getElementById('copyAlert');
                if (alertBox) {
                    alertBox.style.display = 'block';
                    setTimeout(function() {
                        alertBox.style.display = 'none';
                    }, 2000);
                }
            }

            function shareInstagram() {
                copyResultLink();
                alert("✓ تم نسخ رابط الاستعلام بنجاح! يمكنك الآن لصقه ومشاركته في قصة (Story) أو رسائل إنستغرام الخاصة بك.");
            }
            </script>
        <?php endif; ?>

    <?php endif; ?>

    <!-- إشعار المشاركة ومربع التذييل -->
    <div style="margin-top: 35px; padding-top: 25px; border-top: 1.5px solid #f4f6f8; text-align: center; direction: rtl;">
        <span style="font-size: 16px; font-weight: bold; color: #0d4748; display: inline-block; margin-left: 20px; vertical-align: middle; margin-bottom: 10px;">مشاركة النتيجة</span>
        <div style="display: inline-flex; justify-content: center; gap: 10px; flex-wrap: wrap; vertical-align: middle; margin-bottom: 10px;">
            <!-- فيسبوك -->
            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #3b5998; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#f0f4f9'; this.style.borderColor='#3b5998';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                فيسبوك
            </a>
            <!-- تويتر -->
            <a href="https://twitter.com/intent/tweet?text=<?php echo urlencode('رابط الاستعلام عن نتائج امتحانات كلية سماء المتميزين: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #1da1f2; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#f0f8ff'; this.style.borderColor='#1da1f2';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                تويتر
            </a>
            <!-- واتساب -->
            <a href="https://api.whatsapp.com/send?text=<?php echo urlencode('رابط الاستعلام عن نتائج امتحانات كلية سماء المتميزين: ' . (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #25d366; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#e8fced'; this.style.borderColor='#25d366';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
                واتساب
            </a>
            <!-- تيليجرام -->
            <a href="https://t.me/share/url?url=<?php echo urlencode((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode('استعلم الآن عن نتيجة الامتحانات بكلية سماء المتميزين'); ?>" target="_blank" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #0088cc; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#e6f4fc'; this.style.borderColor='#0088cc';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M20.66 4.98l-2.76 13c-.15.68-.55.85-1.12.53l-4.2-3.1-2.03 1.95c-.22.22-.4.4-.83.4l.3-4.23 7.68-6.93c.33-.3-.07-.46-.5-.18L7.66 13.5l-4.1-1.28c-.9-.28-.9-.88.18-1.3L19.9 4.7c.75-.28 1.4.16 1.13 1.25z"/></svg>
                تيليجرام
            </a>
            <!-- انستجرام -->
            <a href="javascript:void(0);" onclick="shareInstagram()" 
               style="display: inline-flex; align-items: center; gap: 8px; padding: 8px 16px; border: 1px solid #ddd; border-radius: 8px; background: white; color: #e1306c; text-decoration: none; font-size: 14px; font-weight: bold; transition: all 0.2s;"
               onmouseover="this.style.background='#ecf4f4'; this.style.borderColor='#e1306c';" onmouseout="this.style.background='white'; this.style.borderColor='#ddd';">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="display:inline-block; vertical-align:middle;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                انستجرام
            </a>
        </div>
        <div id="copyAlert" style="display: none; color: #16a34a; font-size: 13px; font-weight: bold; margin-top: 10px; transition: all 0.3s;">✓ تم نسخ الرابط بنجاح!</div>
        
        <!-- زر العودة للصفحة الرئيسية -->
        <div style="margin-top: 30px;">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
        </div>
    </div>

</div>
