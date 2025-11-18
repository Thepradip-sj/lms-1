<?php

// Fetch quiz/grade for one student in one course
function getQuizByStudentCourse($studentId, $instructorId, $courseId, $semester, $year, $conn){
    $sql = "SELECT * FROM Quiz
            WHERE StudentId=? AND InstructorId=? AND CourseId=?
            AND Semester=? AND Year=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$studentId, $instructorId, $courseId, $semester, $year]);

    if ($stmt->rowCount() == 1) {
        return $stmt->fetch();
    }
    return 0;
}

// Insert new quiz record
function insertQuiz($studentId, $instructorId, $courseId, $results, $semester, $year, $conn){
    $sql = "INSERT INTO Quiz (StudentId, InstructorId, CourseId, Results, Semester, Year)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$studentId, $instructorId, $courseId, $results, $semester, $year]);
}

// Update existing quiz record
function updateQuiz($quizId, $results, $conn){
    $sql = "UPDATE Quiz SET Results=? WHERE QuizId=?";
    $stmt = $conn->prepare($sql);
    return $stmt->execute([$results, $quizId]);
}

?>
