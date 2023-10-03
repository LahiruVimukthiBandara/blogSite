<?php
require '../includes/db.php';

$blockMessage = '';

// Block or unblock user
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $user_id = $_POST['user_id'];
    $action = $_POST['action'];

    if ($action === 'block') {
        $block_user_sql = "UPDATE register SET status = 'blocked' WHERE id = ?";
        $block_user_stmt = $db->prepare($block_user_sql);
        $block_user_stmt->bind_param('i', $user_id);

        if ($block_user_stmt->execute()) {
            $blockMessage = "User blocked successfully.";
        } else {
            $blockMessage = "Error blocking user: " . $block_user_stmt->error;
        }

        $block_user_stmt->close();
    } elseif ($action === 'unblock') {
        $unblock_user_sql = "UPDATE register SET status = 'unblocked' WHERE id = ?";
        $unblock_user_stmt = $db->prepare($unblock_user_sql);
        $unblock_user_stmt->bind_param('i', $user_id);

        if ($unblock_user_stmt->execute()) {
            $blockMessage = "User unblocked successfully.";
        } else {
            $blockMessage = "Error unblocking user: " . $unblock_user_stmt->error;
        }

        $unblock_user_stmt->close();
    }
}

$sql = "SELECT * FROM register";
$result = $db->query($sql);

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
        .buttonhover {
            transition: 0.3s ease-in-out;
        }

        .buttonhover:hover {
            transform: scale(1.07);
        }
    </style>

</head>

<body class="bg-[#000000]">

    <div class="py-[4%] px-[10%] md:px[2%] md:py[1%]">

        <h1 class="text-3xl text-white text-center font-bold mb-6 uppercase">
            <?php echo $result->num_rows; ?> Registered Users
        </h1>
        <h1 class=" py-2 px-4 bg-slate-500 text-sm">
        <a href="admin_dashboard.php">To dashboard</a>
        </h1>
        

        <?php if (!empty($blockMessage)) { ?>
            <p class="text-white text-xl font-semibold"><?= $blockMessage ?></p>
        <?php } ?>

        <?php if ($result->num_rows > 0) { ?>

            <table class="min-w-full bg-[#0a0a0a] border-none rounded-lg">
                <tbody>
                    <tr class="bg-[#161616]">
                        <th class="text-2xl text-end px-6 py-3 capitalize">
                            <p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">
                                Profile
                            </p>
                        </th>
                        <th class="text-2xl text-end px-6 py-3 capitalize">
                            <p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">
                                Name
                            </p>
                        </th>
                        <th class="text-2xl text-end px-6 py-3 capitalize">
                            <p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">
                                Email
                            </p>
                        </th>
                        <th class="text-2xl text-end px-6 py-3 capitalize">
                            <p class="bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">
                                Action
                            </p>
                        </th>
                    </tr>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>
                            <td class="py-4 px-6 border-b text-white text-lg capitalize font-semibold">
                                <img class="mr-3 w-10 h-10 rounded-full object-cover object-center" src="../<?= $row['image'] ?>">
                            </td>
                            <td class="py-4 px-6 border-b text-white text-lg capitalize font-semibold"><?= $row['name']; ?></td>
                            <td class="py-4 px-6 border-b text-white text-lg capitalize font-semibold"><?= $row['email']; ?></td>
                            <td class="py-4 px-6 border-b text-white text-lg capitalize font-semibold">
                                <form method="POST" action="" enctype="multipart/form-data">
                                    <input type="hidden" name="user_id" value="<?= $row['id']; ?>">

                                    <?php if ($row['status'] === 'blocked') { ?>
                                        <button type="submit" name="action" value="unblock" class="buttonhover border-none text-lg text-white bg-gradient-to-r from-green-500 to-blue-600 hover:bg-gradient-to-bl transition-all ease-in-out px-4 py-2 rounded-md">
                                            Unblock User
                                        </button>
                                    <?php } else { ?>
                                        <button type="submit" name="action" value="block" class="buttonhover border-none text-lg text-white bg-gradient-to-r from-red-500 to-yellow-600 hover:bg-gradient-to-bl transition-all ease-in-out px-4 py-2 rounded-md">
                                            Block User
                                        </button>
                                    <?php } ?>

                                </form>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p class="text-white text-xl font-semibold">No registered users found.</p>
        <?php } ?>
    </div>
</body>

</html>

<?php
$db->close();
?>
