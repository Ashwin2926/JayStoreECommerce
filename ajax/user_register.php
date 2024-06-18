<?php 

    require_once '../functions/db.php';
    require_once '../functions/functions.php';

    if(isset($_SERVER['REQUEST_METHOD'])=='POST')
    {
        $first_name = safe_value($con,$_POST['first_name']);
        $last_name = safe_value($con,$_POST['last_name']);
        $address = safe_value($con,$_POST['address']);
        $city = safe_value($con,$_POST['city']);
        $state = safe_value($con,$_POST['state']);
        $zipcode = safe_value($con,$_POST['zipcode']);
        $phone = safe_value($con,$_POST['phone']);
        $email = safe_value($con,$_POST['email']);
        $password = safe_value($con,$_POST['password']);

        $query="select * from customers where email = '$email'";
        $result = mysqli_query($con,$query);

        if(mysqli_num_rows($result)){
            echo "Email Already Exists";
        }
        else{

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $query = "insert into customers(first_name,last_name,address,city,state,zipcode,phone,email,password,status) values('$first_name','$last_name','$address','$city','$state','$zipcode','$phone','$email','$hash','1')";
            $result = mysqli_query($con,$query);

            if($result){
                echo "Welcome!, Registration Successful ) <a href='./login.php'>Login Now</a>";
            }
        }
    }
 