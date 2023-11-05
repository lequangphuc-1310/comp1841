<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage User Request</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/comp1841/admin/contactUser.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

</head>

<body>
    <style>
        .title {
            text-align: center;
            margin-top: 20px;
        }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="container">

        <h1 class='title'>Manage User Request</h1>


        <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>User Name</th>
                    <th>Email</th>
                    <th>User's section</th>
                    <th>Admin's section</th>
                </tr>
            </thead>
            <?php
            $dataUserAdmin = $conn->query("select admin_user.id, user.name, user.email, admin_user.user_send, admin_user.admin_send from `user`, `admin_user` where user.id = admin_user.user_id and admin_user.admin_send = '';");
            $d = $dataUserAdmin->fetchAll();

            if ($d) {
                foreach ($d as $row) {
                    $id = $row['id'];
                    $user_send = $row['user_send'];
                    $admin_send = $row['admin_send'];
                    $user_name = $row['name'];
                    $user_email = $row['email'];
                    echo
                    "
            <tr class='w3-hover-green'>
                <td>$user_name</td>
                <td>$user_email</td>
                <td>$user_send</td>
                <td>
                    <button class='btn btn-danger'><a class='text-light text-decoration-none' href='/comp1841/admin/replyUser.php?updateid=" . $id . "'>Reply this user</a></button>
                    <button class='btn btn-warning'><a class='text-light text-decoration-none' href='/comp1841/crud/delete.php?deleteid=" . $id . "'>Delete</a></button>
                </td>
            </tr> ";
                }
            }
            ?>
        </table>
    </div>
</body>

</html>