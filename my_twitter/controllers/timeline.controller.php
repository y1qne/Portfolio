<?php 
include("../models/model_tweet.php");
$var = new tweet();
$results = $var->timeline($id);