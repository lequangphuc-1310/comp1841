<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
include("/xampp/htdocs/comp1841/toast/toast.php");

if (array_key_exists('deletedUser', $_GET)) {
?>
<script>
showInfo('Since you deleted the user, all of posts that relating to this user will be deleted');
</script>
<?php
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" /> -->

    <title>Display Users</title>

</head>

<body>
    <style>
    .title {
        text-align: center;
        margin-top: 20px;
    }

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


    .container {
        background-color: transparent;
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
    <div class="background">


        <div class="container">

            <h1 class='title'>Display Users</h1>

            <div class="col-12">
                <a href='/comp1841/admin/addUser.php'>
                    <div class="btn btn-primary my-3">Add
                        User</div>
                </a>
            </div>



            <table>
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Operations</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $data = $conn->query("select id, name, password, email from `user` order by id desc");
                    $d = $data->fetchAll();

                    if ($d) {
                        foreach ($d as $row) {
                            $id = $row['id'];
                            $name = $row['name'];
                            $email = $row['email'];
                    ?>
                    <tr class='w3-hover-green'>
                        <td><?php echo $id; ?></td>
                        <td><?php echo $name; ?></td>
                        <td><?php echo $email; ?></td>
                        <td>
                            <a class='text-light text-decoration-none'
                                href='/comp1841/crud/edit.php?updateUserId=<?php echo  $id; ?>'>
                                <button class='btn btn-edit'>Edit</button></a>
                            <?php if (!($name == 'admin' || $email == 'admin@gmail.com')) { ?>
                            <a class='text-light text-decoration-none'
                                href='/comp1841/crud/delete.php?deleteUserId=<?php echo $id; ?>'><button
                                    class='btn btn-delete'>Delete</button></a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?php
                        }
                    } else {
                        ?>
                    <tr>
                        No user available. Please try again or create new user.
                    </tr>
                    <?php
                    }
                    ?>
            </table>
        </div>
    </div>
</body>

</html>