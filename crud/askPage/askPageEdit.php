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
        <form method='POST'>
            <div class='row'>
                <div class='content'>
                    <h4>Title</h4>
                    <label for="">Enter a title</label>
                    <input value='<?php echo $getTitle; ?>' name='title' class="form-control" />
                </div>
                <div class='content'>
                    <h4>What are the details of your problem</h4>
                    <label for="">Introduce the problem and expand on what you put in the title. Minimum 20
                        characters.</label>
                    <textarea name='details' rows="10" cols="50" style="resize: none;"><?php echo $getDetails; ?></textarea>
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
                    // echo $module_id;

                    $user_id = $_SESSION['user_id'];
                    try {
                        $sql = "update `post` set title='$title', details='$details' where id=$postId ";
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