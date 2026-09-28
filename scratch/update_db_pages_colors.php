<?php
require_once 'db_connect.php';

$res = mysqli_query($conn, "SELECT id, page_content FROM site_pages");
if ($res) {
    while ($row = mysqli_fetch_assoc($res)) {
        $id = $row['id'];
        $content = $row['page_content'];
        
        $new_content = str_replace('#0d4748', 'var(--main-color)', $content);
        $new_content = str_replace('#c5a059', 'var(--accent-color)', $new_content);
        
        if ($new_content !== $content) {
            $stmt = mysqli_prepare($conn, "UPDATE site_pages SET page_content = ? WHERE id = ?");
            mysqli_stmt_bind_param($stmt, 'si', $new_content, $id);
            mysqli_stmt_execute($stmt);
            echo "Updated page ID $id successfully.\n";
        }
    }
}
echo "Database color cleanup complete.\n";
?>
