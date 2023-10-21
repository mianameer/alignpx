<?php
include "../../includes/config.php";
include "../../includes/functions.php";

$api_key = constant("Api-Key");
$news = ApiCalling();
if ($news["status"] == 'ok') {
    $newsArticlesArray = $news["articles"];
} else {
    $error = $supportError;
}
?>
<?php
include "../../includes/header.php";
include "../../includes/sidebar.php"; ?>
<div class="main-container" id="container">
    <div class="overlay"></div>
    <div class="search-overlay"></div>
    <div id="content" class="main-content">

        <div class="row">
            <?php for ($i = 0; $i < count($newsArticlesArray); $i++) {
                $timestamp = $newsArticlesArray[$i]['publishedAt'];
                $date = date("Y-m-d", strtotime($timestamp));
            ?>

                <div style="margin: 10px;" class="">
                    <div class="card component-card_9">
                        <a href="<?= $newsArticlesArray[$i]['url'] ?>" target="_blank" rel="noopener noreferrer"><img src="<?= $newsArticlesArray[$i]['urlToImage'] ?>" class="card-img-top" alt="widget-card-2"></a>
                        <div class="card-body">
                            <p class="meta-date"><?= $date ?></p>

                            <h5 class="card-title"><?= $newsArticlesArray[$i]['title'] ?></h5>
                            <p class="card-text"><?= $newsArticlesArray[$i]['description'] ?></p>

                            <div class="meta-info">
                                <div class="meta-user">
                                    <div class="avatar avatar-sm">
                                        <span class="avatar-title rounded-circle">BBC</span>
                                    </div>
                                    <div class="user-name"><?= $newsArticlesArray[$i]['source']['name'] ?></div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            <?php } ?>
        </div>
    </div>
</div>

</div>

<?php include "../../includes/footer.php"; ?>