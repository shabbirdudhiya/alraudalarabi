<?php

// Check if post ID is provided in the URL
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

$url = "https://ziyafat-tus-shukr.co.in/al-raud-al-arabi/logic/logic_get_post_by_id.php?id=" . $_GET['id'];

// Fetch the JSON string from the URL
$json_data = file_get_contents($url);

// Decode the JSON string into an associative array
$post = json_decode($json_data, true);

include './header.inc.php';

?>

<div class="containe-fluid">
    <div id="carouselExample" class="carousel slide">

        <div class="carousel-inner">
            <?php $images = explode(',', $post['Images']);
            $imageCount = count($images);
            for ($i = 0; $i < $imageCount; $i++) { ?>


            <div class="carousel-item <?php echo ($i == 0 ? 'active' : '') ?>">
                <img src="https://ziyafat-tus-shukr.co.in/al-raud-al-arabi/<?php echo $images[$i] ?>" class="d-block"
                    style="height: 650px; width: 100%;" alt="Post Image">
            </div>
            <?php } ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="post-details m-1">
        <h2><?php echo $post['Title']; ?></h2>
        <p><?php echo $post['Body']; ?></p>

        <a href="./index.php">Back to Home</a>
    </div>

</div>
<?php include './footer.inc.php';