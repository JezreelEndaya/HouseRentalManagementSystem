<?php

session_start();

if(isset($_SESSION['User_ID'])){

    $tenandid = $_SESSION['User_ID'];

}else{
    header('Location: ../login.php');
}
?>