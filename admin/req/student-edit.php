<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['fname']) &&
            isset($_POST['lname']) &&
            isset($_POST['username']) &&
            isset($_POST['StudentId']) &&
            isset($_POST['address']) &&
            isset($_POST['SMail']) &&
            isset($_POST['gender']) &&
            isset($_POST['SContact'])
        ) {

            include '../../DB_connection.php';
            include "../data/student.php";

            $fname     = $_POST['fname'];
            $lname     = $_POST['lname'];
            $uname     = $_POST['username'];
            $address   = $_POST['address'];
            $gender    = $_POST['gender'];
            $email     = $_POST['SMail'];
            $contact   = $_POST['SContact'];
            $studentId = $_POST['StudentId'];

            // For redirect
            $data = "StudentId=$studentId";

            // VALIDATION
            if (empty($fname)) {
                $em = "First name is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($lname)) {
                $em = "Last name is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($uname)) {
                $em = "Username is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (!unameIsUnique($uname, $conn, $studentId)) {
                $em = "Username is taken! Try another";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($address)) {
                $em = "Address is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($gender)) {
                $em = "Gender is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($email)) {
                $em = "Email is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } elseif (empty($contact)) {
                $em = "Contact number is required";
                header("Location: ../student-edit.php?error=$em&$data");
                exit;
            } else {

                // UPDATE query for your new DB structure
                $sql = "UPDATE students SET
                        username = ?, 
                        fname = ?, 
                        lname = ?, 
                        address = ?, 
                        gender = ?, 
                        SMail = ?, 
                        SContact = ?
                        WHERE StudentId = ?";

                $stmt = $conn->prepare($sql);
                $stmt->execute([$uname, $fname, $lname, $address, $gender, $email, $contact, $studentId]);

                $sm = "Successfully updated!";
                header("Location: ../student-edit.php?success=$sm&$data");
                exit;
            }

        } else {
            $em = "Invalid form submission";
            header("Location: ../student.php?error=$em");
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
