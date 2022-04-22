<?php
session_start();
include("connect/config.php");
$pid = $_GET["id"];
$sql = "SELECT * FROM plants WHERE P_id = $pid";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $pname = $row['P_name'];
    $ptype = $row['P_type'];
    $quantity = $row['Quantity'];
    $price = $row['Price'];
}
$db_fields = array('P_name','P_type','Quantity', 'Price');
$sqlfield = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST' ) 
{
    foreach($db_fields as $fieldname) {
        if (!empty($_POST[$fieldname])) {
            $sqlfield .= "$fieldname = '{$_POST[$fieldname]}',";
        }
    }
    $sqlfield = rtrim($sqlfield,',');
    $sql = "UPDATE plants SET $sqlfield WHERE P_id = $pid";
    if (mysqli_query($conn, $sql)) {
        echo "<script type='text/javascript'>alert('Details updates successfully');
        window.location='adminplants.php';</script>";
        die;
    } else{
        echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
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
    <title>Update Plants</title>
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
                    <h2 class="mt-5">Update Record</h2>
                    <p>Please edit the input values and submit to update the plants record.</p>
                    <form action="" method="post">
                        <div class="form-group">
                            <label>Plant Name</label>
                            <input type="text" name="P_name" class="form-control" placeholder="<?php echo $pname ?>">
                        </div>
                        <div class="form-group">
                            <label>Plant Type</label>
                            <input type="text" name="P_type" class="form-control" placeholder="<?php echo $ptype ?>">
                        </div>
                        <div class="form-group">
                            <label>Quantity</label>
                            <input type="text" name="Quantity" class="form-control" placeholder="<?php echo $quantity ?>">
                        </div>
                        <div class="form-group">
                            <label>Price</label>
                            <input type="text" name="Price" class="form-control" placeholder="<?php echo $price ?>">
                        </div>
                        <button type="submit" class="btn btn-primary" name="submit"">Submit</button>
                        <a href="adminplants.php" class="btn btn-secondary ml-2">Cancel</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>