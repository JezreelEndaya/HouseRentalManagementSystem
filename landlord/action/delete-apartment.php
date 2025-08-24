<?php 
    if (!isset($_SESSION)) {
        session_start();
    }

    include_once '../../connection/dbcon.php';

    if(isset($_GET['apartmentid'])){

        $apartmentid = $_GET['apartmentid'];
        
        $sqlquery = "DELETE from tblapartment where Apartment_ID='$apartmentid'";
        $con->execute_query($sqlquery);

        header('Location: ../apartment.php?success=Deleted Successfully');
    }else{
        
    ;    }
?>