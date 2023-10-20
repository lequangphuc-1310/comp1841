<?php

// $con = new mysqli('localhost', 'root', '', 'phpstepbystepyoutube');

// if (!$con) {
//     die(mysqli_error($con));
// } else {
//     // echo 'connection established successfully';
// }

try {
    $host = 'localhost';
    $dbName = 'comp1841';
    $userName = 'root';
    $password = '';
    $conn = new PDO("mysql:host=$host; dbname=$dbName; charset=utf8", $userName, $password);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}
