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
    <link rel="stylesheet" href="../dist/output.css">
    <link rel="stylesheet" href="../dist/style.css">
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

    </style>
</head>
<body class="bg-[#000000]">

<?php 
    include_once('includes/header.php');
    ?>

<!-- home page -->
<div class="overflow-hidden animate">

   
  
    <!-- welcome Content -->
    <div class="right_come flex flex-col lg:flex-row-reverse space-y-10 lg:space-y-0 text-center lg:text-left container xl:max-w-7xl mx-auto px-4 py-5 lg:px-8 lg:py-32">
      <div class="lg:w-1/2 lg:flex lg:items-center">
        <div>
          <div class="top_come capitalize font-base inline-flex px-2 py-1 leading-4 mb-2 text-sm rounded text-gray-200 bg-[#292929]">
            the best blogger site!
            </div>
            <div class="h-[125px] p-1 ">
                <h1 id="typing-heading" class="right_come capitalize text-white text-3xl md:text-6xl font-extrabold mb-4"></h1>

                <script>

                  const textToType = "Discover Nice Articles Here.";
                  const heading = document.getElementById('typing-heading');

                  function typeText() {
                    let charIndex = 0;
                    let interval = setInterval(() => {
                      if (charIndex < textToType.length) {
                        heading.innerHTML += textToType.charAt(charIndex);
                        charIndex++;
                      } else {
                        clearInterval(interval);
                        setTimeout(() => {
                          heading.innerHTML = ''; 
                          typeText(); 
                        }, 2000); 
                      }
                    }, 100); 
                  }
                  typeText();

                </script>
            </div>
            

          <p class="right_come text-sm text-gray-400 mt-3">All The Articles And Contents Of The Site Have Been <span class="text-white font-semibold">Updated Today</span> And You Can Find</p>
          <div class="top_come flex flex-col sm:flex-row sm:items-center justify-center lg:justify-start space-y-2 sm:space-y-0 sm:space-x-2 pt-10 pb-8">
            <a href="#title" class="buttonhover text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl transition-all ease-in-out font-medium rounded-lg text-sm px-4 py-4 text-center">
              <span class=" capitalize ">Explore more..</span>
              <svg fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" class="opacity-50 hi-solid hi-arrow-right inline-block w-5 h-5"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
            </a>
          </div>
          <div class="bottom_come flex justify-center gap-3 md:justify-center lg:justify-start">
            <a href="https://twitter.com/" target="blank"> <i class=" hover:bg-blue-600 iconhover fa-brands fa-twitter text-2xl bg-[#212121] border border-none rounded-full py-2 px-3 text-[white] shadow-md"></i> </a>
            <a href="https://youtube.com/" target="blank"> <i class=" hover:bg-red-600 iconhover fa-brands fa-youtube text-2xl bg-[#212121] border border-none rounded-full py-2 px-3 text-white shadow-md"></i> </a>
            <a href="https://facebook.com/" target="blank"> <i class=" hover:bg-blue-600 iconhover fa-brands fa-facebook text-2xl bg-[#212121] border border-none rounded-full py-2 px-3 text-white shadow-md"></i> </a>
        </div>
        </div>
      </div>
      <div class="lg:w-1/2 lg:mr-16 lg:flex lg:justify-center lg:items-center">
        <div class="lg:w-96 relative">
          <div class="absolute pattern-dots-xl text-blue-100 top-0 left-0 w-32 h-48 md:h-96 transform -translate-y-12 -translate-x-16 -rotate-3"></div>
          <div class="absolute pattern-dots-xl text-blue-100 bottom-0 right-0 w-32 h-48 md:h-96 transform translate-y-12 translate-x-16 rotate-3"></div>
          <div class="absolute rounded-full top-0 right-0 w-32 h-32 bg-yellow-300 bg-opacity-50 -mt-12 -mr-12"></div>
          <div class="absolute rounded-full bottom-10px right-25px w-32 h-32 bg-red-500 bg-opacity-50 -mt-12 -mr-12"></div>
          <div class="absolute rounded-xl bottom-0 left-0 w-32 h-32 bg-blue-600 bg-opacity-50 -mb-10 -ml-10 transform rotate-3"></div>
          <div class="absolute rounded-xl bottom-50px left-0 w-32 h-32 bg-cyan-600 bg-opacity-50 -mb-10 -ml-10 transform rotate-3"></div>
          <img src="assets/img/main.jpg" alt="Hero Image" class="right_comes relative rounded-xl mx-auto shadow-lg">
        </div>
      </div>
  </div>
</div>
<!-- welcome ends -->


<!-- title -->
<h3 id="title" class="bottom_come flex items-center my-8 px-[4%] md:px-[10%]">
    <span aria-hidden="true" class="grow bg-gradient-to-r from-[#171616] to-[#1F1E1E]  border-none rounded h-0.5 mr-4"></span>
    <span class="text-2xl text-white font-semibold mx-3">Articals</span>
    <span aria-hidden="true" class="grow bg-gradient-to-r from-[#1F1E1E] to-[#171616]  border-none rounded h-0.5 ml-4"></span>
</h3>
<h1 role="heading" class=" bottom_come text-center xl:text-5xl md:text-4xl text-2xl font-bold text-white">Read Our Latest</h1>
<!-- end title -->


<!-- blog card -->
<div class="cardhover 2xl:container 2xl:mx-auto flex flex-wrap items-start justify-center pt-6 px-4 gap-6 mt-[30px]">

  <?php
  $postquary = "SELECT * FROM post ORDER BY id DESC LIMIT $result,$posts_per_page ";
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