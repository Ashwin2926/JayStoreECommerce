<?php

    require_once 'inc/header.php'; 

    if(isset($_GET['contact_id']))
    {
        $del_id = $_GET['contact_id'];
        $query = "delete FROM contacts WHERE contact_id = '$del_id'";
        $result = mysqli_query($con,$query);

        if($result)
        {
            header("location:manage_contact.php");
        }
    }


?>