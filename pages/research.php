<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}

// قاعدة بيانات مشاريع التخرج والبحوث بالكلية
$projects = [
    '1' => [
        'title' => 'معدل انتشار الصرع بين الأطفال دون سن الخامسة في مستشفى الجمهوري التعليمي بالعاصمة صنعاء خلال الفترة من مايو 2024 إلى مايو 2025 م',
        'category' => 'assistant',
        'category_name' => 'بحوث مساعد طبيب',
        'date' => 'الثلاثاء، 30 ديسمبر، 2025 م',
        'image' => 'images/project_epilepsy_1.jpg',
        'intro' => 'كلية سماء المتميزين تجري دراسة حول معدل انتشار الصرع بين الأطفال دون سن الخامسة في صنعاء',
        'content' => 'أظهرت الدراسة أن تخطيط الدماغ الكهربائي (EEG) كان الفحص التشخيصي الأكثر استخداماً، في حين كان الوصول إلى التصوير بالرنين المغناطيسي محدوداً. وتلقى معظم الأطفال علاجاً دوائياً مضاداً للصرع، مع اعتماد العلاج الأحادي في أغلب الحالات.',
        'participants' => [
            'صهيب علي فرحان محمد الفتيحي',
            'عبد الكريم محمد عبد الله قحطان',
            'جبران محمد سيف أحمد منجث',
            'طه رضوان علي خالد قاسم',
            'بديع يحيى قاسم الجيشي',
            'نائف ابراهيم محمد حسن وهان',
            'مرام نعمان أحمد المصنعة',
            'عائشة علي علي الحمودي',
            'أمنية عبد الله سعيد معروف'
        ],
        'supervisors' => 'أجريت الدراسة تحت إشراف الدكتور عبد الله الطيار، استشاري طب الأطفال وحديثي الولادة، والدكتورة حورية الصبري أخصائي طب المجتمع.',
        'conclusion' => 'وخلصت الدراسة إلى أن الصرع يمثل عبئاً صحياً ملحوظاً بين الأطفال، مع تأكيد أهمية التشخيص المبكر وتوفير الوسائل التشخيصية المناسبة، وتعزيز خدمات رعاية الأم والوليد للحصول على بيانات أكثر شمولاً حول الصرع عند الأطفال.',
        'audience_images' => [
            'images/project_epilepsy_stage.png',
            'images/project_epilepsy_2.jpg'
        ]
    ],
    '2' => [
        'title' => 'تقييم أثر الاستخدام العشوائي للمضادات الحيوية والوعي بمخاطر مقاومة البكتيريا بين مواطني أمانة العاصمة',
        'category' => 'pharmacy',
        'category_name' => 'بحوث الصيدلة',
        'date' => 'الأحد، 28 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80',
        'intro' => 'دراسة ميدانية لتقييم الوعي الدوائي ومخاطر صرف المضادات الحيوية دون وصفة طبية بصنعاء',
        'content' => 'بحثت هذه الدراسة نسب انتشار صرف واستهلاك المضادات الحيوية بشكل عشوائي دون استشارة طبية، ومدى وعي المواطنين بمفهوم مقاومة البكتيريا للمضادات (AMR) الذي بات يهدد الصحة العامة محلياً وعالمياً.',
        'participants' => [
            'أحمد محمد يحيى الكبسي',
            'فاطمة عبد الرحمن الشامي',
            'ياسر صالح علوان',
            'رنا جميل الحبيشي'
        ],
        'supervisors' => 'أشرف على هذا البحث الدكتور عبد السلام الحمادي، أستاذ الصيدلانيات بالكلية.',
        'conclusion' => 'أوصت الدراسة بوضع قوانين صارمة للحد من صرف المضادات الحيوية بدون وصفة طبية، وتكثيف حملات التوعية المجتمعية والأنشطة الإرشادية لرفع الوعي بمخاطر سوء استخدام الدواء.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1584308666744-24d5c474f2ae?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '3' => [
        'title' => 'مدى انتشار تسوس الأسنان وعلاقته بالعادات الغذائية بين أطفال المدارس الابتدائية بمدينة صنعاء',
        'category' => 'dentist',
        'category_name' => 'بحوث طب وجراحة الفم والأسنان',
        'date' => 'الثلاثاء، 30 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=800&q=80',
        'intro' => 'دراسة مسحية لتقييم صحة الفم والأسنان وعلاقتها بنمط التغذية لدى طلبة المدارس بصنعاء',
        'content' => 'استهدفت الدراسة عينات من طلاب المدارس الحكومية والخاصة لتقييم مؤشر تسوس الأسنان (DMFT)، واستقصاء دور تناول السكريات وإهمال نظافة الفم في زيادة معدلات التسوس لدى صغار السن.',
        'participants' => [
            'خالد وليد المطري',
            'مها علي شرف الدين',
            'أروى فؤاد القدسي',
            'سامي عبد الله الوصابي'
        ],
        'supervisors' => 'تم البحث تحت إشراف د. جمال الحيمي، رئيس قسم طب وجراحة الفم والأسنان بالكلية.',
        'conclusion' => 'أكدت النتائج على ضرورة تفعيل برامج الصحة المدرسية الوقائية، وتدريب الأطفال على الطريقة الصحيحة لتنظيف الأسنان، وتقديم فحوصات دورية مجانية بالتعاون مع العيادات التعليمية للكلية.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '4' => [
        'title' => 'أسباب وعوامل الإجهاض المتكرر بين النساء المترددات على مستشفى السبعين للأمومة والطفولة بصنعاء، اليمن',
        'category' => 'midwife',
        'category_name' => 'بحوث القبالة والتوليد',
        'date' => 'الخميس، 25 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1581056771107-24ca5f033842?auto=format&fit=crop&w=800&q=80',
        'intro' => 'دراسة سريرية حول مسببات الإجهاض التلقائي المتكرر والعوامل المناعية والوراثية المرتبطة به',
        'content' => 'تناول البحث دراسة الحالات السريرية للمريضات اللواتي يعانين من إسقاطات متكررة، بهدف تحديد أهم العوامل المسببة سواء كانت متعلقة بالهرمونات، الالتهابات المزمنة، أو نمط الحياة والصحة الإنجابية.',
        'participants' => [
            'بلقيس عبد الكريم العنسي',
            'زينب محمد المحاقري',
            'شروق خالد الحيمي'
        ],
        'supervisors' => 'تحت إشراف الدكتورة إيمان السنباني، استشارية طب النساء والتوليد والمشرفة الأكاديمية بقسم القبالة.',
        'conclusion' => 'دعت الدراسة لتوسيع الفحوصات الطبية قبل الزواج وأثناء الأشهر الأولى من الحمل، وتوفير الدعم الصحي والنفسي للحوامل للحد من مخاطر الإجهاض المتكرر.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1581056771107-24ca5f033842?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '5' => [
        'title' => 'توظيف العمارة الخضراء والمستدامة في إعادة تصميم وتخطيط المراكز والمرافق الصحية بمدينة صنعاء القديمة',
        'category' => 'arch',
        'category_name' => 'الهندسة المعمارية',
        'date' => 'الأربعاء، 24 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1503387762-592dedb8c260?auto=format&fit=crop&w=800&q=80',
        'intro' => 'مشروع إعادة تأهيل وتطوير المستشفيات التاريخية والمراكز الحضرية باستخدام مواد بناء بيئية ومستدامة',
        'content' => 'يهدف المشروع إلى إعادة صياغة التصاميم الداخلية والخارجية للمرافق الصحية بصنعاء القديمة، لدمج الإضاءة الطبيعية والتهوية الذاتية وتقليل استهلاك الطاقة مع الحفاظ على الهوية المعمارية اليمنية الأصيلة.',
        'participants' => [
            'محمد أمين السويدي',
            'أنس نجيب الآنسي',
            'يسرى عبد الله الحاوري'
        ],
        'supervisors' => 'أشرف على هذا المشروع الهندسي د. صلاح الدين الرحبي، أستاذ التصميم المعماري بالكلية.',
        'conclusion' => 'يقدم المشروع نموذجاً يحتذى به في إمكانية دمج التقنيات الخضراء كالألواح الشمسية وتدوير المياه الرمادية في المباني التراثية دون الإضرار بنسيجها المعماري الفريد.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1503387762-592dedb8c260?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '6' => [
        'title' => 'تطوير نظام سجلات طبية إلكتروني ذكي يعتمد على السحابة للمستشفيات والمراكز الصحية اليمنية',
        'category' => 'it',
        'category_name' => 'تكنولوجيا المعلومات',
        'date' => 'الثلاثاء، 23 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80',
        'intro' => 'مشروع برمجي لبناء منصة سحابية آمنة وموحدة لتبادل بيانات المرضى والتقارير الطبية في اليمن',
        'content' => 'استهدف البحث حل مشكلة ضياع وتشتت الملفات الورقية الطبية، عبر بناء واجهة برمجية وتطبيق ويب يتيح للأطباء في مختلف المستشفيات الوصول الفوري والآمن للتاريخ المرضي للحالات الطارئة مع حماية الخصوصية.',
        'participants' => [
            'هشام عبد الوهاب الشرعبي',
            'سارة نبيل القدسي',
            'أيمن منصور الخولاني'
        ],
        'supervisors' => 'تم التطوير تحت إشراف د. نبيل العبسي، عميد كلية تكنولوجيا المعلومات.',
        'conclusion' => 'تم إثبات كفاءة النظام عبر تشغيل نسخة تجريبية حية في العيادات التخصصية للكلية، مما قلل وقت مراجعة بيانات المرضى بنسبة 70% وحفظ سرية الملفات بكفاءة.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1531482615713-2afd69097998?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '7' => [
        'title' => 'تصميم الهويات البصرية المتكاملة للمؤسسات الصحية وحملات التوعية الطبية باستخدام الواقع المعزز',
        'category' => 'graphics',
        'category_name' => 'تصميم جرافيكس',
        'date' => 'الإثنين، 22 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80',
        'intro' => 'ابتكار وتصميم بوسترات تفاعلية وحملات بصرية ذكية تستهدف تحسين السلوك الصحي العام',
        'content' => 'ركز البحث على تحويل البوسترات الطبية التوعوية التقليدية إلى عناصر تفاعلية ذكية، حيث يستطيع المستخدم مسح الكود لمشاهدة مجسمات ثلاثية الأبعاد متحركة توضح أساليب الوقاية من الأوبئة.',
        'participants' => [
            'منى صادق الشرفي',
            'جمال رضوان الآنسي',
            'هدى يحيى الجلال'
        ],
        'supervisors' => 'تحت إشراف الأستاذة نسيم المهدي، رئيسة قسم التصميم الجرافيكي.',
        'conclusion' => 'خرج المشروع بمجموعة حملات توعوية تفاعلية نالت إعجاب الهيئات الطبية المحلية، لدورها في تعزيز استيعاب الأطفال والمراهقين للمعلومات الصحية بطرق ممتعة ومرحة.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?auto=format&fit=crop&w=800&q=80'
        ]
    ],
    '8' => [
        'title' => 'تقييم جودة الخدمات الصحية وأثرها على رضا المرضى في المستشفيات التعليمية الخاصة بأمانة العاصمة',
        'category' => 'business',
        'category_name' => 'إدارة أعمال ومحاسبة',
        'date' => 'السبت، 20 ديسمبر، 2025 م',
        'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80',
        'intro' => 'دراسة إدارية مالية لتقييم كفاءة تشغيل المستشفيات ومؤشرات جودة الرعاية المقدمة للمرضى',
        'content' => 'قامت الدراسة بجمع بيانات استقصائية من المرضى المترددين على المستشفيات الخاصة، لدراسة العلاقة بين جودة الخدمات الإدارية، وسرعة الاستجابة الطبية، ومدى الرضا العام وتكرار زيارة المرفق الصحي.',
        'participants' => [
            'وسيم عبد الحكيم الفضلي',
            'إلهام يحيى زبارة',
            'مروان صالح القديمي'
        ],
        'supervisors' => 'أشرف على هذا البحث الإداري أ.د. طارق الحبيشي، أستاذ إدارة الأعمال والمحاسبة.',
        'conclusion' => 'خلصت الدراسة لوجود فجوة إدارية في استقبال وتوجيه المرضى، وأوصت بتطبيق برامج إدارة الجودة الشاملة وتدريب الكادر الإداري للمستشفيات لتحسين تجربة المريض.',
        'audience_images' => [
            'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=800&q=80'
        ]
    ]
];

