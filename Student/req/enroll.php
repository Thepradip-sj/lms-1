<?php
session_start();

if (!isset($_SESSION['StudentId'])) {
    header("Location: ../login.php");
    exit;
}

if (!isset($_GET['CourseId'])) {
    header("Location: ../index.php");
    exit;
}

include "../../DB_connection.php";

$studentId = $_SESSION['StudentId'];
$courseId  = $_GET['CourseId'];

$sql = "INSERT INTO Enrolls_In (StudentId, CourseId) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->execute([$studentId, $courseId]);

header("Location: ../index.php?success=Enrolled Successfully");
exit;
?>
