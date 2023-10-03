<!-- comment section start -->
<?php
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_SESSION['name']) && isset($_SESSION['image'])) {
  $username = $_SESSION['name'];
  $image = $_SESSION['image'];
  @$comment = $_POST['comment'];
  $postid = $post_id;

  $sql = "INSERT INTO comment VALUES ('?', '?', '$comment', '$username', '$postid', '$image')";
  mysqli_query($db, $sql);
}
?>

<section class="bg-[#000000] py-8 px-5 lg:py-16 max-h-[80vh] overflow-scroll">
  <div class="max-w-4xl overflow-scroll mx-auto">
    <div class="max-w-2xl mx-auto px-4">
      <div class="flex justify-between items-center mb-6">
        <h2 class="text-lg lg:text-2xl font-bold text-white">Comments (<?php echo $allcomments; ?>)</h2>
      </div>
      
      <!-- comment area -->
      
      <?php if (isset($_SESSION['name']) && isset($_SESSION['image'])) { ?>
      <form class="mb-6 right_come" action="" method="post" enctype="multipart/form-data">
        <div class="py-2 px-4 mb-4 bg-[#111111] rounded-lg rounded-t-lg border-none">
          <label for="comment" class="sr-only">Your comment</label>
          <textarea id="comment" name="comment" rows="6" class="px-0 w-full text-sm text-white border-none bg-[#111111] outline-none" placeholder="Write a comment..." required></textarea>
        </div>
        <button type="submit" class="buttonhover rounded-lg inline-flex items-center py-2.5 px-4 text-sm font-medium text-center text-white bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">
          Post comment
        </button>
      </form>
      <?php } else { ?>
      <div class="mb-6 right_come">
        <p class="text-gray-200 text-sm">Please <a href="login.php" class="text-blue-600">sign in</a> to post a comment.</p>
      </div>
      <?php } ?>

      <?php
      if (isset($_GET['id'])) {
        ?>

        <?php
        $comments = getcomment($db, $post_id);
        if (count($comments) < 1) {
          ?>
          <p class="text-gray-200 text-sm left_come text-center">No Comments Yet</p>
          <?php
         }
        foreach ($comments as $comment) {
          ?>
          <article class="left_come p-6 mb-6 text-base bg-[#000000] border-b-2 border-[#212121] w-full">
            <footer class="flex justify-between items-center mb-2 w-full">
              <div class="flex items-center w-full">
                <p class="inline-flex items-center mr-3 text-md text-white capitalize">
                  <img class="mr-3 w-10 h-10 rounded-full object-cover object-center" src="<?=$comment['image_path']?>">
                  <?=$comment['name']?>
                </p>
                <p class="text-xs italic font-italic leading-4 text-blue-500 cursor-text mt-2">Posted on  <span class="text-red-100"><?=date('F jS,Y',strtotime($comment['created']))?></span></p>
              </div>
            </footer>
            <p class="text-gray-200 text-sm"><?=$comment['coment']?></p>
          </article>
          <?php
        }
        ?>

        <?php
      }
      ?>

    </div>
  </div>
</section>
<!-- comment section ends -->
