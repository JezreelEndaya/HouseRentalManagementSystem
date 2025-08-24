<?php
if (!isset($_SESSION)) {
    session_start();
}

include "connection/dbcon.php";

if(isset($_GET['h'])){
    $house_id = $_GET['h'];

    $view_apartment_query = "SELECT `tblhouse`.*, `tblapartment`.*, `tblapartmentaddress`.*, `tblowners`.*
    FROM `tblhouse` 
        LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
        LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
        LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` where tblhouse.House_ID=$house_id";
    $view_apartment_result = $con->query($view_apartment_query);
    $view_apartment_row = $view_apartment_result->fetch_assoc();
}


?>

<!DOCTYPE html>
<html lang="en">

<style>
    #featured-house {
        background-color: #ececec !important;
    }

    .card-house {
        background-color: #ececec !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="landlord/css/table.css">
    <link rel="stylesheet" href="css/styling.css">

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
</head>

<body>

    <div class="container">
        <div class="header">
            <?php
            include_once "include/header.php";
            ?>
        </div>
        <br><br>
        <main>

            <div class="house-wrapper">
                <div class="house-image">
                    
                    <?php $imageData = $view_apartment_row['image'] ?>
                    <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                </div>
                <br><br>
                <div class="details">
                    <div class="detail">
                        <div class="detail-1">
                            <p class="bold font-3 f-color-p">House For Rent</p>
                            <p class="font-2"><?php echo $view_apartment_row['Addres']?></p>
                            <br>
                            <p class="font-3 bold">Price: ₱<?php echo $view_apartment_row['Monthly_Rent'] ?></p>
                        </div>
                        <br><br>
                        <div class="detail-2">
                            <p class="bold font-2 f-color-s">Description</p>
                            <p><?php echo $view_apartment_row['Description'] ?></p>
                            <p class="font-1-3">Bedroom: <?php echo $view_apartment_row['No_Bedroom'] ?></p>
                            <p class="font-1-3">Comfort Room: <?php echo $view_apartment_row['No_ComfortRoom'] ?></p>
                        </div>    
                    </div>
                    <br><br>

                    <div class="contact">
                        <div class="contact-header">
                            <p class="t-align-center bg-p l-height-40 color-white font-1-5">Ask for more Information</p>

                            <form method="POST" id="request-form" class="padding-10">
                                <p class="font-1">Owner: <?php echo $view_apartment_row['Firstname'] ." ". $view_apartment_row['Lastname']?><p>
                                <p class="font-1 line-buttom" >Call: +63<?php echo $view_apartment_row['Contact_Number']?><p>
                                    <br>

                                <div class="input-fields">
                                    <input type="text" id="cnum" name="cnum" placeholder="Phone Number">
                                </div>
                                <br>
                                <div class="input-fields" style="display: none;">
                                    <input type="text" id="houseid" name="houseid" value="<?php echo $view_apartment_row['House_ID']?>">
                                </div>

                                <div class="input-fields">
                                    <input type="text" id="fname" name="fname" placeholder="Fullname">
                                </div>
                                <br>
                                <div class="input-fields">
                                    <input type="email" id="email" name="email" placeholder="Enter a valid Email Address">
                                </div>
                                <br>
                                <div class="input-fields">
                                    <textarea type="text" id="message" name="message" placeholder="Message"></textarea>
                                </div>
                                <br>
                                <div class="button">
                                    <button type="submit" id="button-submit" name="submit-request">Request Details</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                <br><br>
                <p class="bold font-2 f-color-s">Location: </p>
                <div class="map" id="map">
                </div>
            </div>
        
        </main>
        <br><br>

        <div class="footer">
            <?php
            include_once "include/footer.php";
            ?>
        </div>

        <script>

            document.getElementById('request-form').addEventListener('submit', submit);  

            function submit(e){
                e.preventDefault();

                var cnum = document.getElementById('cnum').value;
                var fname = document.getElementById('fname').value;
                var email = document.getElementById('email').value;
                var message = document.getElementById('message').value;
                var houseid = document.getElementById('houseid').value;

                var param = "cnum="+cnum + 
                            "&fname="+fname + 
                            "&email="+email + 
                            "&message="+message +
                            "&houseid="+houseid;

                var xhr = new XMLHttpRequest();
                xhr.open('POST','send-request.php',true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

                xhr.onprogress = function(){
                    document.getElementById('button-submit').innerHTML = "Request Sended";
                }

                xhr.onload = function(){
                    if(xhr.status == 200){
                        var message = this.responseText;
                    }
                }

                xhr.send(param);
            }

        </script>

    </div>
    
    <!-- map js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>
    <script>

        var latitude = "<?php echo $view_apartment_row['Lat']?>";
        var longitude = "<?php echo $view_apartment_row['Lng']?>";

        var map = L.map('map').setView([latitude, longitude], 15); // Set initial view
        var marker;

        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);

        var marker = L.marker([latitude, longitude]).addTo(map);
        marker.bindPopup("Owner: <?php echo $view_apartment_row['Firstname']?>  <?php echo $view_apartment_row['Lastname']?> <br> <?php echo $view_apartment_row['Addres']?>").openPopup();

        // Function to fetch and display address using reverse geocoding
        function fetchAndDisplayAddress(lat, lng) {
            // Show loading message
            loadingMessage.style.display = 'block';

            // Create a new XHR object
            var xhr = new XMLHttpRequest();

            // Configure it with the URL and method
            var url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}`;

            xhr.open('GET', url, true);

            // Set up the onload, onprogress, onerror, and onreadystatechange events
            xhr.onload = function () {
                if (xhr.status >= 200 && xhr.status < 300) {
                    var data = JSON.parse(xhr.responseText);
                    // Display the address in the "location" div


                } else {

                    console.error('Error fetching address:', xhr.statusText);

                }
            };


            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    // Hide loading message when fetch is complete
                    loadingMessage.style.display = 'none';
                }
            };

            // Send the request
            xhr.send();
        }
                             
    </script>
</body>

</html>