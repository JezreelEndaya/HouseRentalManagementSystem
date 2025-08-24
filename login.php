<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";

if (isset($_POST['submit'])) {
    function validate($data)
    {
        $data = htmlspecialchars($data);
        $data = stripslashes($data);
        $data = trim($data);

        return $data;
    }

    $email = validate($_POST['email']);
    $pass = validate($_POST['pass']);

    if (!empty($email) && !empty($pass)) {

        $loginquery = "SELECT * from tbluser where Email_Address='$email' and Password='$pass' and verify_status='1'";
        $loginresult = $con->query($loginquery);

        // tenant
        $tenant_loginquery = "SELECT * from tbltenant where Email_Address='$email' and Password='$pass'";
        $tenant_loginresult = $con->query($tenant_loginquery);
        

        if ($loginresult->num_rows > 0 ||
            $tenant_loginresult->num_rows>0) {

            if($loginresult->num_rows > 0 ){
                if ($row = $loginresult->fetch_assoc()) {
                    if ($row['User_Type'] == "admin") {
                        $_SESSION['User_ID'] = $row['User_ID'];
                        header('Location: admin/admin-dashboard.php');
                    } else if ($row['User_Type'] == "Owner") {

                        $_SESSION['User_ID'] = $row['User_ID'];
                        header('Location: landlord/dashboard.php');
                    }
                }
            }else if($tenant_loginresult->num_rows>0){

                if($tenant_row = $tenant_loginresult->fetch_assoc()){
                    $_SESSION['User_ID'] = $tenant_row['Tenant_ID'];
                    header('Location: tenant/tenant-house.php');
                }
            }

            
        } else {
            header('Location: login.php?alert=Invalid Username or Password');
        }
    } else {
        header('Location: login.php?alert=All fields are required');
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<style>
    .with-eye{
        position: relative;
    }

    input + i{
        font-size: 1.2rem;
        position: absolute;
        right: 10px;
        top: 50%;
        bottom: 50%;
        cursor: pointer;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS: Login</title>
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
            <div class="card login">
                <form action="" method="post">
                    <h1>Login</h1>

                    <?php
                    if (isset($_SESSION['alert'])) {
                    ?> <div class="alert" id="alert">
                            <p> <?php echo $_SESSION['alert']; ?> </p>
                        </div> <?php
                                unset($_SESSION['alert']);
                            } else if (isset($_GET['alert'])) {
                                ?> <div class="alert">
                            <p> <?php echo $_GET['alert']; ?> </p>
                        </div><?php
                            }

                                ?>

                    <div class="input-fields">
                        <label for="email">Email <span>*</span></label>
                        <input type="text" name="email" placeholder="Enter your Email Address">
                    </div>
                    <div class="input-fields with-eye">
                        <label for="pass">Password <span>*</span></label>
                        <input type="password" name="pass" id="password" placeholder="Enter your Password">
                        <i class="fa-solid fa-eye"></i>
                    </div>
                    <div class="input-fields side">
                        <a href="forgot-password.php">Forgot Password?</a>
                    </div>
                    <div class="input-fields">
                        <button type="submit" name="submit">Login</button>
                    </div>

                </form>
                <p>Don't have an account yet? <a href="register.php">Join Now</a></p>
            </div>
        </main>
    </div>

    <script src="js/script.js"></script>
    <script src="js/alert.js"></script>
    
    <script>
        
        let eye_icon = document.querySelector('.fa-eye');
        let password = document.getElementById('password');

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