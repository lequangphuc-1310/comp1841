<link rel="stylesheet" type="text/css" href="/comp1841/chat/homeChat.css?v=<?php echo time(); ?>" />

<?php
// include '/xampp/htdocs/comp1841/auth/functions.php';
include '/xampp/htdocs/comp1841/chat/sql/conversations.php';
include '/xampp/htdocs/comp1841/chat/sql/lastMessage.php';
$_SESSION['user_id'] = $user_data['id'];
$thisUserId = $_SESSION['user_id'];
$conversations = getConversation($thisUserId, $conn);
?>

<div class="chatArea-body">
    <div class="chat-container">
        <div class='exit' onclick='toggleOpenChat()'><i class="fas fa-times"></i></div>
        <div class="up-container">
            <div class="inputSearchUser">
                <input type="text" placeholder="Search..." id="searchText" class="form-control">
                <button class="searchBtn">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>
        <div class="down-container">
            <div class="down">
                <div class="content">
                    <ul id="search-each-user-container">
                        <?php if (!empty($conversations)) { ?>
                            <?php foreach ($conversations as $conversation) {
                            ?>
                                <a href="/comp1841/chat/chat.php?user=<?php echo $conversation['id']; ?>">
                                    <li class="each-user-search">

                                        <div class="each-user-search-child">
                                            <div class='img-user-search' style="background: url(/comp1841/crud/user/uploads/<?php echo $conversation['image']; ?>) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;">
                                            </div>
                                            <div class="user-status">
                                                <h3><?php echo $conversation['name']; ?></h3>
                                                <small>
                                                    <?php echo lastChat($_SESSION['user_id'], $conversation['id'], $conn); ?>
                                                </small>
                                            </div>
                                            <?php if (last_seen($conversation['last_seen']) == "Active") {
                                                echo "
                                                <div class='online-container' title='online'>
                                        <div class='online'></div>
                                    </div>
                                                ";
                                            } ?>
                                        </div>

                                        <div>
                                    </li>
                                </a>
                            <?php } ?>
                        <?php } else { ?>
                            <div class="no-message">
                                <div class="no-message-text">
                                    Search a user...
                                </div>
                            </div>
                        <?php } ?>
                    </ul>
                </div>
                <!-- <div class="typing">
                    <div class="typing-input">
                        <input />
                    </div>
                    <div class="typing-send">
                        <button class="typing-send-btn">Send</button>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
</div>
</div>

<script>
    function toggleOpenChat() {
        let areaText = document.getElementById('chatArea');
        let btnChat = document.getElementsByClassName('btnChat');
        if (areaText.style.display === "none") {
            areaText.style.display = "block";
        } else {
            areaText.style.display = "none";
        }
    }
</script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        // search users by input
        $('#searchText').on("input", function() {
            var searchText = $(this).val();
            console.log(searchText);

            if (searchText == "") return 0;
            else {
                $.post('/comp1841/chat/sql/search.php', {
                        key: searchText
                    },
                    function(data, status) {
                        $("#search-each-user-container").html(data);
                    });
            }
        })
        // search user by button
        $("#searchBtn").on("click", function() {
            var searchText = $("#searchText").val();
            if (searchText == "") return;
            else {
                $.post('/comp1841/chat/sql/search.php', {
                        key: searchText
                    },
                    function(data, status) {
                        $("#search-each-user-container").html(data);
                    });
            }
        });


        let lastSeenUpdate = function() {
            $.get('/comp1841/chat/sql/lastSeenUpdate.php');
        }
        lastSeenUpdate();
        setInterval(lastSeenUpdate, 10000);
    })
</script>