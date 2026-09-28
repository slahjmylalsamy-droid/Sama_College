<?php
$opts = array(
    'http' => array(
        'request_fulluri' => true,
        'proxy' => '',
    )
);
$context = stream_context_create($opts);

// Test port 8080
$res8080 = @file_get_contents("http://127.0.0.1:8080/Sama_College/index.php", false, $context);
if ($res8080 !== false) {
    echo "Port 8080 works: SUCCESS. HTML length: " . strlen($res8080) . "\n";
} else {
    echo "Port 8080 failed.\n";
}

// Test port 80
$res80 = @file_get_contents("http://127.0.0.1/Sama_College/index.php", false, $context);
if ($res80 !== false) {
    echo "Port 80 works: SUCCESS. HTML length: " . strlen($res80) . "\n";
} else {
    echo "Port 80 failed.\n";
}
?>
