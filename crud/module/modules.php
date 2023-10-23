<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Display Modules</title>

</head>

<body id='module'>
    <style>
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
    <div class="container">

        <h1 class='title'>Display Modules</h1>

        <?php
        // echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>';
        if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
            echo "
                <div>
                    <button class='btn btn-blue my-5'>
                        <a class='text-light text-decoration-none' href='/comp1841/admin/addModule.php'>
                            Add
                            Modules
                        </a>
                    </button>
                </div>
                ";
        }
        ?>



        <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>No.</th>
                    <th>Name</th>
                    <th>Module's id</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <?php
            $data = $conn->query("select id, module_name, module_id from `module`");
            $d = $data->fetchAll();

            if ($d) {
                foreach ($d as $row) {
                    $id = $row['id'];
                    $module_name = $row['module_name'];
                    $module_id = $row['module_id'];
                    echo
                    "
                    <tr class='w3-hover-green'>
                        <td>$id</td>
                        <td>$module_name</td>
                        <td>$module_id</td>
                        <td>
                            <button class='btn btn-danger'><a class='text-light text-decoration-none' href='/comp1841/crud/edit.php?updateModuleId=" . $id . "'>Edit</a></button>
                            <button class='btn btn-warning'><a class='text-light text-decoration-none' href='/comp1841/crud/delete.php?deleteModuleId=" . $id . "'>Delete</a></button>
                        </td>
                    </tr> ";
                }
            }
            ?>
        </table>
    </div>
</body>

</html>