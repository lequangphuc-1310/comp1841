<?php
include '/xampp/htdocs/comp1841/auth/connection.php';

if (isset($_POST["submit"])) {
    $module_name = $_POST["module_name"];
    $module_id = $_POST["module_id"];
    try {
        $sql = "INSERT INTO `module` (`module_name`, `module_id`) values ('$module_name', '$module_id')";
        $result = $conn->exec($sql);
        if ($result) {
            header('location: /comp1841/crud/module/modules.php');
        }
    } catch (PDOException $e) {
        die("Error: " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Add New Module</title>
</head>

<body>
    <style type="text/css">
        html,
        body {
            height: 100%;
        }

        .label {
            margin: 10px 0 10px 0;
        }

        .title {
            text-align: center;
            margin-top: 20px;
        }

        .btn-blue {
            background-color: #381DDB !important;
            border-radius: 8px;
            padding: 10px 14px;
            color: #fff;
            cursor: pointer;
        }

        #toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: green;
            color: #fff;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 10;
            left: 50%;
            bottom: 60px;
            font-size: 17px;
        }


        #toast.show {
            visibility: visible;
            -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 60px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 60px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 60px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 60px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
    <?php
    include "/xampp/htdocs/comp1841/crud/nav/nav.php";

    ?>
    <h1 class='title'>CRUD ADD NEW MODULE</h1>
    <div class="container ">
        <form action="addModule.php" method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's name</label>
                    <textarea row='1' col='50' class="form-control textArea" name='module_name'> </textarea>
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's id</label>
                    <input type='module_id' class="form-control textArea" name='module_id' />
                </div>
                <div class='form-group col-12 label'>
                    <button onclick="sendToast()" name='submit' class="btn-blue">Submit</button>
                </div>
            </div>
        </form>
        <div id="toast">Add New Module Success</div>

    </div>
    <script>
        function sendToast() {
            var x = document.getElementById("toast");
            x.className = "show";
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);
        }
    </script>
</body>

</html>