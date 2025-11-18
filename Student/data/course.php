<?php

// Get ALL Courses
function getAllCourses($conn){
    $sql = "SELECT * FROM COURSE";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : 0;
}

function getEnrolledCourses($studentId, $conn) {
    $sql = "SELECT CourseId FROM Enrolls_In WHERE StudentId=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$studentId]);
    return $stmt->fetchAll();
}

// Get Course by ID
function getCourseById($courseId, $conn){
    $sql = "SELECT * FROM COURSE WHERE CourseID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$courseId]);

    return ($stmt->rowCount() == 1) ? $stmt->fetch() : 0;
}


// Get ALL Courses taught by a specific instructor
function getCoursesByInstructor($instructorId, $conn){
    $sql = "SELECT * FROM COURSE WHERE InstructorId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$instructorId]);

    return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : 0;
}


// Check if a course name already exists (optional function)
function courseNameExists($name, $conn, $courseId = 0){
    $sql = "SELECT CName, CourseID FROM COURSE WHERE CName = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$name]);

    if ($courseId == 0) {
        return ($stmt->rowCount() > 0) ? 1 : 0;
    } else {
        if ($stmt->rowCount() == 1) {
            $course = $stmt->fetch();
            return ($course['CourseID'] == $courseId) ? 0 : 1;
        }
        return 0;
    }
}

?>
