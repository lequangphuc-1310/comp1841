<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
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
            z-index: 1;
            left: 50%;
            bottom: 30px;
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
                bottom: 30px;
                opacity: 1;
            }
        }

        @keyframes fadein {
            from {
                bottom: 0;
                opacity: 0;
            }

            to {
                bottom: 30px;
                opacity: 1;
            }
        }

        @-webkit-keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }

        @keyframes fadeout {
            from {
                bottom: 30px;
                opacity: 1;
            }

            to {
                bottom: 0;
                opacity: 0;
            }
        }
    </style>
</head>

<body>

    <h2>toast / Toast</h2>
    <p>toasts are often used as a tooltips/popups to show a message at the bottom of the screen.</p>
    <p>Click on the button to show the toast. It will disappear after 3 seconds.</p>

    <div class="container ">
        <form action="" method='POST'>
            <div class='row'>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's name</label>
                    <textarea row='1' col='50' class="form-control textArea" name='module_name'> </textarea>
                </div>
                <div class='form-group col-12 label'>
                    <label for="">Enter module's id</label>
                    <input type='module_id' class="form-control" name='module_id' />
                </div>
                <div class='form-group col-12 label'>
                </div>
            </div>
        </form>
        <div id="toast">Add New Module Success</div>

        <button onclick="sendToast()" type='submit' name='submit' class="btn-blue">Submit</button>
    </div>

    <button onclick="sendToast()">Show toast</button>

    <div id="toast">Add New Module Success</div>

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