<?php

session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
	//something was posted
	$name = $_POST['name'];
	$password = $_POST['password'];

	if (!empty($name) && !empty($password) && !is_numeric($name)) {

		//read from database
		$query = "select * from user where name = '$name' limit 1";
		$result = $conn->query($query);

		if ($result) {
			$checkRow = $conn->prepare("SELECT COUNT(`name`) FROM `user` WHERE `name` = ?");
			$checkRow->execute(array($name));
			$countRow = $checkRow->fetchColumn();


			$queryAdmin = "select * from user where role = 'admin'";
			$resultAdmin = $conn->query($queryAdmin);
			$admin_data = $resultAdmin->fetch();
			$_SESSION['admin_id'] = $admin_data['id'];


			if ($result && $countRow > 0) {

				$user_data = $result->fetch();



				if ($user_data['password'] === $password) {
					$_SESSION['user_id'] = $user_data['id'];
					$userDataId = $user_data['id'];

					if ($user_data['email'] == 'admin@gmail.com') {
						header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php');
					} else {
						header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php');
					}

					die;
				}
			}
		}

		echo "<script>alert('wrong username or password!')</script>";
	} else {
		echo "<script>alert('wrong username or password!')</script>";
	}
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link href="csslogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

	<div class="login-container">
		<div class="box box-login">
			<!-- <div>
                <h4>Sign Up</h4>
            </div> -->
			<form method="post" action='login.php'>
				<div class='signup-title'><span class="signup-title-red">L</span>og<span class='signup-title-red'>I</span>n</div>
				<!-- <div class="invalid-value">Invalid value</div> -->
				<input type="text" name="name" placeholder="Enter your name"><br><br>
				<input type="password" name="password" placeholder="Enter your password"><br><br>

				<button class='logIn' type="submit">Click to Login</button><br><br>
				<button class='signUp'><a href="signup.php">Click to
						SignUp</a></button><br><br>

			</form>
		</div>
	</div>
</body>

</html>