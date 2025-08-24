<?php
include_once "../connection/dbcon.php";
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .with-button{
        display: flex;
        gap: 10px;
        justify-content: center;
    }

    .with-button a{
        padding: 10px 20px;
        border-radius: 6px;
    }

    .with-button a:hover{
        text-decoration: none;
    }

    .with-button .approve{
        background-color: #04aa6d;
    }

    .with-button .decline{
        background-color: rgb(255, 87, 87);
    }
</style>

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
                <h1>Welcome Admin</h1>
            </header>

            <div class="content">
                <div class="body">
                    <!--  -->
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Admin Request</p>
                        </div>
                        <div class="table-body">
                            <?php 

                                $admin_query = "SELECT `tbluser`.*,tbluser.User_ID as userid, `tbladmin`.*
                                FROM `tbluser` 
                                    LEFT JOIN `tbladmin` ON `tbladmin`.`User_ID` = `tbluser`.`User_ID` where tbluser.User_Type='admin' and verify_status='0'";
                                $admin_result = $con->query($admin_query);

                            if($admin_result->num_rows>0){ 
                            ?>
                            <table class="table-default">
                                <thead>
                                    <tr>
                                    <th>User ID</th>
                                    <th>Fullname</th>
                                    <th>Contact Number</th>
                                    <th>Email Address</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach($admin_result as $admin_row) { ?>
                                    <tr>
                                        <td data-title=""><?php echo $admin_row["userid"]; ?></td>
                                        <td data-title=""><?php echo $admin_row["Firstname"] ." ". $admin_row["Lastname"] ?></td>
                                        <td data-title=""><?php echo $admin_row["Contact_Number"]; ?></td>
                                        <td data-title=""><?php echo $admin_row["Email_Address"]; ?></td>
                                        <?php
                                            $adminid =  $admin_row["Admin_ID"];
                                        ?>
                                        <td data-title="" class="with-button">
                                            <a href="php/request-approve.php?userid=<?php echo $admin_row["User_ID"]?>" class="approve">Approved</a>
                                            <a href="" class="decline">Decline</a>
                                        </td>
                                    </tr>
                                <?php  }
                                ?>
                                </tbody>
                            </table>
                            <?php 
                            }else{
                                ?> <div class="empty-content">
                                    <p>No Admin Request</p>
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