<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php require_once('../controllers/timeline.controller.php') ?>
<?php require_once('view_post_tweet.php') ?>

<div class="d-flex justify-content-center">
    <div class="col-lg-8 col-md-10 col-sm-12">
        <?php foreach ($results as $tweet) : ?>
            <?php require_once('view_time.php'); ?>
            <?php $placeholder = "images/logo.png" ?>
            <div class="col">
                <div class="card" id="<?= $tweet['id'] ?>">
                    <div class="card-body">
                        <p class="card-text"><?= $tweet['message'] ?></p>
                        <p class="card-text">@<?= $tweet['pseudo'] ?>
                            <small class="text-muted"> <?= $time ?></small>
                        </p>
                        <div class="row row-cols-4 row-cols-md-4 g-4 tweet_int_row">
                            <button class="tweet_int btn_like">
                                <span class="like-counter">
                                    <?= $tweet['like'] ?>
                                </span>

                                <?php
                                if ($like_stat = $var->like_stat($id, $tweet['id'])) {
                                    $tweet['liked'] = true;
                                } else {
                                    $tweet['liked'] = false;
                                }

                                ?>
                                <?php
                                if ($tweet['liked'] == true) {

                                ?>
                                    <i class="fa-solid fa-heart-broken liked"></i>
                                <?php
                                } else {
                                ?>
                                    <i class="fa-solid fa-heart"></i>
                                <?php
                                }
                                ?>

                            </button>
                            <button class="tweet_int"><?= $tweet['retweet'] ?> <i class="fa-solid fa-message"></i></button>
                            <button class="tweet_int"><?= $tweet['retweet'] ?> <i class="fa-solid fa-retweet"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>