<?php
session_start();
include("connect/config.php");
$pid = $_GET["id"];
$sql = "SELECT quantity FROM buy WHERE P_id = $pid";
if($result = mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_array($result)){
        $quantity = $row['quantity'];
    }
}
$sql1 = "UPDATE plants SET Quantity = Quantity+$quantity WHERE P_id = $pid";
$result1 = mysqli_query($conn,$sql1);
$sql2 = "DELETE FROM buy WHERE P_id = $pid ";
if($result2 = mysqli_query($conn,$sql2)){
    echo "<script type='text/javascript'>alert('Deleted Successfully');
    window.location='cart.php';</script>";
    die;
} else{
    echo "<script type='text/javascript'>alert('Something went wrong');
    window.location='cart.php';</script>";
    die;
} 

?>
