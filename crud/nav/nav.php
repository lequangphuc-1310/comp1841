<?php
session_start();
include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");

$user_data = check_login($conn);
$_SESSION['user_id'] = $user_data['id'];
$thisUserId = $_SESSION['user_id'];
// echo '<pre>';
// var_dump($_SESSION);
// echo '</pre>';
?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/nav/nav.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <div class="nav-container">
        <div class="nav">
            <div class="nav-child-left">
                <div class='menu icon'>
                    <i class="fas fa-bars"></i>
                    <div class="bridge"></div>
                    <div class="category">
                        <div class="category-item category-item-1"><a href='/comp1841/crud/askPage/askPage.php'>Post a
                                question
                                to community</a>
                        </div>
                        <div class="category-item category-item-2">
                            <a href='/comp1841/crud/user/userInfo.php?userId=<?php echo $thisUserId; ?>'>View your
                                account's information</a>
                        </div>

                        <?php
                        // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
                        if ($_SESSION['user_id'] != $_SESSION['admin_id']) {
                            echo "
                <div class='category-item category-item-3'>
                <a href='/comp1841/crud/user/contactAdmin.php'>
                Contact Administrator
                </a>
                </div>
                ";
                        } else {
                            echo "
                <div class='category-item category-item-3'>
                <a href='/comp1841/admin/contactUser.php'>
                Manage Users' Request
                </a>
                </div>
                ";
                        }
                        ?>
                    </div>
                </div>
                <div class="nav-child"><a class='text-decoration-none' href='/comp1841/crud/home/home.php'>
                        <div class='icon'>

                            <i class="fas fa-home "></i>
                        </div>
                    </a>
                </div>

                <?php
                if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                    echo "
                <div class='nav-child'><a class='text-decoration-none' href='/comp1841/admin/display.php'>View List
                    Users</a>
            </div>
                ";
                }
                ?>


                <div class="nav-child"><a class=' text-decoration-none' href='/comp1841/crud/user/viewPosts.php'>View
                        List
                        Posts
                    </a>
                </div>
                <div class='nav-child'><a class='text-decoration-none' href='/comp1841/crud/module/modules.php'>View
                        List
                        Modules</a>
                </div>
            </div>
            <div class="nav-child-right">

                <div class="admin-notification">Notifications</div>
                <div class="nav-user-avt">
                    <a href="/comp1841/crud/user/userInfo.php?userId=<?php echo $thisUserId; ?>">
                        <?php
                        $userId = $_SESSION['user_id'];
                        $sql = "select `image` from `user` where id = $userId;";
                        $result = $conn->query($sql);
                        $d = $result->fetch();
                        $img = $d['image'];
                        if ($img) {
                            echo '
                    <div class="nav-user-avt-img" style="background: transparent url(/comp1841/crud/user/uploads/' .  $img . ') center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain"></div>';
                        } else {
                            echo '
                        <div class="nav-user-avt-img" style="background: transparent url(/comp1841/crud/user/uploads/IMG-653751dd87d0c4.57015077.png) center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain"></div>';
                        }
                        ?></a>
                </div>
                <span>Hello, <?php echo $user_data['name']; ?></span>
                <div class="logout">
                    <a class='logout-a' href="/comp1841/auth/login.php">Logout &nbsp;<i class="fas fa-sign-out-alt"></i></a>
                </div>

            </div>


        </div>
    </div>

    </div>
    <script src='./nav.js'></script>
</body>


</html>