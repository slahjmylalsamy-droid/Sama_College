<?php
// pages/complaints.php - تقديم شكوى / مقترح ومتابعتها
if (!defined('conn') && !isset($conn)) {
    include 'db_connect.php';
}

$msg = "";
$track_result = null;
$searched_code = "";
$track_error = "";

// معالجة تقديم شكوى جديدة
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_complaint'])) {
    // التحقق من الحماية ضد السبام
    $spam_ans = intval($_POST['spam_answer'] ?? 0);
    $spam_chk = intval($_POST['spam_check'] ?? 0);
    
    if ($spam_ans !== $spam_chk) {
        $msg = '<div style="background:#f0f7f7; color:#b91c1c; border-right:4px solid #b91c1c; padding:15px; border-radius:8px; margin-bottom:20px; font-weight:bold; font-size:14px;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> رمز التحقق البشري غير صحيح، يرجى المحاولة مجدداً.</div>';
    } else {
        $sender_name = trim(mysqli_real_escape_string($conn, $_POST['sender_name'] ?? ''));
        $sender_phone = trim(mysqli_real_escape_string($conn, $_POST['sender_phone'] ?? ''));
        $sender_email = trim(mysqli_real_escape_string($conn, $_POST['sender_email'] ?? ''));
        $sender_type = mysqli_real_escape_string($conn, $_POST['sender_type']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $subject = trim(mysqli_real_escape_string($conn, $_POST['subject']));
        $message = trim(mysqli_real_escape_string($conn, $_POST['message']));
        
        if (empty($subject) || empty($message)) {
            $msg = '<div style="background:#f0f7f7; color:#b91c1c; border-right:4px solid #b91c1c; padding:15px; border-radius:8px; margin-bottom:20px; font-weight:bold; font-size:14px;"><i class="fa-solid fa-triangle-exclamation" style="margin-left: 5px;"></i> يرجى تعبئة عنوان الشكوى/المقترح وتفاصيل الرسالة.</div>';
        } else {
            // توليد رقم مرجعي فريد
            $ref_code = "COMP-" . rand(10000, 99999);
            
            // التأكد من عدم تكرار الرقم المرجعي
            $check_dup = mysqli_query($conn, "SELECT id FROM complaints WHERE reference_code = '$ref_code'");
            while ($check_dup && mysqli_num_rows($check_dup) > 0) {
                $ref_code = "COMP-" . rand(10000, 99999);
                $check_dup = mysqli_query($conn, "SELECT id FROM complaints WHERE reference_code = '$ref_code'");
            }
            
            $query = "INSERT INTO complaints (reference_code, sender_name, sender_phone, sender_email, sender_type, category, subject, message, status) 
                      VALUES ('$ref_code', " . 
                      (empty($sender_name) ? "NULL" : "'$sender_name'") . ", " . 
                      (empty($sender_phone) ? "NULL" : "'$sender_phone'") . ", " . 
                      (empty($sender_email) ? "NULL" : "'$sender_email'") . ", 
                      '$sender_type', '$category', '$subject', '$message', 'قيد المراجعة')";
                      
            if (mysqli_query($conn, $query)) {
                $msg = '<div style="background:#f0fdf4; color:#16a34a; border-right:4px solid #16a34a; padding:25px; border-radius:15px; margin-bottom:25px; box-shadow:0 4px 15px rgba(22,163,74,0.08);">
                            <div style="font-size:40px; margin-bottom:10px;">🎉</div>
                            <h3 style="margin:0 0 10px 0; font-size:18px; font-weight:bold;">تم تقديم شكواك/مقترحك بنجاح!</h3>
                            <p style="margin:0 0 15px 0; font-size:14px; color:#4a5568; line-height:1.6;">نشكرك على مشاركتنا رأيك. لقد تم توليد رقم مرجعي خاص لتتمكن من متابعة حالة الشكوى والرد الإداري عليها في أي وقت.</p>
                            <div style="display:inline-flex; align-items:center; gap:10px; background:#f0fdf4; border:1.5px dashed #16a34a; padding:10px 20px; border-radius:8px;">
                                <span style="font-size:13px; color:#444;">الرقم المرجعي للمتابعة:</span>
                                <strong id="copyRefCode" style="font-size:18px; font-family:monospace; color:#0d4748; letter-spacing:1px;">' . $ref_code . '</strong>
                                <button type="button" onclick="copyRefToClipboard()" style="background:#0d4748; color:white; border:none; padding:4px 10px; border-radius:4px; font-size:11px; cursor:pointer; font-weight:bold;">نسخ الرقم</button>
                            </div>
                            <div id="copyAlert" style="display:none; color:#16a34a; font-size:12px; font-weight:bold; margin-top:8px;">✓ تم نسخ الرقم المرجعي بنجاح!</div>
                        </div>';
            } else {
                $msg = '<div style="background:#f0f7f7; color:#b91c1c; border-right:4px solid #b91c1c; padding:15px; border-radius:8px; margin-bottom:20px; font-weight:bold; font-size:14px;">❌ خطأ أثناء الإرسال: ' . mysqli_error($conn) . '</div>';
            }
        }
    }
}

