<?php 
session_start();

if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role']) &&
    isset($_GET['InstructorId'])) {

    if ($_SESSION['role'] == 'Admin') {

       include "../DB_connection.php";
       include "data/instructor.php";

       $InstructorId = $_GET['InstructorId'];
       $instructor = getInstructorById($InstructorId, $conn);

       if ($instructor == 0) {
         header("Location: instructor.php");
         exit;
       }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Edit Instructor</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
</head>
<body>
    <?php include "inc/navbar.php"; ?>

     <div class="container mt-5">
        <a href="instructor.php" class="btn btn-dark">Go Back</a>

        <form method="post" class="shadow p-3 mt-5 form-w" action="req/instructor-edit.php">
        <h3>Edit Instructor</h3><hr>

        <?php if (isset($_GET['error'])) { ?>
          <div class="alert alert-danger"><?= $_GET['error'] ?></div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
          <div class="alert alert-success"><?= $_GET['success'] ?></div>
        <?php } ?>

        <div class="mb-3">
          <label class="form-label">First Name</label>
          <input type="text" class="form-control" value="<?= $instructor['fname'] ?>" name="fname">
        </div>

        <div class="mb-3">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control" value="<?= $instructor['lname'] ?>" name="lname">
        </div>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control" value="<?= $instructor['username'] ?>" name="username">
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" class="form-control" value="<?= $instructor['address'] ?>" name="address">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" class="form-control" value="<?= $instructor['IContact'] ?>" name="IContact">
        </div>

        <div class="mb-3">
          <label class="form-label">Qualification</label>
          <input type="text" class="form-control" value="<?= $instructor['qualification'] ?>" name="qualification">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="text" class="form-control" value="<?= $instructor['IMail'] ?>" name="IMail">
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio" name="gender" value="Male" <?= ($instructor['gender']=="Male")?"checked":"" ?>> Male
          &nbsp;&nbsp;&nbsp;
          <input type="radio" name="gender" value="Female" <?= ($instructor['gender']=="Female")?"checked":"" ?>> Female
        </div>

        <input type="hidden" name="InstructorId" value="<?= $InstructorId ?>">

        <button type="submit" class="btn btn-primary">Update</button>
     </form>


     <!-- CHANGE PASSWORD -->
     <form method="post" class="shadow p-3 my-5 form-w" action="req/instructor-change-pass.php">
        <h3>Change Password</h3><hr>

        <?php if (isset($_GET['perror'])) { ?>
            <div class="alert alert-danger"><?= $_GET['perror'] ?></div>
        <?php } ?>

        <?php if (isset($_GET['psuccess'])) { ?>
            <div class="alert alert-success"><?= $_GET['psuccess'] ?></div>
        <?php } ?>

        <div class="mb-3">
            <label class="form-label">Admin Password</label>
            <input type="password" class="form-control" name="admin_pass">
        </div>

        <div class="mb-3">
            <label class="form-label">New Password</label>
            <input type="password" class="form-control" name="new_pass">
        </div>

        <div class="mb-3">
            <label class="form-label">Confirm New Password</label>
            <input type="password" class="form-control" name="c_new_pass">
        </div>

        <input type="hidden" name="InstructorId" value="<?= $InstructorId ?>">

        <button type="submit" class="btn btn-primary">Change</button>
     </form>

     </div>

</body>
</html>
<?php 
    } else {
        header("Location: instructor.php");
        exit;
    }
} else {
	header("Location: instructor.php");
	exit;
}
?>
