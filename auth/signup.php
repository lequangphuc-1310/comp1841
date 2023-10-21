<?php
session_start();

include("connection.php");
include("functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$name = $_POST['name'];
	$password = $_POST['password'];
	$email = $_POST['email'];

	if (!empty($name) && !empty($password) && !is_numeric($name) && !is_numeric($email)) {

		//save to database
		$user_id = random_num(20);
		$query = "insert into user (id,name,password,email) values ('$id','$name','$password', '$email')";

		$result = $conn->query($query);

		header("Location: login.php");
		die;
	} else {
		echo "Please enter some valid information!";
	}
}
?>


<!DOCTYPE html>
<html>

<head>
	<title>Signup</title>
</head>

<body>

	<style type="text/css">
		#text {

			height: 25px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			width: 100%;
		}

		#button {

			padding: 10px;
			width: 100px;
			color: white;
			background-color: lightblue;
			border: none;
		}

		#box {

			background-color: grey;
			margin: auto;
			width: 300px;
			padding: 20px;
		}
	</style>

	<div id="box">

		<form method="post">
			<div style="font-size: 20px;margin: 10px;color: white;">Signup</div>

			<input id="text" type="text" name="email" placeholder="Enter your email"><br><br>
			<input id="text" type="text" name="name" placeholder="Enter your name"><br><br>
			<input id="text" type="password" name="password" placeholder="Enter your password"><br><br>

			<input id="button" type="submit" value="Signup"><br><br>

			<a href="login.php">Click to Login</a><br><br>
		</form>
	</div>
</body>

</html>