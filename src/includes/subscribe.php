<?php
require 'db.php';
$db = mysqli_connect('localhost', 'root', '', 'city_times') or die('database is not connected !');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe'])) {
    $subscribe = $_POST['subscribe'];

    $checkQuery = "SELECT * FROM subscribe WHERE sumEmail = '$subscribe'";
    $result = mysqli_query($db, $checkQuery);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("You are already subscribed!");</script>';
    } else {
        $insertQuery = "INSERT INTO subscribe (sumEmail) VALUES ('$subscribe')";
        mysqli_query($db, $insertQuery);
        echo '<script>alert("Thanks for subscribing!");</script>';
    }

    $db->close();
}
?>

<!-- subscribe section -->
<div class=" top_come flex justify-center">

    <div class=" bg-[#0a0a0a] flex flex-col w-full max-w-4xl md:h-56  rounded-lg shadow-lg overflow-hidden md:flex-row my-10">
      <div class="md:flex items-center justify-center md:w-1/2 ">
          <div class="py-6 px-8 md:py-0 text-center md:text-left ">
              <h2 class="text-white text-4xl font-bold md:text-white capitalize">Subscribe for new content</h2>
              <p class="mt-2 text-sm font-light text-gray-400 md:text-gray-400 capitalize">by becoming a member of our blog. you have access articals and contents</p>
          </div>
      </div>
      <div class="flex items-center justify-center pb-6 md:py-0 md:w-1/2">
          <form action="" method="post">
              <div class="flex flex-col rounded-lg overflow-hidden sm:flex-row">
                  <input class="py-3 px-4 bg-[#292929] text-white outline-none placeholder-[#808080]" type="email" name="subscribe" placeholder="Enter your email" required>
                  <button class="py-3 px-4 text-white text-lg font-semibold capitalize bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl">subscribe</button>
              </div>
          </form>
      </div>
    </div>
</div>
<!-- subscribe section end -->
