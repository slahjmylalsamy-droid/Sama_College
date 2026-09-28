<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/index.php';
$content = file_get_contents($filepath);

$target = '<div style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: \'Cairo\', sans-serif; direction: rtl; justify-content: flex-start;">
        <a href="?p=home" style="color: var(--main-color); text-decoration: none; display: flex; align-items: center; justify-content: center;" title="الرئيسية">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        </a>
        <span style="color: var(--main-color); font-size: 16px; font-weight: bold; margin: 0 4px;">/</span>
        <span style="color: var(--main-color); font-weight: bold; font-size: 15px;">
            <?php echo $current_title; ?>
        </span>
    </div>
</div>';

$replacement = '<div style="background:#f4f6f9; padding: 15px 20px; border-bottom: 1px solid #eaeaea;">
    <div style="max-width:1200px; margin:auto; display:flex; align-items:center; gap:8px; font-family: \'Cairo\', sans-serif; direction: rtl; justify-content: flex-start;">
        <a href="?p=home" class="breadcrumb-home-link" title="الرئيسية">
            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="currentColor"><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"/></svg>
        </a>
        <span class="breadcrumb-slash">/</span>
        <span class="breadcrumb-current-page">
            <?php echo $current_title; ?>
        </span>
    </div>
</div>';

// Normalize line endings in search
$content_norm = str_replace("\r\n", "\n", $content);
$target_norm = str_replace("\r\n", "\n", $target);
$replacement_norm = str_replace("\r\n", "\n", $replacement);

if (strpos($content_norm, $target_norm) !== false) {
    $content_norm = str_replace($target_norm, $replacement_norm, $content_norm);
    file_put_contents($filepath, $content_norm);
    echo "Breadcrumbs HTML replaced successfully.\n";
} else {
    echo "Breadcrumbs target not found in index.php content.\n";
}
?>
