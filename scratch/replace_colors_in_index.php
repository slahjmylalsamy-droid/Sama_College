<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/index.php';
$content = file_get_contents($filepath);

// Replace :root variables first
$root_search = ':root{
    --main-color:#0d4748;
    --dark-color:#072928;
    --light-color:#eef5fb;
}';

$root_replace = '<?php
$theme_color = get_setting(\'theme_color\', \'#0d4748\');
$accent_color = get_setting(\'accent_color\', \'#c5a059\');

function adjust_brightness_local($hex, $steps) {
    $steps = max(-255, min(255, $steps));
    $hex = str_replace(\'#\', \'\', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex, 0, 1), 2) . str_repeat(substr($hex, 1, 1), 2) . str_repeat(substr($hex, 2, 1), 2);
    }
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));
    
    $r = max(0, min(255, $r + $steps));
    $g = max(0, min(255, $g + $steps));
    $b = max(0, min(255, $b + $steps));
    
    return \'#\' . str_pad(dechex($r), 2, \'0\', STR_PAD_LEFT) . str_pad(dechex($g), 2, \'0\', STR_PAD_LEFT) . str_pad(dechex($b), 2, \'0\', STR_PAD_LEFT);
}
$dark_theme_color = adjust_brightness_local($theme_color, -40);
?>
:root{
    --main-color: <?php echo $theme_color; ?>;
    --dark-color: <?php echo $dark_theme_color; ?>;
    --accent-color: <?php echo $accent_color; ?>;
    --light-color:#eef5fb;
}';

// We replace the root style block
if (strpos($content, $root_search) !== false) {
    $content = str_replace($root_search, $root_replace, $content);
    echo "Replaced :root style definition successfully.\n";
} else {
    // Try without spaces or standard search
    $content = preg_replace('/:root\s*\{\s*--main-color\s*:\s*#0d4748;\s*--dark-color\s*:\s*#072928;\s*--light-color\s*:\s*#eef5fb;\s*\}/i', $root_replace, $content);
    echo "Replaced :root with regex.\n";
}

// Now replace all other instances of the color codes inside CSS style tags or inline styles
// Let's replace:
// #0d4748 -> var(--main-color)
// #085859 -> var(--main-color)
// #072928 -> var(--dark-color)
// #ffd700 -> var(--accent-color)
// #c5a059 -> var(--accent-color)

// Be careful not to replace it inside the PHP blocks we just added or settings
// We can temporarily replace our newly added variables so they are not changed
$content = str_replace("get_setting('theme_color', '#0d4748')", "get_setting('theme_color', 'TEMP_THEME_COLOR')", $content);
$content = str_replace("get_setting('accent_color', '#c5a059')", "get_setting('accent_color', 'TEMP_ACCENT_COLOR')", $content);

// Replacements:
$replacements = [
    '/#0d4748/i' => 'var(--main-color)',
    '/#085859/i' => 'var(--main-color)',
    '/#072928/i' => 'var(--dark-color)',
    '/#ffd700/i' => 'var(--accent-color)',
    '/#c5a059/i' => 'var(--accent-color)'
];

$count = 0;
foreach ($replacements as $pattern => $replacement) {
    $content = preg_replace_callback($pattern, function($matches) use ($replacement, &$count) {
        $count++;
        return $replacement;
    }, $content);
}

// Revert the temporary placeholders
$content = str_replace("get_setting('theme_color', 'TEMP_THEME_COLOR')", "get_setting('theme_color', '#0d4748')", $content);
$content = str_replace("get_setting('accent_color', 'TEMP_ACCENT_COLOR')", "get_setting('accent_color', '#c5a059')", $content);

file_put_contents($filepath, $content);
echo "Completed replacements. Total colors updated to CSS variables: $count\n";
?>
