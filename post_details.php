<?php
// Include the database connection file
require_once './config/Db.php';

// Check if post ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

// Fetch post details from the database based on the provided ID
$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT * FROM posts WHERE Id = :id");
$stmt->execute(['id' => $id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

// Check if post with the provided ID exists
if (!$post) {
    header("Location: index.php");
    exit();
}

include './header.inc.php';
?>
<!-- 
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post Details</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f3f3f3;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        background-color: #fff;
        padding: 20px;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .post-image {
        width: 100%;
        /* Ensure image fills its container */
        height: 700px;
        /* Maintain aspect ratio */
        max-width: 100%;
        /* Limit image to its natural size */
        display: block;
        /* Remove any extra spacing */
        margin-bottom: 20px;
    }

    .post-details {
        margin-bottom: 20px;
    }

    .post-details h2 {
        margin-top: 0;
    }

    .post-details p {
        margin: 0;
        line-height: 1.5;
    }
    </style>
</head> -->

<div class="container">
    <div id="postCarousel" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            $images = explode(',', $post['Images']);
            $imageCount = count($images);
            for ($i = 0; $i < $imageCount; $i++) {
                echo '<li data-target="#postCarousel" data-slide-to="' . $i . '" ' . ($i == 0 ? 'class="active"' : '') . '></li>';
            }
            ?>
        </ol>
        <div class="carousel-inner" role="listbox">
            <?php
            $images = explode(',', $post['Images']);
            $imageCount = count($images);
            for ($i = 0; $i < $imageCount; $i++) {
                echo '<div class="item ' . ($i == 0 ? 'active' : '') . '">
                            <img src="' . $images[$i] . '" alt="Post Image ' . ($i + 1) . '" class="d-block w-100">
                        </div>';
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#postCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#postCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="post-details">
        <h2><?php echo $post['Title']; ?></h2>
        <p><?php echo $post['Body']; ?></p>
    </div>
    <a href="./index.php">Back to Home</a>
</div>
<?php include './footer.inc.php';
