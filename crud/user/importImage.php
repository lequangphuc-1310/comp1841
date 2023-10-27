<!DOCTYPE html>
<html>

<head>
    <title>Edit Image</title>
    <style>
    .import-img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: row;
        min-height: 100vh;
    }
    </style>
</head>

<body>
    <?php
    include '/xampp/htdocs/comp1841/crud/nav/nav.php';
    ?>
    <div class="import-img-container">
        <?php if (isset($_GET['error'])) : ?>
        <p><?php echo $_GET['error']; ?></p>
        <?php endif ?>
        <form method="post" enctype="multipart/form-data">

            <input type="file" name="inputImage">

            <input type="submit" name="submit" value="Upload">
        </form>
    </div>

</body>

</html>

<?php
if (isset($_POST['submit']) && isset($_FILES['inputImage'])) {

    importImage($_FILES['inputImage']);
}