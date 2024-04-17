<?php
// Start output buffering
ob_start();
include "/xampp/htdocs/comp1841/crud/nav/nav.php";
include("/xampp/htdocs/comp1841/auth/connection.php");
include("/xampp/htdocs/comp1841/toast/toast.php");

// Pagination settings
$records_per_page = 5;
$page = isset($_GET['page']) && is_numeric($_GET['page']) ? $_GET['page'] : 1;

// Calculate the limit clause for SQL
$limit = ($page - 1) * $records_per_page;

// Query to fetch posts for the current page
$sql = "SELECT user.image, user.name, user.email, post.title, post.details, post.id, post.published_at, post.module, post.imagePost, module.module_name
        FROM `user`, `post`
        LEFT JOIN `module` ON post.module = module.id
        WHERE post.user_id=user.id
        ORDER BY post.id DESC
        LIMIT :limit, :per_page";

// Prepare and execute the query
$stmt = $conn->prepare($sql);
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count total number of records
$total_records = $conn->query("SELECT COUNT(*) FROM post")->fetchColumn();

// Calculate total pages
$total_pages = ceil($total_records / $records_per_page);

// Output buffering end
ob_end_flush();

// Function to insert answer into the database
function insertAnswer($conn, $user_id, $post_id, $answer, $module)
{
    $sql = "INSERT INTO answer (user_id, post_id, answer, module) VALUES (:user_id, :post_id, :answer, :module)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':post_id', $post_id, PDO::PARAM_INT);
    $stmt->bindParam(':answer', $answer, PDO::PARAM_STR);
    $stmt->bindParam(':module', $module, PDO::PARAM_STR);
    return $stmt->execute();
}


// Check if the form is submitted
if (isset($_POST['submit_answer'])) {
    $user_id = $_SESSION['user_id'];
    $answer = $_POST['answer'];
    // Pass PHP variables to JavaScript
    $post_id = $_POST['post_id'];
    $module = isset($_POST['moduleID']);
    if (!empty($posts) && isset($posts[0]['id']) && isset($module)) {
        if (insertAnswer($conn, $user_id, $post_id, $answer, $module)) {
            // Redirect to the same page to refresh the content
            echo "<script>window.location.href='/comp1841/crud/home/home.php';</script>";
            exit();
        } else {
            echo "Failed to submit answer.";
        }
    } else {
        echo "No post found.";
    }
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" type="text/css" href="./home.css?v=<?php echo time(); ?>" />
</head>

<body>
    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
            /* Adjust as needed */
        }

        .pagination a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            margin: 0 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .pagination a.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

        .pagination a:hover {
            background-color: #f0f0f0;
        }

        .each-answer-container {
            padding: 10px;
            border: 1px solid lightgreen;
            box-shadow: 0 0 5px #007bff;
            margin-top: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }
    </style>
    <div class="background">
        <div class="container">
            <div class="body">
                <div class="content">
                    <?php foreach ($posts as $post) { ?>
                        <div class="each-post">
                            <h3 style='font-size: 32px'><?php echo $post['title']; ?></h3>
                            <p style='font-size: 24px'><?php echo $post['details']; ?></p>
                            <?php if ($post['imagePost']) { ?>
                                <img class='image-post' src="/comp1841/crud/askPage/uploads/<?php echo $post['imagePost']; ?>" alt="Post Image">
                            <?php } ?>
                            <div class="post-content">
                                <p style='color:gray'><?php echo $post['published_at']; ?></p>
                                <div class="post-content-trivia">
                                    <p><?php echo $post['module_name']; ?></p>
                                    <p style='font-weight: 600'><?php echo $post['name']; ?></p>
                                </div>
                                <img class='image-author-post' src="/comp1841/crud/user/uploads/<?php echo $post['image']; ?>" alt="Author Image">
                            </div>
                            <div class="answer">
                                <?php
                                // Query to fetch answers for the current post
                                $sql2 = "SELECT 
            answer.answer, answer.id As answerID,
            user.name AS user_name, 
            user.email AS user_email, 
            user.image AS user_image,
            user.id AS author_id
         FROM 
            answer 
         LEFT JOIN 
            user ON answer.user_id = user.id 
         WHERE 
            answer.post_id = :postId";

                                // Prepare and execute the query
                                $stmt = $conn->prepare($sql2);
                                $stmt->bindParam(':postId', $post['id']);
                                $stmt->execute();
                                $answerPosts = $stmt->fetchAll(PDO::FETCH_ASSOC);

                                // Output answers
                                foreach ($answerPosts as $answer) {
                                ?>
                                    <div class='each-answer-container'>
                                        <img class='image-author-post' src="/comp1841/crud/user/uploads/<?php echo $answer['user_image']; ?>" alt="User Image">
                                        <p><?php echo $answer['answer']; ?></p>
                                        <p>User Name: <?php echo $answer['user_name']; ?></p>
                                        <p>User Email: <?php echo $answer['user_email']; ?></p>
                                        <p>answer id: <?php echo $answer['author_id']; ?></p>
                                        <p>curr user id: <?php echo $_SESSION['user_id']; ?></p>
                                        <?php if ($_SESSION['user_id'] === $answer['author_id']) { ?>
                                            <a href="/comp1841/crud/home/answerEdit.php?answerId=<?php echo  $answer['answerID']; ?>"><button>Edit</button></a>
                                            <a href="/comp1841/crud/delete.php?postId=<?php echo  $post['id']; ?>"><button>Delete</button></a>
                                        <?php } ?>
                                    </div>
                                <?php
                                }
                                ?>
                                <form method="post">
                                    <textarea name="answer" placeholder="Answer this..."></textarea>
                                    <input type='hidden' name="post_id" value="<?php echo $post['id']; ?>">
                                    <input type='hidden' name="moduleID" value="<?php echo $post['module']; ?>">
                                    <div style='display: flex; justify-content: end'>
                                        <button type="submit" name="submit_answer">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- Pagination links -->
                <div class="pagination">
                    <?php if ($page > 1) { ?>
                        <a href="?page=<?php echo ($page - 1); ?>" class="btn-blue">&laquo; Prev</a>
                    <?php } ?>
                    <?php for ($i = 1; $i <= $total_pages; $i++) { ?>
                        <a href="?page=<?php echo $i; ?>" class="<?php if ($page == $i) echo 'active'; ?>"><?php echo $i; ?></a>
                    <?php } ?>
                    <?php if ($page < $total_pages) { ?>
                        <a href="?page=<?php echo ($page + 1); ?>" class="btn-blue">Next &raquo;</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>