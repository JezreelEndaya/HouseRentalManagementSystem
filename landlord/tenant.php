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

                <div class="add-tenant add-maincontent">
                    <div class="heading">
                        <p>Register New Tenant</p>
                    </div>
                    <div class="body">
                        <form action="php/tenant.php" method="POST">
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
                                    <p>Personal Information</p>
                                </div>
                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="fname">Firstname <span>*</span></label>
                                        <input name="fname" type="text">
                                    </div>
                                    <div class="input-handler">
                                        <label for="mname">Middlename</label>
                                        <input name="mname" type="text">
                                    </div>
                                    <div class="input-handler">
                                        <label for="lname">Lastname <span>*</span></label>
                                        <input name="lname" type="text">
                                    </div>
                                    <div class="input-handler">
                                        <label for="cnum">Contact Number <span>*</span></label>
                                        <input name="cnum" type="tel">
                                    </div>
                                    <div class="input-handler">
                                        <label for="email">Email Address <span>*</span></label>
                                        <input name="email" type="tel">
                                    </div>
                                </div>
                                <div class="button-add">
                                    <button type="submit" name="submit">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="tenant-table all-table">
                    <div class="heading">
                        <p>List of tenants</p>
                    </div>

                    <div class="table-body">
                        <?php if($tenantresult->num_rows>0){ ?>
                        <table class="table-default">
                            <thead>
                                <tr>
                                    <th>Tenant ID</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Contact Number</th>
                                    <th>Start Date</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($tenantid as $tenantids) {
                                    ?>
                                        <tr>
                                            <td data-title="Tenant_ID:"><?php echo $tenantids["Tenant_ID"] ?></td>
                                            <td data-title="Firstname:"><?php echo $tenantids["Firstname"] ?></td>
                                            <td data-title="Middlename:"><?php echo $tenantids["Middlename"] ?></td>
                                            <td data-title="Lastname:"><?php echo $tenantids["Lastname"] ?></td>
                                            <td data-title="Contact Number:"><?php echo $tenantids["Contact_Number"] ?></td>
                                            <td data-title="Start Date:"><?php echo $tenantids["Start_Date"] ?></td>
                                            <td class="action">
                                                <a href="edit_tenant.php?&tenantid=<?php echo $tenantids["Tenant_ID"] ?>" class="edit">
                                                    <i class="fa-solid fa-pen-to-square"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        <?php }
                        else{
                            ?> 
                                <div class="empty-content">
                                    <p>No Registered Tenant</p>
                                </div>
                            <?php
                        }?>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <script src="js/tenant.js"></script>
</body>

</html>