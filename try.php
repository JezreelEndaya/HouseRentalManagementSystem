<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
    <style>
        #map {
            height: 400px;
        }
        .loading {
            display: none;
        }
    </style>
    <title>Leaflet Map</title>
</head>
<body>

<div id="map" class="map">
<div>
    <label for="latitude">Latitude:</label>
    <input type="text" id="latitude" readonly><br>
    <label for="longitude">Longitude:</label>
    <input type="text" id="longitude" readonly>
</div>

<div class="location">
    <p id="loading" class="loading">Fetching address...</p>
</div>

</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

<script>

    var map = L.map('map').setView([0, 0], 2); // Set initial view
    var marker;

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '© OpenStreetMap'
    }).addTo(map);

    var latitudeInput = document.getElementById('latitude');
    var longitudeInput = document.getElementById('longitude');
    var locationDiv = document.querySelector('.location');
    var loadingMessage = document.getElementById('loading');

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
                locationDiv.value = `${data.display_name}`;

            } else {

                console.error('Error fetching address:', xhr.statusText);
                locationDiv.innerHTML = 'Address not available';
            }
        };

        xhr.onerror = function () {
            console.error('Error fetching address:', xhr.statusText);
            locationDiv.innerHTML = 'Address not available';
        };

        xhr.onprogress = function (event) {
            if (event.lengthComputable) {
                // Calculate the percentage of completion
                var percentComplete = (event.loaded / event.total) * 100;
               loadingMessage.innerHTML = `Fetching address... ${percentComplete.toFixed(2)}%;`;

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

    // Add a click event listener to the map
    map.on('click', function (event) {
        var clickedLatLng = event.latlng;

        if (marker) {
            map.removeLayer(marker);
        }

        marker = L.marker(clickedLatLng).addTo(map);

        latitudeInput.value = clickedLatLng.lat;
        longitudeInput.value = clickedLatLng.lng;

        // Fetch and display the address
        fetchAndDisplayAddress(clickedLatLng.lat, clickedLatLng.lng);
    });

    // Fetch and display the initial address on page load
    navigator.geolocation.getCurrentPosition(position => {
        var initialLatLng = L.latLng(position.coords.latitude, position.coords.longitude);
        
        map.setView(initialLatLng, 12);
        marker = L.marker(initialLatLng).addTo(map);

        latitudeInput.value = initialLatLng.lat;
        longitudeInput.value = initialLatLng.lng;

        // Fetch and display the address
        fetchAndDisplayAddress(initialLatLng.lat, initialLatLng.lng);
    });

    L.Control.geocoder().addTo(map);
</script>

</body>
</html>