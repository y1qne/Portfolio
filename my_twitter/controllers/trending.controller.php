<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include("../models/model_tweet.php");
$var = new tweet();
$results = $var->trending();
