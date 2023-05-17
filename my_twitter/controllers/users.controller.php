<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (strpos($_SERVER['SCRIPT_NAME'], 'index.php') !== false) {
    session_start();
    include_once('./models/model_user.php');
} else {
    session_start();
    include_once('../models/model_user.php');
    $id = $_SESSION['id'];
    $query = "SELECT * from users where id = \"$id\"";
    $result = $db->pdo->query($query);
    $row = $result->fetch(PDO::FETCH_ASSOC);
    $email = $_SESSION["email"] = $row["email"];
    $pseudo = $_SESSION["pseudo"] = $row["pseudo"];
    $alias = $_SESSION["alias"] = $row["alias"];
    $pronouns = $_SESSION["pronouns"] = $row["pronouns"];
    $birthdate = $_SESSION["birthdate"] = $row["birthdate"];
    $password = $_SESSION["password"] = $row["password"];
    $bio = $_SESSION["bio"] = $row["bio"];
    $location = $_SESSION["location"] = $row["location"];
    $statut = $_SESSION['statut'] = $row['statut'];
    $theme = $_SESSION['theme'] = $row['theme'];
    $created_at = $_SESSION["created_at"] = $row["created_at"];
    $updated_at = $_SESSION["updated_at"] = $row["updated_at"];
    $picture = "users/$id.png";
}
