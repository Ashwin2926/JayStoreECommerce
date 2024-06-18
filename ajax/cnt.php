<?php

    require_once '../functions/db.php';
    require_once '../functions/functions.php';

    if(isset($_SERVER['REQUEST_METHOD'])=='POST')
    {
       
        $name = safe_value($con,$_POST['Name']);
        $email = safe_value($con,$_POST['Email']);
        $subject = safe_value($con,$_POST['Subject']);
        $message = safe_value($con,$_POST['Message']);

        $query="insert into contacts(name,email,subject,message) values ('$name','$email','$subject','$message')";
        $result = mysqli_query($con,$query);

        if($result)
        {
            echo "Thank you for contact us. Our team will get back to you.";
        }  

    }
