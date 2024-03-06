<?php
require_once './config/Db.php';

// Check if the post ID is provided in the URL
if (!isset($_GET['post_id'])) {
    header("Location: all_posts.php?error=postIDNotProvided");
    exit();
}

$post_id = $_GET['post_id'];

// Fetch post details from the database
$sql = "SELECT * FROM `posts` WHERE `Id` = :post_id";
$query = $pdo->prepare($sql);
$query->execute(['post_id' => $post_id]);
$data_row = $query->fetch();

include 'header.inc.php';
?>

<div class="container">
    <center>
        <h5>Are you sure you want to delete this Post?</h5>
    </center>

    <div class="row">
        <div class="col mx-2">
            <span class="mx-2"><b>Title:</b> <?php echo $data_row['Title'] ?></span>
            <br /> <span class="mx-2"><b>Category:</b> <?php echo $data_row['Category'] ?></span>
            <br /> <span class="mx-2"><b>Body:</b> <?php echo $data_row['Body'] ?></span>
            <br />
            <?php if (!empty($data_row['Images'])) : ?>
                <?php $images = explode(',', $data_row['Images']); ?>
                <?php foreach ($images as $image) : ?>
                    <div class="current-image" style="display: inline-block; margin-right: 10px;">
                        <img src="<?php echo $image; ?>" alt="Current Image" style="max-width: 200px;">
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <span>No images available</span>
            <?php endif; ?>
        </div>
    </div>
    <br>
    <form action="logic/logic_delete_post.php" method="post">
        <input type="hidden" name="post_id" value="<?php echo $data_row['Id']; ?>">
        <button type="submit" name="delete" class="btn btn-danger">Delete</button>
        <a href="./view_posts.php" class="btn btn-primary">Cancel</a>
    </form>
</div>

<?php
// Include footer file
include 'footer.inc.php';
?>