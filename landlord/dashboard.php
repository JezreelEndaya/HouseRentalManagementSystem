<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
</head>

<body>
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
                <div class="grid-body">
                    
                    <a href="add-apartment.php">
                        <div class="card">
                            <img src="" alt="">
                            <p class="label-card-total">
                                <?php
                                if(count($apartmentid) == "0"){
                                    echo "<i>Register New Apartment</i>";
                                }else{
                                    echo count($apartmentid);
                                }
                                ?>
                            </p>
                            <br><br>
                            <p class="total">Total Apartments</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="list-houses.php">
                        <div class="card">
                            <img src="" alt="">
                            <p class="label-card-total">
                                <?php
                                if(count($houseidcount) == "0"){
                                    echo "<i>Register New Apartment</i>";
                                }else{
                                    echo count($houseidcount);
                                }
                                ?>
                            </p>
                            <br><br>
                            <p class="total">Total Houses</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="tenant.php">
                        <div class="card">
                            <img src="" alt="">
                            <p class="label-card-total">
                                <?php
                                if(count($tenantid) == "0"){
                                    echo "<i>Register New Tenant</i>";
                                }else{
                                    echo count($tenantid);
                                }
                                ?>
                            </p>
                            <br><br>
                            <p class="total">Total Tenants</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="list-houses.php?q=Vacant">
                        <div class="card">
                            <img src="" alt="">
                            <p class="label-card-total">
                                <?php
                                if(count($vacantcount) == "0"){
                                    echo "<i>Register New House</i>";
                                }else{
                                    echo count($vacantcount);
                                }
                                ?>
                            </p>
                            <br><br>
                            <p class="total">Vacant Houses</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="">
                        <div class="card">
                            <img src="" alt="">
                            <p class="label-card-total">
                            ₱
                                <?php
                                $amount = $paymentrow['SUM(tblpaymentdetails.Amount_Paid)'];
                                $newamount = intval($amount);
                                
                                echo $newamount;
                                ?>
                            </p>
                            <br><br>
                            <p class="total">Total Payments</p>
                            <p></p>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>