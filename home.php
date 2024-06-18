<?php 

    require_once 'functions/config.php';
	require_once 'functions/functions.php';


   if(!isset($_SESSION['EMAIL_USER_LOGIN'])){
    header("Location: login.php");
   }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/style.css">
    <title>Home</title>
</head>
<body>
    <div class="nav">
        <div class="logo">
            <p><a href="home.php">JaySore</a> </p>
        </div>

        <div class="right-links">

            <?php 
            
            $user_id = $_SESSION['user_id'];
            try{
            $query = mysqli_query($con,"SELECT * FROM customers WHERE customer_id=$user_id");
            
            while($result = mysqli_fetch_assoc($query)){
                $res_first = $result['first_name'];
                $res_last = $result['last_name'];
                $res_email = $result['email'];
                $res_phone = $result['phone'];
                $res_id = $result['customer_id'];
            }
            
        } catch (mysqli_sql_exception $e) { 
            var_dump($e);
            exit; 
         } 

            echo "<a href='profileedit.php?id=$res_id'>Change Profile</a>";
            ?>

            <a href="php/logout.php"> <button class="btn">Log Out</button> </a>

        </div>
    </div>
    <main>

       <div class="main-box top">
          <div class="top">
            <div class="box">
                <p>Hello <b><?php echo $res_first ?></b> <b><?php echo $res_last ?></b>, Welcome</p>
            </div>
            <div class="box">
                <p>Your email is <b><?php echo $res_email ?></b>.</p>
            </div>
          </div>
          <div class="bottom">
            <div class="box">
                <p>Your mobile number is <b><?php echo $res_phone ?> </b>.</p> 
            </div>
          </div>
       </div>

    </main>
</body>
</html>