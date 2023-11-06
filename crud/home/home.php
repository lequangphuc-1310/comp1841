<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Home</title>
<link rel="stylesheet" type="text/css" href="./home.css?v=<?php echo time(); ?>" />
</head>

<body>
    <style>
    .btn-blue {
        background-color: #381DDB !important;
        border-radius: 8px;
        padding: 10px 14px;
        color: #fff;
        cursor: pointer;
    }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";
    ?>
    <?php
    // $postId = $_GET['postId'];
    if (array_key_exists('postId', $_GET)) {
        $postId = $_GET['postId'];
        $sql = "select user.image, user.name, user.email, post.title,post.details,post.id,post.published_at,post.module, post.imagePost from `user`, `post` where post.user_id=user.id and post.id=$postId;";
        $result = $conn->query($sql);
        $d = $result->fetch();
        $title = $d['title'];
        $askerImage = $d['image'];
        $resultGetAskerUserId = $conn->query("SELECT u.id from `user` as u inner join  `post` as p on p.user_id = u.id where p.user_id=u.id and p.id=$postId limit 1;");
        $dataResultGetAskterUserId = $resultGetAskerUserId->fetch();
        $askerUserId = $dataResultGetAskterUserId['id'];
        $name = $d['name'];
        $email = $d['email'];
        $details = $d['details'];
        $published = $d['published_at'];
        $imagePost = $d['imagePost'];
        $moduleId = $d['module'];
        $sqlGetModule = ("select * from `module` where id=$moduleId");
        $resultGetModule = $conn->query($sqlGetModule);
        $dataResultGetModule = $resultGetModule->fetch();
        $module_name = $dataResultGetModule['module_name'];
        $module_id = $dataResultGetModule['module_id'];
        $userId = $_SESSION['user_id'];
        if (!$askerImage) {
            $askerImage = 'IMG-653751dd87d0c4.57015077.png';
        }
    } else {
        $sql = "select user.image, user.name, user.email, post.title,post.details,post.id,post.published_at,post.module, post.imagePost from `user`,`post`
where post.user_id=user.id ORDER BY id DESC LIMIT 1;";
        $result = $conn->query($sql);
        $d = $result->fetch();
        $postId = $d['id'];
        $title = $d['title'];
        $askerImage = $d['image'];
        $resultGetAskerUserId = $conn->query("SELECT u.id from `user` as u inner join  `post` as p on p.user_id = u.id where p.user_id=u.id and p.id=$postId limit 1;");
        $dataResultGetAskterUserId = $resultGetAskerUserId->fetch();
        $askerUserId = $dataResultGetAskterUserId['id'];
        $name = $d['name'];
        $email = $d['email'];
        $details = $d['details'];
        $published = $d['published_at'];
        $imagePost = $d['imagePost'];
        $moduleId = $d['module'];
        $sqlGetModule = ("select * from `module` where id=$moduleId");
        $resultGetModule = $conn->query($sqlGetModule);
        $dataResultGetModule = $resultGetModule->fetch();
        $module_name = $dataResultGetModule['module_name'];
        $module_id = $dataResultGetModule['module_id'];
        $userId = $_SESSION['user_id'];

        if (!$askerImage) {
            $askerImage = 'IMG-653751dd87d0c4.57015077.png';
        }
    }
    ?>
    <div class="container">
        <div class="body">
            <div class="content">
                <div class="question">
                    <div class="question-title">
                        <div class='question-title-content'>
                            <div class="akser-avt"><a
                                    href='/comp1841/crud/user/userInfo.php?userId=<?php echo $askerUserId; ?>'>
                                    <div class="nav-user-avt-img" style="background: url(/comp1841/crud/user/uploads/<?php echo $askerImage; ?>)
                    center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain">
                                    </div>
                                </a>
                            </div>
                            <div>
                                <div class='question-title-content-up'>
                                    <?php
                                    echo $title
                                    ?>
                                </div>
                                <div class='question-title-content-down-name'><a
                                        href='/comp1841/crud/user/userInfo.php?userId=<?php echo $askerUserId; ?>'>
                                        <?php
                                        echo $name;
                                        ?></a><span> - </span>
                                    <?php
                                    echo $email
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="question-title-extra">
                            <div class="question-title-extra-child asked">
                                <?php
                                echo $published
                                ?>
                            </div>
                            <div class="question-title-extra-child module">
                                <?php
                                echo $module_id . ' - ' .  $module_name;
                                ?>
                            </div>
                            <!-- <div class="question-title-extra-child viewed">
                                Viewed 149 times
                            </div> -->
                            <?php
                            if ($_SESSION['user_id'] == $askerUserId) { ?>

                            <div class="question-title-extra-child edit-delete">
                                <button class='edit-post'><a
                                        href="/comp1841/crud/askPage/askPageEdit.php?postId=<?php echo $postId; ?>"><i
                                            class="far fa-edit"></i></a></button>
                            </div>
                            <div class="question-title-extra-child edit-delete">
                                <button class='delete-post'><a
                                        href="/comp1841/crud/delete.php?postId=<?php echo $postId; ?>"><i
                                            class="fas fa-trash"></i></a></button>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="question-content">
                        <div class='question-content-text'>
                            <?php
                            echo $details
                            ?>
                        </div>

                        <?php if ($imagePost) { ?>
                        <hr>
                        <div class="question-content-img">
                            <div class='question-content-img-content'
                                style="background: url(/comp1841/crud/askPage/uploads/<?php echo $imagePost; ?>) center center no-repeat; background-size: contain">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                    <div class="existed-answer">
                        <?php
                        $sqlExistedAnswer = "select user.image, user.name, user.email,answer.* from `user`, `answer` where answer.user_id=user.id and post_id=$postId;";
                        $resultExistedAnswer = $conn->query($sqlExistedAnswer);
                        $datasqlExistedAnswer = $resultExistedAnswer->fetchAll();
                        foreach ($datasqlExistedAnswer as $row) {
                            $answerAuthorImage = $row['image'];
                            $answerAuthorName = $row['name'];
                            $answerAuthorId = $row['id'];
                            $answerAuthorEmail = $row['email'];
                            $existedAnswer = $row['answer'];
                            $answerAuthorPublished = $row['published_at'];
                            $resultGetAnswererId = $conn->query("SELECT u.id from `user` as u inner join  `answer` as a on a.user_id = u.id where a.user_id=u.id and a.id=$answerAuthorId limit 1;");
                            $dataResultGetAnswererId = $resultGetAnswererId->fetch();
                            $answererId = $dataResultGetAnswererId['id'];
                            if (!$answerAuthorImage) {
                                $answerAuthorImage = 'IMG-653751dd87d0c4.57015077.png';
                            }

                        ?>
                        <div class="each-existed-answer">
                            <div class="answer-avt">
                                <a href="/comp1841/crud/user/userInfo.php?userId=<?php echo $answererId; ?>">
                                    <div class="nav-user-avt-img"
                                        style="background: url(/comp1841/crud/user/uploads/<?php echo $answerAuthorImage; ?>)
                                            center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain">
                                    </div>
                                </a>
                            </div>
                            <div class="answer-text"><span class="answerAuthorName"><a
                                        href="/comp1841/crud/user/userInfo.php?userId=<?php echo $answererId; ?>">
                                        <?php echo $answerAuthorName; ?></a></span> &nbsp;-&nbsp;
                                <span class="existedAnswer"><?php echo $existedAnswer; ?></span>&nbsp;-&nbsp;<span
                                    class="answerAuthorEmail"><?php echo $answerAuthorEmail; ?></span>&nbsp;-&nbsp;
                                <span class="answerAuthorPublished"><?php echo $answerAuthorPublished; ?></span>
                                <?php
                                    if ($_SESSION['user_id'] == $answererId) { ?>
                                <span class="answerAuthorEditDelete">
                                    <button><a
                                            href="/comp1841/crud/home/answerEdit.php?answerId=<?php echo $answerAuthorId; ?>"><i
                                                class="far fa-edit"></i></button>
                                    <button><a
                                            href="/comp1841/crud/delete.php?answerId=<?php echo $answerAuthorId; ?>"><i
                                                class="fas fa-trash"></i></a></button>
                                </span>
                                <?php } ?>
                            </div>
                        </div>
                        <?php
                        }
                        ?>

                    </div>
                    <form method="POST">
                        <div class="your-answer">
                            <h4>Your answer</h4>
                            <?php
                            if (isset($_POST['submitAnswer'])) {
                                $inputAnswer =  $_POST["answer"];
                                $answer = mysql_escape_mimic($inputAnswer);
                                $user_id = $_SESSION['user_id'];

                                try {
                                    $check_duplicated = "select * from `answer` where user_id=$user_id and answer='$answer'";
                                    $answerDisplay = $conn->query($check_duplicated);
                                    $countRow = $answerDisplay->fetchColumn();

                                    if ($countRow == 0) {
                                        $sql = "INSERT INTO `answer` (`user_id`, `post_id`, `answer`, `module`)
                                            values ($user_id, $postId, '$answer', $moduleId)";
                                        $result = $conn->query($sql);
                                        if ($result) {
                                            echo "<script>location.reload();</script>";
                                        }
                                    }
                                } catch (PDOException $e) {
                                    die("Error: " . $e->getMessage());
                                }
                            }
                            ?>
                            <textarea placeholder='Type something...' class='textArea' name='answer' rows="10"
                                cols="100" style="resize: none;"></textarea>
                            <div class="submit-answer">
                                <input class="btn-submit" value='Submit Answer' type='submit' name='submitAnswer' />
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>

    <script type='text/javascript'>
    document.querySelector('.question-content-img').addEventListener('click', function() {
        document.querySelector('.question-content-img-content').classList.toggle('large')
    })
    </script>

</body>

</html>