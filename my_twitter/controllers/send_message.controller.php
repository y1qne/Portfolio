<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("../models/model_messages.php");
require_once('users.controller.php');
$var = new Message();
$var->send_message($id,$_POST['id_conv'],$_POST['message_content']);
require_once('../views/view_messages.php');