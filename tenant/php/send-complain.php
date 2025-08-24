<?php 
include_once "../../connection/dbcon.php";
include "../check_session.php";

$title = $_POST['title'];
$message = $_POST['message'];

$get_owner = "SELECT * from tbltenant where Tenant_ID=$tenandid";
$fetch_owner = $con->query($get_owner);
$row = $fetch_owner->fetch_assoc();

$ownerid = $row['Owner_ID'];
$current_Date = date("Y-m-d");


$send_complain = "INSERT into tblcomplain values('','$tenandid','$ownerid','$title','$message','$current_Date')";
$con->query($send_complain);

if($con){
    echo "Sended";
}else{
    echo "not send";
}
?>