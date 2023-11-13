<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/askPage/askPage.css?v=<?php echo time(); ?>" />
    <title>Edit your Post</title>
</head>

<body>
    <style type="text/css">
    .btn-blue {
        background-color: #381DDB !important;
        border-radius: 8px;
        padding: 10px 14px;
        color: #fff;
        cursor: pointer;
    }

    .btn-blue:hover {
        opacity: 0.8;
    }

    input {
        border: 1px solid black !important;
    }

    .label {
        margin: 10px 0 10px 0;
    }

    .title {
        text-align: center;
        margin-top: 20px;
    }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";
    if ($_GET['answerId']) {
        $answerId = $_GET['answerId'];
        $result = $conn->query("SELECT * FROM `answer` where id=$answerId");
        $data = $result->fetch();
        $getAnswer = $data['answer'];
    }
    ?>
    <div class="ask-page-container ">
        <h1 class='title'>Edit Your Answer</h1>
        <form method='POST'>
            <div class='row'>
                <div class='content'>
                    <h4>Edit your answer</h4>
                    <textarea name='answer' rows="10" cols="50"
                        style="resize: none;"><?php echo $getAnswer; ?></textarea>
                </div>


                <div class='form-group col-12 label'>
                    <input type='submit' name='submitPost' value='Submit' class="btn btn-blue" />
                </div>
                <?php
                include '/xampp/htdocs/comp1841/auth/connection.php';


                if (isset($_POST["submitPost"])) {
                    $newAnswer =  $_POST["answer"];
                    $answer = mysql_escape_mimic($newAnswer);
                    $userId = $_SESSION['user_id'];

                    try {
                        $sql = "update `answer` set answer='$answer' where id=$answerId";
                        $result = $conn->query($sql);
                        echo "<script>window.location.href='/comp1841/crud/home/home.php?postId=" . $_SESSION['post_id'] . "';</script>";
                        unset($_SESSION['post_id']);
                        //     }

                        echo $answer;
                    } catch (PDOException $e) {
                        die("Error: " . $e->getMessage());
                    }
                }
                ?>

            </div>
        </form>
    </div>

</body>

</html>