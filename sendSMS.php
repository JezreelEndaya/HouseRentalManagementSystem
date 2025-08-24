<?php 

if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";

use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__."/vendor/autoload.php";

if(isset($_SESSION['cnum'])){

    $id = $_SESSION['id'];
    $number = "+63". $_SESSION['cnum'];
    $verificationCode = random_int(100000, 999999);

    $update_code = "UPDATE contact_verification set verification_code=$verificationCode where User_ID=$id";
    $update_code_result = $con->execute_query($update_code);

    $message = "Message from House Rental System: You're Phone Number Verification Code is: ".$verificationCode;
    $phoneNumber = $number;

    $apiurl = "gyvvke.api.infobip.com";
    $apikey = "116f8fca23f3aa6b0e3fba707ec63e99-5a06144e-b384-451e-a705-84e89781eaec";

    $configuration = new Configuration(host:$apiurl, apiKey:$apikey);
    $api = new SmsApi(config:$configuration);

    $destination = new SmsDestination(to:$phoneNumber);

    $theMessage = new SmsTextualMessage(
        destinations:[$destination],
        text:$message,
        from: ""
    );

    $request = new SmsAdvancedTextualRequest(messages:[$theMessage]);
    $response = $api->sendSmsMessage($request);

    $_SESSION['newcnum'] = $_SESSION['cnum'];
    unset($_SESSION['cnum']);
    
    header('Location: landlord/edit-profile.php?q=verify');

}else{
    echo "unset";
}

// if(){

// }

?>