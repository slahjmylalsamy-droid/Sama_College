<?php
// منع الوصول المباشر
if (!defined('INCLUDED_FROM_INDEX')) {
    die('لا يمكن الوصول إلى هذا الملف مباشرة');
}

// تضمين مصفوفة الأخبار المشتركة لآخر الأخبار
include_once 'pages/latest_news_data.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$has_initial_news = ($id > 0 && isset($latest_news_items[$id]));
?>

<div style="min-height:80vh;background:#f4f6f9;padding:40px 20px;direction:rtl;">
    <div style="max-width:1100px;margin:auto;">

        <!-- قائمة آخر الأخبار -->
        <div style="text-align:right;margin-bottom:30px;">
            <h1 style="color:#0d4748;font-size:28px;margin-bottom:5px;border-bottom:3px solid #ffd700;padding-bottom:15px;display:inline-block;font-family:'Cairo', sans-serif;">
                📰 آخر الأخبار
            </h1>
            <p style="color:#666;margin-top:10px;font-family:'Cairo', sans-serif;">آخر الأخبار المستقلة والفعاليات في كلية سماء المتميزين</p>
        </div>

        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(320px,1fr));gap:25px;font-family:'Cairo', sans-serif;">
            <?php foreach ($latest_news_items as $news_id => $item): 
                $js_data = htmlspecialchars(json_encode(array_merge($item, ['id' => $news_id])), ENT_QUOTES, 'UTF-8');
            ?>
                <div class="news-page-card" onclick="openLatestNewsModal(<?php echo $js_data; ?>)">
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
                        <a href="javascript:void(0)" onclick="event.stopPropagation(); openLatestNewsModal(<?php echo $js_data; ?>)" class="read-more-link">المزيد ←</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- زر العودة -->
        <div style="text-align:center;margin-top:40px;font-family:'Cairo', sans-serif;">
            <a href="?p=home" class="btn-back-to-home"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg> العودة لصفحة الرئيسية</a>
        </div>

    </div>
</div>

<?php if ($has_initial_news): ?>
    <!-- فتح مودال الخبر تلقائياً عند تحميل الصفحة في حال طلب خبر محدد -->
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var news = <?php echo json_encode(array_merge($latest_news_items[$id], ['id' => $id])); ?>;
        openLatestNewsModal(news);
    });
    </script>
<?php endif; ?>
