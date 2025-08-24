<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

if(isset($_GET['tenantid'])){
    $tenantid = $_GET['tenantid'];

    if(isset($_POST['submit'])){

        $fname = $_POST['fname'];
        $mname = $_POST['mname'];
        $lname = $_POST['lname'];
        $cnum = $_POST['cnum'];

        $update_tenant_query = "UPDATE tbltenant set Firstname='$fname', Middlename='$mname',  Lastname='$lname', Contact_Number='$cnum' where Tenant_ID=$tenantid";
        $update_tenant_result = $con->query($update_tenant_query);

        if($update_tenant_result){
            ?> 
                <script>
                    alert("Updated Successfully");
                    window.location.href = "http://localhost:3000/landlord/tenant.php";
                </script>
            <?php
        }

        $con->close();

    }

}else{
    header('Location: tenant.php') ;
}

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
                <h1></h1>
            </header>
            <div class="content">

                <div class="add-tenant add-maincontent">
                    <div class="heading">
                        <p>Update Tenant Information</p>
                    </div>
                    <div class="body">
                        <form action="" method="POST">
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

                                <?php 
                                    if(isset($_GET['tenantid'])){
                                        $tenantid = $_GET['tenantid'];

                                        $tenant_list_query = "SELECT * from tbltenant where Tenant_ID=$tenantid";
                                        $tenant_list_result = $con->query($tenant_list_query);
                                        $tenant_list_row =  $tenant_list_result->fetch_assoc();
                                    
                                ?>

                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="fname">Firstname <span>*</span></label>
                                        <input name="fname" type="text" value="<?php echo $tenant_list_row['Firstname'] ?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="mname">Middlename</label>
                                        <input name="mname" type="text" value="<?php echo $tenant_list_row['Middlename'] ?>">
                                    </div>
                                    <div class="input-handler">
                                        <label for="lname">Lastname <span>*</span></label>
                                        <input name="lname" type="text" value="<?php echo $tenant_list_row['Lastname'] ?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="cnum">Contact Number <span>*</span></label>
                                        <input name="cnum" type="tel" value="<?php echo $tenant_list_row['Contact_Number'] ?>" required>
                                    </div>
                                    <div class="input-handler">
                                        <label for="email">Email Address <span>*</span></label>
                                        <input name="email" type="" value="<?php echo $tenant_list_row['Email_Address'] ?>" disabled>
                                    </div>
                                </div>

                                <?php }?>
                                <div class="button-add">
                                    <button type="submit" name="submit">Update</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script src="js/tenant.js"></script>
</body>

</html>