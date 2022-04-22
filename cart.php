<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="css/custdash.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/dash.css" />
    <link rel="stylesheet" href="css/cart.css">
</head>
    <style>
    .wrapper{
        width: 1000px;
        margin: 0 auto;
    }
    table tr td:last-child{
        width: 120px;
    }
    </style>

<body>
<div class="header">
      <p class="logo">NURSERY MANAGEMENT SYSTEM</p>
      <div class="header-right">
        <a class="active" href="logout.php">Logout</a>
      </div>
</div>

<div style="height: 100%;">
    <a href="custdash.php" class="tablink">Profile</a>
    <a href="plants.php" class="tablink">Plants</a>
    <a href="sell.php" class="tablink">Sell</a>

 <div class="wrapper"> 
  <div class="txt-heading">Shopping Cart</div>

    <?php
    session_start();
    include("connect/config.php");
    $cid = $_SESSION["custid"];

    $sql = "SELECT * FROM buy,plants WHERE buy.P_id = plants.P_id and buy.C_id=$cid and buy.CheckOut=0";
    $result = mysqli_query($conn,$sql);
    $total_quantity = $total_row =  $total_price = 0;
    if($result = mysqli_query($conn, $sql)){
        if(mysqli_num_rows($result) > 0){
            echo '<table class="table table-bordered table-dark">';
            echo "<tbody>";
            echo "<tr>";
            echo '<th style="text-align:left;">Plant ID</th>';
            echo '<th style="text-align:left;">Plant Name</th>';
            echo '<th style="text-align:right;" width="5%">Quantity</th>';
            echo '<th style="text-align:right;" width="10%">Unit Price</th>';
            echo '<th style="text-align:center;" width="10%">Action</th>';
            echo "</tr>";
            while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo '<td style="text-align:left;">'. $row["P_id"] . '</td>';
                echo '<td style="text-align:left;">'. $row["P_name"] . '</td>';
                echo '<td style="text-align:right;">' . $row["quantity"] . '</td>';
                echo '<td style="text-align:right;">' ."$ ". $row["Price"] . '</td>';
                $total_row = ($row["Price"] * $row["quantity"]);
                echo "<td>";
                    echo '<a href="delete.php?id='.$row['P_id'] .'" class="btn btn-primary btn-sm">Remove</a>';
                echo "</td>";
                echo "</tr>";
                $total_quantity += $row["quantity"];
                $total_price += $total_row;
            }
            echo "<tr>";
            echo '<td colspan="2" align="right">Total:</td>"';
            echo '<td align="right">' . $total_quantity . '</td>';
            echo '<td align="right">' ."$ ". $total_price . '</td>';
            echo "</tr>";
            echo "</tbody>";
            echo "</table>";
            echo '<div style="padding-left: 900px;">';
            echo '<a href="checkout.php?"class="btn btn-primary">Checkout</a>';
            echo '</div>';
            mysqli_free_result($result);
            }
            else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
    }
    mysqli_close($conn);
    ?>
</div>
</div>
</body>
</html>