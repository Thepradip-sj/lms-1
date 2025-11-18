<?php
session_start();

if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

    if ($_SESSION['role'] == 'Admin') {

        if (
            isset($_POST['fname']) &&
            isset($_POST['lname']) &&
            isset($_POST['username']) &&
            isset($_POST['InstructorId']) &&
            isset($_POST['address']) &&
            isset($_POST['IContact']) &&
            isset($_POST['qualification']) &&
            isset($_POST['gender']) &&
            isset($_POST['IMail'])
        ) {

            include '../../DB_connection.php';
            include "../data/instructor.php";

            $id = $_POST['InstructorId'];
            $fname = $_POST['fname'];
            $lname = $_POST['lname'];
            $uname = $_POST['username'];
            $address = $_POST['address'];
            $IContact = $_POST['IContact'];
            $qualification = $_POST['qualification'];
            $gender = $_POST['gender'];
            $IMail = $_POST['IMail'];

            $data = "InstructorId=$id";

            // VALIDATION
            if (empty($fname)) {
                $em  = "First name is required";
            } else if (empty($lname)) {
                $em  = "Last name is required";
            } else if (empty($uname)) {
                $em  = "Username is required";
            } else if (!unameIsUnique($uname, $conn, $id)) {
                $em  = "Username is taken";
            } else if (empty($address)) {
                $em  = "Address is required";
            } else if (empty($IContact)) {
                $em  = "Contact is required";
            } else if (empty($qualification)) {
                $em  = "Qualification is required";
            } else if (empty($gender)) {
                $em  = "Gender is required";
            } else if (empty($IMail)) {
                $em  = "Email is required";
            }

            if (isset($em)) {
                header("Location: ../instructor-edit.php?error=$em&$data");
                exit;
            }

            // UPDATE
            $sql = "UPDATE Instructor SET 
                        username = ?, 
                        fname = ?, 
                        lname = ?, 
                        address = ?, 
                        IContact = ?, 
                        qualification = ?, 
                        gender = ?, 
                        IMail = ?
                    WHERE InstructorId = ?";

            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $fname, $lname, $address, $IContact, $qualification, $gender, $IMail, $id]);

            $sm = "Instructor updated successfully!";
            header("Location: ../instructor-edit.php?success=$sm&$data");
            exit;

        } else {
            $em = "Invalid form submission";
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
