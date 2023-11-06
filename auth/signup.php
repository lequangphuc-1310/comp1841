<?php
session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    if (!empty($name) && !empty($password)) {

        //save to database
        $user_id = random_num(20);
        $checkExistedAccount = $conn->query("select * from `user` where `name` = '$name'");
        $dExistedAccount = $checkExistedAccount->fetch();
        if ($dExistedAccount) {
            echo '<script>alert("This username/email has already taken")</script>';
        } else {

            $query = "insert into `user` (name,password,email, image) values ('$name','$password', '$email', 'IMG-653751dd87d0c4.57015077.png')";

            $result = $conn->query($query);

            header("Location: login.php");
        }
    } else {
        echo "<script>alert('Please enter name and password')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SignUp</title>
    <link href="csslogin.css?v=<?php echo time(); ?>" rel="stylesheet">
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