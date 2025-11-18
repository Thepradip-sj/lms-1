<?php 
session_start();

if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Instructor') {

        include "../DB_connection.php";
        include "data/course.php";
        include "data/instructor.php";
        include "data/student.php";

        $InstructorId = $_SESSION['InstructorId'];
        $instructor = getInstructorById($InstructorId, $conn);

        // All courses assigned to this instructor
        $courses = getCoursesByInstructor($InstructorId, $conn);
        $students = getStudentsByInstructor($InstructorId, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Dashboard - My Courses</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<style>
    :root { --primary-color: #3498db; --secondary-color: #2c3e50; --accent-color: #1abc9c; --light-bg: #f8f9fa; --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); } body { background-color: #f5f7fb; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; } .page-header { background: linear-gradient(135deg, var(--primary-color), var(--secondary-color)); color: white; padding: 2rem 0; border-radius: 0 0 20px 20px; margin-bottom: 2rem; } .class-card { background: white; border-radius: 15px; box-shadow: var(--card-shadow); transition: all 0.3s ease; border: none; margin-bottom: 1.5rem; overflow: hidden; } .class-card:hover { transform: translateY(-5px); box-shadow: 0 8px 15px rgba(0, 0, 0, 0.15); } .class-header { background: linear-gradient(to right, var(--primary-color), var(--accent-color)); color: white; padding: 1.5rem; } .class-code { font-size: 1.8rem; font-weight: 700; margin-bottom: 0.5rem; } .class-details { padding: 1.5rem; } .detail-item { display: flex; margin-bottom: 1rem; padding-bottom: 1rem; border-bottom: 1px solid #eee; } .detail-label { font-weight: 600; min-width: 120px; color: var(--secondary-color); } .detail-value { color: #555; } .class-actions { padding: 1rem 1.5rem; background-color: var(--light-bg); display: flex; justify-content: space-between; } .action-btn { display: inline-flex; align-items: center; padding: 0.5rem 1rem; background: white; border-radius: 8px; text-decoration: none; color: var(--secondary-color); font-weight: 500; transition: all 0.3s ease; border: 1px solid #e0e0e0; } .action-btn:hover { background: var(--primary-color); color: white; transform: translateY(-2px); } .action-icon { margin-right: 0.5rem; } .empty-state { text-align: center; padding: 3rem 1rem; } .empty-icon { font-size: 4rem; color: #ddd; margin-bottom: 1.5rem; } .empty-title { color: #6c757d; margin-bottom: 1rem; } .stats-summary { background: white; border-radius: 15px; padding: 1.5rem; box-shadow: var(--card-shadow); margin-bottom: 2rem; } .stats-number { font-size: 2.5rem; font-weight: 700; color: var(--primary-color); } .stats-label { color: #6c757d; font-size: 1rem; } @media (max-width: 768px) { .class-actions { flex-direction: column; gap: 0.5rem; } .action-btn { justify-content: center; } }
</style>
</head>

<body>

<?php include "inc/navbar.php"; ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-8">
                <h1 class="display-5">My Courses</h1>
                <p class="lead">Manage and view your assigned courses</p>
            </div>
            <div class="col-md-4 text-md-end">
                <span class="badge bg-light text-dark p-2">
                    Instructor: <?=$instructor['fname']?> <?=$instructor['lname']?>
                </span>
            </div>
        </div>
    </div>
</div>

<div class="container">

    <!-- Stats Summary -->
    <div class="stats-summary">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="stats-number"><?=count($courses)?></div>
                <div class="stats-label">Total Courses Assigned</div>
            </div>

            <div class="col-md-4">
                <div class="stats-number">
                    <?=array_sum(array_column($courses, 'Credits'))?>
                </div>
                <div class="stats-label">Total Credits</div>
            </div>

            <div class="col-md-4">
                <div class="stats-number"><?=count($students)?></div>
                <div class="stats-label">Total Students</div>
            </div>
        </div>
    </div>

    <!-- Courses Grid -->
    <div class="row">

    <?php 
    if ($courses && count($courses) > 0) {
        foreach ($courses as $crs) {
    ?>

        <div class="col-lg-6 col-xl-4">
            <div class="class-card">

                <div class="class-header">
                    <div class="class-code"><?=$crs['CName']?></div>
                    <div>Course ID: <?=$crs['CourseID']?></div>
                </div>

                <div class="class-details">
                    <div class="detail-item">
                        <span class="detail-label">Credits:</span>
                        <span class="detail-value"><?=$crs['Credits']?></span>
                    </div>

                    <div class="detail-item">
                        <span class="detail-label">Duration:</span>
                        <span class="detail-value"><?=$crs['CDuration']?></span>
                    </div>
                </div>

                <div class="class-actions">
                    <a href="students.php?course=<?=$crs['CourseID']?>" class="action-btn">
                        <i class="fa fa-users action-icon"></i> Students
                    </a>

                    <a href="attendance.php?course=<?=$crs['CourseID']?>" class="action-btn">
                        <i class="fa fa-check-square-o action-icon"></i> Attendance
                    </a>

                    <a href="grades.php?course=<?=$crs['CourseID']?>" class="action-btn">
                        <i class="fa fa-pencil action-icon"></i> Grades
                    </a>
                </div>

            </div>
        </div>

    <?php 
        }
    } else { 
    ?>

        <!-- Empty State -->
        <div class="empty-state">
            <div class="empty-icon"><i class="fa fa-inbox"></i></div>
            <h3 class="empty-title">No Courses Assigned</h3>
            <p class="text-muted">You have not been assigned any courses yet.</p>
            <a href="home.php" class="btn btn-primary mt-3">
                <i class="fa fa-home me-2"></i>Return to Dashboard
            </a>
        </div>

    <?php } ?>

    </div>

</div>

<script>
    $(document).ready(function(){
         $("#navLinks li:nth-child(2) a").addClass('active');
    });
</script>

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
