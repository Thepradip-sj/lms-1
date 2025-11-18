<?php

function getStudentsByCourse($courseId, $conn){
    $sql = "SELECT s.* 
            FROM Enrolls_In ei
            INNER JOIN students s ON ei.StudentId = s.StudentId
            WHERE ei.CourseId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$courseId]);
    return $stmt->fetchAll();
}
?>
