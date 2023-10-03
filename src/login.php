<?php
include 'includes/db.php';
include 'includes/functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $sql = "SELECT * FROM register WHERE email = '$email' AND password = '$password'";
    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        if ($row['status'] == 'blocked') {
            echo '<script>alert("Your account has been blocked. Please contact the administrator.");</script>';
        } else {
            session_start();

            $_SESSION['name'] = $row['name'];
            $_SESSION['image'] = $row['image'];
            $_SESSION['id'] = $row['id'];

            $name = $_SESSION['name'];
            $imagepath = $_SESSION['image'];
            $id = $_SESSION['id'];

            header("Location: index.php");
            exit();
        }
    } else {
        echo '<script>alert("Invalid username or password. Please try again.");</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="dist/output.css">
    <link rel="stylesheet" href="dist/style.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/scrollreveal"></script>

    <style>
      @import url('https://fonts.cdnfonts.com/css/arial-rounded-mt-bold');
      body{
        font-family: "Arial Rounded MT Bold", sans-serif;
      }
      html{
        scroll-behavior: smooth;
      }
      .cardhover{
        transition: 0.2s ease-in-out;
      }
      .cardhover:hover{
        transform: translateY(-2px) scale(1.01);
      }
      .iconhover{
        transition: 0.2s ease-in-out;
      }
      .iconhover:hover{
        transform: scale(1.1);
      }
      .buttonhover{
        transition: 0.3s ease-in-out;
      }
      .buttonhover:hover{
        transform: scale(1.07);
      }
      .typing-animation::after {
        content: "|";
        animation: typing 1s steps(1) infinite;
      }
      @keyframes typing {
        0% { opacity: 0; }
        50% { opacity: 1; }
        100% { opacity: 0; }
      }
    </style>
</head>

<body class="bg-[#000000] ">

<!-- sign in page -->
<div id="page-container" class="bottom_come flex flex-col mx-auto w-full min-h-screen">
    <!-- Page Content -->
    <main id="page-content" class="flex flex-auto flex-col max-w-full">
      <div class="min-h-screen flex items-center justify-center relative overflow-hidden max-w-10xl mx-auto p-4 lg:p-8 w-full">
        <!-- Patterns Background -->
        <div class="pattern-dots-md text-gray-300 absolute top-0 right-0 w-32 h-32 lg:w-48 lg:h-48 transform translate-x-16 translate-y-16"></div>
        <div class="pattern-dots-md text-gray-300 absolute bottom-0 left-0 w-32 h-32 lg:w-48 lg:h-48 transform -translate-x-16 -translate-y-16"></div>
        <!-- END Patterns Background -->
  
        <!-- Sign In Section -->
        <div class="py-6 lg:py-0 w-full md:w-8/12 lg:w-6/12 xl:w-4/12 relative">
          <!-- Header -->
          <div class="mb-8 text-center">
            <h1 class="top_come text-4xl font-bold inline-flex items-center mb-1 space-x-3">
                <a href="" class="inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-blue-600 hover:text-blue-400">
                    <img class="top_come h-[45px]" src="assets/img/logo.png" alt="logo">
                  </a>
            </h1>
            <p class="top_come text-white text-2xl mt-3">
              Welcome
            </p>
            <p class="top_come text-white text-lg ">
              please sign in to your Account
            </p>
          </div>
          <!-- END Header -->
    
          <!-- Sign In Form -->
          <div class="flex flex-col rounded bg-[#0a0a0a] shadow-xl overflow-hidden">
            <div class="p-5 lg:p-6 grow w-full">
              <div class="sm:p-5 lg:px-10 lg:py-8">
                <form action="#" method="post" enctype="multipart/form-data" class="space-y-6">

                    <!-- email feild -->
                  <div class="left_come space-y-1">
                    <label for="email" class="font-lg text-white">Email</label>
                    <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="email" id="email" name="email" placeholder="Enter your email">
                  </div>

                  <!-- password feild -->
                  <div class="right_come space-y-1">
                    <label for="password" class="font-lg text-white">Password</label>
                    <input class="block text-white font-light border-b-2 border-[#808080] w-full p-3 bg-[#0a0a0a] outline-none focus:border-blue-600 focus:outline-none focus:ring-0" type="password" id="password" name="password" placeholder="Enter your password">
                  </div>

                  <!-- sign in button feild -->
                  <div class="left_come ">
                    <button type="submit" class="buttonhover mb-3 inline-flex justify-center items-center space-x-2 border font-semibold focus:outline-none w-full px-4 py-3 leading-6 rounded border-none outline-none text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">
                      Sign In
                    </button>
                    </div>
                  </div>
                </form>          
              </div>
            </div>        
            <div class="py-4 px-5 lg:px-6 w-full text-sm text-center bg-[#212121] text-white">
              Don’t have an account yet?
              <a class="font-medium text-blue-300 hover:text-blue-400" href="register.php" target="blank">Join us today</a>
            </div>
          </div>
          <!-- END Sign In Form -->
        </div>
        <!-- END Sign In Section -->
      </div>
    </main>
    <!-- END Page Content -->
</div>
<!-- sign in end-->

<script>
  ScrollReveal({ 
    reset: false,
    distance: '60px',
    duration: 2500,
    dilay: 200
   });

   ScrollReveal().reveal('.left_come', { delay: 300, origin: 'left' });
   ScrollReveal().reveal('.right_come', { delay: 300, origin: 'right' });
   ScrollReveal().reveal('.top_come', { delay: 300, origin: 'top' });
   ScrollReveal().reveal('.bottom_come', { delay: 300, origin: 'bottom' });
</script>

</body>
</html>