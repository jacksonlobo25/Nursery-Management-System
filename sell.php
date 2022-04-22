<?php
  session_start();
  include("connect/config.php");
  if($_SERVER['REQUEST_METHOD'] == "POST")
  {	 
      $cid = $_SESSION["custid"];
	    $pname = $_POST['pname'];
	    $ptype = $_POST['ptype'];
	    $quantity = $_POST['quantity'];
      $price = $_POST['price'];
      $nid = $_POST['nursery'];
      $sql = "SELECT N_id FROM nursery WHERE N_id = $nid";
      $result = mysqli_query($conn,$sql);
      if(mysqli_num_rows($result)>0){
          $sql = "INSERT INTO plants(P_name,P_type,Quantity,Price,N_id,Status) VALUES ('$pname','$ptype','$quantity','$price',$nid,'Pending')";
          $result = mysqli_query($conn,$sql);
          $last_id = mysqli_insert_id($conn);
          $sql1 = "INSERT INTO visitedby(N_id,C_id) VALUES ($nid,$cid)";
          $result1 = mysqli_query($conn,$sql1);
          $sql2 = "INSERT INTO sell (P_id,C_id) VALUES ($last_id,$cid)";
          $result2 = mysqli_query($conn,$sql2);
          if($result and $result1 and $result2){
            echo "<script type='text/javascript'>alert('Inserted successfully');
            window.location='plants.php';</script>";
            die;
            } else {
                echo "<script type='text/javascript'>alert('Error in inserting plant details');
                window.location='sell.php';</script>";
                die;
            }
        }
        else{
            echo "<script type='text/javascript'>alert('Nursery ID doesnt exist');
            window.location='sell.php';</script>";
        }
  }
?>


<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sell Plants</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/sell.css">
  <style>
    .wrapper{
      padding-top: 140px;
      width: 400px;
    }
    .main{
      padding-left: 100px;
    }
  </style>
</head>

<body>    
    <div class="header">
      <p class="logo">NURSERY MANAGEMENT SYSTEM</p>
      <div class="header-right">
        <a class="active" href="logout.php">Logout</a>
      </div>
    </div>

<div>
  <a href="custdash.php" class="tablink">Dashboard</a>
  <a href="plants.php" class="tablink">Plants</a>
  <a href="cart.php" class="tablink">Cart</a>

<div class="main">
  <div class="row" style="margin-right:0px;">
    <div class="col-lg-6">
      <div class="container" style="padding-top: 100px;">
        <form action="" method="post">
          <h1>Enter Plant Details</h1>
          <hr>

          <label><b>Plant Name</b></label>
          <input type="text" name="pname" required>

          <label><b>Plant Type</b></label>
          <input type="text" name="ptype" required>
          
          <label><b>Quantity</b></label>
          <input type="number" name="quantity" min="1" max="30" required>

          <label><b>Price</b></label>
          <input type="text" name="price" min="1" required>

          <label><b>Nursery</b></label>
          <input type="text" name="nursery" required>

          <hr>
          <button type="submit" class="registerbtn" name="save">SELL</button>
          </form>
        </div>
    </div>

  <div class="col-lg-4">
    <div class="wrapper">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Nursery Available</h2>
        </div>
        <?php
        include('connect/config.php');
        $sql = "SELECT * FROM nursery";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo '<table class="table table-bordered table-dark">';
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Nursery ID</th>";
                            echo "<th>Nursery Name</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['N_id'] . "</td>";
                            echo "<td>" . $row['N_name'] . "</td>";
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
</div>


</body>
</html>

