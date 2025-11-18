<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";
        include "data/student.php";

        if (isset($_GET['StudentId'])) {

            $student_id = $_GET['StudentId'];
            $student = getStudentById($student_id, $conn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin – View Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<?php if ($student != 0) { ?>

<div class="container mt-5">
    <div class="card" style="max-width: 22rem;">
        
        <img src="../img/student-<?= $student['gender'] ?>.png" 
             class="card-img-top">

        <div class="card-body">
            <h5 class="card-title text-center">@<?= $student['username'] ?></h5>
        </div>

        <ul class="list-group list-group-flush">

            <li class="list-group-item">
                <strong>First Name:</strong> <?= $student['fname'] ?>
            </li>

            <li class="list-group-item">
                <strong>Last Name:</strong> <?= $student['lname'] ?>
            </li>

            <li class="list-group-item">
                <strong>Username:</strong> <?= $student['username'] ?>
            </li>

            <li class="list-group-item">
                <strong>Email:</strong> <?= $student['SMail'] ?>
            </li>

            <li class="list-group-item">
                <strong>Contact:</strong> <?= $student['SContact'] ?>
            </li>

            <li class="list-group-item">
                <strong>Address:</strong> <?= $student['address'] ?>
            </li>

            <li class="list-group-item">
                <strong>Gender:</strong> <?= $student['gender'] ?>
            </li>

        </ul>

        <div class="card-body">
            <a href="student.php" class="btn btn-dark">Go Back</a>
        </div>

    </div>
</div>

<?php } else { 
        header("Location: student.php");
        exit;
      } ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
         $("#navLinks li:nth-child(3) a").addClass('active');
    });
</script>

</body>
</html>

<?php 
        } else {
            header("Location: student.php");
            exit;
        }

    } else {
        header("Location: ../login.php");
        exit;
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>