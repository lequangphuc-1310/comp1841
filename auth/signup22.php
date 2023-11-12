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
        $checkExistedAccount = $conn->query("select * from `user` where `name` = '$name' or `email` = '$email'");
        $dExistedAccount = $checkExistedAccount->fetch();
        if ($dExistedAccount) {
            $existedAccount = "This username/email has already taken by another user";
            header("Location: /comp1841/auth/signup.php?error=$existedAccount");
        } else {

            $query = "insert into `user` (name,password,email, image) values ('$name','$password', '$email', 'IMG-653751dd87d0c4.57015077.png')";

            $result = $conn->query($query);

            header("Location: login.php");
        }
    } else {
        $missingParam = 'Please enter name and password';
        header("Location: /comp1841/auth/signup.php?error=$missingParam");
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
            <form method="post">
                <div class='signup-title'><span class="signup-title-red">S</span>ign<span class='signup-title-red'>U</span>p
                </div>
                <?php if (array_key_exists('error', $_GET)) { ?>
                    <div class="error-area">
                        <div class="error-text">
                            <?php if (array_key_exists('error', $_GET)) {
                                echo $_GET['error'];
                            } ?></div>
                    </div>
                <?php } ?>
                <div class="inputUser">
                    <input id="text" type="email" name="email" placeholder="Enter your email"><br><br>
                </div>
                <div class="inputUser">
                    <input id="text" type="text" name="name" placeholder="Enter your name"><br><br>
                </div>
                <div class="inputUser">
                    <input id="text" type="password" name="password" placeholder="Enter your password"><br><br>
                </div>
                <div class="inputUser">
                    <input id="button" class='signUp' type="submit" value="Sign Up"><br><br>
                </div>
                <button id="button" class='logIn' type="submit"><a href="login.php">Go Back
                        Login</a></button><br><br>

            </form>
        </div>
    </div>
</body>

</html>