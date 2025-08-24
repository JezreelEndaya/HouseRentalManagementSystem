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
                            <p>Your Information <a href="edit-profile.php?q=personalinformation"><i class="fa-solid fa-pencil"></i></a></p>
                            <a href=""></a>
                        </div>
                        <div class="table-body">
                            
                            <table class="table-block">
                                <thead>
                                    <tr>
                                        <th>Owner ID</th>
                                        <th>Firstname</th>
                                        <th>Middlename</th>
                                        <th>Lastname</th>
                                        <th>Contact Number</th>
                                        <th>Emaill Address</th>
                                        <th>Membership Start Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    ?>
                                        <tr>
                                            <td data-title="Owner ID"><?php echo $allid['Owner_ID'] ?></td>
                                            <td data-title="Firstname"><?php echo $allid['Firstname'] ?></td>
                                            <td data-title="Lastname"><?php echo $allid['Lastname'] ?></td>
                                            <td data-title="Contact Number"><?php echo $allid['Contact_Number'] ?></td>
                                            <td data-title="Emaill Address"><?php echo $allid['Email_Address'] ?></td>
                                            <td data-title="Membership Start Date"><?php echo $allid['Membership_StartDate'] ?></td>
                                        </tr>
                                    <?php
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!--  -->
                    <!--  -->
                    <div class="list-apartments add-maincontent">
                        <div class="heading">
                            <p>Your Apartments</p>
                        </div>
                        <?php if($apartmentidresult->num_rows>0){?>
                        <div class="grid-body grid-padding">
                            <?php foreach ($apartmentid as $apartmentids) {
                                ?>
                                    <div class="card">
                                        <p><?php echo $apartmentids['Apartment_Name'] ?></p> 
                                        <a href="add-house.php?house='<?php echo $apartmentids['Apartment_Name'] ?>'">Add House</a>
                                    </div>
                                <?php
                            }
                            ?>
                        </div>
                        <?php }else{
                        ?> 
                            <div class="empty-content">
                                <p>No Apartment Registered</p>
                            </div>
                        <?php
                        }?>
                    </div>
                    <!--  -->
                </div>
            </div>
        </main>
    </div>
</body>

</html>