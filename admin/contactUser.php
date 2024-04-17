<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Request</title>

</head>

<body>
    <style>
    .background {
        display: flex;
        justify-content: center;
        align-items: center;
    }

    body {
        background: linear-gradient(-45deg, rgb(152 169 178),
                rgb(101 150 202), rgb(142 138 232), transparent);
        height: 100%
    }

    .title {
        text-align: center;
        margin-top: 20px;
    }

    .container {
        background-color: transparent;
        position: relative;
        margin: 0 auto;
        max-width: 1200px;
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

    .btn-disabled {
        border-radius: 0.3em;
        border: none;
        background: gray;
        padding: 0.5em 0.8em;
        color: #ccc;
        cursor: pointer;
        margin-left: 1em;
    }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="background">

        <div class="container">

            <h1 class='title'>Manage User Request</h1>

            <table>
                <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Email</th>
                        <th>User's request</th>
                        <th>Admin's reply</th>
                        <th>User ask date</th>
                        <th>Admin reply date</th>
                        <th>Admin's section</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                $dataUserAdmin = $conn->query("select admin_user.id, user.name, user.email, 
                admin_user.user_send, admin_user.admin_send, admin_user.admin_published_at, admin_user.user_published_at from `user`, `admin_user` 
                where user.id = admin_user.user_id ;");
                $d = $dataUserAdmin->fetchAll();

                if ($d) {
                    foreach ($d as $row) {
                        $id = $row['id'];
                        $user_send = $row['user_send'];
                        $admin_send = $row['admin_send'];
                        $user_name = $row['name'];
                        $user_email = $row['email'];
                        $replied_date_admin = $row['admin_published_at'];
                        $replied_date_user = $row['user_published_at'];
                ?>
                    <tr class='w3-hover-green'>
                        <td><?php echo $user_name; ?></td>
                        <td><?php echo $user_email; ?></td>
                        <td><?php echo $user_send; ?></td>
                        <td><?php if ($admin_send) {
                                    echo $admin_send;
                                } ?></td>
                        <td><?php echo $replied_date_user; ?></td>
                        <td><?php if ($admin_send) {
                        echo $replied_date_admin;
                                } ?></td>
                        <td>
                            <?php if (!$admin_send) { ?>
                            <a class='text-light text-decoration-none'
                                href='/comp1841/admin/replyUser.php?updateid=<?php echo $id; ?>'>
                                <button class='btn btn-edit'>Reply this user</button>
                            </a>
                            <?php } else { ?>
                            <a class='text-light text-decoration-none'>
                                <button disabled class='btn-disabled'>Replied</button>
                            </a>
                            <?php } ?>
                            <a class='text-light text-decoration-none'
                                href='/comp1841/crud/delete.php?deleteid=<?php echo $id; ?>'><button
                                    class='btn btn-delete'>Delete</button></a>
                        </td>
                    </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        No data...
                    </tr>
                    <?php
                }
                ?>
            </table>
        </div>
    </div>
</body>

</html>