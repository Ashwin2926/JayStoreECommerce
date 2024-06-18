<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['order_id']))
    {
        $del_id = $_GET['order_id'];
        $query = "delete FROM orders WHERE order_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:manage_order.php");
        }
    }
