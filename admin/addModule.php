<?php
include '/xampp/htdocs/comp1841/auth/connection.php';

if (isset($_POST["submit"])) {
    $module_name = $_POST["module_name"];
    $module_id = $_POST["module_id"];
    try {
        $sql = "INSERT INTO `module` (`module_name`, `module_id`) values ('$module_name', '$module_id')";
        $result = $conn->exec($sql);
        if ($result) {
            header('location: /comp1841/crud/module/modules.php');
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
    <title>Add New Module</title>
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

        .btn-blue {
            background-color: #381DDB !important;
            border-radius: 8px;
            padding: 10px 14px;
            color: #fff;
            cursor: pointer;
        }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <h1 class='title'>CRUD ADD NEW MODULE</h1>
    <div class="container ">
        <form action="addModule.php" method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's name</label>
                    <textarea row='1' col='50' class="form-control" name='module_name'> </textarea>
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's id</label>
                    <input type='module_id' class="form-control" name='module_id' />
                </div>
                <div class='form-group col-12 label'>
                    <input type='submit' name='submit' class="btn-blue" />
                </div>
            </div>
        </form>
    </div>

</body>

</html>