<?php
require_once('model_db_connect.php');
class UserInteractions extends db_connect{
    function follow($id_user,$id_follow){
        try {
            $query = "INSERT INTO follow(id_user, followed) VALUES(:id_user, :id_follow)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
                ':id_follow' => $id_follow,
            ));
            header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function block($id_user,$id_block){
        try {
            $query = "INSERT INTO follow(id_user, blocked) VALUES(:id_user, :id_block)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
                ':id_block' => $id_block,
            ));
            header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function liste_followers($id_user){
        try {
            $query = "SELECT users.id, users.pseudo, users.alias FROM follow LEFT JOIN users on users.id=follow.id_user WHERE follow.followed=:id_user;";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
            ));
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
    function liste_following($id_user){
        try {
            $query = "SELECT users.id, users.pseudo, users.alias FROM follow LEFT JOIN users on users.id=follow.id_user WHERE follow.id_user=:id_user;";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
            ));
            $result = $stmt->fetchAll();
            return $result;
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }
}