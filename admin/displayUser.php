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
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>" />

    <title>Display Users</title>

</head>

<body>
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
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="container">

        <h1 class='title'>Display Users</h1>
        <div>
            <a class='text-light text-decoration-none' href="/comp1841/admin/addUser.php">
                <button class='btn btn-blue my-5'>
                    Add
                    User
                </button>
            </a>
        </div>


        <table class="w3-table-all">
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
        </table>
    </div>
</body>

</html>