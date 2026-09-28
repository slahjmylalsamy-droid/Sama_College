<?php
// منع الوصول المباشر
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}

// تضمين مصفوفة الأخبار المشتركة
include_once 'pages/news_data.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$show_detail = ($id > 0 && isset($news_items[$id]));
?>

<style>
.news-page-card {
    background: white;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    transition: all 0.3s ease;
    border-bottom: 4px solid #ffd700;
    cursor: pointer;
}
.news-page-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(0,0,0,0.15);
}
.news-page-card .news-card-content {
    padding: 20px;
    transition: all 0.3s ease;
    background: white;
}
.news-page-card:hover .news-card-content {
    background: #f0f7f7;
}
.news-page-card:hover h3 {
    color: #085859 !important;
}
.news-page-card .read-more-link {
    display: inline-block;
    color: #0d4748;
    font-weight: bold;
    font-size: 14px;
    text-decoration: none;
    transition: all 0.3s ease;
}
.news-page-card:hover .read-more-link {
    color: #085859 !important;
    transform: translateX(-5px);
}
.other-news-card {
    background: white;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.05);
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 110px;
    border-bottom: 3px solid #ffd700;
    transition: all 0.3s ease;
    cursor: pointer;
    text-decoration: none;
}
.other-news-card:hover {
    transform: translateY(-4px);
    background: #f0f7f7 !important;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}
.other-news-card h4 {
    color: #333;
    font-size: 14px;
    margin: 0;
    line-height: 1.6;
    font-weight: bold;
    text-align: justify;
    transition: color 0.3s ease;
}
.other-news-card:hover h4 {
    color: #085859 !important;
}
.other-news-card .arrow-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 28px;
    height: 28px;
    border: 2px solid #085859;
    color: #085859;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    background: transparent;
    transition: all 0.3s ease;
}
.other-news-card:hover .arrow-btn {
    background: #085859 !important;
    color: white !important;
}

