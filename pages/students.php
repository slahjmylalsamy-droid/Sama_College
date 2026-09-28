<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}

// ترميز شعار الكلية إلى Base64 للتخلص من أي تأخير في تحميل الصورة أثناء الطباعة
$logo_base64 = '';
if (file_exists('logo.png')) {
    $logo_base64 = 'data:image/png;base64,' . base64_encode(file_get_contents('logo.png'));
}
?>

<style>
.students-grid {
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    min-height: 550px;
}
@media (max-width: 768px) {
    .students-grid {
        grid-template-columns: 1fr;
    }
}

/* ستايل حقول الإدخال والـ Floating Label والرمز */
.students-input-group {
    position: relative;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #ddd;
    padding-bottom: 4px;
    margin-bottom: 5px;
    transition: all 0.3s ease;
}
.students-input-group:focus-within {
    border-bottom: 2px solid #0d4748;
}
.students-form-input {
    border: none !important;
    outline: none !important;
    width: 100%;
    font-size: 15px;
    color: #333;
    font-family: 'Cairo', sans-serif;
    background: transparent;
    padding: 20px 0 8px 0;
    z-index: 2;
}
.students-form-select {
    border: none !important;
    outline: none !important;
    width: 100%;
    font-size: 15px;
    color: #333;
    font-family: 'Cairo', sans-serif;
    background: transparent;
    padding: 20px 0 8px 0;
    cursor: pointer;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    z-index: 2;
}

/* حاوية التسمية والرمز معاً */
.label-and-icon {
    position: absolute;
    right: 0;
    top: 55%;
    transform: translateY(-50%);
    display: flex;
    align-items: center;
    gap: 8px;
    pointer-events: none;
    transition: all 0.3s ease;
    z-index: 1;
    direction: rtl;
}
.students-form-label {
    font-size: 15px;
    color: #999;
    font-family: 'Cairo', sans-serif;
    transition: all 0.3s ease;
}
.students-form-icon {
    color: #999;
    transition: all 0.3s ease;
}

/* حركة ارتفاع التسمية والرمز معاً وانتقالهما لليسار عند التركيز أو وجود نص */
.students-form-input:focus ~ .label-and-icon,
.students-form-input:not(:placeholder-shown) ~ .label-and-icon,
.students-form-select:focus ~ .label-and-icon,
.students-form-select:valid ~ .label-and-icon {
    top: -5px;
    right: auto;
    left: 0px;
    transform: translateY(0);
}
.students-form-input:focus ~ .label-and-icon .students-form-label,
.students-form-input:not(:placeholder-shown) ~ .label-and-icon .students-form-label,
.students-form-select:focus ~ .label-and-icon .students-form-label,
.students-form-select:valid ~ .label-and-icon .students-form-label {
    color: #0d4748;
    font-size: 12px;
    font-weight: bold;
}
.students-form-input:focus ~ .label-and-icon .students-form-icon,
.students-form-input:not(:placeholder-shown) ~ .label-and-icon .students-form-icon,
.students-form-select:focus ~ .label-and-icon .students-form-icon,
.students-form-select:valid ~ .label-and-icon .students-form-icon {
    color: #0d4748;
}

