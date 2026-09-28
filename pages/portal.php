<!-- صفحة البوابة الإلكترونية الموحدة لمنتسبي الكلية -->
<div style="background:white; padding:40px; border-radius:20px; box-shadow:0 10px 40px rgba(0,0,0,0.05); overflow:hidden; direction:rtl; text-align:right; font-family:'Cairo', sans-serif; border-top: 5px solid #0d4748; margin-top:20px; margin-bottom: 20px;">
    
    <div style="text-align:center; margin-bottom:40px; position:relative;">
        <h2 style="color:#0d4748; margin:0 0 10px; font-size:28px; font-weight:bold; display:flex; align-items:center; justify-content:center; gap:10px;">
            🌐 البوابة الإلكترونية الموحدة
        </h2>
        <p style="color:#666; margin:0 auto; max-width:650px; font-size:16px; line-height:1.7;">البوابة الرقمية الشاملة لخدمة طلاب، أكاديميي، وموظفي كلية سماء المتميزين للعلوم الصحية والتكنولوجيا.</p>
        <div style="width:70px; height:4px; background:#ffd700; margin:15px auto 0; border-radius:2px;"></div>
    </div>

    <?php if ($is_logged_in): ?>
    <!-- حالة المستخدم مسجل الدخول بالفعل -->
    <div style="background:#f4f6f9; border-radius:15px; padding:30px; text-align:center; border-right:5px solid #085859; margin-bottom:30px;">
        <div style="font-size:45px; margin-bottom:15px;">👋</div>
        <h3 style="color:#0d4748; margin:0 0 10px; font-size:20px;">أهلاً بك مجدداً، <?php echo htmlspecialchars($_SESSION['full_name'] ?? 'منتسب الكلية'); ?>!</h3>
        <p style="color:#666; font-size:15px; margin-bottom:20px;">أنت مسجل الدخول حالياً في البوابة الإلكترونية.</p>
        
        <?php if ($is_admin): ?>
            <a href="?p=manage_students" style="display:inline-block; background:#085859; color:white; padding:12px 30px; border-radius:10px; text-decoration:none; font-weight:bold; font-size:15px; transition:all 0.3s; box-shadow:0 4px 15px rgba(8, 88, 89,0.2);" onmouseover="this.style.background='#054445'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#085859'; this.style.transform='none';">
                <i class="fa-solid fa-gear" style="margin-left: 5px;"></i> الانتقال للوحة تحكم الإدارة
            </a>
        <?php elseif ($is_staff): ?>
            <a href="?p=manage_grades" style="display:inline-block; background:#0d4748; color:white; padding:12px 30px; border-radius:10px; text-decoration:none; font-weight:bold; font-size:15px; transition:all 0.3s; box-shadow:0 4px 15px rgba(13, 71, 72,0.2);" onmouseover="this.style.background='#072928'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0d4748'; this.style.transform='none';">
                <i class="fa-solid fa-chalkboard-user" style="margin-left: 5px;"></i> الانتقال لبوابة الكادر التعليمي
            </a>
        <?php else: ?>
            <a href="?p=student_dashboard" style="display:inline-block; background:#0d4748; color:white; padding:12px 30px; border-radius:10px; text-decoration:none; font-weight:bold; font-size:15px; transition:all 0.3s; box-shadow:0 4px 15px rgba(13, 71, 72,0.2);" onmouseover="this.style.background='#072928'; this.style.transform='translateY(-2px)';" onmouseout="this.style.background='#0d4748'; this.style.transform='none';">
                <i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> الانتقال لبوابة الطالب الإلكترونية
            </a>
        <?php endif; ?>
    </div>
    <?php endif; ?>

    <!-- شبكة بوابات المستخدمين -->
    <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap:25px; margin-bottom:40px;">
        
        <!-- كرت بوابة الطالب -->
        <div style="background:white; border: 1.5px solid #eaeaea; border-radius:15px; padding:30px; transition:all 0.3s; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;"
             onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'; this.style.borderColor='#0d4748';"
             onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='#eaeaea';">
            <div style="position:absolute; top:-20px; left:-20px; width:100px; height:100px; background:rgba(13, 71, 72,0.03); border-radius:50%;"></div>
            <div>
                <div style="font-size:35px; margin-bottom:15px; background:rgba(13, 71, 72,0.07); width:65px; height:65px; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#0d4748;"><i class="fa-solid fa-graduation-cap"></i></div>
                <h3 style="color:#0d4748; font-size:20px; font-weight:bold; margin:0 0 15px 0;">بوابة الطالب الإلكترونية</h3>
                <p style="color:#666; font-size:14px; line-height:1.6; margin-bottom:20px;">بوابة مخصصة للطلاب تتيح لهم متابعة حياتهم الأكاديمية والمالية بكل سهولة ويسر من أي مكان.</p>
                
                <ul style="padding:0; margin:0 0 25px 0; list-style:none; font-size:14px; color:#555;">
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        الاطلاع على نتائج الامتحانات الفصلية
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        تحميل المحاضرات والملخصات والخطط الدراسية
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        رفع إيصالات سداد الرسوم الدراسية للتحقق
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        التواصل المباشر مع إدارة شؤون الطلاب والمالية
                    </li>
                </ul>
            </div>
            <div>
                <a href="<?php echo $is_logged_in ? ($is_student ? '?p=student_dashboard' : 'javascript:alert(\'أنت مسجل الدخول بحساب كادر تعليمي/إداري حالياً. يرجى تسجيل الخروج أولاً للدخول كطالب.\')') : '?p=login'; ?>" 
                   style="display:block; text-align:center; background:#0d4748; color:white; padding:12px; border-radius:8px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;"
                   onmouseover="this.style.background='#072928';" onmouseout="this.style.background='#0d4748';">
                    دخول بوابة الطلاب
                </a>
            </div>
        </div>

        <!-- كرت كادر هيئة التدريس -->
        <div style="background:white; border: 1.5px solid #eaeaea; border-radius:15px; padding:30px; transition:all 0.3s; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;"
             onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'; this.style.borderColor='#085859';"
             onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='#eaeaea';">
            <div style="position:absolute; top:-20px; left:-20px; width:100px; height:100px; background:rgba(8, 88, 89,0.03); border-radius:50%;"></div>
            <div>
                <div style="font-size:35px; margin-bottom:15px; background:rgba(8, 88, 89,0.07); width:65px; height:65px; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#085859;"><i class="fa-solid fa-chalkboard-user"></i></div>
                <h3 style="color:#085859; font-size:20px; font-weight:bold; margin:0 0 15px 0;">بوابة الكادر الأكاديمي والتعليمي</h3>
                <p style="color:#666; font-size:14px; line-height:1.6; margin-bottom:20px;">النظام المخصص لأعضاء هيئة التدريس لإدارة وتسهيل العملية التعليمية والتواصل مع الطلاب برمجياً.</p>
                
                <ul style="padding:0; margin:0 0 25px 0; list-style:none; font-size:14px; color:#555;">
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        رصد وإدخال درجات واختبارات الطلاب للفصول
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        رفع المحاضرات وملخصات المناهج لسهولة التحميل
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        إدارة الجداول وتوزيع المجموعات الدراسية
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        إرسال الإعلانات والتعليمات الفورية للطلاب التابعين
                    </li>
                </ul>
            </div>
            <div>
                <a href="<?php echo $is_logged_in ? ($is_staff ? '?p=manage_grades' : 'javascript:alert(\'أنت مسجل الدخول بحساب طالب حالياً. يرجى تسجيل الخروج أولاً للدخول ككادر أكاديمي.\')') : '?p=login'; ?>" 
                   style="display:block; text-align:center; background:#085859; color:white; padding:12px; border-radius:8px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;"
                   onmouseover="this.style.background='#054445';" onmouseout="this.style.background='#085859';">
                    دخول بوابة الأكاديميين
                </a>
            </div>
        </div>

        <!-- كرت المجموعات الأكاديمية والتواصل -->
        <div style="background:white; border: 1.5px solid #eaeaea; border-radius:15px; padding:30px; transition:all 0.3s; display:flex; flex-direction:column; justify-content:space-between; position:relative; overflow:hidden;"
             onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 15px 30px rgba(0,0,0,0.08)'; this.style.borderColor='#0284c7';"
             onmouseout="this.style.transform='none'; this.style.boxShadow='none'; this.style.borderColor='#eaeaea';">
            <div style="position:absolute; top:-20px; left:-20px; width:100px; height:100px; background:rgba(14,165,233,0.03); border-radius:50%;"></div>
            <div>
                <div style="font-size:35px; margin-bottom:15px; background:rgba(14,165,233,0.07); width:65px; height:65px; border-radius:12px; display:flex; align-items:center; justify-content:center; color:#0284c7;"><i class="fa-solid fa-comments"></i></div>
                <h3 style="color:#0284c7; font-size:20px; font-weight:bold; margin:0 0 15px 0;">المجموعات الأكاديمية والتواصل</h3>
                <p style="color:#666; font-size:14px; line-height:1.6; margin-bottom:20px;">القنوات التفاعلية المباشرة للتواصل بين الطلاب، أعضاء هيئة التدريس، وإدارة الكلية لمشاركة الاستفسارات والإعلانات والأصوات.</p>
                
                <ul style="padding:0; margin:0 0 25px 0; list-style:none; font-size:14px; color:#555;">
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        تواصل فوري ومباشر على مستوى التخصص الدراسي
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        إرسال الرسائل النصية، الصور، المستندات، والتسجيلات الصوتية للكل
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        إرسال اعتراضات واستفسارات الطلاب لتظهر للعمادة والكادر
                    </li>
                    <li style="margin-bottom:12px; display:flex; align-items:center; gap:8px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#28a745" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" style="display:inline-block; vertical-align:middle; margin-left:8px;"><polyline points="20 6 9 17 4 12"></polyline></svg>
                        تعميمات وإعلانات العمادة وأعضاء هيئة التدريس فورياً
                    </li>
                </ul>
            </div>
            <div>
                <a href="<?php echo $is_logged_in ? '?p=academic_groups' : '?p=login'; ?>" 
                   style="display:block; text-align:center; background:#0284c7; color:white; padding:12px; border-radius:8px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;"
                   onmouseover="this.style.background='#0369a1';" onmouseout="this.style.background='#0284c7';">
                    دخول المجموعات المشتركة
                </a>
            </div>
        </div>

    </div>

    <!-- قسم الخدمات العامة والإحصائيات -->
    <div style="background:#f9fbfd; border-radius:15px; padding:30px; border:1px solid #eef2f6; margin-bottom:30px;">
        <h4 style="color:#0d4748; font-size:18px; font-weight:bold; margin:0 0 20px 0; display:flex; align-items:center; gap:10px;">
            <i class="fa-solid fa-chart-line" style="margin-left: 5px;"></i> أداء البوابة الرقمية وإحصائياتها
        </h4>
        <div style="display:grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap:20px; text-align:center;">
            <div style="background:white; padding:15px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.02); border-top:3.5px solid #0d4748;">
                <span style="font-size:24px; display:block; margin-bottom:5px;">⚡</span>
                <span style="color:#666; font-size:13px; display:block; margin-bottom:5px;">سرعة معالجة الطلبات</span>
                <strong style="color:#0d4748; font-size:16px;">فورية (Real-time)</strong>
            </div>
            <div style="background:white; padding:15px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.02); border-top:3.5px solid #085859;">
                <span style="font-size:24px; display:block; margin-bottom:5px;">🔒</span>
                <span style="color:#666; font-size:13px; display:block; margin-bottom:5px;">أمان تشفير البيانات</span>
                <strong style="color:#0d4748; font-size:16px;">SSL / AES 256</strong>
            </div>
            <div style="background:white; padding:15px; border-radius:10px; box-shadow:0 2px 8px rgba(0,0,0,0.02); border-top:3.5px solid #ffd700;">
                <span style="font-size:24px; display:block; margin-bottom:5px;">🎯</span>
                <span style="color:#666; font-size:13px; display:block; margin-bottom:5px;">نسبة رضا الطلاب</span>
                <strong style="color:#0d4748; font-size:16px;">%98.2</strong>
            </div>
        </div>
    </div>

    <!-- قسم الدعم الفني والمساعدة -->
    <div style="border-top:1.5px solid #f4f6f8; padding-top:25px; text-align:center;">
        <p style="color:#666; font-size:14px; margin:0 0 15px 0;">🔧 هل تواجه أي مشكلة في تسجيل الدخول أو تحتاج إلى استعادة كلمة المرور الخاصة بك?</p>
        <div style="display:flex; justify-content:center; gap:15px; flex-wrap:wrap;">
            <a href="?p=contact" style="background:#eaeaea; color:#333; padding:10px 22px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:bold; transition:0.3s;" onmouseover="this.style.background='#dddddd';" onmouseout="this.style.background='#eaeaea';">
                📞 اتصل بنا
            </a>
            <a href="mailto:it-support@sama-college.edu.ye" style="background:#0d4748; color:white; padding:10px 22px; border-radius:8px; text-decoration:none; font-size:14px; font-weight:bold; transition:0.3s;" onmouseover="this.style.background='#072928';" onmouseout="this.style.background='#0d4748';">
                <i class="fa-solid fa-envelope" style="margin-left: 5px;"></i> الدعم الفني للبوابة
            </a>
        </div>
    </div>

    <!-- زر العودة للرئيسية -->
    <div style="margin-top: 30px; text-align: center;">
        <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>

</div>
