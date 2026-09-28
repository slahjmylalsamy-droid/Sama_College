<?php
$img_path = 'C:/Users/asus/.gemini/antigravity/brain/e69fa78a-8e64-4837-8d43-af117029d7d9/.user_uploaded/media__1786802401063.png';

if (!file_exists($img_path)) {
    die("Error: Image not found.\n");
}

$im = imagecreatefrompng($img_path);
if (!$im) {
    die("Error: Failed to load image.\n");
}

$width = imagesx($im);
$height = imagesy($im);

$colors = [];
for ($x = 0; $x < $width; $x++) {
    for ($y = 0; $y < $height; $y++) {
        $rgb = imagecolorat($im, $x, $y);
        $r = ($rgb >> 16) & 0xFF;
        $g = ($rgb >> 8) & 0xFF;
        $b = $rgb & 0xFF;
        
        // Skip white/black/gray pixels to find the vibrant green/yellow color
        if ($r > 220 && $g > 220 && $b > 220) continue; // white
        if ($r < 30 && $g < 30 && $b < 30) continue; // black
        if (abs($r - $g) < 15 && abs($g - $b) < 15) continue; // gray
        
        $hex = sprintf("#%02x%02x%02x", $r, $g, $b);
        if (!isset($colors[$hex])) {
            $colors[$hex] = 0;
        }
        $colors[$hex]++;
    }
}

arsort($colors);

echo "DOMINANT COLORS FOUND:\n";
$i = 0;
foreach ($colors as $hex => $count) {
    echo "- $hex (Count: $count)\n";
    $i++;
    if ($i >= 15) break;
}
?>
