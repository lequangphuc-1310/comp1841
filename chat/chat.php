<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.7/css/all.css">
    <link rel="stylesheet" type="text/css" href="/comp1841/chat/chat.css?v=<?php echo time(); ?>" />
</head>

<body>
    <?php include '/xampp/htdocs/comp1841/crud/nav/nav.php'; ?>
    <?php
    if (isset($_SESSION['user_id'])) {
        include '/xampp/htdocs/comp1841/chat/sql/user.php';
        include '/xampp/htdocs/comp1841/chat/sql/chat.php';
        include '/xampp/htdocs/comp1841/chat/sql/openedInbox.php';

        if (!isset($_GET['user'])) {
            header('location: /comp1841/crud/home/home.php');
            exit;
        }

        $chatWith = getUser($_GET['user'], $conn);
        if (empty($chatWith)) {
            header("Location: /comp1841/crud/home/home.php");
            exit;
        }

        $chats = getChats($_SESSION['user_id'], $chatWith['id'], $conn);
        opened($chatWith['id'], $conn, $chats);
    }
    ?>


    <div class="chat-container">
        <div class="chat-user-info">
            <div class="goBack">
                <a href="/comp1841/crud/home/home.php">
                    <i class="fas fa-chevron-left"></i>
                    <span>Back</span>
                </a>
            </div>
            <div class="user-intro-details">
                <div class="user-intro-details-img">
                    <div class='user-intro-details-img-avt' style='    width: 50px;
                        height: 50px;
                        background: url(/comp1841/crud/user/uploads/<?php echo $chatWith['image']; ?>)center center no-repeat;
                        border-radius: 50%;
                        background-size: contain;'>
                    </div>
                </div>
                <div class="user-intro-details-text">
                    <h4><?php echo $chatWith['name']; ?></h4>
                    <?php if (last_seen($chatWith['last_seen']) == "Active") { ?>
                    <div class="outer-online-container">

                        <div class='online-container' title='online'>
                            <div class='online'></div>
                        </div>
                        <p>Online
                        </p>
                    </div>
                    <?php } else { ?>
                    <p>Last seen: <?php echo last_seen($chatWith['last_seen']); ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
        <div class="chat-detail">

            <div id="chat-content">
                <?php if (!empty($chats)) {
                    foreach ($chats as $chat) {
                        if ($chat['from_id'] == $_SESSION['user_id']) { ?>
                <div class="chat-content-you-container">
                    <div class="chat-content-you">
                        <div class="chat-child">
                            <p><?php echo $chat['message']; ?>
                            </p>
                            <small class=''><?php echo $chat['created_at']; ?></small>
                        </div>
                    </div>
                </div>
                <?php } else { ?>
                <div class="chat-content-other-container">
                    <div class="chat-content-other">
                        <div class="chat-child">
                            <p><?php echo $chat['message']; ?>
                            </p>
                            <small class=''><?php echo $chat['created_at']; ?></small>
                        </div>
                    </div>
                </div>
                <?php }
                    }
                } else { ?>
                <div class="no-message">
                    <div class="no-message-text">
                        No message yet, Start a conversation...
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="chat-typing">
                <div class="typing-input">
                    <textarea id='message'></textarea>
                </div>
                <div class="typing-send">
                    <button class="typing-send-btn">Send</button>
                </div>
            </div>
        </div>
    </div>
</body>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
let sendBtn = document.querySelector('.typing-send-btn');
let chatBox = document.querySelector('#chat-content');
let inputChat = document.querySelector('#message')

function sendMessage() {
    inputChat.value = '';
}


// let scrollDown = function() {
//     chatBox.scrollTop = chatBox.scrollHeight;
// }

let scrollDown = function() {
    let chatBox = document.querySelector('#chat-content');
    chatBox.scrollTop = chatBox.scrollHeight;
}

scrollDown();

$(document).ready(function() {

    $(".typing-send-btn").on('click', function() {
        message = $("#message").val()
        if (message == "") return

        $.post("/comp1841/chat/sql/insert.php", {
            message: message,
            to_id: <?php echo $chatWith['id']; ?>
        }, function(data, status) {
            $('#message').val();
            $("#chat-content").append(data);
            scrollDown();
        })

    });

    let lastSeenUpdate = function() {
        $.get('/comp1841/chat/sql/lastSeenUpdate.php');
    }
    lastSeenUpdate();
    setInterval(lastSeenUpdate, 10000);

    // auto refresh / reload
    let fechData = function() {
        $.post("/comp1841/chat/sql/getMessage.php", {
                id_2: <?= $chatWith['id'] ?>
            },
            function(data, status) {
                $("#chat-content").append(data);
                if (data != "") scrollDown();
            });
    }

    fechData();
    /** 
    auto update last seen 
    every 0.5 sec
    **/
    setInterval(fechData, 500);
});
</script>


</html>