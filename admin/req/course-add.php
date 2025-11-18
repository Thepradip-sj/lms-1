<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

if ( isset($_POST['CName']) &&
     isset($_POST['Credits']) &&
     isset($_POST['CDuration']) &&
     isset($_POST['InstructorId']) ) {

    include '../../DB_connection.php';

    $CName       = $_POST['CName'];
    $Credits     = $_POST['Credits'];
    $CDuration   = $_POST['CDuration'];
    $InstructorId = $_POST['InstructorId'];
    $AdminId     = $_SESSION['AdminId'];

    if (empty($CName)) {
        $em = "Course Name is required";
        header("Location: ../course-add.php?error=$em");
        exit;
    }
    else if (empty($Credits)) {
        $em = "Credits are required";
        header("Location: ../course-add.php?error=$em");
        exit;
    }
    else if (empty($CDuration)) {
        $em = "Duration is required";
        header("Location: ../course-add.php?error=$em");
        exit;
    }

    // Insert course
    $sql  = "INSERT INTO COURSE(CName, Credits, CDuration, InstructorId, AdminId)
             VALUES(?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$CName, $Credits, $CDuration, $InstructorId, $AdminId]);

    $sm = "New course created successfully";
    header("Location: ../course-add.php?success=$sm");
    exit;

} else {
    $em = "An error occurred";
    header("Location: ../course-add.php?error=$em");
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
