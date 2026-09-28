<?php
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}

// قاعدة بيانات كتب ومراجع ومجلات المكتبة
$books = [
    '1' => [
        'title' => 'أبعاد رقمية - الاصدار الرابع',
        'author' => 'جامعة الحكمة - الحوبان',
        'language' => 'العربية',
        'subject' => 'المجلات الجامعية',
        'book_subject' => 'مجلات جامعية',
        'image' => 'images/book_dimensions.jpg',
        'link' => '#'
    ],
    '2' => [
        'title' => 'نموذج التقييم المقترح لتحديد أفضل تقنية لاستخراج الارتباطات المتعلقة بإعادة هندسة العمليات التجارية',
        'author' => 'Akram Ali Othman Nasr, Ibrahim Ahmed AL-Baltah',
        'language' => 'الانجليزية',
        'subject' => 'المجلات العلمية - جامعة الحكمة',
        'book_subject' => 'مجلات علمية',
        'image' => 'images/book_evaluation.jpg',
        'link' => '#'
    ],
    '3' => [
        'title' => 'نظم إدارة وقواعد البيانات وتصميمها وتطويرها',
        'author' => 'أ.د. عادل عبد الله السالم',
        'language' => 'العربية',
        'subject' => 'تكنولوجيا المعلومات - الترم الأول',
        'book_subject' => 'قواعد البيانات',
        'image' => 'https://images.unsplash.com/photo-1544716278-ca5e3f4abd8c?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ],
    '4' => [
        'title' => 'مبادئ المحاسبة المالية - الجزء الأول للأقسام الإدارية والمالية',
        'author' => 'د. محمد سمير الكاتب',
        'language' => 'العربية',
        'subject' => 'المحاسبة - الترم الأول',
        'book_subject' => 'مبادئ المحاسبة',
        'image' => 'https://images.unsplash.com/photo-1554415707-6e8cfc93fe23?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ],
    '5' => [
        'title' => 'أساسيات البرمجة الكائنية بلغة C++ للمبتدئين',
        'author' => 'المهندس أحمد الشيباني',
        'language' => 'العربية',
        'subject' => 'تكنولوجيا المعلومات - الترم الأول',
        'book_subject' => 'أساسيات البرمجة',
        'image' => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ],
    '6' => [
        'title' => 'المدخل الحديث إلى علم الإدارة والقيادة الإدارية',
        'author' => 'د. عبد الفتاح منصور',
        'language' => 'العربية',
        'subject' => 'المحاسبة - الترم الأول',
        'book_subject' => 'مبادئ الإدارة',
        'image' => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ],
    '7' => [
        'title' => 'الكيمياء العامة العملية لطلبة الصيدلة والعلوم الصحية',
        'author' => 'د. هالة شرف الدين',
        'language' => 'العربية',
        'subject' => 'الصيدلة - الترم الأول',
        'book_subject' => 'كيمياء عامة',
        'image' => 'https://images.unsplash.com/photo-1532187643603-ba119ca4109e?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ],
    '8' => [
        'title' => 'تشريح الأسنان وتشكيلها لطلبة طب وجراحة الفم والأسنان',
        'author' => 'د. جمال نبيل الحيمي',
        'language' => 'العربية',
        'subject' => 'طب الأسنان - الترم الأول',
        'book_subject' => 'تشريح الأسنان',
        'image' => 'https://images.unsplash.com/photo-1588776814546-1ffcf47267a5?auto=format&fit=crop&w=400&q=80',
        'link' => '#'
    ]
];
?>

<style>
/* ستايل المخطط ثنائي الأعمدة */
.library-grid {
    display: grid;
    grid-template-columns: 1fr 2.2fr; /* الفلترة على اليمين 1fr والكتب على اليسار 2.2fr */
    gap: 30px;
    margin-top: 40px;
}
@media (max-width: 768px) {
    .library-grid {
        grid-template-columns: 1fr;
        gap: 30px;
    }
}

/* ستايل قائمة التصفية الجانبية والأكورديون */
.sidebar-filter-link {
    display: flex;
    align-items: center;
    padding: 12px 20px;
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
}

.accordion-item {
    border-top: 1px solid #f0f0f0;
}
.accordion-trigger {
    width: 100%;
    background: transparent;
    border: none;
    padding: 12px 20px;
    text-align: right;
    display: flex;
    justify-content: space-between;
    align-items: center;
    color: #444;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    font-family: 'Cairo', sans-serif;
    transition: 0.3s;
}
.accordion-trigger:hover {
    background: #f0f7f7;
    color: #085859;
}
.accordion-content {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease-out;
    background: #fafafa;
    display: flex;
    flex-direction: column;
}
.accordion-content.open {
    max-height: 500px;
}
.chevron {
    font-size: 10px;
    transition: transform 0.3s;
}
.accordion-trigger.active .chevron {
    transform: rotate(180deg);
}

.semester-header {
    background: #eaeaea;
    padding: 5px 25px;
    font-size: 12px;
    font-weight: bold;
    color: #555;
    border-right: 3px solid #0d4748;
}
.sidebar-sub-link {
    padding: 8px 35px;
    text-decoration: none;
    color: #666;
    font-size: 13px;
    border-right: 3px solid transparent;
    transition: 0.2s;
    display: block;
}
.sidebar-sub-link:hover {
    background: #ffd70015;
    color: #0d4748;
    border-right-color: #0d4748;
}
.sidebar-sub-link.active-sub-filter {
    background: #ffd70020;
    color: #0d4748 !important;
    font-weight: bold;
    border-right-color: #0d4748;
}

/* ستايل كروت الكتب المرفوعة */
.books-container-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
    gap: 20px;
}
@media (max-width: 480px) {
    .books-container-grid {
        grid-template-columns: 1fr;
    }
}
.library-book-card {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    background: white;
    border-radius: 15px;
    padding: 20px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    border: 1px solid #eaeaea;
    transition: all 0.3s ease;
}
.library-book-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 25px rgba(0,0,0,0.1);
    border-color: #08585930;
}
</style>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;font-family:'Cairo', sans-serif;">
    
    <!-- العنوان الرئيسي للمكتبة -->
    <div style="max-width:1100px;margin:0 auto 20px;">
        <h1 style="color:#0d4748;border-bottom:3px solid #085859;padding-bottom:15px;font-size:26px;font-weight:bold;margin:0 0 10px 0;display:inline-block;">
            📚 المكتبة الإلكترونية
        </h1>
        <p style="color:#666;margin:0;font-size:14px;">مصادر ومراجع المناهج ومشاريع التخرج والمجلات العلمية بالكلية</p>
    </div>

    <!-- بنر البحث الرئيسي بخلفية داكنة وجذابة -->
    <div style="max-width:1100px;margin:0 auto;background: url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat; padding: 60px 20px; text-align: center; border-radius: 20px; position: relative; overflow:hidden; box-shadow:0 10px 30px rgba(0,0,0,0.15);">
        <!-- غطاء حماية داكن يعطي تباين للبحث -->
        <div style="position: absolute; top:0; left:0; width:100%; height:100%; background: rgba(0,0,0,0.75); z-index: 1;"></div>
        
        <!-- حقل البحث المتواجد بالمنتصف -->
        <div style="position: relative; z-index: 2; max-width: 600px; margin: 0 auto;">
            <input type="text" id="library-search-input" onkeyup="searchBooks()" placeholder="ابحث هنا..." style="width: 100%; padding: 16px 25px; background: transparent; border: 2px solid white; color: white; font-size: 18px; font-family: 'Cairo', sans-serif; text-align: center; border-radius: 4px; outline: none; box-shadow: 0 4px 15px rgba(0,0,0,0.3); transition:0.3s;" onfocus="this.style.borderColor='#ffd700'" onblur="this.style.borderColor='white'">
        </div>
    </div>
    
    <!-- الجزء الرئيسي: التصنيفات والكتب المفلترة -->
    <div style="max-width:1100px;margin:0 auto;" class="library-grid">
        
        <!-- الجانب الأيمن في RTL: قائمة التصنيفات والمواد الدراسية (أولاً في HTML ليعرض يميناً) -->
        <div style="background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06); padding:20px 0; border:1px solid #eaeaea; height:fit-content; overflow:hidden;">
            
            <a href="#" onclick="filterLibrary(event, 'all', '')" class="sidebar-filter-link active-filter" style="font-weight:bold; font-size:15px;">
                جميع المراجع والكتب
            </a>
            
            <div style="padding:15px 20px 5px; font-weight:bold; color:#0d4748; font-size:16px; border-top:1px solid #f0f0f0; margin-top:10px;">
                المواد والتخصصات الدراسية
            </div>
            
            <!-- تخصص 1: المحاسبة -->
            <div class="accordion-item">
                <button onclick="toggleAccordion('acc-accordion')" class="accordion-trigger">
                    <span>📊 قسم المحاسبة</span>
                    <span class="chevron">▼</span>
                </button>
                <div id="acc-accordion" class="accordion-content">
                    <div class="semester-header">الترم الأول</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'مبادئ المحاسبة')" class="sidebar-sub-link">مبادئ المحاسبة</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'مبادئ الإدارة')" class="sidebar-sub-link">مبادئ الإدارة</a>
                    <div class="semester-header">الترم الثاني</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'المحاسبة المالية')" class="sidebar-sub-link">المحاسبة المالية</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'اقتصاد كلي')" class="sidebar-sub-link">اقتصاد كلي</a>
                </div>
            </div>

            <!-- تخصص 2: تكنولوجيا المعلومات -->
            <div class="accordion-item">
                <button onclick="toggleAccordion('it-accordion')" class="accordion-trigger">
                    <span>💻 قسم تكنولوجيا المعلومات</span>
                    <span class="chevron">▼</span>
                </button>
                <div id="it-accordion" class="accordion-content">
                    <div class="semester-header">الترم الأول</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'أساسيات البرمجة')" class="sidebar-sub-link">أساسيات البرمجة</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'قواعد البيانات')" class="sidebar-sub-link">قواعد البيانات</a>
                    <div class="semester-header">الترم الثاني</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'هياكل البيانات')" class="sidebar-sub-link">هياكل البيانات</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'شبكات الحاسوب')" class="sidebar-sub-link">شبكات الحاسوب</a>
                </div>
            </div>

            <!-- تخصص 3: قسم الصيدلة -->
            <div class="accordion-item">
                <button onclick="toggleAccordion('pharma-accordion')" class="accordion-trigger">
                    <span>🔬 قسم الصيدلة</span>
                    <span class="chevron">▼</span>
                </button>
                <div id="pharma-accordion" class="accordion-content">
                    <div class="semester-header">الترم الأول</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'كيمياء عامة')" class="sidebar-sub-link">كيمياء عامة</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'علم النبات الطبي')" class="sidebar-sub-link">علم النبات الطبي</a>
                    <div class="semester-header">الترم الثاني</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'كيمياء عضوية')" class="sidebar-sub-link">كيمياء عضوية</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'فيزيولوجيا')" class="sidebar-sub-link">فيزيولوجيا</a>
                </div>
            </div>

            <!-- تخصص 4: طب الأسنان -->
            <div class="accordion-item">
                <button onclick="toggleAccordion('dentist-accordion')" class="accordion-trigger">
                    <span>🦷 قسم طب وجراحة الفم والأسنان</span>
                    <span class="chevron">▼</span>
                </button>
                <div id="dentist-accordion" class="accordion-content">
                    <div class="semester-header">الترم الأول</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'تشريح الأسنان')" class="sidebar-sub-link">تشريح الأسنان</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'أنسجة الفم')" class="sidebar-sub-link">أنسجة الفم</a>
                    <div class="semester-header">الترم الثاني</div>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'مواد طب الأسنان')" class="sidebar-sub-link">مواد طب الأسنان</a>
                    <a href="#" onclick="filterLibrary(event, 'subject', 'تشريح عام')" class="sidebar-sub-link">تشريح عام</a>
                </div>
            </div>
            
            <div style="padding:15px 20px 5px; font-weight:bold; color:#0d4748; font-size:16px; border-top:1px solid #f0f0f0; margin-top:10px;">
                الأقسام الجامعية العامة
            </div>
            <a href="#" onclick="filterLibrary(event, 'subject', 'مجلات جامعية')" class="sidebar-sub-link">
                المجلات الجامعية
            </a>
            <a href="#" onclick="filterLibrary(event, 'subject', 'مجلات علمية')" class="sidebar-sub-link">
                المجلات العلمية
            </a>
            
        </div>

        <!-- الجانب الأيسر في RTL: قائمة الكتب وعرض النتائج المفلترة -->
        <div style="background:white; border-radius:20px; box-shadow:0 10px 30px rgba(0,0,0,0.06); padding:30px 40px;" id="books-content-area">
            <h2 style="color:#0d4748; font-size:20px; font-weight:bold; margin-bottom:25px; border-bottom:2px solid #f0f0f0; padding-bottom:10px;" id="catalog-title">
                كتالوج الكتب والمراجع
            </h2>
            
            <!-- رسالة عدم وجود نتائج للبحث -->
            <div id="no-results-msg" style="display:none; text-align:center; padding:40px 20px; color:#777; font-size:16px;">
                🔍 لم يتم العثور على أي كتب أو مراجع مطابقة لفلترك الحالي.
            </div>

            <div class="books-container-grid" id="books-list-wrapper">
                
                <?php foreach ($books as $id => $item): ?>
                    <div class="library-book-card" data-title="<?php echo $item['title']; ?>" data-author="<?php echo $item['author']; ?>" data-subject="<?php echo $item['subject']; ?>" data-book-subject="<?php echo $item['book_subject']; ?>">
                        
                        <!-- غلاف الكتاب بجهة اليمين (في RTL: يظهر على اليمين) -->
                        <div style="width:105px; height:145px; border-radius:8px; overflow:hidden; flex-shrink:0; box-shadow:0 4px 10px rgba(0,0,0,0.15); background:#f0f2f5;">
                            <img src="<?php echo $item['image']; ?>" alt="غلاف الكتاب" style="width:100%; height:100%; object-fit:cover;">
                        </div>

                        <!-- معلومات الكتاب بجهة اليسار (في RTL: يظهر على اليسار) -->
                        <div style="flex-grow:1; text-align:right; display:flex; flex-direction:column; justify-content:space-between; min-height:145px;">
                            <div>
                                <h3 style="color:#085859; font-size:15px; font-weight:bold; line-height:1.6; margin:0 0 10px 0; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">
                                    <?php echo $item['title']; ?>
                                </h3>
                                <p style="color:#666; font-size:12px; margin:0 0 5px 0;">
                                    <strong>الكاتب:</strong> <?php echo $item['author']; ?>
                                </p>
                                <p style="color:#666; font-size:12px; margin:0 0 5px 0;">
                                    <strong>اللغة:</strong> <?php echo $item['language']; ?>
                                </p>
                                <p style="color:#666; font-size:12px; margin:0;">
                                    <strong>القسم:</strong> <?php echo $item['book_subject']; ?>
                                </p>
                            </div>
                            <div style="margin-top:10px;">
                                <a href="<?php echo $item['link']; ?>" class="download-link" style="display:inline-flex; align-items:center; gap:5px; color:#085859; font-weight:bold; font-size:13px; text-decoration:none; transition:0.2s;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="transform:translateY(1px);"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                    تحميل المرجع
                                </a>
                            </div>
                        </div>
                        
                    </div>
                <?php endforeach; ?>
                
            </div>
        </div>
        
    </div>

    <!-- زر العودة الأنيق المتطابق أسفل قائمة الكتب الرئيسية -->
    <div style="max-width:1100px;margin:40px auto 0;text-align:center;">
        <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
    </div>
    
