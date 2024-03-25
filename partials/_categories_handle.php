<?php

$dupError = false;
$showAlert = false;
$showAlert_2 = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include "db_connection.php";
    $cat_name = $_POST['cat_name'];
    $cat_desc = $_POST['cat_desc'];

    $fil_user = filter_var($user, FILTER_SANITIZE_STRING);

    $dupSql = "SELECT * FROM `categories` where `category_name` = '$cat_name'";
    $dupResult = mysqli_query($conn, $dupSql);

    if ($dupResult) {
        $numRows = mysqli_num_rows($dupResult);
        if ($numRows > 0) {
            $dupError = "Category already exists";
            header("Location: ../index.php?catsuccess=false&error=$dupError");
        } else {
            $insertSql = "INSERT INTO `categories` (`category_name`, `category_description`, `created at`) 
                VALUES ('$cat_name', '$cat_desc', CURRENT_TIMESTAMP())";
            $insertResult = mysqli_query($conn, $insertSql);
            if ($insertResult) {
                $showAlert = true;
                header("Location: ../index.php?catsuccess=true");
            }
        }
    } else {
        $showAlert_2 = "Do not use special characters";
        header("Location: ../index.php?catsuccess=false&error=$showAlert_2");
    }
}
