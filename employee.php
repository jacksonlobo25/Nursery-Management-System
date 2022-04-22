<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employees</title>
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
        .cartbutton {
        border: none;
        padding: 8px;
        background-color:crimson;
        text-align: center;
        cursor: pointer;
        width: 100%;
        font-size: 12px;
        }

        .cartbutton:hover {
        opacity: 0.7;
        }
        .cartlink{
            text-decoration: none;
            color:chartreuse;
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
  <a href="workassign.php" class="tablink" style="width: 25%;">Work Assigned</a>
  <a href="custvisited.php" class="tablink" style="width: 25%;">Customers Visited</a>

<!---------------------------------------CUSTOMER DASHBOARD------------------------------------------------->
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                        <h2 class="float-left">Employee Details</h2>
                        <div style="padding-left: 900px;"><a href="empinsert.php" class="btn btn-primary pull-right" >Add New Employee</a></div>
                    </div>
                    <?php
                    session_start();
                    include("connect/config.php");
                    $Nid =  $_SESSION['nurseryid'];
                    $sql = "SELECT * FROM employees WHERE N_id = {$Nid} ";
                    if($result = mysqli_query($conn, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo '<table class="table table-dark table-bordered">';
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>Employee ID</th>";
                                        echo "<th>Employee Name</th>";
                                        echo "<th>Address</th>";
                                        echo "<th>Phone</th>";
                                        echo "<th>Gender</th>";
                                        echo "<th>Action</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['E_id'] . "</td>";
                                        echo "<td>" . $row['E_name'] . "</td>";
                                        echo "<td>" . $row['Address'] . "</td>";
                                        echo "<td>" . $row['Phone'] . "</td>";
                                        echo "<td>" . $row['Gender'] . "</td>";
                                        echo "<td>";
                                        echo '<div class="btn-group">';
                                            echo '<a href="empupdate.php?id='. $row['E_id'] .'"  class="btn btn-primary btn-sm" data-toggle="tooltip">Update</a>';
                                            echo '<a href="empdelete.php?id='. $row['E_id'] .'"  class="btn btn-primary btn-sm" data-toggle="tooltip">Delete</a>';
                                        echo '</div>';
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";                            
                            echo "</table>";
                            // Free result set
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


<!------------------------------------END OF FULL PAGES ------------------------------------------------------->
</body>
</html>