<?php
$html = file_get_contents('c:/xampp1/htdocs/Sama_College/scratch/output.html');
if (strpos($html, '<h1 class="branch-heading-title">فرع دمنة خدير</h1>') !== false) {
    echo "Found branch header in output!\n";
} else {
    echo "Branch header NOT found in output!\n";
    // Check what is in the main content container
    if (strpos($html, 'slider') !== false) {
        echo "It contains the slider (which means it loaded the home page instead of the branch page)!\n";
    }
}
?>
