<?php
require_once("../models/model_user_interactions.php");
$var = new UserInteraction();
$tab_convo = $var->follow($id,$id_user);
