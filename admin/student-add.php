<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

       include "../DB_connection.php";

       $fname = '';
       $lname = '';
       $uname = '';
       $address = '';
       $email = '';
       $contact = '';

       if (isset($_GET['fname'])) $fname = $_GET['fname'];
       if (isset($_GET['lname'])) $lname = $_GET['lname'];
       if (isset($_GET['username'])) $uname = $_GET['username'];
       if (isset($_GET['address'])) $address = $_GET['address'];
       if (isset($_GET['SMail'])) $email = $_GET['SMail'];
       if (isset($_GET['SContact'])) $contact = $_GET['SContact'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Admin - Add Student</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">
<a href="student.php" class="btn btn-dark">Go Back</a>

<form method="post" class="shadow p-3 mt-5" action="req/student-add.php">
<h3>Add New Student</h3><hr>

<?php if (isset($_GET['error'])) { ?>
  <div class="alert alert-danger"><?= $_GET['error'] ?></div>
<?php } ?>

<?php if (isset($_GET['success'])) { ?>
  <div class="alert alert-success"><?= $_GET['success'] ?></div>
<?php } ?>

<div class="mb-3">
  <label class="form-label">First Name</label>
  <input type="text" class="form-control" name="fname" value="<?=$fname?>">
</div>

<div class="mb-3">
  <label class="form-label">Last Name</label>
  <input type="text" class="form-control" name="lname" value="<?=$lname?>">
</div>

<div class="mb-3">
  <label class="form-label">Username</label>
  <input type="text" class="form-control" name="username" value="<?=$uname?>">
</div>

<div class="mb-3">
  <label class="form-label">Password</label>
  <input type="text" class="form-control" name="password" id="passInput">
  <button class="btn btn-secondary mt-2" id="gBtn">Generate Random</button>
</div>

<div class="mb-3">
  <label class="form-label">Address</label>
  <input type="text" class="form-control" name="address" value="<?=$address?>">
</div>

<div class="mb-3">
  <label class="form-label">Gender</label><br>
  <input type="radio" name="gender" value="Male" checked> Male &nbsp;&nbsp;
  <input type="radio" name="gender" value="Female"> Female
</div>

<div class="mb-3">
  <label class="form-label">Email</label>
  <input type="text" class="form-control" name="SMail" value="<?=$email?>">
</div>

<div class="mb-3">
  <label class="form-label">Contact Number</label>
  <input type="text" class="form-control" name="SContact" value="<?=$contact?>">
</div>

<button class="btn btn-primary">Register</button>

</form>
</div>

<script>
function makePass(length) {
  let result = "";
  let chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
  for (let i = 0; i < length; i++) {
    result += chars.charAt(Math.floor(Math.random() * chars.length));
  }
  document.getElementById('passInput').value = result;
}

document.getElementById('gBtn').addEventListener('click', function(e){
  e.preventDefault();
  makePass(6);
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
