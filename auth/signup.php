<?php
session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");


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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="csslogin.css" rel="stylesheet">
</head>

<body>
    <div class="signup-container">
        <div class="box">
            <!-- <div>
                <h4>Sign Up</h4>
            </div> -->
            <form method="post">
                <div class='signup-title'><span class="signup-title-red">S</span>ign<span class='signup-title-red'>U</span>p
                </div>

                <input id="text" type="email" name="email" placeholder="Enter your email"><br><br>
                <input id="text" type="text" name="name" placeholder="Enter your name"><br><br>
                <input id="text" type="password" name="password" placeholder="Enter your password"><br><br>

                <input id="button" class='signUp' type="submit" value="Sign Up"><br><br>

                <button id="button" class='logIn' type="submit"><a href="login.php">Click to Login</a></button><br><br>

            </form>
        </div>
    </div>
</body>

</html>