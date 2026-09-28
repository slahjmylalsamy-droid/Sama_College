<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    define('INCLUDED_FROM_INDEX', true);
}

// Master Data Repository for all Majors
$majors_database = [
    'major_pharmacy' => [
        'title' => 'برنامج الصيدلة',
        'dept_name' => 'قسم العلوم الطبية والصيدلانية',
        'head_title' => 'د. عبد الرحمن أحمد الفتيعي',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'الريادة والتميز الأكاديمي والبحثي في العلوم الصيدلانية على المستوى المحلي والإقليمي، والإسهام الفاعل في الارتقاء بالخدمات الدوائية والصحة العامة.',
        'dept_mission' => 'تأهيل صيدلانيين وأطباء دواء أكفاء علمياً ومهنياً قادرين على المنافسة محلياً وإقليمياً، ملتزمين بأخلاقيات المهنة من خلال بيئة تعليمية وبحثية وتدريبية محفزة، وتعزيز التعلم المستمر من أجل تقديم رعاية صحية دوائية متميزة للمجتمع.',
        'dept_goals' => [
            'إعداد وتأهيل أطباء صيدلانيين يمتلكون الكفاءة العلمية والمهنية اللازمة للممارسة الدوائية ومواصلة دراساتهم العليا.',
            'توفير بيئة تعليمية وتدريبية محفزة تعزز التعلم المستمر والتطوير المهني.',
            'تنمية القيم المهنية والأخلاقية وترسيخ مبادئ المسؤولية المجتمعية لدى الطلبة والخريجين.',
            'تعزيز جودة التعليم الصيدلاني من خلال تطوير البرنامج التعليمي وفق المعايير الأكاديمية الحديثة.',
            'تعزيز البحث العلمي وتشجيع أعضاء هيئة التدريس والطلبة على إجراء البحوث التي تسهم في تطوير المعرفة الطبية والدوائية.',
            'بناء شراكات علمية ومهنية مع المؤسسات الصحية والأكاديمية على المستويين الوطني والإقليمي.'
        ],
        'program_vision' => 'تخريج صيدلي متميز يمتلك أعلى مستويات المعرفة والمهارة السريرية والصناعية للارتقاء بصحة المجتمع والابتكار الدوائي.',
        'program_mission' => 'إعداد كوادر صيدلانية متخصصة تمتلك المعرفة والمهارات المتقدمة في الرعاية الصيدلانية، والتصنيع الدوائي، والتحليل الكيميائي، والممارسة السريرية المعتمدة في المستشفيات والمراكز العلاجية.',
        'program_goals' => [
            'إكساب الطلاب المعارف والمهارات الأساسية والمتقدمة في الكيمياء الدوائية وحركية الدواء.',
            'تدريب الطلاب على التصنيع الدوائي ومراقبة الجودة وفق المعايير العالمية.',
            'تأهيل الخريجين لتقديم الاستشارات الصيدلانية الفاعلة في منظومة الرعاية الصحية.',
            'تمكين الطلاب من تطبيق الإرشادات الدوائية ورعاية المرضى بالتعاون مع الفريق الطبي.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['كيمياء عامة', 'علم الأحياء الدقيقة', 'مصطلحات طبية', 'لغة إنجليزية طبية'], 'sem2' => ['كيمياء عضوية', 'فيزيولوجيا الأعضاء', 'صيدلانيات 1', 'علم التشريح'], 'hours' => '36'],
            ['year' => 'السنة الثانية', 'sem1' => ['كيمياء دوائية 1', 'علم الأدوية 1', 'صيدلانيات 2', 'كيمياء حيوية'], 'sem2' => ['كيمياء دوائية 2', 'علم الأدوية 2', 'صيدلة سريرية 1', 'علم السموم'], 'hours' => '38'],
            ['year' => 'السنة الثالثة', 'sem1' => ['تصنيع دوائي', 'صيدلة سريرية 2', 'رقابة دوائية', 'تسويق صيدلاني'], 'sem2' => ['مشروع التخرج', 'التدريب الصيدلاني الميداني', 'أخلاقيات وقوانين الصيدلة'], 'hours' => '34']
        ],
        'research_projects' => 'يهتم قسم الصيدلة بإجراء أبحاث حقلية وتطبيقية تناقش دقة الجرعات الدوائية، والتحليل الكيميائي للنباتات الطبية المحلية، ومراقبة الجودة في المستحضرات الدوائية اليمنية، وتطوير مشاريع التخرج في الممارسات الصيدلانية السريرية.',
        'head_speech' => 'أهلاً بكم في قسم العلوم الصيدلانية بكلية سماء المتميزين. نسعى جاهدين لتقديم أفضل البرامج الأكاديمية والتدريب العملي في المختبرات الطبية والدوائية المجهزة بأحدث التقنيات لضمان تخرج صيدلي متميز يخدم وطنه ومجتمعه بكفاءة واقتدار.',
        'outcomes' => [
            'القدرة على تركيب وتحليل وتصنيف المركبات الدوائية بدقة عالية.',
            'إتقان المهارات السريرية في تقديم المشورة الدوائية وحساب الجرعات.',
            'الإلمام بالقوانين والتشريعات الصيدلانية وأخلاقيات المهنة.',
            'المعرفة الكاملة بطرق تقييم الجودة والتصنيع الدوائي المستدام.'
        ],
        'gallery' => [
            'images/slider_mission.jpg?v=3',
            'images/slider_campus.jpg?v=3',
            'images/slider_vision.jpg?v=3'
        ]
    ],

    'major_assistant' => [
        'title' => 'برنامج مساعد طبيب',
        'dept_name' => 'قسم العلوم الطبية والصحة العامة',
        'head_title' => 'د. خالد علي باسويد',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'أن نكون القسم المفضل والمتميز في إعداد وتأهيل مساعدي الأطباء والكادر الصحي المساند على المستوى المحلي والمنطقة.',
        'dept_mission' => 'تأهيل كادر طبي مساند متميز يمتلك الكفاءة السريرية والتشخيصية لتقديم الخدمات الطبية الأولية والطوارئ بكفاءة عالية، ملتزمين بأخلاقيات الرعاية الصحية والمسؤولية الإنسانية.',
        'dept_goals' => [
            'إعداد مساعدي أطباء كفؤين يمتلكون المعارف والمهارات الميدانية لتقديم الرعاية الأولية.',
            'تطوير مهارات التشخيص السريري الفعال في مراكز الرعاية الصحية والمستشفيات.',
            'تعزيز الوعي الصحي والإسعافي الميداني والتعامل مع حالات الطوارئ بنجاح.',
            'ترسيخ القيم الإنسانية والأخلاقية والعمل الجماعي ضمن الفريق الطبي.'
        ],
        'program_vision' => 'التميز العلمي والسريري في تقديم الخدمات الطبية والإسعافات الأولية والتأهيل الشامل لمساعد الطبيب العام.',
        'program_mission' => 'تخريج مساعدي أطباء مؤهلين علمياً وعملياً للمشاركة الفاعلة في منظومة الرعاية الصحية، وإجراء الفحوصات التشخيصية، وإدارة الطوارئ الطبية في مختلف المناطق.',
        'program_goals' => [
            'إكساب الطلاب مهارات الفحص السريري وقراءة التحاليل الطبية والتقارير.',
            'تدريب الطلاب على تقديم الرعاية الإسعافية الأولية والتعامل مع الإصابات والحروق.',
            'تأهيل الطلاب للمشاركة في الحملات الصحية والوقائية وخدمة المجتمع.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['علم التشريح 1', 'علم وظائف الأعضاء 1', 'إسعافات أولية', 'مصطلحات طبية'], 'sem2' => ['علم التشريح 2', 'علم الأدوية العام', 'أمراض باطنية 1', 'تمريض أساسي'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['أمراض باطنية 2', 'جراحة عامة 1', 'تشخيص سريري 1', 'صحة مجتمع'], 'sem2' => ['طب الأطفال', 'أمراض نساء وتوليد', 'جراحة عامة 2', 'فحوصات مخبرية'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['طب الطوارئ والعناية', 'أخلاقيات الممارسة الطبية', 'تشخيص سريري 2'], 'sem2' => ['التدريب السريري الميداني المستمر', 'مشروع التخرج'], 'hours' => '32']
        ],
        'research_projects' => 'تركز مشاريع تخرج برنامج مساعد طبيب على مسوحات الأمراض الشائعة، ودراسات كفاءة الإسعافات الأولية في المراكز الصحية، وتقديم أدلة عمل مساندة للطبيب العام.',
        'head_speech' => 'يسرنا استقبال طلابنا في برنامج مساعد طبيب، حيث نوفر بيئة تدريبية عملية ممتازة بالمراكز الصحية والمستشفيات لتخريج كوادر صحية مساندة تشكل ركيزة أساسية في الخدمات الطبية.',
        'outcomes' => [
            'إتقان مهارات الفحص السريري الشامل وتشخيص الأمراض الشائعة.',
            'تقديم الإسعافات الأولية والرعاية الطبية الفورية في حالات الطوارئ.',
            'كتابة التقارير الطبية ومتابعة الحالة الصحية للمرضى بدقة.'
        ],
        'gallery' => [
            'images/slider_mission.jpg?v=3',
            'images/slider_campus.jpg?v=3'
        ]
    ],

    'major_midwife' => [
        'title' => 'برنامج القبالة والتوليد',
        'dept_name' => 'قسم العلوم الطبية وصحة الأم والطفل',
        'head_title' => 'د. أروى عبد الله سعيد',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'الريادة والتميز الأكاديمي والسريري في علوم صحة الأم والطفل والقبالة والتوليد بما يعزز سلامة المجتمع.',
        'dept_mission' => 'تقديم تعليم وتدريب متميز في مجال صحة الأم والطفل والقبالة والتوليد وفق أعلى المعايير الصحية والمهنية لضمان سلامة الأمومة والطفولة.',
        'dept_goals' => [
            'إعداد قوابل متخصصات يمتلكن الكفاءة العالية في متابعة الحمل والرعاية أثناء الولادة.',
            'توفير تدريب عملي مكثف في أقسام الولادة والمستشفيات التعليمية.',
            'تعزيز الثقافة الصحية الوقائية والتثقيف الصحي للأمهات.',
            'ترسيخ أخلاقيات مهنة القبالة والتوليد والتعامل الإنساني الراقي.'
        ],
        'program_vision' => 'إعداد قابِلات متميزات يمتلكن أعلى درجات الكفاءة المهنية والإنسانية لرعاية الأمومة والطفولة حديثة الولادة.',
        'program_mission' => 'إعداد قابِلات متميزات ومؤهلات علمياً ومهنياً لتقديم رعاية صحية آمنة وشاملة للأمهات والأطفال حديثي الولادة والتعامل مع حالات الولادة الطبيعية والحرجة.',
        'program_goals' => [
            'إكساب الطالبة الخبرات العملية في مراقبة نمو الجنين ورعاية الأم الحامل.',
            'إتقان مهارات توليد الحالات الطبيعية والتعامل السريع مع مضاعفات الولادة.',
            'تأهيل الكادر لتقديم رعاية المواليد الجدد والتطعيمات والتغذية الصحية.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['تشريح الجهاز التناسلي', 'علم وظائف الأعضاء', 'أساسيات التمريض', 'مصطلحات طبية'], 'sem2' => ['متابعة الحمل والرعاية الأولية', 'علم الأدوية في القبالة', 'علم التغذية للأم'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['التوليد الطبيعي 1', 'رعاية المواليد الحديثي الولادة', 'أمراض النساء 1'], 'sem2' => ['التوليد الطبيعي 2', 'حالات الولادة الحرجة', 'أمراض النساء 2'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['صحة المجتمع والأسرة', 'تثقيف صحي ورعاية الأمومة', 'طوارئ توليد'], 'sem2' => ['التدريب الميداني التخصصي بالمستشفيات', 'مشروع التخرج'], 'hours' => '32']
        ],
        'research_projects' => 'تناقش الأبحاث والمشاريع الخاصة بالبرنامج استراتيجيات تقليل وفيات الأمهات، وتحسين خدمات التوليد الطبيعي، ورفع مستوى الرعاية الصحية للأطفال حديثي الولادة.',
        'head_speech' => 'نرحب بكم في برنامج القبالة والتوليد بكليتنا، حيث نعمل على تدريب وتأهيل القابلات بأعلى مستويات المعرفة والمهارة الميدانية لحماية صحة الأم والطفل في جميع أرجاء الوطن.',
        'outcomes' => [
            'الإلمام الشامل بفحوصات متابعة الحمل ومراحل الولادة الطبيعية.',
            'القدرة على التعامل مع حالات التوليد الطارئة وإعادة إنعاش المواليد.',
            'تقديم الاستشارات الصحية والتغذوية الشاملة للأمهات حديثي الولادة.'
        ],
        'gallery' => [
            'images/slider_mission.jpg?v=3',
            'images/slider_campus.jpg?v=3'
        ]
    ],

    'major_it' => [
        'title' => 'برنامج تقنية المعلومات',
        'dept_name' => 'قسم تكنولوجيا المعلومات والحاسوب',
        'head_title' => 'د. صادق محمد الشرعبي',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'الريادة في تقديم تعليم تكنولوجي متميز وبحوث تطبيقية مبتكرة تخدم التحول الرقمي والتطور التقني.',
        'dept_mission' => 'إعداد مهندسي ومطوري تقنية معلومات قادرين على بناء النظم البرمجية وشبكات الحاسوب وتطبيقات الذكاء الاصطناعي، بما يلبي احتياجات التحول الرقمي المحلي والإقليمي.',
        'dept_goals' => [
            'تأهيل مهندسي برمجيات وشبكات يمتلكون المعارف البرمجية والتقنية المتقدمة.',
            'توفير معامل كمبيوتر متطورة مجهزة بأحدث أدوات التطوير والذكاء الاصطناعي.',
            'تعزيز ثقافة الابتكار وبناء التطبيقات الرقمية والحلول التكنولوجية الذكية.',
            'ربط الطلاب بسوق العمل الرقمي وتطوير مشاريع تخرج عملية ذات جدوى اقتصادية.'
        ],
        'program_vision' => 'تخريج مهندسي ومطوري تقنية معلومات يمتلكون الإبداع والمهارة القيادية لبناء الأنظمة والحلول البرمجية الذكية.',
        'program_mission' => 'تأهيل أخصائيي تقنية معلومات يمتلكون مهارات البرمجة الحديثة، وإدارة شبكات البيانات، والأمن السيبراني، وتطوير المواقع وتطبيقات الهواتف الذكية بكفاءة عالية.',
        'program_goals' => [
            'تمكين الطلاب من إتقان لغات البرمجة الحديثة (Python, Java, PHP, JavaScript).',
            'تدريب الطلاب على تصميم وإدارة قواعد البيانات الضخمة والنظم السحابية.',
            'تأهيل الطلاب في مجالات حماية شبكات المعلومات والحلول البرمجية.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['مقدمة تقنية المعلومات', 'أساسيات البرمجة Python', 'رياضيات الحاسوب', 'لغة إنجليزية تقنية'], 'sem2' => ['برمجة هيكلية C++', 'قواعد البيانات 1', 'ترتيب ومعمارية الحاسوب'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['برمجة كائنية Java', 'شبكات الحاسوب 1', 'تصميم وتطوير المواقع Web', 'قواعد بيانات متقدمة'], 'sem2' => ['أمن المعلومات والسيبراني', 'تحليل وتصميم الأنظمة', 'تطوير تطبيقات الموبايل'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['حوسبة سحابية', 'الذكاء الاصطناعي', 'إدارة مشاريع تقنية المعلومات'], 'sem2' => ['مشروع التخرج التطبيقي', 'التدريب الميداني المؤسسي'], 'hours' => '32']
        ],
        'research_projects' => 'تغطي مشاريع تخرج تخصص تقنية المعلومات تطوير الأنظمة الطبية والإدارية الذكية، وتطبيقات التجارة الإلكترونية، وأنظمة الذكاء الاصطناعي في تحليل البيانات وتحسين الخدمات.',
        'head_speech' => 'يسر قسم تقنية المعلومات أن يرحب بطلاب الغد في عالم التكنولوجيا. نوفر لكم بيئة علمية متميزة ومعامل حديثة لتصبحوا قادة التحول الرقمي ومطوري المستقبل.',
        'outcomes' => [
            'إتقان تحليل وتصميم وبناء النظم البرمجية والتطبيقات الذكية.',
            'إدارة وتأمين شبكات الحاسوب وقواعد البيانات المؤسسية.',
            'تطوير مواقع الويب وتطبيقات الهواتف الذكية وفق أحدث المعايير.'
        ],
        'gallery' => [
            'images/slider_vision.jpg?v=3',
            'images/news_launch.jpg'
        ]
    ],

    'major_graphics' => [
        'title' => 'برنامج الجرافيكس والتصميم',
        'dept_name' => 'قسم الجرافيكس والفنون الرقمية',
        'head_title' => 'أ. هشام عبد القادر مرشد',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'أن نصبح المرجع الأكاديمي الرائد في ابتكار الفنون الرقمية، والهويات البصرية، والتصميم الجرافيكي المتميز.',
        'dept_mission' => 'تأهيل مصممين وفنانين رقميين يمتلكون الإبداع والمهارة التقنية في بناء الهويات البصرية، والوسائط الفنية المتعددة، والإعلان الرقمي وفق أعلى التوجهات العالمية.',
        'dept_goals' => [
            'تطوير مهارات التفكير الإبداعي والتصميم الفني والهندسي لدى الطلاب.',
            'توفير مختبرات وتطبيقات تصوير ورسوم متحركة ومونتاج عالية الأداء.',
            'تدريب الطلاب على تصميم الهويات البصرية المتكاملة والحملات الإعلانية.',
            'تمكين الطلاب من بناء معرض أعمال (Portfolio) محترف للمنافسة في سوق العمل.'
        ],
        'program_vision' => 'إعداد مصممين رقميين محترفين يمتلكون الحس الفني والمهارات التقنية المتقدمة لبناء الحلول البصرية والإعلانية.',
        'program_mission' => 'تخريج مصممي جرافيكس ومؤثرات بصرية محترفين قادرين على ابتكار التصاميم الرقمية، وتطوير واجهات المستخدم UI/UX، والإنتاج الفني والطباعي.',
        'program_goals' => [
            'إكساب الطلاب مهارات العمل الاحترافي على برامج Adobe (Photoshop, Illustrator, Premiere, After Effects).',
            'تدريب الطلاب على فنون التيبوجرافي والهوية البصرية والإخراج الصحفي الرقمي.',
            'تأهيل الخريجين للعمل في وكالات الإعلان والشركات والمؤسسات الإعلامية.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['أساسيات الرسم والتصميم', 'برنامج Photoshop', 'نظرية الألوان والإضاءة', 'تاريخ الفن الرقمي'], 'sem2' => ['تصميم المتجهات Illustrator', 'فنون التيبوجرافي', 'تصميم المطبوعات والتغليف'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['تصميم الهويات البصرية', 'مونتاج الفيديو Premiere', 'الإخراج الصحفي الرقمي'], 'sem2' => ['الرسوم المتحركة After Effects', 'تصميم واجهات المستخدم UI/UX', 'تصوير فوتوغرافي'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['تصميم ثنائي وثلاثي الأبعاد 3D', 'إستراتيجيات الإعلان والتسويق', 'إدارة الورش الفنية'], 'sem2' => ['مشروع معرض التخرج النهائي', 'التدريب الميداني بوكالات الإعلان'], 'hours' => '32']
        ],
        'research_projects' => 'تشمل مشاريع تخرج برنامج الجرافيكس إنتاج الهويات البصرية الشاملة للمؤسسات، والأفلام الوثائقية والترويجية، وتصاميم واجهات المستخدم للتطبيقات الذكية.',
        'head_speech' => 'نرحب بمبدعي المستقبل في قسم الجرافيكس والتصميم الرقمي. نحول الشغف إلى مهنة واحتراف من خلال برامجنا التطبيقية ومعاملنا الحديثة.',
        'outcomes' => [
            'تصميم الهويات البصرية المتكاملة والشعارات والوسائط الإعلانية.',
            'إتقان مهارات المونتاج والمؤثرات البصرية وتصميم الرسوم المتحركة.',
            'ابتكار واجهات تجربة المستخدم (UI/UX) للتطبيقات والمواقع الرقمية.'
        ],
        'gallery' => [
            'images/slider_vision.jpg?v=3',
            'images/news_launch.jpg'
        ]
    ],

    'major_arch' => [
        'title' => 'برنامج الهندسة المعمارية',
        'dept_name' => 'قسم الهندسة والتصميم المعماري',
        'head_title' => 'م. أنور محمد القدسي',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'التميز في التنسيق والعمارة المستدامة التي تدمج بين الأصالة والمعاصرة والتطبيقات الهندسية المتقدمة.',
        'dept_mission' => 'تقديم تعليم هندسي معماري متميز يجمع بين الأصالة المعمارية، والتصميم المستدام، والتقنيات الهندسة الحديثة لبناء وتصميم بيئات عمرانية راقية ومستدامة.',
        'dept_goals' => [
            'إعداد مهندسين معماريين يمتلكون الإبداع الهندسي والقدرة التخطيطية.',
            'توفير استوديوهات تصميم معماري ومعامل نمذجة ثلاثية الأبعاد (3D Rendering).',
            'دمج ممارسات المباني الخضراء والتصميم المستدام في المناهج الدراسية.',
            'ربط التصميم المعماري بالتنفيذ الميداني وحساب الكميات والمواصفات.'
        ],
        'program_vision' => 'تأهيل مهندسين المعماريين مبدعين قادرين على التخطيط والتصميم الحضري المتكامل والمستدام.',
        'program_mission' => 'إعداد مهندسين معماريين يمتلكون القدرة على التصميم المبتكر، والتخطيط الحضري، والتنفيذ الهندسي المتقن للمشاريع السكنية والتجارية والعامة.',
        'program_goals' => [
            'إتقان البرامج الهندسية الحديثة (AutoCAD, Revit, 3ds Max, Lumion).',
            'تأهيل الطلاب في أساليب الإظهار المعماري والتصميم الداخلي والحدائق.',
            'تدريب الطلاب على إعداد المخططات التنفيذية وجداول الكميات.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['رسم معماري وإظهار', 'مبادئ التصميم المعماري', 'تاريخ العمارة', 'رياضيات هندسية'], 'sem2' => ['تصميم معماري 1', 'الرسم الهندسي AutoCAD', 'مواد البناء والتنفيذ'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['تصميم معماري 2', 'النمذجة والمعمار Revit', 'إنشاء مباني 1', 'عمارة بيئية'], 'sem2' => ['تصميم معماري 3', 'الإظهار ثلاثي الأبعاد 3ds Max', 'تخطيط حضري', 'تركيبات فنية'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['تصميم معماري متقدم 4', 'تصميم داخلي وحدائق', 'حساب كميات ومواصفات'], 'sem2' => ['مشروع التخرج المعماري الشامل', 'التدريب الميداني بالمواقع الإنشائية'], 'hours' => '32']
        ],
        'research_projects' => 'تناقش مشاريع تخرج الهندسة المعمارية تصميم المستشفيات والجامعات والمجمعات السكنية والتجارية الحديثة، مع التركيز على المعمار اليمني الأصيل والحفاظ على الهوية المعمارية.',
        'head_speech' => 'نرحب بمهندسي المستقبل في قسم الهندسة المعمارية. نحرص على صقل مهاراتكم الفنية والهندسية لتتحول أفكاركم إلى مشاريع وصروح معمارية تخدم المجتمع.',
        'outcomes' => [
            'إعداد المخططات والتصاميم المعمارية والحضرية للمشاريع المختلفة.',
            'استخدام تقنيات النمذجة الإنشائية والمعمارية ثلاثية الأبعاد بمهارة عالية.',
            'إدارة ورش العمل والمواقع الإنشائية والإشراف على التنفيذ المعماري.'
        ],
        'gallery' => [
            'images/slider_campus.jpg?v=3',
            'images/slider_vision.jpg?v=3'
        ]
    ],

    'major_accounting' => [
        'title' => 'برنامج المحاسبة',
        'dept_name' => 'قسم العلوم المالية والمحاسبية',
        'head_title' => 'د. طه حسين عبد العزيز',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'الريادة في التعليم المحاسبي والمالي والرقابي المستند إلى المعايير والنظم الرقمية الحديثة.',
        'dept_mission' => 'إعداد محاسبين وخبراء ماليين يمتلكون الكفاءة في تحليل البيانات المالية، والتدقيق، وتطبيق النظم المحاسبية الإلكترونية، بما يضمن دقة وشفافية الأداء المالي بالمؤسسات.',
        'dept_goals' => [
            'تأهيل كادر محاسبي متخصص في المحاسبة المالية والتكاليف والتدقيق.',
            'توفير تدريب عملي على الأنظمة المحاسبية الإلكترونية والبرامج المالية.',
            'ترسيخ معايير المحاسبة والتدقيق الدولية في إعداد القوائم والتقارير المالية.',
            'تنمية مهارات التفكير التحليلي والحلول المالية الذكية للشركات.'
        ],
        'program_vision' => 'إعداد خبراء ومحاسبين قانونيين متميزين بالنزاهة والكفاءة العالية في إدارة وتدقيق النظم المالية.',
        'program_mission' => 'تأهيل محاسبين قانونيين وماليين قادرين على إدارة الحسابات، والتدقيق المالي، والمحاسبة الضريبية في الشركات والمؤسسات المصرفية والقطاع العام.',
        'program_goals' => [
            'تدريب الطلاب على البرامج المحاسبية الشهيرة (الأونكس بروف، يمن سوفت، المتكامل).',
            'إتقان إعداد القوائم المالية، والموازنات التقديرية، والتحليل المالي.',
            'تأهيل الخريجين لتطبيق معايير المراجعة الداخلية والرقابة المالية.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['مبادئ المحاسبة 1', 'مبادئ الإدارة', 'مبادئ الاقتصاد الجزئي', 'رياضيات مالية'], 'sem2' => ['مبادئ المحاسبة 2', 'محاسبة شركات الأشخاص', 'قانون تجاري', 'إحصاء تطبيقي'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['محاسبة متوسطة 1', 'محاسبة تكاليف 1', 'محاسبة حكومية', 'أنظمة محاسبية إلكترونية'], 'sem2' => ['محاسبة متوسطة 2', 'محاسبة تكاليف 2', 'مراجعة وتدقيق 1', 'محاسبة بنوك'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['محاسبة متقدمة', 'تحليل مالي وموازنات', 'مراجعة وتدقيق 2', 'محاسبة ضريبية'], 'sem2' => ['مشروع التخرج التطبيقي', 'التدريب المحاسبي الميداني في الشركات'], 'hours' => '32']
        ],
        'research_projects' => 'تركز مشاريع التخرج في قسم المحاسبة على دراسات التحول نحو النظم المحاسبية الإلكترونية، والرقابة الداخلية في البنوك اليمنية، وتقييم الأداء المالي بالشركات.',
        'head_speech' => 'يسر قسم العلوم المحاسبية استقبال طلابنا الجدد. نوفر لكم المناهج المحدثة والتطبيق العملي على أحدث البرامج المالية لتكونوا المحاسبين المعتمدين والمفضلين في سوق العمل.',
        'outcomes' => [
            'إعداد وإغلاق القوائم والتقارير المالية وفق المعايير الدولية.',
            'استخدام الأنظمة المحاسبية الإلكترونية والحلول البرمجية المالية بكفاءة.',
            'تنفيذ أعمال التدقيق، والمراجعة المالية، وحساب التكاليف والضرائب.'
        ],
        'gallery' => [
            'images/slider_campus.jpg?v=3',
            'images/slider_vision.jpg?v=3'
        ]
    ],

    'major_business' => [
        'title' => 'برنامج إدارة الأعمال',
        'dept_name' => 'قسم العلوم الإدارية والتسويق',
        'head_title' => 'د. سمير أحمد الخولاني',
        'duration_years' => '3',
        'semesters_count' => '6',
        'dept_vision' => 'التميز في إعداد قادة الأعمال ورواد الاستثمار، وبناء الفكر الإداري والتسويقي الحديث.',
        'dept_mission' => 'تخريج قادة إداريين ورواد أعمال يمتلكون القدرة على التخطيط الاستراتيجي، وإدارة المشروعات، والابتكار الإداري، والتسويق الرقمي لتوجيه كبرى المؤسسات والشركات بنجاح.',
        'dept_goals' => [
            'تأهيل مدراء وموجهين إداريين يمتلكون مهارات القيادة لاتخاذ القرارات.',
            'تعزيز ثقافة ريادة الأعمال وتأسيس المشاريع الناشئة والصغيرة.',
            'تطوير مهارات التسويق، وإدارة الموارد البشرية، وسلاسل الإمداد.',
            'تدريب الطلاب على دراسات الجدوى الاقتصادية وحل المشكلات الإدارية.'
        ],
        'program_vision' => 'تخريج إداريين ورواد أعمال يمتلكون القدرة على صياغة وتنفيذ الاستراتيجيات وقيادة المنظمات بنجاح.',
        'program_mission' => 'إعداد كفاءات إدارية متميزة قادرة على قيادة المنظمات، وتطوير الاستراتيجيات التسويقية، وإدارة الموارد البشرية والمالية بنجاح واقتدار.',
        'program_goals' => [
            'إكساب الطلاب مهارات التخطيط والتنظيم والتوجيه والرقابة الإدارية.',
            'تدريب الطلاب على إعداد خطط الأعمال والتسويق الإلكتروني واستراتيجيات النمو.',
            'تأهيل الخريجين لقيادة فرق العمل وإدارة الأزمات والموارد البشرية.'
        ],
        'study_plan' => [
            ['year' => 'السنة الأولى', 'sem1' => ['مبادئ إدارة الأعمال', 'مبادئ التسويق', 'مبادئ الاقتصاد', 'سلوك تنظيمي'], 'sem2' => ['إدارة الموارد البشرية', 'إدارة العمليات', 'أساليب كمية في الإدارة', 'لغة إنجليزية إدارية'], 'hours' => '34'],
            ['year' => 'السنة الثانية', 'sem1' => ['إدارة تسويق رقمي', 'إدارة مالية', 'ريادة أعمال وتأسيس شركات', 'نظم معلومات إدارية'], 'sem2' => ['إدارة الاستراتيجية', 'إدارة المشاريع', 'التجارة الإلكترونية', 'إدارة سلاسل الإمداد'], 'hours' => '36'],
            ['year' => 'السنة الثالثة', 'sem1' => ['إدارة الأزمات والتغيير', 'دراسات جدوى اقتصادية', 'أخلاقيات وحوكمة الأعمال'], 'sem2' => ['مشروع خطة تخرج استثمارية', 'التدريب الإداري الميداني بالمؤسسات'], 'hours' => '32']
        ],
        'research_projects' => 'تشمل مشاريع تخرج إدارة الأعمال إعداد خطط أعمال متكاملة لمشاريع ناشئة، ودراسات الاستراتيجيات التسويقية في السوق المحلي، وإدارة التغيير في المؤسسات الخدمية.',
        'head_speech' => 'أهلاً بكم في قسم إدارة الأعمال. نحرص على تزويدكم بالمهارات القيادية والإدارية والتسويقية المعاصرة لتصبحوا رواد أعمال ناجحين وقادة متميزين في بيئة الأعمال.',
        'outcomes' => [
            'صياغة وتنفيذ الخطط الاستراتيجية والتشغيلية للمؤسسات والشركات.',
            'إدارة الموارد البشرية، والتسويق الرقمي، وخدمة العملاء بنجاح.',
            'إعداد دراسات الجدوى الاقتصادية وإدارة المشروعات الجديدة والمستدامة.'
        ],
        'gallery' => [
            'images/slider_campus.jpg?v=3',
            'images/slider_vision.jpg?v=3'
        ]
    ]
];

