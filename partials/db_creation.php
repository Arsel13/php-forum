<?php 

$servername = 'localhost';
$username = 'root';
$password = '';

$conn = mysqli_connect($servername, $username, $password);

$sql = 'CREATE DATABASE `icode` ';
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "Database created successfully";
}
else {
    echo "Database couldn't be created";
}

?>