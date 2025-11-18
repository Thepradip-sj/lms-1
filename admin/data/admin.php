<?php 

function adminPasswordVerify($admin_pass, $conn, $AdminId){
   $sql = "SELECT * FROM Admin
           WHERE AdminId=?";
   $stmt = $conn->prepare($sql);
   $stmt->execute([$AdminId]);

   if ($stmt->rowCount() == 1) {
     $admin = $stmt->fetch();
     $pass  = $admin['password'];

     if (password_verify($admin_pass, $pass)) {
     	return 1;
     }else {
     	return 0;
     }
   }else {
    return 0;
   }
}

function getAllAdmins($conn){
    $sql = "SELECT * FROM admin";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    if ($stmt->rowCount() >= 1) {
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        return 0;
    }
}