.captcha-input-wrapper:focus-within {
    border-bottom: 2px solid #0d4748 !important;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ستايل الجدول المحسن والأكثر جاذبية */
.academic-calendar-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    text-align: right;
    font-size: 15px;
    border: 1px solid #eaeaea;
    border-radius: 12px;
    overflow: hidden;
}
.academic-calendar-table th {
    background: #f8f9fa;
    color: #333;
    font-weight: bold;
    padding: 18px 15px;
    border-bottom: 2px solid #eaeaea;
}
.academic-calendar-table td {
    padding: 16px 15px;
    border-bottom: 1px solid #eaeaea;
    color: #555;
    transition: background 0.2s ease;
}
.academic-calendar-table tr:last-child td {
    border-bottom: none;
}
.calendar-badge {
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: bold;
    display: inline-block;
}
.badge-active {
    background: #e8f5e9;
    color: #2e7d32;
}
.badge-upcoming {
    background: #e3f2fd;
    color: #1565c0;
}
</style>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;font-family:'Cairo', sans-serif;">
    
    <!-- القسم العلوي: سجل بالكلية والقبول والتسجيل -->
    <div style="max-width:1100px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;" class="students-grid">
        
        <!-- Left Column: Registration Form -->
        <div style="padding:50px 40px;display:flex;flex-direction:column;justify-content:center;background:white;">
            <h2 style="color:#0d4748;font-size:24px;font-weight:bold;margin:0 0 10px 0;position:relative;">
                سجل بالكلية
                <span style="display:block;width:50px;height:4px;background:#0d4748;margin-top:8px;border-radius:2px;"></span>
            </h2>
            
            <form action="" method="POST" style="margin-top:30px;display:flex;flex-direction:column;gap:25px;">
                <!-- Name Field -->
                <div class="students-input-group">
                    <input type="text" id="name" placeholder=" " required class="students-form-input">
                    <div class="label-and-icon">
                        <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        <span class="students-form-label">الاسم</span>
                    </div>
                </div>
                
                <!-- Email Field -->
                <div class="students-input-group">
                    <input type="email" id="email" placeholder=" " required class="students-form-input">
                    <div class="label-and-icon">
                        <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                        <span class="students-form-label">البريد الإلكتروني</span>
                    </div>
                </div>
                
                <!-- Phone Field -->
                <div class="students-input-group">
                    <input type="tel" id="phone" placeholder=" " required class="students-form-input">
                    <div class="label-and-icon">
                        <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                        <span class="students-form-label">التلفون</span>
                    </div>
                </div>
                
                <!-- Major Select Field -->
                <div class="students-input-group">
                    <select id="major" required class="students-form-select">
                        <option value="" disabled selected></option>
                        <option value="it">تكنولوجيا المعلومات</option>
                        <option value="graphics">تصميم جرافيكس</option>
                        <option value="arch">هندسة معمارية</option>
                        <option value="accounting">محاسبة</option>
                        <option value="business">إدارة أعمال</option>
                        <option value="pharmacy">صيدلة</option>
                        <option value="assistant">مساعد طبيب</option>
                        <option value="dentist">طب وجراحة الفم والأسنان</option>
                        <option value="midwife">قبالة وتوليد</option>
                    </select>
                    <div class="label-and-icon">
                        <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span class="students-form-label">اختر التخصص</span>
                    </div>
                    <span style="position:absolute;left:5px;top:50%;transform:translateY(-50%);color:#999;pointer-events:none;font-size:12px;z-index:3;">▼</span>
                </div>
                
                <!-- Verification Code Field -->
                <div class="students-input-group" style="justify-content: space-between; gap: 15px; border-bottom: none; padding-bottom: 0; margin-bottom: 0;">
                    <div style="position: relative; display: flex; align-items: center; width: 100%; border-bottom: 1px solid #ddd; padding-bottom: 4px; transition: all 0.3s ease;" class="captcha-input-wrapper">
                        <input type="text" id="captcha" placeholder=" " required class="students-form-input">
                        <div class="label-and-icon">
                            <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <span class="students-form-label">كود التحقق</span>
                        </div>
                    </div>
                    <?php 
                        $captcha_code = rand(100000, 999999);
                    ?>
                    <div style="background:black;color:#fff;padding:4px 15px;font-family:'Courier New', monospace;font-size:16px;font-weight:bold;letter-spacing:3px;border-radius:4px;user-select:none; z-index: 3; display: flex; align-items: center; justify-content: center; height: 32px;">
                        <?php echo $captcha_code; ?>
                    </div>
                </div>
                
                <!-- Send Button -->
                <div style="text-align:left;margin-top:10px;">
                    <button type="submit" style="background:#0d4748;color:white;border:none;padding:12px 40px;border-radius:6px;font-size:16px;font-weight:bold;font-family:'Cairo',sans-serif;cursor:pointer;transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white'">
                        ارسال
                    </button>
                </div>
            </form>
        </div>
        
        <!-- Right Column: Admission text with background image -->
        <div style="position:relative;background:url('https://images.unsplash.com/photo-1434030216411-0b793f4b4173?auto=format&fit=crop&w=800&q=80') center center/cover no-repeat;display:flex;flex-direction:column;justify-content:center;padding:50px;color:white;text-align:justify;">
            <!-- Dark Overlay -->
            <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(135deg, rgba(13, 71, 72,0.9), rgba(8, 88, 89,0.9));z-index:1;"></div>
            
            <!-- Content -->
            <div style="position:relative;z-index:2;">
                <h2 style="font-size:28px;font-weight:bold;margin:0 0 20px 0;line-height:1.4;">القبول والتسجيل</h2>
                <p style="font-size:16px;line-height:1.8;margin:0;font-weight:300;">
                    تسعى إدارة القبول والتسجيل بكلية سماء المتميزين للعلوم الصحية والتكنولوجيا إلى قبول الطلبة وتسجيلهم وفق الشروط التي تقرها وزارة التعليم العالي والبحث العلمي، وتوفير البيانات الصحيحة والتقارير الدقيقة للأقسام المختصة والجهات الأخرى المختلفة بالسرعة اللازمة.
                </p>
            </div>
        </div>
        
    </div>
    
    <!-- القسم السفلي: البرامج والرسوم (يسار) ودليل الطالب (يمين) -->
    <div style="max-width:1100px;margin:40px auto 0;background:white;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;display:grid;grid-template-columns:1fr 1.2fr;min-height:300px;" class="students-grid">
        
        <!-- Right Side in RTL: Student Guide (First Child in RTL Grid) -->
        <div style="position:relative;background:url('https://images.unsplash.com/photo-1497633762265-9d179a990aa6?auto=format&fit=crop&w=800&q=80') center center/cover no-repeat;display:flex;flex-direction:column;justify-content:center;padding:40px;color:white;text-align:justify;">
            <!-- Burgundy Overlay -->
            <div style="position:absolute;top:0;left:0;right:0;bottom:0;background:rgba(8, 88, 89,0.88);z-index:1;"></div>
            
            <!-- Content -->
            <div style="position:relative;z-index:2;display:flex;flex-direction:column;gap:15px;height:100%;justify-content:space-between;">
                <div>
                    <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#ffd700;"><line x1="9" y1="6" x2="20" y2="6"></line><line x1="9" y1="12" x2="20" y2="12"></line><line x1="9" y1="18" x2="20" y2="18"></line><line x1="5" y1="6" x2="5.01" y2="6"></line><line x1="5" y1="12" x2="5.01" y2="12"></line><line x1="5" y1="18" x2="5.01" y2="18"></line></svg>
                        <h3 style="font-size:20px;font-weight:bold;margin:0;color:#ffd700;">دليل الطالب</h3>
                    </div>
                    <p style="font-size:14px;line-height:1.7;margin:0;font-weight:300;">
                        يتضمن الدليل الشروط والضوابط العامة للقبول والتسجيل في الكلية، ونظام التقديم وآلية تسجيل الطلبة في التخصصات التي يرغب الطلبة التقديم عليها.
                    </p>
                </div>
                <div style="text-align:left;margin-top:20px;">
                    <a href="javascript:void(0);" onclick="downloadStudentGuide();" style="display:inline-block;border:2px solid white;color:white;padding:8px 25px;border-radius:4px;text-decoration:none;font-size:14px;font-weight:bold;transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748'; this.style.borderColor='rgb(189, 214, 60)';" onmouseout="this.style.background='transparent'; this.style.color='white'; this.style.borderColor='white'">
                        تحميل
                    </a>
                </div>
            </div>
        </div>

        <!-- Left Side in RTL: Programs & Tuition Fees (Second Child in RTL Grid) -->
        <div style="padding:40px;display:flex;flex-direction:column;justify-content:center;background:white;">
            <h2 style="color:#0d4748;font-size:22px;font-weight:bold;margin:0 0 10px 0;position:relative;">
                البرامج المتاحة والرسوم الدراسية
                <span style="display:block;width:50px;height:4px;background:#0d4748;margin-top:8px;border-radius:2px;"></span>
            </h2>
            
            <div style="margin-top:25px;display:flex;flex-direction:column;gap:20px;">
                <!-- Major Select Dropdown -->
                <div class="students-input-group">
                    <select id="fee_major" required class="students-form-select" onchange="updateFeesInfo()">
                        <option value="" disabled selected></option>
                        <option value="it">تكنولوجيا المعلومات</option>
                        <option value="graphics">تصميم جرافيكس</option>
                        <option value="arch">هندسة معمارية</option>
                        <option value="accounting">محاسبة</option>
                        <option value="business">إدارة أعمال</option>
                        <option value="pharmacy">صيدلة</option>
                        <option value="assistant">مساعد طبيب</option>
                        <option value="dentist">طب وجراحة الفم والأسنان</option>
                        <option value="midwife">قبالة وتوليد</option>
                    </select>
                    <div class="label-and-icon">
                        <svg class="students-form-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        <span class="students-form-label">اختر التخصص</span>
                    </div>
                    <span style="position:absolute;left:5px;top:50%;transform:translateY(-50%);color:#999;pointer-events:none;font-size:12px;z-index:3;">▼</span>
                </div>
                
                <!-- المعدل المقبول (يظهر تلقائياً بجهة اليسار على الخط) -->
                <div style="display:flex;align-items:center;border-bottom:1px solid #ddd;padding-bottom:12px;position:relative;margin-top:10px;">
                    <span id="info_avg" style="font-size:15px;color:#0d4748;font-weight:bold;margin-right:auto;opacity:0;transition:opacity 0.3s ease;">--</span>
                    <div style="display:flex;align-items:center;gap:8px;position:absolute;right:0;top:50%;transform:translateY(-50%);pointer-events:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#999;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                        <span style="color:#999;font-size:15px;font-family:'Cairo',sans-serif;">المعدل المقبول</span>
                    </div>
                </div>
                
                <!-- الرسوم الدراسية (تظهر تلقائياً بجهة اليسار على الخط) -->
                <div style="display:flex;align-items:center;border-bottom:1px solid #ddd;padding-bottom:12px;position:relative;margin-top:10px;">
                    <span id="info_fees" style="font-size:15px;color:#085859;font-weight:bold;margin-right:auto;opacity:0;transition:opacity 0.3s ease;">--</span>
                    <div style="display:flex;align-items:center;gap:8px;position:absolute;right:0;top:50%;transform:translateY(-50%);pointer-events:none;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#999;"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                        <span style="color:#999;font-size:15px;font-family:'Cairo',sans-serif;">الرسوم الدراسية</span>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    
    <!-- قسم التقويم الأكاديمي للكلية -->
    <div style="max-width:1100px;margin:40px auto 0;background:white;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.08);padding:40px;direction:rtl;" class="academic-calendar-section">
        <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; margin-bottom:25px; border-bottom:1px solid #eaeaea; padding-bottom:15px;">
            <h2 style="color:#0d4748;font-size:22px;font-weight:bold;margin:0;position:relative;">
                التقويم الأكاديمي للكلية للعام الجامعي 2026 / 2027 م
                <span style="display:block;width:50px;height:4px;background:#0d4748;margin-top:8px;border-radius:2px;"></span>
            </h2>
            <!-- زر الطباعة وتصدير PDF متجاورين -->
            <div style="display:flex; gap:10px; flex-wrap:wrap;">
                <!-- زر استخراج PDF -->
                <button onclick="exportPDF()" style="display:inline-flex; align-items:center; gap:8px; background:#0d4748; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    تصدير PDF
                </button>
                <!-- زر طباعة التقرير -->
                <button onclick="printCalendar()" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 20px; border-radius:6px; border:none; font-size:14px; font-weight:bold; cursor:pointer; transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#085859'; this.style.color='white'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg>
                    طباعة تقرير التقويم
                </button>
            </div>
        </div>

        <!-- أزرار تبديل فروع التقويم بتصميم عصري وأنيق للطلاب -->
        <div style="display:flex; justify-content:center; align-items:center; gap:10px; margin:0 auto 25px; background:#f4f6f9; padding:6px; border-radius:12px; max-width:400px; box-shadow:inset 0 2px 4px rgba(0,0,0,0.03);">
            <button id="branch-btn-main-students" onclick="switchBranchStudents('main')" style="flex:1; padding:9px 18px; background:#0d4748; color:white; border:none; border-radius:8px; font-size:13.5px; font-weight:bold; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; box-shadow:0 4px 10px rgba(13,71,72,0.15); font-family:'Cairo',sans-serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
                الفرع الرئيسي
            </button>
            <button id="branch-btn-rahdah-students" onclick="switchBranchStudents('rahdah')" style="flex:1; padding:9px 18px; background:transparent; color:#555; border:none; border-radius:8px; font-size:13.5px; font-weight:bold; cursor:pointer; transition:all 0.3s; display:flex; align-items:center; justify-content:center; gap:8px; font-family:'Cairo',sans-serif;">
                <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                فرع الراهدة
            </button>
        </div>
        
        <div id="academic-calendar-table-container" style="overflow-x:auto;">
            <table class="academic-calendar-table">
                <thead>
                    <tr style="background:#f8f9fa; border-bottom:2px solid #eaeaea;">
                        <th style="padding:15px; color:#555; font-weight:bold; border-radius: 0 10px 10px 0;">الحدث / الفعالية الأكاديمية</th>
                        <th style="padding:15px; color:#555; font-weight:bold;">التاريخ الهجري</th>
                        <th style="padding:15px; color:#555; font-weight:bold;">التاريخ الميلادي</th>
                        <th style="padding:15px; color:#555; font-weight:bold; text-align:center; border-radius: 10px 0 0 10px;">الحالة</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $cal_res = mysqli_query($conn, "SELECT * FROM academic_calendar ORDER BY id ASC");
                    while ($row = mysqli_fetch_assoc($cal_res)):
                        $status_class = 'badge-upcoming';
                        if ($row['status'] == 'نشط حالياً' || $row['status'] == 'نشط') {
                            $status_class = 'badge-active';
                        }
                    ?>
                    <tr class="cal-row-student" data-branch="<?php echo htmlspecialchars($row['branch']); ?>" style="border-bottom:1px solid #f0f0f0; transition:0.2s;" onmouseover="this.style.background='#f5fafb'" onmouseout="this.style.background='transparent'">
                        <td style="padding:15px; font-weight:bold; color:#0d4748; border-right:4px solid #0d4748;"><?php echo htmlspecialchars($row['event_name']); ?></td>
                        <td style="padding:15px; color:#666;"><?php echo htmlspecialchars($row['hijri_date']); ?></td>
                        <td style="padding:15px; color:#666;"><?php echo htmlspecialchars($row['event_date']); ?></td>
                        <td style="padding:15px; text-align:center;">
                            <span class="calendar-badge <?php echo $status_class; ?>"><?php echo htmlspecialchars($row['status']); ?></span>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    
    <!-- زر العودة للرئيسية أسفل جميع الأقسام -->
    <div style="max-width:1100px;margin:40px auto 0;text-align:center;">
        <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>
    
