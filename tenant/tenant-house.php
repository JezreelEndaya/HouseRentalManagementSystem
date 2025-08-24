<?php
include_once "../connection/dbcon.php";
include_once "check_session.php";

$tenant_house = "SELECT `tblassign_tenant`.*, `tblhouse`.*, `tbltenant`.*, `tblapartment`.*, `tblowners`.*,tblowners.Firstname as fname, tblowners.Lastname as lname, tblowners.Contact_Number as cnum
FROM `tblassign_tenant` 
	LEFT JOIN `tblhouse` ON `tblassign_tenant`.`House_ID` = `tblhouse`.`House_ID` 
	LEFT JOIN `tbltenant` ON `tblassign_tenant`.`Tenant_ID` = `tbltenant`.`Tenant_ID` 
	LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
	LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tbltenant.Tenant_ID=$tenandid";
$tenant_fetch = $con->query($tenant_house);
$row = $tenant_fetch->fetch_assoc();

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
    <link rel="stylesheet" href="css/tenant-house.css">
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
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <p>House Information</p>
                    </div>
                    <div class="body">
                        <div class="house-image">
                            <?php $imageData = $row['image'] ?>
                            <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                        </div>
                        <div class="details">
                            <p>Apartment Name: <span><?php echo $row['Apartment_Name'] ?></span></p>
                            <p>Apartment Type: <span><?php echo $row['Apartment_Type'] ?></span> </p>
                            <p>House ID: <span><?php echo $row['House_ID'] ?></span></p>
                            <p>Monthly Rent: <span><?php echo $row['Monthly_Rent'] ?></span></p>
                            <p>House_Type: <span><?php echo $row['House_Type'] ?></span></p>
                            <p>Owner: <span><?php echo ucwords($row['fname'])." ". ucwords($row['lname'])?></span> </p>
                            <p>Owner Contact#:<span> +63<?php echo $row['cnum'] ?></span> </p>
                        </div>
                    </div>
                </div>

                <div class="apartment-table all-table">

                    <div class="heading">
                        <p>Community</p>
                    </div>

                    <div class="table-body">
                        

                    </div>

                </div>

            </div>
        </main>
    </div>


</body>

</html>