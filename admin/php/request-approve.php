<?php 
if(!isset($_SESSION)){
    session_start();
}

include_once "../../connection/dbcon.php";

if(isset($_GET['userid'])){

    $userid = $_GET['userid'];

    $update_status = "UPDATE tbluser set verify_status=1 where User_ID=$userid";
    $con->query($update_status);

    header('Location: ../admin-request.php');
}else{
    header('Location: ../admin-request.php');
}
?>