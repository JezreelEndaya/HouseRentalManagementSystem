<?php
include_once "../../connection/dbcon.php";
include_once "../../include/fetch-id.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id =  $_SESSION['User_ID'];

    // Retrieve form data
    {
        function validate($data)
        {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        $fname = validate($_POST["fname"]);
        $mname = validate($_POST["mname"]);
        $lname = validate($_POST["lname"]);
        $cnum = validate($_POST["cnum"]);
        $email = validate($_POST["email"]);

        // passowrd
        $password = $fname.'12345';

        //generate pass
        $password = $fname . '12345';

        // tenant
        $tenant = 'Tenant';

            if (
                empty($fname) ||
                empty($lname) ||
                empty($cnum) ||
                empty($email)
            ) {

                header('Location: ../tenant.php?error=Fields with asterisk (*) is required');
            } else {

                // add tenant
                $addtenantquery = "INSERT into tbltenant(Tenant_ID,Owner_ID,Firstname,Middlename,Lastname,Email_Address,Password,Contact_Number,Start_Date)
                                    value('$newtenantid','$ownerid','$fname', '$mname','$lname','$email','$password','$cnum','$datenow')";
                $con->query($addtenantquery);

                header('Location: ../tenant.php?success=');
            }
        }
    }
?>