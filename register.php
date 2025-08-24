<?php

if(!isset($_SESSION)){
    session_start();
}

include_once "connection/dbcon.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
 
function send__emailverfication($email,$verifytoken){
 
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
    $mail->Subject = 'House Rental System Email Verification'; 

    $emailtemplate = 
    "
        <h1>You have Registered with House Rental System</h1>
        <h5>Verify your email address to Login with the below given link</h5>
        <br/>
        <a href='http://localhost:3000/HMS/verification.php?token=$verifytoken'>Click Me</a>
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
    $fname = validate($_POST['fname']);
    $lname = validate($_POST['lname']);
    $pnum = validate($_POST['pnum']);
    $type = validate($_POST['type']);
    $pass = validate($_POST['pass']);

    $fullname = $fname . " " . $lname; 
    $verifytoken = md5(rand());

    $year = date("Y");
    $month = date("n");
    $min = date("i");
    $sec = date("s");

    $id =  $year . $month . $min . $sec;

    $email_address = "SELECT Email_Address from tbluser where Email_Address='$email'";
    $result_email = $con->query($email_address);

    if($result_email->num_rows>0){

        $_SESSION['alert'] = "Email address is already registered";
        header('Location: register.php');
        exit();

    }else{
       

        if($type === 'admin'){
            $userquery = "INSERT into tbluser values('$id','$email','$pass','$verifytoken','0','$type')";
            $con->query($userquery);

            $adminquery = "INSERT into tbladmin values('','$id','$fname','$lname','$pnum')";
            $con->query($adminquery);
        }else{
            send__emailverfication($email,$verifytoken);

            $userquery = "INSERT into tbluser values('$id','$email','$pass','$verifytoken','0','$type')";
            $con->query($userquery);

            $ownerquery = "INSERT into tblowners values('','$id','$fname','$lname','$pnum','','')";
            $con->query($ownerquery);
        }

        $_SESSION['alert'] = "We have sent a verification to your account, please verify";
        header('Location: login.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<style>
    .with-eye{
        position: relative;
    }

    .with-eye i{
        font-size: 1.2rem;
        position: absolute;
        right: 5px;
        cursor: pointer;
        top: 50%;
        transform: translate(-50%, -50%);
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS: Register</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/background.css">
</head>

<body>
    <div class="container full">
        <div class="header">
            <?php
            include_once "include/header.php";
            ?>
        </div>
        <br><br>
        <main>
            <div class="card">
                <form action="" method="post">
                    <h1>Register</h1>
                    <?php
                        if(isset($_SESSION['alert'])){
                            ?> <div class="alert" id="alert">
                            <p> <?php echo $_SESSION['alert']; ?> </p>
                            </div> <?php 
                            unset($_SESSION['alert']);
                        }
                    ?>
                    <div class="input-fields">
                        <label for="email">Enter your Email <span>*</span></label>
                        <input type="text" name="email" id="email" placeholder="Enter your Email Address">
                        <p id="emailerr"></p>
                    </div>
                    <div class="input-fields">
                        <label for="fname">Firstname <span>*</span></label>
                        <input type="text" name="fname" id="fname" placeholder="Enter your Firstname">
                        <p id="fnameerr"></p>
                    </div>
                    <div class="input-fields">
                        <label for="lname">Lastname <span>*</span></label>
                        <input type="text" name="lname" id="lname" placeholder="Enter your Lastname">
                        <p id="lnameerr"></p>
                    </div>
                    <div class="input-fields">
                        <label for="pnum">Phone number <span>*</span></label>
                        <input type="text" name="pnum" id="pnum" placeholder="Enter your Phone Number">
                        <p id="pnumerr"></p>
                    </div>
                    <div class="input-fields">
                        <select name="type" id="type">
                            <option value="" selected disabled>Select User Type</option>
                            <option value="admin">Admin</option>
                            <option value="Owner">Owner</option>
                        </select>
                        <p id="typeerr"></p>
                    </div>
                    <div class="input-fields">
                        <label for="pass">Password <span>*</span></label>
                        <div class="with-eye">
                            <input type="password" name="pass" id="pass" placeholder="Enter your Password">
                            <i class="fa-solid fa-eye"></i>
                        </div>
                        <p id="passerr"></p>
                    </div>
                    <div class="input-fields">
                        <button type="submit" name="submit" id="register">Register</button>
                    </div>
                </form>
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>

    <script>
        let eye_icon = document.querySelector('.fa-eye');
        let password = document.getElementById('pass');

        eye_icon.addEventListener('click', function(){

            eye_icon.classList.toggle('fa-eye');
            eye_icon.classList.toggle('fa-eye-slash');

            if(password.type === "password"){
                password.type = "text";
            }else{
                password.type = "password";
            }
            
        });
    </script>
</body>

</html>