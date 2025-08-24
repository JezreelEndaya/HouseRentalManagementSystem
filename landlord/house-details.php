<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

?>

<style>
    .house-details {
        width: 100%;
    }

    .house-detail-content {
        display: grid;
        gap: 10px;
        padding: 10px;
        grid-template-columns: repeat(auto-fit,minmax(600px,1fr));
    }

    .left {
        display: flex;
        justify-content: center;
    }
    .right{
        display: flex;
        justify-content: center;
    }

    .left img {
        width: 100%;
    }
</style>

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
    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
            <header>
                <h1>House Details</h1>
            </header>
            <div class="content">
                <div class="add-maincontent">
                    <div class="house-details">
                             <?php
                            if (isset($_GET['apartmentid']) && isset($_GET['houseid'])) {
                                $new_apartmentid = $_GET['apartmentid'];
                                $new_houseid = $_GET['houseid'];
                            ?>
                        <div class="heading">
                            <p>House Detail</p>
                            <p><a href="list-houses.php"><i class="fa-solid fa-right-left"></i></a></p>
                        </div>
                        <?php 

                            $specific_house_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblapartmentaddress`.*
                            FROM `tblhouse` 
                                LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                                LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where tblapartment.Apartment_ID=$new_apartmentid and tblhouse.House_ID=$new_houseid";
                            $specific_house_result = $con->query($specific_house_query);

                            if ($specific_house_result->num_rows > 0) {
                                if ($specific_house_row = $specific_house_result->fetch_assoc()) {
                        ?>
                                    <div class="house-detail-content">
                                        <div class="left">
                                            <?php $imageData = $specific_house_row['image'] ?>
                                            <img width="70px" src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                                        </div>
                                        <div class="right">

                                            <div class="table-body">
                                                <table class="table-block">
                                                    <tbody>
                                                        <?php
                                                        ?>
                                                        <tr>
                                                            <td data-title="Apartment Name"><?php echo $specific_house_row['Apartment_Name'] ?></td>
                                                            <td data-title="House Type"><?php echo $specific_house_row['House_Type'] ?></td>
                                                            <td data-title="Number of Bedroom"><?php echo $specific_house_row['No_Bedroom'] ?></td>
                                                            <td data-title="Number of Comfort Room"><?php echo $specific_house_row['No_ComfortRoom'] ?></td>
                                                            <td data-title="Address"><?php echo $specific_house_row['Addres']?></td>
                                                            <td data-title="Description"><?php echo $specific_house_row['Description'] ?></td>
                                                            <td data-title="Monthly Rent"><?php echo $specific_house_row['Monthly_Rent'] ?></td>
                                                            <td data-title="Availability"><?php echo $specific_house_row['Status'] ?></td>
                                                        </tr>

                                                        <?php
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </div>
                        <?php } else {
                                }
                            } else {
                            }
                        } else {
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>