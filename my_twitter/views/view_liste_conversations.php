<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php require_once('../controllers/liste_conversations.controller.php'); ?>

<div class='d-flex justify-content-center '>
    <div class="liste_conversations col">
        <h3>Your DMs</h3>
        <form action='new_group' class='d-grid gap-2'>
            <button type='submit' class='nouvelle_conv'>Create a new discussion</button>
        </form>
        <?php if ($convo==null) : ?>
        <p class='noconv'> No conversations yet. Start chatting!</p>
        <?php endif ?> 
        <?php if ($convo!=null) : ?>
            <?php foreach ($convo as $conv) : ?>
            <div class='convo' >
                <?php $p='';
                if (is_int($conv[1])){
                    $p=$convo[1];
                }else{  
                    for ($i=0 ; $i<count($conv[1]) ; $i++){
                        $p .= $conv[1][$i] . ', ';
                    }
                    $p = substr($p,0,-2);
                } ?>
                <form action='conversation' method='POST' class='d-grid gap-2'>
                    <input type='text' name='participants' value='<?=$p?>' hidden>
                    <input type='number' name='id_conv' value=<?=$conv[0]?> hidden>
                    <button type='submit' id='conversation<?=$conv[0]?>' class='bouton_conv'> Convo with <?=$p?> </h6>
                </form>
            </div>
            <?php endforeach ?>
        <?php endif ?>
    </div>
</div>

<!-- <script src='./script/message.js')></script> -->