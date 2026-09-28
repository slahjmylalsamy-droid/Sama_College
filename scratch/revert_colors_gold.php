<?php
require_once 'db_connect.php';

// Revert primary and secondary colors to original defaults (#0d4748 and #ffd700)
mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('theme_color', '#0d4748') ON DUPLICATE KEY UPDATE setting_value = '#0d4748'");
mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('accent_color', '#ffd700') ON DUPLICATE KEY UPDATE setting_value = '#ffd700'");

echo "Colors reverted to original defaults in database (#0d4748 and #ffd700).\n";
?>
