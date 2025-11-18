<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (isset($_GET['searchKey'])) {

            $search_key = $_GET['searchKey'];

            include "../DB_connection.php";
            include "data/student.php";

            $students = searchStudents($search_key, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Search Students</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
</head>
<body>
<?php include "inc/navbar.php"; ?>

<div class="container mt-5">

    <a href="student-add.php" class="btn btn-dark">Add New Student</a>

    <form action="student-search.php" class="mt-3 n-table" method="get">
        <div class="input-group mb-3">
            <input type="text" class="form-control" 
                   name="searchKey" 
                   value="<?= $search_key ?>"
                   placeholder="Search...">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    <?php if (isset($_GET['error'])) { ?>
        <div class="alert alert-danger mt-3 n-table" role="alert">
            <?= $_GET['error'] ?>
        </div>
    <?php } ?>

    <?php if (isset($_GET['success'])) { ?>
        <div class="alert alert-info mt-3 n-table" role="alert">
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
                    <th>Name</th>
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
                            <?= $student['fname'] . " " . $student['lname'] ?>
                        </a>
                    </td>
                    <td><?= $student['username'] ?></td>
                    <td><?= $student['SMail'] ?></td>
                    <td><?= $student['SContact'] ?></td>

                    <td>
                        <a href="student-edit.php?StudentId=<?= $student['StudentId'] ?>" 
                           class="btn btn-warning">Edit</a>

                        <a href="student-delete.php?StudentId=<?= $student['StudentId'] ?>" 
                           class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>
            </tbody>

        </table>
    </div>

<?php } else { ?>

    <div class="alert alert-info w-450 m-5" role="alert">
        No Results Found
        <a href="student.php" class="btn btn-dark">Go Back</a>
    </div>

<?php } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
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