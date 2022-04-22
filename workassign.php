<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Work Assigned</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/dash.css">
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

  <div style="height: 100%;">
  <a href="admindash.php" class="tablink" style="width: 25%;">Profile</a>
  <a href="adminplants.php" class="tablink" style="width: 25%;">Plants</a>
  <a href="employee.php" class="tablink" style="width: 25%;">Employee</a>
  <a href="custvisited.php" class="tablink" style="width: 25%;">Customers Visited</a>

    
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="padding-top: 50px;">
                <?php
                session_start();
                include("connect/config.php");
                $Nid =  $_SESSION['nurseryid'];
                $sql = "SELECT * FROM looksafter,employees,plants WHERE 
                    employees.N_id = $Nid AND employees.E_id=looksafter.E_id AND looksafter.P_id = plants.P_id";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo '<table class="table table-dark table-bordered">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo "<th>Employee ID</th>";
                                    echo "<th>Employee Name</th>";
                                    echo "<th>Plants ID</th>";
                                    echo "<th>Plants Name</th>";
                                echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
                            while($row = mysqli_fetch_array($result)){
                                echo "<tr>";
                                    echo "<td>" . $row['E_id'] . "</td>";
                                    echo "<td>" . $row['E_name'] . "</td>";
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