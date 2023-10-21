<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./askPage.css" />
    <title>Contact Admin</title>
</head>

<body>
    <style type="text/css">
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
    include "nav.php";
    ?>
    <div class="ask-page-container ">
        <h1 class='title'>Ask a Question to Admin</h1>
        <form action="contactAdmin.php" method='POST'>
            <div class='row'>
                <div class='form-group col-8 label content'>
                    <h4>Write anything you would like to ask to Admin</h4>
                    <textarea name='user_send' rows="10" cols="50" style="resize: none;"></textarea>
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' name='submitPost' value='Submit' class="btn btn-primary" />
                </div>
                <?php
                include 'connect.php';

                if (isset($_POST["submitPost"])) {
                    $user_send = ($_POST["user_send"]);
                    $user_id = $_SESSION['id'];
                    try {
                        $sql = "INSERT INTO `admin_user` (`user_send`, `user_id`)
                        values ('$user_send', '$user_id')";
                        $result = $conn->exec($sql);
                        if ($result) {
                            header('location: home.php');
                            // echo 'success ask admin';
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