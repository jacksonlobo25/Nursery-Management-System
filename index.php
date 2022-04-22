<?php
    session_start();
    include("connect/config.php");
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $firstname = $_POST["firstname"];
        $username = $_POST["username"];
        $address = $_POST["address"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $gender = $_POST["gender"];
        $password = $_POST["password"];
        $confirmpassword = $_POST["confirmpassword"];
        if ($password == $confirmpassword){
            $query = "INSERT INTO customers(C_name,Address,Phone,gender,gmail,password,password1,username) 
            VALUES ('$firstname','$address','$phone','$gender','$email','$password','$confirmpassword','$username')";
            mysqli_query($conn,$query);
            echo "<script type='text/javascript'>alert('Account successfully created');
            window.location='login.php';</script>";
            die;
        }
        else{
            echo "<script>alert(\"Password must be same !\")</script>";
        }
    }
?>


<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/register.css">
</head>

<body>

    <div class="container">
        <h2>Sign Up</h2>
        <form action="" method="post">
            <div class="form-item-username">
                <input type="text" name="firstname" placeholder="Full Name" required>
            </div>

            <div class="form-item-username">
              <input type="text" name="username" placeholder="Username" required>
            </div>
            
            <div class="form-item">
                <input type="text" name="address"  placeholder="Address" required>
            </div>
            <div class="form-item">
                <input type="email" name="email" placeholder="Email" required>
            </div>

            <div class="form-item">
              <input type="text" name="phone"  placeholder="Phone Number"  pattern="[0-9]{10}" required>
            </div>
            <div class="form-item">
              <input type="text" name="gender" placeholder="Gender" required>
            </div>
            <div class="form-item">
                <input type="password" name="password" placeholder="Enter password"  pattern="[A-Za-z0-9#$%*^]{7,16}" required>
            </div>
            <div class="form-item">
                <input type="password" name="confirmpassword"  placeholder="Confirm password" pattern="[A-Za-z0-9#$%*^]{7,16}"  required>
            </div>
            <p><small>Must contain atleast 8 characters</small></p>
            <div class="form-btns">
                <button class="signup" type="submit" name="register">Register</button>
                <div class="options">
                    Already have an account? <a href="login.php">Login here</a>
                </div>
            </div>
        </form>
    </div>

    <script src="/js/register.js">
    </script>

</body>

</html>