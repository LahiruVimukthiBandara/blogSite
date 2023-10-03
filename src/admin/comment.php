<?php
require '../includes/db.php';

$sql = "SELECT * FROM post ORDER BY createdat DESC";
$result = $db->query($sql);

$posts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}

$postCount = count($posts); 

$deleteMessage = '';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $delete_post_id = $_GET['post_id'];

    $delete_sql = "DELETE FROM post WHERE id = ?";
    $delete_stmt = $db->prepare($delete_sql);
    $delete_stmt->bind_param('i', $delete_post_id);

    if ($delete_stmt->execute()) {
        $deleteMessage = "Post deleted successfully.";
        header("Location: {$_SERVER['PHP_SELF']}");
        exit();
    } else {
        $deleteMessage = "Error deleting post: " . $delete_stmt->error;
    }

    $delete_stmt->close();
}

$db->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            <h1 class="text-3xl text-white text-center font-bold mb-6 uppercase">
            <span class="text-3xl text-yellow-400">( <?php echo $postCount; ?> )</span> published posts 
            </h1>

            <?php if (!empty($deleteMessage)) { ?>
            <div class="bg-green-500 text-white px-4 py-2 mb-4"><?php echo $deleteMessage; ?></div>
            <?php } ?>

            <?php if (!empty($posts)) { ?>
            <table class="min-w-full bg-[#0a0a0a] border-none rounded-lg ">

                <tbody>
                    <tr class="bg-[#161616] ">
                        <th class=" text-2xl text-start px-6 py-3 capitalize"><p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md">post Title</p></th>
                        <th class=" text-2xl text-end px-6 py-3 capitalize"><p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md">post Title</p></th>
                    </tr>
                    <?php foreach ($posts as $post) { ?>
                    <tr>
                        <td class="py-4 px-6  border-b text-white text-2xl capitalize font-semibold"><?php echo $post['title']; ?></td>
                        <td class="py-4 px-6 border-b text-end">
                            <a href="viewcomments.php?post_id=<?php echo $post['id']; ?>">
                                <button class="buttonhover border-none text-lg text-white transition-all ease-in-out px-4 py-2 rounded-md bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">View Comments</button>
                            </a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>

            </table>
            <?php } else { ?>
            <p class=" text-white text-xl font-semibold">No posts found.</p>
            <?php } ?>
        </div>
    </div>
</body>

</html>
