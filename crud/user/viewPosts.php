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
    <title>Display Posts</title>
    <link rel="stylesheet" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>">

</head>

<body>
    <style>
        .title {
            text-align: center;
            margin-top: 20px;
        }

        .btn.btn-primary.my-3 a {
            color: #fff;
        }

        .btn.btn-primary.my-3 a:hover {
            opacity: 0.8;
        }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <div class="container">
        <h1 class='title'>Display Posts</h1>
        <div class="col-12">
            <a href='/comp1841/crud/askPage/askPage.php'>
                <div class="btn btn-primary my-3">Create
                    new
                    post</div>
            </a>
        </div>
        <table class="w3-table-all">
            <thead>
                <tr class="w3-light-grey w3-hover-red">
                    <th>Author</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <?php

            // $data = $conn->query("select id, title, details from `post`");
            $data = $conn->query("select user.*,post.title,post.details,post.id from `user`, `post` where user.id=post.user_id;");

            $d = $data->fetchAll();

            if ($d) {
                foreach ($d as $row) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $details = $row['details'];
                    $name = $row['name'];
                    $email = $row['email'];
                    echo
                    "
                    <tr class='w3-hover-green'>
                        <td>$name</td>
                        <td>$email</td>
                        <td>$title</td>
                        <td>
                        <a class='text-light text-decoration-none' href='/comp1841/crud/home/home.php?postId=" . $id . "'><button class='btn btn-danger'>Go to this post</button></a>
                        </td>
                    </tr> ";
                }
            }
            ?>
        </table>

    </div>
</body>

</html>