// Determine current major data
$current_major_key = isset($page) && isset($majors_database[$page]) ? $page : 'major_pharmacy';
$major_data = $majors_database[$current_major_key];
?>

<style>
/* Style rules for Majors Page matching Al-Hikma design guidelines */
.major-page-container {
    direction: rtl;
    font-family: 'Cairo', sans-serif;
    color: #333;
    max-width: 1100px;
    margin: 0 auto;
    background: #ffffff;
    border-radius: 16px;
    padding: 35px 30px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.06);
}
.print-logo-header {
    display: none;
}

.major-main-grid {
    display: flex;
    flex-wrap: wrap;
    gap: 30px;
    align-items: flex-start;
}

/* Right Column Sidebar */
.major-sidebar {
    flex: 0 0 260px;
    background: #ffffff;
    border-left: 2px solid #f1f5f9;
    padding-left: 20px;
    position: sticky;
    top: 20px;
}

.major-sidebar-nav {
    list-style: none;
    padding: 0;
    margin: 0;
}

.major-sidebar-nav li {
    margin-bottom: 18px;
    border-bottom: 1px dashed #e2e8f0;
    padding-bottom: 12px;
}

.major-sidebar-link {
    display: flex;
    align-items: center;
    gap: 10px;
    color: #334155;
    text-decoration: none;
    font-size: 15px;
    font-weight: 700;
    transition: all 0.3s ease;
    position: relative;
    padding-right: 14px;
}

