<?php
include 'includes/db.php';
include 'includes/functions.php';

// Start the login session
session_start();

// logout button click
if (isset($_POST['logout'])) {
  // Destroy the session
  session_destroy();

  header("Location: index.php");
  exit();
}
?>

<header class="bg-[#0a0a0a] left_come flex flex-none items-center shadow-md py-6">
  <div class="flex flex-col text-center md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0 container xl:max-w-7xl mx-auto px-4 lg:px-10">
    <div>
      <a href="index.php" class="inline-flex items-center space-x-2 font-bold text-lg tracking-wide text-blue-600 hover:text-blue-400">
        <img class="cursor-default h-[45px]" src="assets/img/logo.png" alt="logo">
      </a>
    </div>
    <div class="flex flex-col text-center md:flex-row md:items-center md:justify-between space-y-6 md:space-y-0 md:space-x-10">
      <nav class="space-x-4 md:space-x-6">
        <a href="index.php" class="text-white text-[14px] hover:text-blue-400 transition-all ease-in-out">
          <span>Home</span>
        </a>
        <a href="about.php" class="text-white text-[14px] hover:text-blue-400 transition-all ease-in-out">
          <span>About</span>
        </a>
        <a href="category.php" class="text-white text-[14px] hover:text-blue-400 transition-all ease-in-out">
          <span>Category</span>
        </a>
        <a href="contact.php" class="text-white text-[14px] hover:text-blue-400 transition-all ease-in-out">
          <span>Contact</span>
        </a>
      </nav>

      <?php
      if (isset($_SESSION['name']) && isset($_SESSION['image'])) {
        // when logged in
        $name = $_SESSION['name'];
        $imagepath = $_SESSION['image'];
      ?>

        <div class="flex items-center justify-center space-x-2">
          <p class="inline-flex items-center mr-3 text-sm text-white">
            <img class="mr-3 w-10 h-10 rounded-full object-cover object-center" src="<?= $imagepath ?>">
            <?= $name ?>
          </p>
          <form method="post" action="">
            <button type="submit" name="logout" class="text-white buttonhover bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl font-medium rounded-lg text-[14px] px-5 py-2.5 text-center transition-all ease-in-out">
              <span>Logout</span>
            </button>
          </form>
        </div>

      <?php
      } else {
        // when not logged in
        $name = '';
        $imagepath = '';
      ?>

        <div class="flex items-center justify-center space-x-2">
          <a href="login.php" target="_blank" class="text-white buttonhover bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl font-medium rounded-lg text-[14px] px-5 py-2.5 text-center transition-all ease-in-out">
            <span>Sign in</span>
          </a>
          <a href="register.php" target="_blank" class="text-white buttonhover bg-gradient-to-r from-cyan-500 to-blue-600 hover:bg-gradient-to-bl font-medium rounded-lg text-[14px] px-5 py-2.5 text-center transition-all ease-in-out">
            <span>Sign up</span>
          </a>
        </div>

      <?php
      }
      ?>

    </div>
  </div>
</header>