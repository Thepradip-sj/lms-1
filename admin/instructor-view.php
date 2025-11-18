<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (isset($_GET['InstructorId'])) {

            include "../DB_connection.php";

            $id = $_GET['InstructorId'];

            // Fetch instructor
            $sql = "SELECT * FROM Instructor WHERE InstructorId = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            $inst = $result->fetch_assoc();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Instructor Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">

<?php if ($inst) { ?>
    
    <div class="card" style="width: 22rem;">
        <img src="../img/teacher-<?=strtolower($inst['gender'])?>.png" 
             class="card-img-top" alt="Instructor">

        <div class="card-body">
            <h5 class="card-title text-center">@<?=$inst['username']?></h5>
        </div>

        <ul class="list-group list-group-flush">
            <li class="list-group-item"><strong>Instructor ID:</strong> <?=$inst['InstructorId']?></li>
            <li class="list-group-item"><strong>First Name:</strong> <?=$inst['fname']?></li>
            <li class="list-group-item"><strong>Last Name:</strong> <?=$inst['lname']?></li>
            <li class="list-group-item"><strong>Username:</strong> <?=$inst['username']?></li>
            <li class="list-group-item"><strong>Email:</strong> <?=$inst['IMail']?></li>
            <li class="list-group-item"><strong>Contact:</strong> <?=$inst['IContact']?></li>
            <li class="list-group-item"><strong>Qualification:</strong> <?=$inst['qualification']?></li>
            <li class="list-group-item"><strong>Gender:</strong> <?=$inst['gender']?></li>
            <li class="list-group-item"><strong>Address:</strong> <?=$inst['address']?></li>
        </ul>

        <div class="card-body">
            <a href="instructor.php" class="card-link">Go Back</a>
        </div>
    </div>

<?php } else { ?>

    <div class="alert alert-warning mt-5">Instructor not found!</div>
    <a href="instructor.php" class="btn btn-dark">Go Back</a>

<?php } ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $(document).ready(function(){
        $("#navLinks li:nth-child(2) a").addClass('active');
    });
</script>

</body>
</html>

<?php 
        } else {
            header("Location: instructor.php");
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
