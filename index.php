<?php
include_once "connection/dbcon.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS: Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<style>
    .house-bg {
        background-image: url('img/4dhouse.jpg') !important;
        background-repeat: no-repeat;
        background-size: cover;
        width: 90%;
        border-radius: 10px;
        aspect-ratio: 3/1;
        background-position: 25% 25%;
    }


    .heading a {
        text-decoration: none;
        color: white;
        font-size: 1rem;
        padding: 10px 20px;
        background-color: #04AA6D;
        border-radius: 6px;
    }
</style>

<body>

    <div class="container">
        <div class="header">
            <?php
            include_once "include/header.php";
            ?>
        </div>
        
        <main>
            <div class="content-home">
                <div class="heading">
                <br><br><br>
                    <h1>Discover Your Dream <span>Home</span> Today<p>"Find Your Perfect Match For The Home You Deserve"</p>
                    </h1>
                    <a href="apartments.php">Discover</a>
                    <div class="house-bg"></div>
                <br><br><br>
                </div>
                <div id="featured-houses">
                    <br><br><br>
                    <p style="font-size: 2rem; font-weight: Bold;">Featured Houses</p>
                    <br><br><br>
                    <div class="houses">
                        <?php

                        $house_query = 'SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*
                            FROM `tblhouse` 
                            LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                            LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` LIMIT 3;';
                        $result_house = $con->query($house_query);

                        foreach ($result_house as $row) {
                        ?>

                            <div class="card-house">
                                <div class="image">
                                    <?php $imageData = $row['image'] ?>
                                    <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                                </div>
                                <br>
                                <p><span>Apartment Name:</span> <?php echo $row['Apartment_Name'] ?></p>
                                <p><span>Bedroom:</span> <?php echo $row['No_Bedroom'] ?></p>
                                <p><span>Comfort room:</span> <?php echo $row['No_ComfortRoom'] ?></p>
                            </div>
                        <?php
                        }
                        ?>
                    </div>
                    
                    <br><br><br>
                    <div class="footer">
                        <?php
                        include_once "include/footer.php";
                        ?>
                    </div>
                </div>
            </div>
        </main>
  

    </div>
</body>

</html>

<!--  -->