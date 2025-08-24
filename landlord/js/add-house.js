document.addEventListener("DOMContentLoaded", function() {
    document.getElementById("apartment-info").addEventListener("change", function() {
        var apartmentId = this.value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(this.responseText);
                var tableBody = document.getElementById("house-info");
                tableBody.innerHTML = ""; // Clear existing content

                data.forEach(function(house) {
                    var newRow = document.createElement("tr");
                    newRow.innerHTML = "<td data-title='House Type'>" + house.House_Type + "</td>" +
                                       "<td data-title='Number of Bedroom'>" + house.No_Bedroom + "</td>" +
                                       "<td data-title='Number of Comfort Room'>" + house.No_ComfortRoom + "</td>" +
                                       "<td data-title='Monthly Rent '>" + house.Monthly_Rent + "</td>" +
                                       "<td data-title='Status'>" + house.Status + "</td>";
                    tableBody.appendChild(newRow);
                });
            }
        };

        xhr.open("POST", "php/add-house.php", true); // Replace with the actual path to your PHP file
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("apartmentName=" + apartmentId);
    });
});