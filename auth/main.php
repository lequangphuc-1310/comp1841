<?php
session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");

$user_data = check_login($conn);

?>

<!DOCTYPE html>
<html>

<head>
    <title>My website</title>
</head>

<body>

    <a href="logout.php">Logout</a>
    <h1>This is the index page</h1>

    <br>
    Hello, <?php echo $user_data['name']; ?>
</body>

</html>