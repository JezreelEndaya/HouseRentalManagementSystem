<?php
session_start();
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$payment_query = "SELECT `tblassign_tenant`.*, `tbltenant`.*, `tblhouse`.*, `tblpaymentdetails`.*
FROM `tblassign_tenant` 
	LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
	LEFT JOIN `tblhouse` ON `tblassign_tenant`.`House_ID` = `tblhouse`.`House_ID` 
	LEFT JOIN `tblpaymentdetails` ON `tblpaymentdetails`.`Tenant_ID` = `tblassign_tenant`.`Tenant_ID` where tbltenant.Owner_ID=$ownerid and tblpaymentdetails.Status='unpaid' order by tbltenant.Tenant_ID ASC;";
$payment_fetch = $con->query($payment_query);
$payment_result = $payment_fetch->fetch_assoc();

$tenant_query = "SELECT * from tbltenant where Owner_ID=$ownerid";
$tenant_fetch = $con->query($tenant_query);

$currentDay = date('j');
$currentDaTe = date('Y-m-d');

foreach($tenant_fetch as $tenant_fetchs){
    $Tenant_ID = $tenant_fetchs['Tenant_ID'];
    $start_date = $tenant_fetchs['Start_Date'];
    list($y,$m,$d) = explode("-",$start_date);

    if($d == $currentDay){

        $check_payment_post = "SELECT DISTINCT Tenant_ID,Day(Date),Date from tblpaymentdetails where Date='$start_date' and Tenant_ID=$Tenant_ID";
        $check_payment_fetch = $con->query($check_payment_post);
        $check_payment_result = $check_payment_fetch->fetch_assoc();

        foreach($check_payment_fetch as $check_payment_fetchs){

            $newtenantid =  $check_payment_result['Tenant_ID'];
            $last_posted_payment =  $check_payment_result['Date'];

            $select_tenant_payment = "SELECT * from tblpaymentdetails where Tenant_ID=$newtenantid order by Payment_ID desc limit 1";
            $select_tenant_result = $con->query($select_tenant_payment);
            
            foreach($select_tenant_result as $select_tenant_results){
                $tenantadd = $select_tenant_results['Tenant_ID'];

                if($select_tenant_results['Date'] == $currentDaTe){
                    echo "";
                }else{
                    
                    $sql = "INSERT into tblpaymentdetails values('','$tenantadd','0','0','$currentDaTe','unpaid')";
                    $con->query($sql);
                }

            }
        }

    }
}

    


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- table -->
    <link rel="stylesheet" href="css/table.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="css/modal.css">
    <?php include "../include/icon/fontawesome.php"; ?>
</head>

