<?php 
 session_start();
 include("connect/config.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];
    if($username == "admin" && !empty($password)){
        $query1 = "SELECT * FROM nursery WHERE password = '$password' LIMIT 1";
        $result1 = mysqli_query($conn,$query1);
        global $dbnid;
        if($result1){
            if($result1 && mysqli_num_rows($result1)>0){
                $user_data1 = mysqli_fetch_assoc($result1);
                if($user_data1['password'] === $password){
                    $dbnid = $user_data1['N_id'];
                    $_SESSION['nurseryid'] = $dbnid;
                    echo "<script type='text/javascript'>alert('Logged in Successfully');
                    window.location='admindash.php';</script>";
                    die;
                }
            }
        }
        echo "<script>alert(\"User doesn't exist!\")</script>";
    }
    if(!empty($username) && !empty($password)){
        $query = "SELECT * FROM customers WHERE username= '$username' LIMIT 1";
        $result = mysqli_query($conn,$query);
        global $dbcid;
        if($result){
            if($result && mysqli_num_rows($result)>0){
                $user_data = mysqli_fetch_assoc($result);
                if($user_data['password'] === $password){
                    $dbcid = $user_data['C_id'];
                    $_SESSION['custid'] = $dbcid;
                    echo "<script type='text/javascript'>alert('Logged in Successfully');
                    window.location='custdash.php';</script>";
                    die;
                }
            }
        }
        echo "<script>alert(\"User doesn't exist!\")</script>";
    }
}
?>

<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/login.css">

<body>
    <div class="container">
        <h2>Sign In</h2>
        <form method="post" name="custid">
            <div class="form-item-username">
              <input type="text" name="username" id="firstName" placeholder="Username">
          </div>

            <div class="form-item">
                <input type="password" name="password" id="password" placeholder="Enter password">
            </div>
            <div class="form-btns">
                <button class="signup" type="submit" name="login">Login</button>
            </div>
            <div class="form-btns">
                <div class="options">
                    Don't have an account? <a href="index.php">Register here</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>