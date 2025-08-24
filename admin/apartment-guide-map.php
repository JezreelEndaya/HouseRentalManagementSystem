<?php 
include_once "../connection/dbcon.php";

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
    <link rel="stylesheet" href="css/map.css">

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
</head>

<body>
    <div class="container">

        <?php include 'include/sidebar.php' ?>
        
        <main>
            <header>
                <h1>Welcome</h1>
            </header>
            <div class="content">
                <div class="body">
                    <!--  -->
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>MAP   </p>
                        </div>
                        <div class="table-body">
                            
                            <div class="map" id="map">

                            </div>

                        </div>
                    </div>
                    <!--  -->
                </div>
            </div>
        </main>
    </div>

    <!-- map js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <?php
    
    $map_query = "SELECT `tblapartment`.*, `tblapartmentaddress`.*
        FROM `tblapartment` 
        LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID`;";
    $map_fetch = $con->query($map_query);
    
    $map = array();
    while($map_row = $map_fetch->fetch_assoc()){
        $map[] = $map_row;
    }

    
    ?>

    <script>
        var map = L.map('map').setView([0, 0], 2); // Set initial view
        var addresses = <?php echo json_encode($map); ?>;
        console.log(addresses);

        L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
            maxZoom: 20,
            subdomains:['mt0','mt1','mt2','mt3']
        }).addTo(map);

        

        addresses.forEach(function (address){
            var marker  = L.marker([address.Lat, address.Lng]).addTo(map);
            var openPopup = "Apartment Name: "+address.Apartment_Name+ '<br>' + address.Addres;
            marker.bindPopup(openPopup);
        });

        // Fetch and display the initial address on page load
        navigator.geolocation.getCurrentPosition(position => {
            var initialLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

            map.setView(initialLatLng, 12);

            // Fetch and display the address
            fetchAndDisplayAddress(initialLatLng.lat, initialLatLng.lng);
        });

        L.Control.geocoder().addTo(map);
    </script>
</body>

</html>