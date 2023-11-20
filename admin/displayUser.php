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
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" />

    <title>Display Users</title>

</head>

<body>
    <style>
    .title {
        text-align: center;
        margin-top: 20px;
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
    <div class="container">

        <h1 class='title'>Display Users</h1>

        <div class="col-12">
            <a href='/comp1841/admin/addUser.php'>
                <div class="btn btn-primary my-3">Add
                    User</div>
            </a>
        </div>


        <!-- <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <?php
            $data = $conn->query("select id, name, password, email from `user`");
            $d = $data->fetchAll();

            if ($d) {
                foreach ($d as $row) {
                    $id = $row['id'];
                    $name = $row['name'];
                    $password = $row['password'];
                    $email = $row['email'];
                    echo
                    "
                    <tr class='w3-hover-green'>
                        <td>$id</td>
                        <td>$name</td>
                        <td>$email</td>
                        <td>$password</td>
                        <td>
                            <button class='btn btn-danger'><a class='text-light text-decoration-none' href='/comp1841/crud/edit.php?updateUserId=" . $id . "'>Edit</a></button>
                            <button class='btn btn-warning'><a class='text-light text-decoration-none' href='/comp1841/crud/delete.php?deleteUserId=" . $id . "'>Delete</a></button>
                        </td>
                    </tr> ";
                }
            }
            ?>
        </table> -->

        <table>
            <thead>
                <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $data = $conn->query("select id, name, password, email from `user`");
                $d = $data->fetchAll();

                if ($d) {
                    foreach ($d as $row) {
                        $id = $row['id'];
                        $name = $row['name'];
                        $password = $row['password'];
                        $email = $row['email'];
                        ?>
                <tr class='w3-hover-green'>
                    <td><?php echo $id; ?></td>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $password; ?></td>
                    <td>
                        <a class='text-light text-decoration-none'
                            href='/comp1841/crud/edit.php?updateUserId=<?php echo  $id; ?>'>
                            <button class='btn btn-edit'>Edit</button></a>
                        <a class='text-light text-decoration-none'
                            href='/comp1841/crud/delete.php?deleteUserId=<?php  echo $id; ?>'><button
                                class='btn btn-delete'>Delete</button></a>
                    </td>
                </tr>
                <?php
                    }
                }
                else {
                    ?>
                <tr>
                    No user available. Please try again or create new user.
                </tr>
                <?php
                }
                ?>
        </table>
    </div>
</body>

</html>