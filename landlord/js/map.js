var showLocation = document.getElementById('location');
var showMap = document.getElementById('map-container');
var hideMap = document.getElementById('close-map');

showLocation.addEventListener('click', function(){
    showMap.style.top = "150px";
    showMap.style.opacity = "100%";
});

hideMap.addEventListener('click', function(){
    showMap.style.top = "-1000px";
    showMap.style.opacity = "0%";
});




var map = L.map('map').setView([0, 0], 2); // Set initial view
    var marker;

    L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}',{
        maxZoom: 20,
        subdomains:['mt0','mt1','mt2','mt3']
    }).addTo(map);

    var locationDiv = document.querySelector('.location');
    var loadingMessage = document.getElementById('loading');

    var latitudeInputs = document.getElementById('latitudes');
    var longitudeInputs = document.getElementById('longitudes');
    var locationDivs = document.querySelector('.locations');

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
                locationDivs.value = `${data.display_name}`;

            } else {

                console.error('Error fetching address:', xhr.statusText);
                locationDiv.innerHTML = 'Address not available';
            }
        };

        xhr.onerror = function () {
            console.error('Error fetching address:', xhr.statusText);
            locationDiv.innerHTML = 'Address not available';
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

        latitudeInputs.value = clickedLatLng.lat;
        longitudeInputs.value = clickedLatLng.lng;

        // Fetch and display the address
        fetchAndDisplayAddress(clickedLatLng.lat, clickedLatLng.lng);
    });

    // Fetch and display the initial address on page load
    navigator.geolocation.getCurrentPosition(position => {
        var initialLatLng = L.latLng(position.coords.latitude, position.coords.longitude);

        map.setView(initialLatLng, 12);

        // Fetch and display the address
        fetchAndDisplayAddress(initialLatLng.lat, initialLatLng.lng);
    });

    L.Control.geocoder().addTo(map);