<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['category_id']))
    {
        $del_id = $_GET['category_id'];
        $query = "delete FROM categories WHERE category_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:manage_category.php");
        }
    }


?>