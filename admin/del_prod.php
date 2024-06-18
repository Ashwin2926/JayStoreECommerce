<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['product_id']))
    {
        $del_id = $_GET['product_id'];
        $query = "delete FROM products WHERE product_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:manage_product.php");
        }
    }


?>