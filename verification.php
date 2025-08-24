<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";
include_once "include/fetchid.php";

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    $tokenquery = "SELECT  * from tbluser where verify_token='$token' LIMIT 1";
    $tokenresult = $con->query($tokenquery);

    if ($tokenresult->num_rows > 0) {
        $row = $tokenresult->fetch_array();

        if ($row['verify_status'] == "0") {
            $clicked = $row['verify_token'];

            $updatequery = "UPDATE tbluser set verify_status='1' WHERE verify_token='$clicked'";
            $result = $con->query($updatequery);

            if ($result) {
                $_SESSION['alert'] = "Your account has been verified successfully";
                header('Location: login.php');
                exit(0);
            } else {
                $_SESSION['alert'] = "Verification failed";
                header('Location: login.php');
                exit(0);
            }
        } else {
            $_SESSION['alert'] = "Email already verified";
            header('Location: login.php');
            exit(0);
        }
    } else {
        $_SESSION['alert'] = "This token does not exists";
        header('Location: login.php');
    }
} else {
    $_SESSION['alert'] = "Not allowed";
    header('Location: login.php');
}