</div>

<!-- كود جافا سكريبت الخاص بحساب الرسوم التفاعلي وطباعة وتصدير التقرير -->
<script>
var majorsData = {
    'it': { avg: '65%', fees: '600$ سنوياً' },
    'graphics': { avg: '60%', fees: '550$ سنوياً' },
    'arch': { avg: '75%', fees: '900$ سنوياً' },
    'accounting': { avg: '60%', fees: '450$ سنوياً' },
    'business': { avg: '60%', fees: '450$ سنوياً' },
    'pharmacy': { avg: '80%', fees: '1200$ سنوياً' },
    'assistant': { avg: '70%', fees: '800$ سنوياً' },
    'dentist': { avg: '85%', fees: '1800$ سنوياً' },
    'midwife': { avg: '70%', fees: '750$ سنوياً' }
};

function updateFeesInfo() {
    var select = document.getElementById("fee_major");
    var val = select.value;
    var avgSpan = document.getElementById("info_avg");
    var feesSpan = document.getElementById("info_fees");
    
    if (val && majorsData[val]) {
        avgSpan.innerText = majorsData[val].avg;
        avgSpan.style.opacity = "1";
        
        feesSpan.innerText = majorsData[val].fees;
        feesSpan.style.opacity = "1";
    } else {
        avgSpan.style.opacity = "0";
        feesSpan.style.opacity = "0";
    }
}

