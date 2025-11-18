<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

       include "../DB_connection.php";
       include "data/student.php";

       $students = getAllStudents($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Students</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">

    <a href="student-add.php" class="btn btn-dark">Add New Student</a>

    <form action="student-search.php" method="get" class="mt-3 n-table">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="searchKey" placeholder="Search...">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger mt-3 n-table">
            <?= $_GET['error'] ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-info mt-3 n-table">
            <?= $_GET['success'] ?>
        </div>
    <?php } ?>

    <?php if ($students != 0) { ?>

    <div class="table-responsive">
        <table class="table table-bordered mt-3 n-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>

            <?php $i = 0; foreach ($students as $student) { $i++; ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $student['StudentId'] ?></td>

                    <td>
                        <a href="student-view.php?StudentId=<?= $student['StudentId'] ?>">
                            <?= $student['fname'] ?>
                        </a>
                    </td>

                    <td><?= $student['lname'] ?></td>
                    <td><?= $student['username'] ?></td>
                    <td><?= $student['SMail'] ?></td>
                    <td><?= $student['SContact'] ?></td>

                    <td>
                        <a href="student-edit.php?StudentId=<?= $student['StudentId'] ?>" 
                           class="btn btn-warning btn-sm">Edit</a>

                        <a href="student-delete.php?StudentId=<?= $student['StudentId'] ?>" 
                           class="btn btn-danger btn-sm">Delete</a>
                    </td>
                </tr>
            <?php } ?>

            </tbody>
        </table>
    </div>

    <?php } else { ?>

        <div class="alert alert-info mt-5 w-450">
            No students found.
        </div>

    <?php } ?>

</div>

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
        header("Location: ../login.php");
        exit;
    }

} else {
    header("Location: ../login.php");
    exit;
}

?>
