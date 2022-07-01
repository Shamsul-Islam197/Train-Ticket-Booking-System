<?php
require_once('connection.php');
session_start();

    if(isset($_POST['login']))
    {
            $email=($_POST['email']);
            $password=($_POST['password']);
            $password=md5($password);
            $query="select * from user where email='$email' and password='$password'";
            $result=mysqli_query($con,$query);
            $type="";
            $id="";

            if(mysqli_num_rows($result)>0)
            {
                while($row = mysqli_fetch_array($result)){
                    $type=$row["type"];
                    $id=$row["user_id"];

                    if($row["type"]=="admin"){
                        $_SESSION['user_id']=$row["user_id"];
                        echo "<script>alert('Successfully logged in')</script>";
                        echo '<script>window.location="index.php"</script>';
                    }else{
                        $_SESSION['user_id']=$row["user_id"];
                        echo "<script>alert('Successfully logged in as user')</script>";
                        echo '<script>window.location="index.php"</script>';
                        
                    }
                }
            }
            else{
                echo "<script>alert('Username or password is wrong')</script>";
            }
    }




?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/reg.css?version=51" />
    <title>BD Railway</title>
  </head>
  <body>
  <form action="login.php" onsubmit="return Validate()" name="vform" method="POST" enctype="multipart/form-data">
    <div class="container">
      <div class="nav">
        <div class="logo">
          <img src="./images/logo.png" alt="logo" width="60px" height="60px" />
          <a class="logo-text">Bangladesh Railway</a>
        </div>
        <div class="menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li class="active"><a href="log.php"><?php if(isset($_SESSION['user_id'])){
              echo "Logout";
        }else{
            echo "Login";
        } ?></a></li>
            <li ><a href="reg.php">Register</a></li>
            <li><a href="verify.php">Verify Ticket</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="about.php">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="banner">
      <img src="images/train.jpg" alt="" class="img" />

      <div class="container2" style ="height:280px">
    
        <div id="email_div">
		<div class="form-input">
		<input type="text" name="email" placeholder="Email"/>
        <div id="email_error"></div>
        </div>
		</div>
        
		<div class="form-input">
        <div id="password_div">
		<input type="password" name="password" placeholder="Password"/>
        <div id="password_error"></div>
        </div>
		</div>
        

        <input
          type="submit"
          name="login"
          value="Sign In"
          class="btn-register"
        />

        <p class="login"> Not registered?  <a class="login"href="reg.php"><br>Sign up here</a></p>
        
      </div>
    </div>

    <div class="footer"></div>
    </form>
  </body>
</html>

<script type="text/javascript">
    var email = document.forms['vform']['email'];
    var password = document.forms['vform']['password'];

    var email_error = document.getElementById('email_error');
    var password_error = document.getElementById('password_error');

    email.addEventListener('blur', emailVerify, true);
    password.addEventListener('blur', passwordVerify, true);

    function Validate() {
  
  if (email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }
  

  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }
}
</script>
