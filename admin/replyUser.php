<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/askPage/askPage.css" />
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" />
    <title>Reply to User</title>
</head>

<body>
    <style type="text/css">
    input {
        border: 1px solid black !important;
    }

    .btn-blue {
        background-color: #381DDB !important;
        border-radius: 8px;
        padding: 10px 14px;
        color: #fff;
        cursor: pointer;
    }

    .btn-blue:hover {
        background-color: #FC5252;
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
        <h1 class='title'>Reply User</h1>
        <form method='POST'>
            <div class='row'>
                <div class='form-group col-8 label content'>
                    <h4>Write something to reply the user</h4>
                    <textarea name='admin_send' rows="10" cols="50" style="resize: none;"></textarea>
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' name='submitPost' value='Submit' class="btn btn-blue" />
                </div>
                <?php
                include '/xampp/htdocs/comp1841/auth/connection.php';


                if (isset($_POST["submitPost"])) {
                    $input_admin_send = ($_POST["admin_send"]);
                    $admin_send = mysql_escape_mimic($input_admin_send);
                    $updateId = $_GET['updateid'];
                    $user_id = $_SESSION['user_id'];
                    try {
                        $sql = "update `admin_user` set `admin_send`='$admin_send' where id=$updateId";
                        $result = $conn->exec($sql);
                        if ($result) {
                            echo "<script>window.location.href='/comp1841/admin/contactUser.php';</script>";
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