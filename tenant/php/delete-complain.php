<?php 
include_once "../../connection/dbcon.php";

session_start();

if(isset($_GET['complainid'])){

    $complainid = $_GET['complainid'];

    $delete_complain = "DELETE from tblcomplain where Complain_ID=$complainid";
    $con->execute_query($delete_complain);

    if($con){
        $_SESSION['alert'] = "Deleted Successfully";
    }else{
        $_SESSION['alert'] = "Error in deleting Complain";
    }

    header('Location: ../view-complain.php');

}


?>