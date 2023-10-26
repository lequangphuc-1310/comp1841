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


function mysql_escape_mimic($inp)
{

	if (is_array($inp))
		return array_map(__METHOD__, $inp);

	if (!empty($inp) && is_string($inp)) {
		return str_replace(array('\\', "\0", "\n", "\r", "'", '"', "\x1a"), array('\\\\', '\\0', '\\n', '\\r', "\\'", '\\"', '\\Z'), $inp);
	}

	return $inp;
}


function importImage($fileName)
{
	include '/xampp/htdocs/comp1841/auth/connection.php';
	if (isset($fileName)) {

		echo "<pre>";
		print_r($fileName);
		echo "</pre>";

		$img_name = $fileName['name'];
		$img_size = $fileName['size'];
		$tmp_name = $fileName['tmp_name'];
		$error = $fileName['error'];

		if ($error === 0) {
			if ($img_size > 1250000) {
				$messageTooLarge = "Sorry, your file is too large.";
				header("Location: importImage.php?error=$messageTooLarge");
			} else {
				$img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
				$img_ex_lc = strtolower($img_ex);

				$allowed_exs = array("jpg", "jpeg", "png");

				if (in_array($img_ex_lc, $allowed_exs)) {
					$new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
					$img_upload_path = 'uploads/' . $new_img_name;
					move_uploaded_file($tmp_name, $img_upload_path);
					$id = $_SESSION['user_id'];
					$userId = $_SESSION['user_id'];
					if (move_uploaded_file($tmp_name, $img_upload_path)) {
						echo "<script>alert('moved')</script>";
					}

					// Insert into Database
					$sql = "update `user` set image='$new_img_name' where id=$id";
					$result = $conn->query($sql);
					header("Location: /comp1841/crud/user/userInfo.php?userId=$userId");
				} else {
					$messageInvalidType = "You can't upload files of this type";
					header("Location: importImage.php?error=$messageInvalidType");
				}
			}
		} else {
			$unknownError = "unknown error occurred!";
			header("Location: importImage.php?error=$unknownError");
		}
	} else {
		// header("Location: importImage.php");
	}
}
