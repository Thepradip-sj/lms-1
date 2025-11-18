<?php
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

if (isset($_GET['CourseID'])) {

    include '../../DB_connection.php';
    include '../data/course.php';

    $CourseID = $_GET['CourseID'];

    if (removeCourse($CourseID, $conn)) {
        $sm = "Course deleted successfully";
        header("Location: ../course.php?success=$sm");
        exit;
    } else {
        $em = "Failed to delete";
        header("Location: ../course.php?error=$em");
        exit;
    }

} else {
    header("Location: ../course.php?error=Course ID missing");
    exit;
}

    } else {
        header("Location: ../../logout.php");
        exit;
    }

} else {
    header("Location: ../../logout.php");
    exit;
}
