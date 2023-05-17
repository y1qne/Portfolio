<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
Résultats de ma recherche :
<?php foreach ($results as $tweet) : ?>
    <div id=tweet>
        <?= $tweet['alias'] ?>
    </div>
<?php endforeach; ?>