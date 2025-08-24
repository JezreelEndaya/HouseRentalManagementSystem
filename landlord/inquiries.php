<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$complain_query = "SELECT * from tblinquiry where Owner_ID=$ownerid";
$complain_fetch = $con->query($complain_query);

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

    <div class="modal-container">
        <div class="modal" id="modal">
        </div>
    </div>

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
                <div class="apartment-table all-table">
                    <div class="heading">
                        <p>List of Inquiries</p>
                    </div>

                    <div class="table-body">
                        <table class="table-default">
                            <thead>
                                <tr>
                                    <th>Inquiry ID</th>
                                    <th>House ID</th>
                                    <th>Contact Number</th>
                                    <th>Fullname</th>
                                    <th>Email Address</th>
                                    <th>Message</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($complain_fetch as $complain_fetch) {
                                ?>

                                    <tr>
                                        <td><?php echo $complain_fetch['Inquiry_ID'] ?></td>
                                        <td><a href="house-details.php" class=""><?php echo $complain_fetch['House_ID']?></a></td>
                                        <td>₱ <?php echo $complain_fetch['Contact_Number'] ?></td>
                                        <td><?php echo $complain_fetch['Fullname'] ?></td>
                                        <td><?php echo $complain_fetch['Email_Address'] ?></td>
                                        <td><?php echo $complain_fetch['Message'] ?></td>
                                        <td>
                                            <a href="list-houses.php?apartmentid='<?php echo $apartmentids["Message"]; ?>'" class="view">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            
                                        </td>
                                    </tr>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <script src="js/modal.js"></script>
</body>
</html>

<?php
