<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="include/header-footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

        <div class="logo">
            <img src="" alt="">
            <h1>Rentals</h1>
        </div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="apartments.php">Properties</a></li>
            <li><a href="login.php">Login</a></li>
        </ul>

    <script>
        const activeVar = window.location.pathname;
        const navlinks = document.querySelectorAll('li a').forEach(link => {

            if(link.href.includes(`${activeVar}`)){
                link.classList.add('active');
                link.parentElement.parentElement.classList.add('active');
            }


        });
    </script>
</body>
</html>