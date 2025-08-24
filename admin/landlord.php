<?php 
include_once "../connection/dbcon.php";
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
                <h1>Welcome</h1>
            </header>
            <div class="content">
                <div class="body">
                    <!--  -->
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Landlords    </p>
                        </div>
                        <div class="table-body">
                            <?php 

                                $owner_query = "SELECT `tbluser`.*, `tblowners`.*
                                    FROM `tbluser` 
                                    LEFT JOIN `tblowners` ON `tblowners`.`User_ID` = `tbluser`.`User_ID` where tbluser.User_Type='Owner';";
                                $owner_result = $con->query($owner_query);

                            if($owner_result->num_rows>0){ 
                            ?>
                            <table class="table-default">
                                <thead>
                                    <tr>
                                    <th>Owner Name</th>
                                    <th>Contact Number</th>
                                    <th>Email_Address</th>
                                    <th>Membership StartDate</th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($owner_result  as $owner_row) { ?>
                                    <tr>
                                        <td data-title=""><?php echo $owner_row["Firstname"]." ".$owner_row["Lastname"]; ?></td>
                                        <td data-title=""><?php echo $owner_row["Contact_Number"]; ?></td>
                                        <td data-title=""><?php echo $owner_row["Email_Address"]; ?></td>
                                        <td data-title=""><?php echo $owner_row["Membership_StartDate"]; ?></td>
                                        <?php
                                            $ownerid =  $owner_row["Owner_ID"];
                                        ?>
                                        <td data-title="">
                                            <a href="apartment.php?ownerid=<?php echo $ownerid ?>" class="edit">
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