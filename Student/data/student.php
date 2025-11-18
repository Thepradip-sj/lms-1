<?php

// Get ALL Students
function getAllStudents($conn){
    $sql = "SELECT * FROM students";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    return ($stmt->rowCount() > 0) ? $stmt->fetchAll() : 0;
}


// Get student by ID
function getStudentById($id, $conn){
    $sql = "SELECT * FROM students WHERE StudentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    return ($stmt->rowCount() == 1) ? $stmt->fetch() : 0;
}


// Check if username is unique
function unameIsUnique($username, $conn, $studentId = 0){
    $sql = "SELECT username, StudentId FROM students WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$username]);

    if ($studentId == 0) {
        return ($stmt->rowCount() == 0) ? 1 : 0;
    } 
    else {
        if ($stmt->rowCount() == 1) {
            $student = $stmt->fetch();
            return ($student['StudentId'] == $studentId) ? 1 : 0;
        } 
        return 1;
    }
}


// Verify student password
function studentPasswordVerify($password, $conn, $studentId){
    $sql = "SELECT password FROM students WHERE StudentId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$studentId]);

    if ($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        return password_verify($password, $row['password']);
    }

    return false;
}

?>
