<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";


$owner_information_query = "SELECT `tblowners`.*, `tbluser`.*
    FROM `tblowners` 
	LEFT JOIN `tbluser` ON `tblowners`.`User_ID` = `tbluser`.`User_ID` where tbluser.User_ID=$id";
$owner_information_result = $con->query($owner_information_query);
$owner_information_row = $owner_information_result->fetch_assoc();

if(isset($_POST['submit-personal-information'])){

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];

    if(!($fname == ""
    || $lname == "")){
        $update_personal_information_query = "UPDATE tblowners set Firstname='$fname', Lastname='$lname' where User_ID=$id";
        $update_personal_information_success = $con->execute_query($update_personal_information_query);
        
        $_POST['Success'] = "Successfully updated";
        header('Location: profile.php');

    }else{

        $_POST['error'] = "Enter a valid password and try again.";
    }

}

if(isset($_POST['submit-account-information'])){

    $oldpass= $_POST['oldpass'];
    $pass= $_POST['pass'];
    $cpass= $_POST['cpass'];

    $select_password_query = "SELECT Password from tbluser where User_ID=$id";
    $select_password_result = $con->execute_query($select_password_query);
    $select_password_row = $select_password_result->fetch_assoc();

    $existing_pass = $select_password_row['Password'];

    if($existing_pass !== $oldpass || empty($oldpass) || empty($pass) || empty($cpass) || $pass!==$cpass){

        $_POST['error'] = "Enter a valid password and try again.";

    }else{
        
        $update_password_query = "UPDATE tbluser set Password='$pass' where User_ID=$id";
        $update_password_result = $con->execute_query($update_password_query);

        $_POST['success'] = "Successfully updated";
    }

}

if(isset($_POST['submit-contact-information'])){

    $update_number = $_POST['cnum'];

    if($update_number == "0"){
        echo "error";
    }else{
        $update_number_query = "UPDATE tblowners set Contact_Number=$update_number where User_ID=$id";
        $con->execute_query($update_number_query);

        $update_status = "UPDATE contact_verification set verification_code=0,verify_status=0 where User_ID=$id";
        $con->execute_query($update_status);
    }

    header('Location: edit-profile.php?q=contactinformation');
}

if(isset($_POST['sendSMS'])){
    $_SESSION['id'] = $id;
    $_SESSION['cnum'] = $_POST['cnum'];
    header('Location: ../sendSMS.php');
}

if(isset($_POST['verify'])){

    $enter_code = $_POST['code'];

    $verification_code_query = "SELECT * from contact_verification where User_ID=$id";
    $verification_result = $con->query($verification_code_query);
    $verification_row = $verification_result->fetch_assoc();

    $verification_code = $verification_row['verification_code'];

    if($verification_code == $enter_code){

        $newnumber = $_SESSION['newcnum'];
        $update_phone_number = "UPDATE tblowners set Contact_Number=$newnumber where User_ID=$id";
        $con->execute_query($update_phone_number);

        $update_status = "UPDATE contact_verification set verify_status=1 where User_ID=$id";
        $con->execute_query($update_status);

        header('Location: edit-profile.php?q=contactinformation');

    }else{
        echo "error";
    }

}

?>

<!DOCTYPE html>
<html lang="en">

