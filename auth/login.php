<?php

session_start();

include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/auth/functions.php");
include("/xampp/htdocs/comp1841/toast/toast.php");

if (array_key_exists('success', $_GET)) { ?>
    <script>
        showSuccessSignUp()
    </script>
    <?php }
if (isset($_POST['submit'])) {

    $name = $_POST['name'];
    $password = $_POST['password'];

    if (!empty($name) && !empty($password)) {


        $query = "select * from user where name = '$name'";
        $result = $conn->query($query);

        if ($result) {
            $checkRow = $conn->prepare("SELECT COUNT(`name`) FROM `user` WHERE `name` = ?");
            $checkRow->execute(array($name));
            $countRow = $checkRow->fetchColumn();


            $resultAdmin = $conn->query("select * from user where role = 'admin'");
            $admin_data = $resultAdmin->fetch();
            $_SESSION['admin_id'] = $admin_data['id'];


            if ($result && $countRow > 0) {

                $user_data = $result->fetch();



                if ($user_data['password'] === $password) {
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['user_image'] = $user_data['image'];


                    header('Location: http://' . $_SERVER['HTTP_HOST'] . '/comp1841/crud/home/home.php?success');
    ?>
                    <script>
                        showSuccess();
                    </script>
                <?php
                } else {
                    $wrongPassword = "Incorrect password!";
                ?>
                    <script>
                        showError('<?php echo $wrongPassword; ?>');
                    </script>
                <?php
                }
            } else {
                $userNotFound = "User not found!";
                ?>
                <script>
                    showError('<?php echo $userNotFound; ?>');
                </script>
            <?php
            }
        } else {
            $userNotFound = "User not found!";
            // header("Location: /comp1841/auth/login.php?error=$userNotFound");
            ?>
            <script>
                showError('<?php echo $userNotFound; ?>');
            </script>
        <?php
        }
    } else {
        $missingParam = 'Please enter name and password';
        // header("Location: /comp1841/auth/login.php?error=$missingParam");
        ?>
        <script>
            showError('<?php echo $missingParam; ?>');
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
    <title>Login</title>
    <link href="csslogin.css?v=<?php echo time(); ?>" rel="stylesheet">
</head>

<body>

    <div class="login-outer-container">
        <div class="login-container">
            <form action="login.php" method='POST'>
                <div class="login-container-content">
                    <div class="login-content-left">
                        <div class="log-content-left-title"><span>
                                <h5>Sign In</h5>
                            </span></div>
                        <div class="form-login">
                            <div class="form-login-content">
                                <label for="name" class='login-label'>USERNAME</label>
                                <input class="login-input" type="text" id='name' name='name' placeholder="Username" />
                            </div>
                            <div class="form-login-content">
                                <label for="name" class='login-label'>PASSWORD</label>
                                <input class="login-input" type="text" id='password' name='password' placeholder="Password" />
                            </div>
                        </div>
                        <div class="btn-login"><input class='login-submit-btn' type="submit" name='submit' value='Sign In'></div>
                    </div>
                    <div class="login-content-right">
                        <div class="login-content-right-text">
                            <div class="text-welcome">Welcome to login</div>
                            <div class="text-dontHaveAccount">Don't have an account?</div>
                            <div class="btn-signup"><a href="/comp1841/auth/signUp.php"><span>Sign Up</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>

</html>