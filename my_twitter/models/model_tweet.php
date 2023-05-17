<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('model_db_connect.php');
class tweet extends db_connect
{
    function post_tweet($texte, $location, $image, $id)
    {
        try {
            $query = "INSERT INTO `tweet` (`id_user`, `message`, `location`, `image`) VALUES (:id,:texte, :location, :image);";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id' => $id,
                ':texte' => $texte,
                ':location' => $location,
                ':image' => $image,
            ));
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }

    function timeline($id_user){
        try{
            $query = "SELECT * , COUNT(like.id_user) as 'like', COUNT(retweet.id_user) as 'retweet' FROM tweet LEFT JOIN users on tweet.id_user=users.id LEFT JOIN `like` ON tweet.id = like.id_tweet LEFT JOIN `retweet` ON tweet.id = retweet.id_tweet GROUP BY tweet.id HAVING tweet.id_user IN (SELECT follow.followed FROM follow WHERE follow.id_user=:id_user) OR tweet.id_user=:id_user ORDER BY tweet.date DESC";            
            $result = $this->pdo->prepare($query);
            $result->execute(array(
                ':id_user' => $id_user,
            ));
            $results = $result->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }

    function timeline_profil($id_user)
    {
        try {
            $query = "SELECT t.*, 
            users.alias,
            users.pseudo,
            users.id as 'id_user_t_users',
            r.id_tweet as retweet_message,
            COUNT(like.id_user) as 'like',
            COUNT(r.id_user) as 'retweet'
            FROM tweet t 
            LEFT JOIN `like` ON t.id = like.id_tweet 
            LEFT JOIN retweet r ON t.id = r.id_tweet AND r.id_user = :id_user
            LEFT JOIN users on t.id_user = users.id
            WHERE t.id_user = :id_user OR r.id_user = :id_user
            GROUP BY `id`
            ORDER BY date DESC;";
            $result = $this->pdo->prepare($query);
            $result->execute(array(
                ':id_user' => $id_user,
            ));
            $results = $result->fetchAll();
            return $results;
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }

    function trending()
    {
        try {
            $query = "SELECT *, tweet.id, COUNT(like.id_user) as \"like\", COUNT(retweet.id_user) as \"retweet\" FROM `tweet` LEFT JOIN `like` ON tweet.id = like.id_tweet LEFT JOIN `retweet` ON tweet.id = retweet.id_tweet LEFT JOIN `users` on tweet.id_user = users.id GROUP BY tweet.id ORDER BY tweet.date DESC;";
            $result = $this->pdo->prepare($query);
            $result->execute();
            $row = $result->fetchAll();
            return $row;
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }

    function like_stat($user_id, $id_tweet)
    {
        try {
            $query = "SELECT count(*) FROM `like` WHERE id_tweet = :id_tweet AND id_user = :id_user";
            $result = $this->pdo->prepare($query);
            $result->execute(array(
                ':id_tweet' => $id_tweet,
                ':id_user' => $user_id,
            ));
            $count = $result->fetchColumn();
            return $count;
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
    }
}
