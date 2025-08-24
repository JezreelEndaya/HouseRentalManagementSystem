<?php 

include_once "../../connection/dbcon.php";

if(!$_POST['date'] == ""){

    $date =  $_POST['date'];
    $tenantid = $_POST['tenantid'];

    $info_query = "SELECT * from tblpaymentdetails where Tenant_ID=$tenantid and Date='$date'";
    $info_fetch = $con->query($info_query);
    $row = $info_fetch->fetch_assoc();

    $amount_to_pay = $row['Amount_To_Pay'];

    $update_payment = "UPDATE tblpaymentdetails set Status='paid', Amount_Paid='$amount_to_pay' where Tenant_ID=$tenantid and Date='$date'";
    $con->query($update_payment);

    if($con){
        echo "Successfully Paid";
    }else{
        echo "Error in submitting transation";
    }

}else{
    
    echo "Invalid Data";

}

?>