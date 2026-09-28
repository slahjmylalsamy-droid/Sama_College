<?php
$filepath = 'C:/Users/asus/.gemini/antigravity/brain/e69fa78a-8e64-4837-8d43-af117029d7d9/walkthrough.md';
$content = file_get_contents($filepath);

$to_add = "14. **تطوير واجهة المعاينة للمحتوى (Laptop CMS Mockup)**:
    * تحويل شاشة المعاينة التفاعلية داخل لوحة تعديل المحتوى من تصميم جوال طولي إلى تصميم لابتوب متطور (أفقي بنسبة 16:10) مجهز بالكامل بإطار، عدسة كاميرا، شريط عنوان متصفح، وقاعدة لوحة مفاتيح منزلقة لمحاكاة العرض على أجهزة الكمبيوتر الحقيقية بدقة.
15. **تطوير نظام الألوان التفاعلي المتكامل (Dynamic Theme Engine)**:
    * ربط ألوان الموقع بالكامل (الرئيسية والفرعية ولوحة التحكم) بمتغيرات CSS ديناميكية يتم تحديثها فورياً بمجرد اختيار الألوان وحفظها من لوحة التحكم العامة.
    * إصلاح مشكلة ثبات الألوان السابقة في الصفحات الفرعية وتحويل محتواها في قاعدة البيانات ليعتمد على المتغيرات التفاعلية.
16. **إضافة تأثيرات التمرير التفاعلية (Accent Color Hover Effects)**:
    * تصميم تأثيرات بصرية جذابة عند مرور مؤشر الفأرة (السهم) على أيقونة البيت الرئيسية في مسار تصفح الموقع والفاصل المائل للروابط (`/`) وأسماء الصفحات لتتحول إلى اللون الذهبي الثانوي (`#ffd700`).
    * تعديل تأثير التمرير لجميع كروت التخصصات، الخدمات، الأخبار والمربعات الإحصائية لتتحول خلفيتها بشكل انسيابي وتفاعلي للون الثانوي بدقة ومرونة بصرية فائقة.";

$guide_add = "### الخطوة الرابعة: تعديل محتوى صفحات الموقع ومعاينته داخل اللابتوب
1. توجه إلى صفحة **إدارة المحتوى (CMS)**.
2. ستلاحظ فوراً تصميم شاشة المعاينة الفاخر الذي يحاكي جهاز لابتوب حقيقي يعرض شكل الموقع بدقة تامة.
3. اختر الصفحة التي تريد تعديلها (مثل: اتصل بنا أو الرؤية والأهداف).
4. قم بكتابة النص الجديد أو غيّر الألوان والروابط واضغط على **حفظ ونشر التغييرات**.
5. افتح واجهة الموقع العامة لتشاهد المحتوى الجديد يظهر للزوار فوراً.

### الخطوة الخامسة: تجربة تأثيرات التمرير التفاعلية (Hovers)
1. افتح الموقع العام للكلية، وانتقل لأي صفحة فرعية (مثل: الأخبار).
2. مرر الفأرة فوق أيقونة البيت (الرئيسية) في شريط التنقل العلوي، أو فوق علامة القسمة المائلة (`/`)، أو فوق اسم الصفحة الحالية؛ ستلاحظ تحول لونها فوراً إلى اللون الثانوي (الذهبي).
3. ارجع للصفحة الرئيسية ومرر الفأرة فوق أي مربع إحصائي، أو كارت خدمة، أو كارت أخبار؛ ستشاهد المربع يتحول بالكامل للون الثانوي بانتقال ناعم وبصري جذاب.";

// Normalize line endings
$content = str_replace("\r\n", "\n", $content);

// We find the line of item 13.
$search_item = "13. **نظام إدارة المحتوى (CMS) للموقع (`manage_content.php`)**:";
if (strpos($content, $search_item) !== false) {
    // Find next double newline to append
    $pos = strpos($content, $search_item);
    $next_double_nl = strpos($content, "\n\n", $pos);
    if ($next_double_nl !== false) {
        $content = substr_replace($content, "\n" . $to_add, $next_double_nl, 0);
        echo "Added items to section 1.\n";
    }
}

// We find الخطوة الرابعة and replace/append
$search_step4 = "### الخطوة الرابعة: تعديل محتوى صفحات الموقع (CMS)";
if (strpos($content, $search_step4) !== false) {
    $pos_step4 = strpos($content, $search_step4);
    // Let's replace from $pos_step4 to the end of the text
    $content = substr($content, 0, $pos_step4) . $guide_add;
    echo "Added items to section 2.\n";
} else {
    // try to find it without CMS
    $search_step4_alt = "### الخطوة الرابعة:";
    $pos_step4 = strpos($content, $search_step4_alt);
    if ($pos_step4 !== false) {
        $content = substr($content, 0, $pos_step4) . $guide_add;
        echo "Added items to section 2 (alt).\n";
    }
}

file_put_contents($filepath, $content);
echo "Walkthrough updated successfully.\n";
?>
