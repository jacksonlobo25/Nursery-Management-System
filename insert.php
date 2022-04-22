<?php
session_start();
include("connect/config.php");

if(isset($_POST['submit'])){
    $pname = $_POST["pname"];
    $ptype = $_POST["ptype"];
    $quantity = $_POST["quantity"];
    $price = $_POST["price"];
    $Nid =  $_SESSION['nurseryid'];
    $sql = "INSERT INTO plants (P_name,P_type,Quantity,Price,N_id,Status) 
    VALUES ('$pname','$ptype','$quantity','$price','$Nid','Accept')";
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Plant added to nursery');
        window.location='adminplants.php';</script>";
        die;
    } else{
        echo "<script type='text/javascript'>alert('Error in inserting plant details');
        window.location='adminplants.php';</script>";
        die;
    } 
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Insert Plants</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="mt-5">Insert Plant Details</h2>
                    <p>Please fill this form and submit to add plants record to the database.</p>
                    <form method="post" action="">
                        <div class="form-group">
                            <label>Plant Name</label>
                            <input type="text" name="pname" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Plant Type</label>
                            <input type="text" name="ptype" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="number" name="quantity" class="form-control" min="1" required>
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="price" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit">ADD</button>
                        <a href="/adminplants.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>