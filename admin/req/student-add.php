<?php 
session_start();
if (isset($_SESSION['AdminId']) && isset($_SESSION['role'])) {

  if ($_SESSION['role'] == 'Admin') {

    if (isset($_POST['fname']) &&
        isset($_POST['lname']) &&
        isset($_POST['username']) &&
        isset($_POST['pass']) &&
        isset($_POST['address']) &&
        isset($_POST['gender']) &&
        isset($_POST['SMail']) &&
        isset($_POST['SContact'])) {

        include '../../DB_connection.php';
        include "../data/student.php";

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $pass = $_POST['pass'];
        $address = $_POST['address'];
        $gender = $_POST['gender'];
        $email = $_POST['SMail'];
        $contact = $_POST['SContact'];

        // Data for redirect
        $data = 'uname='.$uname.'&fname='.$fname.'&lname='.$lname.'&address='.$address.'&gender='.$gender.'&email='.$email.'&contact='.$contact;

        // VALIDATIONS
        if (empty($fname)) {
            $em  = "First name is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        } 
        else if (empty($lname)) {
            $em  = "Last name is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($uname)) {
            $em  = "Username is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (!unameIsUnique($uname, $conn)) {
            $em  = "Username is taken! Try another.";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($pass)) {
            $em  = "Password is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($address)) {
            $em  = "Address is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($gender)) {
            $em  = "Gender is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($email)) {
            $em  = "Email is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else if (empty($contact)) {
            $em  = "Contact number is required";
            header("Location: ../student-add.php?error=$em&$data"); exit;
        }
        else {

            // Hash password
            $pass = password_hash($pass, PASSWORD_DEFAULT);

            $sql = "INSERT INTO students(username, password, fname, lname, address, gender, SMail, SContact)
                    VALUES(?,?,?,?,?,?,?,?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->execute([$uname, $pass, $fname, $lname, $address, $gender, $email, $contact]);

            $sm = "New student registered successfully";
            header("Location: ../student-add.php?success=$sm");
            exit;
        }

    } else {
        $em = "Invalid form submission";
        header("Location: ../student-add.php?error=$em");
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
