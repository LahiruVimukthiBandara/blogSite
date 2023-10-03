<?php
require '../includes/db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    // Prepare and bind the SQL statement to fetch admin credentials from the database
    $stmt = $db->prepare("SELECT * FROM admindata WHERE userName = ?");
    $stmt->bind_param("s", $inputUsername);

    // Execute the prepared statement
    $stmt->execute();

    // Store the result
    $result = $stmt->get_result();

    // Check if the admin exists
    if ($result->num_rows === 1) {
        $admin = $result->fetch_assoc();
        $adminUsername = $admin['userName'];
        $adminPassword = $admin['password'];

        // Verify the entered password against the stored password
        if ($inputPassword === $adminPassword) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_username'] = $adminUsername;
            header("Location: admin_dashboard.php");
            exit();
        } else {
            echo '<script>alert("Invalid username or password. Please try again.");</script>';;
        }
    } else {
        echo '<script>alert("Invalid username or password. Please try again.");</script>';
    }

    // Close the prepared statement
    $stmt->close();
}
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

  <section class="bg-[#000000]">
  <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
      <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900">
        <img class="cursor-default h-[55px] m-auto mb-10" src="../assets/img/logo.png" alt="logo">
      </a>
      <div class="w-full rounded-lg shadow border-none outline-none md:mt-0 sm:max-w-md xl:p-0 bg-[#0a0a0a]">
          <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
              <h1 class="text-xl mb-10 font-bold leading-tight tracking-tight text-white md:text-2xl text-center capitalize">
                  admin login
              </h1>
              <form class="space-y-4 md:space-y-6"  method="post" action="">
                  <div>
                      <label for="username" class="block mb-2 text-lh font-medium text-white capitalize">anmin username</label>
                      <input type="text" name="username" id="username" class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" placeholder="Username" required="">
                  </div>
                  <div>
                      <label for="password" class="block mb-2 text-sm font-medium text-white capitalize">admin Password</label>
                      <input type="password" name="password" id="password" placeholder="Password" class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" required="">
                  </div>
                  <button type="submit" class="buttonhover w-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl font-medium rounded-lg text-sm px-5 py-4 text-center capitalize">login</button>
              </form>
          </div>
      </div>
  </div>
</section>

</body>
</html>