// التحقق من طلب تفاصيل مشروع معين
$project_id = isset($_GET['id']) ? $_GET['id'] : null;
$project = null;
if ($project_id && array_key_exists($project_id, $projects)) {
    $project = $projects[$project_id];
}
?>

<style>
.research-grid {
    display: grid;
    grid-template-columns: 1fr 2.2fr;
    gap: 30px;
    margin-top: 40px;
}
@media (max-width: 768px) {
    .research-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* ستايل قائمة التصفية الجانبية */
.sidebar-filter-link {
    display: flex;
    align-items: center;
    padding: 10px 20px;
    text-decoration: none;
    color: #555;
    font-size: 14px;
    border-right: 4px solid transparent;
    transition: all 0.3s ease;
}
.sidebar-filter-link:hover {
    background: #f0f7f7;
    color: #085859 !important;
}
.sidebar-filter-link.active-filter {
    color: #085859 !important;
    background: #f0f7f7;
    border-right: 4px solid #085859 !important;
    font-weight: bold;
}

/* ستايل كروت المشاريع في القائمة الرئيسية */
.project-list-card {
    display: flex;
    gap: 20px;
    align-items: center;
    padding: 20px 10px;
    border-bottom: 1px solid #eee;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none !important;
}
.project-list-card:hover {
    background: #fcfcfc;
    transform: translateX(-5px);
}
.project-list-card:hover .project-title {
    color: #085859 !important;
}
.project-title {
    color: #0d4748;
    font-size: 16px;
    font-weight: bold;
    line-height: 1.6;
    margin: 0 0 10px 0;
    transition: color 0.3s ease;
}

/* ستايل أزرار المشاركة التفاعلية بحدود رمادية وتغير الألوان حسب البرنامج عند التحويم */
.share-btn-new {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border: 1px solid #ccc;
    border-radius: 4px;
    text-decoration: none !important;
    font-size: 14px;
    font-weight: 500;
    background: white;
    transition: all 0.3s ease;
}
.share-btn-fb {
    color: #3b5998 !important;
}
.share-btn-fb:hover {
    background: #3b5998 !important;
    color: white !important;
    border-color: #3b5998 !important;
}
.share-btn-tw {
    color: #1da1f2 !important;
}
.share-btn-tw:hover {
    background: #1da1f2 !important;
    color: white !important;
    border-color: #1da1f2 !important;
}
.share-btn-wa {
    color: #25d366 !important;
}
.share-btn-wa:hover {
    background: #25d366 !important;
    color: white !important;
    border-color: #25d366 !important;
}
.share-btn-tg {
    color: #0088cc !important;
}
.share-btn-tg:hover {
    background: #0088cc !important;
    color: white !important;
    border-color: #0088cc !important;
}
.share-btn-ig {
    color: #e1306c !important;
}
.share-btn-ig:hover {
    background: #e1306c !important;
    color: white !important;
    border-color: #e1306c !important;
}

/* ستايل سلايدر صور الحضور والجمهور */
.audience-slider-container {
    position: relative;
    max-width: 100%;
    border-radius: 15px;
    overflow: hidden;
    margin-top: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    background: transparent;
}
.audience-slide {
    width: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    position: relative;
}
.audience-slide.active {
    display: flex;
    animation: fadeAudSlide 0.8s ease-in-out;
}
@keyframes fadeAudSlide {
    from { opacity: 0.5; }
    to { opacity: 1; }
}
.audience-slide img {
    max-width: 100%;
    max-height: 520px;
    width: auto;
    height: auto;
    object-fit: contain;
    border-radius: 15px;
}
.audience-slider-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}
.audience-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(0,0,0,0.3);
    cursor: pointer;
    transition: 0.3s;
}
.audience-dot.active {
    background: #085859;
    transform: scale(1.2);
}
</style>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;font-family:'Cairo', sans-serif;">
    
    <?php if ($project): ?>
        <!-- ==================== واجهة تفاصيل المشروع ==================== -->
        <div style="max-width:900px;margin:auto;background:white;border-radius:20px;padding:40px;box-shadow:0 10px 30px rgba(0,0,0,0.06);">
            
            <!-- عنوان المشروع -->
            <h1 style="color:#0d4748; font-size:24px; font-weight:bold; line-height:1.6; margin:0 0 15px 0; text-align:right;">
                <?php echo $project['title']; ?>
            </h1>
            
            <!-- التصنيف و التابعية -->
            <div style="display:flex; align-items:center; gap:10px; margin-bottom:20px;">
                <span style="color:#085859; font-weight:bold; font-size:14px; background:#f0f7f7; padding:4px 15px; border-radius:20px; border:1px solid #08585930;">
                    <?php echo $project['category_name']; ?> - الدراسات والبحوث
                </span>
            </div>
            
            <!-- خط فاصل عنابي -->
            <div style="width:50px; height:3px; background:#085859; margin-bottom:25px;"></div>
            
            <!-- الصورة الرئيسية للطلاب أو المناقشة -->
            <div style="max-width:100%; border-radius:15px; overflow:hidden; margin-bottom:30px; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
                <img src="<?php echo $project['image']; ?>" alt="صورة المشروع" style="width:100%; height:auto; display:block; object-fit:cover; max-height:480px;">
            </div>
            
            <!-- عنوان فرعي للبحث -->
            <h2 style="color:#085859; font-size:19px; font-weight:bold; line-height:1.6; margin:0 0 15px 0;">
                <?php echo $project['intro']; ?>
            </h2>
            
            <!-- محتوى وشرح البحث بالتفصيل -->
            <p style="line-height:2; font-size:16px; color:#444; text-align:justify; margin:0 0 30px 0;">
                <?php echo $project['content']; ?>
            </p>
            
            <!-- صندوق أسماء المشاركين في البحث -->
            <div style="background:#f5fafb; border:1px solid #08585920; border-radius:15px; padding:25px; margin:30px 0;">
                <h3 style="color:#085859; font-size:17px; font-weight:bold; margin:0 0 15px 0; display:flex; align-items:center; gap:8px;">
                    <i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> شارك في تنفيذ البحث كل من:
                </h3>
                <ol style="line-height:2.2; font-size:15px; color:#333; padding-right:20px; margin:0;">
                    <?php foreach ($project['participants'] as $p): ?>
                        <li style="font-weight:500;"><?php echo $p; ?></li>
                    <?php endforeach; ?>
                </ol>
            </div>
            
            <!-- صندوق المشرفين والتوصية النهائية -->
            <div style="background:#f0f4f8; border-right:4px solid #0d4748; border-radius:4px 15px 15px 4px; padding:20px 25px; margin-bottom:30px;">
                <p style="font-weight:bold; color:#0d4748; font-size:15px; margin:0 0 10px 0;"><i class="fa-solid fa-chalkboard-user" style="margin-left: 5px;"></i> الإشراف الأكاديمي:</p>
                <p style="color:#444; font-size:14px; line-height:1.8; margin:0 0 15px 0;"><?php echo $project['supervisors']; ?></p>
                
                <p style="font-weight:bold; color:#0d4748; font-size:15px; margin:0 0 10px 0;">💡 الخلاصة والتوصية:</p>
                <p style="color:#444; font-size:14px; line-height:1.8; margin:0; text-align:justify;"><?php echo $project['conclusion']; ?></p>
            </div>

            <!-- مشاركة الصفحة -->
            <div style="display:flex; align-items:center; gap:15px; flex-wrap:wrap; border-top:1px solid #eaeaea; padding-top:20px; margin-top:40px;">
                <span style="font-weight:bold; color:#333; font-size:15px;">مشاركة الصفحة:</span>
                
                <!-- فيسبوك -->
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-new share-btn-fb">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                    فيسبوك
                </a>
                
                <!-- تويتر -->
                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($project['title']); ?>" target="_blank" class="share-btn-new share-btn-tw">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                    تويتر
                </a>
                
                <!-- واتساب -->
                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($project['title'] . ' ' . 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-new share-btn-wa">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
                    واتساب
                </a>
                
                <!-- تليجرام -->
                <a href="https://telegram.me/share/url?url=<?php echo urlencode('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($project['title']); ?>" target="_blank" class="share-btn-new share-btn-tg">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M20.66 4.98l-2.76 13c-.15.68-.55.85-1.12.53l-4.2-3.1-2.03 1.95c-.22.22-.4.4-.83.4l.3-4.23 7.68-6.93c.33-.3-.07-.46-.5-.18L7.66 13.5l-4.1-1.28c-.9-.28-.9-.88.18-1.3L19.9 4.7c.75-.28 1.4.16 1.13 1.25z"/></svg>
                    تليجرام
                </a>
                
                <!-- انستجرام (نسخ الرابط مع التنبيه) -->
                <a href="#" onclick="copyProjectLink(event)" class="share-btn-new share-btn-ig">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051c-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                    انستجرام
                </a>
            </div>

            <!-- سلايدر صور الحضور والجمهور (تتغير كل 7 ثواني) -->
            <?php if (isset($project['audience_images']) && count($project['audience_images']) > 0): ?>
                <div style="border-top:1px solid #eaeaea; padding-top:30px; margin-top:40px;">
                    <h3 style="color:#0d4748; font-size:18px; font-weight:bold; margin:0 0 15px 0;">📸 معرض مناقشة وبحوث الطلاب والجمهور:</h3>
                    
                    <div class="audience-slider-container" id="audience-slider">
                        <?php foreach ($project['audience_images'] as $index => $img): ?>
                            <div class="audience-slide <?php echo $index === 0 ? 'active' : ''; ?>" data-slide-index="<?php echo $index; ?>">
                                <img src="<?php echo $img; ?>" alt="صورة الجمهور والمناقشة">
                            </div>
                        <?php endforeach; ?>
                        
                        <?php if (count($project['audience_images']) > 1): ?>
                            <div class="audience-slider-dots">
                                <?php foreach ($project['audience_images'] as $index => $img): ?>
                                    <span class="audience-dot <?php echo $index === 0 ? 'active' : ''; ?>" onclick="showAudienceSlide(<?php echo $index; ?>)"></span>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
            
            <!-- أزرار العودة أسفل تفاصيل المشروع -->
            <div style="text-align:center;margin-top:50px;display:flex;justify-content:center;gap:15px;flex-wrap:wrap;">
                <a href="?p=research" style="display:inline-flex;align-items:center;gap:10px;background:#085859;color:white;padding:12px 35px;border-radius:30px;text-decoration:none;font-weight:bold;font-size:16px;box-shadow:0 4px 15px rgba(8, 88, 89,0.2);transition:0.3s;" onmouseover="this.style.background='#0d4748';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#085859';this.style.transform='translateY(0)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    العودة لصفحة البحوث
                </a>
                <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            </div>
            
        </div>

        <script>
        // دالة نسخ الرابط لمشاركة انستجرام
        function copyProjectLink(e) {
            e.preventDefault();
            var tempInput = document.createElement("input");
            tempInput.value = window.location.href;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand("copy");
            document.body.removeChild(tempInput);
            
            var alertDiv = document.createElement("div");
            alertDiv.style.position = "fixed";
            alertDiv.style.bottom = "30px";
            alertDiv.style.right = "30px";
            alertDiv.style.background = "#e1306c";
            alertDiv.style.color = "white";
            alertDiv.style.padding = "12px 25px";
            alertDiv.style.borderRadius = "8px";
            alertDiv.style.boxShadow = "0 4px 15px rgba(0,0,0,0.2)";
            alertDiv.style.zIndex = "9999";
            alertDiv.style.fontFamily = "'Cairo', sans-serif";
            alertDiv.style.direction = "rtl";
            alertDiv.style.fontSize = "14px";
            alertDiv.innerText = "📋 تم نسخ رابط مشروع التخرج! يمكنك الآن مشاركته على انستجرام.";
            document.body.appendChild(alertDiv);
            
            setTimeout(function() {
                alertDiv.style.transition = "opacity 0.5s ease";
                alertDiv.style.opacity = "0";
                setTimeout(function() {
                    document.body.removeChild(alertDiv);
                }, 500);
            }, 3000);
        }

        // كود سلايدر الجمهور التفاعلي (7 ثواني)
        var currentAudIndex = 0;
        var audSlides = document.querySelectorAll(".audience-slide");
        var audDots = document.querySelectorAll(".audience-dot");
        var audInterval = null;

        function showAudienceSlide(index) {
            if (audSlides.length <= 1) return;
            
            // إزالة النشاط
            audSlides[currentAudIndex].classList.remove("active");
            if (audDots.length > 0) audDots[currentAudIndex].classList.remove("active");
            
            // تعيين المؤشر الجديد
            currentAudIndex = index;
            if (currentAudIndex >= audSlides.length) currentAudIndex = 0;
            if (currentAudIndex < 0) currentAudIndex = audSlides.length - 1;
            
            // تفعيل الجديد
            audSlides[currentAudIndex].classList.add("active");
            if (audDots.length > 0) audDots[currentAudIndex].classList.add("active");
            
            // إعادة ضبط التوقيت التلقائي لمنع تداخل الضغط اليدوي
            resetAudTimer();
        }

        function nextAudSlide() {
            showAudienceSlide(currentAudIndex + 1);
        }

        function startAudTimer() {
            if (audSlides.length > 1) {
                audInterval = setInterval(nextAudSlide, 7000); // 7 ثواني كما طلب العميل
            }
        }

        function resetAudTimer() {
            if (audInterval) {
                clearInterval(audInterval);
                startAudTimer();
            }
        }

        // بدء التايمر عند تحميل الصفحة
        window.addEventListener("DOMContentLoaded", function() {
            startAudTimer();
        });
        </script>
        
    <?php else: ?>
        <!-- ==================== واجهة قائمة المشاريع الرئيسية ==================== -->
        
        <!-- القسم العلوي: مقدمة الدراسات والبحوث -->
        <div style="max-width:1100px;margin:auto;background:white;border-radius:20px;padding:40px;box-shadow:0 10px 30px rgba(0,0,0,0.06);text-align:justify;">
            <h1 style="color:#0d4748;border-bottom:3px solid #085859;padding-bottom:15px;font-size:26px;font-weight:bold;margin:0 0 20px 0;">🔬 الدراسات والبحوث</h1>
            <p style="line-height:2;font-size:17px;color:#444;margin:0;font-family:'Cairo', sans-serif;">
                تهتم كلية سماء المتميزين للعلوم الصحية والتكنولوجيا بالبحث العلمي وتشجيع الطلاب وأعضاء هيئة التدريس على إجراء الدراسات والأبحاث التطبيقية ومشاريع التخرج المتميزة في مختلف المجالات الطبية، الصحية، والتكنولوجية، بما يساهم في تطوير الرعاية الصحية وتقديم حلول تقنية مبتكرة لخدمة المجتمع.
            </p>
        </div>
        
        <!-- القسم السفلي: كروت المشاريع والفلترة الجانبية -->
        <div style="max-width:1100px;margin:0 auto;" class="research-grid">
            
            <!-- الجانب الأيمن في RTL: قائمة التصنيفات والفلترة (أولاً في HTML ليعرض يميناً) -->
            <div style="background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06); padding:20px 0; border:1px solid #eaeaea; height:fit-content;">
                <a href="#" onclick="filterCategory(event, 'all')" class="sidebar-filter-link active-filter">
                    الرئيسية
                </a>
                
                <div style="padding:15px 20px 5px; font-weight:bold; color:#0d4748; font-size:16px; border-top:1px solid #f0f0f0; margin-top:10px;">
                    الأقسام الطبية والصحية
                </div>
                <a href="#" onclick="filterCategory(event, 'dentist')" class="sidebar-filter-link">
                    بحوث طب وجراحة الفم والأسنان
                </a>
                <a href="#" onclick="filterCategory(event, 'pharmacy')" class="sidebar-filter-link">
                    بحوث الصيدلة
                </a>
                <a href="#" onclick="filterCategory(event, 'assistant')" class="sidebar-filter-link">
                    بحوث مساعد طبيب
                </a>
                <a href="#" onclick="filterCategory(event, 'midwife')" class="sidebar-filter-link">
                    بحوث القبالة والتوليد
                </a>
                
                <div style="padding:15px 20px 5px; font-weight:bold; color:#0d4748; font-size:16px; border-top:1px solid #f0f0f0; margin-top:10px;">
                    الأقسام الهندسية والتقنية
                </div>
                <a href="#" onclick="filterCategory(event, 'arch')" class="sidebar-filter-link">
                    الهندسة المعمارية
                </a>
                <a href="#" onclick="filterCategory(event, 'it')" class="sidebar-filter-link">
                    تكنولوجيا المعلومات
                </a>
                <a href="#" onclick="filterCategory(event, 'graphics')" class="sidebar-filter-link">
                    تصميم جرافيكس
                </a>

                <div style="padding:15px 20px 5px; font-weight:bold; color:#0d4748; font-size:16px; border-top:1px solid #f0f0f0; margin-top:10px;">
                    الأقسام الإدارية والمالية
                </div>
                <a href="#" onclick="filterCategory(event, 'business')" class="sidebar-filter-link">
                    إدارة أعمال ومحاسبة
                </a>
            </div>

            <!-- الجانب الأيسر في RTL: قائمة مشاريع التخرج السابقة -->
            <div style="background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06); padding:30px 40px;" id="projects-content-area">
                <h2 style="color:#0d4748; font-size:20px; font-weight:bold; margin-bottom:20px; border-bottom:2px solid #f0f0f0; padding-bottom:10px;">مشاريع التخرج السابقة</h2>
                
                <div style="display:flex; flex-direction:column;" id="projects-list-wrapper">
                    
                    <?php foreach ($projects as $id => $item): ?>
                        <div class="project-list-card" data-category="<?php echo $item['category']; ?>" onclick="location.href='?p=research&id=<?php echo $id; ?>'">
                            <div style="flex-grow:1; text-align:right;">
                                <h3 class="project-title"><?php echo $item['title']; ?></h3>
                                <span style="color:#999; font-size:13px; display:block;">📅 <?php echo $item['date']; ?></span>
                            </div>
                            <div style="width:140px; height:90px; border-radius:10px; overflow:hidden; flex-shrink:0; background:#f0f2f5;">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['category']; ?>" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        </div>
                    <?php endforeach; ?>
                    
                </div>
            </div>
            
        </div>

        <!-- زر العودة الأنيق المتطابق أسفل قائمة المشاريع الرئيسية -->
        <div style="max-width:1100px;margin:40px auto 0;text-align:center;">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
        </div>

        <!-- كود الفلترة الذكي للمشاريع في الصفحة الرئيسية للبحوث -->
        <script>
        function filterCategory(event, category) {
            event.preventDefault();
            
            // تغيير التنشيط في القائمة الجانبية
            var links = document.querySelectorAll(".sidebar-filter-link");
            links.forEach(function(link) {
                link.classList.remove("active-filter");
            });
            event.currentTarget.classList.add("active-filter");
            
            // فلترة المشاريع
            var cards = document.querySelectorAll(".project-list-card");
            cards.forEach(function(card) {
                if (category === "all") {
                    card.style.display = "flex";
                } else {
                    var cat = card.getAttribute("data-category");
                    if (cat === category) {
                        card.style.display = "flex";
                    } else {
                        card.style.display = "none";
                    }
                }
            });
        }
        </script>
    <?php endif; ?>
    
</div>