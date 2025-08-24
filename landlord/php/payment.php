<?php 
session_start();

include_once "../../connection/dbcon.php";

$tenantid = $_POST['tenantid'];

$tenant = "SELECT `tblpaymentdetails`.*, `tblassign_tenant`.*, `tbltenant`.*
FROM `tblpaymentdetails` 
	LEFT JOIN `tblassign_tenant` ON `tblpaymentdetails`.`Tenant_ID` = `tblassign_tenant`.`Tenant_ID` 
	LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` where tbltenant.Tenant_ID=$tenantid and tblpaymentdetails.Status='unpaid'";
$tenant_fetch = $con->query($tenant);

$date = array();
while($row = $tenant_fetch->fetch_assoc()){
    $date[] = $row;
}

echo json_encode($date);
?>