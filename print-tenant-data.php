<?php 
    include "connection/dbcon.php";

    require 'dompdf/autoload.inc.php';
    use Dompdf\Dompdf;
    use Dompdf\Options;

    $tenantid = $_GET['tenantid'];

    $query = "SELECT `tblassign_tenant`.*, `tbltenant`.*,tbltenant.Firstname as tfname,tbltenant.Middlename as tmname,tbltenant.Lastname as tlname, `tblhouse`.*, `tblapartment`.*,`tblowners`.*,tblowners.Firstname as ofname,tblowners.Lastname as olname
        FROM `tblassign_tenant` 
        LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
        LEFT JOIN `tblhouse` ON `tblassign_tenant`.`House_ID` = `tblhouse`.`House_ID` 
        LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
        LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tbltenant.Tenant_ID=$tenantid;";
    $fetch = $con->query($query);
    $row = $fetch->fetch_assoc();

    $fullname = ucwords($row['tfname']) ."_". ucwords($row['tmname']) ."_". ucwords($row['tlname']);

    $payment = "SELECT * from tblpaymentdetails where Tenant_ID=$tenantid";
    $payment_fetch = $con->query($payment);

    $payments = "SELECT SUM(Amount_Paid) from tblpaymentdetails where Tenant_ID=$tenantid";
    $payment_fetchs = $con->query($payments);
    $row_amounts = $payment_fetchs->fetch_assoc();

    $currentdate = date("Y-m-d");


    $options = new Options();
    $options->set('chroot',realpath(''));
    $dompdf = new Dompdf($options);

    ob_start();
    require('print-content.php');
    $html =ob_get_contents();
    ob_get_clean();

    $dompdf->load_html($html);

    $dompdf->setPaper('A4','portrait');

    $dompdf->render();

    $filename = $fullname . ".pdf";

    $dompdf->stream($filename);


    

?>