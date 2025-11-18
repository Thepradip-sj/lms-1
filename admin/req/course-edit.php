<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

if ( isset($_POST['CourseID']) &&
     isset($_POST['CName']) &&
     isset($_POST['Credits']) &&
     isset($_POST['CDuration']) &&
     isset($_POST['InstructorId']) ) {

    include '../../DB_connection.php';

    $CourseID     = $_POST['CourseID'];
    $CName        = $_POST['CName'];
    $Credits      = $_POST['Credits'];
    $CDuration    = $_POST['CDuration'];
    $InstructorId = $_POST['InstructorId'];

    $data = 'CourseID='.$CourseID;

    if (empty($CourseID)) {
        $em = "CourseID is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }
    else if (empty($CName)) {
        $em = "Name is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }
    else if (empty($Credits)) {
        $em = "Credits are required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }
    else if (empty($CDuration)) {
        $em = "Duration is required";
        header("Location: ../course-edit.php?error=$em&$data");
        exit;
    }

    // Update
    $sql  = "UPDATE COURSE SET 
                CName=?, Credits=?, CDuration=?, InstructorId=?
             WHERE CourseID=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$CName, $Credits, $CDuration, $InstructorId, $CourseID]);

    $sm = "Course updated successfully";
    header("Location: ../course-edit.php?success=$sm&$data");
    exit;

} else {
    $em = "An error occurred";
    header("Location: ../course.php?error=$em");
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
