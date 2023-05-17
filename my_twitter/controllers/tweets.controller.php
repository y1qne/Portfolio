<?php
include("../models/model_tweet.php");
$var = new tweet();
$tweets = $var->timeline_profil($_SESSION['profil_user']);
