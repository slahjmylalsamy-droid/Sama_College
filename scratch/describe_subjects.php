<?php
include 'db_connect.php';
$res = mysqli_query($conn, "DESCRIBE subjects");
echo "Subjects table schema:\n";
while ($row = mysqli_fetch_assoc($res)) {
    echo "Field: {$row['Field']} | Type: {$row['Type']} | Null: {$row['Null']}\n";
}
?>