<body>

    <div class="modal" id="modal">
        <button class="close-modal"><i class="fa-solid fa-xmark"></i></button>

        <form id="payment-form" method="POST">
            <div class="payment-content">
                <h1>Pay Now</h1>
                <p id="invalid-data"></p>
                <div class="info-content">
                    <br>
                    <div class="input-handler">
                        <label for="name">Tenant Name</label>
                        <select name="" id="tenant">
                            <option value="" disabled selected>Tenant Name</option>
                            <?php 
                            
                            $all_unpaid_tenant = "SELECT DISTINCT tbltenant.Firstname,`tbltenant`.*, `tblpaymentdetails`.*, `tblassign_tenant`.*
                            FROM `tblpaymentdetails` 
                                LEFT JOIN `tblassign_tenant` ON `tblpaymentdetails`.`Tenant_ID` = `tblassign_tenant`.`Tenant_ID` 
                                LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` where Status='unpaid'";
                            $all_unpaid_result = $con->query($all_unpaid_tenant);

                            foreach($all_unpaid_result as $row_unpaid){

                                ?> 
                                <option value="<?php echo $row_unpaid['Tenant_ID'] ?>"><?php echo $row_unpaid['Firstname'] ." ". $row_unpaid['Firstname'] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                    <br>
                    <div class="input-handler">
                        <label for="name">Unpaid Date</label>
                        <select name="" id="date">
                            
                        </select>
                    </div>
                </div>
                <br>
                <div class="footer-content">
                    <div class="footer-info" id="footer-info">

                    </div>
                    <br>
                    <div class="footer">
                        <p id="price"> 

                        </p>
                        <button class="pay-button" id="submit">Pay</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
        <header>
                <i class="fa-solid fa-building-user"></i>
                <div class="time">
                    <div class="dateTime">
                        <?php 
                        include "include/time.php" 
                        ?>
                    </div>
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
            </header>
            <div class="content">
                <div class="apartment-table all-table">
                    <div class="heading">
                        <p>Add Payment</p>
                        <a class="adding modal-btn"><i class="fa-solid fa-plus"></i> New Payment</a>
                    </div>

                    <div class="table-body">
                        <table class="table-default">
                            <thead>
                                <tr>
                                    <th>House ID</th>
                                    <th>Tenant</th>
                                    <th>Rental Fee</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($payment_fetch as $payment_results) {
                                ?>

                                    <tr>
                                        <td><?php echo $payment_results['House_ID'] ?></td>
                                        <td><?php echo $payment_results['Firstname'] . " " . $payment_result['Lastname'] ?></td>
                                        <td>₱ <?php echo $payment_results['Monthly_Rent'] ?></td>
                                        <td><?php echo $payment_results['Date'] ?></td>
                                        <td><a class="unpaid">Unpaid</a></td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/modal.js"></script>

    <script>
        document.getElementById('tenant').addEventListener('change', tenantPayment);
        var infoContent = document.querySelector('.info-content');
        var date = document.getElementById('date');
        var footerinfo = document.getElementById('footer-info');
        var price = document.getElementById('price');

        function tenantPayment(){

            var tenantName = document.getElementById('tenant').value;
            var xhr = new XMLHttpRequest();

            var params = "tenantid="+ tenantName;

            xhr.open('POST', 'php/payment.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');

            xhr.onload = function(){

                if(xhr.status == 200){
                    var tenants = JSON.parse(this.responseText);

                    var dates = "";
                    var infos = "";
                    var prices = "";

                    console.log(tenants);

                    for(var i in tenants){
                        dates += '<option value="'+tenants[i].Date+'">'+tenants[i].Date+'</option>';
                    }

                    infos = '<p>Tenant ID: '+tenants[i].Tenant_ID+'</p>'+
                            '<p>House ID: '+tenants[i].House_ID+'</p>'+
                            '<p>Fullname: '+tenants[i].Firstname+' '+tenants[i].Middlename+' '+tenants[i].Lastname+' </p>'+
                            '<p>Email Address: '+tenants[i].Email_Address+'</p>';
                        
                    prices = 'Amount to Pay: ₱'+tenants[i].Amount_To_Pay;

                    date.innerHTML = dates;
                    footerinfo.innerHTML = infos;
                    price.innerHTML = prices;
                   
                }
            }

            xhr.send(params);
        }
    </script>

    <script>
        document.getElementById('payment-form').addEventListener('submit',pay);
        var invalids = document.getElementById['invalid-data'];

        function pay(e){

            var tenantid = document.getElementById('tenant').value;
            var date = document.getElementById('date').value;
            

            var xhr = new XMLHttpRequest();
            var params = "date="+date+ "&tenantid="+tenantid;

            xhr.onprogress = function (event) {
                if (event.lengthComputable) {
                    var percentComplete = (event.loaded / event.total) * 100;

                    console.log('Progress: ' + percentComplete + '%');
                    
                } else {
                    console.log('Progress not computable.');
                }
            };
            
            xhr.open('POST','php/fetch-payment-data.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


            xhr.onload = function(){

                if(xhr.status == 200){
                    console.log(this.responseText);
                }
            }

            xhr.send(params);
        }
    </script>
</body>
</html>


<?php
