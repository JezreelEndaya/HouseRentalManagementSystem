<?php
include_once "../connection/dbcon.php";
include_once "check_session.php";

if(!isset($_SESSION)){
    session_start();
}

$select_complain = "SELECT * from tblcomplain where Tenant_ID=$tenandid";
$complain_fetch = $con->query($select_complain);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/table.css">
    <!-- input-handler -->
    <link rel="stylesheet" href="css/input-handler.css">
</head>

<body>
    <div class="container">
        <?php
        include 'include/sidebar.php'
        ?>
        <main>
            <header>
                <h1>List Complain</h1>
            </header>
            <div class="content">
                <div class="body">
                    <div class="view-information all-table">
                        <div class="heading">
                            <p>Complain History</a></p>
                        </div>
                        <?php 
                        if($complain_fetch->num_rows>0){
                        ?>
                        <div class="table-body">

                        <?php
                            if (isset($_SESSION['alert'])) {
                            ?> <div class="alert" id="alert">
                                    <p><i class="fa-solid fa-check"></i> <?php echo $_SESSION['alert']; ?> </p>
                                   
                                </div> 
                                <br>
                            <?php
                                unset($_SESSION['alert']);
                            }
                        ?>
                            
                            <table class="table-default">
                                <thead>
                                    <tr>
                                        <th>Complain Title</th>
                                        <th>Message</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                    foreach ($complain_fetch as $complain_fetchs) {
                                    ?>
                                    <tr>
                                        <td><?php echo $complain_fetchs['Complain_Title'] ?></td>
                                        <td><?php echo $complain_fetchs['Complain_Message'] ?></td>
                                        <td><?php echo $complain_fetchs['Complain_Date'] ?></td>
                                        <td class="action">
                                            <a href="" class="edit">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <a href="php/delete-complain.php?complainid=<?php echo $complain_fetchs['Complain_ID']?>" class="delete">
                                                <i class="fa-solid fa-delete-left"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php 
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php 
                        }else{
                            ?> 
                                <div class="empty-content">
                                    <p>No complains Available</p>
                                </div>
                            <?php 
                        }
                        ?>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>