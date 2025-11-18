<?php
session_start();
if (!isset($_SESSION['InstructorId']) || $_SESSION['role'] !== 'Instructor') {
    header("Location: ../login.php");
    exit;
}

include "../DB_connection.php";
include "data/course.php";
include "data/student.php";
include "data/instructor.php";

$InstructorId = $_SESSION['InstructorId'];
$courses = getCoursesByInstructor($InstructorId, $conn);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Grade Center</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>

<body>
<?php include "inc/navbar.php"; ?>

<div class="container mt-4">
    <h2>Students Grade Center</h2>
    <p>Select a course to view enrolled students.</p>

    <?php if ($courses && count($courses) > 0) { ?>
    
        <?php foreach ($courses as $crs) { ?>
            <div class="card mb-3 shadow-sm">
                <div class="card-header bg-primary text-white">
                    <strong><?= $crs['CName'] ?></strong>
                </div>
                <div class="card-body">
                    <?php
                        $students = getStudentsByCourse($crs['CourseID'], $conn);
                        if (!$students) {
                            echo "<p class='text-muted'>No students enrolled.</p>";
                        } else {
                    ?>
                    <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Grade</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($students as $std) { ?>
                                    <tr>
                                        <td><?= $std['fname'] . " " . $std['lname'] ?></td>
                                        <td>@<?= $std['username'] ?></td>
                                        <td><?= $std['SMail'] ?></td>
                                        <td><?= $std['SContact'] ?></td>

                                        <td>
                                            <a href="student-course-grade.php?student_id=<?= $std['StudentId'] ?>&course_id=<?= $crs['CourseID'] ?>"
                                            class="btn btn-sm btn-success">
                                                Enter Grades
                                            </a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>


                    <?php } ?>
                </div>
            </div>
        <?php } ?>

    <?php } else { ?>
        <div class="alert alert-info">No courses assigned to you.</div>
    <?php } ?>
</div>

</body>
</html>
