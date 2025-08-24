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
                            <p>Tenants</p>
                        </div>
                        <div class="table-body">
                            <?php 

                            $tenants_query = 'SELECT * from tbltenant';
                            $tenantsidresult = $con->query($tenants_query);

                            if($tenantsidresult->num_rows>0){ 
                            ?>
                            <table class="table-default">
                                <thead>
                                    <tr>
                                    <th>ID</th>
                                    <th>Firstname</th>
                                    <th>Middlename</th>
                                    <th>Lastname</th>
                                    <th>Email_Address</th>
                                    <th>Contact Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($tenantsidresult as $tenantsids) { ?>
                                    <tr>
                                        <td data-title="ID:"><?php echo $tenantsids["Tenant_ID"]; ?></td>
                                        <td data-title="Firstname:"><?php echo $tenantsids["Firstname"]; ?></td>
                                        <td data-title="Middlename:"><?php echo $tenantsids["Middlename"]; ?></td>
                                        <td data-title="Lastname:"><?php echo $tenantsids["Lastname"]; ?></td>
                                        <td data-title="Email_Address:"><?php echo $tenantsids["Email_Address"]; ?></td>
                                        <td data-title="Contact_Number:"><?php echo $tenantsids["Contact_Number"]; ?></td>
                                    </tr>
                                <?php  }
                                ?>
                                </tbody>
                            </table>
                            <?php 
                            }else{
                                ?> <div class="empty-content">
                                    <p>No Registered tenants</p>
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