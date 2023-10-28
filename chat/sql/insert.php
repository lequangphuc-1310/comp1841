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
	       `chats` (from_id, to_id, message) 
	       VALUES ($from_id, $to_id, '$message')";
        // $stmt = $conn->prepare($sql);
        // $res  = $stmt->execute([$from_id, $to_id, $message]);
        $data = $conn->query($sql);

        # if the message inserted
        if ($data) {
            /**
       check if this is the first
       conversation between them
             **/
            $sql2 = "SELECT * FROM `conversations`
               WHERE (user_1=$from_id AND user_2=$to_id)
               OR    (user_2=$from_id AND user_1=$to_id)";
            // $stmt2 = $conn->prepare($sql2);
            // $stmt2->execute([$from_id, $to_id, $from_id, $to_id]);
            $data2 = $conn->query($sql2);

            // setting up the time Zone
            // It Depends on your location or your P.c settings
            define('TIMEZONE', 'Asia/Ho_Chi_Minh');

            date_default_timezone_set(TIMEZONE);

            $time = date("h:i:s a");

            if ($data2->rowCount() == 0) {
                echo '<script>console.log("dell co")</script>';
                # insert them into conversations table 
                $sql3 = "INSERT INTO 
			         `conversations`(user_2, user_1)
			         VALUES ($from_id,$to_id)";
                // $stmt3 = $conn->prepare($sql3);
                // $stmt3->execute([$from_id, $to_id]);
                $data3 = $conn->query($sql3);
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
