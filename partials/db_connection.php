<?php 

$servername = 'localhost';
$username = 'root';
$password = '';
$database = 'icode';

$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    echo "We couldn't connect to database at the moment";
}

?>