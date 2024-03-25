<?php

$dupError = false;
$dupError2 = false;
$passError = false;
$showAlert = false;
$showAlert_2 = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db_connection.php";
    $user = $_POST['sign-uname'];
    $pass = $_POST['sign-pass'];
    $cpass = $_POST['sign-cpass'];
    $role = $_POST['role'];

    $fil_user = filter_var($user, FILTER_SANITIZE_STRING);

    $dupSql = "SELECT * FROM `icode_users` where `user_name` = '$fil_user'";
    $dupResult = mysqli_query($conn, $dupSql);
    
    if ($dupResult) {
        $numRows = mysqli_num_rows($dupResult);
        if ($numRows > 0) {
            $dupError = "Username already in use";  
            header("Location: ../index.php?signupsuccess=false&error=$dupError");
        } 
        else {
            if ($pass == $cpass) {
                $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);
                $insertSql = "INSERT INTO `icode_users` (`user_name`, `user_password`, `user_role`, `time`) 
                VALUES ('$fil_user', '$hashed_pass', '$role', CURRENT_TIMESTAMP())";
                $insertResult = mysqli_query($conn, $insertSql);
                if ($insertResult) {
                    $showAlert = true;
                    header("Location: ../index.php?signupsuccess=true");
                }
            }
            else {
                $passError = "Passwords do not match";
                header("Location: ../index.php?signupsuccess=false&error=$passError");
            }
        }
    }
    else {
        $showAlert_2 = "Do not use special characters";
        header("Location: ../index.php?signupsuccess=false&error=$showAlert_2");
    }
}

?>