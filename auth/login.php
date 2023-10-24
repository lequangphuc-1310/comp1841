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
					if ($user_data['email'] == 'admin@gmail.com') {
						// $_SESSION['admin'] = true;
						header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php');
					} else {
						header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php');
					}

					die;
				}
			}
		}

		echo "wrong username or password!";
	} else {
		echo "wrong username or password!";
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
			<form method="post">
				<div class='signup-title'><span class="signup-title-red">L</span>og<span class='signup-title-red'>I</span>n
				</div>
				<input id="text" type="text" name="name" placeholder="Enter your name"><br><br>
				<input id="text" type="password" name="password" placeholder="Enter your password"><br><br>

				<button id="button" class='logIn' type="submit"><a href="login.php">Click to Login</a></button><br><br>
				<button id="button" class='signUp'><a href="signup.php">Click to
						SignUp</a></button><br><br>

			</form>
		</div>
	</div>

</body>

</html>