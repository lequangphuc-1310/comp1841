<?php

session_start();

# check if the user is logged in
if (isset($_SESSION['user_id'])) {
    # check if the key is submitted
    if (isset($_POST['key'])) {
        include '/xampp/htdocs/comp1841/auth/connection.php';

        # creating simple search algorithm :) 
        $key = "%{$_POST['key']}%";

        $sql = "SELECT * FROM `user` WHERE name LIKE '$key'";
        // $stmt = $conn->prepare($sql);
        // $stmt->execute([$key]);
        $stmt = $conn->query($sql);

        if ($stmt->rowCount() > 0) {
            $users = $stmt->fetchAll();

            foreach ($users as $user) {
                if ($user['id'] == $_SESSION['user_id']) continue;
?>
<li class="each-user-search">
    <a href="/comp1841/chat/chat.php?user=<?php echo $user['id']; ?>">
        <div class="each-user-search-child">
            <div class='img-user-search'
                style="background: url(/comp1841/crud/user/uploads/<?php echo $user['image']; ?>) no-repeat center center; width: 50px; height: 50px; border-radius: 50%;">
            </div>
            <h3><?php echo $user['name']; ?></h3>
        </div>
        <div>
    </a>
</li>
<?php }
        } else { ?>
<div class="message-no-result">
    <i class="fa fa-user-times d-block fs-big"></i>
    The user "<?= htmlspecialchars($_POST['key']) ?>"
    is not found.
</div>
<?php }
    }
}