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
            <form method="POST" id="complain-form" action="">
                <div class="personal-info">
                    <div class="info-content">
                        <div class="input-handler">
                            <label for="title">Contact_Number</label>
                            <input value="<?php echo $row['Contact_Number'] ?>" disabled  >
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>


