<?php
   require_once('connection.php');
   session_start();

if(isset($_POST['register'])){
        $username=($_POST['username']);
        $email=($_POST['email']);
        $phone=($_POST['phone']);
        $address=($_POST['address']);
        $password=($_POST['password']);
        $password_2=($_POST['password_confirm']);

        if($password==$password_2){
            $password=md5($password);
            $query="INSERT INTO user(name,email,phone,address,password,type) VALUES('$username','$email','$phone','$address','$password','user')";
            $result=mysqli_query($con,$query);
            echo '<script>alert("Successfully registered")</script>';
            echo '<script>window.location="login.php"</script>';
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
    <form action="reg.php" method="POST" onsubmit="return Validate()" name="vform" >
    <div class="container">
      <div class="nav">
        <div class="logo">
          <img src="./images/logo.png" alt="logo" width="60px" height="60px" />
          <a class="logo-text">Bangladesh Railway</a>
        </div>
        <div class="menu">
          <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="log.php"><?php if(isset($_SESSION['user_id'])){
              echo "Logout";
        }else{
            echo "Login";
        } ?></a></li>
            <li class="active"><a href="reg.php">Register</a></li>
            <li><a href="verify.php">Verify Ticket</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="about.php">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="banner">
      <img src="images/train.jpg" alt="" class="img" />

      <div class="container2">
        <div id="username_div">
		<div class="form_input">
		<input type="text" name="username" placeholder="User Name"/>
        <div id="name_error"></div>
        </div>
		</div>

        <div id="email_div">
		<div class="form_input">
		<input type="text" name="email" placeholder="Email"/>
        <div id="email_error"></div>
        </div>
    	</div>

        <div id="phone_div">
        <div class="form_input">
		<input type="text" name="phone" placeholder="Phone"/>
        <div id="phone_error"></div>
        </div>
    	</div>

    	<div id="address_div">
        <div class="form_input">
		<input type="text" name="address" placeholder="Address"/>
        <div id="address_error"></div>
        </div>
		</div>

        <div id="password_div">
		<div class="form-input">
		<input type="password" name="password" placeholder="Password"/>
		</div>
        </div>

        <div id="pass_confirm_div">
		<div class="form-input">
		<input type="password" name="password_confirm" placeholder="Confirm Password"/>
        <div id="password_error"></div>
        </div>
		</div>

    <input
          type="submit"
          name="register"
          value="Sign Up"
          class="btn-register"
        />

        <p class="login"> Already registered?  <a class="login"href="login.php"><br>Sign in here</a></p>

        
        
      </div>
    </div>

    <div class="footer"></div>
      </form>
  </body>
</html>


<script type="text/javascript">

var username = document.forms['vform']['username'];
var email = document.forms['vform']['email'];
var password = document.forms['vform']['password'];
var password_confirm = document.forms['vform']['password_confirm'];
var phone = document.forms['vform']['phone'];
var address = document.forms['vform']['address'];

var name_error = document.getElementById('name_error');
var email_error = document.getElementById('email_error');
var password_error = document.getElementById('password_error');
var phone_error = document.getElementById('phone_error');
var address_error = document.getElementById('address_error');

username.addEventListener('blur', nameVerify, true);
email.addEventListener('blur', emailVerify, true);
phone.addEventListener('blur', phoneVerify, true);
address.addEventListener('blur', addressVerify, true);
password.addEventListener('blur', passwordVerify, true);

function Validate() {

  if (username.value == "") {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username is required";
    username.focus();
    return false;
  }

  if (username.value.length < 3) {
    username.style.border = "1px solid red";
    document.getElementById('username_div').style.color = "red";
    name_error.textContent = "Username must be at least 3 characters";
    username.focus();
    return false;
  }

  if (email.value == "") {
    email.style.border = "1px solid red";
    document.getElementById('email_div').style.color = "red";
    email_error.textContent = "Email is required";
    email.focus();
    return false;
  }

  if (phone.value == "") {
    phone.style.border = "1px solid red";
    document.getElementById('phone_div').style.color = "red";
    phone_error.textContent = "Phone number is required";
    phone.focus();
    return false;
  }

  if (address.value == "") {
    address.style.border = "1px solid red";
    document.getElementById('address_div').style.color = "red";
    address_error.textContent = "Address is required";
    address.focus();
    return false;
  }

  if (password.value == "") {
    password.style.border = "1px solid red";
    document.getElementById('password_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.textContent = "Password is required";
    password.focus();
    return false;
  }

  if (password.value != password_confirm.value) {
    password.style.border = "1px solid red";
    document.getElementById('pass_confirm_div').style.color = "red";
    password_confirm.style.border = "1px solid red";
    password_error.innerHTML = "The two passwords do not match";
    return false;
  }
}

function nameVerify() {
  if (username.value != "") {
   username.style.border = "1px solid #5e6e66";
   document.getElementById('username_div').style.color = "#5e6e66";
   name_error.innerHTML = "";
   return true;
  }
}
function emailVerify() {
  if (email.value != "") {
    email.style.border = "1px solid #5e6e66";
    document.getElementById('email_div').style.color = "#5e6e66";
    email_error.innerHTML = "";
    return true;
  }
}

function phoneVerify() {
  if (phone.value != "") {
    phone.style.border = "1px solid #5e6e66";
    document.getElementById('phone_div').style.color = "#5e6e66";
    phone_error.innerHTML = "";
    return true;
  }
}

function addressVerify() {
  if (address.value != "") {
    address.style.border = "1px solid #5e6e66";
    document.getElementById('address_div').style.color = "#5e6e66";
    address_error.innerHTML = "";
    return true;
  }
}

function passwordVerify() {
  if (password.value != "") {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    document.getElementById('password_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
  if (password.value === password_confirm.value) {
    password.style.border = "1px solid #5e6e66";
    document.getElementById('pass_confirm_div').style.color = "#5e6e66";
    password_error.innerHTML = "";
    return true;
  }
}
</script>
