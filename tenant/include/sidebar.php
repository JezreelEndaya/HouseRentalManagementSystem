<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="include/sidebar.css">
    <!-- font awesome -->
    <?php include "../include/icon/fontawesome.php"; ?>
</head>
<body>

    <div class="hamburger2">
        <span></span>
        <span></span>
        <span></span>
    </div>
    
    <nav class="sidebar">
        <div class="header">
            <h1>House Rental System</h1>
        </div>

        <div class="nav">
            <ul>
                <li class="link">
                    <a href="tenant-house.php">
                        <div class="side">
                             <i class="fa-solid fa-house-chimney-window"></i>
                            <p>My House</p>
                        </div>
                    </a>
                </li>
                <li class="link">
                    <a href="notices.php">
                        <div class="side">
                            <i class="fa-solid fa-message"></i>
                            <p>Notices</p>
                        </div>
                    </a>
                </li>
                <li class="link dropdown">
                    <a>
                        <div class="side">
                        <i class="fa-solid fa-envelope"></i>
                            <p>Complain</p>
                            <i class="caret fa-solid fa-caret-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="complain.php">Send Complain</a>
                        </li>
                        <li>
                            <a href="view-complain.php">View Complains</a>
                        </li>
                    </ul>
                </li >
                <li class="link">
                    <a href="tenant-profile.php">
                        <div class="side">
                            <i class="fa-solid fa-user"></i>
                            <p>Profile</p>
                        </div>
                    </a>
                </li>
                
                <li class="link link1">
                    <a href="../../logout.php">
                        <div class="side">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <p>Logout</p>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <script src="include/sidebar.js"></script>
    <script>
        var hamburger = document.querySelector('.hamburger2');
        var sidebar = document.querySelector('.sidebar');

        hamburger.addEventListener('click', function(){
            sidebar.classList.toggle('active');
        });
    </script>

</body>
</html>