// متغير لتحديد الفرع الحالي للطلاب
var currentStudentBranch = 'main';

function switchBranchStudents(branch) {
    currentStudentBranch = branch;
    
    var btnMain = document.getElementById('branch-btn-main-students');
    var btnRahdah = document.getElementById('branch-btn-rahdah-students');
    
    if (branch === 'main') {
        btnMain.style.background = '#0d4748';
        btnMain.style.color = 'white';
        btnMain.style.boxShadow = '0 4px 10px rgba(13,71,72,0.15)';
        
        btnRahdah.style.background = 'transparent';
        btnRahdah.style.color = '#555';
        btnRahdah.style.boxShadow = 'none';
    } else {
        btnRahdah.style.background = '#0d4748';
        btnRahdah.style.color = 'white';
        btnRahdah.style.boxShadow = '0 4px 10px rgba(13,71,72,0.15)';
        
        btnMain.style.background = 'transparent';
        btnMain.style.color = '#555';
        btnMain.style.boxShadow = 'none';
    }
    
    updateStudentCalendarFilters();
}

function updateStudentCalendarFilters() {
    var rows = document.getElementsByClassName('cal-row-student');
    for (var i = 0; i < rows.length; i++) {
        var branchMatch = rows[i].getAttribute('data-branch') === currentStudentBranch;
        if (branchMatch) {
            rows[i].style.display = 'table-row';
        } else {
            rows[i].style.display = 'none';
        }
    }
}


