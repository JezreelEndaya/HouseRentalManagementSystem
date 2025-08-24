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
                <p>Owner Name: <?php echo $specific_owner_row['Firstname']." ".$specific_owner_row['Lastname']; ?> <span> <a href=""><i class="fa-solid fa-pencil"></i></a></span></p>
                <p>Contact Number: <?php echo $specific_owner_row['Contact_Number'] ?></p>
                </div>
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>
                                Apartments
                            </p>
                        </div>

                        <div class="grid-body">
                            <?php
                                $specific_apartment_query = "SELECT * from tblapartment where Owner_ID=$ownerid";
                                $specific_apartment_result = $con->query($specific_apartment_query);

                                if($specific_apartment_result->num_rows>0){

                                    foreach($specific_apartment_result as $specific_apartment_row){
                            ?>
                            <div class="card card-apartment-list">
                                <p><?php echo $specific_apartment_row['Apartment_Name'] ?></p>
                                <a href=""></a>
                            </div>
                            <?php } 
                                }else{
                                    ?> 
                                        <p>No Registered Apartments</p>
                                    <?php
                                }?>
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