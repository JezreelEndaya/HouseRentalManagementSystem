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
            <div class="content">
                <div class="body">
                    <!--  -->

                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Your Apartments</p>
                        </div>

                        <div class="table-body">
                            <?php 
                            if($apartmentidresult->num_rows>0){ 
                            ?>
                            <table class="table-default">
                                <thead>
                                    <tr>
                                    <th>Apartment ID</th>
                                    <th>Apartment_Name</th>
                                    <th>Number Units</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($apartmentid as $apartmentids) { ?>
                                    <tr>
                                        <td data-title="Apartment ID:"><?php echo $apartmentids["Apartment_ID"]; ?></td>
                                        <td data-title="Apartment Name:"><?php echo $apartmentids["Apartment_Name"]; ?></td>
                                        <td data-title="Apartment Type:"><?php echo $apartmentids["Apartment_Type"]; ?></td>
                                        <td>
                                        <a href="list-houses.php?apartmentid='<?php echo $apartmentids["Apartment_ID"]; ?>'" class="view">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php  }
                                ?>
                                </tbody>
                            </table>
                            <?php 
                            }else{
                                ?> <div class="empty-content">
                                    <p>No Registered Apartment</p>
                                </div><?php
                            }
                            ?>
                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </main>
    </div>
</body>

</html>