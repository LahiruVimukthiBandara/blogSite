<?php
$categoryq = "SELECT DISTINCT category FROM post";
$results = mysqli_query($db, $categoryq);
?>



<div class="py-4 lg:px-[10%] px-[1%] md:px-[1%] flex justify-center gap-2 right_come">
  <?php while ($row = mysqli_fetch_assoc($results)) : ?>
    <span class="text-base font-semibold text-white capitalize px-4 py-1 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full">
      <?= $row['category'] ?>
    </span>
  <?php endwhile; ?>
</div>
