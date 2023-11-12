<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/comp1841/crud/search/search.css?v=<?php echo time(); ?>" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <title>Search</title>
</head>

<body>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";
    if (array_key_exists('user-input', $_POST)) {
        $user_input = $_POST['user-input'];
    } else {
        $user_input = '';
    }

    ?>


    <form method='POST'>
        <div class="searchArea-body">
            <div class="search-container-homeSearch">
                <div class="up-container">
                    <div class="inputSearchUser">
                        <input type="text" placeholder="Search..." name='user-input' id="searchTextInput" value='<?php echo $user_input; ?>' class="form-control">
                    </div>
                </div>
                <div class="down-container">
                    <div class="down">
                        <div class="content">
                            <div id="search-option">
                                <div class="no-message">
                                    <input type='submit' name='user' class="btn-option" value='Search User' />
                                </div>
                                <div class="no-message">
                                    <input type='submit' name='post' class="btn-option" value='Search Post' />
                                </div>
                                <div class="no-message">
                                    <input type='submit' name='module' class="btn-option" value='Search Module' />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="result-search">
                <?php
                if (isset($_POST['user'])) {
                    $resultUser = $conn->query("select `id`, `name`, `email`, `image` from `user` where name like '%$user_input%' or email like '%$user_input%@gmail.com' ;");
                    $dUser = $resultUser->fetchAll();
                    if ($dUser) {
                        foreach ($dUser as $row) {
                            $name = $row['name'];
                            $id = $row['id'];
                            $email = $row['email'];
                            $image = $row['image'];
                ?>
                            <a href="/comp1841/crud/user/userInfo.php?userId=<?php echo $id; ?>">
                                <div class="each-user-found">
                                    <div class="user-avt">
                                        <div style='border: 1px solid green; width: 40px; height: 40px; background: url(/comp1841/crud/user/uploads/<?php echo $image; ?>) center center no-repeat; background-size: contain; border-radius: 50%;'>
                                        </div>
                                    </div>
                                    <div class="user-name"><?php echo $name; ?></div>
                                    <div class="user-email"><?php echo $email; ?></div>
                                </div>
                            </a>
                        <?php
                        }
                    }
                } elseif (isset($_POST['post'])) {
                    $resultPost = $conn->query("select id, title, details, module from `post` where `title` like '%$user_input%' or `details` like '%$user_input%';");
                    $dPost = $resultPost->fetchAll();
                    if ($dPost) {
                        foreach ($dPost as $row) {
                            $title = $row['title'];
                            $id = $row['id'];
                            $details = $row['details'];
                            $moduleId = $row['module'];
                            $resultGetModule = $conn->query("select * from `module` where id=$moduleId");
                            $dataResultGetModule = $resultGetModule->fetch();
                            $module_name = $dataResultGetModule['module_name'];
                            $module_id = $dataResultGetModule['module_id'];
                        ?>
                            <a href="/comp1841/crud/home/home.php?postId=<?php echo $id; ?>">
                                <div class="each-post-found">
                                    <div class="post-title">
                                        <?php echo $title; ?>
                                    </div>
                                    <div class="post-details"><?php echo $details; ?></div>
                                    <div class="post-module-id"><?php echo $module_id; ?></div>
                                </div>
                            </a>
                        <?php
                        }
                    }
                } elseif (isset($_POST['module'])) {
                    $resultModule = $conn->query("SELECT * FROM `module` WHERE `module_name` like '%$user_input' or `module_id` like '%$user_input%';");
                    $dModule = $resultModule->fetchAll();
                    if ($dModule) {
                        foreach ($dModule as $row) {
                            $module_name = $row['module_name'];
                            $module_id = $row['module_id'];
                        ?>
                            <div class="each-module-found">
                                <div class="module_name"><?php echo $module_name; ?></div>
                                <div class="module_id"><?php echo $module_id; ?></div>
                            </div>
                <?php
                        }
                    }
                }
                ?>
            </div>

        </div>
    </form>

</body>

</html>