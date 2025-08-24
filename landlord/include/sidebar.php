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
                    <a href="dashboard.php">
                        <div class="side">
                            <i class="fa-solid fa-square-poll-vertical r" ></i>
                            <p>Dashboard</p>
                        </div>
                    </a>
                </li>
                <li class="link">
                    <a href="profile.php">
                        <div class="side">
                            <i class="fa-solid fa-user r"></i>
                            <p>Profile</p>
                        </div>
                    </a>
                </li>
                <li class="link dropdown">
                    <a>
                        <div class="side">
                            <i class="fa-solid fa-building"></i>
                            <p>Apartments</p>
                            <i class="caret fa-solid fa-caret-down"></i>
                        </div>
                        
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="add-apartment.php">Add Apartments</a>
                        </li>
                        <li>
                            <a href="list-apartments.php">List Apartments</a>
                        </li>
                        <li>
                            <a href="add-house.php">Add Houses</a>
                        </li>
                        <li>
                            <a href="list-houses.php">List Houses</a>
                        </li>
                    </ul>
                </li >
                <li class="link dropdown">
                    <a>
                        <div class="side">
                            <i class="fa-solid fa-key"></i>
                            <p>Tenants</p>
                            <i class="caret fa-solid fa-caret-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="tenant.php">Add Tenant</a>
                        </li>
                        <li>
                            <a href="assign-tenant.php">Assign Tenant</a>
                        </li>
                    </ul>
                </li >

                <li class="link dropdown">
                    <a>
                        <div class="side">
                            <i class="fa-solid fa-message"></i>
                            <p>Notices</p>
                            <i class="caret fa-solid fa-caret-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="notice.php?notice=private">Private Notice</a>
                        </li>
                        <li>
                            <a href="notice.php?notice=public">Public Notice</a>
                        </li>
                        <li>
                            <a href="manage-notice.php">Manage Notice</a>
                        </li>
                        <li>
                            <a href="view-complain.php">View Complains</a>
                        </li>
                    </ul>
                </li >
                <li class="link dropdown">
                    <a>
                        <div class="side">
                            <i class="fa-solid fa-file-invoice-dollar"></i>
                            <p>Payments</p>
                            <i class="caret fa-solid fa-caret-down"></i>
                        </div>
                    </a>
                    <ul class="sub-menu">
                        <li>
                            <a href="list-payments.php">List of Payments</a>
                        </li>
                        <li>
                            <a href="payment.php">List of Unpaid</a>
                        </li>
                    </ul>
                </li >
                <li class="link">
                    <a href="inquiries.php">
                        <div class="side">
                            <i class="fa-solid fa-file-lines r"></i>
                            <p>Inquiries</p>
                        </div>
                    </a>
                </li>
                <li class="link">
                    <a href="reports.php">
                        <div class="side">
                            <i class="fa-solid fa-file-lines r"></i>
                            <p>Reports</p>
                        </div>
                    </a>
                </li>
                
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
    <script>
        const activeVar = window.location.pathname;
        const navlinks = document.querySelectorAll('li a').forEach(link => {

            if(link.href.includes(`${activeVar}`)){
                link.classList.add('active');
                link.parentElement.parentElement.classList.add('active');
            }


        });
    </script>
    <script>
        var hamburger = document.querySelector('.hamburger2');
        var sidebar = document.querySelector('.sidebar');

        hamburger.addEventListener('click', function(){
            sidebar.classList.toggle('active');
        });
    </script>
</body>
</html>