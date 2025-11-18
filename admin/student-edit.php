<?php 
session_start();

if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role'])     &&
    isset($_GET['StudentId'])) {

    if ($_SESSION['role'] == 'Admin') {

       include "../DB_connection.php";
       include "data/student.php";

       $StudentId = $_GET['StudentId'];
       $student = getStudentById($StudentId, $conn);

       if ($student == 0) {
         header("Location: student.php");
         exit;
       }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">
    <a href="student.php" class="btn btn-dark">Go Back</a>

    <form method="post" class="shadow p-3 mt-5 form-w" action="req/student-edit.php">
        <h3>Edit Student Info</h3><hr>

        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger" role="alert">
           <?= $_GET['error'] ?>
          </div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success" role="alert">
           <?= $_GET['success'] ?>
          </div>
        <?php } ?>

        <div class="mb-3">
          <label class="form-label">First name</label>
          <input type="text" class="form-control" 
                 value="<?= $student['fname'] ?>" name="fname">
        </div>

        <div class="mb-3">
          <label class="form-label">Last name</label>
          <input type="text" class="form-control"
                 value="<?= $student['lname'] ?>" name="lname">
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" class="form-control"
                 value="<?= $student['address'] ?>" name="address">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="text" class="form-control"
                 value="<?= $student['SMail'] ?>" name="SMail">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" class="form-control"
                 value="<?= $student['SContact'] ?>" name="SContact">
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio" value="Male" 
                 <?= ($student['gender'] == 'Male') ? 'checked' : '' ?> 
                 name="gender"> Male
          &nbsp;&nbsp;&nbsp;
          <input type="radio" value="Female" 
                 <?= ($student['gender'] == 'Female') ? 'checked' : '' ?> 
                 name="gender"> Female
        </div>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control"
                 value="<?= $student['username'] ?>" name="username">
        </div>

        <input type="hidden" name="StudentId" value="<?= $student['StudentId'] ?>">

        <button type="submit" class="btn btn-primary">Update</button>
    </form>

    <!-- Password Change Form -->
    <form method="post" class="shadow p-3 my-5 form-w" action="req/student-change.php">
        <h3>Change Password</h3><hr>

        <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger" role="alert">
             <?= $_GET['perror'] ?>
            </div>
        <?php } ?>

        <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success" role="alert">
             <?= $_GET['psuccess'] ?>
            </div>
        <?php } ?>

        <div class="mb-3">
            <label class="form-label">Admin password</label>
            <input type="password" class="form-control" name="admin_pass"> 
        </div>

        <div class="mb-3">
            <label class="form-label">New password</label>
            <input type="text" class="form-control" name="new_pass">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm new password</label>
            <input type="text" class="form-control" name="c_new_pass">
        </div>

        <input type="hidden" name="StudentId" value="<?= $student['StudentId'] ?>">

        <button type="submit" class="btn btn-primary">Change</button>
    </form>

</div>

</body>
</html>

<?php 
  } else {
    header("Location: student.php");
    exit;
  }

} else {
	header("Location: student.php");
	exit;
} 
?>
