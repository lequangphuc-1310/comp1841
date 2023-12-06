<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
if (isset($_GET['deleteUserId'])) {
    $inputId = $_GET['deleteUserId'];
    $sql = "delete from `user` where id = $inputId";
    $sql2 = "delete from `post` where user_id = $inputId";
    $sql3 = "delete from `answer` where user_id = $inputId";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);
    $result3 = $conn->query($sql3);


    if ($result) {
        header('location: /comp1841/admin/displayUser.php?deletedUser');
    } else {
        die("Error when deleting user");
    }
}

if (isset($_GET['deleteModuleId'])) {
    $inputId = $_GET['deleteModuleId'];
    $sql = "delete from `module` where id = $inputId";
    $sql2 = "delete from `post` where module = $inputId";

    $result = $conn->query($sql);
    $result2 = $conn->query($sql2);

    if ($result) {
        header('location: /comp1841/crud/module/modules.php?deletedModule');
    } else {
        die("Error when deleting module");
    }
}

if (isset($_GET['postId'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $postId = $_GET['postId'];
    $result = $conn->query("delete from `post` where id=$postId ");
    $result2 = $conn->query("delete from `answer` where post_id=$postId");
    header('location: /comp1841/crud/user/viewPosts.php');
}

if (isset($_GET['postIdAdmin'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $postId = $_GET['postIdAdmin'];
    $result = $conn->query("delete from `post` where id=$postId ");
    $result2 = $conn->query("delete from `answer` where post_id=$postId");
    header('location: /comp1841/crud/user/viewPosts.php');
}

if (isset($_GET['answerId'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $answerId = $_GET['answerId'];
    $result = $conn->query("delete from `answer` where id=$answerId");
    echo '
    <script type="text/javascript">
    window.location.href=document.referrer;
</script>
    ';
}


if (isset($_GET['deleteid'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $adminUserId = $_GET['deleteid'];
    $result = $conn->query("delete from `admin_user` where id=$adminUserId");
    header('location: /comp1841/admin/contactUser.php');
}
