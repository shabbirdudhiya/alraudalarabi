<?php
// Include the database connection file
require_once '../config/Db.php';

// Initialize success and error messages
$success_msg = "";
$error_msg = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare data for insertion
    $id = $_POST['id'];
    $title = $_POST['title'];
    $body = $_POST['body'];
    $category = $_POST['category'];

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
    // removed_images

    if (isset($_POST['removed_images'])) {
        $removed_images = $_POST['removed_images'];
        foreach ($removed_images as $removed_image) {
            if (file_exists('../' . $removed_image)) {
                unlink('../' . $removed_image); // Delete the image from the server
            }
        }
    }

    // Prepare and execute SQL query to update the post
    $stmt = $pdo->prepare("UPDATE posts SET Title = :title, Body = :body, Category = :category, Images = :images WHERE Id = :id");
    $stmt->execute(['title' => $title, 'body' => $body, 'category' => $category, 'images' => implode(',', $file_paths), 'id' => $id]);
    if ($stmt->rowCount() > 0) {
        // Post updated successfully
        $success_msg = "Post updated successfully!";
        // Redirect after form submission
        header("Location: ../edit_post.php?id=$id&success=$success_msg");
        exit();
    } else {
        // Failed to update post
        $error_msg .= "Error: Failed to update post.";
        // Redirect after form submission
        header("Location: ../edit_post.php?id=$id&error=$error_msg");
        exit();
    }
}
