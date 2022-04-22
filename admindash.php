<?php
  session_start();
  include('connect/config.php');
  $nid = $_SESSION['nurseryid'];
  $sql = "SELECT * FROM nursery WHERE  N_id = '{$nid}'";
  $result = mysqli_query($conn,$sql);
  $sql1 = "SELECT COUNT(P_id) FROM plants WHERE  N_id = '{$nid}' AND status='Accept'";
  $result1 = mysqli_query($conn,$sql1);
  if($result == true and $result1== true){
    while( $row = mysqli_fetch_array($result) and $row1 = mysqli_fetch_array($result1) ){
      $dbnid = $row['N_id'];
      $dbname = $row['N_name'];
      $dbphone = $row['Phone'];
      $dbemail = $row['Gmail'];
      $dbaddress = $row['Address'];
      $dbuser = $row['username'];
      $count = $row1['COUNT(P_id)'];
    }
  }

?>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="css/custdash.css">
  <link rel='stylesheet' href='css/main.css'>
  <link rel="stylesheet" href="css/dash.css">
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
  <a href="adminplants.php" class="tablink" style="width: 25%;">Plants</a>
  <a href="employee.php" class="tablink" style="width: 25%;">Employees</a>
  <a href="workassign.php" class="tablink" style="width: 25%;">Work Assigned</a>
  <a href="custvisited.php" class="tablink" style="width: 25%;">Customers Visited</a>


    
    <div id="Home" class="tabcontent">
      <div class="student-profile py-4">
        <div class="container">
          <div class="row">
            <div class="col-lg-4">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent text-center">
                  <img class="profile_img" src="images/avatar1.png" alt="student dp">
                </div>
                <div class="card-body">
                  <p class="mb-0" style="color: black;"><strong class="pr-1"> <?php echo $dbuser?></strong></p>
                  <p class="mb-0" style="color: black;"><strong class="pr-1">  <?php echo $dbemail?></strong></p>
                </div>
              </div>
            </div>
            <div class="col-lg-8">
              <div class="card shadow-sm">
                <div class="card-header bg-transparent border-0">
                  <h3 class="mb-0" style="color: black;"><i class="far fa-clone pr-1"></i>General Information</h3>
                </div>
                <div class="card-body pt-0">
                  <table class="table table-bordered">
                    <tr>
                      <th width="30%" style="color: black;">Nursery Name</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> <?php echo $dbname?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Nursery ID</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> <?php echo $dbnid?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Address</th>
                      <td width="2%">:</td>
                      <td style="color: black;"> <?php echo $dbaddress?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Phone</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"> +91-<?php echo $dbphone?>  </td>
                    </tr>
                    <tr>
                      <th width="30%" style="color: black;">Plants Available</th>
                      <td width="2%" style="color: black;">:</td>
                      <td style="color: black;"><?php echo $count?></td>
                    </tr>
                  </table>
                </div>
              </div>
          </div>
        </div>
      </div>           
    </div>
  </div>
</body>
</html>