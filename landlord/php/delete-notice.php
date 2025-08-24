<?php 

include_once "../../connection/dbcon.php";

if(isset($_GET['id'])){
    $notice_id = $_GET['id'];

    $delete_notice_query = "DELETE from tblassignnotice where Notice_ID=$notice_id";
    $con->execute_query($delete_notice_query);

    $delete_allnotice_query = "DELETE from tblnotice where Notice_ID=$notice_id";
    $con->execute_query($delete_allnotice_query);

    $con->close();

    if($con){
        header('Location: ../manage-notice.php');
    }
}

?>