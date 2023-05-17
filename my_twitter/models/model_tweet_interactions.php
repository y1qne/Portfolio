<?php
require_once('../controllers/users.controller.php');
require_once('model_db_connect.php');

class TweetInteractions extends db_connect
{
    function like($id_tweet, $id_user)
    {
        try {
            $query = "INSERT INTO `like` (id_user, id_tweet) VALUES(:id_user, :id_tweet)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_tweet' => $id_tweet,
                ':id_user' => $id_user,
            ));
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
        }
    }

    function dislike($id_tweet, $id_user)
    {
        try {
            $query = "DELETE FROM `like` WHERE id_user = :id_user AND id_tweet = :id_tweet";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_tweet' => $id_tweet,
                ':id_user' => $id_user,
            ));
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
        }
    }

    function getLikesCount($tweet_id)
    {
        try {
            $query = "SELECT count(*) as \"like_count\" FROM `like` where id_tweet = :tweet_id";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':tweet_id' => $tweet_id,
            ));
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "General Error: " . $e->getMessage();
        }
        return $result['like_count'];
    }
    function retweet($id_user, $id_tweet)
    {
        try {
            $query = "INSERT INTO retweet(id_user, id_tweet) VALUES(:id_user, :id_tweet)";
            $stmt = $this->pdo->prepare($query);
            $stmt->execute(array(
                ':id_user' => $id_user,
                ':id_tweet' => $id_tweet,
            ));
            header("Location:../index.php?status=success");
        } catch (PDOException $e) {
            echo "General Error: C'EST CA " . $e->getMessage();
        }
    }
}

if ($_POST['action'] == 'like') {
    $test = new TweetInteractions();
    $test->like($_POST['id'], $id);
    $likes_count = $test->getLikesCount($_POST['id'], $id);
    header('Content-Type: application/json');
    echo json_encode(array('likes' => $likes_count));
    return;
}

if ($_POST['action'] == 'dislike') {
    $test = new TweetInteractions();
    $test->dislike($_POST['id'], $id);
    $likes_count = $test->getLikesCount($_POST['id'], $id);
    header('Content-Type: application/json');
    echo json_encode(array('likes' => $likes_count));
    return;
}
