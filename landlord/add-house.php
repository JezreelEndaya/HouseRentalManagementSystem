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
                <div class="grid-item">
                    <div class="item">
                        <div class="add-house add-maincontent">
                            <div class="heading">
                                <p>Register New House</p>
                            </div>
                            <div class="body">
                                <form action="php/add-house.php" method="POST" enctype="multipart/form-data">
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
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="apartmentname">Apartment Name<span>*</span></label>
                                                <select name="apartmentname" id="type" required>
                                                    <option value="Novalue" selected disabled></option>
                                                    <?php

                                                    foreach ($apartmentid as $apartmentids) { ?>

                                                        <option value="<?php echo $apartmentids['Apartment_Name']; ?>"><?php echo $apartmentids['Apartment_Name']; ?></option>

                                                    <?php } ?>

                                                </select>
                                            </div>
                                            <div class="input-handler">
                                                <label for="type">House Type <span>*</span></label>
                                                <select name="type" id="type" required>
                                                    <option value="Novalue" selected disabled></option>
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
                                                <input name="bedroom" type="number" required>
                                            </div>
                                            <div class="input-handler">
                                                <label for="comfortroom">Number of Comfort Room</label>
                                                <input name="comfortroom" type="number" required>
                                            </div>
                                            <div class="input-handler">
                                                <label for="rent">monthly Rent <span>*</span></label>
                                                <input name="rent" type="number" required>
                                            </div>
                                            <div class="input-handler">
                                                <label for="description">Description<span>*</span></label>
                                                <textarea name="description" required></textarea>
                                            </div>
                                            <div class="input-handler">
                                                <label for="image">Image<span>*</span></label>
                                                <input type="file" name="image" required>
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="submit">Add</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="item item-2">
                        <div class="item2-1">
                            <div class="list-house all-table">
                                <div class="heading">
                                    <p>List of Houses</p>
                                </div>
                                <div class="table-body">
                                    <?php if($housesresultss->num_rows>0 ){?>
                                    <table class="table-default">
                                        <thead>
                                            <tr>
                                                <th>Apartment Name</th>
                                                <th>House Type</th>
                                                <th>Number of Bedroom</th>
                                                <th>Number of Comfort Room</th>
                                                <th>Monthly Rent</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody">
                                            <?php 
                                                while($row = $housesresultss->fetch_assoc()){
                                                    if($row['House_ID'] !== null){
                                                    ?>
                                                        <tr>
                                                            <td data-title="Apartment Name"><?php echo $row['Apartment_Name'] ?></td>
                                                            <td data-title="House Type"><?php echo $row['House_Type'] ?></td>
                                                            <td data-title="Number of Bedroom"><?php echo $row['No_Bedroom'] ?></td>
                                                            <td data-title="Number of Comfort Room"><?php echo $row['No_ComfortRoom'] ?></td>
                                                            <td data-title="Monthly Rent"><?php echo $row['Monthly_Rent'] ?></td>
                                                            <td data-title="Status"><?php echo $row['Status'] ?></td>
                                                            <td data-title="Image"><?php $imageData = $row['image']?>
                                                            <img width="40px" src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt=""></td>
                                                            <td class="action">
                                                                <a href="edit-house.php?houseid='<?php echo $row["House_ID"]; ?>'" class="edit">
                                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    <?php
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                    <?php }else{
                                        ?> <div class="empty-content">
                                            <p>No Registered Houses</p>
                                        </div><?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- item 3 -->
                </div>
            </div>
        </main>
    </div>
</body>

</html>