<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['admin_pass']) &&
            isset($_POST['new_pass']) &&
            isset($_POST['c_new_pass']) &&
            isset($_POST['StudentId'])
        ) {

            include '../../DB_connection.php';
            include "../data/admin.php";

            $admin_pass = $_POST['admin_pass'];
            $new_pass = $_POST['new_pass'];
            $c_new_pass = $_POST['c_new_pass'];

            // Correct name
            $student_id = $_POST['StudentId'];  

            // Correct session variable
            $id = $_SESSION['AdminId'];          

            // For redirect
            $data = 'StudentId=' . $student_id . '#change_password';

            // VALIDATION
            if (empty($admin_pass)) {
                $em = "Admin password is required";
                header("Location: ../student-edit.php?perror=$em&$data");
                exit;
            } 
            else if (empty($new_pass)) {
                $em = "New password is required";
                header("Location: ../student-edit.php?perror=$em&$data");
                exit;
            } 
            else if (empty($c_new_pass)) {
                $em = "Confirmation password is required";
                header("Location: ../student-edit.php?perror=$em&$data");
                exit;
            } 
            else if ($new_pass !== $c_new_pass) {
                $em = "New password and confirm password do not match";
                header("Location: ../student-edit.php?perror=$em&$data");
                exit;
            } 
            else if (!adminPasswordVerify($admin_pass, $conn, $id)) {
                $em = "Incorrect admin password";
                header("Location: ../student-edit.php?perror=$em&$data");
                exit;
            } 
            else {
                // Hash new password
                $new_pass_hash = password_hash($new_pass, PASSWORD_DEFAULT);

                // FIXED column name: StudentId
                $sql = "UPDATE students 
                        SET password = ?
                        WHERE StudentId = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$new_pass_hash, $student_id]);

                $sm = "Password changed successfully!";
                header("Location: ../student-edit.php?psuccess=$sm&$data");
                exit;
            }

        } else {
            $em = "Invalid form submission";
            header("Location: ../student-edit.php?error=$em");
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
