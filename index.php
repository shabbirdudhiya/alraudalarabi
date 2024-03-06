<?php
require_once './config/Db.php';
include './utils/shorten_text.php';

// Fetch posts from the database
$stmt = $pdo->query("SELECT * FROM posts");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
include 'header.inc.php';
?>

<!-- banner -->
<div class="banner">
    <div class="container">

        <!-- heading -->
        <h2 class="arabic">الروض العربي </h2>
        <!-- paragraph -->
        <p class="arabic" style="font-size: large;"> الروض العربي تعبر رياضة النفوس باللغة
            العربية، وهذا الاسم تورية إلى معنى كلمة "روز" وهو "الدوام" في اللغة الهندية،
            فنهضة الروض العربي تحيي فكرة #ربيع_طوال-السنة إذ هذه اللغة فعلا روضة مليئة بعجائب الفرائد، ومن
            مارسها كان له كل يوم من ثمارها فوائد إثر فوائد،</p>
    </div>
</div>
<!-- banner end -->

<!-- after banner -->
<div class="after-banner">
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4">
                <!-- after banner item -->
                <div class="ab-item">
                    <!-- heading -->
                    <h3 class="arabic"> قل ولا تقل</h3>
                    <!-- paragraph -->
                    <p class="arabic">
                        وهو يركز على تثقيف اللغة وتقويم اللسان، وذلك بأنه قد شاعت بعض الألفاظ والتقاليد الغير
                        الموافقة لقوانين اللغة العربية، فسيبعث كل يوم حقيقة لغوية واحدة تخبر عن أغلوطة تقع عند
                        التكلم وهو ما نقول له لا تقل، ثم يُكشف عن الإستعمال الصحيح من حيث القواعد اللغوية، وهو
                        ما نقول له قل،
                    </p>
                    <br>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 arabic">
                <!-- after banner item -->
                <div class="ab-item">
                    <!-- heading -->
                    <h3 class="arabic">لا علم كعلم التجارب</h3>
                    <!-- paragraph -->
                    <p class="arabic">نحتاج في تعليم الفنون وإحراز المهارات إلى التجارب والإفادات، والعبر والتنبيهات،
                        فلم لا نبحث عن تجارب الماهرين في اللغة العربية، ونعلم طرقهم الممتازة التي بلغتهم إلى تلك المهارة
                        العدملية،
                        فسيبعث تحت هذا البرنامج بعض تجارب عن الطلباء، يخبرون فيه طرق تعليمهم للغة وما ساعدتهم في هذا
                        المجال من التقنيات والأساليب،
                        وهذا البرنامج مفتوح شبابيكه للجميع، سيمنح الفرصة للطلباء أن يبعثوا تجاربهم الذاتية للنشر على
                        المنصة الجامعية</p>
                    <br>
                </div>
            </div>
            <div class="col-md-4 col-sm-4 arabic">
                <!-- after banner item -->
                <div class="ab-item">
                    <!-- heading -->
                    <h3 class="arabic">الأثر العربي</h3>
                    <!-- paragraph -->
                    <p class="arabic">
                        دعوة عامة فوائدها مدهامة!
                        علينا إظهار أثرات النعمة، كما بين ذلك في بيان الإختتام ولي النعمة ط ع،
                        استعدوا لتحقيق أحلامكم في تعلم اللغة العربية! ندعو الجميع من الطلبة والطالبات (سواء بشكل فردي أو
                        اجتماعي) للمشاركة في إرسال المراسلات الممتعة من الفوائد والفرائد اللغوية، وتقديم البوستات على
                        منصتنا بأي شكل من: منشورات، وفيديوهات، ونصوص، وغيرها كيفما يريد الباعث الباحث!
                        يمكنكم المشاركة ليوم واحد، أو لأسبوع، أو لشهر كامل حسب رغبتكم. لنبنِ مجتمعاً يعزز التعليم ويشجع
                        على التبادل الثقافي، وسيحصل أحسن البرامج جوائزا مخصوصة،
                    </p>
                    <br>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- after banner end-->

<!-- events -->
<div class="event" id="event">
    <div class="container">
        <div class="default-heading">
            <!-- heading -->
            <h2>Recent Uploads</h2>
        </div>
        <div class="row">
            <?php foreach ($posts as $post) : ?>
            <div class="col-md-4 col-sm-4">
                <!-- event item -->
                <div class="event-item">
                    <!-- image -->
                    <?php
                        $images = explode(',', $post['Images']);
                        if (!empty($images)) {
                            $firstImage = $images[0];
                            echo '<img class="img-responsive" src="' . $firstImage . '" alt="Events" onclick="location.href=\'post_details.php?id=' . $post['Id'] . '\'" />';
                        }
                        ?>
                    <!-- heading -->
                    <h4><a href="post_details.php?id=<?php echo $post['Id']; ?>"><?php echo $post['Title']; ?></a></h4>
                    <!-- sub text -->
                    <span class="sub-text"><?php echo shorten_text($post['Body'], 50); ?></span>
                    <div class="likes-section">
                        <!-- Like button -->
                        <div class="like-btn" id="like-btn-<?php echo $post['Id']; ?>"
                            onclick="likePost(<?php echo $post['Id']; ?>)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                id="heart-icon-<?php echo $post['Id']; ?>" class="bi bi-heart" viewBox="0 0 16 16">
                                <path
                                    d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143q.09.083.176.171a3 3 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15" />
                            </svg>
                        </div>
                        <!-- Likes count -->
                        <span id="likes-count-<?php echo $post['Id']; ?>"></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- events end -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// Function to handle like button click
function likePost(postId) {

    // Send AJAX request to update likes count
    $.ajax({
        type: 'POST',
        url: '../../blog/logic/logic_like_post.php',
        data: {
            postId: postId
        },
        success: function(response) {
            // Update likes count after successful response
            $('#likes-count-' + postId).html(response);
            $('#like-btn-' + postId).html(
                '<img src="./view/img/heart-fill-svgrepo-com.svg"width="16" height="16" alt="" style="background: none; border: none;"/>'
            );
        }
    });
}

// Function to get likes count on page load
window.onload = function() {
    <?php foreach ($posts as $post) : ?>
    getLikesCount(<?php echo $post['Id']; ?>);
    <?php endforeach; ?>
};

function getLikesCount(postId) {
    // Send AJAX request to fetch likes count
    $.ajax({
        type: 'GET',
        url: '../../blog/logic/logic_get_likes_count.php',
        data: {
            postId: postId
        },
        success: function(response) {
            // Update likes count after successful response
            $('#likes-count-' + postId).html(response);
        }
    });
}
</script>

<?php include './footer.inc.php'; ?>