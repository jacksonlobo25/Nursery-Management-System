<style>
    body{  background: url(images/bg.jpg);}
</style>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="assets/js/jquery.js"></script>
<?php
    session_start();
    include("connect/config.php");
    $cid = $_SESSION["custid"];
    $pid = $_GET["id"];
    $nid = $_GET["nid"];
    $sql1 = "INSERT INTO visitedby(N_id,C_id) VALUES ($nid,$cid)";
    $result1 = mysqli_query($conn,$sql1);
    $sql = "SELECT Quantity FROM plants WHERE P_id = $pid";
    $result = mysqli_query($conn,$sql);
    while($row = mysqli_fetch_array($result))
    {
        $Quantity = $row["Quantity"];
    }
    try{
        if ($Quantity == 0){
            throw new Exception("Out of Stock");
        }
        else{
            $sql = "SELECT P_id FROM buy WHERE P_id=$pid";
            if($result = mysqli_query($conn,$sql)){
                if(mysqli_num_rows($result) > 0){
                    $sql = "UPDATE plants SET Quantity = Quantity-1 WHERE P_id = $pid;";
                    $sql .= "UPDATE buy SET quantity = quantity+1 WHERE P_id = $pid";
                    if($result = mysqli_multi_query($conn,$sql)){
                        echo "<script type='text/javascript'>alert('Item added to cart');
                        window.location='plants.php';</script>";
                        die;
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
                        window.location='plants.php';</script>";
                        die;
                    }
                }
                else{
                    $quantity = 1;
                    $sql = "INSERT INTO buy(quantity,P_id,C_id) VALUES ($quantity,$pid,$cid);";
                    $sql .= "UPDATE plants SET Quantity = Quantity-1 WHERE P_id = $pid";
                    if($result = mysqli_multi_query($conn,$sql)){
                        echo "<script type='text/javascript'>alert('Item added to cart');
                        window.location='plants.php';</script>";
                        die;
                    }
                    else{
                        echo "<script type='text/javascript'>alert('Oops! Something went wrong. Please try again later.');
                        window.location='plants.php';</script>";
                        die;
                    }

                }
            }
         }
    }
    catch(Exception $e){

        //echo "<script type='text/javascript'>alert('{$e->getMessage()}');
        echo  '
        <script type="text/javascript">
        $(document).ready(function(){
            $("#myModal").modal("show");
        });
    </script>
  <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">
        
          <!-- Modal content-->
          <div class="modal-content" style="background-color:#470006;">
            <div class="modal-header" style="background-color:#a10000;color:white;">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h3 class="modal-title" style="text-align:center;">Out Of Stock</h3>
            </div>
            <div class="modal-body" style="color:white;">
              <h4>Sorry, this plant is not available at the moment</h4>
            </div>
            <div class="modal-footer">
              <button type="button" style="background-color:black; color:white;" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
          
        </div>
      </div>
      
<script>
function functn() {
    window.location="plants.php";
}
setTimeout(functn, 4000);
$(document).on("hide.bs.modal", "#myModal", function () {
    functn();
});
</script>';
        die;
    }
    mysqli_close($conn);
?>
<body>
    <div style="width:100%;height:100%;"></div>
</body>
