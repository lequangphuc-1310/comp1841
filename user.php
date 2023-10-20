<?php
include 'connect.php';

if (isset($_POST["submit"])) {
    $name = $_POST["name"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    try {
        $sql = "INSERT INTO `crud` (`name`, `password`, `email`)
    values ('$name', '$password', '$email')";
        $result = $conn->query($sql);
        if ($result) {
            header('location: display.php');
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <h1 class='title'>CRUD ADD NEW USER</h1>
    <div class="container ">
        <form action="user.php" method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Enter name</label>
                    <input class="form-control" name='name' />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter password</label>
                    <input type='password' class="form-control" name='password' />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter email</label>
                    <input class="form-control" name='email' />
                </div>
                <!-- <div class='form-group col-12 label'>
                    <label for="">Enter mobile</label>
                    <input class="form-control" name='mobile' />
                </div> -->
                <div class='form-group col-12 label'>
                    <input type='submit' name='submit' class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>