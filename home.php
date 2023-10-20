<?php
include 'connect.php'
?>

<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Document</title>
<link rel="stylesheet" type="text/css" href="./home.css" />
</head>

<body>
    <?php
    include "nav.php";
    ?>
    <div class="container">

        <div class="body">
            <div class="category">
                <div class="category-item"><a href='askPage.php'>Post a question to community</a></div>
                <div class="category-item">View your account's information</div>
                <div class="category-item">Contact Administrator</div>
            </div>
            <div class="content">
                <div class="question">
                    <div class="question-title">
                        <div class='question-title-content'>
                            <?php
                            $data = $conn->query("select title from `post`");
                            $d = $data->fetch();
                            $name = $d['title'];
                            echo "$name"
                            ?>
                        </div>
                        <div class="question-title-extra">
                            <div class="asked">
                                <?php
                                $data = $conn->query("select published_at from `post`");
                                $d = $data->fetch();
                                $published = $d['published_at'];
                                echo "$published"
                                ?>
                            </div>
                            <div class="modified">
                                Modified 3 years, 2 months ago
                            </div>
                            <div class="viewed">Viewed 149 times
                            </div>

                        </div>
                    </div>
                    <div class="question-content">
                        <?php
                                $data = $conn->query("select details from `post`");
                                $d = $data->fetch();
                                $details = $d['details'];
                                echo "$details"
                                ?>
                    </div>
                    <div class="answer">

                        The easiest way to get help with such problems is to help yourself, by learning how to use a
                        debugger to step through the code and see the values of variables at each step. Then you would
                        see the obvious problem here as pointed out above. –
                        underscore_d
                        Aug 5, 2020 at 9:43
                        @Yksisarvinen nombre = (nombre * 10) + chiffre;i changed it with this and still the same problem
                        –
                        user14052726
                        Aug 5, 2020 at 9:55
                        @aymanedu Well, is chiffre_prec or chiffre a non-zero value? Seems to me that they are also
                        equal to zero all the time. Debugger would have helped you - you can examine value of each and
                        every variable at any point of execution of your code. –
                        Yksisarvinen
                        Aug 5, 2020 at 9:59
                        @Yksisarvinen chiffre_prec's value is 1 for me though. in the 1 5 example. –
                        user14052726
                        Aug 5, 2020 at 10:11
                    </div>
                </div>
            </div>

        </div>



</body>
<script src="./home.js"></script>

</html>