<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" />
    <title>Display Users</title>
    <link rel="stylesheet" href="./home.css">

</head>

<body>
    <style>
    .title {
        text-align: center;
        margin-top: 20px;
    }

    .container {
        background-color: transparent;
        position: relative;
        margin: 0 auto;
        max-width: 800px;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        border-radius: 3em;
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
        width: 6em;
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

    button.btn.btn-edit a {
        color: #fff;
    }

    button.btn.btn-delete:hover {
        background-color: red;
    }

    button.btn.btn-edit a,
    button.btn.btn-delete:hover a {
        color: #fff;
    }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="container">

        <h1 class='title'>Notifications</h1>

        <table>
            <thead>
                <tr>
                    <th>Your message to admin</th>
                    <th>Admin's respond</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $userId = $_SESSION['user_id'];
                $data = $conn->query("select * from `admin_user` where user_id=$userId");
                $d = $data->fetchAll();

                if ($d) {
                    foreach ($d as $row) {
                        $id = $row['id'];
                        $user_id = $row['user_id'];
                        $user_send = $row['user_send'];
                        $admin_send = $row['admin_send'];
                ?>
                <tr class='w3-hover-green'>
                    <td><?php echo $user_send; ?></td>
                    <td><?php echo $admin_send; ?></td>

                </tr>
                <?php
                    }
                } else {
                    ?>
                <tr>
                    <td colspan="2">No data...</td>

                </tr>
                <?php
                }
                ?>
        </table>
    </div>
</body>

</html>