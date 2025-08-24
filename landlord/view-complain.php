<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$select_complain = "SELECT * from tblcomplain where Owner_ID=$ownerid";
$complain_fetch = $con->query($select_complain);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/table.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
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
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Complain History</a></p>
                        </div>
                        <?php 
                        if($complain_fetch->num_rows>0){
                        ?>
                        <div class="table-body">
                            <table class="table-default">
                                <thead>
                                    <tr>
                                        <th>Tenant ID</th>
                                        <th>Complain Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($complain_fetch as $complain_fetchs) {
                                    ?>
                                    <tr>
                                        <td><?php echo $complain_fetchs['Tenant_ID'] ?></td>
                                        <td><?php echo $complain_fetchs['Complain_Title'] ?></td>
                                        <td><?php echo $complain_fetchs['Complain_Message'] ?></td>
                                        <td><?php echo $complain_fetchs['Complain_Date'] ?></td>
                                        <td class="action">
                                            <a href="" class="view">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        }else{
                            ?> 
                                <div class="empty-content">
                                    <p>No complains Available</p>
                                </div>
                            <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>