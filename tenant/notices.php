<?php
include_once "../connection/dbcon.php";
include_once "check_session.php";

$select_notice = "SELECT `tblassignnotice`.*, `tblnotice`.*
    FROM `tblassignnotice` 
	LEFT JOIN `tblnotice` ON `tblassignnotice`.`Notice_ID` = `tblnotice`.`Notice_ID` where Tenant_ID=$tenandid;";
$notice_fetch = $con->query($select_notice);


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
                <h1>Notice</h1>
            </header>
            <div class="content">
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Notices</a></p>
                        </div>
                        <?php 
                        if($notice_fetch->num_rows>0){
                        ?>
                        <div class="table-body">
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
                                    foreach ($notice_fetch as $notice_fetchs) {
                                    ?>
                                    <tr>
                                        <td><?php echo $notice_fetchs['Notice_ID'] ?></td>
                                        <td><?php echo $notice_fetchs['Notice_Title'] ?></td>
                                        <td><?php echo $notice_fetchs['Notice_Message'] ?></td>
                                        <td><?php echo $notice_fetchs['Notice_Date'] ?></td>
                                        <td><?php echo $notice_fetchs['Notice_Type'] ?></td>
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
                                    <p>No Notices Available</p>
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