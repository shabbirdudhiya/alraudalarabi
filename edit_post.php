<?php
include './config/Db.php';
include 'header.inc.php';

// Check for success or error messages in the URL
$success_msg = isset($_GET['success']) ? $_GET['success'] : "";
$error_msg = isset($_GET['error']) ? $_GET['error'] : "";

// Check if post ID is provided in the URL
if (!isset($_GET['id'])) {
    echo "Post ID not provided.";
    // header("Location: ./error.php"); // Redirect to error page if ID is not provided
    exit();
} else {

    // Fetch post details from the database based on the provided ID
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE Id = :id");
    $stmt->execute(['id' => $id]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if post with the provided ID exists
    if (!$post) {
        echo "Post not found.";
        // header("Location: ./error.php"); // Redirect to error page if post does not exist
        exit();
    }
}
?>

<div class="container mt-5">
    <div class="row">
        <h2 class="col">Edit Posts</h2>
        <button class="btn btn-primary btn-sm col" onclick="window.location.href='all_posts.php'">View all
            Posts</button>
    </div>
    <?php
    // Display success message if set
    if (!empty($success_msg)) {
        echo '<div class="alert alert-success">' . $success_msg . '</div>';
    }

    // Display error message if set
    if (!empty($error_msg)) {
        echo '<div class="alert alert-danger">' . $error_msg . '</div>';
    }
    ?>
    <form action="./logic/logic_edit_post.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $post['Id']; ?>">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" value="<?php echo $post['Title']; ?>">
        </div>
        <div class="form-group">
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body" rows="6"><?php echo $post['Body']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <?php
                // Retrieve categories from the database
                $categories = $pdo->query("SELECT * FROM Categories")->fetchAll(PDO::FETCH_ASSOC);
                foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['Name']; ?>" <?php echo ($post['Category'] == $category['Name']) ? 'selected' : ''; ?>>
                        <?php echo $category['Name']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <label for="current_images">Current Images:</label><br>
            <?php if (!empty($post['Images'])) : ?>
                <?php $images = explode(',', $post['Images']); ?>
                <?php foreach ($images as $image) : ?>
                    <div class="current-image" style="display: inline-block; margin-right: 10px;">
                        <img src="<?php echo $image; ?>" alt="Current Image" style="max-width: 200px;">
                        <button type="button" class="btn btn-danger btn-sm remove-image">Remove</button>
                        <input type="hidden" name="removed_images[]" value="<?php echo $image; ?>">
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <span>No images available</span>
            <?php endif; ?>
        </div>
        <div class="form-group">
            <label for="images">New Images:</label>
            <input type="file" class="form-control" id="images" name="images[]" multiple required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>

<script>
    // Script to handle removal of images
    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-image')) {
            var imageContainer = e.target.parentNode;
            var imagePathInput = imageContainer.querySelector('input[type="hidden"]');

            // Remove the parent div containing the image
            imageContainer.remove();

            // Remove the corresponding input field from the form data
            if (imagePathInput) {
                imagePathInput.parentNode.removeChild(imagePathInput);
            }
        }
    });
</script>

<?php include 'footer.inc.php'; ?>