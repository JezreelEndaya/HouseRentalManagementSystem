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
    <!-- Font awesome -->
    <?php include "../include/icon/fontawesome.php"; ?>
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- table -->
    <link rel="stylesheet" href="css/table.css">
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
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <p>Allocate Tenant</p>
                    </div>
                    <div class="body">
                        <form action="php/assign-tenant.php" method="POST">
                            <div class="personal-info">
                                <?php
                                if (isset($_GET['error'])) { ?>
                                    <div class="warning">
                                        <div class="waningmessagge">
                                            <p class="error"><?php echo $_GET['error'] ?></p>
                                        </div>
                                    </div>
                                <?php    }
                                ?>

                                <div class="header">
                                    <p>Information</p>
                                </div>

                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="tenantname">Tenant Name <span>*</span></label>
                                        <select name="tenantName" id="">
                                            <?php
                                            if($tenantnullresult->num_rows>0){
                                            ?>
                                                <option value="tenantname" disabled selected>Tenant Name</option>
                                            <?php foreach ($tenantnullid as $tenantids) { ?>?>
                                                <option value='<?php echo $tenantids['tenantid']; ?>'><?php echo $tenantids['Firstname']?></option>
                                            <?php }
                                            }else{
                                                ?>
                                                <option value='noregister'>No Registered Tenant</option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="input-handler">
                                        <label for="apartment-name">Apartment Name <span>*</span></label>
                                        <select name="apartmentName" id="apartment-info" >
                                            <option value="" disabled selected>Select Apartment</option>
                                            <?php 
                                            if(isset($_GET['houseid'])){
                                                $houseid = $_GET['houseid'];
                                                $houseid_query = "SELECT `tblhouse`.*, `tblapartment`.*
                                                    FROM `tblhouse` 
                                                    LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where tblhouse.House_ID=$houseid";
                                                $houseid_result = $con->query($houseid_query);
                                                $houserow = $houseid_result->fetch_assoc();

                                                ?>
                                                <option value="<?php echo $houserow['Apartment_ID'] ?>" selected><?php echo $houserow['Apartment_Name'] ?></option>
                                                <?php 
                                            }
                                            ?>
                                            <?php 
                                            foreach ($apartmentid as $apartmentids) { ?>
                                                <option value='<?php echo $apartmentids['Apartment_ID']; ?>' <?php if (isset($_GET['apartment'])) {
                                                                                                                    if ($_GET['apartment'] == $apartmentids['Apartment_ID']) {
                                                                                                                        echo "selected";
                                                                                                                    }
                                                                                                                } ?>><?php echo $apartmentids['Apartment_Name'] ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- fetched by AJAX -->
                                    <div class="input-handler">
                                        <label for="name">House Type <span>*</span></label>
                                        <select name="houseType" id="house-info" >
                                        </select>
                                    </div>
                                    <div class="button-add">
                                        <button type="submit" name="submit">Add</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="apartment-table all-table">

                    <div class="heading">
                        <p>List of Allocated tenants</p>
                    </div>

                    <div class="table-body">
                        <?php if($result_occupied_house->num_rows>0){?>
                        <table class="table-default">
                            <thead>
                                <tr>
                                    <th>Apartment Name</th>
                                    <th>House Type</th>
                                    <th>Full name</th>
                                    <th>Rent to Pay</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($rowoccupy = $result_occupied_house->fetch_assoc()){?>
                                <tr>
                                    <td data-title="Apartment Name"><?php echo $rowoccupy['Apartment_Name'] ?></td>
                                    <td data-title="House Type"><?php echo $rowoccupy['House_Type'];  ?></td>
                                    <td data-title="Full name"><?php echo $rowoccupy['Firstname']." ".$rowoccupy['Lastname']; ?></td>
                                    <td data-title="Rent to Pay"><?php echo  $rowoccupy['Monthly_Rent'];?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                        <?php }else{
                            ?> 
                                <div class="empty-content">
                                    <p>All Tenants are Allocated / No Tenant Registered</p>
                                </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/assign-tenant.js"></script>
</body>

</html>
