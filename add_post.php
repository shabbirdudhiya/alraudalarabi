<?php include 'header.inc.php';

// Check for success or error messages in the URL
$success_msg = isset($_GET['success']) ? $_GET['success'] : "";
$error_msg = isset($_GET['error']) ? $_GET['error'] : "";
?>
<div class="container mt-5">

    <div class="row">
        <h2>Add Posts</h2>
        <button class="btn btn-primary btn-sm" onclick="window.location.href='all_posts.php'">View all
            Posts</button>
    </div>
    <?php
    // Display success message if set
    if (!empty($success_msg)) {
        echo '<div class="alert alert-success m-2">' . $success_msg . '</div>';
    }

    // Display error message if set
    if (!empty($error_msg)) {
        echo '<div class="alert alert-danger m-2">' . $error_msg . '</div>';
    }
    ?>
    <form action="logic/logic_add_post.php" method="post" enctype="multipart/form-data">
        <div>
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div>
            <label for="body">Body:</label>
            <textarea class="form-control" id="body" name="body" rows="6" required></textarea>
        </div>
        <div class="row">
            <div class="col-md-6">
                <label for="category">Category:</label>
                <select class="form-control" id="category" name="category" required>
                    <?php
                    include_once './config/Db.php';
                    // Retrieve categories from the database
                    $categories = $pdo->query("SELECT * FROM categories");
                    $categories = $categories->fetchAll(PDO::FETCH_ASSOC);
                    foreach ($categories as $category) : ?>
                        <option value="<?php echo $category['Name']; ?>"><?php echo $category['Name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-6">
                <label for="image">Image:</label>
                <input type="file" class="form-control" id="image" name="images[]" multiple required>
            </div>
        </div>
        <br />
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php include 'footer.inc.php'; ?>