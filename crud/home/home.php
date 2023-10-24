<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
// $postId = $_GET['postId'];
if (array_key_exists('postId', $_GET)) {
    $postId = $_GET['postId'];
    $sql = "select user.image, user.name, user.email, post.title,post.details,post.id,post.published_at,post.module from `user`, `post` where post.user_id=user.id and post.id=$postId;";
    $result = $conn->query($sql);
    $d = $result->fetch();
    $title = $d['title'];
    $askerImage = $d['image'];
    $name = $d['name'];
    $email = $d['email'];
    $details = $d['details'];
    $published = $d['published_at'];
    $moduleId = $d['module'];
    $sqlGetModule = ("select * from `module` where id=$moduleId");
    $resultGetModule = $conn->query($sqlGetModule);
    $dataResultGetModule = $resultGetModule->fetch();
    $module_name = $dataResultGetModule['module_name'];
    $module_id = $dataResultGetModule['module_id'];
} else {
    $sql = "select user.image, user.name, user.email, post.title,post.details,post.id,post.published_at,post.module from `user`,`post`
where post.user_id=user.id ORDER BY id DESC LIMIT 1;";
    $result = $conn->query($sql);
    $d = $result->fetch();
    $postId = $d['id'];
    $title = $d['title'];
    $askerImage = $d['image'];
    $name = $d['name'];
    $email = $d['email'];
    $details = $d['details'];
    $published = $d['published_at'];
    $moduleId = $d['module'];
    $sqlGetModule = ("select * from `module` where id=$moduleId");
    $resultGetModule = $conn->query($sqlGetModule);
    $dataResultGetModule = $resultGetModule->fetch();
    $module_name = $dataResultGetModule['module_name'];
    $module_id = $dataResultGetModule['module_id'];
}
?>

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
    <div class="container">

        <div class="body">

            <div class="content">
                <div class="question">
                    <div class="question-title">
                        <div class='question-title-content'>
                            <div class="akser-avt">
                                <div class="nav-user-avt-img"
                                    style='background: transparent url("/comp1841/crud/user/uploads/<?php echo $askerImage; ?>") center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain'>
                                </div>
                            </div>
                            <div>
                                <div class='question-title-content-up'>
                                    <?php
                                    echo $title
                                    ?>
                                </div>
                                <div class='question-title-content-down-name'>
                                    <?php
                                    echo $name;
                                    ?><span> - </span>
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
                            <div class="question-title-extra-child viewed">
                                Viewed 149 times
                            </div>

                        </div>
                    </div>
                    <div class="question-content">
                        <?php
                        echo $details
                        ?>
                    </div>
                    <div class="existed-answer">
                        <?php
                        $sqlExistedAnswer = "select user.image, user.name, user.email,answer.* from `user`, `answer` where answer.user_id=user.id and post_id=$postId;";
                        $resultExistedAnswer = $conn->query($sqlExistedAnswer);
                        $datasqlExistedAnswer = $resultExistedAnswer->fetchAll();
                        foreach ($datasqlExistedAnswer as $row) {
                            $answerAuthorImage = $row['image'];
                            $answerAuthorName = $row['name'];
                            $answerAuthorEmail = $row['email'];
                            $existedAnswer = $row['answer'];
                            $answerAuthorPublished = $row['published_at'];
                            echo '<div class="each-existed-answer">' . '
                            <div class="answer-avt">
                                <div class="answer-avt-img" style="background: transparent url(/comp1841/crud/user/uploads/' . $answerAuthorImage . ')
                        center center no-repeat; height: 30px; width: 30px; padding: 3px;background-size: contain">
                    </div>
                </div>
                <div class="answer-text"><span class="answerAuthorName">' . $answerAuthorName . '</span> &nbsp;-&nbsp; <span
                        class="existedAnswer">' . $existedAnswer . '</span>&nbsp;-&nbsp;<span
                        class="answerAuthorEmail">' . $answerAuthorEmail . '</span>&nbsp;-&nbsp; <span
                        class="answerAuthorPublished">' . $answerAuthorPublished . '</span></div>
            </div>';
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
                                $user_id = $_SESSION['id'];

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
                            <textarea class='textArea' name='answer' rows="10" cols="100"
                                style="resize: none;"></textarea>
                            <div class="submit-answer">
                                <input placholder='Type something...' class="btn-submit" value='Submit Answer'
                                    type='submit' name='submitAnswer' />
                            </div>



                        </div>
                    </form>
                </div>

            </div>



</body>
<script src="./home.js"></script>

</html>