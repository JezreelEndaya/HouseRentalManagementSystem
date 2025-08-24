

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

    <!-- <div class="hamburger2">
        <span></span>
        <span></span>
        <span></span>
    </div> -->
    
    <nav class="sidebar">
        <div class="header">
            <h1>House Rental System</h1>
            <!-- <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div> -->
        </div>

        <div class="nav">
            <ul>
                <li class="link">              
                    <a href="admin-dashboard.php">
                        <div class="side">
                        <i class="fa-solid fa-square-poll-vertical r" ></i>
                            <p>Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="link">
                    <a href="landlord.php">
                        <div class="side">
                        <i class="fa-solid fa-user-tie"></i>
                            <p>Landlords</p>
                        </div>
                        
                    </a>
                </li >
                <li class="link">
                    <a href="admin-request.php">
                        <div class="side">
                        <i class="fa-solid fa-bell"></i>
                            <p>Admin Request</p>
                        </div>
                        
                    </a>
                </li >
                <li class="link">
                    <a href="apartment-guide-map.php">
                        <div class="side">
                        <i class="fa-solid fa-location-dot"></i>
                            <p>Apartment Guide Map</p>
                        </div>
                        
                    </a>
                </li >
                <div class="logout">
                    <li class="link link1">
                        <a href="../../logout.php">
                            <div class="side">
                                <i class="fa-solid fa-right-from-bracket"></i>
                                <p>Logout</p>
                            </div>
                        </a>
                    </li>
                </div>
            </ul>
        </div>
    </nav>
    <script src="include/sidebar.js"></script>
</body>
</html>