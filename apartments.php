<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once "connection/dbcon.php";

?>

<!DOCTYPE html>
<html lang="en">

<style>
    #featured-house {
        background-color: #ececec !important;
    }

    .card-house {
        background-color: #ececec !important;
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HMS-Apartments</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/modal.css">
    <link rel="stylesheet" href="css/styling.css">
    <link rel="stylesheet" href="landlord/css/table.css">
    
</head>

<body>
    <div class="container">
        <div class="header">
            <?php
            include_once "include/header.php";
            ?>
        </div>

        <main>

            <div id="featured-house" class="mt-100">

                <nav>
                    <form action="" id="address">
                        <div class="input-fields">
                            <input type="text" placeholder="Search..." list="addresses" id="addresslist">

                            <div class="hidden">
                                <datalist id="addresses">
                                <?php 
                                        $address_query = "SELECT DISTINCT Addres from tblapartmentaddress";
                                        $address_result = $con->query($address_query);

                                        
                                        
                                        foreach($address_result as $address_results){

                                            $full_address = $address_results['Addres'];
                                            $full_address_explode = explode(', ', $full_address);

                                            $address_province = array_slice($full_address_explode, -4, 1)[0];
                                            $address_city = array_slice($full_address_explode, -5, 1)[0];
                                        
                                        ?>
                                        
                                        //     <option value="<?php echo $address_city.", ". $address_province?>"></option>
                                        <?php
                                        }
                                        ?>
                                </datalist>
                            </div>
                           
                        </div>
                        <button class="search">Search</button>
                    </form>
                    
                </nav>

                <div class="houses" id="houses">
                    
                <?php
                    $house_query = 'SELECT `tblhouse`.*, `tblapartment`.*, `tblowners`.*, `tblapartmentaddress`.*
                        FROM `tblhouse` 
                        LEFT JOIN `tblapartment` ON `tblhouse`.`Apartment_ID` = `tblapartment`.`Apartment_ID` 
                        LEFT JOIN `tblowners` ON `tblapartment`.`Owner_ID` = `tblowners`.`Owner_ID` 
                        LEFT JOIN `tblapartmentaddress` ON `tblapartmentaddress`.`Apartment_ID` = `tblapartment`.`Apartment_ID`';
                    $allhouseresult = $con->query($house_query);

                    if($allhouseresult->num_rows>0){
                        
                    foreach ($allhouseresult as $row) {

                        $full_address = $row['Addres'];
                        $full_address_explode = explode(', ', $full_address);

                        $address_province = array_slice($full_address_explode, -4, 1)[0];
                        $address_city = array_slice($full_address_explode, -5, 1)[0];
                    ?>

                        <div class="card-house">
                            <?php $houseid =  $row['House_ID'] ?>
                            <div class="image">
                                <?php $imageData = $row['image'] ?>
                                <img src="data:image/jpeg;base64, <?php echo base64_encode($imageData); ?>" alt="">
                            </div>
                            <br>
                            <p class="bold font-1-2"><?php echo $address_city.", ".$address_province ?></p>
                            <p><span><?php echo $row['Apartment_Name'] ?> Apartment</span></p>
                            <br>
                            <p><?php echo $row['No_Bedroom'] ?><span> : Bedroom</span> </p>
                            <p><?php echo $row['No_ComfortRoom'] ?><span> : Comfortroom</span></p>
                            <br>
                            <div class="card-footer">
                                <p>₱<?php echo $row['Monthly_Rent'] ?> <span> monthly</span></p>
                                <div class="house-buttons">
                                    <a href="view-apartment.php?h=<?php echo $houseid ?>" class="house-button">More Info..</i></a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <?php }else{
                    ?> 
                        <div class="empty">
                            <div class="image">
                            <img src="img/apartment.png" alt="">
                            <p>Houses Coming Soon</p>
                            </div>
                        </div>
                    <?php
                }?>
                </div>
                <br>
                <br>
                <br>
            </div>
        </main>

        <div class="footer">
            <?php
            include_once "include/footer.php";
            ?>
        </div>

    </div>

    <script>
        document.getElementById('address').addEventListener('submit', addressFetch);
        var houses = document.getElementById('houses');
        
       
        function addressFetch(e){
            e.preventDefault();
            var addresslist = document.getElementById('addresslist').value;
            var addresssearch = document.getElementById('addresslist')  ;
            if(addresslist == ""){ 
                addresslist == " ";
                addresssearch.focus();
            }
                var xhr = new XMLHttpRequest();

                xhr.open('GET','fetch-address.php?address='+addresslist,true);

                xhr.onload = function(){
                    if(xhr.status == 200){
                        console.log(this.responseText);

                        houses.innerHTML = this.responseText;
                    }
                }

                xhr.send();
            
        }
    </script>

    <script>

    </script>

</body>

</html>
