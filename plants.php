<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Plants</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/dash.css" />
  <style>
        .wrapper{
            width: 1000px;
            margin: 0 auto;
        }
        table tr td:last-child{
            width: 120px;
        }
        .cartbutton {
        border: none;
        padding: 8px;
        background-color:blue;
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
    <a href="custdash.php" class="tablink">Profile</a>
    <a href="sell.php" class="tablink">Sell</a>
    <a href="cart.php" class="tablink">Cart</a>

<!---------------------------------------CUSTOMER DASHBOARD------------------------------------------------->
<div id="News" class="tabcontent">
      <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mt-5 mb-3 clearfix">
                        <h2 class="pull-left">Plant Details</h2>
                    </div>
                    <?php
                    session_start();
                    include("connect/config.php");
                    $sql = "SELECT * FROM plants,nursery WHERE plants.N_id = nursery.N_id";
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
                                        echo "<th>Action</th>";
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
                                        echo "<td>";
                                            echo '<a href="cartpress.php?id='.$row['P_id'] .'&&nid='.$row['N_id'] .'" class="btn btn-primary btn-sm">Add to cart</a>';
                                        echo "</td>";
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
</div>
<!------------------------------------END OF FULL PAGES ------------------------------------------------------->
</body>
</html>