<style>
    input {
        text-transform: capitalize;
    }

    .header {
        display: flex;
        gap: 10px;
    }

    .header a:hover{
        text-decoration: none;
    }

    .verify{
        display: flex;
        gap: 10px;
    }

    .verify a{
        padding: 10px 20px;
        background-color: #229bff;
        border-radius: 6px;
    }

    .verify a:hover{
        text-decoration: none;
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
                <h1>Profile</h1>
            </header>
            <div class="content">
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <p>Update Your Information</p>
                        <p><a href="profile.php"><i class="fa-solid fa-right-left"></i></a></p>
                    </div>
                    <div class="body">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <?php
                            if (isset($_GET['q'])) {
                                if ($_GET['q'] === "personalinformation") {
                            ?>

                                    

                                    <div class="personal-info">

                                    <?php
                                            if (isset($_POST['error'])) { ?>
                                                <div class="warning">
                                                    <div class="waningmessagge">
                                                        <p class="error"><?php echo $_POST['error'] ?></p>
                                                    </div>
                                                </div>
                                            <?php    
                                            unset($_POST['error']);
                                            }else if(isset($_POST['success'])){
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
                                        
                                        <div class="header-button">
                                            <a href="edit-profile.php?q=personalinformation" class="active">Personal Information</a>
                                            <a href="edit-profile.php?q=accountinformation">Account Information</a>
                                            <a href="edit-profile.php?q=contactinformation">Contact Information</a>
                                        </div>
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="ownerid">Owner ID</label>
                                                <input name="ownerid" value="<?php echo $owner_information_row['Owner_ID'] ?>" disabled>
                                            </div>
                                            <div class="input-handler">
                                                <label for="fname">Firstname</label>
                                                <input name="fname" value="<?php echo $owner_information_row['Firstname'] ?>">
                                            </div>
                                            <div class="input-handler">
                                                <label for="lname">Lastname</label>
                                                <input name="lname" value="<?php echo $owner_information_row['Lastname'] ?>">
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="submit-personal-information">Update</button>
                                        </div>
                                    </div>
                            <?php
                                } else if($_GET['q'] === "accountinformation") {
                                    ?>
                                    
                                    <div class="personal-info">
                                        <?php
                                            if (isset($_POST['error'])) { ?>
                                                <div class="warning">
                                                    <div class="waningmessagge">
                                                        <p class="error"><?php echo $_POST['error'] ?></p>
                                                    </div>
                                                </div>
                                            <?php    
                                            unset($_POST['error']);
                                            }else if(isset($_POST['success'])){
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
                                        <div class="header-button">
                                            <a href="edit-profile.php?q=personalinformation">Personal Information</a>
                                            <a href="edit-profile.php?q=accountinformation" class="active">Account Information</a>
                                            <a href="edit-profile.php?q=contactinformation">Contact Information</a>
                                        </div>
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="email">Email Address</label>
                                                <input name="email" value="<?php echo $owner_information_row['Email_Address'] ?>" disabled>
                                            </div>
                                        </div>
                                        <div class="info-content">
                                            <div class="input-handler">
                                                <label for="oldpass">Enter Old Password</label>
                                                <input name="oldpass" type="password">
                                            </div>
                                            <div class="input-handler">
                                                <label for="pass">Enter New Password</label>
                                                <input name="pass" type="password">
                                            </div>
                                            <div class="input-handler">
                                                <label for="cpass">Re-type New Password</label>
                                                <input name="cpass" type="password">
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="submit-account-information">Update</button>
                                        </div>
                                    </div>
                                    <?php
                                }else if($_GET['q'] === "contactinformation"){
                                    ?>
                                    

                                    <div class="personal-info">
                                        <div class="header-button">
                                            <a href="edit-profile.php?q=personalinformation">Personal Information</a>
                                            <a href="edit-profile.php?q=accountinformation">Account Information</a>
                                            <a href="edit-profile.php?q=contactinformation" class="active">Contact Information</a>
                                        </div>
                                        <br><br>
                                        <?php 
                                            $verification_status_query = "SELECT verify_status from contact_verification where User_ID=$id";
                                            $verification_status_result = $con->query($verification_status_query);
                                            $verification_status_row = $verification_status_result->fetch_assoc();

                                            $status = $verification_status_row['verify_status'];

                                            if($status === "0"){
                                                ?> 
                                                    <div class="status">
                                                        <i style="font-family: Arial, Helvetica, sans-serif; font-weight:lighter; color:red;">unverify</i>
                                                    </div>
                                                <?php 
                                            }else{
                                                ?> 
                                                    <div class="status">
                                                        <i style="font-family: Arial, Helvetica, sans-serif; font-weight:lighter; color:green;">verified</i>
                                                    </div>
                                                <?php 
                                            }
                                        ?> 
                                        <div class="info-content">
                                            <div class="input-handler">        
                                                <label for="cnum">Contact Number</label>
                                                <div class="verify">
                                                    <input name="cnum" type="tel" value="<?php echo $owner_information_row['Contact_Number'] ?>">
                                                    <button type="submit" name="sendSMS">Verify</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="button-add">
                                            <button type="submit" name="submit-contact-information">Update</button>
                                        </div>
                                    </div>
                                    <?php
                                }else if($_GET['q'] === "verify"){

                                ?>
                                    <div class="personal-info">
                                        <div class="info-content">
                                            <div class="input-handler">        
                                                <label for="code">Enter Verification Code</label>
                                                <div class="verify">
                                                    <input name="code" type="text" value="">
                                                    <button type="submit" name="verify">Submit</button>
                                                </div>
                                            </div>
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

</html>