<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$select_tenants = "SELECT * from tbltenant where Owner_ID=$ownerid";
$fetch_tenants = $con->query($select_tenants);

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
    <link rel="stylesheet" href="css/payment-report.css">
    <?php include "../include/icon/fontawesome.php"; ?>
</head>

<body>
    <div class="modal" id="modal">
        <div class="header-modal">
            <p>All Payments Record</p>
            <p id="close"><i class="fa-solid fa-xmark"></i></p>
        </div>

        <table class="table-default">
            <thead>
                <tr>
                    <th>Tenant ID</th>
                    <th>Fullname</th>
                    <th>Print</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach($fetch_tenants as $fetch_tenant){
                ?>
                <tr>
                    <td><?php echo $fetch_tenant['Tenant_ID'] ?></td>
                    <td><?php echo $fetch_tenant['Firstname'] ." " .$fetch_tenant['Middlename'] ." ". $fetch_tenant['Lastname']?></td>
                    <td><a target="_blank" href="../print-tenant-data.php?tenantid=<?php echo $fetch_tenant['Tenant_ID']?>"><i class="fa-solid fa-download"></i></i></a>
                </td>
                </tr>
                <?php 
                }
                ?>
            </tbody>
        </table>
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
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Reports</p>
                        </div>
                        <div class="table-body">
                            <div class="mini-card" id="report">
                                <p >Payments</p>
                                <i class="fa-solid fa-money-check-dollar"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        var report = document.getElementById('report');
        var modal = document.getElementById('modal');
        var close = document.getElementById('close');

        


        report.addEventListener('click',function(){
            modal.style.top = "150px";
            modal.style.opacity = "100%";
        });

        close.addEventListener('click',function(){
            modal.style.top = "-1000px";
            modal.style.opacity = "0%";
        });

       
    </script>

</body>

<?php
