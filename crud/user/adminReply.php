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
    <link rel="stylesheet" href="./home.css">

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
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="container">

        <h1 class='title'>Notifications</h1>


        <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>Your message to admin</th>
                    <th>Admin's respond</th>
                </tr>
            </thead>
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
                    if ($admin_send != '') {
                        $_SESSION['admin_seen'] = 'unread';
                    }
            ?>
            <tr class='w3-hover-green'>
                <td><?php echo $user_send; ?></td>
                <td><?php echo $admin_send; ?></td>
            </tr>
            <?php
                }
            }
            ?>
        </table>
    </div>
</body>

</html>