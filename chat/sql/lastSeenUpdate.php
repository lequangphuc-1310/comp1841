<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_id'])) {

    # database connection file
    include '/xampp/htdocs/comp1841/auth/connection.php';

    # get the logged in user's username from SESSION
    $id = $_SESSION['user_id'];

    $sql = "UPDATE user
	        SET last_seen = NOW() 
	        WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);
} else {
    header("Location: /comp1481/crud/home/home.php");
    exit;
}
