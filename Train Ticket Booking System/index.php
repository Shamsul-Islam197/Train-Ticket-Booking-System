<?php
require_once('connection.php');
session_start();



if(isset($_POST['search'])){
  
  $dep=($_POST['departure']);
  $arri=($_POST['arrival']);
  $type=($_POST['class']);
  $date=($_POST['date']);
  $adult=($_POST['adult']);
  $child=($_POST['child']);
  
  $seat = $adult+$child;
  

  $query="SELECT * FROM `train`   WHERE `departure`='$dep' && `arrival`='$arri' && `type`='$type' && `date`='$date'";
  $result=mysqli_query($con,$query);
  $rows=mysqli_fetch_assoc($result);
  if($rows==0){
    echo "<script>alert('No train available')</script>";
  }else if($rows['capacity'] < $seat){
    echo "<script>alert('Not enough seat available')</script>";
  }else{ 
    $a = $rows['train_no']; 
    $b = number_format($rows["fare"]);
    $b = $b*$adult+($b/2)*$child;

    if (isset($_SESSION['cart'])) {
      unset($_SESSION['cart']);
  }else{
    $_SESSION['cart'] = array();
  }
  $train = array(
    "train_id" => $a,
    "adult" => $adult, 
    "child" => $child,
    "bill" => $b,
    "seat" => $seat
);
$_SESSION['cart'][] = $train;
echo "<script>alert('added in the cart')</script>";
header("location:available.php?train_id=$a&adult=$adult&child=$child");
}
}
         
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="stylesheet" type="text/css" href="./css/style.css?version=51" />
    <title>BD Railway</title>
  </head>
  <body>
    <form action="index.php" method="POST" enctype="multipart/form-data">


    <div class="container">
      <div class="nav">
        <div class="logo">
          <img src="./images/logo.png" alt="logo" width="60px" height="60px" />
          <a class="logo-text">Bangladesh Railway</a>
        </div>
        <div class="menu">
          <ul>
            <li class="active"><a href="index.php">Home</a></li>
            <li><a href="log.php"><?php if(isset($_SESSION['user_id'])){
              echo "Logout";
        }else{
            echo "Login";
        } ?></a></li>
            <li><a href="reg.php">Register</a></li>
            <li><a href="verify.php">Verify Ticket</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="about.php">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="banner">
      <img src="images/train.jpg" alt="" class="img" />
      <h2 class="welcome title">Welcome to</h2>
      <h2 class="railway title">Bangladesh Railway</h2>

      <div class="container2">

        <label class="label">Route</label>

        <div class="select-box" >

        <select name="departure" required>

        <option value="" disabled selected hidden>From</option>

        <?php 
        $query="select Distinct departure from train ORDER by departure ASC";
        $result=mysqli_query($con,$query);
        while($rows=mysqli_fetch_assoc($result)){
        ?>

    
        <option>
        <?php echo $rows['departure']; ?>
        </option>
        <?php 
        }
        ?>

        </select>
        </div>
        <div class="select-box" >
        <select name="arrival" required>
          <option value="" disabled selected hidden>To</option>
        

        <?php 
        $query="select Distinct arrival from train ORDER by arrival ASC";
        $result=mysqli_query($con,$query);
        while($rows=mysqli_fetch_assoc($result)){
        ?>
        <option>
        <?php echo $rows['arrival']; ?>
        </option>
        <?php 
        }
        ?>

        </select>
        </div>

        <label class="label">Date</label>
        <input type="date" name="date" class="input" required/>
        <label class="label">Class</label>


        <div class="select-box" >
        <select name="class" required>
        <option value="" disabled selected hidden>Class</option>
        <?php 
        $query="select Distinct type from train";
        $result=mysqli_query($con,$query);
        while($rows=mysqli_fetch_assoc($result)){
        ?>
        <option>
        <?php echo $rows['type']; ?>
        </option>
        <?php 
        }
        ?>
        </select>
        </div>
        


        <label class="label">Passenger(s)</label>
        
        <div class="select-box" required>
        <select  name="adult" required>
          <option value="" disabled selected hidden>Adult</option>
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>

        </select>
        </div>

        <div class="select-box">
        <select name="child" required>
          <option value="" disabled selected hidden>Child</option>
          <option>0</option>
          <option>1</option>
          <option>2</option>
          

        </select>
        </div>

        <input type="submit" name="search" value="Search" class="btn-search" />
      </div>
    </div>





    <div class="info">
      <div class="text">
        <div>
          <h1>Get Train Tickets from the <br />comfort of your home</h1>
          <p>
            Book train tickets from anywhere using the robust ticketing platform
            exclusively built to provide the passengers with pleasant ticketing
            experience. Also check out the mobile app RailSheba to further
            extend your pleasure of booking train tickets.
          </p>
        </div>
        <div>
          <h1>
            Train & Ticketing related<br />
            information at your fingertips
          </h1>
          <p>
            Checkout available seats, route information, fare information on
            real time basis with Esheba Platform.
          </p>
        </div>
        <div>
          <h1>Pay Securely</h1>
          <p>
            Pay using your convenient payment option. Bangladesh Railway
            supports Visa, Master, Amex & Nexus Cards, Rocket and bKash Mobile
            Financial Services for your convenience.
          </p>
        </div>
      </div>
    </div>

    <div class="footer"></div>
      </form>
  </body>
</html>
