
<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

if(isset($_GET['apartmentid'])){

    $apartment_id = $_GET['apartmentid'];

    if(isset($_POST['submit'])){
        $apartment_name = $_POST['name'];
        $apartment_unit = $_POST['unit'];


        $update_apartment_query = "UPDATE tblapartment set Apartment_Name='$apartment_name', Apartment_Type='$apartment_unit' where Apartment_ID=$apartment_id ";
        $update_apartment_result = $con->query($update_apartment_query);

        if($update_apartment_result){
            header('Location: add-apartment.php');
        }else{
            ?> 
                <script>
                    alert("Update error");
                </script>
            <?php
        }
    }

}else{
    header('Location: add-apartment.php');
}
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
    <?php include "../include/icon/fontawesome.php"; ?>
</head>

<body>
    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
            <header>
                <h1>Apartment Dashboard</h1>
            </header>
            <div class="content">
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <p>Update Apartment</p>
                        <p><a href="add-apartment.php"><i class="fa-solid fa-right-left"></i></a></p>
                    </div>
                    <div class="body">
                        <form action="" method="POST">

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
                                    <p>Apartment Information</p>
                                </div>

                                <?php
                                    if(isset($_GET['apartmentid'])){
                                        $apartmentid = $_GET['apartmentid'];

                                        $apartment_list_update_query = "SELECT * from tblapartment where Apartment_ID=$apartmentid ";
                                        $apartment_list_update_result = $con->query($apartment_list_update_query);
                                        $apartment_list_update_row = $apartment_list_update_result->fetch_assoc();

                                ?>

                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="name">Apartment Name</label>
                                        <input name="name" type="text" value="<?php echo $apartment_list_update_row['Apartment_Name']?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="unit">Apartment Type</label>
                                        <input name="unit" type="text" value="<?php echo $apartment_list_update_row['Apartment_Type']?>" required>
                                    </div>
                                </div>

                                <?php 
                                    }
                                ?>

                                <div class="button-add">
                                    <button type="submit" name="submit">Update</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="js/apartment.js"></script>
</body>

</html>