</div>

<!-- كود الأكورديون والتصفية والبحث البرمجي للمكتبة -->
<script>
var currentSubject = "all";
var currentSearchText = "";

// دالة التحكم في طي وتوسيع التخصصات والمواد (الأكورديون)
function toggleAccordion(id) {
    var content = document.getElementById(id);
    var trigger = content.previousElementSibling;
    
    if (content.classList.contains("open")) {
        content.classList.remove("open");
        trigger.classList.remove("active");
    } else {
        // إغلاق أي أكورديون مفتوح آخر أولاً لمنع التداخل
        var allContents = document.querySelectorAll(".accordion-content");
        allContents.forEach(function(c) {
            c.classList.remove("open");
            c.previousElementSibling.classList.remove("active");
        });
        
        content.classList.add("open");
        trigger.classList.add("active");
    }
}

// دالة تصفية وعرض الكتب والمجلات
function filterLibrary(event, type, value) {
    if (event) event.preventDefault();
    
    // إزالة التنشيط عن الأزرار والروابط السابقة
    var allSubLinks = document.querySelectorAll(".sidebar-sub-link");
    allSubLinks.forEach(function(link) {
        link.classList.remove("active-sub-filter");
    });
    document.querySelector(".sidebar-filter-link").classList.remove("active-filter");
    
    if (type === "all") {
        currentSubject = "all";
        document.querySelector(".sidebar-filter-link").classList.add("active-filter");
        document.getElementById("catalog-title").innerText = "كتالوج الكتب والمراجع";
    } else if (type === "subject") {
        currentSubject = value;
        if (event) {
            event.currentTarget.classList.add("active-sub-filter");
        }
        document.getElementById("catalog-title").innerText = "مراجع مادة: " + value;
    }
    
    applyFilters();
}

