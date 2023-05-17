<?php require_once('view_header.php'); ?>
<?php require_once('view_nav.php'); ?>
<?php require_once('../controllers/messages_conversation.controller.php'); ?>



<div class="container-fluid conversation_in">
    <h3><?=$_POST['participants']?></h3>
    <div class='box_messages'>
        <?php if ($tableau_messages==null) : ?>
        <p> No messages sent yet. <br> Start chatting!</p>
        <?php endif ?> 
        <?php foreach ($tableau_messages as $message) : ?>
        <?php if ($message['id_sender']==$id) : ?>
            <div class='message right' >
            <p class='message_content'><?=$message['message']?></p>
            <div class='message_info'>
                <p class='message_timestamp'><?=$message['sent_at']?></p>
            </div>
        <?php else: ?>
            <div class='message' >
            <p class='message_content'><?=$message['message']?></p>
            <div class='message_info'>
                <p class='message_sender'>@<?=$message['pseudo']?></p>
                <p class='message_timestamp'><?=$message['sent_at']?></p>
            </div>
        <?php endif?>
        </div>
        <?php endforeach ?>
    </div>
    <form action='conversation_new' class='conversation_new' method='POST'>
    <input type='number' name='id_conv' value=<?=$_POST['id_conv']?> hidden>
    <input type='text' name='participants' value='<?=$_POST['participants']?>' hidden>
    <textarea class='send_message_content' type='text' maxlength='140' name='message_content' required></textarea>
    <button class='send_message_button' type='submit'>SEND</button>
    </form>
</div>

