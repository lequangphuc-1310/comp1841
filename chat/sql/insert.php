<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_id'])) {

    if (
        isset($_POST['message']) &&
        isset($_POST['to_id'])
    ) {
        include '/xampp/htdocs/comp1841/auth/connection.php';


        # get data from XHR request and store them in var
        $message = $_POST['message'];
        $to_id = $_POST['to_id'];

        # get the logged in user's username from the SESSION
        $from_id = $_SESSION['user_id'];

        $sql = "INSERT INTO 
	       chats (from_id, to_id, message) 
	       VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $res  = $stmt->execute([$from_id, $to_id, $message]);

        # if the message inserted
        if ($res) {
            /**
       check if this is the first
       conversation between them
             **/
            $sql2 = "SELECT * FROM conversations
               WHERE (user_1=? AND user_2=?)
               OR    (user_2=? AND user_1=?)";
            $stmt2 = $conn->prepare($sql2);
            $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);

            // setting up the time Zone
            // It Depends on your location or your P.c settings
define('TIMEZONE', 'Asia/Ho_Chi_Minh');
        
            date_default_timezone_set(TIMEZONE);

            $time = date("h:i:s a");

            if ($stmt2->rowCount() == 0) {
                # insert them into conversations table 
                $sql3 = "INSERT INTO 
			         conversations(user_1, user_2)
			         VALUES (?,?)";
                $stmt3 = $conn->prepare($sql3);
                $stmt3->execute([$from_id, $to_id]);
            }
?>

<div class="chat-content-you-container">
    <div class="chat-content-you">
        <div class="chat-child">
            <p><?php echo $message; ?>
            </p>
            <small class=''><?php echo $time; ?></small>
        </div>
    </div>
</div>

<?php
        }
    }
}