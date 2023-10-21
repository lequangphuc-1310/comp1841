<?php



try {
	$host = 'localhost';
	$dbName = 'comp1841';
	$userName = 'root';
	$password = '';
	$conn = new PDO("mysql:host=$host; dbname=$dbName; charset=utf8", $userName, $password);
} catch (PDOException $e) {
	die("Error: " . $e->getMessage());
}

/** 
 * 
 * 
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "user";

if (!$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {

	die("failed to connect!");
}
 * 
 */
