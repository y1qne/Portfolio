<?php
include("../models/model_tweet.php");
$var = new tweet();
$var->post_tweet($_POST['texte'], $_POST['location'], $_POST['image'], $_POST["id"]);

header("Location:../home");
