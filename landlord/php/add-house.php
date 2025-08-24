<?php
include_once "../../connection/dbcon.php";
include_once "../../include/fetch-id.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {

    function validate($data)
    {
        $data = trim($data);
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        return $data;
    }

    $id = $_SESSION['User_ID'];

    $apartmentname = validate($_POST['apartmentname']);
    $housetype = validate($_POST['type']);
    $bedroom = validate($_POST['bedroom']);
    $comfortroom = validate($_POST['comfortroom']);
    $rent = validate($_POST['rent']);
    $description = validate($_POST['description']);


    // house id
    $housequery = "SELECT * from tblhouse ORDER BY House_id DESC LIMIT 1";
    $resulthouseid = $con->query($housequery) or die($con->error);
    $rowhouseid = $resulthouseid->fetch_assoc()['House_ID'];
    $houseid = intval($rowhouseid) + 1;

    // owner id
    $owneridquery = "SELECT Owner_ID from tblowners where User_ID='$id'";
    $owneridres = $con->query($owneridquery) or die($con->error);
    $ownerid = $owneridres->fetch_assoc()['Owner_ID'];

    // apartment id query
    $apartmentidquery = "SELECT * from tblapartment where Apartment_Name='$apartmentname'";
    $resultapartmentid = $con->query($apartmentidquery);
    $apartmentidrow = $resultapartmentid->fetch_assoc();
    $apartmentid = $apartmentidrow['Apartment_ID'];

    $image = file_get_contents($_FILES['image']["tmp_name"]);


    if (
        $apartmentname === "" ||
        $housetype === "" ||
        empty($bedroom) ||
        empty($comfortroom) ||
        empty($description) ||
        empty($rent) ||
        empty($image)
    ) {

        header('Location: ../add-house.php?error=Fields with asterisk (*) is required');
    } else {

        $addhousequery = "INSERT into tblhouse (House_ID,Apartment_ID,House_Type,No_Bedroom,No_ComfortRoom,Monthly_Rent,Description,image,Status)values
                                            (?,?,?,?,?,?,?,?,'Vacant')";
        $stmt = $con->prepare($addhousequery);

        if ($stmt) {

            $stmt->bind_param("iisiiiss", $houseid, $apartmentid, $housetype, $bedroom, $comfortroom, $rent, $description, $image);
            $stmt->execute();

            $stmt->close();
            $con->close();

            header('Location: ../add-house.php?success=');
        } else {
        }
    }
}

if (isset($_POST['apartmentName']) && !isset($_POST['submit'])) {

    $apartmentid = $_POST['apartmentName'];

    $housequery = "SELECT * from tblhouse WHERE Apartment_ID='$apartmentid'";
    $houseresult = $con->query($housequery);

    $housetype = array();
    while ($row =  $houserow = $houseresult->fetch_assoc()) {
        $housetype[] = $row;
    }

    echo json_encode($housetype);
}
exit;
