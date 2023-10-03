<?php
include 'includes/db.php';
include 'includes/functions.php';

// Start the session
session_start();

// Access the stored session variables
$name = @$_SESSION['name'];
$imagepath = @$_SESSION['image'];
$id = @$_SESSION['id'];

$post_id = $_GET['id'];

$sql = "SELECT * FROM comment WHERE post_id = $post_id";
$result = $db->query($sql);

$commentcount = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $commentcount[] = $row;
    }
}

$allcomments = count($commentcount); 


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
    .light-mode {
      background-color: #E4E3E3;
      color: #000000;
    }

    .dark-mode {
      background-color: #000000;
      color: #E4E3E3;
    }
    .buttonhover{
        transition: 0.3s ease-in-out;
      }
      .buttonhover:hover{
        transform: scale(1.07);
      }
      .iconhover{
        transition: 0.2s ease-in-out;
      }
      .iconhover:hover{
        transform: scale(1.1);
      }
  </style>

</head>


<body class="bg-[#000000] ">
    
<!-- blog post section -->
<section class="py-16 lg:px-[10%] bg-[#000000] px-[4%] md:px-[10%]">
      <!-- back to blog btn -->
      <div class="bottom_come capitalize mb-10 px-8 text-white ">
        <a href="index.php#title"> <i class="fa-solid fa-arrow-left mr-1 text-blue-400"></i> back to blog</a>
      </div>
        <div class="px-4">
        <?php
        $post_id = $_GET['id'];
          $postquary = "SELECT * FROM post WHERE id=$post_id ";
          $runPq = mysqli_query($db,$postquary);
          $posts = mysqli_fetch_assoc($runPq);
        ?>
          <div class="flex flex-col">
            <div class=" relative w-full px-4 mb-8 lg:mb-0">
              <div class="top_come mb-8 md:mb-10 text-left">
                <span class="inline-block py-1 px-4 mb-4 text-sm font-semibold text-white bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full capitalize"> <?=$posts['category']?> </span>
                <h1 class="font-heading text-4xl xs:text-4xl md:text-4xl font-bold text-white ">
                <?=$posts['title']?>
                </h1>
                <p class="text-xs italic font-italic leading-4 text-blue-500 cursor-text mt-2">Posted on  <span class=" text-red-100"> <?=date('F jS,Y',strtotime($posts['createdat'])) ?> </span> </p>
              </div>
              <img class="left_come block w-full h-[60vh] object-cover object-center rounded-3xl" src="../src/images/<?=$posts['imagePath']?>" alt=" image">
            </div>

            <div class="w-full px-4 flex flex-col shrink mt-8 rounded-lg" id="myDiv">
              <div>
                <button id="modeToggleBtn" class="mode-toggle-btn block float-right w-auto px-3 py-2"></button>
              </div>
              <div class="right_come mt-2 py-4 px-2 text-[15px]">
                <p><?=$posts['content']?></p>
              </div>
            </div>

            <h3 class="right_come capitalize text-right text-sm mt-3 text-gray-300">Dont forget to leave a comment</h3>
          </div>
        </div>

          <!-- share section start -->
          <h3 class="text-gray-400 ml-3 text-sm mb-2 text-center mt-5">share with your friends</h3>
          <div class="sharing-buttons flex flex-wrap ml-3 justify-center gap-2">
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl border-none outline-none iconhover" target="_blank" rel="noopener" href="https://facebook.com/sharer/sharer.php?u=" aria-label="Share on Facebook">
              <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                <title>Facebook</title>
                <path d="M379 22v75h-44c-36 0-42 17-42 41v54h84l-12 85h-72v217h-88V277h-72v-85h72v-62c0-72 45-112 109-112 31 0 58 3 65 4z">
                </path>
              </svg>
            </a>
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl border-none outline-none iconhover" target="_blank" rel="noopener" href="https://twitter.com/intent/tweet?url=&amp;text=" aria-label="Share on Twitter">
              <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                <title>Twitter</title>
                <path d="m459 152 1 13c0 139-106 299-299 299-59 0-115-17-161-47a217 217 0 0 0 156-44c-47-1-85-31-98-72l19 1c10 0 19-1 28-3-48-10-84-52-84-103v-2c14 8 30 13 47 14A105 105 0 0 1 36 67c51 64 129 106 216 110-2-8-2-16-2-24a105 105 0 0 1 181-72c24-4 47-13 67-25-8 24-25 45-46 58 21-3 41-8 60-17-14 21-32 40-53 55z">
                </path>
              </svg>
            </a>
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl border-none outline-none iconhover" target="_blank" rel="noopener" href="https://telegram.me/share/url?text=&amp;url=" aria-label="Share on Telegram" draggable="false">
              <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                <title>Telegram</title>
                <path d="M256 8a248 248 0 1 0 0 496 248 248 0 0 0 0-496zm115 169c-4 39-20 134-28 178-4 19-10 25-17 25-14 2-25-9-39-18l-56-37c-24-17-8-25 6-40 3-4 67-61 68-67l-1-4-5-1q-4 1-105 70-15 10-27 9c-9 0-26-5-38-9-16-5-28-7-27-16q1-7 18-14l145-62c69-29 83-34 92-34 2 0 7 1 10 3l4 7a43 43 0 0 1 0 10z">
                </path>
              </svg>
            </a>
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl border-none outline-none iconhover" target="_blank" rel="noopener" href="https://www.linkedin.com/shareArticle?mini=true&amp;url=&amp;title=&amp;summary=&amp;source=" aria-label="Share on Linkedin">
              <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                <title>Linkedin</title>
                <path d="M136 183v283H42V183h94zm6-88c1 27-20 49-53 49-32 0-52-22-52-49 0-28 21-49 53-49s52 21 52 49zm333 208v163h-94V314c0-38-13-64-47-64-26 0-42 18-49 35-2 6-3 14-3 23v158h-94V183h94v41c12-20 34-48 85-48 62 0 108 41 108 127z">
                </path>
              </svg>
            </a>
            <a class="border-2 duration-200 ease inline-flex items-center mb-1 mr-1 transition p-3 rounded-full text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl border-none outline-none iconhover" target="_blank" rel="noopener" href="https://pinterest.com/pin/create/button/?url=&amp;media=&amp;description=" aria-label="Share on Pinterest" draggable="false">
              <svg aria-hidden="true" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" class="w-4 h-4">
                <title>Pinterest</title>
                <path d="M268 6C165 6 64 75 64 186c0 70 40 110 64 110 9 0 15-28 15-35 0-10-24-30-24-68 0-81 62-138 141-138 68 0 118 39 118 110 0 53-21 153-90 153-25 0-46-18-46-44 0-38 26-74 26-113 0-67-94-55-94 25 0 17 2 36 10 51-14 60-42 148-42 209 0 19 3 38 4 57 4 3 2 3 7 1 51-69 49-82 72-173 12 24 44 36 69 36 106 0 154-103 154-196C448 71 362 6 268 6z">
                </path>
              </svg>
            </a>
          </div>
  <!-- share section end -->
</section>
<!-- blog post section end -->

<?php
include 'includes/comment.php';
?>



<!-- subscribe section -->
<?php
include('includes/subscribe.php');
?>
<!-- subscribe section end -->



<!-- footer include -->
<?php
include_once('includes/footer.php');
?>
<!-- footer include end -->


<script>

  // mode changing
    function toggleMode() {
    var element = document.getElementById("myDiv");
    element.classList.toggle("light-mode");
    element.classList.toggle("dark-mode");

    var btn = document.getElementById("modeToggleBtn");
    if (element.classList.contains("dark-mode")) {
      btn.textContent = "Light";
    } else {
      btn.textContent = "Dark";
    }
  }

  function checkModePreference() {
    var isDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    var element = document.getElementById("myDiv");
    element.classList.toggle("dark-mode", isDarkMode);

    var btn = document.getElementById("modeToggleBtn");
    if (element.classList.contains("dark-mode")) {
      btn.textContent = "Mode";
    } else {
      btn.textContent = "Dark";
    }
  }

  document.getElementById("modeToggleBtn").addEventListener("click", function() {
    toggleMode();
  });

  checkModePreference();

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