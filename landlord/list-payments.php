<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$paid_Tenants = "SELECT `tblassign_tenant`.*, `tbltenant`.*, `tblpaymentdetails`.*
FROM `tblassign_tenant` 
	LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
	LEFT JOIN `tblpaymentdetails` ON `tblpaymentdetails`.`Tenant_ID` = `tblassign_tenant`.`Tenant_ID` where tbltenant.Owner_ID=$ownerid and tblpaymentdetails.Status='paid';";
$paid_Tenants_fetch = $con->query($paid_Tenants);

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
    <?php include "../include/icon/fontawesome.php"; ?>
</head>

<body>

    <div class="modal-container">
        <div class="modal" id="modal">
        </div>
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
                        <p>List of Payments</p>
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
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($paid_Tenants_fetch as $paid_Tenants_fetchs) {
                                ?>

                                    <tr>
                                        <td><?php echo $paid_Tenants_fetchs['House_ID'] ?></td>
                                        <td><?php echo $paid_Tenants_fetchs['Firstname'] . " " . $paid_Tenants_fetchs['Lastname'] ?></td>
                                        <td>₱ <?php echo $paid_Tenants_fetchs['Amount_To_Pay'] ?></td>
                                        <td><?php echo $paid_Tenants_fetchs['Date'] ?></td>
                                        <td>
                                            <a class="paid"><?php echo $paid_Tenants_fetchs['Status'] ?></a>
                                        </td>
                                        <td>
                                            <a href="list-houses.php?apartmentid='<?php echo $apartmentids["Apartment_ID"]; ?>'" class="view">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            
                                        </td>
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
</body>
</html>

<?php
