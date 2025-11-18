<?php 

// All Students 
function getAllStudents($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     return $stmt->fetchAll();
   } else {
     return 0;
   }
}


// Get Student By Id 
function getStudentById($id, $conn){
   $sql = "SELECT * FROM students
           WHERE StudentId = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     return $stmt->fetch();
   } else {
     return 0;
   }
}


// Check if username is unique
function unameIsUnique($uname, $conn, $student_id = 0){
   $sql = "SELECT username, StudentId FROM students
           WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);

   if ($student_id == 0) {
     // For new user
     return $stmt->rowCount() == 0 ? 1 : 0;
   } else {
     // For existing user
     if ($stmt->rowCount() >= 1) {
        $student = $stmt->fetch();
        return ($student['StudentId'] == $student_id) ? 1 : 0;
     } else {
        return 1;
     }
   }
}



// Verify Student Password
function studentPasswordVerify($student_pass, $conn, $student_id){
   $sql = "SELECT * FROM students
           WHERE StudentId = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$student_id]);

   if ($stmt->rowCount() == 1) {
     $student = $stmt->fetch();
     $pass  = $student['password'];

     return password_verify($student_pass, $pass) ? 1 : 0;
   } else {
     return 0;
   }
}
function getStudentsByCourse($courseId, $conn){
    $sql = "SELECT s.* 
            FROM Enrolls_In ei
            INNER JOIN students s ON ei.StudentId = s.StudentId
            WHERE ei.CourseId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$courseId]);
    return $stmt->fetchAll();
}
function getStudentsByInstructor($InstructorId, $conn) {
    $sql = "SELECT DISTINCT s.*
        FROM students s
        INNER JOIN Enrolls_In e ON s.StudentId = e.StudentId
        INNER JOIN COURSE c ON e.CourseId = c.CourseID
        WHERE c.InstructorId = ?
        ORDER BY s.fname, s.lname";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$InstructorId]);

    return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : [];
}


?>
