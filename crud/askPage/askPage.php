<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/askPage/askPage.css?v=<?php echo time(); ?>" />
    <title>Add New Post</title>
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

    ?>
    <div class="ask-page-container ">
        <h1 class='title'>Ask a Question</h1>
        <form action="askPage.php" method='POST' enctype="multipart/form-data">
            <div class='row'>
                <div class='content'>
                    <h4>Title</h4>
                    <label for="title">Enter a title</label>
                    <input name='title' id='title' class="form-control" name='name' />
                </div>
                <div class='content'>
                    <h4>What are the details of your problem</h4>
                    <label for='details'>Introduce the problem and expand on what you put in the title. Minimum 20
                        characters.</label>
                    <textarea name='details' id='details' rows="10" cols="50" style="resize: none;"></textarea>
                </div>

                <div class='form-group col-8 content'>
                    <h4>Select Module</h4>
                    <?php


                    $result = $conn->query("select id, module_id, module_name from `module`");
                    $d = $result->fetchAll();


                    echo "<html>";
                    echo "<body>";
                    echo "<select name='module_id'>";

                    foreach ($d as $row) {
                        $module_id = $row['module_id'];
                        $module_name = $row['module_name'];
                        $module_id_PK = $row['id'];
                        echo '<option value="' . htmlspecialchars($module_id_PK) . '">' . htmlspecialchars($module_id) . ' -' . htmlspecialchars($module_name) . '</option>';
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class='content'>
                    <h4>Image (Optional)</h4>
                    <input type="file" name="inputImage">
                </div>

                <div class='form-group col-12 label'>
                    <input type='submit' name='submitPost' value='Submit' class="btn btn-blue" />
                </div>
                <?php
                include '/xampp/htdocs/comp1841/auth/connection.php';

                if (isset($_POST["submitPost"])) {
                    $inputTitle =  $_POST["title"];
                    $title = mysql_escape_mimic($inputTitle);
                    $inputDetails = $_POST["details"];
                    $details = mysql_escape_mimic($inputDetails);
                    $module_id = $_POST['module_id'];
                    $userId = $_SESSION['user_id'];
                    $user_id = $_SESSION['user_id'];
                    $img_name = '';
                    if (isset($_FILES['inputImage'])) {
                        $img_name = $_FILES['inputImage']['name'];
                        $img_size = $_FILES['inputImage']['size'];
                        $tmp_name = $_FILES['inputImage']['tmp_name'];
                        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
                        $img_ex_lc = strtolower($img_ex);

                        $allowed_exs = array("jpg", "jpeg", "png");

                        if (in_array($img_ex_lc, $allowed_exs)) {
                            $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                            $img_upload_path = 'uploads/' . $new_img_name;
                            move_uploaded_file($tmp_name, $img_upload_path);
                            $id = $_SESSION['user_id'];
                            if (move_uploaded_file($tmp_name, $img_upload_path)) {
                                echo "<script>alert('moved')</script>";
                            }
                        }
                    }

                    try {

                        $sql = "INSERT INTO `post` (`title`, `details`, `user_id`, `module`, `imagePost`)
                        values ('$title', '$details', '$user_id', '$module_id', '$new_img_name')";
                        $result = $conn->exec($sql);

                        $sql2 = "SELECT p.id, p.user_id from `post` as p inner join  `user` as u on p.user_id = u.id where p.user_id=u.id and u.id=$userId order by p.id desc limit 1 ;";
                        $result2 = $conn->query($sql2);
                        $d = $result2->fetch();
                        $latestPostId = $d['id'];
                        if ($result) {
                            if ($result2) {
                                echo "<script>window.location.href='/comp1841/crud/home/home.php?postId=$latestPostId';</script>";
                            }
                        }
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