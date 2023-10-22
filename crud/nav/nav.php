<?php
session_start();
include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");

$user_data = check_login($conn);
$_SESSION['id'] = $user_data['id'];
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/nav/nav.css?v=<?php echo time(); ?>" />

</head>

<body>
    <div class="nav">
        <div class="nav-child-left">
            <div class="nav-child"><a class='text-decoration-none' href='/comp1841/crud/home/home.php'>Home</a>
            </div>

            <?php
            // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
            if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                echo "
                <div class='nav-child'><a class='text-decoration-none' href='/comp1841/admin/display.php'>View List
                    Users</a>
            </div>
                ";
            }
            ?>


            <div class="nav-child"><a class='text-decoration-none' href='/comp1841/crud/user/posts.php'>View List
                    Posts</a>
            </div>
            <div class='nav-child'><a class='text-decoration-none' href='/comp1841/crud/module/modules.php'>View List
                    Modules</a>
            </div>
        </div>
        <div class="nav-child-right">

            <div class="admin-notification">Notifications</div>
            <span>Hello, <?php echo $user_data['name']; ?></span>
            <a href="/comp1841/auth/login.php">Logout</a>

        </div>
    </div>
    <script src='./nav.js'></script>
</body>


</html>