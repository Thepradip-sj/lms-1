<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (isset($_GET['searchKey'])) {

            $search_key = $_GET['searchKey'];
            include "../DB_connection.php";

            // --- SEARCH QUERY LOGIC ---
            $sql = "SELECT * FROM Instructor
                    WHERE InstructorId LIKE ?
                       OR fname LIKE ?
                       OR lname LIKE ?
                       OR username LIKE ?
                       OR IMail LIKE ?
                       OR qualification LIKE ?
                       OR IContact LIKE ?";

            $stmt = $conn->prepare($sql);
            $param = "%$search_key%";
            $stmt->bind_param("sssssss", $param, $param, $param, $param, $param, $param, $param);

            $stmt->execute();
            $result = $stmt->get_result();
            $instructors = $result->fetch_all(MYSQLI_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Search Instructors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-5">
    <a href="instructor-add.php" class="btn btn-dark">Add New Instructor</a>

    <!-- Search Bar -->
    <form action="instructor-search.php" method="get" class="mt-3 n-table">
        <div class="input-group mb-3">
            <input type="text" class="form-control"
                   name="searchKey"
                   value="<?=$search_key?>"
                   placeholder="Search instructors...">
            <button class="btn btn-primary">
                <i class="fa fa-search"></i>
            </button>
        </div>
    </form>

    <?php if (count($instructors) > 0) { ?>

    <div class="table-responsive">
        <table class="table table-bordered mt-3 n-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Instructor ID</th>
                    <th>Name</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Qualification</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=1; foreach ($instructors as $inst) { ?>
                <tr>
                    <td><?=$i++?></td>
                    <td><?=$inst['InstructorId']?></td>
                    <td>
                        <a href="instructor-view.php?InstructorId=<?=$inst['InstructorId']?>">
                            <?=$inst['fname'] . " " . $inst['lname']?>
                        </a>
                    </td>
                    <td><?=$inst['username']?></td>
                    <td><?=$inst['IMail']?></td>
                    <td><?=$inst['IContact']?></td>
                    <td><?=$inst['qualification']?></td>
                    <td>
                        <a href="instructor-edit.php?InstructorId=<?=$inst['InstructorId']?>" class="btn btn-warning">Edit</a>
                        <a href="instructor-delete.php?InstructorId=<?=$inst['InstructorId']?>" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php } else { ?>
        <div class="alert alert-info mt-4">No Results Found
            <a href="instructor.php" class="btn btn-dark ms-3">Go Back</a>
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
