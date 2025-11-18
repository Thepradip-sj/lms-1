<?php 
session_start();

if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Instructor') {

        include "../DB_connection.php";
        include "data/instructor.php";
        include "data/course.php";
        include "data/student.php";

        $InstructorId = $_SESSION['InstructorId'];
        $Instructor = getInstructorById($InstructorId, $conn);

        // Get instructor's courses
        $courses = getCoursesByInstructor($InstructorId, $conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor - Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="icon" href="../logo.png">
</head>
<body>

<?php include "inc/navbar.php"; ?>

<div class="page-header bg-primary text-white py-4 mb-4">
    <div class="container">
        <h1 class="display-6">Manage Students</h1>
        <p class="lead mb-0">View all students enrolled in your courses</p>
    </div>
</div>

<div class="container">

    <!-- Search Bar -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <h5>Search Students</h5>
            <input type="text" class="form-control" id="searchInput" placeholder="Search by student name or course name...">
        </div>
    </div>

    <!-- Courses List -->
    <?php if (count($courses) > 0) { ?>
    
    <div class="row" id="courseContainer">

        <?php foreach ($courses as $course) { 
            // Get enrolled students
            $students = getStudentsByCourse($course['CourseID'], $conn);
        ?>
        
        <div class="col-lg-6 mb-4 course-card-container">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><?= $course['CName'] ?></h5>
                </div>
                <div class="card-body">

                    <p><strong>Credits:</strong> <?= $course['Credits'] ?></p>
                    <p><strong>Duration:</strong> <?= $course['CDuration'] ?></p>
                    <p><strong>Enrolled Students:</strong> <?= count($students) ?></p>

                    <?php if (count($students) > 0) { ?>
                    <ul class="list-group mt-3">
                        <?php foreach ($students as $student) { ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <?= $student['fname'] . " " . $student['lname'] ?>
                            <a href="student-view.php?student_id=<?= $student['StudentId'] ?>&course_id=<?= $course['CourseID'] ?>" 
                               class="btn btn-primary btn-sm">View</a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } else { ?>
                        <div class="alert alert-info mt-3">No students enrolled yet.</div>
                    <?php } ?>

                </div>
            </div>
        </div>

        <?php } ?>

    </div>

    <?php } else { ?>

        <div class="alert alert-info text-center">
            You have no assigned courses.
        </div>

    <?php } ?>

</div>

<script>
document.getElementById('searchInput').addEventListener('input', function(){
    const search = this.value.toLowerCase();
    document.querySelectorAll('.course-card-container').forEach(card => {
        const text = card.innerText.toLowerCase();
        card.style.display = text.includes(search) ? '' : 'none';
    });
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
