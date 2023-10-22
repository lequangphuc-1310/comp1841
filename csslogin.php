<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="csslogin.css?v=<?echo time()?>" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="box">
            <!-- <div>
                <h4>Sign Up</h4>
            </div> -->
            <form method="post">
                <div class='signup-title'><span class="signup-title-red">L</span>og<span
                        class='signup-title-red'>I</span>n
                </div>
                <input id="text" type="text" name="name" placeholder="Enter your name"><br><br>
                <input id="text" type="password" name="password" placeholder="Enter your password"><br><br>

                <button id="button" class='logIn' type="submit"><a href="login.php">Click to Login</a></button><br><br>

            </form>
        </div>
    </div>
</body>

</html>