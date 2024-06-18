<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['cart_id']))
    {

        $del_id = $_GET['cart_id'];
        $query = "delete FROM cart WHERE cart_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:cart.php");
        }
    }







