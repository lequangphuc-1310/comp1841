<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/comp1841/crud/toast/toast.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
</head>

<body>
    <div class="wrapper">
        <div class="toast success">
            <div class="outer-container">
                <i class="fas fa-check-circle"></i>
            </div>
            <div class="inner-container">
                <p>Success</p>
                <p>Your changes saved successfully</p>
            </div>
            <button class='close-toast'>&times;</button>
        </div>
        <div class="toast error">
            <div class="outer-container">
                <i class="fas fa-times-circle"></i>
            </div>
            <div class="inner-container">
                <p>Error</p>
                <p>Error has occured while saving changes.</p>
            </div>
            <button class='close-toast'>&times;</button>
        </div>

    </div>
</body>

<script>
    let closeBtn = document.getElementsByClassName('close-toast');
</script>

</html>