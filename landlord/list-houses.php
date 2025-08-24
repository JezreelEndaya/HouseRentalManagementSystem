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
    <!-- css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- table -->
    <link rel="stylesheet" href="css/table.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
</head>

<body>
    <div class="container">
        <?php include 'include/sidebar.php' ?>
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

            <!-- list of houses query -->
            <?php
            ?>

            <div class="content">
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <?php 
                            if(isset($_GET['q'])){
                                ?> 
                                <p>Vacant Houses</p>
                                <?php
                            }else{
                                ?> 
                                <p>Houses</p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="table-body">
                            <div class="house-card">

                                <!-- With specific apartment Id -->
                                <?php
                                if (isset($_GET['apartmentid'])) {

                                    $apartment_id = $_GET['apartmentid'];

                                    $list_houses_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*
                                    FROM `tblhouse` 
                                    LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                                    LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tblowners.User_ID=$id and tblhouse.Apartment_ID=$apartment_id";

                                    $list_houses_result = $con->query($list_houses_query);

                                    if ($list_houses_result->num_rows > 0) {
                                        while ($list_houses_row =  $list_houses_result->fetch_assoc()) {
                                        ?>
                                            <div class="house-item">
                                                <p>Apartment Name: <?php echo $list_houses_row['Apartment_Name'] ?></p>
                                                <br>
                                                <?php $imageData = $list_houses_row['image'] ?>
                                                <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" style="width: 100%;" alt="">
                                                <br>
                                                <p>House Type: <?php echo $list_houses_row['House_Type'] ?></p>
                                                <p>Number of Bedroom: <?php echo $list_houses_row['No_Bedroom'] ?></p>
                                                <p>Number of Comfortroom: <?php echo $list_houses_row['No_ComfortRoom'] ?></p>
                                                <p>Status: <?php echo $list_houses_row['Status'] ?></p>
                                                <br>
                                                <div class="house-button">
                                                    <a href="house-details.php?apartmentid=<?php echo $list_houses_row['Apartment_ID'] ?>&houseid=<?php echo $list_houses_row['House_ID'] ?>" class="house-details">Details</a>
                                                </div>
                                            </div>
                                        <?php  }
                                    } else {
                                        ?>
                                        <div class="empty-content">
                                            <p>No Registered Houses</p>
                                        </div>
                                        <?php
                                    }

                                } else if (isset($_GET['q'])) {
                                    $vacant_status = $_GET['q'];

                                    $list_houses_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*
                                    FROM `tblhouse` 
                                    LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                                    LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tblowners.User_ID=$id and tblhouse.Status='$vacant_status'";

                                    $list_houses_result = $con->query($list_houses_query);

                                    if ($list_houses_result->num_rows > 0) {
                                        while ($list_houses_row =  $list_houses_result->fetch_assoc()) {
                                        ?>
                                            <div class="house-item">
                                                <p>Apartment Name: <?php echo $list_houses_row['Apartment_Name'] ?></p>
                                                <br>
                                                <?php $imageData = $list_houses_row['image'] ?>
                                                <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" style="width: 100%;" alt="">
                                                <br>
                                                <p>House Type: <?php echo $list_houses_row['House_Type'] ?></p>
                                                <p>Number of Bedroom: <?php echo $list_houses_row['No_Bedroom'] ?></p>
                                                <p>Number of Comfortroom: <?php echo $list_houses_row['No_ComfortRoom'] ?></p>
                                                <p>Status: <?php echo $list_houses_row['Status'] ?></p>
                                                <br>
                                                <div class="house-button">
                                                    <a href="house-details.php?apartmentid=<?php echo $list_houses_row['Apartment_ID']?>&houseid=<?php echo $list_houses_row["House_ID"] ?>" class="house-details">Details</a>
                                                    <a href="assign-tenant.php?houseid=<?php echo $list_houses_row["House_ID"] ?>" class="house-details">Assign</a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                }else{

                                    $list_houses_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*
                                    FROM `tblhouse` 
                                    LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                                    LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tblowners.User_ID=$id";

                                    $list_houses_result = $con->query($list_houses_query);

                                    if ($list_houses_result->num_rows > 0) {
                                        while ($list_houses_row =  $list_houses_result->fetch_assoc()) {
                                        ?>
                                            <div class="house-item">
                                                <p>Apartment Name: <?php echo $list_houses_row['Apartment_Name'] ?></p>
                                                <br>
                                                <?php $imageData = $list_houses_row['image'] ?>
                                                <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" style="width: 100%;" alt="">
                                                <br>
                                                <p>House Type: <?php echo $list_houses_row['House_Type'] ?></p>
                                                <p>Number of Bedroom: <?php echo $list_houses_row['No_Bedroom'] ?></p>
                                                <p>Number of Comfortroom: <?php echo $list_houses_row['No_ComfortRoom'] ?></p>
                                                <p>Status: <?php echo $list_houses_row['Status'] ?></p>
                                                <br>
                                                <div class="house-button">
                                                    <a href="house-details.php?apartmentid=<?php echo $list_houses_row["Apartment_ID"] ?>&houseid=<?php echo $list_houses_row["House_ID"] ?>" class="house-details">Details</a>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    }
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>