/* ستايل سلايدر الصور الجديد */
.news-slider-container {
    position: relative;
    width: 100%;
    overflow: hidden;
    background: transparent;
    direction: ltr;
    border-bottom: 4px solid #ffd700;
}
.news-slides {
    display: flex;
    width: 100%;
    transition: transform 0.5s ease-in-out;
    direction: ltr;
}
.news-slide {
    min-width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
}
.slider-arrow {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0,0,0,0.4);
    color: white;
    border: none;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 20px;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s ease;
}
.slider-arrow:hover {
    background: #085859;
}
.slider-arrow.prev {
    left: 15px;
}
.slider-arrow.next {
    right: 15px;
}
.slider-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
}
.slider-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255,255,255,0.5);
    cursor: pointer;
    transition: all 0.3s ease;
}
.slider-dot.active {
    background: #ffd700 !important;
    width: 25px !important;
    border-radius: 5px !important;
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
</style>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;">
    <div style="max-width:1100px;margin:auto;">

        <?php if ($show_detail): 
            $item = $news_items[$id];
            
            // Construct share URLs
            $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
            $current_url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            $share_url = urlencode($current_url);
            $share_title = urlencode($item['title']);
            
            // Get other news items (limit to 3 other news)
            $other_news = [];
            foreach ($news_items as $other_id => $other_item) {
                if ($other_id != $id) {
                    $other_news[$other_id] = $other_item;
                }
            }
            $other_news = array_slice($other_news, 0, 3, true);
        ?>
            <!-- تفاصيل الخبر -->
            <div style="max-width:900px;margin:auto;background:white;border-radius:20px;box-shadow:0 10px 30px rgba(0,0,0,0.08);overflow:hidden;">
                <?php if (isset($item['images']) && is_array($item['images']) && count($item['images']) > 0): ?>
                    <!-- عرض سلايدر الصور التفاعلي -->
                    <div class="news-slider-container" id="slider-<?php echo $id; ?>" onmouseenter="pauseSlider(<?php echo $id; ?>)" onmouseleave="resumeSlider(<?php echo $id; ?>)">
                        <!-- Slides -->
                        <div class="news-slides" style="transform: translateX(0%);">
                            <?php foreach ($item['images'] as $img_path): ?>
                                <div class="news-slide">
                                    <img src="<?php echo $img_path; ?>" style="max-width:100%; max-height:520px; width:auto; height:auto; object-fit:contain;" alt="">
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <!-- Arrows -->
                        <button class="slider-arrow prev" onclick="moveSlider(<?php echo $id; ?>, -1)">❮</button>
                        <button class="slider-arrow next" onclick="moveSlider(<?php echo $id; ?>, 1)">❯</button>
                        
                        <!-- Dots -->
                        <div class="slider-dots">
                            <?php foreach ($item['images'] as $idx => $img_path): ?>
                                <span class="slider-dot <?php echo $idx === 0 ? 'active' : ''; ?>" onclick="setSlider(<?php echo $id; ?>, <?php echo $idx; ?>)"></span>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php elseif (isset($item['image']) && !empty($item['image'])): ?>
                    <div style="width:100%; overflow:hidden; background:transparent; display:flex; align-items:center; justify-content:center; border-bottom: 4px solid #ffd700;">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" style="max-width:100%; height:auto; max-height:520px; object-fit:contain;">
                    </div>
                <?php else: ?>
                    <div style="height:250px;background:<?php echo $item['gradient']; ?>;display:flex;align-items:center;justify-content:center;color:white;font-size:70px;">
                        <?php echo $item['icon']; ?>
                    </div>
                <?php endif; ?>
                
                <div style="padding:40px;">
                    <div style="display:flex;flex-wrap:wrap;gap:15px;justify-content:space-between;align-items:center;margin-bottom:20px;border-bottom:1px solid #f0f0f0;padding-bottom:15px;">
                        <span style="color:#ffd700;font-size:14px;font-weight:bold;background:#ffd70020;padding:5px 15px;border-radius:20px;"><?php echo $item['badge']; ?></span>
                        <span style="color:#999;font-size:14px;">📅 <?php echo $item['date']; ?></span>
                    </div>
                    <h1 style="color:#0d4748;font-size:24px;line-height:1.6;margin-bottom:20px;"><?php echo $item['title']; ?></h1>
                    <div style="color:#444;font-size:16px;line-height:2;text-align:justify;font-family:'Cairo', sans-serif;">
                        <?php echo $item['content']; ?>
                    </div>
                    
                    <!-- قسم مشاركة الصفحة داخل الكارت -->
                    <div style="display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:15px; margin-top:40px; padding-top:20px; border-top:1px solid #eaeaea; direction:rtl;">
                        <span style="font-size:16px; font-weight:bold; color:#333;">مشاركة الصفحة</span>
                        <div style="display:flex; gap:10px; flex-wrap:wrap;">
                            <!-- فيسبوك -->
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo $share_url; ?>" target="_blank" class="share-btn-new share-btn-fb">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                                فيسبوك
                            </a>
                            <!-- تويتر -->
                            <a href="https://twitter.com/intent/tweet?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>" target="_blank" class="share-btn-new share-btn-tw">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/></svg>
                                تويتر
                            </a>
                            <!-- واتساب -->
                            <a href="https://api.whatsapp.com/send?text=<?php echo $share_title; ?>%20<?php echo $share_url; ?>" target="_blank" class="share-btn-new share-btn-wa">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.514 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.502-5.724-1.457L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.825 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.97C16.59 1.966 14.122 1.05 11.5 1.05c-5.437 0-9.863 4.373-9.867 9.803-.001 1.814.497 3.59 1.44 5.176l-.999 3.644 3.75-.983zm11.567-5.69c-.29-.145-1.716-.847-1.978-.942-.262-.096-.453-.145-.642.145-.19.29-.738.942-.905 1.135-.166.19-.333.214-.623.069-.29-.145-1.224-.451-2.33-1.439-.86-.767-1.44-1.716-1.609-2.006-.169-.29-.018-.447.127-.591.13-.13.29-.338.435-.507.145-.169.193-.29.29-.483.097-.193.048-.361-.024-.507-.072-.145-.642-1.544-.88-2.118-.231-.557-.465-.482-.642-.49-.166-.008-.357-.01-.548-.01-.19 0-.501.072-.762.357-.262.29-1 .978-1 2.386 0 1.409 1.023 2.769 1.167 2.962.145.193 2.013 3.074 4.877 4.307.682.293 1.215.468 1.63.6.685.218 1.309.187 1.802.114.549-.08 1.717-.701 1.958-1.378.24-.678.24-1.258.17-1.379-.071-.12-.262-.193-.552-.338z"/></svg>
                                واتساب
                            </a>
                            <!-- تيليجرام -->
                            <a href="https://t.me/share/url?url=<?php echo $share_url; ?>&text=<?php echo $share_title; ?>" target="_blank" class="share-btn-new share-btn-tg">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M20.66 4.98l-2.76 13c-.15.68-.55.85-1.12.53l-4.2-3.1-2.03 1.95c-.22.22-.4.4-.83.4l.3-4.23 7.68-6.93c.33-.3-.07-.46-.5-.18L7.66 13.5l-4.1-1.28c-.9-.28-.9-.88.18-1.3L19.9 4.7c.75-.28 1.4.16 1.13 1.25z"/></svg>
                                تيليجرام
                            </a>
                            <!-- انستجرام -->
                            <a href="#" onclick="copyNewsLink(event)" class="share-btn-new share-btn-ig">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" style="vertical-align:middle;"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.051c-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/></svg>
                                انستجرام
                            </a>
                        </div>
                    </div>
                    
                    <script>
                    function copyNewsLink(e) {
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
                        alertDiv.innerText = "📋 تم نسخ رابط الخبر! يمكنك الآن لصقه ومشاركته على انستجرام.";
                        document.body.appendChild(alertDiv);
                        
                        setTimeout(function() {
                            alertDiv.style.transition = "opacity 0.5s ease";
                            alertDiv.style.opacity = "0";
                            setTimeout(function() {
                                document.body.removeChild(alertDiv);
                            }, 500);
                        }, 3000);
                    }
                    </script>
                </div>
            </div>


            <!-- أزرار التنقل والعودة في أسفل الصفحة -->
            <div style="text-align:center;margin-top:50px;display:flex;justify-content:center;gap:15px;flex-wrap:wrap;">
                <a href="?p=news" style="display:inline-flex;align-items:center;gap:10px;background:#085859;color:white;padding:12px 35px;border-radius:30px;text-decoration:none;font-weight:bold;font-size:16px;box-shadow:0 4px 15px rgba(8, 88, 89,0.2);transition:0.3s;" onmouseover="this.style.background='#0d4748';this.style.transform='translateY(-2px)'" onmouseout="this.style.background='#085859';this.style.transform='translateY(0)'">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                    العودة لصفحة الأخبار
                </a>
                <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            </div>
        <?php else: ?>
            <!-- قائمة الأخبار -->
            <div style="text-align:right;margin-bottom:30px;">
                <h1 style="color:#0d4748;font-size:28px;margin-bottom:5px;border-bottom:3px solid #ffd700;padding-bottom:15px;display:inline-block;">
                    📰 أخبار الكلية
                </h1>
                <p style="color:#666;margin-top:10px;">آخر الأخبار في كلية سماء المتميزين</p>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:25px;">
                <?php foreach ($news_items as $news_id => $item): ?>
                    <div class="news-page-card" onclick="location.href='?p=news&id=<?php echo $news_id; ?>'">
                        <?php if (isset($item['images']) && is_array($item['images']) && count($item['images']) > 0): ?>
                            <div style="height:200px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f0f2f5;">
                                <img src="<?php echo $item['images'][0]; ?>" alt="<?php echo $item['title']; ?>" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        <?php elseif (isset($item['image']) && !empty($item['image'])): ?>
                            <div style="height:200px; overflow:hidden; display:flex; align-items:center; justify-content:center; background:#f0f2f5;">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                        <?php else: ?>
                            <div style="height:200px;background:<?php echo $item['gradient']; ?>;display:flex;align-items:center;justify-content:center;color:white;font-size:50px;">
                                <?php echo $item['icon']; ?>
                            </div>
                        <?php endif; ?>
                        <div class="news-card-content">
                            <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:10px;">
                                <span style="color:#ffd700;font-size:12px;font-weight:bold;background:#ffd70020;padding:3px 12px;border-radius:20px;"><?php echo $item['badge']; ?></span>
                                <span style="color:#999;font-size:12px;">📅 <?php echo $item['date']; ?></span>
                            </div>
                            <h3 style="color:#0d4748;font-size:17px;margin-bottom:10px;line-height:1.6;transition: color 0.3s ease;"><?php echo $item['title']; ?></h3>
                            <p style="color:#555;font-size:14px;line-height:1.7;margin-bottom:15px;"><?php echo $item['summary']; ?></p>
                            <a href="?p=news&id=<?php echo $news_id; ?>" class="read-more-link">المزيد ←</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- زر العودة -->
            <div style="text-align:center;margin-top:40px;">
                <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<!-- كود جافا سكريبت الخاص بالسلايدر التفاعلي -->
<script>
var sliders = {};

function initSlider(id, count) {
    sliders[id] = {
        currentIndex: 0,
        count: count,
        intervalId: null,
        paused: false
    };
    startSliderTimer(id);
}

function startSliderTimer(id) {
    if (sliders[id].intervalId) {
        clearInterval(sliders[id].intervalId);
    }
    sliders[id].intervalId = setInterval(function() {
        if (!sliders[id].paused) {
            moveSlider(id, 1);
        }
    }, 6000); // الانتقال كل 6 ثواني كما هو مطلوب
}

function moveSlider(id, direction) {
    var slider = sliders[id];
    if (!slider) return;
    
    slider.currentIndex += direction;
    if (slider.currentIndex >= slider.count) {
        slider.currentIndex = 0;
    } else if (slider.currentIndex < 0) {
        slider.currentIndex = slider.count - 1;
    }
    
    updateSliderUI(id);
}

function setSlider(id, index) {
    var slider = sliders[id];
    if (!slider) return;
    
    slider.currentIndex = index;
    updateSliderUI(id);
    startSliderTimer(id); // تصفير العداد عند التقليب اليدوي
}

function updateSliderUI(id) {
    var slider = sliders[id];
    var container = document.getElementById("slider-" + id);
    if (!container) return;
    
    var slidesWrapper = container.querySelector(".news-slides");
    if (slidesWrapper) {
        slidesWrapper.style.transform = "translateX(-" + (slider.currentIndex * 100) + "%)";
    }
    
    var dots = container.querySelectorAll(".slider-dot");
    dots.forEach(function(dot, idx) {
        if (idx === slider.currentIndex) {
            dot.classList.add("active");
        } else {
            dot.classList.remove("active");
        }
    });
}

function pauseSlider(id) {
    if (sliders[id]) {
        sliders[id].paused = true;
    }
}

function resumeSlider(id) {
    if (sliders[id]) {
        sliders[id].paused = false;
        startSliderTimer(id); // استئناف العداد عند خروج الماوس
    }
}

document.addEventListener("DOMContentLoaded", function() {
    <?php
    foreach ($news_items as $news_id => $item) {
        if (isset($item['images']) && is_array($item['images'])) {
            echo "initSlider(" . $news_id . ", " . count($item['images']) . ");\n";
        }
    }
    ?>
});
</script>
