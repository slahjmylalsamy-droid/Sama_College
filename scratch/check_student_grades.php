<?php
include 'db_connect.php';
$res = mysqli_query($conn, "SELECT g.*, s.subject_name, s.subject_code, s.level as sub_level 
                             FROM grades g 
                             JOIN subjects s ON g.subject_id = s.id 
                             WHERE g.student_id = 11");
echo "Grades for student 11:\n";
while ($row = mysqli_fetch_assoc($res)) {
    echo "Subject: {$row['subject_name']} | Code: {$row['subject_code']} | Sub Level: {$row['sub_level']} | Grade: {$row['total_grade']}\n";
}
?>
