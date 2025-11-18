<?php 
session_start();
if (isset($_SESSION['AdminId']) && 
    isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {
       include "../DB_connection.php";
       include "data/course.php";
       include "data/instructor.php";

       $courses = getAllCourses($conn);
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin - Courses</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <?php include "inc/navbar.php"; ?>

     <div class="container mt-5">
        <a href="course-add.php" class="btn btn-dark">Add New Course</a>

        <?php if (isset($_GET['error'])) { ?>
            <div class="alert alert-danger mt-3 n-table"><?=$_GET['error']?></div>
        <?php } ?>

        <?php if (isset($_GET['success'])) { ?>
            <div class="alert alert-info mt-3 n-table"><?=$_GET['success']?></div>
        <?php } ?>

        <?php if ($courses != 0) { ?>
        <div class="table-responsive">
            <table class="table table-bordered mt-3 n-table">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Course</th>
                    <th>Credits</th>
                    <th>Duration</th>
                    <th>Instructor</th>
                    <th>Action</th>
                  </tr>
                </thead>
                
                <tbody>
                    <?php 
                    $allInstructors = getAllInstructors($conn);

                    $i = 0; 
                    foreach ($courses as $course) { 
                        $i++; 
                        
                        // default (if instructor not found)
                        $inst = [
                            'fname' => 'N/A',
                            'lname' => ''
                        ];

                        // find matching instructor
                        foreach ($allInstructors as $one) {
                            if ($one['InstructorId'] == $course['InstructorId']) {
                                $inst = $one;
                                break;
                            }
                        }
                    ?>
                    <tr>
                        <th><?= $i ?></th>
                        <td><?= $course['CName'] ?></td>
                        <td><?= $course['Credits'] ?></td>
                        <td><?= $course['CDuration'] ?></td>

                        <td><?= $inst['fname'] . ' ' . $inst['lname'] ?></td>

                        <td>
                            <a href="course-edit.php?CourseID=<?= $course['CourseID'] ?>" class="btn btn-warning">Edit</a>
                            <a href="course-delete.php?CourseID=<?= $course['CourseID'] ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>
              </tbody>
            </table>
        </div>
        <?php } else { ?>
            <div class="alert alert-info m-5">Empty!</div>
        <?php } ?>

     </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>	
<script>
    $(document).ready(function(){
        $("#navLinks li:nth-child(6) a").addClass('active');
    });
</script>

</body>
</html>
<?php 
  } else { header("Location: ../login.php"); exit; }
} else {
	header("Location: ../login.php"); exit;
}
?>
