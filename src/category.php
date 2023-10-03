<?php
  require('includes/db.php');

  if(isset($_GET['page'])){
    $page = $_GET['page'];
  }
  else{
    $page = 1;
  }

  $posts_per_page = 9;
  $result=($page-1)*$posts_per_page;
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
    
<body class="bg-[#000000] animate">


<!-- Header include -->
<?php 
    include_once('includes/header.php');
    ?>
<!-- END Header include -->    

<!-- category tabs -->
<?php 
    include_once('includes/categorybadge.php');
    ?>
<!-- category tabs -->

<!-- category section -->
<!-- search bar -->
<div class="left_come flex items-center max-w-md mx-auto bg-[#212121] rounded-lg mt-6 mb-6">
    
    <div class="w-full  ">
    <form>
            <input type="search" name="search" id="search" class=" w-full px-4 py-1 text-white bg-[#212121] rounded-full focus:outline-none placeholder-[#808080]"
                placeholder="search post or category...">
        </div>
        <div>
            <button type="submit" class="flex items-center bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl justify-center w-12 h-12 text-white rounded-r-lg"
                :class="(search.length > 0) ? 'bg-purple-500' : 'bg-gray-500 cursor-not-allowed'"
                :disabled="search.length == 0">
                <svg class="w-5 h-5 justify-center" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </button>
            </form>
        </div>
    
    </div>
    
<!-- search bar end -->

<!-- blog card -->
<div class="2xl:container 2xl:mx-auto flex flex-wrap items-start justify-center pt-6 px-4 gap-6 mt-[30px]">

  <?php
    if(isset($_GET['search'])){
        $keyword = $_GET['search'];
        $postquary = "SELECT * FROM post WHERE title LIKE '%$keyword%' OR category LIKE '%$keyword%'  ORDER BY id DESC LIMIT $result,$posts_per_page ";
    }else{
        $postquary = "SELECT * FROM post ORDER BY id DESC LIMIT $result,$posts_per_page ";
    }
  $runPq = mysqli_query($db,$postquary);
  
  while($posts = mysqli_fetch_assoc($runPq)){
    ?>
    
    <div class="bg-[#0a0a0a] shadow-sm shadow-[#0e0d0d] border border-none rounded-lg max-w-sm mb-5 bottom_come">
    <a href="post.php?id=<?=$posts['id']?>">
          <img class="rounded-t-lg object-cover h-[300px] w-[460px]" src="../src/images/<?=$posts['imagePath']?>">
        </a>
        <div class="p-5">
            <a href="post.php?id=<?=$posts['id']?>">
                <h5 class="text-white font-bold text-2xl tracking-tight mb-2 cursor-text "> <?=$posts['title']?> </h5>
            </a>
            <!-- category -->
            <div class="flex mt-2">
            <h2 class="text-base font-semibold text-white capitalize px-4 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full"> <?=$posts['category']?> </h2>
              </div>
            
            <div class="mt-6 justify-between flex items-center cursor-pointer">
            <p class="text-xs italic font-italic leading-4 text-blue-400 cursor-text ">Posted on  <span class=" text-red-100"> <?=date('F jS,Y',strtotime($posts['createdat'])) ?> </span> </p>
                <!-- read more button -->  
                <div class="flex gap-2 items-center">
                    <a href="post.php?id=<?=$posts['id']?>"> <button class="text-white buttonhover bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl font-medium rounded-lg text-[14px] px-5 py-2.5 text-center transition-all ease-in-out">Read more..</button> </a>
                  </div>
                </div>
        </div>
    </div>
    <?php
  }
  ?>
</div>    
<!-- blog card ends -->

<!-- page navigation section -->
<div class=" flex justify-center items-center px-[4%] md:px-[10%] mt-[50px]">

  <?php
 $q = "SELECT * FROM post";
 $r = mysqli_query($db,$q);
 $total_posts = mysqli_num_rows($r);
 $total_pages = ceil ($total_posts/$posts_per_page);
  ?>

    <span aria-hidden="true" class="grow bg-gradient-to-r from-[#171616] to-[#1F1E1E]  border-none rounded h-0.5 mr-4"></span>
    <ul class="flex gap-1">
      <?php
      if($page>1){
        $switch = "";
      }else{
        $switch="pointer-events-none"; 
      }

      if($page<$total_pages){
        $nswitch = "";
      }else{
        $nswitch="pointer-events-none"; 
      }
      ?>
        <li class="<?=$switch?>"><a class="text-xs text-white px-4 py-2 border bg-[#0a0a0a] border-[#292929] rounded-full "  tabindex="-1" aria-disabled="true" href="?page=<?=$page-1?>"> Previous </a></li>
        

        <?php
        for($opage=1;$opage<=$total_pages;$opage++){
          ?>
          <li><a class="text-xs text-white px-4 py-2 border border-[#292929] rounded-full" href="?page=<?=$opage?>"> <?=$opage?> </a></li>
          <?php
        }
        ?>


        <li class="<?=$nswitch?>"><a class="text-xs text-white px-4 py-2 border bg-[#0a0a0a] border-[#292929] rounded-full" href="?page=<?=$page+1?>"> Next </a></li>
    </ul>
    <span aria-hidden="true" class="grow bg-gradient-to-r from-[#171616] to-[#1F1E1E]  border-none rounded h-0.5 ml-4"></span>
</div>
<!-- page navigation section end-->
<!-- category section end -->


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