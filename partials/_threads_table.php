<?php

include "db_connection.php";
$sql = "CREATE TABLE `threads` (`thread_id` INT(11) NOT NULL AUTO_INCREMENT, `thread_title` VARCHAR(255) NOT NULL, 
        `thread_description` TEXT NOT NULL, `thread_cat_id` INT(11) NOT NULL, `thread_user_id` INT(11) NOT NULL, 
        `thread_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY(`thread_id`))";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Threads Table created successfully";
} else {
    echo "Table couldn't be created";
}

?>