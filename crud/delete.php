<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
if (isset($_GET['deleteUserId'])) {
    $inputId = $_GET['deleteUserId'];
    $sql = "delete from `user` where id = $inputId";
    $result = $conn->query($sql);
    if ($result) {
        header('location: /comp1841/admin/display.php');
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