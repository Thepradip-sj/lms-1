<?php  

// Get Instructor by ID
function getInstructorById($InstructorId, $conn){
   $sql = "SELECT * FROM Instructor ORDER BY InstructorId DESC";
$stmt = $conn->prepare($sql);
$stmt->execute();
$instructors = $stmt->fetchAll(PDO::FETCH_ASSOC);

   if ($stmt->rowCount() == 1) {
     $instructor = $stmt->fetch();
     return $instructor;
   }else {
     return 0;
   }
}

// Get All Instructors
function getAllInstructors($conn){
   $sql = "SELECT * FROM Instructor";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $instructors = $stmt->fetchAll();
     return $instructors;
   }else {
     return 0;
   }
}

// Check if username is Unique
function unameIsUniqueInstructor($uname, $conn, $InstructorId = 0){
   $sql = "SELECT username, InstructorId FROM Instructor
           WHERE username=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$uname]);

   if ($InstructorId == 0) {
       // For ADD
       return ($stmt->rowCount() >= 1) ? 0 : 1;

   } else {
       // For EDIT
       if ($stmt->rowCount() >= 1) {
          $instructor = $stmt->fetch();
          if ($instructor['InstructorId'] == $InstructorId) {
             return 1;
          } else {
             return 0;
          }
       } else {
          return 1;
       }
   }
}

// DELETE Instructor
function removeInstructor($id, $conn){
   $sql = "DELETE FROM Instructor
           WHERE InstructorId=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);

   if ($re) {
     return 1;
   }else {
     return 0;
   }
}

// Search Instructors
function searchInstructors($key, $conn){

   // Use LIKE wildcards
   $key = "%$key%";

   $sql = "SELECT * FROM Instructor
           WHERE InstructorId LIKE ?
           OR fname LIKE ?
           OR lname LIKE ?
           OR username LIKE ?
           OR IContact LIKE ?
           OR qualification LIKE ?
           OR IMail LIKE ?
           OR address LIKE ?";

   $stmt = $conn->prepare($sql);
   $stmt->execute([$key, $key, $key, $key, $key, $key, $key, $key]);

   return ($stmt->rowCount() >= 1) ? $stmt->fetchAll() : 0;
}