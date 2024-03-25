<?php

include "db_connection.php";
$sql = "CREATE TABLE `profiles` (`profile_id` INT(11) NOT NULL AUTO_INCREMENT, `user_id` INT(11) NOT NULL, 
        `user_name` VARCHAR(255) NOT NULL, `first_name` VARCHAR(255) NOT NULL, `last_name` VARCHAR(255) NOT NULL, 
        `date` DATE NOT NULL, `gender` TEXT NOT NULL, `image_url` VARCHAR(255) NOT NULL, `about` TEXT NOT NULL, 
        `edited_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`profile_id`) ) ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Profiles Table created successfully";
} else {
    echo "Table couldn't be created";
}

?>