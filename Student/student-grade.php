<?php 
session_start();

if (isset($_SESSION['StudentId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {

        include "../DB_connection.php";
        include "data/score.php";     // UPDATED score functions
        include "data/course.php";    // NEW course file

        $StudentId = $_SESSION['StudentId'];
        $scores = getScoresByStudent($StudentId, $conn);   // NEW FUNCTION

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Grade Summary</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">

    <style>
        body { background: #f5f7fb; font-family: 'Segoe UI', sans-serif; }
        .page-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white; padding: 2rem 0; margin-bottom: 2rem; border-radius: 0 0 20px 20px;
        }
        .year-section { background: white; border-radius: 15px; padding: 1rem; margin-bottom: 2rem; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        .quiz-card { border-radius: 10px; border: 1px solid #e0e0e0; margin-bottom: 1rem; }
        .quiz-header { padding: 1rem; background: #f1f3f5; border-bottom: 1px solid #e0e0e0; }
        .quiz-content { padding: 1rem 1.5rem; }
        .badge-sem { background: #f39c12; color:white; padding: 5px 12px; border-radius: 20px; }
        .assessment-badge { background:white; border:1px solid #ccc; padding:5px 10px; border-radius:12px; margin-right:5px; }
        .grade-display {
            margin-top: 1rem; text-align:center; padding:1rem;
            background: linear-gradient(135deg, #1abc9c, #3498db);
            color:white; border-radius:10px;
        }
        .grade-letter { font-size:2rem; font-weight:700; }
        .quiz-card {
    border-radius: 12px;
    border: 1px solid #ddd;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.quiz-header {
    padding: 1rem 1.2rem;
    background: #fff;
    border-bottom: 1px solid #eee;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.quiz-left {
    display: flex;
    flex-direction: column;
}

.quiz-left h5 {
    margin: 0;
    font-size: 1.1rem;
    font-weight: 600;
}

.quiz-left small {
    color: #666;
}

.download-btn {
    margin-left: auto;
}

.badge-sem {
    margin-left: 15px;
    background: #f39c12;
    color: white;
    padding: 8px 15px;
    border-radius: 20px;
    font-size: 0.85rem;
}

    </style>
</head>

<body>

<?php include "inc/navbar.php"; ?>

<?php if ($scores != 0) { ?>

<div class="page-header">
    <div class="container">
        <h1 class="display-6">Grade Summary</h1>
        <p class="lead">View your quiz and course performance</p>
    </div>
</div>

<div class="container">

    <!-- Summary -->
    <div class="p-3 bg-white shadow-sm rounded mb-4">
        <div class="row text-center">
            <div class="col-md-4">
                <h3><?= count($scores) ?></h3>
                <small>Total Assessments</small>
            </div>

            <div class="col-md-4">
                <h3>
                    <?php
                        $years = array_unique(array_column($scores, 'Year'));
                        echo count($years);
                    ?>
                </h3>
                <small>Academic Years</small>
            </div>

            <div class="col-md-4">
                <h3>
                    <?php
                        $pass = 0;
                        foreach ($scores as $s) {
                            $percent = calculatePercentageFromResults($s['Results']);
                            if ($percent >= 40) $pass++;
                        }
                        echo $pass;
                    ?>
                </h3>
                <small>Passed</small>
            </div>
        </div>
    </div>


    <!-- Group by Year -->
    <?php 
        $currentYear = "";
        foreach ($scores as $score) {
            if ($currentYear != $score['Year']) {
                $currentYear = $score['Year'];
    ?>

    <div class="year-section">
        <h3 class="mb-3">Academic Year: <?= $currentYear ?></h3>

        <?php
            foreach ($scores as $quiz) {
                if ($quiz['Year'] != $currentYear) continue;

                $course = getCourseById($quiz['CourseId'], $conn);
                $percent = calculatePercentageFromResults($quiz['Results']);
                $grade = gradeCalc($percent);

                // Parse assessments
                $assessments = explode(",", $quiz['Results']);
        ?>

        <div class="quiz-card">
            <div class="quiz-header">

                    <div class="quiz-left">
                        <h5><?= $course['CName'] ?></h5>
                        <small>Course ID: <?= $course['CourseID'] ?></small>
                    </div>

                    <?php if ($percent >= 40): ?>
                        <a href="req/download-grade.php?course_id=<?= $course['CourseID'] ?>&year=<?= $quiz['Year'] ?>&semester=<?= $quiz['Semester'] ?>"
                        class="btn btn-sm btn-outline-primary download-btn">
                            <i class="fa fa-download"></i> Download Certificate
                        </a>
                    <?php endif; ?>

                    <span class="badge-sem">Semester <?= $quiz['Semester'] ?></span>

            </div>

            <div class="quiz-content">

                <div class="mb-2">
                    <?php foreach ($assessments as $a): ?>
                        <span class="assessment-badge"><?= trim($a) ?></span>
                    <?php endforeach; ?>
                </div>

                <div class="row text-center mb-2">
                    <div class="col-md-4">
                        <strong><?= round($percent, 1) ?>%</strong><br>
                        <small>Percentage</small>
                    </div>

                    <div class="col-md-4">
                        <strong><?= $grade ?></strong><br>
                        <small>Grade</small>
                    </div>

                    <div class="col-md-4">
                        <strong><?= $quiz['Year'] ?></strong><br>
                        <small>Year</small>
                    </div>
                </div>

                <div class="grade-display">
                    <div class="grade-letter"><?= $grade ?></div>
                    <div>Final Grade</div>
                </div>

            </div>
        </div>

        <?php } // end inner foreach ?>

    </div>

    <?php } } ?>

</div>

<?php } else { ?>

<!-- No Grades Yet -->
<div class="container">
    <div class="text-center p-5 bg-white rounded shadow-sm mt-4">
        <h3>No Grades Available</h3>
        <p>Your results will appear here once instructors update your quiz grades.</p>
        <a href="index.php" class="btn btn-primary mt-3">Return to Dashboard</a>
    </div>
</div>

<?php } ?>

</body>
</html>

<?php
    }
} 
else {
    header("Location: ../login.php");
    exit;
}
?>
