<?php
session_start();

if (!isset($_SESSION['StudentId'])) {
    header("Location: ../login.php");
    exit;
}

include "../../DB_connection.php";
include "../data/course.php";
include "../data/score.php";

$studentId = $_SESSION['StudentId'];

if (!isset($_GET['course_id'])) {
    die("Missing Course ID");
}

$courseId = $_GET['course_id'];
$year     = $_GET['year'];
$semester = $_GET['semester'];

// Get student & course info
$course = getCourseById($courseId, $conn);
$scores = getScoreByStudentCourse($studentId, $courseId, $conn);

if (!$scores) {
    die("No grade data found.");
}

// Calculations
$percent = calculatePercentageFromResults($scores['Results']);
$grade   = gradeCalc($percent);

// Create PDF
header("Content-Type: application/pdf");
header("Content-Disposition: attachment; filename=Grade_Report_{$course['CName']}.pdf");

echo "
Grade Report
-------------------------
Student ID: $studentId
Course Name: {$course['CName']}
Course ID: {$course['CourseID']}

Semester: $semester
Year: $year

Percentage: " . round($percent,1) . " %
Grade: $grade

Assessments:
{$scores['Results']}

-------------------------
Generated from LMS System
";

exit;
?>
