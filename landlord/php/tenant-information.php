<?php 
include_once "../../connection/dbcon.php";
include_once "../../include/fetch-id.php";

    if(isset($_SESSION['User_ID'])){

        // stored user id
        $id = $_SESSION['User_ID'];

        if(isset($_GET['tenantid'])){

            $tenantid = $_GET['tenantid'];

            $tenantquery = "SELECT `tbltenant`.* FROM `tbltenant` where Tenant_ID='$tenantid'";
            $tenantresult  = $con->query($tenantquery);

            while($tenantrow = $tenantresult->fetch_assoc()){
                echo "Tenant ID: " ; echo $tenantrow['Tenant_ID']; echo " ";
                echo "Firstname: " ; echo $tenantrow['Firstname']; echo " ";
                echo "Middlename: " ; echo $tenantrow['Middlename']; echo " ";
                echo "Lastname: " ; echo $tenantrow['Lastname']; echo " ";
                echo "Email_Address: " ; echo $tenantrow['Email_Address']; echo "<br>";
            }
        }

        
    }


?>