<?php 
session_start();

if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Instructor') {

        include "../DB_connection.php";
        include "data/student.php";
        include "data/course.php";

        if (!isset($_GET['course'])) {
            header("Location: courses.php");
            exit;
        }

        $course_id = $_GET['course'];

        // Get course details
        $course = getCourseById($course_id, $conn);

        // Get all students enrolled in this course
        $students = getStudentsByCourse($course_id, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Students</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
</head>

<body>

<?php include "inc/navbar.php"; ?>

<div class="page-header">
    <div class="container">
        <h1 class="display-5">Students in <?=$course['CName']?></h1>
        <p class="lead">Manage the students enrolled in this course</p>
        <a href="courses.php" class="btn btn-light">
            <i class="fa fa-arrow-left me-2"></i>Back to Courses
        </a>
    </div>
</div>

<div class="container">

    <!-- Course Overview Card -->
    <div class="class-info-card">
        <h2><?=$course['CName']?></h2>
        <p><b>Credits:</b> <?=$course['Credits']?></p>
        <p><b>Duration:</b> <?=$course['CDuration']?></p>
        <p><b>Total Students:</b> <?=count($students)?></p>
    </div>

    <!-- Students Table -->
    <?php if (count($students) > 0) { ?>

        <div class="students-table-container">
            <div class="table-header">
                <h4 class="table-title">Enrolled Students</h4>
            </div>

            <div class="table-responsive">
                <table class="table student-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Student</th>
                            <th>ID</th>
                            <th>Email</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php 
                        $i = 0;
                        foreach ($students as $stu) { 
                            $i++;
                        ?>
                        <tr>
                            <td><?=$i?></td>
                            <td>
                                <?=$stu['fname']?> <?=$stu['lname']?>
                            </td>
                            <td><?=$stu['StudentId']?></td>
                            <td><?=$stu['SMail']?></td>
                            <td><?=$stu['SContact']?></td>
                            <td>
                                <a href="student-course-grade.php?student_id=<?=$stu['StudentId']?>&course=<?=$course_id?>" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil"></i> Grades
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>

    <?php } else { ?>

        <div class="empty-state">
            <div class="empty-icon"><i class="fa fa-users"></i></div>
            <h3>No Students Found</h3>
            <p>No students are enrolled in this course yet.</p>
        </div>

    <?php } ?>

</div>

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