<?php
// Include the database connection file
require_once './config/Db.php';

// Retrieve all posts from the database
$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'header.inc.php'; ?>

<div class="container mt-5">
    <div class="row">
        <h2 class="col">View Posts</h2>
        <button class="btn btn-primary btn-sm col" onclick="window.location.href='add_post.php'">Create New
            Post</button>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (empty($posts)) {
                    echo '<tr><td colspan="3"><span class="mx-auto p-2"><b>No posts found.</b></span></td></tr>';
                } ?>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?php echo $post['Title']; ?></td>
                        <td><?php echo $post['Category']; ?></td>
                        <td>
                            <a href="edit_post.php?id=<?php echo $post['Id']; ?>" class="btn btn-primary">Edit</a>
                            <a href="delete_post.php?post_id=<?php echo $post['Id']; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include 'footer.inc.php'; ?>