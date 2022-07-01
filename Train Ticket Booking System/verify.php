<?php 
require_once('connection.php');
session_start(); 
$found=0;
if(isset($_POST['search'])){
  $ticket=($_POST['ticket']);
  $pin=($_POST['pin']);

  $query="SELECT * FROM `purchased`   WHERE `ticket_no`='$ticket' && `pin`='$pin'";
  $result=mysqli_query($con,$query);
  $rows=mysqli_fetch_assoc($result);
  

  

  if($rows==0){

    $found=2;
  }else{
    $found=1;
    $train_id= $rows['train_id'];
    $customer_id = $rows['customer_id'];
    $query2="SELECT * FROM `train` WHERE `train_no`='$train_id'";
    $result2=mysqli_query($con,$query2);
    $rows=mysqli_fetch_assoc($result);


    $query3="SELECT * FROM `user` WHERE `user_id`='$customer_id'";
    $result3=mysqli_query($con,$query3);
  }
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="./css/verify.css?version=51" />
    <title>BD Railway</title>
  </head>
  <body>
  <form action="verify.php" method="POST" enctype="multipart/form-data">
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
            <li class="active"><a href="verify.php">Verify Ticket</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="about.php">About Us</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="header">
    <?php if($found!=2){?>
      <label class="label">Verify your ticket</label>
      <?php } else {?>
      <label class="label">Not Found</label>
      <?php }?>
    </div>

    <div>
    <div class="container2">
    
        <input
          type="text"
          name="ticket"
          class="form_input"
          required
          placeholder="Ticket Number"
        />
        
        <input
          type="password"
          name="pin"
          class="form_input"
          required
          placeholder="Pin"
        />

        <input
          type="submit"
          name="search"
          value="Search"
          class="btn-search"
        />
    </div>

      <div class="content-table">
    <table >
    <thead>
    <tr>
      <th>Passenger Name</th>
      <th>Phone</th>
      <th>Email</th>
      <th>Route</th>
      <th>Date</th>
      <th>Class</th>
      
    </tr> 

                        <?php if($found==1){ ?>
                        <tr>
                        <?php
                    while($row=mysqli_fetch_assoc($result3))
                    {
                      ?>
                        <td>
                        <?php echo $row["name"] ?>
                        </td>
                        <td>
                        <?php echo $row["phone"] ?>

                        </td>
                        <td>
                        <?php echo $row["email"] ?>

                        </td>
                         <?php
                    }
                 ?> 
                        
                        <?php
                    while($row=mysqli_fetch_assoc($result2))
                    {
                            ?>
                            <td>
                                <?php echo $row["departure"]."-To-". $row["arrival"] ?>
                            </td>

                            <td>
                                <?php echo $row["date"] ?>
                            </td>

                            <td>
                                <?php echo $row["type"] ?>
                            </td>
                            <?php
                    }
                 ?> 

                
                            
                        </tr>
                        <?php } ?>
                    


  </thead>
    </table>
  </div>


     <div class="footer"></div>
     </form>
  </body>
</html>