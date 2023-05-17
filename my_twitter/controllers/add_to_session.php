<?php
// Récupération des données envoyées par la requête POST
$conv_id = $_POST['data'];

// Ajout des données à $_SESSION
$_SESSION['conversation'] = $conv_id;

var_dump($_SESSION);