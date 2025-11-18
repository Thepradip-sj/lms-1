<?php

// Get ALL quiz scores of a student (sorted by latest year/semester)
function getScoresByStudent($studentId, $conn) {
    $sql = "SELECT q.*, c.CName, i.fname AS instructor_fname, i.lname AS instructor_lname
            FROM Quiz q
            INNER JOIN COURSE c ON q.CourseId = c.CourseID
            INNER JOIN Instructor i ON q.InstructorId = i.InstructorId
            WHERE q.StudentId = ?
            ORDER BY q.Year DESC, q.Semester DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$studentId]);

    return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : 0;
}


// Get quiz score for a single student in a course (latest)
function getScoreByStudentCourse($studentId, $courseId, $conn) {
    $sql = "SELECT * FROM Quiz
            WHERE StudentId = ? AND CourseId = ?
            ORDER BY Year DESC, Semester DESC
            LIMIT 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$studentId, $courseId]);

    return ($stmt->rowCount() == 1) ? $stmt->fetch() : 0;
}


// Convert marks to letter grade (same scale as before)
function gradeCalc($grade){
    if ($grade >= 92) return "A+";
    if ($grade >= 86) return "A";
    if ($grade >= 80) return "A-";
    if ($grade >= 75) return "B+";
    if ($grade >= 70) return "B";
    if ($grade >= 66) return "B-";
    if ($grade >= 60) return "C";
    if ($grade >= 55) return "C-";
    if ($grade >= 50) return "D+";
    if ($grade >= 45) return "D";
    if ($grade >= 40) return "D-";
    return "F";
}


// Calculate percentage from quiz results (e.g. "10 20, 15 20")
function calculatePercentageFromResults($results) {
    if (!$results || trim($results) == "") return 0;

    $entries = explode(",", $results);

    $obtained = 0;
    $total = 0;

    foreach ($entries as $entry) {
        $e = trim($entry);
        if ($e == "") continue;

        list($score, $outof) = explode(" ", $e);

        $obtained += floatval($score);
        $total    += floatval($outof);
    }

    if ($total == 0) return 0;

    return ($obtained / $total) * 100;
}

?>
