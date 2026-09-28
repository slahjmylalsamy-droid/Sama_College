<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/index.php';
$content = file_get_contents($filepath);

$target = '<!-- ===== قسم إحصائيات الكلية ===== -->
<section style="background-color: #22316c; color: white; padding: 75px 4% 95px 4%; direction: rtl; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
        
        <!-- الجزء العلوي: النص والعناوين -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 40px; margin-bottom: 60px;">
            <!-- العناوين (على اليمين) -->
            <div style="flex: 1; min-width: 300px; text-align: right;">
                <span style="color: rgba(255, 255, 255, 0.7); font-size: 15px; font-weight: normal; display: block; margin-bottom: 12px; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif; letter-spacing: 0.5px;">إحصائيات الكلية</span>
                <h2 style="color: white; font-size: 35px; font-weight: bold; margin: 0; line-height: 1.2; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">كلية سماء المتميزين</h2>
            </div>
            
            <!-- الوصف (على اليسار) -->
            <div style="flex: 1.8; min-width: 350px;">
                <p style="color: rgba(255, 255, 255, 0.9); font-size: 15px; line-height: 1.8; margin: 0; text-align: justify; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">
                    كلية سماء المتميزين للعلوم الصحية والتكنولوجيا هي مؤسسة تعليمية رائدة مرخصة رسمياً من الجهات المختصة. بدأت الكلية مسيرتها في تقديم البرامج الطبية والتقنية المتميزة لتأهيل الطلاب وإعدادهم لسوق العمل بأعلى مستويات الجودة والكفاءة الأكاديمية والتدريب العملي في مختلف التخصصات الطبية والصحية والتقنية.
                </p>
            </div>
        </div>
        
        <!-- الجزء السفلي: شبكة الإحصائيات (موزعة بمسافات متناسقة ومحاذاة مركزية لكل عنصر) -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px; margin-top: 30px;">
            <!-- بطاقة 1 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: white; line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">12</span>
                <div style="width: 140px; border-bottom: 1.5px solid white; margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: white; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">برنامج أكاديمي</span>
            </div>
            <!-- بطاقة 2 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: white; line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">2</span>
                <div style="width: 140px; border-bottom: 1.5px solid white; margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: white; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">فرع</span>
            </div>
            <!-- بطاقة 3 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: white; line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">3500</span>
                <div style="width: 140px; border-bottom: 1.5px solid white; margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: white; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">خريج</span>
            </div>
            <!-- بطاقة 4 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: white; line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">5</span>
                <div style="width: 140px; border-bottom: 1.5px solid white; margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: white; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">مبنى</span>
            </div>
        </div>
        
    </div>
</section>';

$replacement = '<!-- ===== قسم إحصائيات الكلية ===== -->
<section style="background-color: rgb(189, 214, 60); color: var(--main-color); padding: 75px 4% 95px 4%; direction: rtl; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">
    <div style="max-width: 1400px; margin: 0 auto; padding: 0 40px;">
        
        <!-- الجزء العلوي: النص والعناوين -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; align-items: flex-start; gap: 40px; margin-bottom: 60px;">
            <!-- العناوين (على اليمين) -->
            <div style="flex: 1; min-width: 300px; text-align: right;">
                <span style="color: rgba(13, 71, 72, 0.7); font-size: 15px; font-weight: bold; display: block; margin-bottom: 12px; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif; letter-spacing: 0.5px;">إحصائيات الكلية</span>
                <h2 style="color: var(--main-color); font-size: 35px; font-weight: bold; margin: 0; line-height: 1.2; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">كلية سماء المتميزين</h2>
            </div>
            
            <!-- الوصف (على اليسار) -->
            <div style="flex: 1.8; min-width: 350px;">
                <p style="color: rgba(13, 71, 72, 0.9); font-size: 15px; line-height: 1.8; margin: 0; text-align: justify; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif; font-weight: 500;">
                    كلية سماء المتميزين للعلوم الصحية والتكنولوجيا هي مؤسسة تعليمية رائدة مرخصة رسمياً من الجهات المختصة. بدأت الكلية مسيرتها في تقديم البرامج الطبية والتقنية المتميزة لتأهيل الطلاب وإعدادهم لسوق العمل بأعلى مستويات الجودة والكفاءة الأكاديمية والتدريب العملي في مختلف التخصصات الطبية والصحية والتقنية.
                </p>
            </div>
        </div>
        
        <!-- الجزء السفلي: شبكة الإحصائيات (موزعة بمسافات متناسقة ومحاذاة مركزية لكل عنصر) -->
        <div style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 40px; margin-top: 30px;">
            <!-- بطاقة 1 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">12</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">برنامج أكاديمي</span>
            </div>
            <!-- بطاقة 2 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">2</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">فرع</span>
            </div>
            <!-- بطاقة 3 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">3500</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">خريج</span>
            </div>
            <!-- بطاقة 4 -->
            <div style="display: flex; flex-direction: column; align-items: center; text-align: center; flex: 1; min-width: 180px;">
                <span style="font-size: 45px; font-weight: bold; color: var(--main-color); line-height: 1; font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">5</span>
                <div style="width: 140px; border-bottom: 1.5px solid var(--main-color); margin: 12px 0;"></div>
                <span style="font-size: 15px; font-weight: bold; color: var(--main-color); font-family: Tahoma, \'Segoe UI\', Arial, sans-serif;">مبنى</span>
            </div>
        </div>
        
    </div>
</section>';

$content_norm = str_replace("\r\n", "\n", $content);
$target_norm = str_replace("\r\n", "\n", $target);
$replacement_norm = str_replace("\r\n", "\n", $replacement);

if (strpos($content_norm, $target_norm) !== false) {
    $content_norm = str_replace($target_norm, $replacement_norm, $content_norm);
    file_put_contents($filepath, $content_norm);
    echo "Statistics section background color updated successfully to rgb(189, 214, 60).\n";
} else {
    echo "Statistics section target block not found in index.php.\n";
}
?>
