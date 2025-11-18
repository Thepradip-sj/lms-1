<?php 

// All Students 
function getAllStudents($conn){
   $sql = "SELECT * FROM students";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
   } else {
     return 0;
   }
}

// DELETE
function removeStudent($id, $conn){
   $sql  = "DELETE FROM students
            WHERE StudentId = ?";
   $stmt = $conn->prepare($sql);
   return $stmt->execute([$id]) ? 1 : 0;
}

// Get Student By Id 
function getStudentById($id, $conn){
   $sql = "SELECT * FROM students
           WHERE StudentId = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$id]);

   if ($stmt->rowCount() == 1) {
     return $stmt->fetch(PDO::FETCH_ASSOC);
   } else {
     return 0;
   }
}

// Check if the username is Unique
function unameIsUnique($uname, $conn, $student_id = 0){
   $sql = "SELECT username, StudentId FROM students
           WHERE username = ?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);
   
   if ($student_id == 0) {
     return ($stmt->rowCount() >= 1) ? 0 : 1;
   } else {
     if ($stmt->rowCount() >= 1) {
       $student = $stmt->fetch();
       return ($student['StudentId'] == $student_id) ? 1 : 0;
     } else {
       return 1;
     }
   }
}

// Search Students
function searchStudents($key, $conn){
   // Escape SQL wildcard characters
   $key = "%$key%";

   $sql = "SELECT * FROM students
           WHERE StudentId LIKE ?
           OR fname LIKE ?
           OR lname LIKE ?
           OR username LIKE ?
           OR address LIKE ?
           OR gender LIKE ?
           OR SMail LIKE ?
           OR SContact LIKE ?";
   
   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key]);

   if ($stmt->rowCount() >= 1) {
     return $stmt->fetchAll(PDO::FETCH_ASSOC);
   } else {
     return 0;
   }
}