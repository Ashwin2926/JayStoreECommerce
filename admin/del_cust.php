<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['customer_id']))
    {
        $del_id = $_GET['customer_id'];
        $query = "delete FROM customers WHERE customer_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:manage_customer.php");
        }
    }
