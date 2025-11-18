<?php 
session_start();

if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Instructor') {

        include "../DB_connection.php";
        include "data/student.php";
        include "data/course.php";
        include "data/quiz.php";

        // FIXED: Use correct parameter names
        if (!isset($_GET['student_id']) || !isset($_GET['course_id'])) {
            header("Location: courses.php");
            exit;
        }

        $studentId = $_GET['student_id'];
        $courseId  = $_GET['course_id'];

        $student = getStudentById($studentId, $conn);
        $course  = getCourseById($courseId, $conn);

        $semester = "1";
        $year = date("Y");

        $instructorId = $_SESSION['InstructorId'];

        // Get quiz record
        $quiz = getQuizByStudentCourse($studentId, $instructorId, $courseId, $semester, $year, $conn);

        // Parse quiz results
        $scores = [];
        if ($quiz) {
            $parts = explode(",", $quiz['Results']);
            foreach ($parts as $val) {
                $scores[] = explode(" ", trim($val));
            }
        }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Course Grade - <?=$student['fname']?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="container mt-4">

    <h2><?=$course['CName']?> — Grade Entry</h2>
    <p><b>Student:</b> <?=$student['fname']?> <?=$student['lname']?></p>
    <p><b>Semester:</b> <?=$semester?> | <b>Year:</b> <?=$year?></p>

    <form method="post" action="req/save-quiz.php">
        
        <div class="card p-3 mt-3">
            <h5>Assessments (max 5)</h5>

            <?php for ($i = 1; $i <= 5; $i++): ?>
                <div class="row mb-2">
                    <label class="col-md-3">Assessment <?=$i?>:</label>
                    
                    <div class="col-md-3">
                        <input type="number" 
                               class="form-control"
                               name="score-<?=$i?>"
                               placeholder="Score"
                               value="<?=isset($scores[$i-1][0]) ? $scores[$i-1][0] : ''?>">
                    </div>

                    <div class="col-md-3">
                        <input type="number" 
                               class="form-control"
                               name="outof-<?=$i?>"
                               placeholder="Out of"
                               value="<?=isset($scores[$i-1][1]) ? $scores[$i-1][1] : ''?>">
                    </div>
                </div>
            <?php endfor ?>
        </div>

        <br>

        <input type="hidden" name="student_id" value="<?=$studentId?>">
        <input type="hidden" name="course_id" value="<?=$courseId?>">
        <input type="hidden" name="semester" value="<?=$semester?>">
        <input type="hidden" name="year" value="<?=$year?>">

        <button class="btn btn-primary mt-3">Save Grades</button>

    </form>
</div>

</body>
</html>

<?php
    }
} else {
    header("Location: ../login.php");
    exit;
}
?>
