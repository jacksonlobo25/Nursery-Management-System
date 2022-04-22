<?php
session_start();
include("connect/config.php");
$Nid =  $_SESSION['nurseryid'];
$pid = $_GET["id"];
$sql = "UPDATE plants SET Status='Reject' WHERE P_id = $pid";
if (mysqli_query($conn, $sql)) {
    echo "<script type='text/javascript'>alert('Plants Rejected');
    window.location='adminplants.php';</script>";
    die;
} else{
    echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
    window.location='adminplants.php';</script>";
    die;
}
?>