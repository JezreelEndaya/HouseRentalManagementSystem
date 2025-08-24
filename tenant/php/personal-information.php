<?php
include_once "../../connection/dbcon.php";
include_once "../check_session.php";

$tenant_profile = "SELECT * FROM tbltenant";
$tenant_fetch = $con->query($tenant_profile);
$row = $tenant_fetch->fetch_assoc();

?>

<div class="add-apartment add-maincontent">
        <div class="heading">
            <h1>Personal Information</h1>
        </div>
        <div class="body">
            <form method="POST" id="complain-form" action="">
                <div class="personal-info">
                    <div class="info-content">
                    <div class="input-handler">
                            <label for="title">Tenant ID</label>
                            <input value="<?php echo $row['Tenant_ID'] ?>" disabled >
                        </div>
                        <div class="input-handler">
                            <label for="title">Firstname</label>
                            <input value="<?php echo $row['Firstname'] ?>" disabled >
                        </div>
                        <div class="input-handler expand">
                            <label for="message">Middlename</label>
                            <input value="<?php echo $row['Middlename'] ?>" disabled>
                        </div>
                        <div class="input-handler expand">
                            <label for="message">Lastname</label>
                            <input value="<?php echo $row['Lastname'] ?>" disabled>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

