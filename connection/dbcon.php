<?php

$sname = "localhost";
$uname = "root";
$password = "";
$dbname = "apartmentmanagement";

$con = new mysqli($sname, $uname, $password, $dbname);

if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

?>
