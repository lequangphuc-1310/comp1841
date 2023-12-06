<?php
try {
	$host = 'localhost';
	$dbName = 'comp1841_001282874';
	$userName = 'root';
	$password = '';
	$conn = new PDO("mysql:host=$host; dbname=$dbName; charset=utf8", $userName, $password);
} catch (PDOException $e) {
	die("Error: " . $e->getMessage());
}
