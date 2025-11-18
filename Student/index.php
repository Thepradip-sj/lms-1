<?php 
session_start();

if (isset($_SESSION['StudentId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Student') {

        include "../DB_connection.php";
        include "data/student.php";
        include "data/course.php";

        $StudentId = $_SESSION['StudentId'];
        $student = getStudentById($StudentId, $conn);

        // Fetch all courses
        $courses = getAllCourses($conn);

        // Fetch student's enrolled courses
        $enrolled = getEnrolledCourses($StudentId, $conn);
        $enrolledIds = array_column($enrolled, 'CourseId');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Home</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">

    <style>
        body {
            background: #f5f7fb;
            font-family: 'Segoe UI', sans-serif;
        }

        .page-header {
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 2rem;
            border-radius: 0 0 20px 20px;
            margin-bottom: 2rem;
        }

        .course-card {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.08);
            transition: 0.3s;
            height: 100%;
        }

        .course-card:hover {
            transform: translateY(-5px);
        }

        .course-title {
            font-weight: 700;
            font-size: 1.2rem;
            color: #2c3e50;
        }

        .enrolled-badge {
            background: #2ecc71;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85rem;
        }

        .btn-enroll {
            background: #3498db;
            color: white;
            border-radius: 8px;
            padding: 8px 15px;
            text-decoration: none;
        }

        .btn-enroll:hover {
            background: #2c3e50;
            color: white;
        }
    </style>
</head>

<body>

<?php include "inc/navbar.php"; ?>

<div class="page-header">
    <div class="container">
        <h1 class="display-6">Welcome, <?= $student['fname'] ?>!</h1>
        <p>Your Courses & Enrollment Status</p>
    </div>
</div>

<div class="container">

    <h3 class="mb-3">Available Courses</h3>

    <div class="row">

        <?php foreach ($courses as $course): ?>

        <div class="col-md-6 col-lg-4 mb-4">
            <div class="course-card">

                <div class="course-title"><?= $course['CName'] ?></div>

                <p class="mt-2 mb-1"><strong>Credits:</strong> <?= $course['Credits'] ?></p>
                <p class="mb-3"><strong>Duration:</strong> <?= $course['CDuration'] ?></p>

                <div class="mt-3">
                    <?php if (in_array($course['CourseID'], $enrolledIds)): ?>

                        <span class="enrolled-badge">Enrolled</span>

                    <?php else: ?>

                        <a href="req/enroll.php?course_id=<?= $course['CourseID'] ?>" class="btn-enroll">
                            Enroll Now
                        </a>

                    <?php endif; ?>
                </div>

            </div>
        </div>

        <?php endforeach; ?>

    </div>

</div>

</body>

</html>

<?php 
    } else {
        header("Location: ../login.php"); exit;
    }

} else {
    header("Location: ../login.php"); exit;
}
?>
<script>
function changeToEnrolled(btn) {
    // Immediately change text
    btn.textContent = "Enrolled";

    // Disable the button so user cannot click again
    btn.style.pointerEvents = "none";
    btn.style.opacity = "0.6";
}
</script>