.major-sidebar-link.active {
    color: #085859;
}

.major-sidebar-link.active::before {
    content: '';
    position: absolute;
    right: 0;
    top: 0;
    bottom: 0;
    width: 4px;
    background-color: #085859;
    border-radius: 2px;
}

.major-sidebar-link:hover {
    color: #085859;
    transform: translateX(-4px);
}

/* Left / Main Content Area */
.major-content-area {
    flex: 1 1 670px;
    line-height: 2;
}

.major-heading-title {
    font-size: 26px;
    font-weight: 800;
    color: #0d4748;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 8px;
}

.major-heading-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    right: 0;
    width: 60%;
    height: 3px;
    background-color: #085859;
    border-radius: 2px;
}

.major-section-label {
    color: #b91c1c;
    font-size: 18px;
    font-weight: 800;
    margin-top: 28px;
    margin-bottom: 12px;
}

.major-section-label::after {
    content: ' :';
}

.major-section-text {
    font-size: 15px;
    color: #333;
    line-height: 2;
    text-align: justify;
    margin-bottom: 20px;
}

.major-bullet-list {
    margin-bottom: 25px;
    padding-right: 20px;
    line-height: 2;
    font-size: 15px;
    color: #333;
    list-style-type: decimal;
}

.major-bullet-list li {
    margin-bottom: 10px;
}

