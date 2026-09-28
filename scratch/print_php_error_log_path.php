<?php
echo "ini_get('error_log'): " . ini_get('error_log') . "\n";
echo "real path of error_log: " . realpath(ini_get('error_log')) . "\n";
?>
