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
		header("Location: /comp1841/auth/login.php");
		die;
	}
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
	include("/xampp/htdocs/comp1841/toast/toast.php");
	if (isset($fileName)) {

		$img_name = $fileName['name'];
		$img_size = $fileName['size'];
		$tmp_name = $fileName['tmp_name'];
		$error = $fileName['error'];


		if ($error === 0) {
			if ($img_size / 1024 > 10000) {
				$messageTooLarge = "Sorry, your file is too large.";
?>
				<script>
					showError('<?php echo $messageTooLarge; ?>')
				</script>
				<?php
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
					$sql2 = "select * from `user` where image='$new_img_name' and id=$id";
					$result2 = $conn->query($sql2);
					$result2fetch = $result2->fetch();
					$dResult2 = $result2fetch['image'];
					$_SESSION['new_user_image'] = $dResult2;
					echo "<script>window.location.href='/comp1841/crud/user/importImage.php?userId=$userId';</script>";
				} else {



					$messageInvalidType = "You can\'t upload files of this type";
				?>
					<script>
						showError('<?php echo $messageInvalidType; ?>')
					</script>
<?php
				}
			}
		} else {
			$unknownError = "unknown error occurred!";
			// header("Location: importImage.php?error=$unknownError");
			echo "<script>window.location.href='/xampp/htdocs/comp1841/crud/user/importImage.php?error=$unknownError;</script>";
		}
	} else {
		// header("Location: importImage.php");
	}
}




// setting up the time Zone
define('TIMEZONE', 'Asia/Ho_Chi_Minh');
date_default_timezone_set(TIMEZONE);

function last_seen($date_time)
{

	$timestamp = strtotime($date_time);

	$strTime = array("second", "minute", "hour", "day", "month", "year");
	$length = array("60", "60", "24", "30", "12", "10");

	$currentTime = time();
	if ($currentTime >= $timestamp) {
		$diff     = time() - $timestamp;
		for ($i = 0; $diff >= $length[$i] && $i < count($length) - 1; $i++) {
			$diff = $diff / $length[$i];
		}

		$diff = round($diff);
		if ($diff < 59 && $strTime[$i] == "second") {
			return 'Active';
		} else {
			return $diff . " " . $strTime[$i] . "(s) ago ";
		}
	}
}