// معالجة البحث ومتابعة الشكوى
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['track_complaint'])) {
    $searched_code = trim(mysqli_real_escape_string($conn, $_POST['reference_code']));
    if (empty($searched_code)) {
        $track_error = "<i class='fa-solid fa-triangle-exclamation' style='margin-left: 5px;'></i> يرجى إدخال الرقم المرجعي للشكوى أولاً.";
    } else {
        $query_track = "SELECT * FROM complaints WHERE reference_code = '$searched_code' LIMIT 1";
        $res_track = mysqli_query($conn, $query_track);
        if ($res_track && mysqli_num_rows($res_track) == 1) {
            $track_result = mysqli_fetch_assoc($res_track);
        } else {
            $track_error = "❌ لم يتم العثور على أي شكوى أو مقترح مسجل بالرقم المرجعي المدخل. يرجى التحقق وإعادة المحاولة.";
        }
    }
}

// توليد مسألة رياضية عشوائية لحماية السبام
$num1 = rand(2, 9);
$num2 = rand(2, 9);
$check_val = $num1 + $num2;
?>

<div style="max-width:1100px; margin:30px auto; padding:0 20px; font-family:'Cairo', sans-serif; direction:rtl; text-align:right;">
    
    <!-- العنوان الرئيسي والوصف -->
    <div style="text-align:center; margin-bottom:40px;">
        <h2 style="color:#0d4748; font-size:26px; font-weight:800; margin:0 0 10px 0;">📩 نظام الشكاوى والمقترحات الموحد</h2>
        <p style="color:#666; font-size:15px; margin:0; max-width:600px; margin:0 auto; line-height:1.7;">يسعدنا في كلية سماء المتميزين الاستماع إلى آرائكم، مقترحاتكم، أو شكاواكم للارتقاء بجودة الخدمات التعليمية والإدارية المقدمة.</p>
    </div>

    <?php echo $msg; ?>

    <div style="display:grid; grid-template-columns:1.8fr 1.2fr; gap:30px; align-items:start; flex-wrap:wrap;">
        
        <!-- قسم تقديم شكوى أو مقترح جديد -->
        <div style="background:white; border-radius:20px; padding:30px; box-shadow:0 10px 30px rgba(0,0,0,0.05); border-top:5px solid #1c7f7c;">
            <h3 style="color:#0d4748; font-size:18px; font-weight:bold; margin:0 0 20px 0; display:flex; align-items:center; gap:8px;">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 1 1 3 3L12 15l-4 1 1-4z"></path></svg>
                تعبئة طلب جديد
            </h3>
            
            <form method="POST" action="">
                
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">الاسم الكامل (اختياري):</label>
                        <input type="text" name="sender_name" placeholder="يمكنك تركه فارغاً للإرسال بسرية" style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box;">
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">رقم الجوال (اختياري):</label>
                        <input type="text" name="sender_phone" placeholder="مثال: 777XXXXXX" style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box; text-align:left;">
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:15px; margin-bottom:15px;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">البريد الإلكتروني (اختياري):</label>
                        <input type="email" name="sender_email" placeholder="name@example.com" style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box; text-align:left;">
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">صفة المرسل:</label>
                        <select name="sender_type" required style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box; background:white;">
                            <option value="طالب">طالب بالكلية</option>
                            <option value="ولي أمر">ولي أمر طالب</option>
                            <option value="موظف">كادر تعليمي / إداري</option>
                            <option value="زائر">زائر / أخرى</option>
                        </select>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1.2fr 1.8fr; gap:15px; margin-bottom:15px;">
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">تصنيف الرسالة:</label>
                        <select name="category" required style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box; background:white;">
                            <option value="أكاديمي">أكاديمي وتعليمي</option>
                            <option value="مالي">شؤون مالية ورسوم</option>
                            <option value="إداري">شؤون إدارية وتنظيمية</option>
                            <option value="خدمات ومرافق">خدمات عامة ومرافق</option>
                            <option value="مقترح تطويري">مقترح تطويري للكلية</option>
                            <option value="تقني">مشكلة تقنية بالموقع</option>
                            <option value="أخرى">أخرى</option>
                        </select>
                    </div>
                    <div>
                        <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">موضوع الرسالة / العنوان:</label>
                        <input type="text" name="subject" required placeholder="أكتب خلاصة الموضوع باختصار" style="width:100%; padding:10px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; box-sizing:border-box;">
                    </div>
                </div>

                <div style="margin-bottom:20px;">
                    <label style="display:block; font-size:13px; font-weight:bold; color:#4a5568; margin-bottom:6px;">تفاصيل الشكوى أو المقترح بالتفصيل:</label>
                    <textarea name="message" required rows="6" placeholder="اكتب تفاصيل شكواك أو مقترحك هنا بدقة ووضوح..." style="width:100%; padding:12px; border:1.5px solid #e2e8f0; border-radius:8px; font-family:'Cairo', sans-serif; font-size:14px; line-height:1.6; box-sizing:border-box; resize:vertical;"></textarea>
                </div>

                <!-- التحقق البشري ضد السبام -->
                <div style="background:#f8fafc; border:1px solid #e2e8f0; padding:15px; border-radius:10px; margin-bottom:20px; display:flex; align-items:center; justify-content:space-between; gap:15px; flex-wrap:wrap;">
                    <div style="display:flex; align-items:center; gap:8px;">
                        <span style="font-size:18px;">🤖</span>
                        <span style="font-size:13.5px; color:#4a5568;">التحقق الأمني: ما هو ناتج <strong><?php echo $num1; ?> + <?php echo $num2; ?></strong> ؟</span>
                    </div>
                    <div>
                        <input type="hidden" name="spam_check" value="<?php echo $check_val; ?>">
                        <input type="number" name="spam_answer" required placeholder="الإجابة" style="width:90px; padding:8px; border:1.5px solid #cbd5e1; border-radius:6px; font-family:'Cairo', sans-serif; font-size:14px; text-align:center;">
                    </div>
                </div>

                <button type="submit" name="submit_complaint" style="width:100%; background:linear-gradient(135deg, #0d4748, #1c7f7c); color:white; border:none; padding:12px; border-radius:10px; font-size:16px; font-weight:bold; cursor:pointer; transition:0.3s; box-shadow:0 4px 15px rgba(13, 71, 72,0.15);" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748'; this.style.transform='translateY(-1px)';" onmouseout="this.style.background='linear-gradient(135deg, #0d4748, #1c7f7c)'; this.style.color='white'; this.style.transform='none';">
                    📤 إرسال الطلب الآن
                </button>
            </form>
        </div>

        <!-- قسم متابعة شكوى سابقة -->
        <div style="display:flex; flex-direction:column; gap:25px;">
            
            <div style="background:white; border-radius:20px; padding:25px; box-shadow:0 10px 30px rgba(0,0,0,0.05); border-top:5px solid #0d4748;">
                <h3 style="color:#0d4748; font-size:18px; font-weight:bold; margin:0 0 15px 0; display:flex; align-items:center; gap:8px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#0d4748" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
                    متابعة حالة الشكوى
                </h3>
                <p style="color:#777; font-size:13px; margin:0 0 15px 0; line-height:1.6;">هل قمت بتقديم طلب سابق؟ أدخل الرقم المرجعي المكون من 5 أرقام لتتبع حالة معالجتها والرد الرسمي للكلية.</p>
                
                <form method="POST" action="">
                    <div style="margin-bottom:15px;">
                        <input type="text" name="reference_code" required value="<?php echo htmlspecialchars($searched_code); ?>" placeholder="مثال: COMP-12345" style="width:100%; padding:10px; border:1.5px solid #cbd5e1; border-radius:8px; font-family:monospace; font-size:16px; text-align:center; box-sizing:border-box; letter-spacing:1px;">
                    </div>
                    <button type="submit" name="track_complaint" style="width:100%; background:#0d4748; color:white; border:none; padding:10px; border-radius:8px; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white';">
                        🔍 تتبع حالة الطلب
                    </button>
                </form>
                
                <?php if (!empty($track_error)): ?>
                    <div style="background:#f0f7f7; color:#b91c1c; padding:10px; border-radius:6px; margin-top:15px; font-size:12.5px; border:1px solid #fecaca; line-height:1.5;"><?php echo $track_error; ?></div>
                <?php endif; ?>
            </div>

            <!-- عرض نتيجة التتبع حال العثور عليها -->
            <?php if ($track_result): ?>
                <div style="background:#fcfdfd; border:1.5px solid #e2e8f0; border-radius:20px; padding:25px; box-shadow:0 10px 25px rgba(0,0,0,0.03);">
                    <div style="display:flex; justify-content:space-between; align-items:center; border-bottom:1.5px solid #e2e8f0; padding-bottom:12px; margin-bottom:15px;">
                        <span style="font-size:13px; color:#777;">الرقم المرجعي: <strong style="font-family:monospace; color:#0d4748; font-size:14px;"><?php echo htmlspecialchars($track_result['reference_code']); ?></strong></span>
                        
                        <?php 
                        $status = $track_result['status'];
                        $bg = "#f3f4f6"; $fg = "#4b5563";
                        if ($status === 'قيد المراجعة') { $bg = "#fffbeb"; $fg = "#d97706"; }
                        elseif ($status === 'جاري التحقق') { $bg = "#eff6ff"; $fg = "#2563eb"; }
                        elseif ($status === 'تم الرد والحل') { $bg = "#f0fdf4"; $fg = "#16a34a"; }
                        elseif ($status === 'مغلقة') { $bg = "#f3f4f6"; $fg = "#4b5563"; }
                        ?>
                        <span style="background:<?php echo $bg; ?>; color:<?php echo $fg; ?>; padding:3px 10px; border-radius:15px; font-size:12px; font-weight:bold; border:1px solid <?php echo $fg; ?>33;">
                            <?php echo $status; ?>
                        </span>
                    </div>

                    <div style="margin-bottom:15px;">
                        <span style="font-size:12px; color:#999; display:block; margin-bottom:4px;">تاريخ التقديم:</span>
                        <span style="font-size:13px; color:#4a5568; font-weight:bold;"><?php echo date('Y/m/d - H:i', strtotime($track_result['created_at'])); ?></span>
                    </div>

                    <div style="margin-bottom:15px;">
                        <span style="font-size:12px; color:#999; display:block; margin-bottom:4px;">موضوع الطلب:</span>
                        <strong style="font-size:14px; color:#0d4748;"><?php echo htmlspecialchars($track_result['subject']); ?></strong>
                    </div>

                    <div style="background:white; border:1px solid #edf2f7; padding:12px; border-radius:8px; margin-bottom:20px; max-height:150px; overflow-y:auto; font-size:13.5px; color:#555; line-height:1.6;">
                        <?php echo nl2br(htmlspecialchars($track_result['message'])); ?>
                    </div>

                    <!-- الرد الرسمي للإدارة -->
                    <div style="background:#f0fdfa; border:1px solid #99f6e4; padding:15px; border-radius:12px;">
                        <span style="font-size:12px; color:#1c7f7c; font-weight:bold; display:flex; align-items:center; gap:6px; margin-bottom:6px;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#1c7f7c" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            الرد الرسمي للعمادة / شؤون الطلاب:
                        </span>
                        <p style="margin:0; font-size:13px; color:#2d3748; line-height:1.6; font-weight:500;">
                            <?php 
                            if (!empty($track_result['admin_response'])) {
                                echo nl2br(htmlspecialchars($track_result['admin_response']));
                            } else {
                                echo '<span style="color:#777; font-style:italic;">الطلب قيد المراجعة والدراسة حالياً من قبل شؤون الطلاب، وسيتم تحديث الرد هنا فوراً عند الانتهاء.</span>';
                            }
                            ?>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>

    </div>

</div>

<script>
function copyRefToClipboard() {
    var textToCopy = document.getElementById("copyRefCode").innerText;
    var dummy = document.createElement("input");
    document.body.appendChild(dummy);
    dummy.value = textToCopy;
    dummy.select();
    document.execCommand("copy");
    document.body.removeChild(dummy);
    
    var alertBox = document.getElementById("copyAlert");
    alertBox.style.display = "block";
    setTimeout(function() {
        alertBox.style.display = "none";
    }, 2000);
}
</script>
