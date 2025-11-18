<?php 
session_start();

if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['StudentId'])) {

  if ($_SESSION['role'] == 'Admin') {

     include "../DB_connection.php";

     $id = $_GET['StudentId'];

     // DELETE student
     $sql = "DELETE FROM students WHERE StudentId = ?";
     $stmt = $conn->prepare($sql);

     if ($stmt->execute([$id])) {
        $sm = "Successfully deleted!";
        header("Location: student.php?success=$sm");
        exit;
     } else {
        $em = "Unknown error occurred";
        header("Location: student.php?error=$em");
        exit;
     }

  } else {
    header("Location: student.php");
    exit;
  }

} else {
	header("Location: student.php");
	exit;
}
?>
