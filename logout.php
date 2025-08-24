<?php 
    session_start();
    unset($_SESSION['User_ID']);
    header('location: login.php');
?> 