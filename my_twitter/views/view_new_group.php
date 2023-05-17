<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php require_once('../controllers/get_followers.controller.php'); ?>

<div class='d-flex justify-content-center '>
    <div class="liste_conversations col-lg-8 col-md-10 col-sm-12">
        <?php if ($followers==null) : ?>
        <p class='noconv'> No followers. Make friends first!</p>
        <?php endif ?> 
        <?php if ($followers!=null) : ?>
            <div class='convo d-grid gap-2' >
                <?php foreach ($followers as $follower) : ?>
                <button id='follower<?=$follower['id']?>' class='bouton_conv'> <?=$follower['alias']?> @<?=$follower['pseudo']?></button>
            <?php endforeach ?>
            <button id='create_group' class='bouton_conv'> Start conversation</button>
            <input id='user' value=<?=$id?> hidden></input>
            </div>
        <?php endif ?>
    </div>
</div>


<script src='./script/groupe.js'></script>

