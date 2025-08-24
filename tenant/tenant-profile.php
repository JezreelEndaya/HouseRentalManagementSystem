<?php
include_once "../connection/dbcon.php";
include_once "check_session.php";

$tenant_profile = "SELECT * FROM tbltenant";
$tenant_fetch = $con->query($tenant_profile);
$row = $tenant_fetch->fetch_assoc();

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

    <link rel="stylesheet" href="css/tenant-house.css">
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
                <div class="apartment-table all-table">

                    <div class="heading">
                        <p>Your Information</p>
                    </div>
                    <div class="table-body">
                        <div class="card-profile">
                            <div class="mini-card" id="personal">
                                <p >Personal Information</p>
                                <i class="fa-solid fa-user"></i>
                            </div>

                            <div class="mini-card" id="account">
                                <p >Account Information</p>
                                <i class="fa-solid fa-gear"></i>
                            </div>

                            <div class="mini-card" id="contact">
                                <p >Contact Information</p>
                                <i class="fa-solid fa-address-book"></i>
                            </div>
                            
                        </div>
                        
                        <br>
                        <div class="fetch-fields" id="fetch-fields">
                        </div>
                        
                    </div>
                    
                </div>

            </div>
        </main>
    </div>

    <script>
        document.getElementById('personal').addEventListener('click', personalInfo);

        function personalInfo(){
            var fetch = document.getElementById('fetch-fields');

            var xhr = new XMLHttpRequest();
            xhr.open('GET','php/personal-information.php',true);

            xhr.onload = function(){
                if(xhr.status==200){
                    console.log(this.responseText);

                    fetch.innerHTML = this.responseText;
                }
            }

            xhr.send();
        }
    </script>

    <script>
        document.getElementById('account').addEventListener('click', accountInfo);

        function accountInfo(){
            var fetch = document.getElementById('fetch-fields');

            var xhr = new XMLHttpRequest();
            xhr.open('GET','php/account-information.php',true);

            xhr.onload = function(){
                if(xhr.status==200){
                    console.log(this.responseText);

                    fetch.innerHTML = this.responseText;
                }
            }

            xhr.send();
        }
    </script>

    <script>
        document.getElementById('contact').addEventListener('click', accountInfo);

        function accountInfo(){
            var fetch = document.getElementById('fetch-fields');

            var xhr = new XMLHttpRequest();
            xhr.open('GET','php/contact-information.php',true);

            xhr.onload = function(){
                if(xhr.status==200){
                    console.log(this.responseText);

                    fetch.innerHTML = this.responseText;
                }
            }

            xhr.send();
        }
    </script>


</body>

</html>