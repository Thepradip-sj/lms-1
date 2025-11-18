<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";

        // --- Prefill variables if redirected with error ---
        $fname = $_GET['fname'] ?? '';
        $lname = $_GET['lname'] ?? '';
        $uname = $_GET['uname'] ?? '';
        $address = $_GET['address'] ?? '';
        $IContact = $_GET['contact'] ?? '';
        $qualification = $_GET['qualification'] ?? '';
        $IMail = $_GET['email'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Add Instructor</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>

    <div class="container mt-5">
        <a href="instructor.php" class="btn btn-dark">Go Back</a>

        <form method="post"
              class="shadow p-3 mt-5 form-w"
              action="req/instructor-add.php">

        <h3>Add New Instructor</h3><hr>

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
          <label class="form-label">First Name</label>
          <input type="text" class="form-control"
                 name="fname"
                 value="<?= $fname ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Last Name</label>
          <input type="text" class="form-control"
                 name="lname"
                 value="<?= $lname ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Username</label>
          <input type="text" class="form-control"
                 name="username"
                 value="<?= $uname ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Password</label>
          <div class="input-group mb-3">
              <input type="text" 
                     class="form-control"
                     name="pass"
                     id="passInput">
              <button class="btn btn-secondary" id="gBtn">
                Random
              </button>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Address</label>
          <input type="text" class="form-control"
                 name="address"
                 value="<?= $address ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Contact Number</label>
          <input type="text" class="form-control"
                 name="IContact"
                 value="<?= $IContact ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Qualification</label>
          <input type="text" class="form-control"
                 name="qualification"
                 value="<?= $qualification ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control"
                 name="IMail"
                 value="<?= $IMail ?>">
        </div>

        <div class="mb-3">
          <label class="form-label">Gender</label><br>
          <input type="radio" name="gender" value="Male" checked> Male
          &nbsp;&nbsp;&nbsp;
          <input type="radio" name="gender" value="Female"> Female
        </div>

        <button type="submit" class="btn btn-primary">Add Instructor</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Highlight nav
        $(document).ready(function() {
            $("#navLinks li:nth-child(2) a").addClass('active');
        });

        // Random password generator
        function makePass(length) {
            var result = '';
            var chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            for (var i = 0; i < length; i++) {
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
