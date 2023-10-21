<?php
function check_login($conn)
{

	if (isset($_SESSION['user_id'])) {
		$id = $_SESSION['user_id'];
		$query = "select * from user where id = '$id' limit 1";

		$result = $conn->query($query);
		$checkRow = $conn->prepare("SELECT COUNT(`id`) FROM `user` WHERE `id` = ?");
		$checkRow->execute(array($id));
		$countRow = $checkRow->fetchColumn();
		if ($result && $countRow > 0) {

			$user_data = $result->fetch();
			return $user_data;
		}
	} else {
		//redirect to login
		header("Location: ./login.php");
		die;
	}
}

function random_num($length)
{

	$text = "";
	if ($length < 5) {
		$length = 5;
	}

	$len = rand(4, $length);

	for ($i = 0; $i < $len; $i++) {
		# code...

		$text .= rand(0, 9);
	}

	return $text;
}
