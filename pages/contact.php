<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}
?>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;font-family:'Cairo', sans-serif;">
    <div style="max-width:900px;margin:auto;background:white;border-radius:20px;padding:40px;box-shadow:0 10px 30px rgba(0,0,0,0.06);">
        
        <!-- عنوان الصفحة الرئيسي -->
        <h1 style="color:#000; font-size:24px; font-weight:bold; margin:0 0 15px 0; text-align:right; font-family:'Cairo', sans-serif;">
            كن على اتصال بنا
        </h1>
        
        <!-- خط فاصل عنابي -->
        <div style="width:50px; height:3px; background:#085859; margin-bottom:30px;"></div>
        
        <!-- قسم رسالة الكلية -->
        <div style="margin-bottom:35px; text-align:right;">
            <h3 style="color:#000; font-size:20px; font-weight:bold; margin:0 0 12px 0;">
                رسالة الكلية
            </h3>
            <p style="color:#444; font-size:15px; line-height:2; margin:0; text-align:justify; font-weight:500;">
                تقديم خدمة تعليمية وبحثية ومجتمعية متميزة لإعداد مخرجات كفؤة تتمتع بالمعرفة وتساهم في تحقيق التنمية المستدامة من خلال بيئة أكاديمية وإدارية وتقنية محفزة وفقاً لأحدث معايير الجودة.
            </p>
        </div>
        
        <!-- قسم موقع الخريطة الجغرافية للفرع الرئيسي -->
        <div style="margin-top:40px;">
            <h3 style="color:#000; font-size:18px; font-weight:bold; margin:0 0 15px 0; text-align:right;">
                📍 موقعنا الجغرافي:
            </h3>
            <div style="width:100%; height:420px; border-radius:15px; overflow:hidden; box-shadow:0 5px 20px rgba(0,0,0,0.08); border:1px solid #eaeaea; background:#f0f2f5;">
                <iframe 
                    src="https://maps.google.com/maps?q=عيادة%20بلسم%20الحياة%20د/اماني%20البرطي،%20دمنة%20خدير&t=&z=17&ie=UTF8&iwloc=&output=embed" 
                    width="100%" 
                    height="100%" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>

        <!-- ستايل متجاوب لكروت الفروع واستايلات فورم راسلنا التفاعلية -->
        <style>
        .branches-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-top: 40px;
            margin-bottom: 20px;
        }
        @media (max-width: 768px) {
            .branches-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }

        /* ستايل المجموعات والحقول والـ floating labels في فورم راسلنا */
        .contact-form-group {
            position: relative;
            border-bottom: 1.5px solid #ccc;
            margin-bottom: 15px;
            height: 50px;
            display: flex;
            align-items: flex-end;
            transition: border-color 0.3s ease;
        }
        .contact-form-input {
            width: 100%;
            border: none !important;
            background: transparent !important;
            outline: none !important;
            padding: 6px 0px 8px 0;
            font-size: 15px;
            color: #333;
            font-family: 'Cairo', sans-serif;
            font-weight: bold;
            z-index: 2;
        }
        .contact-label-container {
            position: absolute;
            bottom: 8px;
            right: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #777;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            pointer-events: none;
            z-index: 1;
        }
        .contact-label-text {
            font-size: 14.5px;
            font-weight: 500;
        }
        .contact-icon {
            width: 16px;
            height: 16px;
            color: #777;
            transition: color 0.3s;
        }

        /* تأثير التنشيط عند التركيز أو امتلاء الحقل */
        .contact-form-group.focused-active {
            border-bottom: 2px solid #0d4748 !important;
        }
        .contact-form-group.focused-active .contact-label-container {
            bottom: 32px;
            right: auto;
            left: 0; /* ينتقل إلى أقصى اليسار */
            font-size: 12px;
            color: #0d4748;
            font-weight: bold;
        }
        .contact-form-group.focused-active .contact-icon {
            color: #0d4748;
        }
        
        .contact-form-row {
            display: grid; 
            grid-template-columns: 1fr 1fr; 
            gap: 30px; 
            margin-bottom: 25px;
        }
        @media (max-width: 768px) {
            .contact-form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
        </style>

        <!-- قسم الفروع وعناوين التواصل كمثل الصورة المرفقة تماماً -->
        <div class="branches-grid">
            <!-- المركز الرئيسي -->
            <div style="position: relative; border: 2px solid #eaeaea; padding: 30px 20px 20px; border-radius: 4px; background: white; text-align:right; display:flex; flex-direction:column; justify-content:space-between; min-height:260px;">
                <span style="position: absolute; top: -14px; right: 20px; background: white; padding: 0 12px; font-weight: bold; color: #000; font-size: 16px; font-family:'Cairo', sans-serif;">
                    المركز الرئيسي
                </span>
                <div>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; line-height: 1.6; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="white" /></g></svg>
                        <strong style="color:#000;">العنوان:</strong> تعز- دمنة خدير- شارع شمعة – خلف حلويات الناشري – مقابل خزان شاعر
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><polyline points="22,6 12,13 2,6" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></g></svg>
                        <strong style="color:#000;">البريد الإلكتروني:</strong> <a href="mailto:klytalmtmyzyn@gmail.com" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">klytalmtmyzyn@gmail.com</a>
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" fill="white" /></g></svg>
                        <strong style="color:#000;">رقم الهاتف:</strong> <a href="tel:04323058" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">04-323058</a>
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><rect x="5" y="2" width="14" height="20" rx="2" ry="2" fill="none" stroke="white" stroke-width="2" /><line x1="12" y1="18" x2="12.01" y2="18" fill="none" stroke="white" stroke-width="2" /></g></svg>
                        <strong style="color:#000;">رقم الهاتف المحمول:</strong> 
                        <span style="direction: ltr; display: inline-block;">
                            <a href="tel:770821112" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">770821112</a> - 
                            <a href="tel:733045299" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">733045299</a> -
                            <a href="tel:736863982" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">736863982</a>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="https://maps.app.goo.gl/LXAGdWTzoy7mfjTb9" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#085859'; this.style.color='white';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        الخريطة
                    </a>
                </div>
            </div>

            <!-- فرع الراهدة -->
            <div style="position: relative; border: 2px solid #eaeaea; padding: 30px 20px 20px; border-radius: 4px; background: white; text-align:right; display:flex; flex-direction:column; justify-content:space-between; min-height:260px;">
                <span style="position: absolute; top: -14px; right: 20px; background: white; padding: 0 12px; font-weight: bold; color: #000; font-size: 16px; font-family:'Cairo', sans-serif;">
                    فرع الراهدة
                </span>
                <div>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; line-height: 1.6; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z" fill="white" /></g></svg>
                        <strong style="color:#000;">العنوان:</strong> طريق عدن - مدخل حي الجنوبيين - مبنى مستوصف ابن سينا سابقاً
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /><polyline points="22,6 12,13 2,6" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" /></g></svg>
                        <strong style="color:#000;">الايميل:</strong> <a href="mailto:klytalmtmyzyn@gmail.com" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">klytalmtmyzyn@gmail.com</a>
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z" fill="white" /></g></svg>
                        <strong style="color:#000;">رقم الهاتف:</strong> <a href="tel:04323058" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">04-323058</a>
                    </p>
                    <p style="margin: 0 0 12px 0; font-size: 14.5px; color: #333; display: flex; align-items: center; gap: 6px; flex-wrap: wrap;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" style="vertical-align:middle; display:inline-block;"><rect x="2" y="2" width="20" height="20" rx="5" fill="#085859" /><g transform="scale(0.6) translate(8, 8)"><rect x="5" y="2" width="14" height="20" rx="2" ry="2" fill="none" stroke="white" stroke-width="2" /><line x1="12" y1="18" x2="12.01" y2="18" fill="none" stroke="white" stroke-width="2" /></g></svg>
                        <strong style="color:#000;">رقم الهاتف المحمول:</strong> 
                        <span style="direction: ltr; display: inline-block;">
                            <a href="tel:770821112" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">770821112</a> - 
                            <a href="tel:733045299" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">733045299</a> -
                            <a href="tel:736863982" style="color: #085859; text-decoration: none; font-weight: bold; transition: 0.3s;" onmouseover="this.style.color='#0d4748'" onmouseout="this.style.color='#085859'">736863982</a>
                        </span>
                    </p>
                </div>
                <div>
                    <a href="https://maps.google.com/?q=الراهدة،+تعز،+اليمن" target="_blank" style="display:inline-flex; align-items:center; gap:8px; background:#085859; color:white; padding:8px 22px; text-decoration:none; font-weight:bold; font-size:14px; transition:0.3s;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#085859'; this.style.color='white';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/></svg>
                        الخريطة
                    </a>
                </div>
            </div>
        </div>

        <!-- راسلنا فورم التفاعلي المتطابق مع الصورة -->
        <form id="contact-form" onsubmit="submitContactForm(event)" style="margin-top: 50px; background: white; border-radius: 12px; padding: 35px; box-shadow: 0 10px 30px rgba(0,0,0,0.04); border: 1px solid #eaeaea; text-align: right;">
            <h3 style="color: #000; font-size: 20px; font-weight: bold; margin: 0 0 25px 0;">
                راسلنا
            </h3>
            
            <div class="contact-form-row">
                <!-- العمود الأيمن في RTL (الاسم، التلفون، الرسالة) -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- الاسم -->
                    <div class="contact-form-group">
                        <input type="text" id="contact-name" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                            <span class="contact-label-text">الاسم</span>
                        </div>
                    </div>
                    
                    <!-- التلفون -->
                    <div class="contact-form-group">
                        <input type="text" id="contact-phone" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span class="contact-label-text">التلفون</span>
                        </div>
                    </div>
                    
                    <!-- الرسالة -->
                    <div class="contact-form-group">
                        <input type="text" id="contact-message" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                            <span class="contact-label-text">الرسالة</span>
                        </div>
                    </div>
                </div>
                
                <!-- العمود الأيسر في RTL (البريد الإلكتروني، العنوان) -->
                <div style="display: flex; flex-direction: column; gap: 20px;">
                    <!-- البريد الإلكتروني -->
                    <div class="contact-form-group">
                        <input type="email" id="contact-email" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                            <span class="contact-label-text">البريد الإلكتروني</span>
                        </div>
                    </div>
                    
                    <!-- العنوان -->
                    <div class="contact-form-group">
                        <input type="text" id="contact-subject" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                            <span class="contact-label-text">العنوان</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- كود التحقق والزر -->
            <div style="display:flex; justify-content:space-between; align-items:center; gap:20px; flex-wrap:wrap; border-top:1px solid #f0f0f0; padding-top:20px;">
                <!-- كود التحقق في اليمين -->
                <div style="display:flex; align-items:center; gap:15px; min-width:280px;">
                    <div class="contact-form-group" style="width:160px; margin-bottom:0;">
                        <input type="text" id="contact-captcha" class="contact-form-input" required onfocus="activateLabel(this)" onblur="deactivateLabel(this)">
                        <div class="contact-label-container">
                            <svg class="contact-icon" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align:middle;"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <span class="contact-label-text">كود التحقق</span>
                        </div>
                    </div>
                    <!-- صندوق الكود المولد -->
                    <div id="contact-captcha-box" style="background:black; color:white; font-family:'Courier New', monospace; font-size:18px; font-weight:bold; letter-spacing:2px; padding:6px 15px; border-radius:4px; user-select:none; height:38px; display:flex; align-items:center; justify-content:center;">
                        <!-- سيتولد برمجياً -->
                    </div>
                </div>
                
                <!-- زر الارسال في اليسار -->
                <button type="submit" style="background:#0d4748; color:white; border:none; padding:12px 45px; border-radius:4px; font-weight:bold; font-size:16px; cursor:pointer; font-family:'Cairo', sans-serif; transition:0.3s; margin-right:auto;" onmouseover="this.style.background='rgb(189, 214, 60)'; this.style.color='#0d4748';" onmouseout="this.style.background='#0d4748'; this.style.color='white'">
                    ارسال
                </button>
            </div>
        </form>
        
        <!-- زر العودة الأنيق المتطابق -->
        <div style="text-align:center; margin-top:45px;">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
        </div>

        <script>
        // تفعيل حركة المجموعات والـ floating labels
        function activateLabel(input) {
            input.parentElement.classList.add("focused-active");
        }
        function deactivateLabel(input) {
            if (input.value.trim() === "") {
                input.parentElement.classList.remove("focused-active");
            }
        }
        
        // التحقق من الحقول عند التحميل
        function checkContactInputs() {
            var inputs = document.querySelectorAll(".contact-form-input");
            inputs.forEach(function(input) {
                if (input.value.trim() !== "") {
                    input.parentElement.classList.add("focused-active");
                } else {
                    input.parentElement.classList.remove("focused-active");
                }
            });
        }

        // توليد رمز التحقق (كابتشا)
        var contactCaptchaCode = "";
        function generateContactCaptcha() {
            var code = "";
            for (var i = 0; i < 6; i++) {
                code += Math.floor(Math.random() * 10);
            }
            contactCaptchaCode = code;
            document.getElementById("contact-captcha-box").innerText = code;
        }

        // معالجة إرسال الفورم
        function submitContactForm(event) {
            event.preventDefault();
            var name = document.getElementById("contact-name").value;
            var captcha = document.getElementById("contact-captcha").value;
            
            if (captcha !== contactCaptchaCode) {
                alert("رمز التحقق غير صحيح، يرجى إعادة المحاولة.");
                generateContactCaptcha();
                document.getElementById("contact-captcha").value = "";
                return;
            }
            
            alert("شكراً لك يا " + name + "! تم إرسال رسالتك بنجاح وسنقوم بالرد عليك في أقرب وقت.");
            document.getElementById("contact-form").reset();
            var groups = document.querySelectorAll(".contact-form-group");
            groups.forEach(function(g) {
                g.classList.remove("focused-active");
            });
            generateContactCaptcha();
        }

        // تشغيل كود كود كابتشا عند تشغيل الصفحة
        window.addEventListener("DOMContentLoaded", function() {
            generateContactCaptcha();
            checkContactInputs();
        });
        </script>
        
    </div>
</div>