<?php
// Include the database connection file
require_once '../config/Db.php';

// Check if postId is set in the GET request
if (isset($_GET['postId'])) {
    // Sanitize the postId
    $postId = filter_var($_GET['postId'], FILTER_SANITIZE_NUMBER_INT);

    // Prepare and execute SQL query to fetch likes count for the given postId
    $stmt = $pdo->prepare("SELECT likes_count FROM postlikes WHERE post_id = :postId");
    $stmt->execute(['postId' => $postId]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the post exists
    if ($result) {
        // Return the likes count
        echo $result['likes_count'];
    } else {
        // Return 0 if post not found
        echo 0;
    }
} else {
    // Return 0 if postId is not set
    echo 0;
}
