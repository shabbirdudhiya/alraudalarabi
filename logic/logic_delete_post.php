<?php

// Include the database connection file
require_once '../config/Db.php';

// Check if post ID is provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['post_id'])) {
    // Retrieve post ID from the form
    $post_id = $_POST['post_id'];

    // Prepare and execute SQL query to delete the post
    $stmt = $pdo->prepare("DELETE FROM posts WHERE Id = :post_id");
    if ($stmt->execute(['post_id' => $post_id])) {
        // Post deleted successfully
        $success_msg = "Post deleted successfully!";
        header("Location: ../all_posts.php?success=$success_msg");
        exit();
    } else {
        // Failed to delete post
        $error_msg = "Error: Failed to delete post.";
        header("Location: ../all_posts.php?error=$error_msg");
        exit();
    }
}
