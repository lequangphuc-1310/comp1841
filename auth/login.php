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


			$queryAdmin = "select * from user where email = 'admin@gmail.com' limit 1;";
			$resultAdmin = $conn->query($queryAdmin);



			if ($result && $countRow > 0) {

				$user_data = $result->fetch();
				$admin_data = $resultAdmin->fetch();

				if ($user_data['password'] === $password) {
					$_SESSION['user_id'] = $user_data['id'];
					if ($user_data['email'] == 'admin@gmail.com') {
						$_SESSION['admin'] = true;
						$_SESSION['admin_id'] = $user_data['id'];
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

        <form method="post" action='login.php'>
            <div style="font-size: 20px;margin: 10px;color: white;">Login</div>

            <input id="text" type="text" name="name"><br><br>
            <input id="text" type="password" name="password"><br><br>

            <input id="button" type="submit" value="Login"><br><br>

            <a href="signup.php">Click to Signup</a><br><br>
        </form>
    </div>
</body>

</html>