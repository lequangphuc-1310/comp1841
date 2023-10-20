<?php include 'connect.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Display Posts</title>
    <link rel="stylesheet" href="./home.css">

</head>

<body>
    <style>
    .title {
        text-align: center;
        margin-top: 20px;
    }
    </style>
    <?php
    include 'nav.php'
    ?>
    <div class="container">

        <h1 class='title'>Display Posts</h1>
        <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>No.</th>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <?php
            // $sql = 'SELECT * FROM `crud`';
            // $result = mysqli_query($conn, $sql);

            $data = $conn->query("select id, title, details from `post`");
            $d = $data->fetchAll();

            if ($d) {
                foreach ($d as $row) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $details = $row['details'];
                    echo
                    "
                    <tr class='w3-hover-green'>
                        <td>$id</td>
                        <td>---</td>
                        <td>---</td>
                        <td>$title</td>
                        <td>
                            <button class='btn btn-danger'><a class='text-light text-decoration-none' href='edit.php?updateid=" . $id . "'>Edit</a></button>
                            <button class='btn btn-warning'><a class='text-light text-decoration-none' href='delete.php?deleteid=" . $id . "'>Delete</a></button>
                        </td>
                    </tr> ";
                }
            }
            ?>
        </table>

    </div>
</body>

</html>