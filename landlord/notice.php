<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

$all_tenants_query = "SELECT * from tbltenant where Owner_ID=$ownerid";
$all_tenants_result = $con->query($all_tenants_query);

if (isset($_POST['add-private-notice'])) {

    $title = $_POST['title'];
    $tenant_id = $_POST['tenant'];
    $message = $_POST['message'];

    $currentdate = date("Y-m-d");

    if (empty($title) || empty($tenant_id) || empty($message)) {
        $_POST['error'] = "Please filled up all the input fields";
    } else {

        $add_notice = "INSERT into tblnotice values('','$ownerid','$title','$message','$currentdate','private') ";
        $added = $con->execute_query($add_notice);

        $last_inserted_id = $con->insert_id;

        $add_tenant_notice = "INSERT into tblassignnotice values('$tenant_id','$last_inserted_id') ";
        $added = $con->execute_query($add_tenant_notice);

        if ($added) {
            $_POST['success'] = "Successfully Added";
        }
    }
}

if (isset($_POST['add-public-notice'])) {

    $title = $_POST['title'];
    $message = $_POST['message'];

    $currentdate = date("Y-m-d");

    if (empty($title) || empty($message)) {
        $_POST['error'] = "Please filled up all the input fields";
    } else {
        
        $all_add_notice = "INSERT into tblnotice values('','$ownerid','$title','$message','$currentdate','public') ";
        $added = $con->execute_query($all_add_notice);

        $last_inserted_id = $con->insert_id;

        while($all_tenants_rows = $all_tenants_result->fetch_assoc()){

            $tenant_ids = $all_tenants_rows['Tenant_ID'];

            $all_addassign_notice = "INSERT into tblassignnotice values('$tenant_ids','$last_inserted_id') ";
            $added = $con->execute_query($all_addassign_notice);

        }

        if ($added) {
            $_POST['success'] = "Successfully Added";
        }
    }
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
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <?php
                        if (isset($_GET['notice'])) {
                            if ($_GET['notice'] === 'public') {
                        ?>
                                <p>Public Notice</p>
                            <?php
                            } else {
                            ?>
                                <p>Private Notice</p>
                        <?php
                            }
                        }
                        ?>
                        <p><a href="profile.php"><i class="fa-solid fa-right-left"></i></a></p>
                    </div>
                    <div class="body">

                        <?php
                        if (isset($_POST['error'])) { ?>
                            <div class="warning">
                                <div class="waningmessagge">
                                    <p class="error"><?php echo $_POST['error'] ?></p>
                                </div>
                            </div>
                        <?php
                            unset($_POST['error']);
                        } else if (isset($_POST['success'])) {
                        ?>
                            <div class="success">
                                <div class="successmessagge">
                                    <p class="success"><?php echo $_POST['success'] ?></p>
                                </div>
                            </div>
                        <?php
                            unset($_POST['success']);
                        }
                        ?>

                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['notice'])) {
                                $notice = $_GET['notice'];

                                if ($notice === 'private') {
                            ?>
                                    <div class="personal-info">
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="title">Notice Title</label>
                                                <input name="title" value="">
                                            </div>
                                            <div class="input-handler">
                                                <label for="tenant">Select Tenant</label>
                                                <select name="tenant" id="">
                                                    <?php
                                                    if ($all_tenants_result->num_rows > 0) {
                                                    ?>
                                                        <option value="select" disabled selected>Select Tenant</option>
                                                        <?php
                                                        while ($all_tenants_row = $all_tenants_result->fetch_assoc()) {
                                                            $fullname = $all_tenants_row['Firstname'] . " " . $all_tenants_row['Middlename'] . " " . $all_tenants_row['Lastname'];
                                                        ?>
                                                            <option value="<?php echo $all_tenants_row['Tenant_ID'] ?>"><?php echo $fullname ?></option>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <option value="noregistered">No Registered Tenant</option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="input-handler notice">
                                                <label for="message">Message</label>
                                                <textarea name="message" id=""></textarea>
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="add-private-notice">Add</button>
                                        </div>
                                    </div>
                                <?php
                                } else if ($notice === 'public') {
                                ?>
                                    <div class="personal-info">
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="title">Notice Title</label>
                                                <input name="title" value="">
                                            </div>
                                            <div class="input-handler">
                                                <label for="message">Message</label>
                                                <textarea name="message" id=""></textarea>
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="add-public-notice">Add</button>
                                        </div>
                                    </div>
                            <?php
                                }
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

</body>

<?php

if(isset($_GET['id'])){
    echo $_GET['id'];
}
?>

</html>