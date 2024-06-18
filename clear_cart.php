<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['delete_all']))
    {
        // Get user_id from session
	    $user_id = $_SESSION["user_id"];

        $query = "delete FROM cart WHERE user_id = '$user_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:cart.php");
        }
    }
