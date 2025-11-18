<?php 
// All classes
function getAllCourses($conn){
   $sql = "SELECT * FROM Course";
   $stmt = $conn->prepare($sql);
   $stmt->execute();

   if ($stmt->rowCount() >= 1) {
     $courses = $stmt->fetchAll();
     return $courses;
   }else {
    return 0;
   }
}


// Get class by ID
function getCourseById($CourseId, $conn){
   $sql = "SELECT * FROM Course
           WHERE CourseId=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$CourseId]);

   if ($stmt->rowCount() == 1) {
     $course = $stmt->fetch();
     return $course;
   }else {
    return 0;
   }
}


// DELETE
function removeCourse($id, $conn){
   $sql  = "DELETE FROM Course
           WHERE CourseID=?";
   $stmt = $conn->prepare($sql);
   $re   = $stmt->execute([$id]);
   if ($re) {
     return 1;
   }else {
    return 0;
   }
}