<?php
require_once('model_db_connect.php');
class user extends db_connect{
    function add_user_to_db($pseudo, $birthdate, $email, $password)
    {
        try {

            $query = "INSERT INTO users(pseudo, alias, birthdate, email, password, created_at) VALUES(:pseudo, :pseudo, :birthdate, :email, :password, NOW())";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':pseudo' => $pseudo,
                ':birthdate' => $birthdate,
                ':email' => $email,
                ':password' => hash_hmac('ripemd160', 'vive le projet tweet_academy', $password),
            ));
            header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
            //header("Location:..//index.php?status=error");
        }
    }

    function verify_users($username, $password)
    {
        $u_password = $_POST["password"];
        $username = $_POST["username"];
        $query = "SELECT password FROM `users` WHERE (pseudo = \"$username\" OR email = \"$username\");";
        $result = $this->pdo->query($query);
        $row = $result->fetch(PDO::FETCH_ASSOC);
        $password = $row['password'];
        if ($password == $u_password) {
            $query = "SELECT * FROM `users` WHERE (pseudo = \"$username\" OR email = \"$username\");";
            $result = $this->pdo->query($query);
            $row = $result->fetch(PDO::FETCH_ASSOC);
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION["id"] = $row["id"];
            header("Location: ../home");
        } else {
            header("Location: ../index.php?status=error");
        }
    }

    function delete_account($id)
    {
        echo "UPDATE `users` SET `statut` = '0' WHERE `users`.`id` = $id";
        $query = "UPDATE `users` SET `statut` = '0' WHERE `users`.`id` = :id; ";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(array(
            ':id' => $id,
        ));
    }
    
}
