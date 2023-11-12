<?php
session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");
include("/xampp/htdocs/comp1841/toast/toast.php");


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    //something was posted
    $name = $_POST['name'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($name) && !empty($password) && !empty($email) && !empty($confirm_password)) {
        //save to database
        $user_id = random_num(20);
        $checkExistedAccount = $conn->query("select * from `user` where `name` = '$name' or `email` = '$email'");
        $dExistedAccount = $checkExistedAccount->fetch();
        if ($password != $confirm_password) {
            $NotMatchedConfirmPassword = 'Passwords do not match';
?>
<script>
showError('<?php echo $NotMatchedConfirmPassword; ?>');
</script>
<?php
        } else {
            if ($dExistedAccount) {
                $ExistedNameOrEmail = 'This username/email has already taken by another user!'
            ?>
<script>
showError('<?php echo $ExistedNameOrEmail; ?>');
</script>
<?php
            } else {

                $query = "insert into `user` (name,password,email, image) values ('$name','$password', '$email', 'IMG-653751dd87d0c4.57015077.png')";

                $result = $conn->query($query);

                header("Location: login.php?success");
            }
        }
    } else {
        $notFillAll = 'Please fill all input to Signup!'
        ?>
<script>
showError('<?php echo $notFillAll; ?>');
</script>
<?php
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link href="csslogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

    <div class="login-outer-container">
        <div class="login-container">
            <form action="signUp.php" method='POST'>
                <div class="login-container-content">
                    <div class="login-content-left-signUp">
                        <div class="login-content-right-text">
                            <div class="text-welcome-signUp">Welcome to Sign Up</div>
                            <div class="text-dontHaveAccount">Already have an account?</div>
                            <div class="btn-signup">
                                <a href="/comp1841/auth/login.php"><span>Sign In</span></a>
                            </div>
                        </div>
                    </div>
                    <div class="login-content-right-signUp">
                        <div class="log-content-left-title">
                            <span>
                                <h5>Sign Up</h5>
                            </span>
                        </div>
                        <div class="form-login-signUp">
                            <div class="form-login-content">
                                <label for="email" class='login-label-signUp'>EMAIL</label>
                                <input class="login-input" type="email" id='email' name='email' placeholder="Email" />
                            </div>
                            <div class="form-login-content">
                                <label for="name" class='login-label-signUp'>USERNAME</label>
                                <input class="login-input" type="text" id='name' name='name' placeholder="Username" />
                            </div>
                            <div class="form-login-content">
                                <label for="name" class='login-label-signUp'>PASSWORD</label>
                                <input class="login-input" type="text" id='password' name='password'
                                    placeholder="Password" />
                            </div>
                            <div class="form-login-content">
                                <label for="confirm_password" class='login-label-signUp'>CONFIRM YOUR PASSWORD</label>
                                <input class="login-input" type="text" id='confirm_password' name='confirm_password'
                                    placeholder="Confirm Your Password" />
                            </div>
                        </div>
                        <div class="btn-login-signUp"><input type='submit' class='login-submit-btn' value='Sign Up' />
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <?php
    ?>
    <!-- <script>
        showError();
    </script> -->
</body>

</html>