.major-divider-line {
    border: none;
    border-top: 2px dashed #cbd5e1;
    margin: 35px 0;
}

/* Study Plan Table Styling */
.major-study-plan-box {
    margin: 25px 0 35px;
    background: #f8fafc;
    border-radius: 12px;
    padding: 20px;
    border: 1px solid #e2e8f0;
}

.major-plan-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px;
}

.major-plan-table th, .major-plan-table td {
    padding: 12px 15px;
    border: 1px solid #e2e8f0;
    text-align: right;
}

.major-plan-table th {
    background: #0d4748;
    color: #ffffff;
    font-weight: 700;
}

.major-plan-table tr:nth-child(even) {
    background: #ffffff;
}

.major-plan-table tr:nth-child(odd) {
    background: #f5fafb;
}

.major-head-speech-card {
    background: #f8fafc;
    border-right: 4px solid #0d4748;
    padding: 20px 22px;
    border-radius: 8px;
    margin: 25px 0;
    box-shadow: 0 2px 10px rgba(0,0,0,0.03);
}

.major-head-speech-card h4 {
    color: #0d4748;
    font-weight: 800;
    font-size: 17px;
    margin-bottom: 8px;
}

.major-head-speech-card p {
    color: #444;
    font-size: 15px;
    line-height: 1.9;
    margin: 0;
}

