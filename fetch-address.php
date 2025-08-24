<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";

if(isset($_GET['address'])){
    $address = $_GET['address'];

    $house_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*, `tblapartmentaddress`.*
    FROM `tblhouse` 
        LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
        LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` 
        LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where tblapartmentaddress.Addres LIKE '%$address%'";
    $result_house = $con->query($house_query);

    if($result_house->num_rows>0){
        
    foreach ($result_house as $row) {
    ?>

        <div class="card-house">
            <?php $houseid =  $row['House_ID'] ?>
            <div class="image">
                <?php $imageData = $row['image'] ?>
                <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
            </div>
            <br>
            <p class="bold"><?php echo $row['Apartment_Name'] ?> Apartment</p>
            <br>
            <p><span><?php echo $row['No_Bedroom'] ?> : Bedroom</span> </p>
            <p><span><?php echo $row['No_ComfortRoom'] ?> : Comfortroom</span></p>
            <br>
            <div class="card-footer">
                <p>₱<?php echo $row['Monthly_Rent'] ?> <span> monthly</span></p>
                <div class="house-buttons">
                    <a href="view-apartment.php?h=<?php echo $houseid ?>" class="house-button">View</i></a>
                </div>
            </div>
        </div>


        <?php
    }
    ?>
    <?php }else{
    ?> 
        <div class="empty">
            <div class="image">
                <img src="img/apartment.png" alt="">
                <p>Not Found...</p>
            </div>
        </div>
    <?php
    }
}
?>
    