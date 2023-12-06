<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
include '/xampp/htdocs/comp1841/toast/toast.php';
$sql = "select user.image, user.name, user.email, post.title,post.details,post.id,post.published_at,post.module, post.imagePost from `user`,`post`
where post.user_id=user.id ORDER BY id DESC LIMIT 1;";
$result = $conn->query($sql);
$d = $result->fetch();
if ($d) {
    $postId = $d['id'];
}

if (array_key_exists('noPost', $_GET)) {
    ?>
<script>
showInfo('No post available! Please add new post')
</script>
<?php
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <title>Display Posts</title>
    <link rel="stylesheet" href="/comp1841/crud/home/home.css?v=<?php echo time(); ?>">

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
        width: 10em;
        margin: 1em 0;
    }

    select {
        padding: 0.6em;
        border-radius: 0.5em;
        cursor: pointer;
    }

    button.btn.btn-goToPost {
        border-radius: 0.3em;
        border: none;
        color: #fff;
        background-color: #557fbd;
        padding: 0.5em 0.8em;
        cursor: pointer;
        margin-left: 1em;
    }

    button.btn.btn-goToPost:hover {
        background-color: red;
        color: #fff;
    }

    button.btn.btn-edit {
        border-radius: 0.3em;
        border: none;
        color: #fff;
        background-color: #8455bd;
        padding: 0.5em 0.8em;
        cursor: pointer;
        margin-left: 1em;
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
    }

    button.btn.btn-delete:hover {
        background-color: red;
    }

    button.btn.btn-edit i {
        color: #fff;
    }

    .filter-container {
        display: flex;
        justify-content: end;
        margin: 1em 0;
    }

    .filterBtn {
        padding: 0.5em 0.8em;
        border: none;
        border-radius: 0.3em;
        cursor: pointer;
    }

    .filterBtn:hover {
        background-color: #000;
        color: #fff;
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
        <div class="filter-container">
            <form action="" method="POST">
                <?php
                $result = $conn->query("select id, module_id, module_name from `module`");
                $d = $result->fetchAll();


                echo "<html>";
                echo "<body>";
                echo "<select name='module_id'>";

                foreach ($d as $row) {
                    $module_id = $row['module_id'];
                    $module_name = $row['module_name'];
                    $module_id_PK = $row['id'];
                    echo '<option value="' . htmlspecialchars($module_id_PK) . '">' . htmlspecialchars($module_id) . ' -' . htmlspecialchars($module_name) . '</option>';
                }
                echo '<option value="All">All</option>';

                echo "</select>";
                ?>
                <input class="filterBtn" type='submit' value='Filter' name='submitFilter' />
            </form>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Author</th>
                    <th>Email</th>
                    <th>Post</th>
                    <th>Operations</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (array_key_exists('moduleId', $_GET)) {
                    $moduleId = $_GET['moduleId'];

                    if ($moduleId == 'All') {
                        $data = $conn->query("select user.*,post.title,post.details,post.id from `user`, `post` where user.id=post.user_id;");
                        $d = $data->fetchAll();
                        if ($d) {
                            foreach ($d as $row) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $details = $row['details'];
                                $name = $row['name'];
                                $email = $row['email'];
                ?>
                <tr class='w3-hover-green'>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $title; ?></td>
                    <td class='admin-operation'>
                        <a class='text-light text-decoration-none'
                            href='/comp1841/crud/home/home.php?postId=<?php echo $id; ?>'>
                            <button class='btn btn-goToPost'>Go to this post</button></a>
                        <?php
                                        if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                                        ?>
                        <a href="/comp1841/crud/askPage/askPageEdit.php?postId=<?php echo $postId; ?>">
                            <button class='btn btn-edit'><i class="far fa-edit"></i></button></a>
                        <a href="/comp1841/crud/delete.php?postIdAdmin=<?php echo $postId; ?>">
                            <button class='btn btn-delete'><i class="fas fa-trash"></i></button></a>
                        <?php
                                        }
                                        ?>
                    </td>
                </tr>
                <?php  }
                        } else {
                            ?>
                <tr>
                    No Post available. Please try again or create new post.
                </tr>
                <?php
                        }
                    } else {
                        $data = $conn->query("select user.*,post.title,post.details,post.id from `user`, `post` where user.id=post.user_id and module=$moduleId");

                        $d = $data->fetchAll();

                        if ($d) {
                            foreach ($d as $row) {
                                $id = $row['id'];
                                $title = $row['title'];
                                $details = $row['details'];
                                $name = $row['name'];
                                $email = $row['email'];
                            ?>
                <tr class='w3-hover-green'>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $title; ?></td>
                    <td class='admin-operation'>
                        <a class='text-light text-decoration-none'
                            href='/comp1841/crud/home/home.php?postId=<?php echo $id; ?>'>
                            <button class='btn btn-goToPost'>Go to this post</button></a>
                        <?php
                                        if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                                        ?>
                        <a href="/comp1841/crud/askPage/askPageEdit.php?postId=<?php echo $postId; ?>">
                            <button class='btn btn-edit'><i class="far fa-edit"></i></button></a>
                        <a href="/comp1841/crud/delete.php?postIdAdmin=<?php echo $postId; ?>">
                            <button class='btn btn-delete'><i class="fas fa-trash"></i></button></a>
                        <?php
                                        }
                                        ?>
                    </td>
                </tr>
                <?php  }
                        } else {
                            ?>
                <tr>
                    <td colspan='4'>No Post available. Please try again or create new post.</td>
                </tr>
                <?php
                        }
                    }
                } else {
                    $data = $conn->query("select user.*,post.title,post.details,post.id from `user`, `post` where user.id=post.user_id;");

                    $d = $data->fetchAll();

                    if ($d) {
                        foreach ($d as $row) {
                            $id = $row['id'];
                            $title = $row['title'];
                            $details = $row['details'];
                            $name = $row['name'];
                            $email = $row['email'];
                        ?>
                <tr class='w3-hover-green'>
                    <td><?php echo $name; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $title; ?></td>
                    <td class='admin-operation'>
                        <a class='text-light text-decoration-none'
                            href='/comp1841/crud/home/home.php?postId=<?php echo $id; ?>'>
                            <button class='btn btn-goToPost'>Go to this post</button></a>
                        <?php
                                    if ($_SESSION['user_id'] == $_SESSION['admin_id']) {
                                    ?>
                        <a href="/comp1841/crud/askPage/askPageEdit.php?postId=<?php echo $postId; ?>">
                            <button class='btn btn-edit'><i class="far fa-edit"></i></button></a>
                        <a href="/comp1841/crud/delete.php?postIdAdmin=<?php echo $postId; ?>">
                            <button class='btn btn-delete'><i class="fas fa-trash"></i></button></a>
                        <?php
                                    }
                                    ?>
                    </td>
                </tr>
                <?php  }
                    } else {
                        ?>
                <tr>
                    No Post available. Please try again or create new post.
                </tr>
                <?php
                    }
                }
                ?>
            </tbody>
        </table>



    </div>
</body>

</html>

<?php if (isset($_POST['submitFilter'])) {
    // header('Location: /comp1841/crud/user/viewPosts.php?module');
    $moduleId = $_POST['module_id']
?>
<script>
window.location.href = '/comp1841/crud/user/viewPosts.php?moduleId=<?php echo $moduleId; ?>'
</script>
<?php
}; ?>