function generatePrintContent(titleText) {
    var calendarTable = document.getElementById("academic-calendar-table-container");
    if (!calendarTable) return '';
    
    var branchLabel = currentStudentBranch === 'main' ? 'الفرع الرئيسي' : 'فرع الراهدة';
    var fullTitle = titleText + ' - ' + branchLabel;
    var currentDate = new Date().toLocaleDateString('ar-YE', {year: 'numeric', month: 'long', day: 'numeric'});
    
    var html = '<html><head><title>' + fullTitle + '</title>';
    html += '<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">';
    html += '<style>';
    html += '@page { size: A4 portrait; margin: 0mm; }';
    html += 'body { font-family: "Cairo", sans-serif; direction: rtl; padding: 8mm 10mm; text-align: right; background: #fff; color: #333; }';
    html += '.print-header-container { display: flex; justify-content: space-between; align-items: center; border-bottom: 3px double #0d4748; padding-bottom: 6px; margin-bottom: 10px; page-break-inside: avoid; }';
    html += '.print-header-right { width: 35%; font-size: 11px; line-height: 1.5; color: #333; text-align: right; }';
    html += '.print-header-left { width: 35%; font-size: 11px; line-height: 1.5; color: #333; text-align: left; }';
    html += '.print-header-center { width: 30%; text-align: center; }';
    html += '.print-header-center img { height: 75px; width: auto; object-fit: contain; }';
    html += '.print-title-box { text-align: center; margin-bottom: 10px; page-break-inside: avoid; }';
    html += '.print-title-box h2 { color: #0d4748; font-size: 15px; font-weight: bold; margin: 0; padding: 4px 15px; display: inline-block; border-bottom: 2px solid #bdd63c; }';
    html += 'table { width: 100%; border-collapse: collapse; margin-top: 5px; font-size: 12px; }';
    html += 'tr { page-break-inside: avoid; }';
    html += 'th, td { border: 1px solid #999; padding: 5px 8px; text-align: right; }';
    html += 'th { background-color: #f5f5f5; color: #000; font-weight: bold; }';
    html += '.calendar-badge { padding: 3px 8px; border-radius: 4px; font-size: 11px; font-weight: bold; border: 1px solid #ccc; }';
    html += '.badge-active { background: #e8f5e9; color: #2e7d32; }';
    html += '.badge-upcoming { background: #e3f2fd; color: #1565c0; }';
    html += '.footer-print { text-align: center; margin-top: 15px; font-size: 10px; color: #777; border-top: 1px solid #eee; padding-top: 8px; page-break-inside: avoid; }';
    html += '</style></head><body>';
    html += '<div class="print-header-container">';
    html += '  <div class="print-header-right">';
    html += '    <div>الجمهورية اليمنية</div>';
    html += '    <div>وزارة التعليم العالي والبحث العلمي</div>';
    html += '    <div style="font-weight: bold; margin-top: 2px; color: #0d4748;">كلية سماء المتميزين</div>';
    html += '    <div style="font-size: 10px; color: #555;">للعلوم الصحية والتكنولوجيا</div>';
    html += '  </div>';
    html += '  <div class="print-header-center">';
    html += '    <img src="<?php echo $logo_base64; ?>" alt="شعار الكلية">';
    html += '  </div>';
    html += '  <div class="print-header-left">';
    html += '    <div>التاريخ: ' + currentDate + '</div>';
    html += '    <div>الجهة المصدرة: نيابة شؤون الطلاب</div>';
    html += '    <div>حالة التقرير: رسمي معتمد</div>';
    html += '  </div>';
    html += '</div>';
    html += '<div class="print-title-box">';
    html += '  <h2>التقويم الأكاديمي للعام الجامعي 2026 / 2027 م - ' + branchLabel + '</h2>';
    html += '</div>';
    html += '<table>';
    html += '<thead>';
    html += '  <tr>';
    html += '    <th>الحدث / الفعالية الأكاديمية</th>';
    html += '    <th>التاريخ الهجري</th>';
    html += '    <th>التاريخ الميلادي</th>';
    html += '    <th>الحالة</th>';
    html += '  </tr>';
    html += '</thead>';
    html += '<tbody>';
    
    var rows = document.getElementsByClassName('cal-row-student');
    for (var i = 0; i < rows.length; i++) {
        if (rows[i].style.display !== 'none') {
            html += '<tr>' + rows[i].innerHTML + '</tr>';
        }
    }
    
    html += '</tbody>';
    html += '</table>';
    html += '<div class="footer-print">';
    html += 'تم استخراج هذا التقرير تلقائياً من البوابة الإلكترونية لشؤون الطلاب بالكلية - جميع الحقوق محفوظة لـ كلية سماء المتميزين.</div>';
    html += '</body></html>';
    
    return html;
}

