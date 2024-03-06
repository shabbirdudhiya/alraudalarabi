<?php
// Include the database connection file
require_once '../config/Db.php';

// Initialize success and error messages
$success_msg = "";
$error_msg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Prepare data for insertion
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category = $_POST['category'] ?? null;

    // Handle image upload
    $file_paths = [];

    if (isset($_FILES['images'])) {

        foreach ($_FILES['images']['name'] as $key => $name) {

            if ($_FILES['images']['error'][$key] === UPLOAD_ERR_OK) {

                $file_name = $_FILES['images']['name'][$key];
                $file_tmp = $_FILES['images']['tmp_name'][$key];

                // Generate unique filename
                $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
                $unique_filename = uniqid() . '.' . $file_extension;

                // Destination directory accessible from any file in the website
                $file_destination = 'uploads/' . $unique_filename;

                if (move_uploaded_file($file_tmp, '../' .  $file_destination)) {
                    // Image uploaded successfully
                    $file_paths[] = $file_destination;
                } else {
                    // Failed to upload image
                    $error_msg = "Error: Failed to upload image.";
                }
            }
        }
    }

    if (!empty($file_paths)) {

        // Convert file paths array to string
        $images_str = implode(',', $file_paths);

        // Prepare and execute SQL query
        $stmt = $pdo->prepare("INSERT INTO posts (Title, Body, Category, Images) VALUES (:title, :body, :category, :images)");
        if ($stmt->execute(['title' => $title, 'body' => $body, 'category' => $category, 'images' => $images_str])) {

            // Post inserted successfully
            $success_msg = "Post added successfully!";

            // Redirect after form submission
            header("Location: ../add_post.php?success=$success_msg");

            exit();
        }
    } else {
        // Failed to insert post
        $error_msg = "Error: Failed to add post.";

        // Redirect after form submission
        header("Location: ../add_post.php?error=$error_msg");
        exit();
    }
}
