<?php
include_once "../connection/dbcon.php";

$total_owner_query = 'SELECT count(*) from tblowners';
$reult_owner = $con->query($total_owner_query);
$owner_row = $reult_owner->fetch_assoc();

$total_apartments_query = 'SELECT count(*) from tblapartment';
$reult_apartments = $con->query($total_apartments_query);
$apartments_row = $reult_apartments->fetch_assoc();

$total_houses_query = 'SELECT count(*) from tblhouse';
$reult_houses = $con->query($total_houses_query);
$houses_row = $reult_houses->fetch_assoc();

$total_tenants_query = 'SELECT count(*) from tbltenant';
$reult_tenants = $con->query($total_tenants_query);
$tenants_row = $reult_tenants->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
</head>

<body>
    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
            <header>
                <h1>Welcome Admin</h1>
            </header>
            <div class="content">
                <div class="grid-body">
                    <a href="">
                        <div class="card">
                            <img src="" alt="">
                            
                            <p class="label-card-total">
                                <?php echo $owner_row['count(*)']?>
                            </p>
                            <br><br>
                            <p class="total">Total Owners</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="">
                        <div class="card">
                            <img src="" alt="">
                            
                            <p class="label-card-total">
                            <?php echo $apartments_row['count(*)']?>
                            </p>
                            <br><br>
                            <p class="total">Total Apartments</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="">
                        <div class="card">
                            <img src="" alt="">
                            
                            <p class="label-card-total">
                            <?php echo $houses_row['count(*)']?>
                            </p>
                            <br><br>
                            <p class="total">Total Houses</p>
                            <p></p>
                        </div>
                    </a>
                    <a href="">
                        <div class="card">
                            <img src="" alt="">
                            
                            <p class="label-card-total">
                            <?php echo $tenants_row['count(*)']; ?>
                            </p>
                            <br><br>
                            <p class="total">Total Tenants</p>
                            <p></p>
                        </div>
                    </a>
                </div>
            </div>
        </main>
    </div>
</body>

</html>