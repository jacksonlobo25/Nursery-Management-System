<?php
  session_start();
  include("connect/config.php");
  $custid = $_SESSION['custid'];
  $sql = "SELECT * FROM customers WHERE C_id = $custid";
  $result = mysqli_query($conn,$sql);
  if($result == true){
    while($row = mysqli_fetch_array($result)){
      $dbname = $row['C_name'];
      $dbgmail = $row['gmail'];
      $dbcid = $row['C_id'];
      $dbphone = $row['Phone'];
      $dbgender = $row['gender'];
      $dbaddress = $row['Address'];
      $dbuser = $row['username'];
    }
  }
?>

<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customer Dashboard</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/dash.css" />
  <style>
    .wrapper{
      padding-bottom: 50px;
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

<div style="height: 100%;">
  <a href="plants.php" class="tablink">Plants</a>
  <a href="sell.php" class="tablink">Sell</a>
  <a href="cart.php" class="tablink">Cart</a>
    
    <div id="Home" class="tabcontent">
      <div class="student-profile py-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center">
                  <img class="profile_img" src="images/avatar2.png" alt="student dp">
                </div>
                <div class="card-body">
                  <p class="mb-0" style="color: black;"><strong class="pr-1"> <?php echo $dbuser?></strong></p>
                  <p class="mb-0" style="color: black;"><strong class="pr-1">  <?php echo $dbgmail?></strong></p>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-0">
                  <h3 class="mb-0" style="color: black;">General Information</h3>
                </div>
                <div class="card-body pt-0">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%" style="color: black;">Username</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> <?php echo $dbname?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Customer ID</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> <?php echo $dbcid?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Address</th>
                      <td width="2%">:</td>
                      <td style="color: black;"> <?php echo $dbaddress?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Gender</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> <?php echo $dbgender?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Phone</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;">+91-<?php echo $dbphone?>  </td>
                    </tr>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>           
    </div>
  </div>
  <div class="wrapper">
    <div class="container-fluid">
        <div class="mt-5 mb-3 clearfix">
            <h2 class="pull-left">Plants Sold</h2>
        </div>
        <?php
        include('connect/config.php');
        $sql = "SELECT * FROM plants,sell,nursery WHERE sell.C_id=$custid AND sell.P_id = plants.P_id AND plants.N_id=nursery.N_id";
        if($result = mysqli_query($conn, $sql)){
            if(mysqli_num_rows($result) > 0){
                echo '<table class="table table-dark table-bordered">';
                    echo "<thead>";
                        echo "<tr>";
                            echo "<th>Plant ID</th>";
                            echo "<th>Plant Name</th>";
                            echo "<th>Plant Type</th>";
                            echo "<th>Quantity</th>";
                            echo "<th>Price</th>";
                            echo "<th>Nursery</th>";
                            echo "<th>Status</th>";
                        echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";
                    while($row = mysqli_fetch_array($result)){
                        echo "<tr>";
                            echo "<td>" . $row['P_id'] . "</td>";
                            echo "<td>" . $row['P_name'] . "</td>";
                            echo "<td>" . $row['P_type'] . "</td>";
                            echo "<td>" . $row['Quantity'] . "</td>";
                            echo "<td>" . $row['Price'] . "</td>";
                            echo "<td>" . $row['N_name'] . "</td>";
                            echo "<td>" . $row['Status'] . "</td>";
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

</body>
</html>