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
    <link rel="stylesheet" href="/comp1841/crud/user/userInfo.css?v=<?php echo time(); ?>">
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
                        if ($_SESSION['user_id'] != $_SESSION['admin_id']) { ?>
                        <div class='category-item category-item-3'>
                            <a href='/comp1841/crud/user/contactAdmin.php'>
                                Contact Administrator
                            </a>
                        </div>
                        <?php } else { ?>
                        <div class='category-item category-item-3'>
                            <a href='/comp1841/admin/contactUser.php'>
                                Manage Users' Request
                            </a>
                        </div>
                        <?php }
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
                if ($_SESSION['user_id'] == $_SESSION['admin_id']) { ?>
                <div class='nav-child'><a class='text-decoration-none' href='/comp1841/admin/displayUser.php'>View List
                        Users</a>
                </div>
                <?php    }
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
                <div class="nav-child-chat">
                    <button class="btnChat-nav" onclick="openChat()">Chat
                    </button>
                </div>

            </div>
            <div class="nav-child-right">
                <?php if ($_SESSION['user_id'] != $_SESSION['admin_id']) { ?>
                <div class="admin-notification" onclick="seenNotification()">
                    <a href='/comp1841/crud/user/adminReply.php' style='color: #fff'>
                        Notifications
                        <?php
                            if (array_key_exists('admin_seen', $_SESSION)) {
                                $unread_admin = $_SESSION['admin_seen'];
                                if ($unread_admin == 'unread') {
                            ?>
                        <div class='dot-notification'></div>
                    </a>
                    <?php
                                }
                            }
                        }
            ?>
                    <div class="nav-user-avt">
                        <a href="/comp1841/crud/user/userInfo.php?userId=<?php echo $thisUserId; ?>">
                            <?php
                    $userId = $_SESSION['user_id'];
                    $sql = "select `image` from `user` where id = $userId;";
                    $result = $conn->query($sql);
                    $d = $result->fetch();
                    $img = $d['image'];
                    if ($img) { ?>
                            <div class="nav-user-avt-img"
                                style="background: transparent url(/comp1841/crud/user/uploads/<?php echo $img; ?>) center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain">
                            </div>
                            <?php } else { ?>
                            <div class="nav-user-avt-img"
                                style="background: transparent url(/comp1841/crud/user/uploads/IMG-653751dd87d0c4.57015077.png) center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain">
                            </div>
                            <?php }
                    ?>
                        </a>
                    </div>
                    <span>Hello, <?php echo $user_data['name']; ?></span>
                    <div class="logout">
                        <a class='logout-a' href="/comp1841/auth/login.php">Logout &nbsp;<i
                                class="fas fa-sign-out-alt"></i></a>
                    </div>

                </div>
                <div id="chatArea" style='display:none'>
                    <?php include '/xampp/htdocs/comp1841/chat/homeChat.php'; ?>
                </div>


            </div>
        </div>

    </div>
    <script src='/comp1841/crud/nav/nav.js'></script>
    <script>
    function openChat() {
        let areaText = document.getElementById('chatArea');
        let btnChat = document.getElementsByClassName('btnChat');
        if (areaText.style.display === "none") {
            areaText.style.display = "block";
        }
    }

    function seenNotification() {
        let notificationBtn = document.querySelector('.admin-notification');
        let dotNotification = document.querySelector('.dot-notification');
        <?php $unread_admin = 'read'; ?>
    }
    </script>
</body>


</html>