// دالة البحث النصي الحي
function searchBooks() {
    var searchInput = document.getElementById("library-search-input");
    currentSearchText = searchInput.value.toLowerCase().trim();
    applyFilters();
}

// دالة تطبيق الفلترة المزدوجة (تصفية القسم + كلمة البحث)
function applyFilters() {
    var cards = document.querySelectorAll(".library-book-card");
    var foundCount = 0;
    
    cards.forEach(function(card) {
        var title = card.getAttribute("data-title").toLowerCase();
        var author = card.getAttribute("data-author").toLowerCase();
        var subject = card.getAttribute("data-subject").toLowerCase();
        var bookSubject = card.getAttribute("data-book-subject").toLowerCase();
        
        // 1. التحقق من القسم والمادة الدراسية
        var matchesSubject = false;
        if (currentSubject === "all") {
            matchesSubject = true;
        } else {
            matchesSubject = (bookSubject === currentSubject.toLowerCase());
        }
        
        // 2. التحقق من كلمة البحث
        var matchesSearch = false;
        if (currentSearchText === "") {
            matchesSearch = true;
        } else {
            matchesSearch = title.includes(currentSearchText) || author.includes(currentSearchText) || subject.includes(currentSearchText);
        }
        
        // إظهار أو إخفاء كارت الكتاب بناءً على الشرطين
        if (matchesSubject && matchesSearch) {
            card.style.display = "flex";
            foundCount++;
        } else {
            card.style.display = "none";
        }
    });
    
    // إظهار رسالة التنبيه في حال كانت النتائج صفراً
    var noResultsDiv = document.getElementById("no-results-msg");
    if (foundCount === 0) {
        noResultsDiv.style.display = "block";
    } else {
        noResultsDiv.style.display = "none";
    }
}
</script>