.major-outcomes-list {
    list-style: none;
    padding: 0;
    margin-bottom: 30px;
}

.major-outcomes-list li {
    padding: 10px 15px;
    background: #f5fafb;
    border-right: 3px solid #085859;
    margin-bottom: 10px;
    border-radius: 4px;
    font-size: 15px;
    color: #333;
    font-weight: 600;
}

/* Single Photo Gallery Slider Box */
.major-gallery-slide-box {
    position: relative;
    width: 100%;
    border-radius: 14px;
    overflow: hidden;
    margin: 25px 0 35px;
    box-shadow: 0 8px 25px rgba(0,0,0,0.06);
    background: transparent;
}

.major-gallery-slides-wrap {
    width: 100%;
    position: relative;
}

.major-gallery-slide {
    width: 100%;
    display: none;
    align-items: center;
    justify-content: center;
    position: relative;
}

.major-gallery-slide.active {
    display: flex;
    animation: fadeEffect 0.8s;
}

@keyframes fadeEffect {
    from { opacity: 0.4; }
    to { opacity: 1; }
}

.major-gallery-slide img {
    max-width: 100%;
    max-height: 520px;
    width: auto;
    height: auto;
    object-fit: contain !important;
    display: block;
    margin: auto;
}

.major-gallery-caption {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: linear-gradient(to top, rgba(0,0,0,0.85), transparent);
    color: #ffffff;
    padding: 20px 25px 55px;
    font-size: 15px;
    font-weight: 700;
    text-align: right;
}

.major-gallery-arrow {
    position: absolute;
    top: 45%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.3);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    z-index: 10;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.major-gallery-arrow:hover {
    background: #085859;
    border-color: #085859;
}

.major-gallery-arrow.prev { right: 15px; }
.major-gallery-arrow.next { left: 15px; }

.major-gallery-controls-bar {
    position: absolute;
    bottom: 12px;
    left: 15px;
    right: 15px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    z-index: 12;
    flex-wrap: wrap;
    gap: 10px;
}

.major-gallery-dots-wrap {
    display: flex;
    gap: 8px;
    align-items: center;
}

.major-gallery-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}

.major-gallery-dot.active {
    background: #ffd700;
    width: 26px;
    border-radius: 10px;
}

/* Actions and Share buttons */
.major-actions-bar {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: space-between;
    gap: 15px;
    margin-top: 35px;
    padding-top: 25px;
    border-top: 1px solid #eee;
}

.share-group {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}

.share-btn-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 14px;
    border-radius: 20px;
    border: 1px solid #d1d5db;
    background: #ffffff;
    color: #4b5563;
    text-decoration: none;
    font-size: 13px;
    font-weight: 600;
    transition: all 0.3s ease;
    cursor: pointer;
}

