<?php 
session_start();

if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['InstructorIdd'])) {

  if ($_SESSION['role'] == 'Admin') {

     include "../DB_connection.php";
     include "data/instructor.php"; // updated file

     $id = $_GET['InstructorIdd'];

     if (removeInstructor($id, $conn)) {   // updated function
        $sm = "Instructor deleted successfully!";
        header("Location: instructor.php?success=$sm");
        exit;
     } else {
        $em = "Unknown error occurred";
        header("Location: instructor.php?error=$em");
        exit;
     }

  } else {
    header("Location: staff.php");
    exit;
  }

} else {
    header("Location: staff.php");
    exit;
}
?>
