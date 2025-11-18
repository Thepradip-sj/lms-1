<?php 
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['admin_pass']) &&
            isset($_POST['new_pass'])   &&
            isset($_POST['c_new_pass']) &&
            isset($_POST['InstructorId'])
        ) {

            include '../../DB_connection.php';
            include "../data/admin.php";

            $admin_pass = $_POST['admin_pass'];
            $new_pass   = $_POST['new_pass'];
            $c_new_pass = $_POST['c_new_pass'];
            $insId      = $_POST['InstructorId'];
            $adminId    = $_SESSION['AdminId'];

            $data = "InstructorId=$insId#change_password";

            if (empty($admin_pass)) {
                $em = "Admin password is required";
            } else if (empty($new_pass)) {
                $em = "New password required";
            } else if (empty($c_new_pass)) {
                $em = "Confirm password required";
            } else if ($new_pass !== $c_new_pass) {
                $em = "Passwords do not match";
            } else if (!adminPasswordVerify($admin_pass, $conn, $adminId)) {
                $em = "Wrong admin password";
            }

            if (isset($em)) {
                header("Location: ../instructor-edit.php?perror=$em&$data");
                exit;
            }

            $new_pass = password_hash($new_pass, PASSWORD_DEFAULT);

            $sql = "UPDATE Instructor SET password=? WHERE InstructorId=?";
            $stmt = $conn->prepare($sql);
            $stmt->execute([$new_pass, $insId]);

            $sm = "Password updated successfully!";
            header("Location: ../instructor-edit.php?psuccess=$sm&$data");
            exit;

        } else {
            $em = "Invalid request";
            header("Location: ../instructor-edit.php?error=$em");
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
