<?php
require_once('model_db_connect.php');
class Message extends db_connect{
    
    function liste_conversations($id){
        try {
            $query = "SELECT * FROM conversation WHERE id_user=:id_user";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id,
            ));
            $result = $stmt->fetchAll();
            return $result;
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function participants($id_conv,$id_user){
        try {
            $query = "SELECT users.alias FROM conversation LEFT JOIN users on users.id=conversation.id_user WHERE conversation.id IN (:id_conv) AND conversation.id_user != :id_user";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_conv' => $id_conv,
                ':id_user' => $id_user,
            ));
            $result = $stmt->fetchAll();
            return $result;
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error:  " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function send_message($id_user,$id_conversation, $message, $image=null){
        try {
            $query = "INSERT INTO messages (id_sender, id_conv, message) VALUES(:id_user, :id_conv, :message)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
                ':id_conv' => $id_conversation,
                ':message' => $message,
                // ':image' => $image,
            ));
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function load_messages($id_conv){
        try {
            $query = "SELECT messages.id_sender, users.id, users.pseudo, messages.message, DATE_FORMAT(messages.sent_at,'%e %M %H:%i') as 'sent_at' FROM messages LEFT JOIN users on messages.id_sender=users.id WHERE id_conv=:id_conv ORDER BY messages.sent_at DESC"; // LIMIT?
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_conv' => $id_conv,
            ));
            $result = $stmt->fetchAll();
            return $result;
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function next_id_conv(){
        try {
            $query = "SELECT * FROM conversation ORDER BY id DESC LIMIT 1";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return ($result[0]['id']+1);
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }

    function add_user_to_conversation($participant, $id_conv){
        try {
            $query = "INSERT INTO conversation VALUES(:id_conv, :id_user)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $participant,
                ':id_conv' => $id_conv,
            ));
            // header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
}