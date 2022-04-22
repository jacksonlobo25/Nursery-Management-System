<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/dash.css" />
  <style>
        .wrapper{
            width: 1100px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
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

<!--------------------------------------------FULL PAGE------------------------------------------------>
  <div style="height: 100%;">
  <a href="admindash.php" class="tablink" style="width: 25%;">Profile</a>
  <a href="adminplants.php" class="tablink" style="width: 25%;">Plants</a>
  <a href="employee.php" class="tablink" style="width: 25%;">Employee</a>
  <a href="workassign.php" class="tablink" style="width: 25%;">Work Assigned</a>

<!---------------------------------------CUSTOMER DASHBOARD------------------------------------------------->
    
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-top: 50px;">
                <?php
                session_start();
                include("connect/config.php");
                $Nid =  $_SESSION['nurseryid'];
                $sql = "SELECT DISTINCT customers.* FROM customers,visitedby WHERE visitedby.C_id=customers.C_id AND visitedby.N_id = {$Nid}";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<table class="table table-dark table-bordered">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Customer ID</th>";
                                    echo "<th>Name</th>";
                                    echo "<th>Address</th>";
                                    echo "<th>Phone</th>";
                                    echo "<th>Gender</th>"; 
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['C_id'] . "</td>";
                                    echo "<td>" . $row['C_name'] . "</td>";
                                    echo "<td>" . $row['Address'] . "</td>";
                                    echo "<td>" . $row['Phone'] . "</td>";
                                    echo "<td>" . $row['gender'] . "</td>";
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