<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet"> -->
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

    .btn-blue:hover {
        opacity: 0.8;
    }

    .title {
        text-align: center;
        margin-top: 20px;
    }

    .container {
        background-color: transparent;
        display: flex;
        justify-content: center;
    }

    .container-2 {
        max-width: 720px;
    }



    table {
        border-collapse: collapse;
        border-spacing: 0;
        border-radius: 3em;
        margin: 0 auto;
    }

    thead {
        background-color: #000;
        color: #fff;
        border: none;
    }

    thead th {
        padding: 1em 2em;

    }

    tbody {
        background-color: #fff;
        color: #555;
    }

    tr td {
        padding: 0.5em 0.8em;
        text-align: center;
    }

    .btn.btn-primary.my-3 {
        padding: 0.8em 0.5em;
        /* width: 200px; */
        background: #3151e8;
        /* text-align: center; */
        border-radius: 0.5em;
        color: #fff;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .btn.btn-primary.my-3:hover {
        opacity: 0.8;
    }

    .col-12 {
        width: 12em;
        margin: 1em 0;
    }

    button.btn.btn-edit {
        border-radius: 0.3em;
        border: none;
        color: #fff;
        background-color: #8455bd;
        padding: 0.5em 0.8em;
        cursor: pointer;
    }

    button.btn.btn-edit:hover {
        background-color: red;
        color: #fff;
    }

    button.btn.btn-delete {
        border-radius: 0.3em;
        border: none;
        background: #ffb723;
        color: #fff;
        padding: 0.5em 0.8em;
        cursor: pointer;
        margin-left: 1em;
    }

    button.btn.btn-delete:hover {
        background-color: red;
    }

    button.btn.btn-edit i {
        color: #fff;
    }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";
    include "/xampp/htdocs/comp1841/toast/toast.php";
    if (array_key_exists('success', $_GET)) {
        $addModuleSuccess = 'Successfully added new module!';
    ?>
    <script>
    showSuccess('<?php echo $addModuleSuccess; ?>')
    </script>
    <?php }
    ?>
    <div class="container">
        <div class="container-2">
            <h1 class='title'>Display Modules</h1>

            <?php
            if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
            ?>

            <div class="col-12">
                <a href='/comp1841/admin/addModule.php'>
                    <div class="btn btn-primary my-3">Create
                        new
                        module</div>
                </a>
            </div>
            <?php
            }
            ?>



            <table>
                <thead>
                    <tr>
                        <th>Module ID</th>
                        <th>Module Name</th>
                        <?php
                        if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                            echo '
            <th>Operations</th>                        
                ';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("select id, module_name, module_id from `module`");
                    $d = $data->fetchAll();

                    if ($d) {
                        foreach ($d as $row) {
                            $id = $row['id'];
                            $module_name = $row['module_name'];
                            $module_id = $row['module_id'];
                            if ($_SESSION['user_id'] == $_SESSION['admin_id']) { ?>
                    <tr class='w3-hover-green'>
                        <td><?php echo $module_name; ?></td>
                        <td><?php echo $module_id; ?></td>
                        <td>
                            <button class='btn btn-edit'><a class='text-light text-decoration-none'
                                    href='/comp1841/crud/edit.php?updateModuleId=<?php echo $id; ?>'><i
                                        class="far fa-edit"></i></a></button>
                            <button class='btn btn-delete'><a class='text-light text-decoration-none'
                                    href='/comp1841/crud/delete.php?deleteModuleId=<?php echo $id; ?>'><i
                                        class="fas fa-trash"></i></a></button>
                        </td>
                    </tr>
                    <?php

                            } else {  ?>
                    <tr class='w3-hover-green'>
                        <td><?php echo $module_name; ?></td>
                        <td><?php echo $module_id; ?></td>
                    </tr>
                    <?php }
                        }
                    } else {
                        ?>
                    <tr>
                        No Module available. Please try again or create new module.
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>

    </div>
</body>

</html>