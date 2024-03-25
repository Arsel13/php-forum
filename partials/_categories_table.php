<?php

include "db_connection.php";
$sql = "CREATE TABLE `categories` (`category_id` INT(11) NOT NULL AUTO_INCREMENT, `category_name` VARCHAR(255) NOT NULL, 
        `category_description` VARCHAR(255) NOT NULL, `created at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        PRIMARY KEY (`category_id`) ) ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Categories Table created successfully";
} else {
    echo "Table couldn't be created";
}

?>