.share-btn-item svg {
    width: 18px;
    height: 18px;
}

.share-btn-item.fb:hover { background: #1877f2; color: white; border-color: #1877f2; }
.share-btn-item.fb:hover svg path { fill: white; }

.share-btn-item.tw:hover { background: #000000; color: white; border-color: #000000; }
.share-btn-item.tw:hover svg path { fill: white; }

.share-btn-item.wa:hover { background: #25d366; color: white; border-color: #25d366; }
.share-btn-item.wa:hover svg path { fill: white; }

.share-btn-item.insta:hover { background: #e1306c; color: white; border-color: #e1306c; }
.share-btn-item.insta:hover svg path { fill: white; }

.share-btn-item.tg:hover { background: #0088cc; color: white; border-color: #0088cc; }
.share-btn-item.tg:hover svg path { fill: white; }

.export-group {
    display: flex;
    align-items: center;
    gap: 10px;
}

.export-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 8px 16px;
    border-radius: 8px;
    border: 1px solid #085859;
    background: #ffffff;
    color: #085859;
    font-weight: 700;
    font-size: 14px;
    cursor: pointer;
    transition: all 0.3s ease;
}

.export-action-btn:hover {
    background: rgb(189, 214, 60) !important;
    color: var(--main-color) !important;
    border-color: rgb(189, 214, 60) !important;
    box-shadow: 0 4px 12px rgba(189, 214, 60, 0.3) !important;
}

/* Bottom Nav Buttons */
.major-bottom-nav {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 12px;
    margin-top: 45px;
    padding-top: 25px;
    border-top: 2px dashed #e5e7eb;
}

.nav-pill-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 20px;
    border-radius: 25px;
    background: #0d4748;
    color: #ffffff;
    text-decoration: none;
    font-size: 14px;
    font-weight: 700;
    box-shadow: 0 4px 12px rgba(13, 71, 72, 0.15);
    transition: all 0.3s ease;
}

.nav-pill-btn:hover {
    background: #085859;
    transform: translateY(-3px);
    box-shadow: 0 6px 18px rgba(8, 88, 89, 0.25);
    color: #ffffff;
}

.nav-pill-btn.home-pill {
    background: #085859;
}
.nav-pill-btn.home-pill:hover {
    background: #0d4748;
}

/* Toast Message */
#majorToast {
    visibility: hidden;
    min-width: 250px;
    background-color: #072928;
    color: #fff;
    text-align: center;
    border-radius: 8px;
    padding: 12px 20px;
    position: fixed;
    z-index: 9999;
    left: 50%;
    bottom: 30px;
    transform: translateX(-50%);
    font-size: 14px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.3);
    border: 1px solid #ffd700;
}

#majorToast.show {
    visibility: visible;
    animation: fadein 0.5s, fadeout 0.5s 2.5s;
}

@keyframes fadein {
    from { bottom: 0; opacity: 0; }
    to { bottom: 30px; opacity: 1; }
}

@keyframes fadeout {
    from { bottom: 30px; opacity: 1; }
    to { bottom: 0; opacity: 0; }
}

/* Responsive breakpoint */
@media (max-width: 850px) {
    .major-main-grid {
        flex-direction: column;
    }
    .major-sidebar {
        flex: 1 1 100%;
        width: 100%;
        border-left: none;
        border-bottom: 2px solid #e2e8f0;
        padding-left: 0;
        padding-bottom: 15px;
        position: relative;
        top: 0;
    }
}

/* Print specific styles */
@media print {
    /* Hide all layout elements completely */
    header, footer, nav, .major-bottom-nav, .major-actions-bar, .major-sidebar,
    .breadcrumb-container, .subpage-dropdown-banner, .major-section-label,
    .major-gallery-slide-box, .major-gallery-controls-bar, .major-gallery-arrow,
    .export-group, .btn-back-to-home, #majorToast,
    div[style*="background:#f4f6f9"][style*="padding: 15px 20px"],
    div[style*="background:#f4f6f9"][style*="padding: 20px 20px 0"] {
        display: none !important;
    }
    
    /* Reset visibility for everything else to let display:none work perfectly */
    body * {
        visibility: visible;
    }
    
    /* Ensure the body and html take full height and have zero padding */
    html, body {
        background: #ffffff !important;
        color: #000000 !important;
        margin: 0 !important;
        padding: 0 !important;
        height: auto !important;
        font-family: 'Cairo', 'Segoe UI', sans-serif !important;
        font-size: 11pt !important;
        line-height: 1.4 !important;
        width: 100% !important;
    }
    
    /* Clean up the container layout for print */
    .major-page-container {
        width: 100% !important;
        max-width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        border: none !important;
        background: #ffffff !important;
        display: block !important;
        position: relative !important;
        top: 0 !important;
        left: 0 !important;
    }
    
    .major-main-grid {
        display: block !important;
    }
    
    .major-content-col {
        width: 100% !important;
        padding: 0 !important;
    }
    
    /* Center college logo & name at the top for official print layout */
    .print-logo-header {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        margin-bottom: 20px !important;
        padding-bottom: 12px !important;
        border-bottom: 3px double #0d4748 !important;
    }
    
    .print-logo-header img {
        width: 85px !important;
        height: 85px !important;
        margin-bottom: 6px !important;
        object-fit: contain !important;
    }
    
    .print-logo-header h1 {
        font-size: 14pt !important;
        font-weight: 800 !important;
        color: #0d4748 !important;
        margin: 0 0 4px 0 !important;
    }
    
    .print-logo-header p {
        font-size: 10.5pt !important;
        color: #444444 !important;
        margin: 0 !important;
        font-weight: 700 !important;
    }
    
    /* Title print styling */
    .major-main-title {
        font-size: 14pt !important;
        text-align: center !important;
        color: #0d4748 !important;
        font-weight: 800 !important;
        margin-bottom: 12px !important;
    }
    
    /* Section texts */
    .major-intro-speech {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        text-align: justify !important;
        margin-bottom: 10px !important;
    }
    
    .major-head-speech-card {
        font-size: 9.5pt !important;
        line-height: 1.45 !important;
        margin-bottom: 12px !important;
        padding: 8px 12px !important;
        background: #f0f7f7 !important;
        border-right: 4px solid #0d4748 !important;
    }
    
    .major-head-speech-card h4 {
        margin: 0 0 4px 0 !important;
        font-size: 10.5pt !important;
        color: #0d4748 !important;
        font-weight: bold !important;
    }
    
    .major-outcomes-list {
        font-size: 9pt !important;
        line-height: 1.35 !important;
        margin-bottom: 12px !important;
        padding-right: 15px !important;
    }
    
    /* A4 Page printing size optimization */
    @page {
        size: A4 portrait;
        margin: 0.5cm 0.6cm 0.5cm 0.6cm !important;
    }
}
</style>

