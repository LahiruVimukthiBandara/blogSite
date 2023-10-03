<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $post_sql = "SELECT * FROM post WHERE id = ?";
    $post_stmt = $db->prepare($post_sql);
    $post_stmt->bind_param('i', $post_id);
    $post_stmt->execute();
    $post_result = $post_stmt->get_result();
    $post = $post_result->fetch_assoc();

    $post_stmt->close();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_comment'])) {
    $comment_id = $_POST['comment_id'];

    $post_id = $_POST['post_id'];

    $delete_comment_sql = "DELETE FROM comment WHERE id = ?";
    $delete_comment_stmt = $db->prepare($delete_comment_sql);
    $delete_comment_stmt->bind_param('i', $comment_id);

    if ($delete_comment_stmt->execute()) {

        header("Location: viewcomments.php?post_id=$post_id");
        exit();
    } else {
        echo "Error deleting comment: " . $delete_comment_stmt->error;
    }

    $delete_comment_stmt->close();
}


$comments_sql = "SELECT * FROM comment WHERE post_id = ?";
$comments_stmt = $db->prepare($comments_sql);
$comments_stmt->bind_param('i', $post_id);
$comments_stmt->execute();
$comments_result = $comments_stmt->get_result();
$comments = $comments_result->fetch_all(MYSQLI_ASSOC);

$comments_stmt->close();

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comments</title>
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
    .buttonhover{
        transition: 0.3s ease-in-out;
      }
    .buttonhover:hover{
        transform: scale(1.07);
      }
    </style>

</head>

<body class="bg-[#000000]">
    <div class="py-[4%] px-[10%] md:px[2%] md:py[1%]">
        <div class="container mx-auto p-4">
            <h2 class="text-white text-3xl font-semibold mb-5">Post Title  : <?php echo $post['title']; ?></h2>

            <h3 class=" text-yellow-400 text-2xl font-semibold mb-3">Comments :</h3>
            <?php if (!empty($comments)) { ?>
                <ul>
                    <?php foreach ($comments as $comment) { ?>
                        <li class=" bg-[#0a0a0a] py-1 px-3 rounded-md mb-1">
                            <p class="text-white text-lg ml-7 mt-4"><?php echo $comment['coment']; ?></p>
                            <form action="" method="POST" style="display: inline;">
                                <input type="hidden" name="comment_id" value="<?php echo $comment['id']; ?>">
                                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                                <button class="buttonhover bg-gradient-to-r from-red-500 to-yellow-600 hover:bg-gradient-to-bl  py-2 px-4 mb-2 text-white rounded-md font-semibold mt-3" type="submit" name="delete_comment" onclick="return confirm('Are you sure you want to delete this comment?')">Delete</button>
                            </form>
                        </li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p class=" text-white text-xl font-semibold">No Comments found.</p>
            <?php } ?>
        </div>
    </div>
</body>

</html>
