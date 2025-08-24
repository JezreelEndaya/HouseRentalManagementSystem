<?php 
include_once "../../connection/dbcon.php";
include_once "../../include/fetch-id.php";

    

    if(isset($_POST['submit'])){

        $tenantname = $_POST['tenantName'];
        $apartmentname = $_POST['apartmentName'];
        $housename = $_POST['houseType'];

        // house id query based on selected
        $selectedhouseidquery = "SELECT `tblapartment`.*,tblapartment.Apartment_ID as apartmentid, `tblhouse`.*
        FROM `tblapartment` 
        LEFT JOIN `tblhouse` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID`
        where tblapartment.Apartment_ID='$apartmentname' and Status='Vacant'";
        $selectedhouseidresult = $con->query($selectedhouseidquery);
        $selectedhouseidrow = $selectedhouseidresult->fetch_assoc();
        
        $selectedhouseid = $selectedhouseidrow['House_ID'];

        if(
            $tenantname === 'tenantname' ||
            $tenantname === 'noregister' ||
            empty($housename))
        {
            header('Location: ../assign-tenant.php?error=Fields with asterisk (*) is required');
        }else{
            $addtenanthousequery = "INSERT into tblassign_tenant(Tenant_ID,House_ID)Values
                                                                ('$tenantname','$selectedhouseid')";
            $addtenanthouseresult = $con->query($addtenanthousequery);

            $updatestatus = "UPDATE tblhouse set Status='Occupied' where House_ID='$selectedhouseid'";
            $con->query($updatestatus);
            header('Location: ../assign-tenant.php');
        }
    }

    if(isset($_POST['apartmentName']) && !isset($_POST['submit'])){
        $apartmentid = $_POST['apartmentName'];

        $housequery = "SELECT * from tblhouse WHERE Apartment_ID='$apartmentid' and Status='Vacant'";
        $houseresult = $con->query($housequery);
       
        $housetype = array();
        while($row =  $houserow = $houseresult->fetch_assoc()){
            $housetype[] = $row['House_Type'];
        }

        echo json_encode($housetype);
    }
?>