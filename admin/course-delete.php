<?php 
session_start();
if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role']) &&
    isset($_GET['CourseID'])) {

  if ($_SESSION['role'] == 'Admin') {

     include "../DB_connection.php";
     include "data/course.php";

     $id = $_GET['CourseID'];

     if (removeCourse($id, $conn)) {
     	$sm = "Successfully deleted!";
        header("Location: course.php?success=$sm");
        exit;
     } else {
        $em = "Unknown error occurred";
        header("Location: course.php?error=$em");
        exit;
     }

  } else {
    header("Location: course.php");
    exit;
  }

} else {
	header("Location: course.php");
	exit;
}
?>
