<?php

include "db_connection.php";
$sql = "CREATE TABLE `comments` (`comment_id` INT(11) NOT NULL AUTO_INCREMENT, `thread_id` INT(11) NOT NULL,
        `comment_content` TEXT NOT NULL, `comment_by` VARCHAR(255) NOT NULL, `comment_time` DATETIME NOT NULL 
        DEFAULT CURRENT_TIMESTAMP, PRIMARY KEY (`comment_id`) ) ";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Comments Table created successfully";
} else {
    echo "Table couldn't be created";
}

?>