<?php
require 'includes/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Get the form data
  $name = $_POST['name'];
  $email = $_POST['email'];
  $message = $_POST['message'];

  // Insert the form data into the database
  $insert_sql = "INSERT INTO contactus (name, email, message) VALUES (?, ?, ?)";
  $insert_stmt = $db->prepare($insert_sql);
  $insert_stmt->bind_param('sss', $name, $email, $message);

  if ($insert_stmt->execute()) {
      // Data inserted successfully
      echo '<script>alert("Thanks for contact us");</script>';
  } else {
      // Error inserting data
      echo '<script>alert("Error while sending messages");</script>';
  }

  $insert_stmt->close();
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

  
<!-- Header include -->
<?php 
    include_once('includes/header.php');
    ?>
<!-- END Header include -->    


<!-- contact section -->
<div class="top_come flex min-h-screen items-center justify-start">
    <div class="mx-auto w-full max-w-lg">
      <h1 class="text-5xl text-white font-bold">Contact us</h1>
      <p class="mt-3 text-white font-light">Email us at <span class="text-blue-500"><a href="mailto:citytimes@gmail.com"> citytimes@gmail.com </a></span> or message us here</p>
  
      <form action="" method="POST" class="mt-10" enctype="multipart/form-data">

         
        <div class="grid gap-6 sm:grid-cols-2">
          <div class="relative z-0">
            <input required type="text" name="name" class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0" placeholder="Your Name " />
          </div>
          <div class="relative z-0">
            <input required type="email" name="email" class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0" placeholder="Your Email " />
          </div>
          <div class="relative z-0 col-span-2">
            <textarea name="message" rows="5" class="peer block w-full appearance-none border-0 border-b border-[#292929] bg-transparent py-2.5 px-0 text-sm text-white focus:border-blue-600 focus:outline-none focus:ring-0" placeholder="Your Message here.. "></textarea>
          </div>
        </div>
        <button type="submit" class="buttonhover mt-5 rounded-md bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl transition-all ease-in-out px-10 py-4 text-white text-lg font-semibold">Send Message</button>
      </form>
    </div>
</div>
<!-- contact section end -->


<!-- footer include -->
<?php
include_once('includes/footer.php');
?>
<!-- footer include end -->
    
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