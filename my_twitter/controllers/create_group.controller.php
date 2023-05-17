<?php 
require_once("../models/model_user_interactions.php");
$var = new UserInteractions();
$followers = $var->liste_followers($id);
