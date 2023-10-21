<?php
session_start();

include("auth/connection.php");
include("auth/functions.php");

$user_data = check_login($conn);
$_SESSION['id'] = $user_data['id'];
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="./nav.css?v=<?php echo time(); ?>" />

</head>

<body>
    <div class="nav">
        <div class="nav-child-left">
            <div class="nav-child">
                <button class="btn-nav"><a class='text-decoration-none' href='home.php'>Home</a></button>
            </div>
            <div class="nav-child">
                <button class="btn-nav"><a class='text-decoration-none' href='display.php'>View List
                        Users</a></button>
            </div>
            <div class="nav-child">
                <button class="btn-nav"><a class='text-decoration-none' href='posts.php'>View List
                        Posts</a></button>
            </div>
        </div>
        <div class="nav-child-right">
            <a href="./auth/login.php">Logout</a>
            <span>Hello, <?php echo $user_data['name']; ?></span>

        </div>
    </div>
</body>

</html>