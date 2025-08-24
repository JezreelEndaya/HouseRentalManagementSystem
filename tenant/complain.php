<?php
include_once "../connection/dbcon.php";
include "check_session.php";

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
                <h1>Complain</h1>
            </header>
            <div class="content">
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <h1>Complain</h1>
                        <p><a href="tenant-house.php"><i class="fa-solid fa-right-left"></i></a></p>
                    </div>
                    <div class="body">
                        <form method="POST" id="complain-form">
                            <div class="personal-info">
                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="title">Complain Title</label>
                                        <input name="title" class="title" id="title" value="">
                                    </div>
                                    <div class="input-handler expand">
                                        <label for="message">Message</label>
                                        <textarea name="message" class="message" id="message"></textarea>
                                    </div>
                                </div>
                                <div class="button-add">
                                    <button type="submit" name="submit" id="loading">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('complain-form').addEventListener('submit', complainSend);
       
        function complainSend(e){
            e.preventDefault();

            var title = document.getElementById('title').value;
            var message = document.getElementById('message').value;

            var xhr = new XMLHttpRequest();
            var params = "message=" + message + "&title=" + title;

            xhr.open('POST', 'php/send-complain.php',true);
            xhr.setRequestHeader('Content-type','application/x-www-form-urlencoded');


            xhr.onprogress = function(event) {
                if (event.lengthComputable) {
                var percentage = (event.loaded / event.total) * 100;
                console.log('Loading progress: ' + percentage + '%');
                
                // Update the loading indicator
                updateLoadingIndicator(percentage);
                }
            };

            xhr.onreadystatechange = function (){
                if(xhr.readyState === 4 && xhr.status == 200){
                    console.log(this.responseText);
                }
            }

            xhr.send(params);
        }

        function updateLoadingIndicator(percentage) {
        document.getElementById('loading').innerHTML = 'Loading... ' + percentage.toFixed(2) + '%';
        }
    </script>

</body>

</html>