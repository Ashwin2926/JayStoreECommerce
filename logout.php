<?php
      session_start();
      unset($_SESSION['EMAIL_USER_LOGIN']);
      unset($_SESSION['user_id']);
      session_unset();
      session_destroy();
      header("location:index.php");		    
?>
