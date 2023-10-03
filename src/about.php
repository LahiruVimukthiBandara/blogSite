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
        transition: 0.8s ease-in-out;
      }
      .cardhover:hover{
        transform: translateY(-2px) scale(1.1);
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


<!-- about section -->

<div class="container my-14 mx-auto md:px-6">
  <section class="mb-20">

    <h3 id="title" class="bottom_come flex items-center my-8 px-[4%] md:px-[10%] pb-10">
      <span aria-hidden="true" class="grow bg-gradient-to-r from-[#171616] to-[#1F1E1E]  border-none rounded h-0.5 mr-4"></span>
      <span class="text-4xl text-white font-semibold mx-3 capitalize">about us</span>
      <span aria-hidden="true" class="grow bg-gradient-to-r from-[#1F1E1E] to-[#171616]  border-none rounded h-0.5 ml-4"></span>
    </h3>

    <div class="mb-16 flex flex-wrap left_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/vision.jpg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6 ">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">our vision!</h3>
          
        <p class="text-gray-200">
        City Times envisions becoming the premier online destination for urban dwellers,
         providing a platform where bloggers share their unique perspectives, insights,
          and experiences about cities. Our goal is to offer timely, engaging, and 
          informative content that caters to a diverse audience of city enthusiasts,
           professionals, students, and tourists. By fostering a vibrant community and 
           promoting interactions between readers and bloggers, City Times aims to create an
            immersive and valuable urban lifestyle experience, making it the go-to resource for
             individuals seeking in-depth knowledge, recommendations, and connections within 
             the dynamic world of cities.
        </p>
      </div>
    </div>

    <div class="mb-16 flex flex-wrap lg:flex-row-reverse right_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/mission.jpg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize"">our mission</h3>
    
        <p class="text-gray-200">
        At City Times, our mission is to curate and deliver high-quality,
         engaging, and relevant content about cities worldwide while empowering
          bloggers to share their unique perspectives. We strive to foster a
           sense of community and connection among urban enthusiasts, inspiring,
            informing, and entertaining our readers with comprehensive coverage 
            of urban topics. By continuously improving our platform, expanding our
             blogger network, and providing a valuable experience, we aim to navigate 
             and appreciate the complexities and opportunities of city life, serving as 
             the ultimate destination for all things urban.
        </p>
      </div>
    </div>

    <div class="mb-16 flex flex-wrap left_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pr-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/qulity.jpg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pl-6">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize"">qulity blog posts</h3>
        
        <p class="text-gray-200">
        City Times takes pride in curating top-notch blog 
        posts that captivate and inform urban enthusiasts.
         Our rigorous selection process ensures that only 
         the highest quality content makes it to our platform.
          With well-researched articles, unique perspectives
           from expert bloggers, and a diverse range of topics
            including travel, culture, architecture, and events,
             our blog posts provide an immersive experience. We 
             strive to engage readers with an inviting tone, sparking
              meaningful conversations and inspiring a deeper appreciation 
              for the dynamic world of cities. City Times is committed to being 
              the ultimate destination for urban enthusiasts, delivering exceptional 
              blog posts that inform, entertain, and enrich the urban lifestyle.
      </div>
    </div>


    <div class="mb-16 flex flex-wrap lg:flex-row-reverse right_come">
      <div class="mb-6 w-full shrink-0 grow-0 basis-auto lg:mb-0 lg:w-6/12 lg:pl-6">
        <div class="ripple relative overflow-hidden rounded-lg bg-cover bg-[50%] bg-no-repeat shadow-lg">
          <img src="../src/assets/img/team.jpg" class="cardhover w-full" alt="image" />
        </div>
      </div>

      <div class="w-full shrink-0 grow-0 basis-auto lg:w-6/12 lg:pr-6">
        <h3 class="mb-4 text-2xl font-bold bg-gradient-to-r from-cyan-500 to-blue-600 text-transparent bg-clip-text p-4 rounded-md capitalize">our team</h3>
    
        <p class="text-gray-200">
        Welcome to City Times, your go-to destination for
         urban living and the vibrant energy of city life. 
         We capture the essence of cities worldwide, sharing 
         captivating stories, insider tips, and intriguing insights.
          Discover hidden gems, trendy hotspots, and the cultural fabric
           of modern metropolises. Join us as we navigate streets, neighborhoods,
            and diverse communities that shape each city's unique character. Let's
             celebrate the vibrant tapestry of urban life together, exclusively on City Times!
        </p>
      </div>
    </div>
  </section>
</div>

<!-- about section end -->


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