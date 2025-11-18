<?php 
session_start();

if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] === 'Instructor') {

        include "../DB_connection.php";
        include "data/instructor.php";
        include "data/course.php";
        include "data/student.php";

        $InstructorId = $_SESSION['InstructorId'];
        $Instructor = getInstructorById($InstructorId, $conn);

        // Get courses for this instructor
        $courses = getCoursesByInstructor($InstructorId, $conn);
        $students = getStudentsByInstructor($InstructorId, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Instructor Dashboard</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
	<link rel="stylesheet" href="../css/style.css">
	<link rel="icon" href="../logo.png">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<?php if ($Instructor != 0) { ?>

<div class="container my-4">

    <h1 class="mb-4">Welcome, <?= $Instructor['fname'] ?>!</h1>

    <!-- Profile Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Your Profile</h4>
        </div>
        <div class="card-body">

            <div class="row mb-3">
                <div class="col-md-6"><strong>Name:</strong> <?= $Instructor['fname']." ".$Instructor['lname'] ?></div>
                <div class="col-md-6"><strong>Username:</strong> @<?= $Instructor['username'] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6"><strong>Email:</strong> <?= $Instructor['IMail'] ?></div>
                <div class="col-md-6"><strong>Contact:</strong> <?= $Instructor['IContact'] ?></div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6"><strong>Qualification:</strong> <?= $Instructor['qualification'] ?></div>
                <div class="col-md-6"><strong>Gender:</strong> <?= $Instructor['gender'] ?></div>
            </div>

            <strong>Address:</strong> <?= $Instructor['address'] ?>
        </div>
    </div>


    <!-- Courses Section -->
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Your Courses</h4>
        </div>
        <div class="card-body">

            <?php if (count($courses) > 0) { ?>

                <div class="list-group">
                <?php foreach ($courses as $course) { ?>
                    
                    <a href="students-of-course.php?course_id=<?= $course['CourseID'] ?>" 
                       class="list-group-item list-group-item-action d-flex justify-content-between">
                        <div>
                            <strong><?= $course['CName'] ?></strong><br>
                            <small>Credits: <?= $course['Credits'] ?> | Duration: <?= $course['CDuration'] ?></small>
                        </div>

                        <button class="btn btn-outline-primary btn-sm">View Students</button>
                    </a>

                <?php } ?>
                </div>

            <?php } else { ?>

                <div class="alert alert-info">You are not assigned to any courses yet.</div>

            <?php } ?>

        </div>
    </div>


    <!-- Quick Actions -->
    <div class="card shadow-sm">
        <div class="card-header bg-dark text-white">
            <h4 class="mb-0">Quick Actions</h4>
        </div>
        <div class="card-body">

            <a href="pass.php" class="btn btn-primary me-2">Change Password</a>
            <a href="quiz.php" class="btn btn-secondary me-2">Manage Quizzes</a>

        </div>
    </div>

</div>

<?php } else { ?>
    <script>window.location.href = "../login.php";</script>
<?php } ?>

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
