<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
if (isset($_GET['deleteUserId'])) {
    $inputId = $_GET['deleteUserId'];
    $sql = "delete from `user` where id = $inputId";
    $result = $conn->query($sql);
    if ($result) {
        header('location: /comp1841/admin/displayUser.php');
    } else {
        die("Error when deleting user");
    }
}

if (isset($_GET['deleteModuleId'])) {
    $inputId = $_GET['deleteModuleId'];
    $sql = "delete from `module` where id = $inputId";
    $result = $conn->query($sql);
    if ($result) {
        header('location: /comp1841/crud/module/modules.php');
    } else {
        die("Error when deleting user");
    }
}

if (isset($_GET['postId'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $postId = $_GET['postId'];
    $result = $conn->query("delete from `post` where id=$postId");
    header('location: /comp1841/crud/home/home.php');
}

if (isset($_GET['answerId'])) {
    include '/xampp/htdocs/comp1841/auth/connection.php';
    $answerId = $_GET['answerId'];
    $result = $conn->query("delete from `answer` where id=$answerId");
    header('location: /comp1841/crud/user/viewPosts.php');
}
