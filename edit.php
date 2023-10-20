<?php
include 'connect.php';
$id = $_GET['updateid'];
$sql = "select * from `crud` where id = $id";
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
    $sql = "update `crud` set id=$id, name='$name', password='$password', email='$email' where id=$id ";
    $result = $conn->query($sql);
    if ($result) {
        echo 'update scuees';
        header('location: display.php');
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Edit User</title>
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
    <h1 class='title'>CRUD EDIT USER</h1>

    <div class="container ">
        <form method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Enter name</label>
                    <input class="form-control" name='name' value=<?php echo "{$name}"; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter password</label>
                    <input type='password' class="form-control" name='password' value=<?php echo $password; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter email</label>
                    <input class="form-control" name='email' value=<?php echo $email; ?> />
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' value='update' name='submit' class="btn btn-primary" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>