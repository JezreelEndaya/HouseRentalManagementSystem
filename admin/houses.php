<?php
include_once "../connection/dbcon.php";
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
                <h1>Welcome</h1>
            </header>
            <div class="content">
                <?php 
                    if(isset($_GET['ownerid'])){

                        $ownerid = $_GET['ownerid'];

                        $specific_owner_query = "SELECT * from tblowners where tblowners.Owner_ID=$ownerid";
                        $specific_owner_result = $con->query($specific_owner_query);
                        $specific_owner_row =  $specific_owner_result->fetch_assoc();

                ?>
                <div class="info">
                    <div class="card-apartment-list">
                        <p><?php 
                        if(isset($_GET['apartmentid'])){
                            $apartmentid = $_GET['apartmentid'];
                            $apartment_name_query = "SELECT * from tblapartment where Apartment_ID=$apartmentid";
                            $apartment_name_result = $con->query($apartment_name_query);
                            $apartment_name_row = $apartment_name_result->fetch_assoc();

                            echo $apartment_name_row['Apartment_Name']." Apartment";
                        
                        ?></p>
                    </div>
                <p>Owner Name: <?php echo $specific_owner_row['Firstname']." ".$specific_owner_row['Lastname']; ?></p>
                </div>
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>
                                Houses
                            </p>
                        </div>

                        <div class="table-body">
                            <div class="house-card">
                                <?php 
                                    $apartment_houses_query = "SELECT* from tblhouse where Apartment_ID=$apartmentid";
                                    $apartment_houses_result = $con->query($apartment_houses_query);

                                    if($apartment_houses_result->num_rows>0){

                                        foreach($apartment_houses_result as $apartment_houses_row){
                                ?>
                                <div class="house-item">
                                    <p><?php echo $apartment_houses_row['House_Type']?></p>
                                    <br>
                                    <p><?php $imageData = $apartment_houses_row['image']?>
                                        <img width="100px" src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                                    </p>
                                    <br>
                                    <p>Number of Bedroom: <?php echo $apartment_houses_row['No_Bedroom']?></p>
                                    <p>Number of Comfortroom: <?php echo $apartment_houses_row['No_ComfortRoom']?></p>
                                    <p>Monthly Rent: <?php echo $apartment_houses_row['Monthly_Rent']?></p>
                                    <br>
                                    <a href="" class="details">Details</a>
                                </div>
                            

                            <?php }
                                    }else{
                                        ?> 
                                        <p>No Registered Houses</p>
                                    <?php
                                    }
                        }?>
                        </div>
                        </div>
                    </div>
                </div>
                <?php }else{
                    header('Location: landlord.php');
                }
                ?>
            </div>
        </main>
    </div>
</body>

</html>