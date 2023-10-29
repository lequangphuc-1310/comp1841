<?php
include '/xampp/htdocs/comp1841/auth/connection.php';
$postId = $_GET['postId'];
$result = $conn->query("delete from `post` where id=$postId");
header('location: /comp1841/crud/home/home.php');
