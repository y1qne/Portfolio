<?php 
require_once("../models/model_messages.php");
$var = new Message();
$tableau_messages = $var->load_messages($_POST['id_conv']);
