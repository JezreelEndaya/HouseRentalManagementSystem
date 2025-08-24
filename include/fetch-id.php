<?php 
if (!isset($_SESSION)) {
    session_start();
}

if (isset($_SESSION['User_ID'])) {

    $id = $_SESSION['User_ID'];

    $mainquery= "SELECT `tbluser`.*,tbluser.User_ID as userid, `tblowners`.*,tblowners.Firstname as ownername, `tblapartment`.*,tblapartment.Apartment_ID as apartmentid, `tblhouse`.*,tblhouse.House_ID as houseid, `tblassign_tenant`.*,tblassign_tenant.House_ID as tenanthouseid, `tbltenant`.*,tbltenant.Tenant_ID as tenantid,tbltenant.Firstname as tenantname
            FROM `tbluser` 
            LEFT JOIN `tblowners` ON `tblowners`.`User_ID` = `tbluser`.`User_ID` 
            LEFT JOIN `tblapartment` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` 
            LEFT JOIN `tblhouse` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
            LEFT JOIN `tblassign_tenant` ON `tblassign_tenant`.`House_ID` = `tblhouse`.`House_ID` 
            LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID`
            WHERE `tblowners`.`User_ID` = '$id';";
    $resultmain = $con->query($mainquery);

    $tenantidcount = array();
    $apartmentidcount = array();
    $houseidcount = array();

    while($row = $resultmain->fetch_assoc()){

        // couting number of house
        if($row['houseid'] !== null){
            $houseidcount[$row['houseid']] =  true;
        }
        
        // counting number of user
        if($row['tenantid'] !== null){
            $tenantid[$row['tenantid']] =  true;
        }

        // counting number of apartment
        if($row['apartmentid'] !== null){
            $apartmentid[$row['apartmentid']] =  true;
        }
    }

    // count vacant houses
    $list_vacant_houses_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*
    FROM `tblhouse` 
    LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
    LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tblowners.User_ID='$id' and tblhouse.Status='Vacant' ";
    $list_vacant_houses_result = $con->query($list_vacant_houses_query);

    $vacantcount = array();
    while($row = $list_vacant_houses_result ->fetch_assoc()){

        // couting number of vacant house
        if($row['House_ID'] !== null){
            $vacantcount[$row['House_ID']] =  true;
        }
    }
    
    // owner query
    $sqlqueryall = "SELECT `tblowners`.`Owner_ID`, `tblowners`.`Firstname`, `tblowners`.`Lastname`, `tblowners`.`Lastname`, `tblowners`.`Contact_Number`, `tblowners`.`Membership_StartDate`, `tbluser`.`User_ID`, `tbluser`.`Email_Address`, `tblowners`.`User_ID`
    FROM `tblowners` 
    LEFT JOIN `tbluser` ON `tblowners`.`User_ID` = `tbluser`.`User_ID` where `tblowners`.`User_ID` = '$id';";
    $resultall = $con->query($sqlqueryall);
    $allid = $resultall->fetch_assoc();

    // owner id query
    $owneridquery = "SELECT * from tblowners where User_ID='$id'";
    $owneridresult = $con->query($owneridquery) or die($con->error);
    $owneridrow = $owneridresult->fetch_assoc();
    
    // fetched owner id
    @$ownerid = $owneridrow['Owner_ID'];
    
    // apartment id query
    $apartmentidquery = "SELECT * from tblapartment where Owner_ID='$ownerid'";
    $apartmentidresult = $con->query($apartmentidquery);
    
    $apartmentid = array();
    while($apartmentidrow = $apartmentidresult->fetch_assoc()){
        $apartmentid[] = $apartmentidrow;
    }

    $housesquery = "SELECT `tblapartment`.*, `tblhouse`.*
    FROM `tblapartment` 
    LEFT JOIN `tblhouse` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where Owner_ID='$ownerid';";
    $housesresultss = $con->query($housesquery);

    // tenant id query
    $tenantquery = "SELECT * from tbltenant where Owner_ID='$ownerid'";
    $tenantresult = $con->query($tenantquery);

    $tenantid = array();
    while($tenantrow = $tenantresult->fetch_assoc()){
        $tenantid[] = $tenantrow;
    }

    // number of tenatn who doesnt have house yet
    $tenantnullquery = "SELECT `tbltenant`.*,tbltenant.Tenant_ID as tenantid, `tblassign_tenant`.*
    FROM `tbltenant` 
    LEFT JOIN `tblassign_tenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID`
    where House_ID is null;";
    $tenantnullresult = $con->query($tenantnullquery);

    // ids of null tenants
    $tenantnullid = array();
    while($tenantnullrow = $tenantnullresult->fetch_assoc()){
        $tenantnullid[] = $tenantnullrow;
    }

    // generate tenant id based on last id 
    $tenantidquery = "SELECT * from tbltenant ORDER BY tenant_id DESC LIMIT 1";
    $tenantidresult = $con->query($tenantidquery);
    @$tenandidrow = $tenantidresult->fetch_assoc()['Tenant_ID'];
    
    $lasttenantid = intval($tenandidrow);
    $newtenantid = $lasttenantid+1;

    // date now
    $datenow =  strval(date("Y-m-d"));

    $occupied_house_query = "SELECT `tblassign_tenant`.*, `tbltenant`.*,`tbltenant`.Owner_ID as ownerid, `tblhouse`.*, `tblapartment`.*
    FROM `tblassign_tenant` 
        LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
        LEFT JOIN `tblhouse` ON `tblassign_tenant`.`House_ID` = `tblhouse`.`House_ID` 
        LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` WHERE tbltenant.Owner_ID='$ownerid'";
    $result_occupied_house = $con->query($occupied_house_query);


    $payment = "SELECT `tblassign_tenant`.*, `tblpaymentdetails`.*, `tbltenant`.*, `tblowners`.*, SUM(tblpaymentdetails.Amount_Paid) 
        FROM `tblassign_tenant` 
        LEFT JOIN `tblpaymentdetails` ON `tblpaymentdetails`.`Tenant_ID` = `tblassign_tenant`.`Tenant_ID` 
        LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
        LEFT JOIN `tblowners` ON `tbltenant`.`Owner_ID` = `tblowners`.`Owner_ID` where tbltenant.Owner_ID=$ownerid;";
    $paymentFetch = $con->query($payment);
    $paymentrow = $paymentFetch->fetch_assoc();




} else {
    header('Location: ../login.php');
}

?>