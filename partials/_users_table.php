<?php

include "db_connection.php";
$sql = "CREATE TABLE `icode_users` (`user_id` INT(11) NOT NULL AUTO_INCREMENT, `user_name` VARCHAR(255) NOT NULL, 
        `user_password` VARCHAR(255) NOT NULL, `user_role` TEXT NOT NULL, `time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, 
        PRIMARY KEY (`user_id`) ) ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Users Table created successfully";
} else {
    echo "Table couldn't be created";
}

?>