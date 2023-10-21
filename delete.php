<?php
include 'connect.php';
if (isset($_GET['deleteid'])) {
    $inputId = $_GET['deleteid'];
    $sql = "delete from `user` where id = $inputId";
    $result = $conn->query($sql);
    if ($result) {
        header('location: display.php');
    } else {
        die("Error when deleting user");
    }
}
