<?php
session_start();
include("connect/config.php");
    $id = $_GET["id"];
    $sql = "DELETE FROM plants WHERE P_id = $id";
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Deleted Successfully');
        window.location='adminplants.php';</script>";
        die;
    } else{
        echo "<script type='text/javascript'>alert('Something went wrong'');
        window.location='adminplants.php';</script>";
        die;
    } 
    mysqli_close($conn);
?>