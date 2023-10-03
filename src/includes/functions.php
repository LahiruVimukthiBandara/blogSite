<?php
require 'db.php';

function getComment($db, $post_id) {
    $query = "SELECT * FROM comment WHERE post_id = $post_id ORDER BY created DESC";
    $result = mysqli_query($db, $query);
    $comments = array();

    while ($row = mysqli_fetch_assoc($result)) {
        $comments[] = $row;
    }

    // Reverse the array to display newest comments first
    $comments = array_reverse($comments);

    return $comments;
}

?>