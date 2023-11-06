<?php

session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");

if (isset($_POST['submit'])) {

	$name = $_POST['name'];
	$password = $_POST['password'];

	if (!empty($name) && !empty($password)) {


		$query = "select * from user where name = '$name'";
		$result = $conn->query($query);

		if ($result) {
			$checkRow = $conn->prepare("SELECT COUNT(`name`) FROM `user` WHERE `name` = ?");
			$checkRow->execute(array($name));
			$countRow = $checkRow->fetchColumn();


			$resultAdmin = $conn->query("select * from user where role = 'admin'");
			$admin_data = $resultAdmin->fetch();
			$_SESSION['admin_id'] = $admin_data['id'];


			if ($result && $countRow > 0) {

				$user_data = $result->fetch();



				if ($user_data['password'] === $password) {
					$_SESSION['user_id'] = $user_data['id'];

					header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php');
				}
			} else {
				echo  '<script>alert("User not found!")</script>';
			}
		} else {
			echo  '<script>alert("User not found!")</script>';
		}
	} else {
		echo "<script>alert('Please enter name and password')</script>";
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

				<button class='logIn' type="submit" name='submit'>Click to Login</button><br><br>
				<div class="or">Or</div>
				<button class='signUp'><a href="signup.php">Click to
						SignUp</a></button><br><br>

			</form>
		</div>
	</div>
</body>

</html>