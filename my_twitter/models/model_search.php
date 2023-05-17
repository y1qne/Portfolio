<?php
require_once('model_db_connect.php');
class search extends db_connect
{
    function search($texte)
    {
        try {
            $query = "SELECT * FROM `users` WHERE (pseudo = :texte or alias = :texte);";
            $result = $this->pdo->prepare($query);
            $result->execute(array(
                ':texte' => $texte,
            ));
            $row = $result->fetchAll();
            return $row;
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }
}
