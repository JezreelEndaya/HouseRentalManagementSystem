<?php 
include_once "../../connection/dbcon.php";
include_once "../../include/fetch-id.php";


    if(isset($_GET['search'])){

        $name = $_GET['apartmentname'];
        $houseid = $_GET['housetype'];
        header('Location: ../assign-tenant.php?&apartment='  . urlencode($name) . '');
    }

?>