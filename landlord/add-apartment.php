<?php
include_once "../connection/dbcon.php";
include_once "../include/fetch-id.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $id = $_SESSION['User_ID'];

        $name = validate($_POST["name"]);
        $type = validate($_POST["type"]);

        // address

        $address = validate($_POST["address"]);
        $lat = validate($_POST["latitude"]);
        $lng = validate($_POST["longitude"]);

        // apartment id
        $apartmentquery = "SELECT * from tblapartment ORDER BY apartment_id DESC LIMIT 1";
        $resultid = $con->query($apartmentquery) or die($con->error);
        $rowid = $resultid->fetch_assoc()['Apartment_ID'];

        $apartmentid = intval($rowid) + 1;

        // owner id
        $owneridquery = "SELECT Owner_ID from tblowners where User_ID='$id'";
        $owneridres = $con->query($owneridquery) or die($con->error);
        $ownerid = $owneridres->fetch_assoc()['Owner_ID'];

        if (
            empty($name) ||
            empty($address) ||
            empty($lat) ||
            empty($lng) ||
            empty($type)
        ) {

            header('Location: add-apartment.php?error=Fields with asterisk (*) is required');
        } else {

            $add_apartment_query = "INSERT into tblapartment(Apartment_ID,Owner_ID,Apartment_Name,Apartment_Type)
                                    value('$apartmentid','$ownerid','$name','$type')";
            $con->query($add_apartment_query);

            $add_address_query = "INSERT tblapartmentaddress VALUES ('','$apartmentid','$address','$lat','$lng')";
            $con->query($add_address_query);

            $con->close();

            header('Location: add-apartment.php?success');
        }
    }
}

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
    <link rel="stylesheet" href="css/map.css">
    <link rel="stylesheet" href="css/modal.css">
    <?php include "../include/icon/fontawesome.php"; ?>

    <!-- map -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />
</head>

<body>

<div class="map-container" id="map-container">
    <div id="map" class="map"></div>
    <div class="map-info">
            <!-- address -->
        <div class="input-handler" id="location-handler">
            <input name="brgy" class="location" type="text" readonly>
        </div>
        <div class="pay-button" id="close-map">
            <button class="confirm">Confirm</button>
        </div>
    </div>
    <p id="loading" class="loading"></p>
</div>

<?php 
    if(isset($_GET['success'])){
        ?> 
            <script>
                alert("Successfully Added");
                window.location.href = "http://localhost:3000/landlord/add-apartment.php";
            </script>
        <?php
    }
?>
    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
        <header>
                <i class="fa-solid fa-building-user"></i>
                <div class="time">
                    <div class="dateTime">
                        <?php 
                        include "include/time.php" 
                        ?>
                    </div>
                    <i class="fa-solid fa-calendar-day"></i>
                </div>
            </header>
            <div class="content">
                <div class="add-apartment add-maincontent">
                    <div class="heading">
                        <p>Add Apartment</p>
                    </div>
                    <div class="body">
                        <form action="" method="POST">

                            <div class="personal-info">
                                <?php
                                if (isset($_GET['error'])) { ?>
                                    <div class="warning">
                                        <div class="waningmessagge">
                                            <p class="error"><?php echo $_GET['error'] ?></p>
                                        </div>
                                    </div>
                                <?php    }
                                ?>

                                <div class="header">
                                    <p>Apartment Information</p>
                                </div>

                                <div class="info-content">
                                    <div class="input-handler">
                                        <label for="name">Apartment Name <span>*</span></label>
                                        <input name="name" type="text" required>
                                    </div>

                                    <!-- address -->
                                    <div class="input-handler" id="location-handler">
                                        <label for="address">Address <span>*</span></label>
                                        <input name="address" class="locations" type="text" readonly required>
                                        <a id="location">
                                            <i class="fa-solid fa-location-dot"></i>
                                        </a>
                                    </div>
                                    <div class="input-handler none">
                                        <label for="latitude">Latitude:</label>
                                        <input name="latitude" type="text" id="latitudes" readonly>
                                    </div>
                                    <div class="input-handler none">
                                        <label for="longitude">Longitude:</label>
                                        <input name="longitude" type="text" id="longitudes" readonly>
                                    </div>
                                
                                    <div class="input-handler">
                                        <label for="type">Apartment Type<span>*</span></label>
                                        <input name="type" type="text" required>
                                    </div>
                                </div>

                                <div class="button-add">
                                    <button type="submit" name="submit">Add</button>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>

                <div class="apartment-table all-table">

                    <div class="heading">
                        <p>List of apartments</p>
                    </div>

                    <div class="table-body">
                        <?php if($apartmentidresult->num_rows>0){?>
                        <table class="table-default">
                            <thead>
                                <tr>
                                    <th>Apartment ID</th>
                                    <th>Apartment Name</th>
                                    <th>Apartment Type</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($apartmentid as $apartmentids) { ?>
                                    <tr>
                                        <td data-title="Apartment ID:"><?php echo $apartmentids["Apartment_ID"]; ?></td>
                                        <td data-title="Apartment Name:"><?php echo $apartmentids["Apartment_Name"]; ?></td>
                                        <td data-title="Apartment Type:"><?php echo $apartmentids["Apartment_Type"]; ?></td>
                                        <td class="action">
                                            <a href="list-houses.php?apartmentid='<?php echo $apartmentids["Apartment_ID"]; ?>'" class="view">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="edit-apartment.php?apartmentid='<?php echo $apartmentids["Apartment_ID"]; ?>'" class="edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php  }
                                ?>
                            </tbody>
                        </table>
                        <?php 
                        }else{
                            ?> <div class="empty-content">
                                <p>No Registered Apartment</p>
                            </div><?php 
                        }?>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js" integrity="sha512-BwHfrr4c9kmRkLw6iXFdzcdWV/PGkVgiIyIWLLlTSXzWQzxuSg4DiQUCpauz/EWjgk5TYQqX/kvn9pG1NpYfqg==" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script src="js/map.js"></script>

</body>

</html>