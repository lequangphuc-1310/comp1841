<?php
include 'connect.php';
// $submit = $_POST["submit"];
if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    // $mobile = $_POST["mobile"];

    $sql = "INSERT INTO `crud` (`name`, `password`, `email`)
    values ('$name', '$password', '$email')";
    $result = $conn->query($sql);
    if ($result) {
        header('location: display.php');
    } else {
        die(mysqli_error($con));
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="./askPage.css" />
    <title>Add New User</title>
</head>

<body>
    <style type="text/css">
    /* .container {
            margin: 20px auto;
        } */

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
    include "nav.php"
    ?>
    <div class="ask-page-container ">

        <h1 class='title'>Ask a Question</h1>
        <form action="user.php" method='POST'>
            <div class='row'>
                <div class='form-group col-8 label content'>
                    <h4>Title</h4>
                    <label for="">Enter name</label>
                    <input class="form-control" name='name' />
                </div>
                <div class='form-group col-8 label content'>
                    <h4>What are the details of your problem</h4>
                    <label for="">Introduce the problem and expand on what you put in the title. Minimum 20
                        characters.</label>
                    <textarea rows="10" cols="50" style="resize: none;"></textarea>
                </div>
                <div class='form-group col-8 label content'>
                    <h4>Review questions already on Stack Overflow to see if your question is a duplicate.</h4>
                    <label for="">Clicking on these questions will open them in a new tab for you to review. Your
                        progress here will be saved so you can come back and continue.</label>
                    <textarea rows="10" cols="50" style="resize: none;"></textarea>
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' name='submit' class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>