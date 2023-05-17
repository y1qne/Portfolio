<?php
require_once('model_db_connect.php');
class profil extends db_connect
{
    function edit_profil($id, $theme, $pseudo, $alias, $pronouns, $birthdate, $email, $bio, $location)
    {
        try {
            $query = "UPDATE `users`
        SET `theme` = \"$theme\", `pseudo`= \"$pseudo\", `alias` = \"$alias\", `pronouns` = \"$pronouns\", `birthdate` = \"$birthdate\", `email` = \"$email\", `bio` = \"$bio\", `location` = \"$location\" WHERE users.id = $id;";
            $result_row = $this->pdo->query($query);
            $result_row->fetch(PDO::FETCH_ASSOC);
            //             header("Location:../my_account.php");
        } catch (PDOException $e) {
            echo "General Error:" . $e->getMessage();
        }
    }
    function profil($alias)
    {
        try {
            $query = "SELECT * FROM `users` WHERE pseudo = :alias2";
            $result = $this->pdo->prepare($query);
            $result->execute(array(
                ':alias2' => $alias,
            ));
            $row = $result->fetchAll();
            return $row;
        } catch (PDOException $e) {
            echo "General Error:" . $e->getMessage();
        }
    }
}
