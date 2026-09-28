<?php
$filepath = 'c:/xampp1/htdocs/Sama_College/index.php';
$content = file_get_contents($filepath);

// We replace the styles
$replacements = [
    // 1. Slider hover arrows
    '.prev:hover, .next:hover{ background:#051c1d; }' => '.prev:hover, .next:hover{ background:var(--accent-color) !important; color:black !important; }',
    '.news-prev:hover, .news-next:hover{ background:#051c1d; }' => '.news-prev:hover, .news-next:hover{ background:var(--accent-color) !important; color:black !important; }',
    
    // 2. Box / Squares hover on home page
    '.box:hover{
    background:var(--main-color);
    color:white;
    transform:translateY(-8px);
}' => '.box:hover{
    background:var(--accent-color);
    color:black;
    transform:translateY(-8px);
}',
    
    '.box:hover .arrow{
    color:var(--accent-color);
    transform:translateX(-5px);
}' => '.box:hover .arrow{
    color:var(--main-color) !important;
    transform:translateX(-5px);
}',
    
    '.box:hover .service-icon {
    stroke: white !important;
}' => '.box:hover .service-icon {
    stroke: var(--main-color) !important;
}',

    // 3. Quick boxes hover
    '.quick:hover{
    background:var(--main-color);
    color:white;
    transform:translateY(-8px);
}' => '.quick:hover{
    background:var(--accent-color);
    color:black;
    transform:translateY(-8px);
}',
    
    '.quick:hover .quick-icon {
    stroke: white !important;
}' => '.quick:hover .quick-icon {
    stroke: var(--main-color) !important;
}',

    // 4. Major box hover
    '.major-box:hover{
    transform:translateY(-8px);
    background:var(--main-color);
    color:white;
}' => '.major-box:hover{
    transform:translateY(-8px);
    background:var(--accent-color);
    color:black;
}',

    // 5. News card hover
    '.news-card:hover{
    transform:scale(1.05) translateY(-5px);
    background:var(--main-color);
    color:white;
}' => '.news-card:hover{
    transform:scale(1.05) translateY(-5px);
    background:var(--accent-color);
    color:black;
}'
];

$content_norm = str_replace("\r\n", "\n", $content);

foreach ($replacements as $search => $replace) {
    $search_norm = str_replace("\r\n", "\n", $search);
    $replace_norm = str_replace("\r\n", "\n", $replace);
    
    if (strpos($content_norm, $search_norm) !== false) {
        $content_norm = str_replace($search_norm, $replace_norm, $content_norm);
        echo "Successfully replaced style: " . substr(trim($search_norm), 0, 40) . "...\n";
    } else {
        echo "Warning: Target not found: " . substr(trim($search_norm), 0, 40) . "...\n";
    }
}

// Add the breadcrumbs hover styles at the end of the style block (we can find the closing </style> tag in index.php)
$style_close = '</style>';
$breadcrumb_styles = '
/* Breadcrumb Hover Styles */
.breadcrumb-home-link {
    color: var(--main-color) !important;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}
.breadcrumb-home-link:hover {
    color: var(--accent-color) !important;
    transform: scale(1.15);
}
.breadcrumb-slash {
    color: var(--main-color);
    font-size: 16px;
    font-weight: bold;
    margin: 0 4px;
    transition: color 0.3s ease;
    cursor: default;
}
.breadcrumb-slash:hover {
    color: var(--accent-color) !important;
}
.breadcrumb-current-page {
    color: var(--main-color);
    font-weight: bold;
    font-size: 15px;
    transition: color 0.3s ease;
    cursor: default;
}
.breadcrumb-current-page:hover {
    color: var(--accent-color) !important;
}
</style>';

// Let's add it only if not already added
if (strpos($content_norm, '.breadcrumb-home-link') === false) {
    // Replace the first or last </style>, let's replace the one near page contents or let's target the exact line 1250 style close
    // Actually we can search for the style block after news-page-card
    $target_close = '.btn-back-to-home:hover {
    color: var(--accent-color) !important;
    background: white !important;
    border-color: var(--accent-color) !important;
}
</style>';
    
    $target_replace = '.btn-back-to-home:hover {
    color: var(--accent-color) !important;
    background: white !important;
    border-color: var(--accent-color) !important;
}
' . $breadcrumb_styles;
    
    $target_close_norm = str_replace("\r\n", "\n", $target_close);
    $target_replace_norm = str_replace("\r\n", "\n", $target_replace);
    
    if (strpos($content_norm, $target_close_norm) !== false) {
        $content_norm = str_replace($target_close_norm, $target_replace_norm, $content_norm);
        echo "Successfully added breadcrumb hover CSS.\n";
    } else {
        // Fallback: replace the first </style>
        $content_norm = preg_replace('/<\/style>/', $breadcrumb_styles, $content_norm, 1);
        echo "Added breadcrumb hover CSS using fallback.\n";
    }
} else {
    echo "Breadcrumb hover CSS already exists.\n";
}

file_put_contents($filepath, $content_norm);
?>
