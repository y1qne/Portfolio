<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php require_once('../controllers/profil.controller.php'); ?>
<?php
foreach ($results as $key) {
    $_SESSION['profil_user'] = $key['id'];
}
?>
<?php require_once('../controllers/tweets.controller.php') ?>
<?php
if (empty($results)) {
    //A créer
    header('Location: /404.php');
    exit();
} else {
    foreach ($results as $key) {
        $user_id = $key['id'];
?>
        <div class="container my-5">
            <div class="row justify-content-center">
                <div class="col-md-4 col-lg-3 mb-3">
                    <div class="card border-0 shadow-sm">
                        <img src='./images/profil/<?= $user_id ?>.png' class="card-img-top" alt="<?= $key['alias'] ?>">
                        <div class="card-body text-center">
                            <h5 class="card-title"><?php echo $key['pseudo']; ?></h5>
                            <p class="card-text"><?php echo $key['bio']; ?></p>
                            <button id='follow_button<?=$key['id']?>' class="btn btn-primary">Follow</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-8 col-lg-6">
                    <?php foreach ($tweets as $tweet) : ?>
                        <?php require_once('view_time.php'); ?>
                        <?php $placeholder = "images/logo.png" ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4">
                                    <img src="<?= $placeholder ?>" class="card-img-top" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body">
                                        <p class="card-text"><?= $tweet['message'] ?></p>
                                        <p class="card-text">@<?= $tweet['alias'] ?>
                                            <small class="text-muted"> <?= $time ?></small>
                                        </p>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-auto">
                                                <button class="btn tweet_int btn_like">
                                                    <span class="like-counter">
                                                        <?= $tweet['like'] ?>
                                                    </span>

                                                    <?php
                                                    if ($like_stat = $var->like_stat($user_id, $tweet['id'])) {
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
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn tweet_int"><?= $tweet['retweet'] ?> <i class="fa-solid fa-message"></i></button>
                                            </div>
                                            <div class="col-auto">
                                                <button class="btn tweet_int"><?= $tweet['retweet'] ?> <i class="fa-solid fa-retweet"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
<?php


    }
}
?>