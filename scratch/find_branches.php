<?php
function searchDir($dir, $term) {
    $results = [];
    $files = scandir($dir);
    foreach ($files as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = $dir . '/' . $file;
        if (is_dir($path)) {
            $results = array_merge($results, searchDir($path, $term));
        } else {
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            if (in_array($ext, ['php', 'html', 'js', 'css'])) {
                $content = file_get_contents($path);
                if (strpos($content, $term) !== false) {
                    $results[] = $path;
                }
            }
        }
    }
    return $results;
}

$root = 'c:/xampp1/htdocs/Sama_College';
echo "Searching for 'الراهدة':\n";
print_r(searchDir($root, 'الراهدة'));

echo "\nSearching for 'دمنة':\n";
print_r(searchDir($root, 'دمنة'));

echo "\nSearching for 'branch':\n";
print_r(searchDir($root, 'branch'));
?>
