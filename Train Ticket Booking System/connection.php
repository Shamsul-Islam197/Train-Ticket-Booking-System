<?php

    $con=mysqli_connect('localhost','root','','train_ticket');

    if(!$con)
    {
        die(' Please Check Your Connection'.mysqli_error($con));
    }
?>
