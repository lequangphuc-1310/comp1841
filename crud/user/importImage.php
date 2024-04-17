<!DOCTYPE html>
<html>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">

<head>
    <title>Edit your avatar</title>
    <style>
    input,
    label {
        font-family: Arial, Helvetica, sans-serif;
    }

    .import-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        min-height: 100vh;
        background: #dfdfdf;
    }

    .import-img-content {
        box-shadow: 0px 1px 1px 0px rgba(0, 0, 0, 0.15), 0px 2px 2px -8px rgba(0, 0, 0, 0.15), 0px 4px 4px 0px rgba(0, 0, 0, 0.15), 0px 8px 8px 0px rgba(0, 0, 0, 0.15);
        background-color: #fff;
        border-radius: 2em;
        padding: 1.2em;
    }

    .transform-arrow i {
        font-size: 2em;
        color: #fff;
    }

    .image-avt-default {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: url("/comp1841/crud/user/uploads/<?php echo '/comp1841/crud/user/uploads/cho-ray.jpg?'; ?>")
    }

    .import-img-content h2 {
        display: flex;
        flex-direction: row;
        justify-content: center;
        font-family: Arial, Helvetica, sans-serif;
        margin-top: 1em;
    }

    .image-container {
        border-radius: 0.5em;
        /* background: linear-gradient(rgb(95 215 220), rgb(102 178 227), rgb(124 112 232), rgb(146 92 233)) */
    }

    .label-changeImage {
        border: 1px solid #ccc;
        display: inline-block;
        padding: 0.6em 0.8em;
        cursor: pointer;
        border-radius: 0.3em;
    }

    .label-changeImage:hover {
        background: #bcbcbc;
    }

    #changeImage {
        display: none;
    }

    .changeImageBtn {
        padding: 0.8em 0.8em;
        border: 1px solid #a8a8a8;
        background: #fff;
        border-radius: 0.3em;
        outline: none;
        cursor: pointer;
    }

    .changeImageBtn:hover {
        background: #ccc;
        color: #111;
    }

    .confirmChanges {
        padding: 0.8em 0.8em;
        border: none;
        color: #fff;
        background: linear-gradient(to top right, rgb(95 215 220), rgb(102 178 227), rgb(124 112 232), rgb(146 92 233));
        border-radius: 0.3em;
        outline: none;
        cursor: pointer;
    }

    .confirmChanges:hover {
        background: rgb(102 178 227);
        color: #fff;
        animation-name: confirmChanges;
        animation-duration: 1s;
        animation-iteration-count: 1;
    }

    @keyframes confirmChanges {
        0% {
            background-color: rgb(95 215 220);
        }

        50% {
            background-color: rgb(124 112 232);
        }

        100% {
            background-color: rgb(102 178 227);
        }
    }

    .image-btn-options {
        display: flex;
        justify-content: space-between;
    }

    .image-btn-options-left {
        display: flex;
        gap: 0.5em;
    }
    </style>
</head>

<body>
    <?php
    include '/xampp/htdocs/comp1841/crud/nav/nav.php';
    ?>
    <div class="import-img-container">
        <div class="import-img-content">
            <h2>Edit Avatar</h2>
            <form method="post" enctype="multipart/form-data">
                <div class="image-container"
                    style='margin: 3em auto; display:flex; justify-content: space-between; align-items: center'>
                    <div class="image-avt"
                        style='width: 150px; border: 1px solid green; height: 150px; border-radius: 50%; background: #fff url(/comp1841/crud/user/uploads/<?php echo $_SESSION['user_image']; ?>) no-repeat center center; background-size: contain; margin: 2em;'>
                    </div>
                    <span class='transform-arrow'><i class="fas fa-angle-double-right"></i><i
                            class="fas fa-angle-double-right"></i></span>
                    <div class="image-avt"
                        style='width: 150px; border: 1px solid green; height: 150px; border-radius: 50%; background: #fff url(/comp1841/crud/user/uploads/<?php echo $_SESSION['new_user_image']; ?>) no-repeat center center; background-size: contain; margin: 2em;'>
                    </div>
                </div>
                <div class="image-btn-options">
                    <div class="image-btn-options-left">
                        <label for="changeImage" class="label-changeImage"><i class="fas fa-cloud-upload-alt"></i>
                            Change
                            Image</label>
                        <input type="file" name="inputImage" id='changeImage' onchange="changeImageBtn.submit()">
                        <input type="submit" name="submit" value="Check Image" class='changeImageBtn'>
                    </div>
                    <div class="image-btn-options-right">
                        <input type='submit' name="submitSave" value='Save Changes' class='confirmChanges'>

                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
    document.getElementsByClassName('changeImageBtn').onChange = function() {
        document.querySelector('.changeImageBtn').submit();
    }
    </script>
</body>

</html>

<?php
if (isset($_POST['submit']) && isset($_FILES['inputImage'])) {

    importImage($_FILES['inputImage']);

?>
<script>

</script>
<?php
}

if (isset($_POST['submitSave'])) {
    $_SESSION['user_image'] = $_SESSION['new_user_image'];
    echo '<script>window.location.href="/comp1841/crud/user/userInfo.php?userId=' . $_SESSION['user_id'] . '&success"</script>';
}