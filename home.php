<?php
include 'connect.php';
// $postId = $_GET['postId'];
if (array_key_exists('postId', $_GET)) {
    $postId = $_GET['postId'];
    $sql = "select user.name, user.email, post.title,post.details,post.id,post.published_at from `user`, `post` where post.user_id=user.id and post.id=$postId;";
    $result = $conn->query($sql);
    $d = $result->fetch();
    $title = $d['title'];
    $name = $d['name'];
    $email = $d['email'];
    $details = $d['details'];
    $published = $d['published_at'];
} else {
    $sql = "select user.name, user.email, post.title,post.details,post.id,post.published_at from `user`,`post` where post.user_id=user.id ORDER BY id DESC LIMIT 1;";
    $result = $conn->query($sql);
    $d = $result->fetch();
    $title = $d['title'];
    $name = $d['name'];
    $email = $d['email'];
    $details = $d['details'];
    $published = $d['published_at'];
}
?>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="./home.css?v=<?php echo time(); ?>" />
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <div class="container">

        <div class="body">
            <div class="category">
                <div class="category-item"><a href='askPage.php'>Post a question to community</a></div>
                <div class="category-item">
                    <a href='userAccount.php'>View your account's information</a>
                </div>

                <?php
                // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
                if ($_SESSION['user_id'] != $_SESSION['admin_id']) {
                    echo "
                <div class='category-item'>Contact Administrator</div>
                ";
                }
                ?>


            </div>
            <div class="content">
                <div class="question">
                    <div class="question-title">
                        <div class='question-title-content'>

                            <div class='question-title-content-up'>
                                <?php
                                echo $title
                                ?>
                            </div>
                            <div class='question-title-content-down-name'>
                                <?php
                                echo $name;
                                ?>
                                <?php
                                echo $email
                                ?>
                            </div>
                        </div>
                        <div class="question-title-extra">
                            <div class="asked">
                                <?php
                                echo $published
                                ?>
                            </div>
                            <div class="modified">
                                Modified 3 years, 2 months ago
                            </div>
                            <div class="viewed">Viewed 149 times
                            </div>

                        </div>
                    </div>
                    <div class="question-content">
                        <?php
                        echo $details
                        ?>
                    </div>
                    <div class="answer">

                        The easiest way to get help with such problems is to help yourself, by learning how to use a
                        debugger to step through the code and see the values of variables at each step. Then you would
                        see the obvious problem here as pointed out above. –
                        underscore_d
                        Aug 5, 2020 at 9:43
                        @Yksisarvinen nombre = (nombre * 10) + chiffre;i changed it with this and still the same problem
                        –
                        user14052726
                        Aug 5, 2020 at 9:55
                        @aymanedu Well, is chiffre_prec or chiffre a non-zero value? Seems to me that they are also
                        equal to zero all the time. Debugger would have helped you - you can examine value of each and
                        every variable at any point of execution of your code. –
                        Yksisarvinen
                        Aug 5, 2020 at 9:59
                        @Yksisarvinen chiffre_prec's value is 1 for me though. in the 1 5 example. –
                        user14052726
                        Aug 5, 2020 at 10:11
                    </div>
                </div>
            </div>

        </div>



</body>
<script src="./home.js"></script>

</html>