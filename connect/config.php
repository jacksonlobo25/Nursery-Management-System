<?php
$servername = "localhost";
$username = "root";
$password = "";
$database ="nursery";
$conn = mysqli_connect($servername, $username, $password, $database);

if($conn == false){
    dir('Error: Cannot connect');
}

?>
