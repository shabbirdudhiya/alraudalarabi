<?php
require_once '../config/Db.php';


// Set the content type to JSON
header('Content-Type: application/json');

// Check if the 'id' parameter is provided in the URL
if (isset($_GET['id'])) {
    // Fetch post details from the database based on the provided ID
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE Id = :id");
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if a post with the provided ID exists
    if ($post) {
        // Output the post in JSON format
        echo json_encode($post);
    } else {
        // Output a not found message
        echo json_encode(['message' => 'Post not found']);
    }
} else {
    // Output an error message if 'id' is not provided
    echo json_encode(['message' => 'No post ID provided']);
}
