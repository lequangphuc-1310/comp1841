<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_id'])) {

    if (isset($_POST['id_2'])) {
        include '/xampp/htdocs/comp1841/auth/connection.php';


        $id_1  = $_SESSION['user_id'];
        $id_2  = $_POST['id_2'];
        $opend = 0;

        $sql = "SELECT * FROM chats
	        WHERE to_id=?
	        AND   from_id= ?
	        ORDER BY chat_id ASC";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$id_1, $id_2]);

        if ($stmt->rowCount() > 0) {
            $chats = $stmt->fetchAll();

            # looping through the chats
            foreach ($chats as $chat) {
                if ($chat['opened'] == 0) {

                    $opened = 1;
                    $chat_id = $chat['chat_id'];

                    $sql2 = "UPDATE chats
	    		         SET opened = ?
	    		         WHERE chat_id = ?";
                    $stmt2 = $conn->prepare($sql2);
                    $stmt2->execute([$opened, $chat_id]);

?>
<div class="chat-content-other-container">
    <div class="chat-content-other">
        <div class="chat-child">
            <p><?php echo $chat['message']; ?>
            </p>
            <small class=''><?php echo $chat['created_at']; ?></small>
        </div>
    </div>
</div>
<?php
                }
            }
        }
    }
}