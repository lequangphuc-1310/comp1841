<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>My account</title>
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
    <?php
    include '/xampp/htdocs/comp1841/auth/connection.php';

    $user_id = $_SESSION['id'];
    $sql = "select * from `user` where id = $user_id";
    $result = $conn->query($sql);
    $d = $result->fetch();
    $name = $d['name'];
    $password = $d['password'];
    $email = $d['email'];

    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $sql = "update `user` set id=$user_id, name='$name', password='$password', email='$email' where id=$user_id ";
        $result = $conn->query($sql);
        if ($result) {
            header('location: /comp1841/crud/home/home.php');
        }
    }

    ?>

    <div class="container ">
        <h1 class='title'>My Account</h1>

        <form method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Your name</label>
                    <input class="form-control" name='name' value=<?php echo "{$name}"; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Your password</label>
                    <input type='password' class="form-control" name='password' value=<?php echo $password; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Your email</label>
                    <input class="form-control" name='email' value=<?php echo $email; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' value='Update' name='submit' class="btn btn-blue" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>