<?php

session_start();

if (isset($_SESSION['user_id'])) {
	unset($_SESSION['user_id']);
}

header("Location: /comp1841/auth/login.php");
die;
