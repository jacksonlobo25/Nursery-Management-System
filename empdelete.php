<?php
    session_start();
    include("connect/config.php");
    $eid = $_GET["id"];
    $sql = "DELETE FROM employees WHERE E_id = $eid";
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Deleted Successfully');
        window.location='employee.php';</script>";
        die;
    } else{
        echo "<script type='text/javascript'>alert('Something went wrong');
        window.location='employee.php';</script>";
        die;
    } 
    mysqli_close($conn);
?>