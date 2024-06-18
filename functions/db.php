<?php 
 
    $con = mysqli_connect("localhost","root","","store") or die("Connection Failed");

    if(!$con)
    {
        echo "Connection Failed!";
        exit();
    }