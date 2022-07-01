<?php

require_once('connection.php');
session_start();
$id2;
if(isset($_GET['train_id'])){
$id = $_GET['train_id'];
$adult = $_GET['adult'];
$child = $_GET['child'];
}else{
  $id = "";
}

$query="SELECT * FROM `train`   WHERE `train_no`='$id'";
$result=mysqli_query($con,$query);



if(isset(($_POST['purchase']))){
  $user_id = ($_SESSION['user_id']);
  if(!empty($_SESSION["cart"])){
    foreach ($_SESSION["cart"] as $key => $value) {
      $id = $value["train_id"];
      $adult = $value["adult"];
      $child = $value["child"];
      $bill = $value["bill"];
      $seat = $value["seat"];

      $ticket = TicketNumber(6);
      $pin = TicketNumber(4);

      $query2="INSERT INTO `purchased` (`train_id`,`customer_id`,`adult`, `child`,`total_fare`,`ticket_no`,`pin`)
      VALUES ('$id','$user_id','$adult', '$child','$bill','$ticket','$pin');";
      if(mysqli_query($con,$query2)){
        echo "<script>alert('Purchased')</script>";
      }

       $query2 = " SELECT * FROM `train` where train_no='".$id."'";

                        $result = mysqli_query($con,$query2);

                        while($rows=mysqli_fetch_assoc($result)){
                            $tmp=$rows['capacity'];
                        }
                        $tmp=$tmp-$seat;
                        $query3="UPDATE `train` SET `capacity` = '".$tmp."' WHERE `train_no` = '".$id."'";
                        $result2=mysqli_query($con,$query3);
                        }
    }
     unset($_SESSION['cart']);
     echo '<script>window.location="index.php"</script>';
    }


    function TicketNumber(int $length) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/available.css?version=51" />
    <title>BD Railway</title>
  </head>
  <body>
  <form action="available.php" method="POST" >
    <div class="container">
      <div class="nav">
        <div class="logo">
          <img src="./images/logo.png" alt="logo" width="60px" height="60px" />
          <a class="logo-text">Bangladesh Railway</a>
        </div>
        <div class="menu">
          <ul>
            <li ><a href="index.php">Home</a></li>
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

    <div class="header">
      <label class="label">Purchase your ticket</label>
    </div>

    <div>
      <div class="content-table">
    <table >
    <thead>
    <tr>
      <th>Train Name</th>
      <th>Departure</th>
      <th>Dep. Time</th>
      <th>Arrival</th>
      <th>Class</th>
      <th>Date</th>
      <th>Fare</th>
      <th>Total Fare</th>
    </tr> 
    
    <?php
                    while($rows=mysqli_fetch_assoc($result))
                    {
                            ?>
                        <tr>
                            <td>
                                <?php echo $rows["train_name"]?>
                            </td>
                             <td>
                                <?php echo $rows["departure"]?>
                            </td>
                             <td>
                                <?php echo $rows["dep_time"]?>
                            </td>
                             <td>
                                <?php echo $rows["arrival"]?>
                            </td>
                             <td>
                                <?php echo $rows["type"]?>
                            </td>
                             <td>
                                <?php echo $rows["date"]?>
                            </td>
                            <td>
                                <?php echo $rows["fare"]." TK"?>
                            </td>
                            <td>
                                <?php $bill = number_format($rows["fare"]);
                                      $bill = $bill*$adult+($bill/2)*$child;
                                      echo $bill." TK";
                                ?>
                            </td>
                        </tr>
                    <?php
                    }
                 ?>
    
  </thead>
    </table>
  </div>

  <div>
      <input
          type="submit"
          name="purchase"
          value="Purchase"
          class="btn-purchase"
          onclick="return Confirmation()"
        />
  </div>


     <div class="footer"></div>
  </body>
</html>

<script type="text/javascript">
    function Confirmation(){
    var user = '<?php  
    if(isset(($_SESSION['user_id']))){
      echo $_SESSION['user_id'];
    } 
    ?>';

    if(user.length===0){
      alert('Not logged in')
      window.open('login.php','_blank');
      return false;
    }else{
    var x=confirm("Are you sure?")
    if(x==true){
        return true;
    }else{
        return false;
    }
    }
}

        
</script>