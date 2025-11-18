<?php  

function getInstructorById($InstructorId, $conn){
   $sql = "SELECT * FROM Instructor
           WHERE InstructorId = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$InstructorId]);

   if ($stmt->rowCount() == 1) {
     return $stmt->fetch();
   } else {
     return 0;
   }
}
function instructorPasswordVerify($pass, $conn, $InstructorId){
    $sql = "SELECT password FROM Instructor WHERE InstructorId=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$InstructorId]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        return password_verify($pass, $row['password']);
    }
    return false;
}
?>
