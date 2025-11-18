<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        include "../DB_connection.php";

        // Fetch all instructors
        $sql = "SELECT * FROM Instructor ORDER BY InstructorId DESC";
        $result = $conn->query($sql);

        $instructors = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $instructors[] = $row;
            }
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Instructors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">

    <a href="instructor-add.php" class="btn btn-dark">Add New Instructor</a>

    <form action="instructor-search.php" method="get" class="mt-3 n-table">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="searchKey" placeholder="Search...">
            <button class="btn btn-primary">
                <i class="fa fa-search" aria-hidden="true"></i>
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

    <?php if (!empty($instructors)) { ?>

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
                        <th>Qualification</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                <?php $i = 0; foreach ($instructors as $inst) { $i++; ?>
                    <tr>
                        <th><?= $i ?></th>
                        <td><?= $inst['InstructorId'] ?></td>

                        <td>
                            <a href="instructor-view.php?InstructorId=<?= $inst['InstructorId'] ?>">
                                <?= $inst['fname'] ?>
                            </a>
                        </td>

                        <td><?= $inst['lname'] ?></td>
                        <td><?= $inst['username'] ?></td>
                        <td><?= $inst['IMail'] ?></td>
                        <td><?= $inst['IContact'] ?></td>
                        <td><?= $inst['qualification'] ?></td>

                        <td>
                            <a href="instructor-edit.php?InstructorId=<?= $inst['InstructorId'] ?>" 
                               class="btn btn-warning">Edit</a>

                            <a href="instructor-delete.php?InstructorId=<?= $inst['InstructorId'] ?>" 
                               class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php } ?>

                </tbody>
            </table>
        </div>

    <?php } else { ?>

        <div class="alert alert-info mt-5 w-450" role="alert">
            No Instructors Found!
        </div>

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
        header("Location: ../login.php");
        exit;
    }

} else {
    header("Location: ../login.php");
    exit;
}

?>
