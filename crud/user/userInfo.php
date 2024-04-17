<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/comp1841/crud/user/userInfo.css?v=<?php echo time(); ?>">

</head>

<body>
    <?php
    include '/xampp/htdocs/comp1841/crud/nav/nav.php';
    $userInfoId = $_GET['userId'];
    $userId = $_SESSION['user_id'];
    ?>
    <?php
    include("/xampp/htdocs/comp1841/toast/toast.php");

    if (array_key_exists('success', $_GET)) {
        $updateImageSuccess = 'Successfully updated your avatar';
    ?>
    <script>
    showSuccess('<?php echo $updateImageSuccess; ?>')
    </script>
    <?php } ?>
    <div class="background">
        <div class="user-info-container">
            <div class="user-intro">

                <div class="user-intro-img-section">

                    <div class="user-intro-img">
                        <?php
                    $sql = "select `image` from `user` where id = $userInfoId;";
                    $result = $conn->query($sql);
                    $d = $result->fetch();
                    if (!$d) {
                    ?>
                        <script>
                        alert('Unable to find user. Please try again.')
                        window.location.href = '/comp1841/crud/search/search.php'
                        </script>
                        <?php
                    }
                    $img = $d['image'];
                    ?>
                        <div class="your-avt">
                            <?php
                        if (!$img) {
                            echo '<div class="your-avt-img" style="background: url(/comp1841/crud/user/uploads/IMG-653751dd87d0c4.57015077.png)
                            center center no-repeat; height: 110px; width: 110px; padding: 1px;background-size: contain; border-radius: 8px">
                        </div>';
                    } else {
                            echo '
                            <div class="your-avt-img" style="background: transparent url(/comp1841/crud/user/uploads/' .  $img . ') 
                            center center no-repeat; height: 110px; width: 110px; padding: 1px;background-size: contain; border-radius: 8px">
                            </div>
                            ';
                        }
                        ?>
                        </div>
                    </div>
                    <?php
                $userInfoId = $_GET['userId'];
                if ($userInfoId == $_SESSION['user_id']) {
                    echo '
                    <a class="changeImage" href="/comp1841/crud/user/importImage.php">
                    <div class="user-intro-edit-img">
                        <div class="user-intro-edit-img-changeImage">
                            <i class="far fa-edit"></i>
                            Edit Your Avatar
                            </div>
                            </div>
                            </a>
                    ';
                }
                ?>

                </div>
                <div class="user-intro-detail">
                    <div class="user-intro-detail-name">
                        <?php
                    $result = $conn->query("SELECT * FROM `user` where id=$userInfoId");
                    $d = $result->fetch();
                    $userName = $d['name'];
                    $userEmail = $d['email'];
                    ?>
                    </div>
                    <div class="user-intro-detail-extra"><?php echo $userEmail ?></div>
                    <div class="chatBtn">
                        <?php if ($_SESSION['user_id'] != $userInfoId) { ?>
                        <a href='/comp1841/chat/chat.php?user=<?php echo $userInfoId; ?>'>
                            <button class="btnChat">
                                Chat with
                                <?php echo $userName; ?>
                            </button>
                        </a>
                        <?php } else { ?>
                        <button class="btnChat" onclick="openChat()">Chat
                        </button>
                        <?php } ?>
                    </div>

                </div>
            </div>
            <div class="user-details">
                <div class="user-details-left">
                    <?php
                $userInfoId = $_GET['userId'];
                if ($userInfoId == $_SESSION['user_id']) {
                    echo '
                        <div class="userSecure">
                            <i class="fas fa-shield-alt"></i>
                            <a href="/comp1841/crud/user/userSecure.php">Secure your
                            account</a>
                        </div>';
                    }
                ?>
                </div>
                <div class="user-details-right">
                    <div class="user-details-right-body">
                        <div class="user-details-right-child user-details-posts">
                            <h3>Posts</h3>
                            <div class="user-details-existed-content">
                                <?php
                            $sql = "select user.name,user.id,user.email,post.* from user, post
                            where user.id=post.user_id and user.id=$userInfoId;";
                            $result = $conn->query($sql);
                            $d = $result->fetchAll();

                            if ($d) {
                                foreach ($d as $row) {
                                    $title = $row['title'];
                                    $published_at = $row['published_at'];
                                    $post_id = $row['id'];
                                    echo
                                    "<div class='each-user-details-existed-content'>";
                                    echo "<a href='/comp1841/crud/home?postId=$post_id'><span>$title</span> - <span 
                                    class='published_at'>$published_at</span>
                        </a>
                        </div>";
                                }
                            } else {
                                echo '<div class="each-user-details-existed-content">No post available.</div>';
                            }
                            ?>
                            </div>
                        </div>
                        <div class="user-details-right-child user-details-answers">
                            <h3>Answers</h3>
                            <div class="user-details-existed-content">
                                <?php
                            $sql = "select user.name,user.id,user.email,answer.* from user, answer 
                            where user.id=answer.user_id and user.id=$userInfoId;";
                            $result = $conn->query($sql);
                            $d = $result->fetchAll();

                            if ($d) {
                                foreach ($d as $row) {
                                    $answer = $row['answer'];
                                    $published_at = $row['published_at'];
                                    $post_id = $row['post_id'];
                                    echo
                                    "
                        <div class='each-user-details-existed-content'><a href='/comp1841/crud/home?postId=$post_id'>
                        <span>$answer</span> - <span class='published_at'>$published_at</span></a></div>
                                ";
                                }
                            } else {
                                echo '<div class="each-user-details-existed-content">No answer available.</div>';
                            }
                            ?>
                            </div>
                        </div>
                        <div class="user-details-right-child user-details-modules">
                            <h3>Modules</h3>
                            <div class="each-user-details-existed-content disabled"><small>Developing...</small></div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="chatArea" style='display:none'>
                <?php include '/xampp/htdocs/comp1841/chat/homeChat.php'; ?>
            </div>
            <script>
            function openChat() {
                let areaText = document.getElementById('chatArea');
                let btnChat = document.getElementsByClassName('btnChat');
                if (areaText.style.display === "none") {
                    areaText.style.display = "block";
                }
            }
            </script>

        </div>
</body>

</html>