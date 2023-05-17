<?php
include_once('../models/model_user.php');
$var = new user();
$var->verify_users($_POST["username"], $_POST["password"]);
