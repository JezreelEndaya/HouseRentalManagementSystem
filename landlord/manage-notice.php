<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";


$all_notices_query = "SELECT * FROM tblnotice where tblnotice.Owner_ID=$ownerid and tblnotice.Notice_Type='public'";
$all_notices_result = $con->query($all_notices_query);

$notices_query = "SELECT `tblassignnotice`.*, `tblnotice`.*, `tbltenant`.*
FROM `tblassignnotice` 
	LEFT JOIN `tblnotice` ON `tblassignnotice`.`Notice_ID` = `tblnotice`.`Notice_ID` 
	LEFT JOIN `tbltenant` ON `tblassignnotice`.`Tenant_ID` = `tbltenant`.`Tenant_ID` where tblnotice.Owner_ID=$ownerid and tblnotice.Notice_Type='private'";

$notices_result = $con->query($notices_query);

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
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Notices</a></p>
                            <a href=""></a>
                            <a href="notice.php?notice=public" class="adding"><i class="fa-solid fa-plus"></i> Add New Notice</a>
                        </div>

                        <?php
                        if (!isset($_GET['q'])) {
                        ?>
                            <div class="table-body">

                                <div class="header-button">
                                    <a href="manage-notice.php" class="active">Public Notices</a>
                                    <a href="manage-notice.php?q=private">Private Notices</a>
                                </div><br><br>

                                <?php
                                if($notices_result->num_rows>0){
                                ?>

                                <table class="table-default">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Notice Title</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($notices_row = $notices_result->fetch_assoc()) {
                                        ?>
                                            <tr>
                                                <td><?php echo $notices_row['Notice_ID'] ?></td>
                                                <td><?php echo $notices_row['Notice_Title'] ?></td>
                                                <td><?php echo $notices_row['Notice_Message'] ?></td>
                                                <td><?php echo $notices_row['Notice_Date'] ?></td>

                                                <td class="action">
                                                
                                                    <a href="notice.php?notice=public&id=<?php echo $notices_row['Notice_ID'] ?>" class="edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="php/delete-notice.php?id=<?php echo $notices_row['Notice_ID'] ?>" class="delete">
                                                        <i class="fa-solid fa-delete-left"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php 
                                }else{
                                    ?> 
                                    <div class="empty-content">
                                          <p>No Notices</p>
                                    </div>
                                    <?php
                                }
                                ?>
                            </div>
                        <?php
                        }else{
                            ?>
                            <div class="table-body">

                                <div class="header-button">
                                    <a href="manage-notice.php">Public Notices</a>
                                    <a href="manage-notice.php?q=private" class="active">Private Notices</a>
                                </div><br><br>

                                <?php
                                if($notices_result->num_rows>0){
                                ?>

                                <table class="table-default">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Fullname</th>
                                            <th>Notice Title</th>
                                            <th>Message</th>
                                            <th>Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($notices_row = $notices_result->fetch_assoc()) {
                                            $fullname = $notices_row['Firstname'] ." ". $notices_row['Middlename']." ". $notices_row['Lastname'];
                                        ?>
                                            <tr>
                                                <td><?php echo $notices_row['Notice_ID'] ?></td>
                                                <td><?php echo $fullname ?></td>
                                                <td><?php echo $notices_row['Notice_Title'] ?></td>
                                                <td><?php echo $notices_row['Notice_Message'] ?></td>
                                                <td><?php echo $notices_row['Notice_Date'] ?></td>
                                                <td class="action">
                                                
                                                    <a href="notice.php?notice=private&id=<?php echo $notices_row['Notice_ID'] ?>" class="edit">
                                                        <i class="fa-solid fa-pen-to-square"></i>
                                                    </a>
                                                    <a href="php/delete-notice.php?id=<?php echo $notices_row['Notice_ID'] ?>" class="delete">
                                                        <i class="fa-solid fa-delete-left"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <?php 
                                }else{
                                    ?> 
                                    <div class="empty-content">
                                          <p>No Notices</p>
                                    </div>
                                    <?php
                                }
                                ?>
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