<div style="background:#f4f6f9; padding: 40px 15px;">
    <div class="major-page-container" id="printableMajorArea">
        
        <!-- Print Letterhead Logo Header (Only visible when printing) -->
        <div class="print-logo-header">
            <img src="logo.png?v=4" alt="شعار الكلية">
            <h1>كلية سماء المتميزين للعلوم الصحية والتكنولوجيا</h1>
            <p>الدليل التعريفي لتخصص: <?php echo $major_data['title']; ?></p>
        </div>
        
        <div class="major-main-grid">
            
            <!-- Right Column Sidebar (جهة اليمين كالصورة تماماً) -->
            <div class="major-sidebar">
                <ul class="major-sidebar-nav">
                    <li>
                        <a href="#sec-main" class="major-sidebar-link active">
                            الرئيسية
                        </a>
                    </li>
                    <li>
                        <a href="#sec-plan" class="major-sidebar-link">
                            الخطة الدراسية
                        </a>
                    </li>
                    <li>
                        <a href="#sec-speech" class="major-sidebar-link">
                            كلمة رئيس القسم
                        </a>
                    </li>
                    <li>
                        <a href="#sec-outcomes" class="major-sidebar-link">
                            مخرجات التعلم من البرنامج ومواصفات المتخرج
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Left / Main Content Area (جهة اليسار) -->
            <div class="major-content-area" id="sec-main">
                
                <h1 class="major-heading-title"><i class="fa-solid fa-graduation-cap" style="margin-left: 10px;"></i> <?php echo $major_data['title']; ?> (<?php echo $major_data['dept_name']; ?>)</h1>

                <!-- Vision, Mission & Goals -->
                <div class="major-section-label">الرؤية</div>
                <div class="major-section-text">
                    <?php echo $major_data['program_vision']; ?>
                </div>

                <div class="major-section-label">الرسالة</div>
                <div class="major-section-text">
                    <?php echo $major_data['program_mission']; ?>
                </div>

                <div class="major-section-label">الأهداف</div>
                <ol class="major-bullet-list">
                    <?php foreach ($major_data['program_goals'] as $pgoal): ?>
                        <li><?php echo $pgoal; ?></li>
                    <?php endforeach; ?>
                </ol>

                <!-- Program Research and Projects (أبحاث ومشاريع التخصص) -->
                <div class="major-section-label">أبحاث ومشاريع برنامج <?php echo $major_data['title']; ?></div>
                <div class="major-section-text">
                    <?php echo $major_data['research_projects']; ?>
                </div>

                <!-- Study Plan Section (الخطة الدراسية - مستويات وفصول) -->
                <div id="sec-plan" style="scroll-margin-top: 30px;">
                    <div class="major-section-label">الخطة الدراسية لبرنامج <?php echo $major_data['title']; ?></div>
                    <p style="font-size: 15px; color: #444; margin-bottom: 20px;">
                        تتكون الخطة الدراسية لـ <?php echo $major_data['title']; ?> من <?php echo $major_data['duration_years']; ?> سنوات دراسية مقسمة على <?php echo $major_data['semesters_count']; ?> فصول دراسية، وفيما يلي تفصيل المواد التي يدرسها الطالب في كل ترم دراسي:
                    </p>

                    <?php foreach ($major_data['study_plan'] as $year_plan): ?>
                    <div class="major-level-card" style="background:#ffffff; border-radius:12px; border:1px solid #e2e8f0; margin-bottom:25px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.04);">
                        <div class="major-level-header" style="background:#0d4748; color:#ffffff; padding:12px 20px; font-size:16px; font-weight:700; display:flex; justify-content:space-between; align-items:center;">
                            <span><i class="fa-solid fa-graduation-cap" style="margin-left: 5px;"></i> <?php echo $year_plan['year']; ?></span>
                            <span style="font-size:13px; background:rgba(255,255,255,0.15); padding:3px 10px; border-radius:15px;">إجمالي الساعات: <?php echo $year_plan['hours']; ?> ساعة</span>
                        </div>
                        
                        <div class="major-semesters-grid" style="display:flex; flex-wrap:wrap; gap:20px; padding:20px;">
                            <!-- الترم الأول -->
                            <div class="major-semester-box" style="flex:1 1 270px; background:#f8fafc; border-radius:8px; padding:16px 18px; border:1px solid #cbd5e1;">
                                <div class="semester-title" style="color:#085859; font-size:15px; font-weight:800; margin-bottom:12px; padding-bottom:6px; border-bottom:2px solid #e2e8f0;">
                                    📚 المواد الدراسية - الترم الأول
                                </div>
                                <ul class="semester-courses-list" style="list-style:none; padding:0; margin:0;">
                                    <?php foreach ($year_plan['sem1'] as $course): ?>
                                        <li style="padding:8px 0; font-size:14px; color:#333; border-bottom:1px dashed #e2e8f0; display:flex; align-items:center; gap:8px;">
                                            <span style="color:#2563eb; font-weight:bold;">✓</span> <?php echo $course; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>

                            <!-- الترم الثاني -->
                            <div class="major-semester-box" style="flex:1 1 270px; background:#f5fafb; border-radius:8px; padding:16px 18px; border:1px solid #cce2e2;">
                                <div class="semester-title" style="color:#0d4748; font-size:15px; font-weight:800; margin-bottom:12px; padding-bottom:6px; border-bottom:2px solid #e2e8f0;">
                                    📘 المواد الدراسية - الترم الثاني
                                </div>
                                <ul class="semester-courses-list" style="list-style:none; padding:0; margin:0;">
                                    <?php foreach ($year_plan['sem2'] as $course): ?>
                                        <li style="padding:8px 0; font-size:14px; color:#333; border-bottom:1px dashed #e2e8f0; display:flex; align-items:center; gap:8px;">
                                            <span style="color:#085859; font-weight:bold;">✓</span> <?php echo $course; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>

                <!-- Head of Department Speech (كلمة رئيس القسم) -->
                <div id="sec-speech" style="scroll-margin-top: 30px;">
                    <div class="major-section-label">كلمة رئيس القسم</div>
                    <div class="major-head-speech-card">
                        <h4>رئيس <?php echo $major_data['dept_name']; ?> : <?php echo $major_data['head_title']; ?></h4>
                        <p><?php echo $major_data['head_speech']; ?></p>
                    </div>
                </div>

                <!-- Program Learning Outcomes & Graduate Specs (مخرجات التعلم من البرنامج ومواصفات المتخرج) -->
                <div id="sec-outcomes" style="scroll-margin-top: 30px;">
                    <div class="major-section-label">مخرجات التعلم من البرنامج ومواصفات المتخرج</div>
                    <ul class="major-outcomes-list">
                        <?php foreach ($major_data['outcomes'] as $out): ?>
                            <li>✓ <?php echo $out; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

        

                <!-- Export Buttons (طباعة وحفظ كـ PDF) -->
                <div class="export-group" style="margin-bottom: 25px;">
                    <button onclick="window.print()" class="export-action-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><polyline points="6 9 6 2 18 2 18 9"></polyline><path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path><rect x="6" y="14" width="12" height="8"></rect></svg> طباعة الصفحة
                    </button>
                    <button onclick="exportMajorPDF()" class="export-action-btn" style="background:#085859; color:white;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> حفظ كـ PDF
                    </button>
                </div>

                <!-- Single Photo Gallery Slider Box (صورة واحدة متغيرة مع السهام والتنزيل) -->
                <div class="major-section-label">🖼️ معرض صور ومعامل التخصص</div>
                <div class="major-gallery-slide-box">
                    <div class="major-gallery-slides-wrap" id="majorGallerySlidesWrap">
                        <?php foreach ($major_data['gallery'] as $index => $img): ?>
                            <div class="major-gallery-slide <?php echo $index === 0 ? 'active' : ''; ?>">
                                <img src="<?php echo $img; ?>" alt="صورة معرض <?php echo $major_data['title']; ?>">
                                <div class="major-gallery-caption">
                                    🖼️ صورة من معامل وتطبيقات <?php echo $major_data['title']; ?> (<?php echo ($index + 1); ?> من <?php echo count($major_data['gallery']); ?>)
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <!-- Navigation Arrows -->
                    <button class="major-gallery-arrow prev" onclick="moveMajorGallerySlide(-1)">❮</button>
                    <button class="major-gallery-arrow next" onclick="moveMajorGallerySlide(1)">❯</button>

                    <!-- Controls Bar: Dots & Downloads -->
                    <div class="major-gallery-controls-bar">
                        <div class="major-gallery-dots-wrap" id="majorGalleryDotsWrap">
                            <?php foreach ($major_data['gallery'] as $index => $img): ?>
                                <span class="major-gallery-dot <?php echo $index === 0 ? 'active' : ''; ?>" onclick="setMajorGallerySlide(<?php echo $index; ?>)"></span>
                            <?php endforeach; ?>
                        </div>
                        
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <button onclick="downloadCurrentMajorPhoto()" class="export-action-btn" title="تنزيل الصورة الظاهرة حالياً">
                                📥 تنزيل الصورة المعروضة
                            </button>
                            <button onclick="downloadAllMajorPhotos()" class="export-action-btn" style="background:#085859; color:white;" title="تنزيل جميع صور المعرض">
                                📦 تنزيل جميع الصور
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actions and Share Bar -->
                <div class="major-actions-bar">
                    <div class="share-group">
                        <span style="font-weight: 700; color: #0d4748; font-size: 14px; margin-left: 5px;">مشاركة الصفحة:</span>
                        
                        <!-- Facebook -->
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item fb" title="فيسبوك">
                            <svg viewBox="0 0 24 24"><path fill="#1877F2" d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                            فيسبوك
                        </a>

                        <!-- Twitter / X -->
                        <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($major_data['title'] . ' - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tw" title="تويتر">
                            <svg viewBox="0 0 24 24"><path fill="#000000" d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                            تويتر
                        </a>

                        <!-- WhatsApp -->
                        <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($major_data['title'] . ' - كلية سماء المتميزين: ' . 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" target="_blank" class="share-btn-item wa" title="واتساب">
                            <svg viewBox="0 0 32 32"><path fill="#25D366" d="M16 2A13 13 0 0 0 4.68 21.25L3 27.5l6.43-1.64A13 13 0 1 0 16 2zm0 24a10.9 10.9 0 0 1-5.56-1.52l-.4-.24-4.13 1.05 1.1-4-.26-.42A10.95 10.95 0 1 1 16 26zm6-8.17c-.33-.17-1.95-.96-2.25-1.07s-.53-.17-.75.17-.87 1.07-1.07 1.3-.4.25-.73.08a9.23 9.23 0 0 1-2.71-1.67 10.2 10.2 0 0 1-1.88-2.34c-.2-.33 0-.5.15-.67.15-.15.33-.38.5-.58s.22-.33.33-.55a.69.69 0 0 0 0-.67c-.08-.17-.75-1.81-1.03-2.48s-.55-.57-.75-.58h-.64a1.23 1.23 0 0 0-.9.42 3.79 3.79 0 0 0-1.18 2.81 6.58 6.58 0 0 0 1.37 3.5 15.08 15.08 0 0 0 5.78 5.12 19.53 19.53 0 0 0 1.93.71 4.64 4.64 0 0 0 2.13.13 3.48 3.48 0 0 0 2.28-1.61 2.82 2.82 0 0 0 .2-1.61c-.09-.12-.42-.29-.75-.46z"/></svg>
                            واتساب
                        </a>

                        <!-- Instagram -->
                        <button onclick="copyMajorLink()" class="share-btn-item insta" title="انستجرام">
                            <svg viewBox="0 0 24 24"><path fill="#E1306C" d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                            انستجرام
                        </button>

                        <!-- Telegram -->
                        <a href="https://t.me/share/url?url=<?php echo urlencode('http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>&text=<?php echo urlencode($major_data['title'] . ' - كلية سماء المتميزين'); ?>" target="_blank" class="share-btn-item tg" title="تليجرام">
                            <svg viewBox="0 0 24 24"><path fill="#0088CC" d="M12 0C5.37 0 0 5.37 0 12s5.37 12 12 12 12-5.37 12-12S18.63 0 12 0zm5.56 8.24l-1.97 9.28c-.15.68-.55.84-1.12.52l-3.03-2.23-1.46 1.41c-.16.16-.3.3-.61.3l.22-3.08 5.61-5.07c.24-.22-.05-.34-.37-.13l-6.93 4.36-2.99-.93c-.65-.2-.66-.65.14-.96l11.68-4.5c.54-.2 1.02.13.84.93z"/></svg>
                            تليجرام
                        </a>
                    </div>


                </div>

                <!-- Bottom Navigation Pill Buttons -->
                <div class="major-bottom-nav">
                    <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
                    <a href="?p=about" class="nav-pill-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="16" x2="12" y2="12"></line><line x1="12" y1="8" x2="12.01" y2="8"></line></svg> نبذة عن الكلية
                    </a>
                    <a href="?p=students" class="nav-pill-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-left: 6px; display: inline-block; vertical-align: middle;"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg> القبول والتسجيل
                    </a>
                    <a href="?p=research" class="nav-pill-btn">
                        🔬 أبحاث التخرج
                    </a>
                </div>

            </div>

        </div>

    </div>
</div>

<!-- Toast notification element -->
<div id="majorToast">تم نسخ رابط التخصص بنجاح! يمكنك مشاركته عبر انستجرام.</div>

<script>
var currentMajorGalleryIndex = 0;
var majorGalleryImagesList = <?php echo json_encode($major_data['gallery']); ?>;
var majorGalleryTimer = null;

function showMajorGallerySlide(index) {
    var slides = document.querySelectorAll('.major-gallery-slide');
    var dots = document.querySelectorAll('.major-gallery-dot');
    if (slides.length === 0) return;
    
    if (index >= slides.length) currentMajorGalleryIndex = 0;
    else if (index < 0) currentMajorGalleryIndex = slides.length - 1;
    else currentMajorGalleryIndex = index;
    
    slides.forEach(function(s){ s.classList.remove('active'); });
    dots.forEach(function(d){ d.classList.remove('active'); });
    
    slides[currentMajorGalleryIndex].classList.add('active');
    if (dots[currentMajorGalleryIndex]) dots[currentMajorGalleryIndex].classList.add('active');
}

function moveMajorGallerySlide(step) {
    showMajorGallerySlide(currentMajorGalleryIndex + step);
    resetMajorGalleryTimer();
}

function setMajorGallerySlide(index) {
    showMajorGallerySlide(index);
    resetMajorGalleryTimer();
}

function startMajorGalleryTimer() {
    majorGalleryTimer = setInterval(function() {
        showMajorGallerySlide(currentMajorGalleryIndex + 1);
    }, 6000);
}

function resetMajorGalleryTimer() {
    clearInterval(majorGalleryTimer);
    startMajorGalleryTimer();
}

function downloadCurrentMajorPhoto() {
    if (!majorGalleryImagesList || majorGalleryImagesList.length === 0) return;
    var currentImg = majorGalleryImagesList[currentMajorGalleryIndex];
    var a = document.createElement('a');
    a.href = currentImg;
    a.download = 'صورة_تخصص_<?php echo str_replace(' ', '_', $major_data['title']); ?>_' + (currentMajorGalleryIndex + 1) + '.jpg';
    document.body.appendChild(a);
    a.click();
    document.body.removeChild(a);
}

function downloadAllMajorPhotos() {
    if (!majorGalleryImagesList || majorGalleryImagesList.length === 0) return;
    majorGalleryImagesList.forEach(function(imgUrl, idx) {
        setTimeout(function() {
            var a = document.createElement('a');
            a.href = imgUrl;
            a.download = 'صورة_تخصص_<?php echo str_replace(' ', '_', $major_data['title']); ?>_' + (idx + 1) + '.jpg';
            document.body.appendChild(a);
            a.click();
            document.body.removeChild(a);
        }, idx * 400);
    });
}

document.addEventListener('DOMContentLoaded', function() {
    startMajorGalleryTimer();
});

function copyMajorLink() {
    var dummy = document.createElement('input');
    document.body.appendChild(dummy);
    dummy.value = window.location.href;
    dummy.select();
    document.execCommand('copy');
    document.body.removeChild(dummy);
    
    var toast = document.getElementById("majorToast");
    toast.className = "show";
    setTimeout(function(){ toast.className = toast.className.replace("show", ""); }, 3000);
}

function exportMajorPDF() {
    var oldTitle = document.title;
    document.title = "<?php echo str_replace(' ', '_', $major_data['title']); ?>_كلية_سماء_المتميزين_2026";
    window.print();
    document.title = oldTitle;
}
</script>
