<?php
session_start();
$_SESSION['user_id'] = 1;
$_SESSION['role'] = 'staff';
$_SESSION['permission'] = 3;
$_SESSION['user_name'] = 'مدير النظام';

$_SERVER['PHP_SELF'] = 'manage_content.php';
$_SERVER['REQUEST_METHOD'] = 'GET';

ob_start();
try {
    include 'c:/xampp1/htdocs/Sama_College/admin/manage_content.php';
} catch (Throwable $t) {
    echo "ERROR: " . $t->getMessage() . "\n";
}
$html = ob_get_clean();
file_put_contents('c:/xampp1/htdocs/Sama_College/scratch/test_output.html', $html);
echo "Done. Length: " . strlen($html) . "\n";
?>
