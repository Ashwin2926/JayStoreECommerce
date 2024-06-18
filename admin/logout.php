<?php 

    session_start();
    unset($_SESSION['ADMIN']);
    header("location: index.php");
    exit();

?>