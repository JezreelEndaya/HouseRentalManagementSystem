<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

if(isset($_GET['houseid'])){
    $houseid = $_GET['houseid'];
    if(isset($_POST['submit'])){

        $type = $_POST['type'];
        $bedroom = $_POST['bedroom'];
        $comfortroom = $_POST['comfortroom'];
        $rent = $_POST['rent'];
        $description = $_POST['description'];
        $image = file_get_contents($_FILES['image']["tmp_name"]);

        $update_house_query = "UPDATE tblhouse set House_Type=?, No_Bedroom=?, No_ComfortRoom=?, Monthly_Rent=?, Description=?, image=? where House_ID=$houseid";
        $update_house_result = $con->prepare($update_house_query);

        if($update_house_result){
            $update_house_result->bind_param("siiiss",$type,$bedroom,$comfortroom,$rent,$description,$image);
            $update_house_result->execute();

            $update_house_result->close();
            $con->close();

            ?> 
                <script>
                    alert("Updated Successfully");
                    window.location.href = "http://localhost:3000/landlord/add-house.php";
                </script>
            <?php

            
        }

    }

}else{
    header('Location: add-house.php');
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
                <h1>Update House</h1>
            </header>
            <div class="content">
                <div class="add-house add-maincontent">
                    <div class="heading">
                        <p>Update House</p>
                    </div>
                    <div class="body">
                        <form action="" method="POST" enctype="multipart/form-data">
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
                                    <p>House Information</p>
                                </div>

                                <?php 
                                    if(isset($_GET['houseid'])){
                                        $houseid = $_GET['houseid'];

                                        $house_list_query = "SELECT `tblhouse`.*, `tblapartment`.*
                                            FROM `tblhouse` 
                                            LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where tblhouse.House_ID=$houseid;";
                                        $house_list_result = $con->query($house_list_query);

                                        
                                        $house_list_row = $house_list_result->fetch_assoc();
                                        echo $house_list_row['Apartment_Name'];
                                ?>

                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="apartmentname">Apartment Name<span>*</span></label>
                                        <select name="apartmentname" id="type" disabled>
                                            <option value="<?php echo $house_list_row['Apartment_Name']?>" selected><?php echo $house_list_row['Apartment_Name']?></option>
                                            <?php

                                            foreach ($apartmentid as $apartmentids) { ?>

                                                <option value="<?php echo $apartmentids['Apartment_Name']; ?>"><?php echo $apartmentids['Apartment_Name']; ?></option>

                                            <?php } ?>

                                        </select>
                                    </div>
                                    <div class="input-handler">
                                        <label for="type">House Type <span>*</span></label>
                                        <select name="type" id="type" required>
                                            <option value="<?php echo $house_list_row['House_Type']?>" selected><?php echo $house_list_row['House_Type']?></option>
                                            <option value="Studio">Studio</option>
                                            <option value="Loft">Loft</option>
                                            <option value="Micro">Micro</option>
                                            <option value="Duplex">Duplex</option>
                                            <option value="Triplex">Triplex</option>
                                            <option value="Garden">Garden</option>
                                            <option value="Basement">Basement</option>
                                            <option value="Alcove">Alcove</option>
                                            <option value="Penthouse">Penthouse</option>
                                            <option value="Corporate">Corporate</option>
                                            <option value="Railroad">Railroad</option>
                                        </select>
                                    </div>
                                    <div class="input-handler">
                                        <label for="bedroom">Number of Bedroom <span>*</span></label>
                                        <input name="bedroom" type="number" value="<?php echo $house_list_row['No_Bedroom']?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="comfortroom">Number of Comfort Room</label>
                                        <input name="comfortroom" type="number" value="<?php echo $house_list_row['No_ComfortRoom']?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="rent">monthly Rent <span>*</span></label>
                                        <input name="rent" type="number" value="<?php echo $house_list_row['Monthly_Rent']?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="description">Description<span>*</span></label>
                                        <textarea name="description" value="<?php echo $house_list_row['Description']?>" required><?php echo $house_list_row['Description']?></textarea>
                                    </div>
                                    <div class="input-handler">
                                        <label for="image">Image<span>*</span></label>
                                        <input type="file" name="image" required>
                                    </div>
                                </div>

                                <?php } ?>
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
</body>

</html>