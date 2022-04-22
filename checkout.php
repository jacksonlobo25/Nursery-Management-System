<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/checkout.css">
    <link rel="stylesheet" href="css/main.css">
</head>
<body>

<div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
     <div class="card">
         <div class="card-header p-4">
             <a class="pt-2 d-inline-block" href="cart.php" data-abc="true">Home</a>
             <div class="float-right">
                 <h3 class="mb-0">Invoice #BB<?php echo(rand(100,900));?></h3>
                 Date: <?php echo(date("d-m-Y")); ?>
             </div>
         </div>
         <div class="card-body">
           <?php
             echo '<div class="table-responsive-sm">';
                 session_start();
                 include("connect/config.php");
                 $total_quantity = $total_row =  $total_price = 0;
                 $cid = $_SESSION["custid"];

                 $sql = "SELECT * FROM buy,plants WHERE buy.P_id = plants.P_id and buy.C_id=$cid and buy.CheckOut=0";
                 $result = mysqli_query($conn,$sql);
                 if($result){
                        echo '<table class="table table-striped">';
                            echo "<thead>";
                                echo "<tr>";
                                    echo '<th class="center">#</th>';
                                    echo '<th>Plant Name</th>';
                                    echo '<th class="right">Price</th>';
                                    echo '<th class="center">Qunatity</th>';
                                    echo '<th class="right">Total</th>';
                                echo '</tr>';
                                $count = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $count = $count + 1;                             
                                    echo "<tr>";
                                        echo '<td style="text-align:left;">'. $count . '</td>';
                                        echo '<td style="text-align:left;">'. $row["P_name"] . '</td>';
                                        echo '<td style="text-align:left;">' . $row["Price"] . '</td>';
                                        echo '<td style="text-align:left;">' . $row["quantity"] . '</td>';
                                        $total_row = ($row["Price"] * $row["quantity"]);
                                        echo '<td style="text-align:left;">' ."$". $total_row . '</td>';
                                    echo "</tr>";
                                    $total_quantity += $row["quantity"];
                                    $total_price += $total_row;
                                }
                            echo "</tbody>";
                            echo "</table>";
                    echo '</div>';
                    echo '<div class="row">';
                        echo '<div class="col-lg-4 col-sm-5">';
                        echo '</div>';
                        echo '<div class="col-lg-4 col-sm-5 ml-auto">';
                            echo '<table class="table table-clear">';
                                echo '<tbody>';
                                    echo '<tr>';
                                        echo '<td class="left">';
                                            echo '<strong class="text-dark">Total</strong> </td>';
                                        echo '<td class="right">';
                                            echo '<strong class="text-dark">' ."$". $total_price.' </strong>';
                                        echo '</td>';
                                    echo '</tr>';
                                echo '</tbody>';
                            echo '</table>';
                        echo '</div>';
                    echo '</div>';
                    mysqli_free_result($result);
                    $sql1 = "UPDATE buy SET buy.CheckOut=1 WHERE buy.CheckOut=0 and C_id=$cid";
                 $result1 = mysqli_query($conn,$sql1);
                    }
            else{
                echo '<div class="alert alert-danger"><em>No records were found.</em></div>';
            }
            ?>
         </div>
     </div>
    <div style="padding-left: 700px;">
        <button onclick="window.print()"  class="btn">Print</button>
    </div>
 </div>

</body>
</html>