<?php

$invalidpass = false;
$user_de = false;
$showAlert_2 = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    include "db_connection.php";
    $uname = $_POST['uname'];
    $password = $_POST['pass'];

    $fil_uname = filter_var($uname, FILTER_SANITIZE_STRING);

    $selectSql = "SELECT * FROM `icode_users` WHERE `user_name`='$fil_uname'";
    $selectResult = mysqli_query($conn, $selectSql);
    
    if ($selectResult) {
        $numRows = mysqli_num_rows($selectResult);
        if ($numRows==1) {
            while($row = mysqli_fetch_assoc($selectResult)) {
                if (password_verify($password, $row['user_password'])) {
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['username'] = $row['user_name'];
                    $_SESSION['user_role'] = $row['user_role'];
                    header("Location: ../index.php?loginsuccess=true");
                }
                else{
                    $invalidpass = "Invalid password";
                    header("Location: ../index.php?loginsuccess=false&error=$invalidpass");
                }
            }
        }
        else {
            $user_de = "User does not exist";
            header("Location: ../index.php?loginsuccess=false&error=$user_de");
        }
    } else {
        $showAlert_2 = "Do not use special characters";
        header("Location: ../index.php?loginsuccess=false&error=$showAlert_2");
    }
    
}

?>