// دالة طباعة تقرير التقويم الأكاديمي
function printCalendar() {
    var content = generatePrintContent('التقويم الأكاديمي للكلية');
    if (!content) return;
    
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(content);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 150);
}

// دالة تصدير تقرير التقويم الأكاديمي كـ PDF
function exportPDF() {
    var content = generatePrintContent('التقويم_الأكاديمي_لكلية_سماء_المتميزين_2026');
    if (!content) return;
    
    var printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(content);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 150);
}

// تشغيل الفلترة للفروع عند تحميل الصفحة
document.addEventListener("DOMContentLoaded", function() {
    updateStudentCalendarFilters();
});

// دالة توليد وطباعة دليل الطالب كملف PDF رسمي
function downloadStudentGuide() {
    var currentDate = new Date().toLocaleDateString('ar-YE', {year: 'numeric', month: 'long', day: 'numeric'});
    
    var html = '<html><head><title>دليل الطالب - كلية سماء المتميزين</title>';
    html += '<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;700&display=swap" rel="stylesheet">';
    html += '<style>';
    html += '@page { size: A4 portrait; margin: 0mm; }';
    html += 'body { font-family: "Cairo", sans-serif; direction: rtl; padding: 2cm 2cm; text-align: right; background: #fff; color: #333; line-height: 1.6; }';
    html += '.print-header-container { display: flex; justify-content: space-between; align-items: center; border-bottom: 3px double #0d4748; padding-bottom: 8px; margin-bottom: 20px; page-break-inside: avoid; }';
    html += '.print-header-right { width: 35%; font-size: 11px; line-height: 1.5; color: #333; text-align: right; }';
    html += '.print-header-left { width: 35%; font-size: 11px; line-height: 1.5; color: #333; text-align: left; }';
    html += '.print-header-center { width: 30%; text-align: center; }';
    html += '.print-header-center img { height: 100px; width: auto; object-fit: contain; }';
    
    html += '.print-title-box { text-align: center; margin-bottom: 20px; page-break-inside: avoid; }';
    html += '.print-title-box h2 { color: #0d4748; font-size: 20px; font-weight: bold; margin: 0; padding: 6px 20px; display: inline-block; border-bottom: 2px solid #bdd63c; }';
    
    html += '.section-title { color: #0d4748; font-size: 15px; font-weight: bold; margin-top: 15px; margin-bottom: 8px; border-right: 4px solid #bdd63c; padding-right: 8px; page-break-inside: avoid; }';
    html += 'ul { margin: 0 0 15px 0; padding-right: 20px; font-size: 13px; }';
    html += 'li { margin-bottom: 6px; }';
    html += 'p { font-size: 13px; margin: 0 0 10px 0; text-align: justify; }';
    
    html += 'table { width: 100%; border-collapse: collapse; margin-top: 10px; font-size: 12px; page-break-inside: avoid; }';
    html += 'th, td { border: 1px solid #ccc; padding: 6px 8px; text-align: right; }';
    html += 'th { background-color: #f5f5f5; color: #000; font-weight: bold; }';
    
    html += '.footer-print { text-align: center; margin-top: 30px; font-size: 11px; color: #777; border-top: 1px solid #eee; padding-top: 10px; page-break-inside: avoid; }';
    html += '</style></head><body>';
    
    html += '<div class="print-header-container">';
    html += '  <div class="print-header-right">';
    html += '    <div>الجمهورية اليمنية</div>';
    html += '    <div>وزارة التعليم العالي والبحث العلمي</div>';
    html += '    <div style="font-weight: bold; margin-top: 2px; color: #0d4748;">كلية سماء المتميزين</div>';
    html += '    <div style="font-size: 9px; color: #555;">للعلوم الصحية والتكنولوجيا</div>';
    html += '  </div>';
    html += '  <div class="print-header-center">';
    html += '    <img src="<?php echo $logo_base64; ?>" alt="شعار الكلية">';
    html += '  </div>';
    html += '  <div class="print-header-left">';
    html += '    <div>التاريخ: ' + currentDate + '</div>';
    html += '    <div>الجهة المصدرة: نيابة شؤون الطلاب</div>';
    html += '    <div>المستند: دليل الطالب التعريفي</div>';
    html += '  </div>';
    html += '</div>';
    
    html += '<div class="print-title-box">';
    html += '  <h2>دليل الطالب للقبول والتسجيل (2026 / 2027 م)</h2>';
    html += '</div>';
    
    html += '<div class="section-title">مقدمة عن الكلية</div>';
    html += '<p>تعتبر كلية سماء المتميزين للعلوم الصحية والتكنولوجيا من المؤسسات الرائدة التي تهدف إلى إعداد كوادر مؤهلة تأهيلاً علمياً وعملياً في المجالات الصحية والتقنية والإدارية لتلبية احتياجات سوق العمل والتنمية المحلية.</p>';
    
    html += '<div class="section-title">أولاً: شروط وضوابط القبول العامة</div>';
    html += '<ul>';
    html += '  <li>أن يكون الطالب حاصلاً على شهادة الثانوية العامة (علمي للأقسام الطبية والهندسية، وعلمي/أدبي للأقسام الإدارية).</li>';
    html += '  <li>ألا يقل معدل الثانوية العامة عن الحد الأدنى المعتمد من وزارة التعليم العالي للتخصص المطلوب.</li>';
    html += '  <li>اجتياز اختبارات القبول والمقابلة الشخصية إن وجدت في القسم المحدد.</li>';
    html += '</ul>';
    
    html += '<div class="section-title">ثانياً: الوثائق والمستندات المطلوبة</div>';
    html += '<ul>';
    html += '  <li>أصل شهادة الثانوية العامة مع صورتين طبق الأصل معمدتين.</li>';
    html += '  <li>صورة البطاقة الشخصية (الهوية الوطنية) أو جواز السفر للطلاب غير اليمنيين.</li>';
    html += '  <li>عدد (6) صور شخصية حديثة مقاس (4×6) بخلفية بيضاء.</li>';
    html += '  <li>استمارة طلب الالتحاق معبأة بالكامل وموقعة من الطالب.</li>';
    html += '</ul>';
    
    html += '<div class="section-title">ثالثاً: التخصصات المتاحة ونسب القبول</div>';
    html += '<table>';
    html += '  <thead>';
    html += '    <tr>';
    html += '      <th>اسم البرنامج الدراسي</th>';
    html += '      <th>الدرجة العلمية</th>';
    html += '      <th>القسم الثانوي المطلوب</th>';
    html += '      <th>الحد الأدنى للمعدل</th>';
    html += '    </tr>';
    html += '  </thead>';
    html += '  <tbody>';
    html += '    <tr><td>الصيدلة</td><td>دبلوم عالي / بكالوريوس</td><td>علمي</td><td>80%</td></tr>';
    html += '    <tr><td>مساعد طبيب</td><td>دبلوم عالي</td><td>علمي</td><td>70%</td></tr>';
    html += '    <tr><td>قبالة وتوليد</td><td>دبلوم عالي</td><td>علمي (إناث)</td><td>70%</td></tr>';
    html += '    <tr><td>تقنية المعلومات</td><td>دبلوم / بكالوريوس</td><td>علمي</td><td>65%</td></tr>';
    html += '    <tr><td>محاسبة</td><td>دبلوم / بكالوريوس</td><td>علمي / أدبي</td><td>60%</td></tr>';
    html += '    <tr><td>إدارة أعمال</td><td>دبلوم / بكالوريوس</td><td>علمي / أدبي</td><td>60%</td></tr>';
    html += '    <tr><td>هندسة معمارية</td><td>دبلوم / بكالوريوس</td><td>علمي</td><td>75%</td></tr>';
    html += '  </tbody>';
    html += '</table>';
    
    html += '<div class="footer-print">';
    html += 'تم استخراج هذا الدليل رسمياً من البوابة الإلكترونية لكلية سماء المتميزين للعلوم الصحية والتكنولوجيا. جميع الحقوق محفوظة © 2026</div>';
    html += '</body></html>';
    
    var printWindow = window.open('', '', 'height=700,width=850');
    printWindow.document.write(html);
    printWindow.document.close();
    printWindow.focus();
    
    setTimeout(function() {
        printWindow.print();
        printWindow.close();
    }, 150);
}
</script>