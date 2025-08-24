<?php
include_once "../../connection/dbcon.php";
include_once "../check_session.php";

$tenant_profile = "SELECT * FROM tbltenant";
$tenant_fetch = $con->query($tenant_profile);
$row = $tenant_fetch->fetch_assoc();

?>

    <div class="add-apartment add-maincontent">
        <div class="heading">
            <h1>Account Information</h1>
        </div>
        <div class="body">

                <div class="personal-info">
                    <div class="info-content">
                        <div class="input-handler">
                            <label for="title">Email Address</label>
                            <input name="title" class="title" id="title" value="<?php echo $row['Email_Address'] ?>" disabled  >
                        </div>
                    </div>
                </div>

        </div>
    </div>
