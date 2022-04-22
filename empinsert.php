<?php
session_start();
include("connect/config.php");

if(isset($_POST['submit'])){
    $name = $_POST["name"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $gender = $_POST["gender"];
    $gmail=  $_POST['gmail'];
    $nid = $_SESSION["nurseryid"];
    $sql = "INSERT INTO employees (E_name,Address,Phone,Gender,Gmail,N_id) VALUES ('$name','$address','$phone','$gender','$gmail',$nid)";
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Inserted successfully');
        window.location='employee.php';</script>";
        die;
    } else{
        echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
        window.location='employee.php';</script>";
        die;
    } 
    mysqli_close($conn);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
    .wrapper{
      width: 600px;
    }
    .main{
        padding-left: 300px;
    }
    </style>
</head>
<body>
<div class="main">
    <div class="wrapper">
      <div class="container">
            <h2 class="mt-5">Insert Employee Details</h2>
            <p>Please fill this form and submit to add employee record to the database.</p>
            <form action="" method="post">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input type="text" name="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" pattern="[0-9]{10}" required>
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" name="gender" class="form-control" required>
                </div>
                <div class="form-group">
                    <label>Gmail</label>
                    <input type="email" name="gmail" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary" name="submit">ADD</button>
                <a href="employee.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>
        </div>
    </div>
</div>
</body>
</html>