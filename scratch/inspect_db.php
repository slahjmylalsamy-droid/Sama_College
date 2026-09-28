<?php
require_once 'db_connect.php';

$output = "";
$res = mysqli_query($conn, "SHOW TABLES");
if ($res) {
    while ($row = mysqli_fetch_row($res)) {
        $table = $row[0];
        $output .= "\n--- Table: $table ---\n";
        $desc = mysqli_query($conn, "DESCRIBE `$table`");
        if ($desc) {
            while ($col = mysqli_fetch_assoc($desc)) {
                $output .= "  Column: {$col['Field']} - Type: {$col['Type']} - Key: {$col['Key']} - Default: {$col['Default']}\n";
            }
        }
    }
} else {
    $output .= "Error showing tables: " . mysqli_error($conn);
}
file_put_contents('scratch/db_structure.txt', $output);
echo "Successfully generated structure.\n";
?>
