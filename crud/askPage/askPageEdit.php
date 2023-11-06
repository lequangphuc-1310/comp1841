<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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
    if ($_GET['postId']) {
        $postId = $_GET['postId'];
        $result = $conn->query("SELECT * FROM `post` where id=$postId");
        $data = $result->fetch();
        $getTitle = $data['title'];
        $getDetails = $data['details'];
    }
    ?>
    <div class="ask-page-container ">
        <h1 class='title'>Edit Your Post</h1>
        <form method='POST' enctype="multipart/form-data">
            <div class='row'>
                <div class='content'>
                    <h4>Title</h4>
                    <label for="title">Enter a title</label>
                    <input value='<?php echo $getTitle; ?>' id='title' name='title' class="form-control" />
                </div>
                <div class='content'>
                    <h4>What are the details of your problem</h4>
                    <label for="details">Introduce the problem and expand on what you put in the title. Minimum 20
                        characters.</label>
                    <textarea name='details' id='details' rows="10" cols="50"
                        style="resize: none;"><?php echo $getDetails; ?></textarea>
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
                        echo '<option value="' . htmlspecialchars($module_id_PK) . '">' . htmlspecialchars($module_id) . '-' . htmlspecialchars($module_name) . '</option>';
                    }
                    echo "</select>";
                    ?>
                </div>
                <div class='content'>
                    <h4>Image (Optional)</h4>
                    <input type='file' name='imagePost' class="form-control" />
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
                    if (isset($_FILES['imagePost'])) {
                        $img_name = $_FILES['imagePost']['name'];
                        $img_size = $_FILES['imagePost']['size'];
                        $tmp_name = $_FILES['imagePost']['tmp_name'];
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
                    $userId = $_SESSION['user_id'];

                    $user_id = $_SESSION['user_id'];
                    try {
                        $sql = "update `post` set title='$title', details='$details', imagePost='$new_img_name' where id=$postId ";
                        $result = $conn->query($sql);
                        echo "<script>window.location.href='/comp1841/crud/home/home.php?postId=$postId';</script>";
                        //     }

                        echo $title, $details, $postId;
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