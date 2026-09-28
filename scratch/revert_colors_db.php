<?php
require_once 'db_connect.php';

// Revert primary and secondary colors to defaults in site_settings
mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('theme_color', '#0d4748') ON DUPLICATE KEY UPDATE setting_value = '#0d4748'");
mysqli_query($conn, "INSERT INTO site_settings (setting_key, setting_value) VALUES ('accent_color', '#c5a059') ON DUPLICATE KEY UPDATE setting_value = '#c5a059'");

echo "Colors reverted to original defaults in database (#0d4748 and #c5a059).\n";
?>
