<?php
require '../includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['post_id'])) {
    $post_id = $_GET['post_id'];

    $sql = "SELECT * FROM post WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->bind_param('i', $post_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $title = $row['title'];
        $category = $row['category'];
        $content = $row['content'];

        $isUpdate = true;
    } else {
        echo "Post not found.";
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $post_id = $_POST['post_id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $content = $_POST['content'];

    if (isset($_FILES['upload_file']) && $_FILES['upload_file']['name'] !== '') {
        $image = $_FILES['upload_file']['name'];
        $image_temp = $_FILES['upload_file']['tmp_name'];
        $imagelocation = '../images/' . $image;
        $move = move_uploaded_file($image_temp, $imagelocation);

        $sql = "UPDATE post SET title = ?, category = ?, content = ?, imagepath = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('ssssi', $title, $category, $content, $image, $post_id);
    } else {
        $sql = "UPDATE post SET title = ?, category = ?, content = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param('sssi', $title, $category, $content, $post_id);
    }

    if ($stmt->execute()) {
        echo "Post updated successfully.";
    } else {
        echo "Error updating post: " . $stmt->error;
    }

    $stmt->close();
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
    <script src="https://cdn.ckeditor.com/4.21.0/standard/ckeditor.js"></script>

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
        <?php if (isset($isUpdate) && $isUpdate) { ?>
            <h1 class="text-4xl text-white font-bold text-center uppercase mb-2">Update post</h1>
            <form action="updatepost.php" method="post" enctype="multipart/form-data" class="py-[4%] px-[10%] md:px-[2%] md:py-[1%]">
                <div class="flex flex-col rounded bg-[#0a0a0a] shadow-xl overflow-hidden p-5 lg:p-6 grow w-full">
                    <div class="sm:p-5 lg:px-10 lg:py-8 space-y-6">
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                        <div class="left_come space-y-1">
                            <label for="title" class="text-lg text-white capitalize">Post Title:</label>
                            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <div class="right_come space-y-1">
                            <label for="category" class="text-lg text-white capitalize">Post Category:</label>
                            <input type="text" id="category" name="category" value="<?php echo $category; ?>" required class="block focus:border-blue-600 focus:outline-none focus:ring-0 text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <div class="left_come space-y-1">
                            <label for="content" class="text-lg text-white capitalize">Post Content:</label>
                            <textarea id="content" name="content" rows="5" required class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0"><?php echo $content; ?></textarea>
                            <script>
                                CKEDITOR.replace( 'content' );
                            </script>
                        </div>
                        <div class="right_come space-y-1">
                            <label for="upload" class="text-lg text-white capitalize">Upload Image:</label>
                            <input type="file" id="upload" name="upload_file" accept="image/*" class="focus:border-blue-600 focus:outline-none focus:ring-0 block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none">
                        </div>
                        <div>
                            <input type="submit" value="Update Post" class="buttonhover mt-9 left_come inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-4 leading-6 rounded text-white border-none outline-none bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">
                        </div>
                    </div>
                </div>
            </form>
        <?php } ?>
    </div>
</body>

</html>
