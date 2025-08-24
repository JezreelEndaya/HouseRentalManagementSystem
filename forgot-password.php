<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
 
function send__newpassword($email,$verification_password){
 
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
    $mail->Subject = 'House Rental System Password Recovery'; 

    $emailtemplate = 
    "
        <h5>Your new password:</h5>
        <h1>$verification_password</h1>
    ";

    $mail->Body    = $emailtemplate;
      
    $mail->send();
}

if(isset($_POST['submit'])){
    function validate($data){
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);

        return $data;
    }

    $email = validate($_POST['email']);
    $verification_password = md5(rand());

    if(!empty($email)){
        $find_email_query = "SELECT * from tbluser WHERE Email_Address='$email' and verify_status='1'";
        $result_email = $con->query($find_email_query);

        if($result_email->num_rows>0){
            send__newpassword($email,$verification_password);
            
            $update_pass_query = "UPDATE tbluser set Password='$verification_password'";
            $result_update_pass = $con->query($update_pass_query);

            $_SESSION['alert'] = "Check your email for the new password";
            header('Location: login.php');
        }else{
            header('Location: forgot-password.php?alert=Invalid email address');
        }
    }else{
        header('Location: forgot-password.php?alert=Please enter your email');
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="container">
        <div class="header">
            <?php 
                include_once "include/header.php";
            ?>
        </div>
        <br><br>
        <main>
            <div class="card login">
                <form action="" method="post">
                    <h1>Password Recovery</h1>
                    
                        <?php 
                            if(isset($_GET['alert'])){
                                ?> <div class="alert" id="alert">
                                    <p> 
                                        <?php echo $_GET['alert']; ?> 
                                    </p> 
                                    </div>
                                <?php
                            }
                        ?>
                    
                    <div class="input-fields">
                        <label for="email">Enter your Email Address<span>*</span></label>
                        <input type="text" name="email">
                    </div>
                    <div class="input-fields">
                        <button type="submit" name="submit">verify</button>
                    </div>
                    <p><span>Back to</span><a href="login.php"> Login</a></p>
                </form>
            </div>
        </main>


    </div>

    <script src="js/script.js"></script>
    <script src="js/alert.js"></script>
</body>
</html>