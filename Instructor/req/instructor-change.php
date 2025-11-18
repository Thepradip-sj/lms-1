<?php 
session_start();
if (isset($_SESSION['InstructorId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Instructor') {

        if (isset($_POST['old_pass']) &&
            isset($_POST['new_pass']) &&
            isset($_POST['c_new_pass'])) {

            include '../../DB_connection.php';
            include "../data/instructor.php"; // FIXED

            $old_pass = $_POST['old_pass'];
            $new_pass = $_POST['new_pass'];
            $c_new_pass = $_POST['c_new_pass'];

            $InstructorId = $_SESSION['InstructorId'];

            if (empty($old_pass)) {
                header("Location: ../pass.php?perror=Old password is required");
                exit;
            }
            if (empty($new_pass)) {
                header("Location: ../pass.php?perror=New password is required");
                exit;
            }
            if (empty($c_new_pass)) {
                header("Location: ../pass.php?perror=Confirmation password is required");
                exit;
            }
            if ($new_pass !== $c_new_pass) {
                header("Location: ../pass.php?perror=New password and confirm password do not match");
                exit;
            }

            // USE INSTRUCTOR PASSWORD VERIFY
            if (!instructorPasswordVerify($old_pass, $conn, $InstructorId)) {
                header("Location: ../pass.php?perror=Incorrect old password");
                exit;
            }

            // Hash new password
            $hashed_pass = password_hash($new_pass, PASSWORD_DEFAULT);

            $sql = "UPDATE Instructor SET password=? WHERE InstructorId=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$hashed_pass, $InstructorId]);

            header("Location: ../pass.php?psuccess=Password changed successfully!");
            exit;

        } else {
            header("Location: ../pass.php?perror=Invalid request");
            exit;
        }

    } else {
        header("Location: ../../logout.php");
        exit;
    }

} else {
    header("Location: ../../logout.php");
    exit;
}
?>
