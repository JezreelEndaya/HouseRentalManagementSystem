<?php 

include "connection/dbcon.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

$email = $_POST['email'];
$fname = $_POST['fname'];
$cnum = $_POST['cnum'];
$message = $_POST['message'];
$houseid = $_POST['houseid'];
 
function send__emailverfication($email,$cnum,$fname,$message){
 
  $mail = new PHPMailer(true);
 
    //Server settings
    $mail->isSMTP();                              //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;             //Enable SMTP authentication
    $mail->Username   = 'jezreelhazel10@gmail.com';   //SMTP write your email
    $mail->Password   = 'vnrnbcafsgalqeln';      //SMTP password
    $mail->SMTPSecure = 'ssl';            //Enable implicit SSL encryption
    $mail->Port       = 465;                                    
 
    //Recipients
    $mail->setFrom('jezreelhazel10@gmail.com','House Rental System'); // Sender Email and name
    $mail->addAddress($email);     //Add a recipient email  

    //Content
    $mail->isHTML(true);
    $mail->Subject = 'House Rental System'; 

    $emailtemplate = 
    "
        <h1>You have an new customer</h1>
        <h2>Phone number: $cnum</h5>
        <h2>Fullname: $fname</h5>
        <h2>Message: $message</h5>
        <h2>Email: $email</h5>
    ";

    $mail->Body    = $emailtemplate;
      
    $mail->send();
}

send__emailverfication($email,$cnum,$fname,$message);

$view_owner = "SELECT `tblowners`.*, `tblapartment`.*, `tblapartmentaddress`.*, `tblhouse`.*
    FROM `tblowners` 
        LEFT JOIN `tblapartment` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` 
        LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
        LEFT JOIN `tblhouse` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` where tblhouse.House_ID=$houseid";
$view_owner_result = $con->query($view_owner);
$view_owner_row = $view_owner_result->fetch_assoc();

$ownerid = $view_owner_row['Owner_ID'];

$ad_inquiry = "INSERT into tblinquiry values('','$ownerid','$houseid','$cnum','$fname','$email','$message')";
$request_send = $con->query($ad_inquiry);

if($request_send){
    echo "Request Sended";
}else{
    echo "failed";
}


?>