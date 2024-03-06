<?php
// Include the database connection file
require_once '../config/Db.php';

// Check if post ID is provided in the request
if (isset($_POST['postId'])) {
    $postId = $_POST['postId'];

    // Check if there is an entry for the post in the PostLikes table
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM PostLikes WHERE post_id = ?");
    $stmt->execute([$postId]);
    $count = $stmt->fetchColumn();

    if ($count == 0) {
        // If no entry exists, create one
        $stmt = $pdo->prepare("INSERT INTO PostLikes (post_id, likes_count) VALUES (?, 1)");
        $stmt->execute([$postId]);
    } else {
        // If entry exists, update likes count for the post
        $stmt = $pdo->prepare("UPDATE PostLikes SET likes_count = likes_count + 1 WHERE post_id = ?");
        $stmt->execute([$postId]);
    }

    // Get updated likes count
    $stmt = $pdo->prepare("SELECT likes_count FROM PostLikes WHERE post_id = ?");
    $stmt->execute([$postId]);
    $likesCount = $stmt->fetchColumn();

    // Return updated likes count
    echo $likesCount;
}
