<?php
session_start();
include("connect/config.php");
$eid = $_GET["id"];
$nid = $_SESSION["nurseryid"];
$sql = "SELECT * FROM employees WHERE E_id = $eid";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)){
    $name = $row['E_name'];
    $address = $row['Address'];
    $phone = $row['Phone'];
    $gender = $row['Gender'];
    $gmail = $row['Gmail'];
}
$db_fields = array('E_name','Address','Phone', 'Gender','Gmail');
$sqlfield = ''; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') 
{
    foreach($db_fields as $fieldname) {
        if (!empty($_POST[$fieldname])) {
            $sqlfield .= "$fieldname = '{$_POST[$fieldname]}',";
        }
    }
    $sqlfield = rtrim($sqlfield, ',');
    $pid = $_POST["plant"];
    if(empty($pid)){
        $sql = "UPDATE employees SET $sqlfield WHERE E_id = $eid";
        if (mysqli_query($conn, $sql)) {
            echo "<script type='text/javascript'>alert('Details updates successfully');
            window.location='employee.php';</script>";
            die;
        } else{
            echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
            window.location='employee.php';</script>";
            die;
        } 
    }
    else{
        if(isset($_POST["plant"])){
            $pid =  $_POST['plant'];
        }
        $sql = "SELECT * FROM looksafter WHERE E_id = $eid AND P_id = $pid LIMIT 1";
        $result = mysqli_query($conn,$sql);
        if(mysqli_num_rows($result) > 0){
                echo "<script type='text/javascript'>alert('You are assaigning the same plant');
                window.location='employee.php';</script>";
                die;
        }
        else{
            $sql1 = "SELECT * FROM plants WHERE P_id = $pid AND N_id = $nid";
            $result1 = mysqli_query($conn,$sql1);
            if(mysqli_num_rows($result1) > 0 ){
                if(!empty($sqlfield)){  
                    $sql = "UPDATE employees SET $sqlfield WHERE E_id = $eid";
                    $result = mysqli_query($conn,$sql);
                }
                $sql1 = "INSERT INTO looksafter(E_id,P_id) VALUES ($eid,$pid)";
                if (mysqli_query($conn,$sql1)) {
                    echo "<script type='text/javascript'>alert('Details updates successfully');
                    window.location='employee.php';</script>";
                    die;
                } else{
                    echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
                    window.location='employee.php';</script>";
                    die;
                }
            }
            else{
                echo "<script type='text/javascript'>alert('Plant ID does not exist');
                window.location='employee.php';</script>";
                die;
            }
        }
    }
}
mysqli_close($conn);
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Employee</title>
    <link rel="stylesheet" href="css/main.css">
    <style>
    .wrapper{
      width: 400px;
    }
    .main{
      padding-left: 100px;
    }
    </style>
</head>
<body>
<div class="main">
  <div class="row" style="margin-right:0px;">
    <div class="col-lg-6">
      <div class="container">
            <h2 class="mt-5">Update Record</h2>
            <p>Please edit the input values and submit to update the Employee record.</p>
            <form action="" method="post">
                <div class="form-group">
                    <label>Employee Name</label>
                    <input type="text" name="E_name" class="form-control" placeholder="<?php echo $name ?>">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="Address" class="form-control" placeholder="<?php echo $address ?>">
                </div>
                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="Phone" class="form-control" placeholder="<?php echo $phone ?>">
                </div>
                <div class="form-group">
                    <label>Gender</label>
                    <input type="text" name="Gender" class="form-control" placeholder="<?php echo $gender ?>">
                </div>
                <div class="form-group">
                    <label>Gmail</label>
                    <input type="text" name="Gmail" class="form-control" placeholder="<?php echo $gmail ?>">
                </div>                        
                <div class="form-group">
                    <label>Plant</label>
                    <input type="text" name="plant" class="form-control" >
                </div>
                <button type="submit" class="btn btn-primary" name="submit"">Submit</button>
                <a href="employee.php" class="btn btn-secondary ml-2">Cancel</a>
            </form>     
        </div>
    </div>

<div class="col-lg-4">
    <div class="wrapper">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Plants Available</h2>
        </div>
        <?php
        include('connect/config.php');
        $nid = $_SESSION["nurseryid"];
        $sql = "SELECT * FROM plants WHERE N_id = $nid";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo '<table class="table table-bordered table-dark">';
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Plant ID</th>";
                            echo "<th>Plant Name</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['P_id'] . "</td>";
                            echo "<td>" . $row['P_name'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</tbody>";                            
                echo "</table>";
                mysqli_free_result($result);
            } else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
        mysqli_close($conn);
        ?>
        </div>
      </div>
  </div>
</div>
</body>
</html>