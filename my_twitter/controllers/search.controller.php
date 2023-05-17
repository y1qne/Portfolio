<?php 
include_once("../models/model_search.php");
$var = new search();
$results = $var->search($_POST["texte"]);
include_once("../views/view_search_result.php");