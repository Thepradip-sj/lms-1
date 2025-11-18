<?php
session_start();

if (isset($_SESSION['InstructorId']) && isset($_POST['student_id'])) {

    include "../../DB_connection.php";
    include "../data/quiz.php";

    $studentId = $_POST['student_id'];
    $courseId  = $_POST['course_id'];
    $instructorId = $_SESSION['InstructorId'];
    $semester = $_POST['semester'];
    $year = $_POST['year'];

    // Build result string
    $results = "";
    for ($i = 1; $i <= 5; $i++) {
        $score = trim($_POST["score-$i"]);
        $outof = trim($_POST["outof-$i"]);

        if ($score !== "" && $outof !== "") {
            $results .= "$score $outof, ";
        }
    }
    $results = trim($results, ", ");

    // Check if quiz exists
    $existing = getQuizByStudentCourse($studentId, $instructorId, $courseId, $semester, $year, $conn);

    if ($existing) {
        updateQuiz($existing['QuizId'], $results, $conn);
        $msg = "Grades updated successfully!";
    } else {
        insertQuiz($studentId, $instructorId, $courseId, $results, $semester, $year, $conn);
        $msg = "Grades saved successfully!";
    }

    header("Location: ../student-course-grade.php?student_id=$studentId&course=$courseId&success=$msg");
    exit;

} else {
    header("Location: ../courses.php");
    exit;
}
