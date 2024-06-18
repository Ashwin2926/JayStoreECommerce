<?php

    session_start();
    require_once '../functions/db.php';
    require_once '../functions/functions.php';

    if(isset($_SERVER['REQUEST_METHOD'])=='POST')
    {
       
        $email = safe_value($con,$_POST['Email']);
        $password = safe_value($con,$_POST['Password']);

        $query="SELECT * FROM customers WHERE email = '$email' AND status = '1';";
        $result = mysqli_query($con,$query);

        if($row=mysqli_fetch_assoc($result))
        {
            $desh=password_verify($password,$row['password']);

            if($desh==false)
            {
                echo "invalid";
            }

            if($desh==true)
            {
                echo "valid";
                $_SESSION['EMAIL_USER_LOGIN'] = $row["email"];
                $_SESSION['user_id'] = $row["customer_id"];
            }
        }      

    }
