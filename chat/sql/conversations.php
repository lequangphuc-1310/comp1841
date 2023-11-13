<?php

function getConversation($id, $conn)
{
    // Getting all the conversations for current (logged in) user
    $sql = "SELECT * FROM conversations
                WHERE user_1=? OR user_2=?
                ORDER BY conversation_id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([$id, $id]);

    if ($stmt->rowCount() > 0) {
        $conversations = $stmt->fetchAll();

        // creating empty array to store the user conversation
        $user_data = [];

        # looping through the conversations
        foreach ($conversations as $conversation) {
            # if conversations user_1 row equal to id
            if ($conversation['user_1'] == $id) {
                $sql2  = "SELECT *
            	          FROM user WHERE id=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$conversation['user_2']]);
            } else {
                $sql2  = "SELECT *
            	          FROM user WHERE id=?";
                $stmt2 = $conn->prepare($sql2);
                $stmt2->execute([$conversation['user_1']]);
            }

            $allConversations = $stmt2->fetchAll();

            # pushing the data into the array 
            array_push($user_data, $allConversations[0]);
        }
        return $user_data;
    } else {
        $conversations = [];
        return $conversations;
    }
}
