<?php
function getUser($id, $conn)
{
    $sql = "SELECT * FROM user 
			WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$id]);

    if ($stmt->rowCount() === 1) {
        $user = $stmt->fetch();
        return $user;
    } else {
        $user = [];
        return $user;
    }
}
