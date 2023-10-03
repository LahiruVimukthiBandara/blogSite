<?php
require '../includes/db.php';
session_start();

// Check if the user is not logged in, redirect them to the login page
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.php");
    exit();
}

// The user is logged in, you can access the admin's username using $_SESSION['admin_username']
$adminUsername = $_SESSION['admin_username'];

// Check if the logout action is triggered
if (isset($_GET['action']) && $_GET['action'] === 'logout') {
    // Destroy all session data
    session_destroy();

    // Redirect the user to the login page after logout
    header("Location: admin_login.php");
    exit();
}

//subscriber count
require('../includes/db.php');
$subsql = "SELECT * FROM subscribe";
$subresult = $db->query($subsql);
$subcount = array();
if ($subresult->num_rows > 0) {
    while ($subrow = $subresult->fetch_assoc()) {
        $subcount[] = $subrow;
    }
}
$subscribers = count($subcount);

//post count
$sql = "SELECT * FROM post";
$result = $db->query($sql);
$posts = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }
}
$postCount = count($posts);

//user count
$usersql = "SELECT * FROM register";
$userresults = $db->query($usersql);
$users = array();
if ($userresults->num_rows > 0) {
    while ($userraw = $userresults->fetch_assoc()) {
        $users[] = $userraw;
    }
}
$usercount = count($users);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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

        <div class="text-white text-5xl text-center font-semibold mb-5">
            <img class="cursor-default h-[55px] m-auto mb-10" src="../assets/img/logo.png" alt="logo">
        </div>

        <!-- count posts and subscribers -->
        <div class=" mt-6 py-5 text-start flex justify-between">
            <h2 class="text-lg lg:text-2xl text-white capitalize"><span class="text-yellow-300"><?php echo $subscribers; ?> </span>subscribers</h2>
            <h2 class="text-lg lg:text-2xl text-white capitalize"><span class="text-yellow-300"><?php echo $postCount; ?> </span> posts published</h2>
            <h2 class="text-lg lg:text-2xl text-white capitalize"><span class="text-yellow-300"><?php echo $usercount; ?> </span> user accounts</h2>
            <!-- Logout button -->
            <a href="admin_dashboard.php?action=logout" class="logout-button text-white font-semibold ">
                <button class="bg-white px-4 py-2 float-right flex bg-gradient-to-r from-red-500 to-yellow-600 hover:bg-gradient-to-bl rounded-md buttonhover">
                    Logout
                </button>
            </a>
        </div>
        <!-- end count posts and subscribers -->
        <div class="container mx-auto grid sm:grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 pt-6 gap-8 mt-10">
            <a href="addpost.php">
                <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> add post </h2>
                </div>
            </a>
            <a href="viewposts.php">
                <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> manage posts </h2>
                </div>
            </a>
            <a href="comment.php">
                <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> manage comments </h2>
                </div>
            </a>
            <a href="viewusers.php">
                <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> manage users </h2>
                </div>
            </a>
            <a href="contactdetails.php">
                <div class="rounded bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> messages </h2>
                </div>
            </a>
            <a href="sendemails.php">
                <div class="rounded bg-gradient-to-r from-green-500 to-yellow-800 hover:bg-gradient-to-bl buttonhover outline-none border-none h-24 text-center flex items-center justify-center">
                    <h2 class="capitalize text-2xl font-semibold text-white"> click to send notification </h2>
                </div>
            </a>
        </div>

    </div>
</body>

</html>