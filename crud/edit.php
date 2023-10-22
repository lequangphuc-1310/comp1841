<?php
include '/xampp/htdocs/comp1841/auth/connection.php';


if (isset($_GET['updateUserId'])) {
    $id = $_GET['updateUserId'];
    $sql = "select * from `user` where id = $id";
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
        $sql = "update `user` set id=$id, name='$name', password='$password', email='$email' where id=$id ";
        $result = $conn->query($sql);
        if ($result) {
            echo 'update scuees';
            header('location: /comp1841/admin/display.php');
        }
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
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";
    ?>
    <h1 class='title'>CRUD EDIT USER</h1>

    <div class="container ">
        <form method='POST'>

            <?php
            if (isset($_GET['updateModuleId'])) {
                $moduleId = $_GET['updateModuleId'];


                $sql = "select * from `module` where id = $moduleId";
                $result = $conn->query($sql);
                $d = $result->fetch();
                $module_name = $d['module_name'];
                $module_id = $d['module_id'];

                echo
                "
                <div class='row'>
                    <div class='form-group col-12 label'>
                        <label >Enter Module's name</label>
                        <textarea class='form-control' name='nameModule'> $module_name </textarea>
                    </div>
                    <div class='form-group col-12 label'>
                        <label>Enter module's id</label>
                        <input class='form-control' name='idModule' value=" . $module_id . " />
                    </div>
                    <div class='form-group col-12 label'>
                        <input type='submit' value='update' name='submit' class='btn btn-primary' />
                    </div>
                </div>
                ";
            } else {
                echo "
                    <div class='row'>
                        <div class='form-group col-12 label'>
                            <label >Enter name</label>
                            <input class='form-control' name='name' value=" . $name . " />
                        </div>
                        <div class='form-group col-12 label'>
                            <label>Enter password</label>
                            <input type='password' class='form-control' name='password' value=" . $password . " />
                        </div>
                        <div class='form-group col-12 label'>
                            <label>Enter email</label>
                            <input class='form-control' name='email' value=" . $email . " />
                        </div>
                        <div class='form-group col-12 label'>
                            <input type='submit' value='update' name='submit' class='btn btn-primary' />
                        </div>
                    </div>
                    ";
            }
            ?>
            <?php
            if (isset($_GET['updateModuleId'])) {
                if (isset($_POST['submit'])) {
                    $module_name = $_POST['nameModule'];
                    $module_id = $_POST['idModule'];
                    $sql = "update `module` set id=$moduleId, module_name='$module_name', module_id='$module_id' where id=$moduleId";
                    $result = $conn->query($sql);
                    echo $moduleId, $module_name, $module_id;

                    if ($result) {
                        header('location: /comp1841/crud/module/modules.php');
                    }
                }
            }
            ?>

        </form>
    </div>

</body>

</html>